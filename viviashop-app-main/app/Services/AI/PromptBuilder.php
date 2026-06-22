<?php

namespace App\Services\AI;

/**
 * Builds the system instruction string sent to Gemini.
 * Selects the correct persona based on the request surface (frontend vs admin).
 */
class PromptBuilder
{
    /**
     * Return the system instruction for the given surface.
     *
     * @param string $surface  'frontend' | 'admin'
     * @param array  $extra    Optional extra context lines appended to the prompt
     */
    public function build(string $surface, array $extra = []): string
    {
        $base = config("ai.prompts.{$surface}", config('ai.prompts.frontend'));

        if (! empty($extra)) {
            $base .= "\n\n" . implode("\n", $extra);
        }

        return $base;
    }

    /**
     * Build a frontend (customer-facing) system prompt.
     */
    public function frontend(array $extra = []): string
    {
        return $this->build('frontend', $extra);
    }

    /**
     * Build an admin (back-office) system prompt.
     */
    public function admin(array $extra = []): string
    {
        return $this->build('admin', $extra);
    }

    /**
     * Wrap a ToolResult as a Gemini tool-response content part.
     *
     * @return array{role: string, parts: array}
     */
    public function toolResponseTurn(string $toolName, array $resultData): array
    {
        return [
            'role'  => 'user',
            'parts' => [
                [
                    'functionResponse' => [
                        'name'     => $toolName,
                        'response' => $resultData,
                    ],
                ],
            ],
        ];
    }

    /**
     * Wrap a user message as a Gemini content turn.
     *
     * @return array{role: string, parts: array}
     */
    public function userTurn(string $message): array
    {
        return [
            'role'  => 'user',
            'parts' => [['text' => $message]],
        ];
    }

    /**
     * Wrap a model reply as a Gemini content turn.
     *
     * @return array{role: string, parts: array}
     */
    public function modelTurn(string $text): array
    {
        return [
            'role'  => 'model',
            'parts' => [['text' => $text]],
        ];
    }
}
