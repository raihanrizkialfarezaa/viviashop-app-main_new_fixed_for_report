<?php
/**
 * scripts/stress_test_e2e_chatbot.php
 * Robust end-to-end simulation of all user actions (Search, Cart, Direct Buy, Print Service, and Order Checking).
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\AI\ToolDispatcher;
use App\Services\AI\Context;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Start session
Session::start();

$dispatcher = app(ToolDispatcher::class);

echo "=========================================================\n";
echo "    VIVIASHOP AI CHATBOT END-TO-END FLOW STRESS TEST      \n";
echo "=========================================================\n\n";

// Get test user
$user = User::first();
if (!$user) {
    $user = User::create([
        'name'     => 'E2E Test User',
        'email'    => 'e2etestuser@viviashop.local',
        'password' => bcrypt('password123')
    ]);
}

// Setup Request and Context
$request = new Request();
$request->setUserResolver(fn() => $user);
$request->merge(['print_session_token' => 'e2e_test_session_token_' . uniqid()]);
$ctx = Context::fromRequest($request);

$failures = 0;
$stepsCount = 0;

$runStep = function(string $title, callable $action) use (&$failures, &$stepsCount) {
    $stepsCount++;
    echo "Step {$stepsCount}: {$title}...\n";
    try {
        $result = $action();
        if ($result) {
            echo "   ✅ SUCCESS\n";
        } else {
            echo "   ❌ FAILED\n";
            $failures++;
        }
    } catch (\Throwable $e) {
        echo "   💥 EXCEPTION: " . $e->getMessage() . "\n";
        echo "      File: " . $e->getFile() . ":" . $e->getLine() . "\n";
        $failures++;
    }
    echo "---------------------------------------------------------\n";
};

// ── Flow 1: Search Products ──────────────────────────────────────────
$runStep("Search for a product (e.g. 'Joyko')", function() use ($dispatcher, $ctx, &$searchedProductId) {
    $res = $dispatcher->dispatch('search_products_via_sql', ['query' => 'Joyko'], $ctx);
    if (!$res->success || empty($res->data['products'])) {
        echo "      Error or empty result: " . ($res->message ?? 'No products');
        return false;
    }
    // Find a simple product
    foreach ($res->data['products'] as $p) {
        $prod = Product::find($p['id']);
        if ($prod && $prod->type === 'simple') {
            $searchedProductId = $p['id'];
            echo "      Found simple product: \"{$p['name']}\" (ID: {$searchedProductId})\n";
            return true;
        }
    }
    echo "      No simple products found in search results.\n";
    return false;
});

// ── Flow 2: Add Search Product to Cart ────────────────────────────────
$runStep("Add searched product to cart", function() use ($dispatcher, $ctx, &$searchedProductId) {
    if (empty($searchedProductId)) {
        echo "      Skipped (no product found in step 1)\n";
        return false;
    }
    $res = $dispatcher->dispatch('add_to_cart', ['product_id' => $searchedProductId, 'confirm' => true], $ctx);
    if (!$res->success) {
        echo "      Error: " . $res->message;
        return false;
    }
    echo "      Response message: \"{$res->message}\"\n";
    return true;
});

// ── Flow 3: Get Quick Buy Redirect URL ────────────────────────────────
$runStep("Request direct purchase / checkout redirect", function() use ($dispatcher, $ctx) {
    $res = $dispatcher->dispatch('quick_buy_redirect', ['confirm' => true], $ctx);
    if (!$res->success || empty($res->data['redirect_url'])) {
        echo "      Error: " . ($res->message ?? 'No redirect URL');
        return false;
    }
    echo "      Redirect URL: {$res->data['redirect_url']}\n";
    return true;
});

// ── Flow 4: Resolve Printing Variant ──────────────────────────────────
$runStep("Resolve printing configuration to variant", function() use ($dispatcher, $ctx, &$printVariantId) {
    $res = $dispatcher->dispatch('resolve_print_variant', [
        'paper_type_name' => 'HVS',
        'print_type_name' => 'BW',
        'paper_size'      => 'A4'
    ], $ctx);
    if (!$res->success || empty($res->data['variant_id'])) {
        echo "      Error: " . ($res->message ?? 'No variant resolved');
        return false;
    }
    $printVariantId = $res->data['variant_id'];
    echo "      Resolved variant: ID {$printVariantId} - Cost Per Page: Rp " . number_format($res->data['price_per_page'], 0, ',', '.') . "\n";
    return true;
});

// ── Flow 5: Calculate Printing Cost ───────────────────────────────────
$runStep("Calculate cost for printing", function() use ($dispatcher, $ctx, &$printVariantId, &$totalCost) {
    if (empty($printVariantId)) {
        echo "      Skipped (no variant resolved in step 4)\n";
        return false;
    }
    $res = $dispatcher->dispatch('calculate_print_cost', [
        'variant_id'  => $printVariantId,
        'total_pages' => 30,
        'quantity'    => 2
    ], $ctx);
    if (!$res->success || empty($res->data['total_price'])) {
        echo "      Error: " . ($res->message ?? 'No cost calculated');
        return false;
    }
    $totalCost = $res->data['total_price'];
    echo "      Calculated cost: Rp " . number_format($totalCost, 0, ',', '.') . "\n";
    return true;
});

// ── Flow 6: Add Printing Item to Cart ────────────────────────────────
$runStep("Add print job to cart", function() use ($dispatcher, $ctx, &$printVariantId, &$totalCost) {
    if (empty($printVariantId) || empty($totalCost)) {
        echo "      Skipped (missing print data)\n";
        return false;
    }
    $res = $dispatcher->dispatch('create_print_cart_item', [
        'variant_id'  => $printVariantId,
        'total_pages' => 30,
        'quantity'    => 2,
        'total_price' => $totalCost,
        'confirm'     => true
    ], $ctx);
    if (!$res->success) {
        echo "      Error: " . $res->message;
        return false;
    }
    echo "      Response message: \"{$res->message}\"\n";
    return true;
});

// ── Flow 7: Check User Orders ──────────────────────────────────────────
$runStep("Check order history & tracking status", function() use ($dispatcher, $ctx, $user) {
    // Create a mock order if the user has no orders
    if (\App\Models\Order::where('user_id', $user->id)->count() === 0) {
        \App\Models\Order::create([
            'user_id' => $user->id,
            'code' => 'INV-TEST-001',
            'status' => \App\Models\Order::CREATED,
            'payment_status' => \App\Models\Order::UNPAID,
            'payment_method' => 'cod',
            'grand_total' => 150000,
            'base_total_price' => 140000,
            'order_date' => now(),
            'payment_due' => now()->addDays(1),
            'customer_first_name' => 'E2E',
            'customer_last_name' => 'Test',
            'customer_email' => $user->email,
            'customer_phone' => '081234567890',
            'customer_address1' => 'Test Address',
            'shipping_cost' => 10000,
            'shipping_courier' => 'jne',
            'shipping_service_name' => 'REG',
        ]);
    }

    $res = $dispatcher->dispatch('check_order_status', ['limit' => 3], $ctx);
    if (!$res->success) {
        echo "      Error: " . $res->message;
        return false;
    }
    echo "      Order status response:\n";
    echo $res->message . "\n";
    return true;
});

echo "\n=========================================================\n";
if ($failures === 0) {
    echo "🎉 ALL E2E FLOW TESTS COMPLETED SUCCESSFULLY (100% Success Rate)!\n";
} else {
    echo "⚠️  STRESS TEST COMPLETED WITH {$failures} FAILURES.\n";
}
echo "=========================================================\n";
exit($failures === 0 ? 0 : 1);
