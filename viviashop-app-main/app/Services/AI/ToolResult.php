<?php

namespace App\Services\AI;

/**
 * Immutable value object returned by every ToolHandler::execute() call.
 */
final class ToolResult
{
    public function __construct(
        public readonly bool   $success,
        public readonly array  $data,
        public readonly string $uiHint = '',   // e.g. 'product-card', 'print-summary-card'
        public readonly string $message = '',  // human-readable summary for the model
    ) {}

    public static function ok(array $data, string $uiHint = '', string $message = ''): self
    {
        return new self(true, $data, $uiHint, $message);
    }

    public static function error(string $message, array $data = []): self
    {
        return new self(false, $data, '', $message);
    }

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'data'    => $this->data,
            'ui_hint' => $this->uiHint,
            'message' => $this->message,
        ];
    }
}
