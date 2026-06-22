<?php

namespace App\Services\AI;

use App\Models\AiToolCall;
use App\Services\AI\Contracts\ToolHandler;
use Illuminate\Support\Facades\Log;

/**
 * Validates RBAC and invokes the correct ToolHandler.
 * Writes an audit record to ai_tool_calls for every invocation.
 */
class ToolDispatcher
{
    public function __construct(
        private readonly ToolRegistry $registry,
    ) {}

    /**
     * Dispatch a tool call from Gemini.
     *
     * @param string               $toolName  Name from Gemini functionCall.name
     * @param array<string, mixed> $args      Decoded args from Gemini functionCall.args
     * @param Context              $ctx       Request context
     */
    public function dispatch(string $toolName, array $args, Context $ctx): ToolResult
    {
        $tool = $this->registry->get($toolName);

        if ($tool === null) {
            $result = ToolResult::error("Tool '{$toolName}' not found.");
            $this->audit($toolName, $args, $ctx, $result);
            return $result;
        }

        // RBAC check — always re-verified at execution time, never trust model
        if (! $this->isAuthorized($tool, $ctx)) {
            $result = ToolResult::error("Unauthorized: tool '{$toolName}' requires role '{$tool->requiredRole()}'.");
            $this->audit($toolName, $args, $ctx, $result);
            return $result;
        }

        try {
            $result = $tool->execute($args, $ctx);
        } catch (\Throwable $e) {
            Log::error("AI tool '{$toolName}' threw an exception", [
                'exception' => $e->getMessage(),
                'args'      => $args,
                'user_id'   => $ctx->user?->id,
            ]);
            $result = ToolResult::error("Tool execution failed: " . $e->getMessage());
        }

        $this->audit($toolName, $args, $ctx, $result);

        return $result;
    }

    private function isAuthorized(ToolHandler $tool, Context $ctx): bool
    {
        return match ($tool->requiredRole()) {
            'public' => true,
            'auth'   => $ctx->user !== null,
            'admin'  => $ctx->isAdmin,
            default  => false,
        };
    }

    private function audit(string $toolName, array $args, Context $ctx, ToolResult $result): void
    {
        try {
            AiToolCall::create([
                'tool_name'  => $toolName,
                'args'       => json_encode($args),
                'user_id'    => $ctx->user?->id,
                'request_id' => $ctx->requestId,
                'success'    => $result->success,
                'message'    => $result->message,
            ]);
        } catch (\Throwable $e) {
            // Audit failure must never break the main flow
            Log::warning("AI audit log failed: " . $e->getMessage());
        }
    }
}
