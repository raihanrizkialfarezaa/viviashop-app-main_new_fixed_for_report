<?php

namespace App\Services\AI\Contracts;

use App\Services\AI\Context;
use App\Services\AI\ToolResult;

/**
 * Every AI tool must implement this contract.
 *
 * The name(), description(), and parameters() methods supply the
 * Gemini function-declaration payload verbatim.
 *
 * requiredRole() returns one of: 'public' | 'auth' | 'admin'
 * execute() performs the actual work and returns a ToolResult.
 */
interface ToolHandler
{
    /** Unique snake_case name matching the Gemini function declaration. */
    public function name(): string;

    /** One-sentence description sent to Gemini. */
    public function description(): string;

    /**
     * JSON Schema object describing the function parameters.
     * Must follow the Gemini FunctionDeclaration.parameters schema.
     *
     * @return array{type: string, properties: array, required?: array}
     */
    public function parameters(): array;

    /**
     * Minimum role required to invoke this tool.
     * 'public' = no auth needed
     * 'auth'   = authenticated user
     * 'admin'  = user with is_admin = true
     */
    public function requiredRole(): string;

    /**
     * Execute the tool with validated arguments.
     *
     * @param array<string, mixed> $args  Decoded JSON args from Gemini
     * @param Context              $ctx   Request context (user, session, etc.)
     */
    public function execute(array $args, Context $ctx): ToolResult;
}
