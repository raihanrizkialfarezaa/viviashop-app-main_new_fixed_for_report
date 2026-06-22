<?php

namespace App\Services\AI\Tools;

use App\Models\Product;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use Illuminate\Support\Facades\DB;

/**
 * UC1 — Search products using validated Eloquent parameters.
 *
 * IMPORTANT: Despite the name "via_sql", this tool NEVER executes raw SQL
 * from the model. All filtering is done through Eloquent scopes and
 * validated parameter values on the read-only DB connection.
 */
class SearchProductsViaSqlTool implements ToolHandler
{
    public function name(): string
    {
        return 'search_products_via_sql';
    }

    public function description(): string
    {
        return 'Cari produk di katalog Viviashop berdasarkan kata kunci, kategori, rentang harga, atau ketersediaan stok. Gunakan parameter min_qty untuk pencarian grosir/volume besar.';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'q' => [
                    'type'        => 'string',
                    'description' => 'Kata kunci pencarian nama produk',
                ],
                'category_slug' => [
                    'type'        => 'string',
                    'description' => 'Slug kategori produk',
                ],
                'price_min' => [
                    'type'        => 'number',
                    'description' => 'Harga minimum (Rupiah)',
                ],
                'price_max' => [
                    'type'        => 'number',
                    'description' => 'Harga maksimum (Rupiah)',
                ],
                'min_qty' => [
                    'type'        => 'integer',
                    'description' => 'Stok minimum yang dibutuhkan (untuk pencarian grosir)',
                ],
                'sort_by' => [
                    'type'        => 'string',
                    'description' => 'Kriteria pengurutan produk (contoh: "terlaris", "price_asc", "price_desc")',
                ],
                'limit' => [
                    'type'        => 'integer',
                    'description' => 'Jumlah maksimum hasil (default 10, max 20)',
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
        try {
            $sortBy = ! empty($args['sort_by']) ? (string) $args['sort_by'] : null;

            // Initialize query based on sorting
            if ($sortBy === 'terlaris') {
                $hasOrders = DB::connection('mysql_readonly')->table('order_items')->exists();
                if ($hasOrders) {
                    $query = Product::on('mysql_readonly')
                        ->selectRaw('products.*, COUNT(order_items.id) as total_sold')
                        ->join('order_items', 'order_items.product_id', '=', 'products.id')
                        ->join('orders', 'order_items.order_id', '=', 'orders.id')
                        ->where('orders.status', \App\Models\Order::COMPLETED)
                        ->active()
                        ->groupBy('products.id')
                        ->orderByRaw('total_sold DESC');
                } else {
                    $query = Product::on('mysql_readonly')
                        ->active()
                        ->orderBy('is_featured', 'desc')
                        ->orderBy('id', 'desc');
                }
            } else {
                $query = Product::on('mysql_readonly')->active();
                if ($sortBy === 'price_asc') {
                    $query->orderBy('price', 'asc');
                } else if ($sortBy === 'price_desc') {
                    $query->orderBy('price', 'desc');
                } else {
                    $query->orderBy('id', 'desc');
                }
            }

            // Eager load relations
            $query->with(['productImages', 'productInventory', 'productVariants', 'brand']);

            // Keyword search
            if (! empty($args['q'])) {
                $q = strip_tags((string) $args['q']);
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhere('sku', 'like', "%{$q}%");
                });
            }

            // Category filter
            if (! empty($args['category_slug'])) {
                $slug = strip_tags((string) $args['category_slug']);
                $query->whereHas('categories', fn ($c) => $c->where('slug', $slug));
            }

            // Price range
            if (! empty($args['price_min'])) {
                $query->where('price', '>=', (float) $args['price_min']);
            }
            if (! empty($args['price_max'])) {
                $query->where('price', '<=', (float) $args['price_max']);
            }

            // Minimum stock (grosir / volume)
            if (! empty($args['min_qty'])) {
                $minQty = (int) $args['min_qty'];
                $query->where(function ($sub) use ($minQty) {
                    $sub->whereHas('productInventory', fn ($inv) => $inv->where('qty', '>=', $minQty))
                        ->orWhereHas('productVariants', fn ($v) => $v->where('stock', '>=', $minQty)->where('is_active', true));
                });
            }

            $limit    = min((int) ($args['limit'] ?? 10), 20);
            $products = $query->limit($limit)->get();

            if ($products->isEmpty()) {
                return ToolResult::ok(
                    ['products' => []],
                    '',
                    'Tidak ada produk yang ditemukan sesuai kriteria pencarian.'
                );
            }

            $data = $products->map(fn (Product $p) => [
                'id'          => $p->id,
                'name'        => $p->name,
                'slug'        => $p->slug,
                'brand'       => $p->brand?->name ?? 'ViviaShop',
                'price'       => $p->base_price,
                'price_label' => 'Rp ' . number_format((float) $p->base_price, 0, ',', '.'),
                'type'        => $p->type,
                'status'      => $p->statusLabel(),
                'total_stock' => $p->total_stock,
                'is_best_seller' => (bool) ($p->is_featured || (isset($p->total_sold) && $p->total_sold > 0)),
                'price_per'   => str_contains(strtolower($p->name), 'kertas') ? 'rim' : 'pcs',
                'image'       => $p->productImages->first()?->path ?? '',
                'url'         => url('/product/' . $p->slug),
                'checkout_url'=> url('/orders/checkout'),
            ])->values()->all();

            return ToolResult::ok(
                ['products' => $data],
                'product-card',
                "Ditemukan {$products->count()} produk."
            );

        } catch (\Throwable $e) {
            return ToolResult::error('Gagal mencari produk: ' . $e->getMessage());
        }
    }
}
