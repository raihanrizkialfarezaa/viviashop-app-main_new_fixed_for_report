<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductInventory;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;
use Illuminate\Support\Facades\Schema;

$failures = [];

$simpleSku = 'ATK-PULPEN-GEL-JOYKO-001';
$configurableSku = 'ATK-KERTAS-HVS-MULTI-001';
$legacyParentSku = 'ATK-MAP-PLASTIK-BANTEX-001';
$smartPrintSimpleSku = 'ATK-PRINT-SMART-A4-001';
$legacyChildSkus = [
    'ATK-MAP-PLASTIK-BANTEX-MERAH-A4',
    'ATK-MAP-PLASTIK-BANTEX-MERAH-F4',
    'ATK-MAP-PLASTIK-BANTEX-BIRU-A4',
    'ATK-MAP-PLASTIK-BANTEX-BIRU-F4',
];

$simpleProduct = Product::where('sku', $simpleSku)->first();
if (! $simpleProduct) {
    $failures[] = "Simple product not found: {$simpleSku}";
}

$configurableProduct = Product::where('sku', $configurableSku)->first();
if (! $configurableProduct) {
    $failures[] = "Configurable product not found: {$configurableSku}";
}

$legacyParent = Product::where('sku', $legacyParentSku)->first();
if (! $legacyParent) {
    $failures[] = "Legacy parent product not found: {$legacyParentSku}";
}

if ($simpleProduct) {
    $inventory = ProductInventory::where('product_id', $simpleProduct->id)->first();
    if (! $inventory || (int) $inventory->qty !== 84) {
        $failures[] = 'Simple product inventory quantity is not 84.';
    }
}

if ($configurableProduct) {
    $variants = ProductVariant::where('product_id', $configurableProduct->id)->get();
    if ($variants->count() !== 4) {
        $failures[] = 'Configurable product does not have 4 variants.';
    }

    $variantAttributeCount = VariantAttribute::whereIn('variant_id', $variants->pluck('id'))->count();
    if ($variantAttributeCount !== 12) {
        $failures[] = 'Configurable product does not have 12 variant attributes.';
    }
}

if ($legacyParent) {
    $children = Product::where('parent_id', $legacyParent->id)->get();
    if ($children->count() !== 4) {
        $failures[] = 'Legacy configurable product does not have 4 child products.';
    }

    $legacyAttributeValues = ProductAttributeValue::where('parent_product_id', $legacyParent->id)->count();
    if ($legacyAttributeValues !== 8) {
        $failures[] = 'Legacy configurable product does not have 8 attribute values.';
    }
}

foreach ($legacyChildSkus as $sku) {
    if (! Product::where('sku', $sku)->exists()) {
        $failures[] = "Legacy child product not found: {$sku}";
    }
}

if (Schema::hasColumn('products', 'is_print_service')) {
    $printServiceCount = Product::where('is_print_service', true)->count();
    if ($printServiceCount < 1) {
        $failures[] = 'No print service product found after seeding.';
    }
}

if (Schema::hasColumn('products', 'is_smart_print_enabled')) {
    $smartPrintCount = Product::where('is_smart_print_enabled', true)->count();
    if ($smartPrintCount < 1) {
        $failures[] = 'No smart print enabled product found after seeding.';
    }
}

if (Schema::hasColumn('products', 'is_print_service') && Schema::hasColumn('products', 'is_smart_print_enabled')) {
    $smartSimple = Product::where('sku', $smartPrintSimpleSku)->first();
    if (! $smartSimple) {
        $failures[] = "Smart print simple product not found: {$smartPrintSimpleSku}";
    } else {
        if (! $smartSimple->is_print_service || ! $smartSimple->is_smart_print_enabled) {
            $failures[] = 'Smart print simple product flags are not set.';
        }

        $smartVariants = ProductVariant::where('product_id', $smartSimple->id)->get();
        if ($smartVariants->count() !== 2) {
            $failures[] = 'Smart print simple product does not have 2 variants.';
        }

        $smartAttrCount = VariantAttribute::whereIn('variant_id', $smartVariants->pluck('id'))->count();
        if ($smartAttrCount !== 4) {
            $failures[] = 'Smart print simple variants do not have 4 attributes.';
        }
    }
}

if ($failures) {
    foreach ($failures as $failure) {
        echo '[FAIL] ' . $failure . PHP_EOL;
    }

    exit(1);
}

echo '[OK] Product seed validated successfully.' . PHP_EOL;
echo '  Simple product: ' . ($simpleProduct?->name ?? '-') . PHP_EOL;
echo '  Configurable product variants: ' . ($configurableProduct ? ProductVariant::where('product_id', $configurableProduct->id)->count() : 0) . PHP_EOL;
echo '  Legacy child products: ' . ($legacyParent ? Product::where('parent_id', $legacyParent->id)->count() : 0) . PHP_EOL;
