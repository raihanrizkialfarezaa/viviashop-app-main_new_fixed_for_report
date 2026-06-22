<?php

namespace App\Services\AI\Tools;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * UC2 — Add a print job to the session cart.
 *
 * Pushes a Cart line pointing to the print variant with the
 * print_session_token stored in options so the existing
 * OrderController@doCheckout can process it normally.
 *
 * Does NOT call PrintService::createPrintOrder() directly —
 * that happens at checkout time, preserving the existing order pipeline.
 *
 * Requires confirm:true before writing.
 */
class CreatePrintCartItemTool implements ToolHandler
{
    public function name(): string
    {
        return 'create_print_cart_item';
    }

    public function description(): string
    {
        return 'Tambahkan pesanan cetak ke keranjang setelah pengguna mengkonfirmasi biaya. Wajib konfirmasi pengguna (confirm: true).';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'variant_id' => [
                    'type'        => 'integer',
                    'description' => 'ID varian produk cetak (dari resolve_print_variant)',
                ],
                'total_pages' => [
                    'type'        => 'integer',
                    'description' => 'Total halaman dokumen',
                ],
                'quantity' => [
                    'type'        => 'integer',
                    'description' => 'Jumlah rangkap (default 1)',
                ],
                'total_price' => [
                    'type'        => 'number',
                    'description' => 'Total harga yang sudah dikonfirmasi (dari calculate_print_cost)',
                ],
                'confirm' => [
                    'type'        => 'boolean',
                    'description' => 'Harus true agar aksi dieksekusi.',
                ],
            ],
            'required' => ['variant_id', 'total_pages', 'total_price', 'confirm'],
        ];
    }

    public function requiredRole(): string
    {
        return 'auth';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        if (empty($args['confirm']) || $args['confirm'] !== true) {
            return ToolResult::error('Aksi dibatalkan. Konfirmasi pengguna diperlukan (confirm: true).');
        }

        $variantId  = (int) ($args['variant_id'] ?? 0);
        $totalPages = (int) ($args['total_pages'] ?? 0);
        $quantity   = max(1, (int) ($args['quantity'] ?? 1));
        $totalPrice = (float) ($args['total_price'] ?? 0);

        if (! $variantId || ! $totalPages || ! $totalPrice) {
            return ToolResult::error('variant_id, total_pages, dan total_price wajib diisi.');
        }

        $variant = ProductVariant::with('product')->find($variantId);

        if (! $variant || ! $variant->product?->is_print_service) {
            return ToolResult::error("Varian cetak ID {$variantId} tidak ditemukan.");
        }

        $product = $variant->product;

        // Cart item ID uses variant ID with print suffix to avoid collision with retail items
        $cartItemId = $variantId . '_print';

        Cart::add([
            'id'      => $cartItemId,
            'name'    => $variant->name . " ({$totalPages} hal × {$quantity} rangkap)",
            'price'   => $totalPrice,   // total price as a single line item
            'qty'     => 1,
            'weight'  => 0,
            'options' => [
                'product_id'          => $product->id,
                'variant_id'          => $variant->id,
                'type'                => 'print_service',
                'slug'                => $product->slug,
                'image'               => '',
                'sku'                 => $variant->sku ?? 'PRINT',
                'print_session_token' => $ctx->printSessionToken,
                'total_pages'         => $totalPages,
                'quantity'            => $quantity,
                'price_per_page'      => $variant->price,
            ],
        ])->associate(Product::class);

        return ToolResult::ok(
            [
                'cart_item_id' => $cartItemId,
                'variant_name' => $variant->name,
                'total_pages'  => $totalPages,
                'quantity'     => $quantity,
                'total_price'  => $totalPrice,
                'total_price_label' => 'Rp ' . number_format($totalPrice, 0, ',', '.'),
                'cart_count'   => Cart::content()->count(),
                'checkout_url' => url('/orders/checkout'),
            ],
            'print-summary-card',
            "Pesanan cetak '{$variant->name}' berhasil ditambahkan ke keranjang. Total: Rp " . number_format($totalPrice, 0, ',', '.')
        );
    }
}
