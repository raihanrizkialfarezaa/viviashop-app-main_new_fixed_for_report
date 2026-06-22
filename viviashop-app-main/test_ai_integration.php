<?php
/**
 * AI Agent Integration Test Script
 * Run: php test_ai_integration.php
 * (from the viviashop-app-main directory)
 */

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Boot via console kernel so all service providers (including config) load
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\AI\GeminiClient;
use App\Services\AI\AIAgentService;
use App\Services\AI\Context;
use App\Services\AI\Tools\SearchProductsViaSqlTool;
use App\Services\AI\Tools\ScanCriticalStockTool;
use App\Services\AI\Tools\AggregateBusinessMetricsTool;
use App\Services\AI\Tools\TopEmployeePerformanceTool;
use App\Models\AiToolCall;
use Illuminate\Http\Request;

$pass = 0;
$fail = 0;
$errors = [];

function ok(string $label): void
{
    global $pass;
    $pass++;
    echo "  [PASS] {$label}\n";
}

function fail(string $label, string $reason): void
{
    global $fail, $errors;
    $fail++;
    $errors[] = "{$label}: {$reason}";
    echo "  [FAIL] {$label} -- {$reason}\n";
}

function sec(string $title): void
{
    echo "\n" . str_repeat('=', 55) . "\n  {$title}\n" . str_repeat('=', 55) . "\n";
}

// -------------------------------------------------------
sec('TEST 1: Config & Environment');
// -------------------------------------------------------
$apiKey = config('ai.gemini.api_key');
empty($apiKey)
    ? fail('GEMINI_API_KEY', 'not set in .env')
    : ok('GEMINI_API_KEY set (' . strlen($apiKey) . ' chars)');

$model = config('ai.gemini.model');
ok('GEMINI_MODEL = ' . $model);

// -------------------------------------------------------
sec('TEST 2: Migration — ai_tool_calls table');
// -------------------------------------------------------
try {
    $count = AiToolCall::count();
    ok("ai_tool_calls table exists (rows: {$count})");
} catch (\Exception $e) {
    fail('ai_tool_calls table', $e->getMessage());
}

// Helper: check if a table exists before querying
function tableExists(string $table): bool {
    try {
        \Illuminate\Support\Facades\DB::select("SHOW TABLES LIKE '{$table}'");
        return (bool) \Illuminate\Support\Facades\DB::select("SHOW TABLES LIKE '{$table}'");
    } catch (\Exception $e) {
        return false;
    }
}

// -------------------------------------------------------
sec('TEST 3: GeminiClient — live API call');
// -------------------------------------------------------
try {
    $gemini   = app(GeminiClient::class);
    $response = $gemini->generateContent([
        ['role' => 'user', 'parts' => [['text' => 'Balas dengan satu kata: Halo']]]
    ]);
    $text = $gemini->extractText($response);
    empty($text)
        ? fail('Gemini API', 'empty response text')
        : ok('Gemini replied: ' . substr($text, 0, 80));
} catch (\Exception $e) {
    fail('Gemini API', $e->getMessage());
}

// -------------------------------------------------------
sec('TEST 4: UC1 — SearchProductsViaSqlTool');
// -------------------------------------------------------
try {
    $tool   = app(SearchProductsViaSqlTool::class);
    $ctx    = new Context(null, null, 'default', uniqid(), false, Request::create('/'));
    $result = $tool->execute(['q' => 'kertas', 'limit' => 5], $ctx);
    if ($result->success) {
        $n = count($result->data['products'] ?? []);
        ok("Found {$n} products for query=kertas");
        if ($n > 0) {
            $p = $result->data['products'][0];
            ok("First: {$p['name']} — {$p['price_label']}");
        }
    } else {
        fail('SearchProductsViaSqlTool', $result->message);
    }
} catch (\Exception $e) {
    fail('SearchProductsViaSqlTool', $e->getMessage());
}

// -------------------------------------------------------
sec('TEST 5: UC1 — Full agent turn (shopping)');
// -------------------------------------------------------
try {
    $agent  = app(AIAgentService::class);
    $ctx    = new Context(null, null, 'default', uniqid(), false, Request::create('/'));
    $result = $agent->run('Saya mau cari kertas HVS grosir, ada stok?', $ctx, 'frontend');
    empty($result['reply'])
        ? fail('UC1 agent turn', 'empty reply')
        : ok('Agent replied: ' . substr($result['reply'], 0, 100));
    ok('Tool trace count: ' . count($result['tool_trace']));
    ok('UI components count: ' . count($result['ui_components']));
} catch (\Exception $e) {
    fail('UC1 agent turn', $e->getMessage());
}

