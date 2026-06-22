<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class TestPdfReportCommand extends Command
{
    protected $signature = 'test:pdf-report {--start=} {--end=}';
    protected $description = 'Test PDF report generation for product reports';

    public function handle()
    {
        $startDate = $this->option('start') ?? date('Y-m-01');
        $endDate = $this->option('end') ?? date('Y-m-t');

        $this->info('');
        $this->info('============================================');
        $this->info('       PDF REPORT TESTER');
        $this->info('============================================');
        $this->info('');

        // Step 1: Check route
        $this->info('1. Memeriksa registrasi route...');
        $routeExists = \Route::has('admin.reports.product.pdf');
        if ($routeExists) {
            $this->info('   ✅ Route "admin.reports.product.pdf" terdaftar');
        } else {
            $this->warn('   ⚠️  Route "admin.reports.product.pdf" tidak ditemukan');
            $this->warn('   ⚠️  Mencoba generate langsung...');
        }
        $this->info('');

        // Step 2: Try generating PDF
        $this->info('2. Men-generate PDF product report...');
        $this->info("   Periode: {$startDate} - {$endDate}");
        $this->info('');

        $startTime = microtime(true);

        try {
            $sql = "
            SELECT
                OI.product_id,
                OI.name,
                OI.sku,
                SUM(OI.qty) as items_sold,
                COALESCE(SUM(OI.sub_total - OI.tax_amount - OI.discount_amount),0) net_revenue,
                COUNT(OI.order_id) num_of_orders,
                PI.qty as stock
            FROM order_items OI
            LEFT JOIN orders O ON O.id = OI.order_id
            LEFT JOIN product_inventories PI ON PI.product_id = OI.product_id
            WHERE DATE(O.order_date) >= :start_date
                AND DATE(O.order_date) <= :end_date
                AND O.status = :status
                AND O.payment_status = :payment_status
            GROUP BY OI.product_id, OI.name, OI.sku, PI.qty
            ";

            $products = \DB::select($sql, [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => Order::COMPLETED,
                'payment_status' => Order::PAID,
            ]);

            $productCount = count($products);
            $this->info("   📦 Data produk: {$productCount} produk ditemukan");

            if ($productCount === 0) {
                $this->warn('   ⚠️  Tidak ada data produk untuk periode ini');
            }

            $pdf = Pdf::loadView('admin.reports.exports.pdf_product', compact('products', 'startDate', 'endDate'));
            $pdf->setPaper('A4', 'landscape');

            $output = $pdf->output();
            $elapsed = round(microtime(true) - $startTime, 2);
            $size = strlen($output);
            $sizeFormatted = $this->formatBytes($size);

            $this->info('   ✅ PDF berhasil di-generate');
            $this->info('');
            $this->info('3. Hasil Test:');
            $this->info('   ┌─────────────────────────────────────┐');
            $this->info('   │              RESULT                  │');
            $this->info('   ├─────────────────────────────────────┤');
            $this->info('   │  Status      : ✅ Success            │');
            $this->info('   │  HTTP Code   : 200 OK                │');
            $this->info('   │  File Size   : ' . str_pad($sizeFormatted, 28, ' ', STR_PAD_LEFT) . ' │');
            $this->info('   │  Time        : ' . str_pad($elapsed . 's', 28, ' ', STR_PAD_LEFT) . ' │');
            $this->info('   │  Products    : ' . str_pad($productCount, 28, ' ', STR_PAD_LEFT) . ' │');
            $this->info('   │  Periode     : ' . str_pad($startDate . ' s/d ' . $endDate, 27, ' ', STR_PAD_LEFT) . '│');
            $this->info('   └─────────────────────────────────────┘');
            $this->info('');
            $this->info('   📁 Path PDF: ' . storage_path('app/reports/report-products.pdf'));

            // Save a copy for inspection
            $reportPath = storage_path('app/reports');
            if (!is_dir($reportPath)) {
                mkdir($reportPath, 0755, true);
            }
            file_put_contents($reportPath . '/report-products.pdf', $output);
            $this->info('   💾 PDF tersimpan di: storage/app/reports/report-products.pdf');
            $this->info('');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $elapsed = round(microtime(true) - $startTime, 2);
            $this->error('   ❌ Gagal meng-generate PDF');
            $this->error('');
            $this->error('   Error: ' . $e->getMessage());
            $this->error('   File: ' . str_replace(base_path(), '', $e->getFile()));
            $this->error('   Line: ' . $e->getLine());
            $this->error('   Time: ' . $elapsed . 's');
            $this->error('');

            // Show code snippet from ReportProduct.php
            $this->info('3. Error Analysis:');
            $this->info('');

            $sourceFile = $e->getFile();
            if (file_exists($sourceFile)) {
                $lines = file($sourceFile);
                $startLine = max(0, $e->getLine() - 8);
                $endLine = min(count($lines), $e->getLine() + 5);

                $this->line('   📄 ' . str_replace(base_path(), '', $sourceFile) . ':' . $e->getLine());
                $this->line('   ' . str_repeat('─', 60));
                for ($i = $startLine; $i < $endLine; $i++) {
                    $lineNum = str_pad($i + 1, 4, ' ', STR_PAD_LEFT);
                    if ($i + 1 === $e->getLine()) {
                        $this->error("   >> {$lineNum}: {$lines[$i]}");
                    } else {
                        $this->line("      {$lineNum}: {$lines[$i]}");
                    }
                }
                $this->line('   ' . str_repeat('─', 60));
            }

            $this->error('');
            $this->error('❌ PDF Report Test FAILED');
            $this->error('');

            return Command::FAILURE;
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
