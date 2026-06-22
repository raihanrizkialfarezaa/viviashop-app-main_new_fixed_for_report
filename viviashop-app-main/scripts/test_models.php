<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$apiKey = config('ai.gemini.api_key');
$models = [
    'gemini-flash-latest',
    'gemini-flash-lite-latest',
    'gemini-2.5-flash-lite',
    'gemini-3.5-flash',
    'gemini-2.5-pro',
];

$client = new \GuzzleHttp\Client([
    'verify' => false,
]);

foreach ($models as $model) {
    echo "Testing model: {$model}... ";
    $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
    $body = [
        'contents' => [
            ['role' => 'user', 'parts' => [['text' => 'Hello']]]
        ]
    ];
    try {
        $res = $client->post($url, [
            'json' => $body,
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        $data = json_decode((string)$res->getBody(), true);
        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
        echo "SUCCESS: " . trim($text) . "\n";
    } catch (\Exception $e) {
        $msg = $e->getMessage();
        if (method_exists($e, 'getResponse') && $e->getResponse()) {
            $resp = json_decode((string)$e->getResponse()->getBody(), true);
            $msg = $resp['error']['message'] ?? $msg;
        }
        echo "FAILED: " . $msg . "\n";
    }
}
