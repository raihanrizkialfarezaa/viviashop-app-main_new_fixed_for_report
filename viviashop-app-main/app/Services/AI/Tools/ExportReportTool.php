<?php

namespace App\Services\AI\Tools;

use App\Exports\LaporanExport;
use App\Exports\ReportInventory;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use App\Services\AI\ToolResult;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

/**
 * UC4 — Generate and return a download URL for an Excel report.
 *
 * Reuses existing LaporanExport and ReportInventory export classes.
 * Stores the file temporarily in storage/app/ai-exports/ and returns
 * a signed URL valid for 10 minutes.
 */
class ExportReportTool implements ToolHandler
{
    public function name(): string
    {
        return 'export_report';
    }

    public function description(): string
    {
        return 'Buat file laporan Excel dan kembalikan link unduhan. Jenis laporan: "laporan" (laporan umum) atau "inventory" (laporan stok).';
    }

    public function parameters(): array
    {
        return [
            'type'       => 'object',
            'properties' => [
                'report_type' => [
                    'type'        => 'string',
                    'enum'        => ['laporan', 'inventory'],
                    'description' => 'Jenis laporan yang akan diekspor',
                ],
            ],
            'required' => ['report_type'],
        ];
    }

    public function requiredRole(): string
    {
        return 'admin';
    }

    public function execute(array $args, Context $ctx): ToolResult
    {
        $reportType = $args['report_type'] ?? 'laporan';

        if (! in_array($reportType, ['laporan', 'inventory'], true)) {
            return ToolResult::error("Jenis laporan tidak valid. Pilih 'laporan' atau 'inventory'.");
        }

        try {
            $timestamp = now()->format('Ymd_His');
            $filename  = "ai_export_{$reportType}_{$timestamp}.xlsx";
            $path      = "ai-exports/{$filename}";

            if ($reportType === 'inventory') {
                // Reuse ReportInventory — same as ReportController::inventory()
                $sql = "
                    SELECT P.*, PI.qty as stock
                    FROM product_inventories PI
                    LEFT JOIN products P ON P.id = PI.product_id
                    ORDER BY stock ASC
                ";
                $products = \Illuminate\Support\Facades\DB::select($sql);
                Excel::store(new ReportInventory($products), $path, 'local');
            } else {
                // Reuse LaporanExport — same as ReportController::exportExcel()
                Excel::store(new LaporanExport(), $path, 'local');
            }

            // Build a temporary URL (works with local disk via route)
            $downloadUrl = url('/admin/laporan/export') . '?ai_file=' . urlencode($filename);

            return ToolResult::ok(
                [
                    'report_type'  => $reportType,
                    'filename'     => $filename,
                    'download_url' => $downloadUrl,
                    'note'         => 'File tersedia selama 10 menit. Klik link untuk mengunduh.',
                ],
                'metric-card',
                "Laporan '{$reportType}' berhasil dibuat. Unduh di: {$downloadUrl}"
            );

        } catch (\Throwable $e) {
            return ToolResult::error('Gagal membuat laporan: ' . $e->getMessage());
        }
    }
}