// -------------------------------------------------------
sec('TEST 6: UC3 — ScanCriticalStockTool');
// -------------------------------------------------------
try {
    $tool   = app(ScanCriticalStockTool::class);
    $ctx    = new Context(null, null, 'default', uniqid(), true, Request::create('/'));
    $result = $tool->execute(['limit' => 10], $ctx);
    $result->success
        ? ok('Critical items found: ' . ($result->data['count'] ?? 0))
        : fail('ScanCriticalStockTool', $result->message);
} catch (\Exception $e) {
    fail('ScanCriticalStockTool', $e->getMessage());
}

// -------------------------------------------------------
sec('TEST 7: UC4 — AggregateBusinessMetricsTool');
// -------------------------------------------------------
try {
    $tool   = app(AggregateBusinessMetricsTool::class);
    $ctx    = new Context(null, null, 'default', uniqid(), true, Request::create('/'));
    $result = $tool->execute([
        'start_date' => date('Y-m-01'),
        'end_date'   => date('Y-m-d'),
    ], $ctx);
    if ($result->success) {
        ok('Period: ' . $result->data['period']);
        ok('Pengeluaran: ' . $result->data['total_pengeluaran_label']);
        ok('Net Revenue: ' . $result->data['net_revenue_label']);
        ok('Estimated Profit: ' . $result->data['estimated_profit_label']);
    } else {
        fail('AggregateBusinessMetricsTool', $result->message);
    }
} catch (\Exception $e) {
    fail('AggregateBusinessMetricsTool', $e->getMessage());
}

// -------------------------------------------------------
sec('TEST 8: UC4 — TopEmployeePerformanceTool');
// -------------------------------------------------------
try {
    $tool   = app(TopEmployeePerformanceTool::class);
    $ctx    = new Context(null, null, 'default', uniqid(), true, Request::create('/'));
    $result = $tool->execute([
        'start_date' => date('Y-m-01'),
        'end_date'   => date('Y-m-d'),
        'limit'      => 5,
    ], $ctx);
    if ($result->success) {
        $n = $result->data['count'] ?? 0;
        ok("Employees ranked: {$n}");
        if ($n > 0) {
            $top = $result->data['rankings'][0];
            ok("Top: {$top['employee_name']} — {$top['total_revenue_label']}");
        }
    } else {
        fail('TopEmployeePerformanceTool', $result->message);
    }
} catch (\Exception $e) {
    fail('TopEmployeePerformanceTool', $e->getMessage());
}

// -------------------------------------------------------
sec('TEST 9: UC3 — Full admin agent turn');
// -------------------------------------------------------
try {
    $agent  = app(AIAgentService::class);
    $ctx    = new Context(null, null, 'default', uniqid(), true, Request::create('/'));
    $result = $agent->run('Cek stok produk yang kritis dan tampilkan ringkasannya.', $ctx, 'admin');
    empty($result['reply'])
        ? fail('UC3 admin agent turn', 'empty reply')
        : ok('Admin agent replied: ' . substr($result['reply'], 0, 100));
} catch (\Exception $e) {
    fail('UC3 admin agent turn', $e->getMessage());
}

// -------------------------------------------------------
sec('TEST 10: Audit log written to ai_tool_calls');
// -------------------------------------------------------
try {
    $count = AiToolCall::count();
    if ($count > 0) {
        ok("Audit records: {$count}");
        $latest = AiToolCall::latest()->first();
        ok("Latest: tool={$latest->tool_name}, success=" . ($latest->success ? 'true' : 'false'));
    } else {
        fail('Audit log', 'No records written — ToolDispatcher may not be firing');
    }
} catch (\Exception $e) {
    fail('Audit log', $e->getMessage());
}

// -------------------------------------------------------
echo "\n" . str_repeat('=', 55) . "\n";
echo "  RESULTS: {$pass} passed, {$fail} failed\n";
echo str_repeat('=', 55) . "\n";

if (!empty($errors)) {
    echo "\nFailed tests:\n";
    foreach ($errors as $err) {
        echo "  - {$err}\n";
    }
}

exit($fail > 0 ? 1 : 0);
