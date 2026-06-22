<?php

namespace App\Services\AI;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Immutable value object passed to every ToolHandler::execute() call.
 * Carries auth state, session references, and the originating request.
 */
final class Context
{
    public function __construct(
        public readonly ?User    $user,
        public readonly ?string  $printSessionToken,
        public readonly ?string  $cartInstance,
        public readonly string   $requestId,
        public readonly bool     $isAdmin,
        public readonly Request  $request,
    ) {}

    public static function fromRequest(Request $request): self
    {
        /** @var User|null $user */
        $user = $request->user();

        return new self(
            user:               $user,
            printSessionToken:  $request->input('print_session_token'),
            cartInstance:       'default',
            requestId:          uniqid('ai_', true),
            isAdmin:            $user?->is_admin ?? false,
            request:            $request,
        );
    }
}
