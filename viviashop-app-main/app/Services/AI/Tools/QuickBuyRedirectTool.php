<?php

namespace App\Services\AI\Tools;

use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;

/**
 * UC1 — Return the checkout URL for a quick-buy redirect.
 * The widget uses the returned URL to navigate the browser.
 */
class QuickBuyRedirectTool implements ToolHandler
{
    public function name(): string
    {
        return 'quick_buy_redirect';
    }

    public function description(): string
    {
        return 'Dapatkan URL halaman checkout untuk melanjutkan pembelian langsung. Gunakan setelah produk ditambahkan ke keranjang.';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'message' => [
                    'type'        => 'string',
                    'description' => 'Pesan opsional untuk ditampilkan kepada pengguna sebelum redirect',
                ],
            ],
        ];
    }

    public function requiredRole(): string
    {
        return 'auth';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        return ToolResult::ok(
            [
                'redirect_url' => url('/orders/checkout'),
                'message'      => $args['message'] ?? 'Silakan lanjutkan ke halaman checkout.',
            ],
            '',
            'Redirect ke checkout siap.'
        );
    }
}
