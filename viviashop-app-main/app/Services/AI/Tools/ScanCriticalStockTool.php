<?php

namespace App\Services\AI\Tools;

use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use App\Services\StockManagementService;

/**
 * UC3 — Scan for product variants whose stock is at or below min_stock_threshold.
 *
 * Delegates to StockManagementService::getLowStockVariants() which already
 * filters by the existing min_stock_threshold column on product_variants.
 */
class ScanCriticalStockTool implements ToolHandler
{
    public function __construct(
        private readonly StockManagementService $stockService,
    ) {}

    public function name(): string
    {
        return 'scan_critical_stock';
    }

    public function description(): string
    {
        return 'Pindai semua varian produk yang stoknya kritis (di bawah atau sama dengan min_stock_threshold). Kembalikan daftar produk yang perlu di-restock.';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'limit' => [
                    'type'        => 'integer',
                    'description' => 'Jumlah maksimum hasil (default 20)',
                ],
            ],
        ];
    }

    public function requiredRole(): string
    {
        return 'admin';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        try {
            $limit   = min((int) ($args['limit'] ?? 20), 50);
            $variants = $this->stockService->getLowStockVariants()->take($limit);

            if ($variants->isEmpty()) {
                return ToolResult::ok(
                    ['critical_items' => [], 'count' => 0],
                    '',
                    'Tidak ada produk dengan stok kritis saat ini.'
                );
            }

            $items = $variants->map(fn ($v) => [
                'variant_id'         => $v->id,
                'variant_name'       => $v->name,
                'product_id'         => $v->product?->id,
                'product_name'       => $v->product?->name ?? 'Unknown',
                'current_stock'      => (int) $v->stock,
                'min_stock_threshold'=> (int) $v->min_stock_threshold,
                'deficit'            => max(0, (int) $v->min_stock_threshold - (int) $v->stock),
                'sku'                => $v->sku ?? '',
            ])->values()->all();

            return ToolResult::ok(
                ['critical_items' => $items, 'count' => count($items)],
                'restock-draft-card',
                "Ditemukan " . count($items) . " varian dengan stok kritis."
            );

        } catch (\Throwable $e) {
            return ToolResult::error('Gagal memindai stok: ' . $e->getMessage());
        }
    }
}
