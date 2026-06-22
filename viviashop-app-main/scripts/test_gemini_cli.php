<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$c = app(App\Services\AI\GeminiClient::class);
try {
    $res = $c->generateContent([
        [
            'role' => 'user',
            'parts' => [
                ['text' => 'Ping']
            ]
        ]
    ]);
    var_dump($res);
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "TRACE:\n" . $e->getTraceAsString() . "\n";
}
