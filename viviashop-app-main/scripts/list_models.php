<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$apiKey = config('ai.gemini.api_key');
$url = "https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}";

$client = new \GuzzleHttp\Client([
    'verify' => false,
]);
try {
    $res = $client->get($url);
    $data = json_decode((string)$res->getBody(), true);
    echo "Available Models:\n";
    foreach ($data['models'] ?? [] as $m) {
        echo "- " . $m['name'] . " (methods: " . implode(', ', $m['supportedGenerationMethods'] ?? []) . ")\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    if (method_exists($e, 'getResponse') && $e->getResponse()) {
        echo (string)$e->getResponse()->getBody() . "\n";
    }
}
