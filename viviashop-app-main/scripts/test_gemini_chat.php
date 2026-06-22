<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\AI\AIAgentService;
use App\Services\AI\Context;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

Session::start();

// Find the first user (raihan rizki alfareza in user's system)
$user = User::where('name', 'like', '%raihan%')->first() ?: User::first();
echo "Simulating user: " . ($user ? $user->name . " (ID: " . $user->id . ")" : "None") . "\n";

$req = new Request();
if ($user) {
    $req->setUserResolver(fn() => $user);
}
$ctx = Context::fromRequest($req);

$agentService = app(AIAgentService::class);

echo "\n--- Sending message: 'pulpen' ---\n";
try {
    $result = $agentService->run('pulpen', $ctx, 'frontend');
    echo "AI Reply:\n";
    echo $result['reply'] . "\n";
    echo "\nTool Trace:\n";
    print_r($result['tool_trace']);
    echo "\nUI Components:\n";
    print_r($result['ui_components']);
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
