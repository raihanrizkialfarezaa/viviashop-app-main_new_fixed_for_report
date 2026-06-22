<?php

namespace App\Services\AI\Tools;

use App\Models\PembelianDetail;
use App\Models\Supplier;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use Illuminate\Support\Facades\DB;

/**
 * UC3 — Suggest the best supplier for a list of product/variant IDs.
 *
 * Joins historical PembelianDetail records to find the most frequently
 * used supplier per product and the average purchase price.
 * Read-only — no writes.
 */
class SuggestSupplierTool implements ToolHandler
{
    public function name(): string
    {
        return 'suggest_supplier';
    }

    public function description(): string
    {
        return 'Sarankan supplier terbaik untuk produk yang perlu di-restock berdasarkan riwayat pembelian historis.';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'product_ids' => [
                    'type'        => 'array',
                    'items'       => ['type' => 'integer'],
                    'description' => 'Daftar ID produk yang perlu di-restock',
                ],
                'variant_ids' => [
                    'type'        => 'array',
                    'items'       => ['type' => 'integer'],
                    'description' => 'Daftar ID varian produk (opsional, untuk produk configurable)',
                ],
            ],
            'required' => ['product_ids'],
        ];
    }

    public function requiredRole(): string
    {
        return 'admin';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        $productIds = array_map('intval', (array) ($args['product_ids'] ?? []));
        $variantIds = array_map('intval', (array) ($args['variant_ids'] ?? []));

        if (empty($productIds)) {
            return ToolResult::error('product_ids wajib diisi.');
        }

        try {
            // Find most frequent supplier per product from purchase history
            $suggestions = [];

            foreach ($productIds as $productId) {
                $query = DB::connection('mysql_readonly')
                    ->table('pembelian_details as pd')
                    ->join('pembelians as p', 'pd.id_pembelian', '=', 'p.id')
                    ->join('suppliers as s', 'p.id_supplier', '=', 's.id')
                    ->where('pd.id_produk', $productId)
                    ->whereNotNull('p.waktu') // only completed purchases
                    ->select(
                        's.id as supplier_id',
                        's.nama as supplier_name',
                        's.telepon as supplier_phone',
                        's.alamat as supplier_address',
                        DB::raw('COUNT(*) as purchase_count'),
                        DB::raw('AVG(pd.harga_beli) as avg_harga_beli'),
                        DB::raw('MAX(p.waktu) as last_purchase_date')
                    )
                    ->groupBy('s.id', 's.nama', 's.telepon', 's.alamat')
                    ->orderByDesc('purchase_count')
                    ->first();

                if ($query) {
                    $suggestions[] = [
                        'product_id'        => $productId,
                        'supplier_id'       => $query->supplier_id,
                        'supplier_name'     => $query->supplier_name,
                        'supplier_phone'    => $query->supplier_phone ?? '',
                        'supplier_address'  => $query->supplier_address ?? '',
                        'purchase_count'    => (int) $query->purchase_count,
                        'avg_harga_beli'    => round((float) $query->avg_harga_beli, 0),
                        'avg_harga_beli_label' => 'Rp ' . number_format((float) $query->avg_harga_beli, 0, ',', '.'),
                        'last_purchase_date'=> $query->last_purchase_date,
                    ];
                } else {
                    // No history — return all active suppliers as fallback
                    $fallback = Supplier::orderBy('nama')->first();
                    $suggestions[] = [
                        'product_id'     => $productId,
                        'supplier_id'    => $fallback?->id,
                        'supplier_name'  => $fallback?->nama ?? 'Belum ada supplier',
                        'supplier_phone' => $fallback?->telepon ?? '',
                        'purchase_count' => 0,
                        'avg_harga_beli' => 0,
                        'avg_harga_beli_label' => '-',
                        'note'           => 'Tidak ada riwayat pembelian. Supplier default disarankan.',
                    ];
                }
            }

            return ToolResult::ok(
                ['suggestions' => $suggestions, 'count' => count($suggestions)],
                '',
                "Saran supplier untuk " . count($suggestions) . " produk berhasil ditemukan."
            );

        } catch (\Throwable $e) {
            return ToolResult::error('Gagal mencari saran supplier: ' . $e->getMessage());
        }
    }
}
