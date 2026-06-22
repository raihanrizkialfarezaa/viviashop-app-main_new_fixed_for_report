<?php
$c = file_get_contents(dirname(__DIR__) . '/resources/views/ai/widget.blade.php');
$checks = [
    'FAB ring animation'    => str_contains($c, 'ai-ring-pulse'),
    'Message animation'     => str_contains($c, 'ai-bubble-in'),
    'Typing avatar'         => str_contains($c, 'ai-typing-avatar'),
    'Storage key v2'        => str_contains($c, 'viviashop_chat_v2'),
    'saveMsg method'        => str_contains($c, 'saveMsg('),
    'fileIcon method'       => str_contains($c, 'fileIcon('),
    'fmtSize method'        => str_contains($c, 'fmtSize('),
    'addChips method'       => str_contains($c, 'addChips('),
    'CSS variables'         => str_contains($c, '--ai-brand:'),
    'Product card v2'       => str_contains($c, 'ai-product-card-header'),
    'Scroll pill'           => str_contains($c, 'Gulir ke bawah'),
    'Notification dot'      => str_contains($c, 'ai-notif-dot'),
    'Input footer'          => str_contains($c, 'ai-input-footer'),
    'Powered by Gemini'     => str_contains($c, 'Powered by Gemini'),
    'Avatar online badge'   => str_contains($c, 'ai-avatar-online'),
    'Header dot pattern'    => str_contains($c, 'ai-header-pattern'),
    '7 @keyframes total'    => substr_count($c, '@keyframes') === 7,
    'backdrop-filter glass' => str_contains($c, 'backdrop-filter'),
    'CSS custom props'      => substr_count($c, '--ai-') >= 10,
    'No jQuery'             => !str_contains($c, 'jQuery') && !str_contains($c, '$('),
    'No Bootstrap'          => !str_contains($c, 'bootstrap'),
    'CSRF meta tag'         => str_contains($c, 'meta[name="csrf-token"]'),
    '419 retry'             => str_contains($c, '419'),
    'Markdown bold'         => str_contains($c, '\\*\\*'),
    'Markdown code blocks'  => str_contains($c, '```'),
    'localStorage save'     => str_contains($c, 'localStorage.setItem'),
    'localStorage restore'  => str_contains($c, 'localStorage.getItem'),
    'DOMContentLoaded boot' => str_contains($c, 'DOMContentLoaded'),
    '/ai/chat endpoint'     => str_contains($c, "'/ai/chat'"),
    '/ai/upload endpoint'   => str_contains($c, "'/ai/upload'"),
];
$pass = 0;
echo "=== Viviashop AI Widget v2.0 — Final Validation ===\n\n";
foreach ($checks as $name => $ok) {
    echo ($ok ? '✅' : '❌') . " $name\n";
    if ($ok) $pass++;
}
$total = count($checks);
$pct = round($pass/$total*100, 1);
echo "\n=== RESULT: $pass/$total tests passed ($pct%) ===\n";
if ($pass === $total) echo "🎉 ALL CLEAR — Widget v2.0 ready!\n";
