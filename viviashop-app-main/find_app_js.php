<?php
$path = __DIR__ . '/public/themes/ezone/assets/js/app.js';
if (!file_exists($path)) {
    die("File not found\n");
}
$c = file_get_contents($path);
$lines = explode("\n", $c);
foreach ($lines as $idx => $line) {
    if (str_contains(strtolower($line), 'cart') || str_contains(strtolower($line), 'ajax') || str_contains(strtolower($line), 'loader') || str_contains(strtolower($line), 'overlay')) {
        echo ($idx + 1) . ": " . trim($line) . "\n";
    }
}
