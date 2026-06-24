<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Product;

echo "=== RESET HARGA & STOK PRODUK UNTUK TESTING ===\n\n";

// 1. Update all simple products' price to 1
$simpleUpdated = DB::table('products')
    ->where('type', 'simple')
    ->update(['price' => 1]);
echo "✓ Simple products (price = Rp 1): {$simpleUpdated} produk\n";

// 2. Update all product inventories stock to 10,000
$invUpdated = DB::table('product_inventories')
    ->update(['qty' => 10000]);
echo "✓ Product inventories (stock = 10.000): {$invUpdated} record\n";

// 3. Update all product variants' price to 1 and stock to 10,000
$varUpdated = DB::table('product_variants')
    ->update([
        'price' => 1,
        'stock' => 10000,
    ]);
echo "✓ Product variants (price = Rp 1, stock = 10.000): {$varUpdated} variant\n";

// 4. Create missing product_inventories for products that don't have one
$productsWithoutInventory = DB::table('products')
    ->where('type', 'simple')
    ->whereNotExists(function ($query) {
        $query->select(DB::raw(1))
            ->from('product_inventories')
            ->whereColumn('product_inventories.product_id', 'products.id');
    })
    ->pluck('id');

$newInventories = 0;
foreach ($productsWithoutInventory as $pid) {
    DB::table('product_inventories')->insert([
        'product_id' => $pid,
        'qty' => 10000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $newInventories++;
}
if ($newInventories > 0) {
    echo "✓ New inventory records created: {$newInventories}\n";
}

// 5. Sync base_price and total_stock for configurable products
$configurableProducts = Product::where('type', 'configurable')->get();
$configurableCount = 0;
foreach ($configurableProducts as $product) {
    $product->updateBasePrice();
    $configurableCount++;
}
echo "✓ Configurable products synced (base_price & total_stock): {$configurableCount} produk\n";

// 6. Summary
$totalProducts = DB::table('products')->count();
$totalVariants = DB::table('product_variants')->count();
$configurableProductCount = DB::table('products')->where('type', 'configurable')->count();
$simpleProductCount = DB::table('products')->where('type', 'simple')->count();

echo "\n=== SUMMARY ===\n";
echo "Total produk di database: {$totalProducts}\n";
echo "  - Simple: {$simpleProductCount}\n";
echo "  - Configurable: {$configurableProductCount}\n";
echo "Total variants: {$totalVariants}\n";
echo "\n✅ SEMUA PRODUK BERHASIL DI-RESET!\n";
echo "   Harga: Rp 1 (semua produk & variant)\n";
echo "   Stok: 10.000 (semua produk & variant)\n";
