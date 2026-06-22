<?php

namespace App\Services\AI\Tools;

use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use App\Services\PrintService;

/**
 * UC2 — Calculate the total cost of a print job.
 *
 * Delegates to PrintService::calculatePrice() which is the canonical
 * price calculation used by the existing print service checkout flow.
 */
class CalculatePrintCostTool implements ToolHandler
{
    public function __construct(
        private readonly PrintService $printService,
    ) {}

    public function name(): string
    {
        return 'calculate_print_cost';
    }

    public function description(): string
    {
        return 'Hitung total biaya cetak berdasarkan varian produk, jumlah halaman, dan jumlah rangkap. Gunakan setelah resolve_print_variant dan setelah file diunggah.';
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
                    'description' => 'Total halaman dokumen yang akan dicetak',
                ],
                'quantity' => [
                    'type'        => 'integer',
                    'description' => 'Jumlah rangkap/eksemplar (default 1)',
                ],
            ],
            'required' => ['variant_id', 'total_pages'],
        ];
    }

    public function requiredRole(): string
    {
        return 'public';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        $variantId  = (int) ($args['variant_id'] ?? 0);
        $totalPages = (int) ($args['total_pages'] ?? 0);
        $quantity   = max(1, (int) ($args['quantity'] ?? 1));

        if (! $variantId || ! $totalPages) {
            return ToolResult::error('variant_id dan total_pages wajib diisi.');
        }

        try {
            $calc = $this->printService->calculatePrice($variantId, $totalPages, $quantity);

            $totalPrice = (float) $calc['total_price'];
            $unitPrice  = (float) $calc['unit_price'];

            return ToolResult::ok(
                [
                    'variant_id'        => $variantId,
                    'variant_name'      => $calc['variant']->name ?? '',
                    'total_pages'       => $totalPages,
                    'quantity'          => $quantity,
                    'price_per_page'    => $unitPrice,
                    'price_per_page_label' => 'Rp ' . number_format($unitPrice, 0, ',', '.'),
                    'total_price'       => $totalPrice,
                    'total_price_label' => 'Rp ' . number_format($totalPrice, 0, ',', '.'),
                    'breakdown'         => "Rp {$unitPrice} × {$totalPages} halaman × {$quantity} rangkap",
                ],
                'print-summary-card',
                "Total biaya cetak: Rp " . number_format($totalPrice, 0, ',', '.') . " ({$totalPages} halaman × {$quantity} rangkap)."
            );

        } catch (\Throwable $e) {
            return ToolResult::error('Gagal menghitung biaya cetak: ' . $e->getMessage());
        }
    }
}
