<?php

namespace App\Services\AI\Tools;

use App\Models\PaperType;
use App\Models\PrintType;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use App\Services\SmartPrintVariantService;

/**
 * UC2 — Resolve the correct ProductVariant for a print job.
 *
 * Matches user-supplied paper type name (e.g. "buffalo hijau") and
 * binding/print type (e.g. "softcover") against PaperType and PrintType
 * master data, then finds the matching ProductVariant on a print-service product.
 */
class ResolvePrintVariantTool implements ToolHandler
{
    public function __construct(
        private readonly SmartPrintVariantService $smartPrintService,
    ) {}

    public function name(): string
    {
        return 'resolve_print_variant';
    }

    public function description(): string
    {
        return 'Temukan varian produk cetak yang sesuai berdasarkan jenis kertas, jenis jilid/cetak, dan ukuran kertas. Gunakan sebelum menghitung biaya cetak.';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'paper_type_name' => [
                    'type'        => 'string',
                    'description' => 'Nama jenis kertas (contoh: "HVS", "Buffalo Hijau", "Art Paper")',
                ],
                'print_type_name' => [
                    'type'        => 'string',
                    'description' => 'Jenis cetak/jilid (contoh: "softcover", "hardcover", "bw", "color")',
                ],
                'paper_size' => [
                    'type'        => 'string',
                    'description' => 'Ukuran kertas (contoh: "A4", "A3", "F4"). Default A4.',
                ],
            ],
            'required' => ['paper_type_name'],
        ];
    }

    public function requiredRole(): string
    {
        return 'public';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        $paperTypeName = strtolower(trim($args['paper_type_name'] ?? ''));
        $printTypeName = strtolower(trim($args['print_type_name'] ?? ''));
        $paperSize     = strtoupper(trim($args['paper_size'] ?? 'A4'));

        // 1. Find matching PaperType by fuzzy name match
        $paperType = PaperType::active()
            ->where(function ($q) use ($paperTypeName) {
                $q->where('name', 'like', "%{$paperTypeName}%")
                  ->orWhere('display_name', 'like', "%{$paperTypeName}%");
            })
            ->first();

        // 2. Find matching PrintType if provided
        $printType = null;
        if ($printTypeName) {
            $printType = PrintType::active()
                ->where(function ($q) use ($printTypeName) {
                    $q->where('name', 'like', "%{$printTypeName}%")
                      ->orWhere('display_name', 'like', "%{$printTypeName}%");
                })
                ->first();
        }

        // 3. Find print-service products
        $products = Product::where('is_print_service', true)
            ->where('is_smart_print_enabled', true)
            ->where('status', Product::ACTIVE)
            ->with(['activeVariants.variantAttributes'])
            ->get();

        if ($products->isEmpty()) {
            return ToolResult::error('Tidak ada produk layanan cetak yang tersedia saat ini.');
        }

        // 4. Find best matching variant
        $bestVariant = null;
        $bestProduct = null;

        foreach ($products as $product) {
            foreach ($product->activeVariants as $variant) {
                // Auto-fix missing print fields if needed
                if (empty($variant->paper_size) || empty($variant->print_type)) {
                    $this->smartPrintService->detectAndSetPrintFields($variant);
                    $variant->refresh();
                }

                $variantPaperSize  = strtoupper($variant->paper_size ?? 'A4');
                $variantPrintType  = strtolower($variant->print_type ?? '');

                // Match paper size
                if ($variantPaperSize !== $paperSize) {
                    continue;
                }

                // Match print type if specified
                if ($printTypeName && ! str_contains($variantPrintType, $printTypeName)) {
                    // Try common aliases
                    $isBW    = in_array($printTypeName, ['bw', 'hitam putih', 'black white', 'black & white']);
                    $isColor = in_array($printTypeName, ['color', 'warna', 'colour']);

                    if ($isBW && $variantPrintType !== 'bw') {
                        continue;
                    }
                    if ($isColor && $variantPrintType !== 'color') {
                        continue;
                    }
                }

                $bestVariant = $variant;
                $bestProduct = $product;
                break 2;
            }
        }

        if (! $bestVariant) {
            // Fall back to first available variant
            $bestProduct = $products->first();
            $bestVariant = $bestProduct?->activeVariants->first();
        }

        if (! $bestVariant) {
            return ToolResult::error('Tidak ada varian cetak yang cocok ditemukan.');
        }

        return ToolResult::ok(
            [
                'variant_id'        => $bestVariant->id,
                'variant_name'      => $bestVariant->name,
                'product_id'        => $bestProduct->id,
                'product_name'      => $bestProduct->name,
                'paper_size'        => $bestVariant->paper_size ?? $paperSize,
                'print_type'        => $bestVariant->print_type ?? $printTypeName,
                'price_per_page'    => (float) $bestVariant->price,
                'price_label'       => 'Rp ' . number_format((float) $bestVariant->price, 0, ',', '.') . '/halaman',
                'paper_type_found'  => $paperType?->display_name ?? $paperTypeName,
                'print_type_found'  => $printType?->display_name ?? $printTypeName,
                'price_multiplier'  => (float) ($paperType?->price_multiplier ?? 1.0),
            ],
            '',
            "Varian cetak '{$bestVariant->name}' ditemukan dengan harga Rp " . number_format((float) $bestVariant->price, 0, ',', '.') . '/halaman.'
        );
    }
}
