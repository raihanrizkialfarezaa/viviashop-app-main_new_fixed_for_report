<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\StockMovement;
use App\Models\RekamanStok;
use Illuminate\Support\Facades\DB;

class TestStockOpnameCommand extends Command
{
    protected $signature = 'test:stock-opname {--adjust= : Random adjustment range (default: simulate)}';
    protected $description = 'Test stock opname: compare system vs physical stock';

    public function handle()
    {
        $this->info('');
        $this->info('============================================');
        $this->info('       STOCK OPNAME TESTER');
        $this->info('============================================');
        $this->info('');

        // Step 1: Load products
        $this->info('1. Memuat data produk...');
        $products = Product::with(['productInventory', 'productVariants'])
            ->orderBy('name')
            ->get();

        if ($products->isEmpty()) {
            $this->error('   Tidak ada produk ditemukan.');
            return Command::FAILURE;
        }

        $this->info('   ✅ ' . $products->count() . ' produk ditemukan');
        $this->info('');

        // Step 2: Show current system stock
        $this->info('2. Stok sistem saat ini:');
        $this->info('   ' . str_repeat('─', 80));
        $this->info('   ' . str_pad('Product', 40) . str_pad('SKU', 15) . str_pad('Type', 12) . str_pad('Stock', 10));
        $this->info('   ' . str_repeat('─', 80));

        $products->take(10)->each(function ($product) {
            $stock = $this->getSystemStock($product);
            $type = $product->type === 'configurable' ? 'Configurable' : 'Simple';
            $this->info('   ' . str_pad(substr($product->name, 0, 38), 40)
                . str_pad($product->sku, 15)
                . str_pad($type, 12)
                . str_pad(number_format($stock, 0, ',', '.'), 10));
        });

        if ($products->count() > 10) {
            $this->info('   ... dan ' . ($products->count() - 10) . ' produk lainnya');
        }
        $this->info('');

        // Step 3: Simulate physical stock (with random adjustments)
        $this->info('3. Simulasi stok fisik...');

        $adjustRange = $this->option('adjust') ? (int) $this->option('adjust') : 5;
        $adjusted = 0;
        $totalDiff = 0;

        DB::beginTransaction();
        try {
            foreach ($products as $product) {
                $oldStock = $this->getSystemStock($product);
                $adjustment = rand(-$adjustRange, $adjustRange);
                $newStock = max(0, $oldStock + $adjustment);
                $difference = $newStock - $oldStock;

                if ($difference === 0) continue;

                $adjusted++;

                if ($product->type === 'configurable' && $product->productVariants->count() > 0) {
                    $totalCurrent = $product->productVariants->sum('stock');
                    $ratio = $totalCurrent > 0 ? $newStock / $totalCurrent : 0;
                    $distributed = 0;
                    $variantCount = $product->productVariants->count();

                    foreach ($product->productVariants as $i => $variant) {
                        if ($i === $variantCount - 1) {
                            $variantNewStock = max(0, $newStock - $distributed);
                        } else {
                            $variantNewStock = max(0, (int) round($variant->stock * $ratio));
                        }

                        $variantOldStock = $variant->stock;
                        $variantDiff = $variantNewStock - $variantOldStock;

                        if ($variantDiff !== 0) {
                            $variant->stock = $variantNewStock;
                            $variant->save();

                            StockMovement::create([
                                'variant_id' => $variant->id,
                                'movement_type' => $variantDiff > 0 ? StockMovement::MOVEMENT_IN : StockMovement::MOVEMENT_OUT,
                                'quantity' => abs($variantDiff),
                                'old_stock' => $variantOldStock,
                                'new_stock' => $variantNewStock,
                                'reference_type' => 'stock_opname_test',
                                'reason' => StockMovement::REASON_INVENTORY_CORRECTION,
                                'notes' => "Test stock opname (system: {$oldStock}, physical: {$newStock})",
                            ]);
                        }

                        $distributed += $variantNewStock;
                    }

                    RekamanStok::create([
                        'product_id' => $product->id,
                        'waktu' => now(),
                        'stok_awal' => $oldStock,
                        'stok_sisa' => $newStock,
                    ]);
                } else {
                    $inventory = $product->productInventory;
                    if ($inventory) {
                        $inventory->qty = $newStock;
                        $inventory->save();
                    }

                    RekamanStok::create([
                        'product_id' => $product->id,
                        'waktu' => now(),
                        'stok_awal' => $oldStock,
                        'stok_sisa' => $newStock,
                    ]);
                }

                $totalDiff += $difference;
            }

            DB::rollBack();
            $this->info('   ✅ Simulasi selesai (' . $adjusted . ' produk disesuaikan)');
            $this->info('');

            // Step 4: Results
            $this->info('4. Hasil Simulasi:');
            $this->info('   ┌─────────────────────────────────────┐');
            $this->info('   │              RESULT                  │');
            $this->info('   ├─────────────────────────────────────┤');
            $this->info('   │  Status      : ✅ Success            │');
            $this->info('   │  Products    : ' . str_pad($products->count(), 28, ' ', STR_PAD_LEFT) . ' │');
            $this->info('   │  Adjusted    : ' . str_pad($adjusted, 28, ' ', STR_PAD_LEFT) . ' │');
            $this->info('   │  Total Diff  : ' . str_pad(($totalDiff >= 0 ? '+' : '') . number_format($totalDiff, 0, ',', '.'), 26, ' ', STR_PAD_LEFT) . ' │');
            $this->info('   │  Adjust Range: ' . str_pad('±' . $adjustRange, 28, ' ', STR_PAD_LEFT) . ' │');
            $this->info('   └─────────────────────────────────────┘');
            $this->info('');
            $this->info('   📝 StockMovement records: ' . $adjusted . ' created');
            $this->info('   📝 RekamanStok records: ' . $adjusted . ' created');
            $this->info('');
            $this->info('   ⚠️  (Transaction rolled back - no actual changes)');
            $this->info('   💡 Gunakan UI admin untuk eksekusi real:');
            $this->info('      http://localhost:8000/admin/stock-opname');
            $this->info('');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('   ❌ Gagal: ' . $e->getMessage());
            $this->error('   File: ' . str_replace(base_path(), '', $e->getFile()));
            $this->error('   Line: ' . $e->getLine());
            $this->error('');

            // Show code snippet
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

            return Command::FAILURE;
        }
    }

    private function getSystemStock($product): int
    {
        if ($product->type === 'configurable' && $product->productVariants->count() > 0) {
            return $product->productVariants->sum('stock');
        }
        return $product->productInventory?->qty ?? 0;
    }
}
