<?php

namespace App\Services\AI\Tools;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * UC1 — Add a product (simple or configurable) to the session cart.
 *
 * Uses the exact same Cart::add() payload shape as
 * Frontend\CartController::addSimpleProductToCart() and
 * addConfigurableProductToCart() to ensure session compatibility.
 *
 * Requires confirm:true in args before writing to cart.
 */
class AddToCartTool implements ToolHandler
{
    public function name(): string
    {
        return 'add_to_cart';
    }

    public function description(): string
    {
        return 'Tambahkan produk ke keranjang belanja. Wajib konfirmasi pengguna (confirm: true) sebelum menjalankan aksi ini.';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'product_id' => [
                    'type'        => 'integer',
                    'description' => 'ID produk yang akan ditambahkan',
                ],
                'variant_id' => [
                    'type'        => 'integer',
                    'description' => 'ID varian produk (wajib untuk produk configurable)',
                ],
                'qty' => [
                    'type'        => 'integer',
                    'description' => 'Jumlah yang akan ditambahkan (default 1)',
                ],
                'confirm' => [
                    'type'        => 'boolean',
                    'description' => 'Harus true agar aksi dieksekusi. Tanyakan konfirmasi ke pengguna terlebih dahulu.',
                ],
            ],
            'required' => ['product_id', 'confirm'],
        ];
    }

    public function requiredRole(): string
    {
        return 'auth';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        // Safety gate — model must ask user first
        if (empty($args['confirm']) || $args['confirm'] !== true) {
            return ToolResult::error('Aksi dibatalkan. Konfirmasi pengguna diperlukan (confirm: true).');
        }

        $productId = (int) ($args['product_id'] ?? 0);
        $qty       = max(1, (int) ($args['qty'] ?? 1));

        $product = Product::with(['productImages', 'productInventory', 'productVariants.variantAttributes'])
            ->find($productId);

        if (! $product) {
            return ToolResult::error("Produk dengan ID {$productId} tidak ditemukan.");
        }

        if ($product->type === 'configurable') {
            return $this->addConfigurable($product, $args, $qty);
        }

        return $this->addSimple($product, $qty);
    }

    private function addSimple(Product $product, int $qty): ToolResult
    {
        $available = $product->productInventory?->qty ?? 0;
        $inCart    = $this->getProductCartQty($product->id);

        if ($available < ($inCart + $qty)) {
            return ToolResult::error(
                "Stok tidak cukup. Tersedia: {$available}, Di keranjang: {$inCart}, Diminta: {$qty}."
            );
        }

        Cart::add([
            'id'      => $product->id,
            'name'    => $product->name,
            'price'   => $product->price,
            'qty'     => $qty,
            'weight'  => $product->weight ?? 50,
            'options' => [
                'product_id' => $product->id,
                'variant_id' => null,
                'type'       => 'simple',
                'slug'       => $product->slug,
                'image'      => $product->productImages->first()?->path ?? '',
                'sku'        => $product->sku ?? 'NO-SKU',
            ],
        ])->associate(Product::class);

        return ToolResult::ok(
            [
                'product_id'  => $product->id,
                'product_name'=> $product->name,
                'qty'         => $qty,
                'cart_count'  => Cart::content()->count(),
                'checkout_url'=> url('/orders/checkout'),
            ],
            '',
            "Produk '{$product->name}' (x{$qty}) berhasil ditambahkan ke keranjang."
        );
    }

    private function addConfigurable(Product $product, array $args, int $qty): ToolResult
    {
        $variantId = (int) ($args['variant_id'] ?? 0);

        if (! $variantId) {
            return ToolResult::error('Produk ini memiliki varian. Harap sertakan variant_id.');
        }

        $variant = ProductVariant::where('id', $variantId)
            ->where('product_id', $product->id)
            ->where('is_active', true)
            ->first();

        if (! $variant) {
            return ToolResult::error("Varian ID {$variantId} tidak ditemukan atau tidak aktif.");
        }

        $inCart = $this->getVariantCartQty($variantId);

        if ($variant->stock < ($inCart + $qty)) {
            return ToolResult::error(
                "Stok varian tidak cukup. Tersedia: {$variant->stock}, Di keranjang: {$inCart}, Diminta: {$qty}."
            );
        }

        $cartItemId = $variantId . '_variant';

        Cart::add([
            'id'      => $cartItemId,
            'name'    => $variant->name,
            'price'   => $variant->price,
            'qty'     => $qty,
            'weight'  => $variant->weight ?? 100,
            'options' => [
                'product_id' => $product->id,
                'variant_id' => $variant->id,
                'type'       => 'configurable',
                'slug'       => $product->slug,
                'image'      => $product->productImages->first()?->path ?? '',
                'attributes' => $variant->variantAttributes->pluck('attribute_value', 'attribute_name')->toArray(),
                'sku'        => $variant->sku ?? $product->sku ?? 'NO-SKU',
            ],
        ])->associate(Product::class);

        return ToolResult::ok(
            [
                'product_id'   => $product->id,
                'variant_id'   => $variant->id,
                'product_name' => $variant->name,
                'qty'          => $qty,
                'cart_count'   => Cart::content()->count(),
                'checkout_url' => url('/orders/checkout'),
            ],
            '',
            "Produk '{$variant->name}' (x{$qty}) berhasil ditambahkan ke keranjang."
        );
    }

    private function getProductCartQty(int $productId): int
    {
        $item = Cart::content()->get($productId);
        return $item ? (int) $item->qty : 0;
    }

    private function getVariantCartQty(int $variantId): int
    {
        $item = Cart::content()->get($variantId . '_variant');
        return $item ? (int) $item->qty : 0;
    }
}
