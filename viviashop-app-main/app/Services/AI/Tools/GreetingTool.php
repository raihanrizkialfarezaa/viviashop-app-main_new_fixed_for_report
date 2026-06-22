<?php

namespace App\Services\AI\Tools;

use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;

class GreetingTool implements ToolHandler
{
    public function name(): string
    {
        return 'greeting';
    }

    public function description(): string
    {
        return 'Menyapa pengguna dan membalas ucapan sapaan.';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'name' => [
                    'type'        => 'string',
                    'description' => 'Nama pengguna (opsional)',
                ],
            ],
        ];
    }

    public function requiredRole(): string
    {
        return 'public';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        $name = $args['name'] ?? ($ctx->user?->name ?? 'Guest');

        return ToolResult::ok(
            ['greeting' => "Halo $name! Ada yang bisa saya bantu?"],
            '',
            "Halo $name! Ada yang bisa saya bantu?"
        );
    }
}
