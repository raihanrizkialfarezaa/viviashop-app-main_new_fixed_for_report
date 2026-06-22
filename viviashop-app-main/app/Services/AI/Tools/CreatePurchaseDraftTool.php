<?php

namespace App\Services\AI\Tools;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use Illuminate\Support\Facades\DB;

/**
 * UC3 — Create a purchase draft (Pembelian with status pending).
 *
 * Mirrors exactly what PembelianController@create + @store do:
 *  - Creates a Pembelian row with waktu=null (pending status)
 *  - Creates PembelianDetail rows for each item
 *  - Does NOT call StockService::processPurchaseStockUpdate()
 *    (stock only moves when admin manually confirms via existing controller)
 *
 * Requires confirm:true before writing.
 */
class CreatePurchaseDraftTool implements ToolHandler
{
    public function name(): string
    {
        return 'create_purchase_draft';
    }

    public function description(): string
    {
        return 'Buat draf pembelian (restock) baru dengan status pending untuk diverifikasi admin. Wajib konfirmasi pengguna (confirm: true). Stok TIDAK berubah sampai admin mengkonfirmasi secara manual.';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'supplier_id' => [
                    'type'        => 'integer',
                    'description' => 'ID supplier tujuan pembelian',
                ],
                'items' => [
                    'type'        => 'array',
                    'description' => 'Daftar item yang akan dibeli',
                    'items'       => [
                        'type'       => 'object',
                        'properties' => [
                            'product_id'  => ['type' => 'integer', 'description' => 'ID produk'],
                            'variant_id'  => ['type' => 'integer', 'description' => 'ID varian (opsional)'],
                            'jumlah'      => ['type' => 'integer', 'description' => 'Jumlah yang akan dibeli'],
                            'harga_beli'  => ['type' => 'number', 'description' => 'Harga beli per unit (Rupiah)'],
                        ],
                        'required' => ['product_id', 'jumlah', 'harga_beli'],
                    ],
                ],
                'notes' => [
                    'type'        => 'string',
                    'description' => 'Catatan tambahan untuk draf pembelian',
                ],
                'confirm' => [
                    'type'        => 'boolean',
                    'description' => 'Harus true agar draf dibuat.',
                ],
            ],
            'required' => ['supplier_id', 'items', 'confirm'],
        ];
    }

    public function requiredRole(): string
    {
        return 'admin';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        if (empty($args['confirm']) || $args['confirm'] !== true) {
            return ToolResult::error('Aksi dibatalkan. Konfirmasi admin diperlukan (confirm: true).');
        }

        $supplierId = (int) ($args['supplier_id'] ?? 0);
        $items      = (array) ($args['items'] ?? []);
        $notes      = strip_tags((string) ($args['notes'] ?? ''));

        if (! $supplierId || empty($items)) {
            return ToolResult::error('supplier_id dan items wajib diisi.');
        }

        try {
            return DB::transaction(function () use ($supplierId, $items, $notes, $ctx) {
                // Validate all products/variants exist before creating anything
                $validatedItems = [];
                $totalHarga     = 0;
                $totalItem      = 0;

                foreach ($items as $item) {
                    $productId = (int) ($item['product_id'] ?? 0);
                    $variantId = isset($item['variant_id']) ? (int) $item['variant_id'] : null;
                    $jumlah    = max(1, (int) ($item['jumlah'] ?? 1));
                    $hargaBeli = (int) ($item['harga_beli'] ?? 0);

                    if (! $productId || ! $hargaBeli) {
                        throw new \InvalidArgumentException("Item tidak valid: product_id dan harga_beli wajib diisi.");
                    }

                    $product = Product::find($productId);
                    if (! $product) {
                        throw new \InvalidArgumentException("Produk ID {$productId} tidak ditemukan.");
                    }

                    if ($variantId) {
                        $variant = ProductVariant::where('id', $variantId)
                            ->where('product_id', $productId)
                            ->first();
                        if (! $variant) {
                            throw new \InvalidArgumentException("Varian ID {$variantId} tidak ditemukan untuk produk {$productId}.");
                        }
                    }

                    $subtotal        = $hargaBeli * $jumlah;
                    $totalHarga     += $subtotal;
                    $totalItem      += $jumlah;

                    $validatedItems[] = [
                        'id_produk'  => $productId,
                        'variant_id' => $variantId,
                        'jumlah'     => $jumlah,
                        'harga_beli' => $hargaBeli,
                        'subtotal'   => $subtotal,
                        'name'       => $product->name,
                    ];
                }

                // Create Pembelian draft — mirrors PembelianController@create
                $pembelian = Pembelian::create([
                    'id_supplier' => $supplierId,
                    'total_item'  => $totalItem,
                    'total_harga' => $totalHarga,
                    'diskon'      => 0,
                    'bayar'       => 0,
                    'waktu'       => null,   // null = pending (same as manual create)
                    'status'      => Pembelian::STATUS_PENDING,
                    'notes'       => $notes ?: "Draf otomatis dari AI Agent - " . now()->format('d/m/Y H:i'),
                    'payment_method' => 'pending',
                ]);

                // Create PembelianDetail rows — mirrors PembelianDetailController@store
                foreach ($validatedItems as $item) {
                    PembelianDetail::create([
                        'id_pembelian' => $pembelian->id,
                        'id_produk'    => $item['id_produk'],
                        'variant_id'   => $item['variant_id'],
                        'jumlah'       => $item['jumlah'],
                        'harga_beli'   => $item['harga_beli'],
                        'subtotal'     => $item['subtotal'],
                    ]);
                }

                $itemSummary = collect($validatedItems)->map(
                    fn ($i) => "{$i['name']} × {$i['jumlah']} @ Rp " . number_format($i['harga_beli'], 0, ',', '.')
                )->implode(', ');

                return ToolResult::ok(
                    [
                        'pembelian_id'   => $pembelian->id,
                        'supplier_id'    => $supplierId,
                        'total_item'     => $totalItem,
                        'total_harga'    => $totalHarga,
                        'total_harga_label' => 'Rp ' . number_format($totalHarga, 0, ',', '.'),
                        'status'         => 'pending',
                        'items_count'    => count($validatedItems),
                        'review_url'     => url('/admin/pembelian/' . $pembelian->id),
                        'note'           => 'Stok belum berubah. Admin harus mengkonfirmasi di halaman pembelian.',
                    ],
                    'restock-draft-card',
                    "Draf pembelian #{$pembelian->id} berhasil dibuat (status: pending). Total: Rp " . number_format($totalHarga, 0, ',', '.') . ". Silakan verifikasi di /admin/pembelian/{$pembelian->id}."
                );
            });

        } catch (\InvalidArgumentException $e) {
            return ToolResult::error($e->getMessage());
        } catch (\Throwable $e) {
            return ToolResult::error('Gagal membuat draf pembelian: ' . $e->getMessage());
        }
    }
}
