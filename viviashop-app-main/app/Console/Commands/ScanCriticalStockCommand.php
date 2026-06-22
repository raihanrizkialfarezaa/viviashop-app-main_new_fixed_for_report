<?php

namespace App\Console\Commands;

use App\Services\AI\Context;
use App\Services\AI\Tools\ScanCriticalStockTool;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Scheduled AI stock health check.
 *
 * Scans for critical stock and logs a summary.
 * Does NOT auto-create purchase drafts — that requires admin confirmation
 * via the admin AI assistant chat.
 *
 * Registered in Console\Kernel:
 *   $schedule->command('ai:scan-critical-stock --notify')->dailyAt('08:00');
 */
class ScanCriticalStockCommand extends Command
{
    protected $signature   = 'ai:scan-critical-stock {--notify : Write results to application log}';
    protected $description = 'Scan for product variants with critical stock levels and display a summary.';

    public function __construct(
        private readonly ScanCriticalStockTool $scanTool,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Scanning critical stock levels...');

        $ctx = new Context(
            user:               null,
            printSessionToken:  null,
            cartInstance:       'default',
            requestId:          uniqid('cli_', true),
            isAdmin:            true,
            request:            request(),
        );

        $result = $this->scanTool->execute(['limit' => 50], $ctx);

        if (! $result->success) {
            $this->error('Scan failed: ' . $result->message);
            return self::FAILURE;
        }

        $items = $result->data['critical_items'] ?? [];
        $count = $result->data['count'] ?? 0;

        if ($count === 0) {
            $this->info('✅ No critical stock items found.');
            return self::SUCCESS;
        }

        $this->warn("⚠️  Found {$count} critical stock item(s):");

        $headers = ['Variant', 'Product', 'Stock', 'Min Threshold', 'Deficit'];
        $rows    = array_map(fn ($i) => [
            $i['variant_name'],
            $i['product_name'],
            $i['current_stock'],
            $i['min_stock_threshold'],
            $i['deficit'],
        ], $items);

        $this->table($headers, $rows);

        if ($this->option('notify')) {
            Log::warning('AI Stock Scan: Critical stock detected', [
                'count' => $count,
                'items' => array_column($items, 'variant_name'),
            ]);
            $this->info('Results written to application log.');
        }

        $this->info('Review at: ' . url('/admin/pembelian'));
        $this->info('Use the admin AI assistant to create purchase drafts.');

        return self::SUCCESS;
    }
}
