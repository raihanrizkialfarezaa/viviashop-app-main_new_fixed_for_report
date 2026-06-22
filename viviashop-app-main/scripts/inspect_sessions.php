<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sessionPath = storage_path('framework/sessions');
$files = glob($sessionPath . '/*');

foreach ($files as $file) {
    if (basename($file) === '.gitignore') continue;
    $content = file_get_contents($file);
    // Laravel sessions are serialized PHP arrays
    try {
        $data = unserialize($content);
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                if (str_contains($key, 'ai_conversation_')) {
                    echo "Found Conversation Key: $key in Session file: " . basename($file) . "\n";
                    echo "Total Turns: " . count($val) . "\n";
                    echo json_encode($val, JSON_PRETTY_PRINT) . "\n\n";
                }
            }
        }
    } catch (\Throwable $e) {
        // Not a serialized PHP session (maybe JSON or encrypted)
    }
}
