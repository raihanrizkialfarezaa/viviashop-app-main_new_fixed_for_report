<?php
/**
 * scripts/stress_test_chatbot.php
 * Stress test and end-to-end debugger for all 12 AI tools.
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\AI\ToolRegistry;
use App\Services\AI\ToolDispatcher;
use App\Services\AI\Context;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Initialize a session for Cart / Upload testing
Session::start();

$registry   = app(ToolRegistry::class);
$dispatcher = app(ToolDispatcher::class);

echo "=========================================================\n";
echo "       VIVIASHOP AI CHATBOT STRESS TEST & DEBUGGER       \n";
echo "=========================================================\n\n";

// 1. Verify Gemini Connection
echo "Step 1: Checking Gemini API connectivity...\n";
try {
    $client = app(App\Services\AI\GeminiClient::class);
    // Simple prompt to test connection
    $res = $client->generateContent([
        ['role' => 'user', 'parts' => [['text' => 'Ping']]]
    ]);
    $text = $client->extractText($res);
    echo "✅ Gemini connection OK. Reply: \"" . trim($text) . "\"\n";
} catch (\Throwable $e) {
    echo "⚠️  Gemini API warning: " . $e->getMessage() . "\n";
    echo "   (This is fine if GEMINI_API_KEY is not set or in offline sandbox)\n";
}

echo "\n---------------------------------------------------------\n";
echo "Step 2: Testing Public Tools\n";
echo "---------------------------------------------------------\n";

// Setup public context
$reqPublic = new Request();
$publicCtx = Context::fromRequest($reqPublic);

// Tool 1: search_products_via_sql
testTool($dispatcher, 'search_products_via_sql', [
    'query' => 'HVS A4'
], $publicCtx);

// Tool 2: resolve_print_variant (now public!)
testTool($dispatcher, 'resolve_print_variant', [
    'paper_type_name' => 'hvs',
    'print_type_name' => 'bw',
    'paper_size'      => 'A4'
], $publicCtx);

// Tool 3: calculate_print_cost (now public!)
$printVariant = ProductVariant::whereHas('product', function($q) {
    $q->where('is_print_service', true);
})->first();

$printVariantId = $printVariant ? $printVariant->id : 1;
testTool($dispatcher, 'calculate_print_cost', [
    'variant_id'  => $printVariantId,
    'total_pages' => 20,
    'quantity'    => 2
], $publicCtx);


echo "\n---------------------------------------------------------\n";
echo "Step 3: Testing Authenticated (Auth) Tools\n";
echo "---------------------------------------------------------\n";

// Find or create a test user
$testUser = User::first();
if (!$testUser) {
    $testUser = User::create([
        'name'     => 'Test User',
        'email'    => 'testuser@viviashop.local',
        'password' => bcrypt('password123')
    ]);
}

$reqAuth = new Request();
$reqAuth->setUserResolver(fn() => $testUser);
$reqAuth->merge(['print_session_token' => 'fake_print_token']);
$authCtx = Context::fromRequest($reqAuth);

// Find a regular product to test AddToCart
$regularProduct = Product::where('is_print_service', false)->first();
$productId = $regularProduct ? $regularProduct->id : 1;

// Tool 4: add_to_cart (simple)
testTool($dispatcher, 'add_to_cart', [
    'product_id' => $productId,
    'confirm'    => true,
    'qty'        => 1
], $authCtx);

// Tool 5: quick_buy_redirect
testTool($dispatcher, 'quick_buy_redirect', [
    'product_id' => $productId,
    'confirm'    => true
], $authCtx);

// Tool 6: create_print_cart_item
testTool($dispatcher, 'create_print_cart_item', [
    'variant_id'           => $printVariantId,
    'total_pages'          => 15,
    'quantity'             => 1,
    'total_price'          => 15000,
    'confirm'              => true
], $authCtx);


echo "\n---------------------------------------------------------\n";
echo "Step 4: Testing Admin Tools\n";
echo "---------------------------------------------------------\n";

// Find or create an admin user
$adminUser = User::where('is_admin', true)->first();
if (!$adminUser) {
    $adminUser = User::create([
        'name'     => 'Test Admin',
        'email'    => 'admin@viviashop.local',
        'password' => bcrypt('password123'),
        'is_admin' => true
    ]);
}

$reqAdmin = new Request();
$reqAdmin->setUserResolver(fn() => $adminUser);
$adminCtx = Context::fromRequest($reqAdmin);

// Tool 7: scan_critical_stock
testTool($dispatcher, 'scan_critical_stock', [
    'threshold' => 10
], $adminCtx);

// Tool 8: suggest_supplier
testTool($dispatcher, 'suggest_supplier', [
    'product_ids' => [$productId]
], $adminCtx);

// Tool 9: create_purchase_draft
$supplier = Supplier::first();
if (!$supplier) {
    $supplier = Supplier::create([
        'nama'    => 'Test Supplier',
        'alamat' => 'Test Address',
        'telepon'   => '08123456789'
    ]);
}
$supplierId = $supplier->id;

testTool($dispatcher, 'create_purchase_draft', [
    'supplier_id' => $supplierId,
    'items'       => [
        ['product_id' => $productId, 'qty' => 50, 'harga_beli' => 15000]
    ],
    'confirm'     => true
], $adminCtx);

// Tool 10: aggregate_business_metrics
testTool($dispatcher, 'aggregate_business_metrics', [
    'metric_type' => 'revenue',
    'start_date'  => date('Y-m-d', strtotime('-30 days')),
    'end_date'    => date('Y-m-d')
], $adminCtx);

// Tool 11: top_employee_performance
testTool($dispatcher, 'top_employee_performance', [
    'start_date' => date('Y-m-01'),
    'end_date'   => date('Y-m-t')
], $adminCtx);

// Tool 12: export_report
testTool($dispatcher, 'export_report', [
    'report_type' => 'laporan', // 'laporan' (financial) or 'inventory'
    'format'      => 'excel'
], $adminCtx);


echo "\n=========================================================\n";
echo "                  STRESS TEST COMPLETED                  \n";
echo "=========================================================\n";

/**
 * Run a single tool dispatcher test.
 */
function testTool(ToolDispatcher $dispatcher, string $name, array $args, Context $ctx)
{
    echo "Running tool [{$name}]... ";
    try {
        $res = $dispatcher->dispatch($name, $args, $ctx);
        if ($res->success) {
            echo "✅ SUCCESS. Msg: \"" . cutStr($res->message, 80) . "\"\n";
        } else {
            echo "❌ FAILED (handled). Error: \"{$res->message}\"\n";
        }
    } catch (\Throwable $e) {
        echo "💥 EXCEPTION (unhandled error): " . $e->getMessage() . "\n";
        echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    }
}

function cutStr(string $str, int $len): string
{
    if (strlen($str) > $len) {
        return substr($str, 0, $len - 3) . '...';
    }
    return $str;
}
