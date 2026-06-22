<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Log;

/**
 * Orchestrates the Gemini agentic turn loop.
 *
 * Flow per request:
 *  1. Load conversation history from ConversationStore.
 *  2. Append the new user turn.
 *  3. Call Gemini with the full history + tool declarations.
 *  4. If Gemini returns a functionCall, dispatch it via ToolDispatcher,
 *     append the tool response, and loop (up to max_turns).
 *  5. When Gemini returns a text reply, persist history and return the result.
 */
class AIAgentService
{
    public function __construct(
        private readonly GeminiClient      $gemini,
        private readonly ToolRegistry      $registry,
        private readonly ToolDispatcher    $dispatcher,
        private readonly PromptBuilder     $promptBuilder,
        private readonly ConversationStore $store,
    ) {}

    /**
     * Run one user turn through the agent loop.
     *
     * @param string  $userMessage  Raw user text
     * @param Context $ctx          Request context
     * @param string  $surface      'frontend' | 'admin'
     *
     * @return array{
     *   reply: string,
     *   tool_trace: array,
     *   ui_components: array
     * }
     */
    public function run(string $userMessage, Context $ctx, string $surface = 'frontend'): array
    {
        $sessionKey    = $this->store->keyFromContext($ctx);
        $history       = $this->store->get($sessionKey);
        $systemPrompt  = $surface === 'admin'
            ? $this->promptBuilder->admin()
            : $this->promptBuilder->frontend();
        $fallbackReply = 'Maaf, AI belum dapat memberikan jawaban yang valid. Silakan coba lagi.';

        $role          = $ctx->isAdmin ? 'admin' : ($ctx->user ? 'auth' : 'public');
        $toolDecls     = $this->registry->toGeminiDeclarations($role);

        // Append the new user turn
        $history[] = $this->promptBuilder->userTurn($userMessage);

        $maxTurns  = (int) config('ai.agent.max_turns', 8);
        $toolTrace = [];
        $uiComponents = [];
        $reply     = '';

        for ($turn = 0; $turn < $maxTurns; $turn++) {
            try {
                $response = $this->gemini->generateContent($history, $toolDecls, $systemPrompt);
            } catch (\RuntimeException $e) {
                Log::error('AIAgentService: Gemini call failed', ['error' => $e->getMessage()]);
                $reply = $fallbackReply;
                $history[] = $this->promptBuilder->modelTurn($reply);
                break;
            }

            $functionCall = $this->gemini->extractFunctionCall($response);

            if ($functionCall === null) {
                // Gemini returned a text reply — we're done
                $reply = $this->gemini->extractText($response);

                if (trim($reply) === '') {
                    Log::warning('AIAgentService: Gemini returned an empty reply', [
                        'surface'    => $surface,
                        'request_id' => $ctx->requestId,
                    ]);
                    $reply = $fallbackReply;
                }

                // Append model turn to history
                $history[] = $this->promptBuilder->modelTurn($reply);
                break;
            }

            // Gemini wants to call a tool
            $toolName = $functionCall['name'];
            $toolArgs = $functionCall['args'];

            // Append the model's functionCall turn to history
            $history[] = [
                'role'  => 'model',
                'parts' => [['functionCall' => ['name' => $toolName, 'args' => $toolArgs]]],
            ];

            // Dispatch the tool
            $toolResult = $this->dispatcher->dispatch($toolName, $toolArgs, $ctx);

            $toolTrace[] = [
                'tool'    => $toolName,
                'args'    => $toolArgs,
                'success' => $toolResult->success,
                'message' => $toolResult->message,
            ];

            if ($toolResult->uiHint) {
                $uiComponents[] = [
                    'hint' => $toolResult->uiHint,
                    'data' => $toolResult->data,
                ];
            }

            // Append the tool response turn
            $history[] = $this->promptBuilder->toolResponseTurn($toolName, $toolResult->toArray());
        }

        if (trim($reply) === '') {
            Log::warning('AIAgentService: Gemini loop ended without a final reply', [
                'surface'    => $surface,
                'request_id' => $ctx->requestId,
            ]);
            $reply = $fallbackReply;
            $history[] = $this->promptBuilder->modelTurn($reply);
        }

        // Persist updated history
        $this->store->set($sessionKey, $history);

        return [
            'reply'         => $reply,
            'tool_trace'    => $toolTrace,
            'ui_components' => $uiComponents,
        ];
    }
}
