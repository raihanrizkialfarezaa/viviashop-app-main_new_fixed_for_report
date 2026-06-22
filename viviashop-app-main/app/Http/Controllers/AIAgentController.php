<?php

namespace App\Http\Controllers;

use App\Http\Requests\AI\AIChatRequest;
use App\Services\AI\AIAgentService;
use App\Services\AI\Context;
use App\Services\PrintService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Handles all AI agent HTTP interactions.
 *
 * Public surface  (web middleware):
 *   POST /ai/chat              — UC1 + UC2 frontend chat
 *   POST /ai/upload            — UC2 file upload (auth required)
 *
 * Admin surface  (auth + is_admin middleware):
 *   GET  /admin/ai-assistant   — admin console page
 *   POST /admin/ai-assistant/chat — UC3 + UC4 admin chat
 */
class AIAgentController extends Controller
{
    public function __construct(
        private readonly AIAgentService $agentService,
        private readonly PrintService   $printService,
    ) {}

    // -------------------------------------------------------------------------
    // Public / Frontend
    // -------------------------------------------------------------------------

    /**
     * Handle a frontend chat turn (UC1 + UC2).
     */
    public function handleChat(AIChatRequest $request): JsonResponse
    {
        $ctx     = Context::fromRequest($request);
        $message = $request->input('message', '');

        try {
            $result = $this->agentService->run($message, $ctx, 'frontend');

            return response()->json([
                'success'       => true,
                'reply'         => $result['reply'],
                'tool_trace'    => $result['tool_trace'],
                'ui_components' => $result['ui_components'],
            ]);

        } catch (\Throwable $e) {
            Log::error('AIAgentController::handleChat failed', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'reply'   => 'Maaf, terjadi kesalahan. Silakan coba lagi.',
                'error'   => app()->isLocal() ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Upload a file for the print assistant (UC2).
     * Reuses PrintService::generateSession() + uploadFiles() exactly as the
     * existing print-service widget does.
     */
    public function uploadAttachment(Request $request): JsonResponse
    {
        $request->validate([
            'files'   => 'required|array|min:1',
            'files.*' => 'file|max:51200', // 50 MB
        ]);

        try {
            // Reuse existing session token if provided, otherwise generate new
            $token   = $request->input('print_session_token');
            $session = $token
                ? $this->printService->getSession($token)
                : null;

            if (! $session) {
                $session = $this->printService->generateSession();
            }

            $result = $this->printService->uploadFiles($request->file('files'), $session);

            return response()->json([
                'success'             => true,
                'print_session_token' => $session->session_token,
                'total_pages'         => $result['total_pages'],
                'files'               => $result['files'],
                'newly_uploaded'      => $result['newly_uploaded'],
                'skipped_files'       => $result['skipped_files'] ?? [],
            ]);

        } catch (\Throwable $e) {
            Log::error('AIAgentController::uploadAttachment failed', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunggah file: ' . $e->getMessage(),
            ], 422);
        }
    }

    // -------------------------------------------------------------------------
    // Admin surface
    // -------------------------------------------------------------------------

    /**
     * Render the admin AI assistant console page.
     */
    public function adminConsole(): \Illuminate\View\View
    {
        return view('ai.admin-console');
    }

    /**
     * Handle an admin chat turn (UC3 + UC4).
     */
    public function handleAdminChat(AIChatRequest $request): JsonResponse
    {
        $ctx     = Context::fromRequest($request);
        $message = $request->input('message', '');

        try {
            $result = $this->agentService->run($message, $ctx, 'admin');

            return response()->json([
                'success'       => true,
                'reply'         => $result['reply'],
                'tool_trace'    => $result['tool_trace'],
                'ui_components' => $result['ui_components'],
            ]);

        } catch (\Throwable $e) {
            Log::error('AIAgentController::handleAdminChat failed', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'reply'   => 'Maaf, terjadi kesalahan pada AI. Silakan coba lagi.',
                'error'   => app()->isLocal() ? $e->getMessage() : null,
            ], 500);
        }
    }
}
