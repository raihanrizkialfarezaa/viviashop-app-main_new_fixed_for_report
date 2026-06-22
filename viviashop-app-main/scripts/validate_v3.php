<?php
$c = file_get_contents(dirname(__DIR__) . '/resources/views/ai/widget.blade.php');
$checks = [
    // Structure
    'FAB button #ai-widget-toggle'   => str_contains($c, 'id="ai-widget-toggle"'),
    'FAB ring animation'             => str_contains($c, 'ai-fab-ring'),
    'FAB badge'                      => str_contains($c, 'ai-fab-badge'),
    'FAB label Butuh bantuan'        => str_contains($c, 'Butuh bantuan'),
    'Panel #ai-widget-panel'         => str_contains($c, 'id="ai-widget-panel"'),
    'Fullscreen toggle method'       => str_contains($c, 'toggleFullscreen'),
    'Fullscreen backdrop'            => str_contains($c, 'ai-fs-backdrop'),
    'Fullscreen CSS class'           => str_contains($c, 'ai-fullscreen'),
    // Header
    'Bot avatar in header'           => str_contains($c, 'ai-bot-avatar'),
    'Chips bar inside header'        => str_contains($c, 'ai-chips-bar'),
    'Quick chips (w-chip style)'     => str_contains($c, 'ai-w-chip'),
    'Chip: Cari produk'              => str_contains($c, 'Cari produk'),
    'Chip: Layanan cetak'            => str_contains($c, 'Layanan cetak'),
    'Online dot animation'           => str_contains($c, 'ai-online-dot'),
    // Messages
    'Messages #ai-messages'          => str_contains($c, 'id="ai-messages"'),
    'Per-message row class'          => str_contains($c, 'ai-msg-row'),
    'Bot avatar per-message'         => str_contains($c, 'ai-av-bot'),
    'User avatar per-message'        => str_contains($c, 'ai-av-me'),
    'Bubble wrapper'                 => str_contains($c, 'ai-bbl-wrap'),
    'Bot bubble class'               => str_contains($c, 'ai-bbl-bot'),
    'User bubble class'              => str_contains($c, 'ai-bbl-me'),
    'Bubble timestamp'               => str_contains($c, 'ai-bbl-time'),
    // Typing
    'Typing row'                     => str_contains($c, 'ai-typing-row'),
    'Typing dots'                    => str_contains($c, 'ai-tdot'),
    // Product cards
    'Product mini card'              => str_contains($c, 'ai-prod-mini'),
    'Product detail button'          => str_contains($c, 'ai-p-btn-detail'),
    'Product buy button'             => str_contains($c, 'ai-p-btn-buy'),
    'Product stock classes'          => str_contains($c, 'ai-stock-hi'),
    // Input
    'Input box class'                => str_contains($c, 'ai-input-box'),
    'Attach button'                  => str_contains($c, 'ai-attach-btn'),
    'Send button'                    => str_contains($c, 'id="ai-send-btn"'),
    'Textarea #ai-input'             => str_contains($c, 'id="ai-input"'),
    // Footer
    'Footer hint badges'             => str_contains($c, 'ai-badges'),
    'Powered by Gemini'              => str_contains($c, 'Powered by Gemini'),
    'Security badges'                => str_contains($c, 'Aman') && str_contains($c, 'terenkripsi'),
    // File upload
    'Upload area #ai-upload-area'    => str_contains($c, 'id="ai-upload-area"'),
    'Dropzone #ai-dropzone'          => str_contains($c, 'id="ai-dropzone"'),
    'File input #ai-file-input'      => str_contains($c, 'id="ai-file-input"'),
    'Upload progress'                => str_contains($c, 'ai-up-prog'),
    'File chips render'              => str_contains($c, 'ai-file-chips'),
    // JS methods
    'aiWidget.toggle()'              => str_contains($c, 'toggle()'),
    'aiWidget.toggleFullscreen()'    => str_contains($c, 'toggleFullscreen()'),
    'aiWidget.send()'                => str_contains($c, 'async send()'),
    'aiWidget.addRow()'              => str_contains($c, 'addRow('),
    'aiWidget.addProductCards()'     => str_contains($c, 'addProductCards('),
    'aiWidget.showTyping()'          => str_contains($c, 'showTyping()'),
    'aiWidget.hideTyping()'          => str_contains($c, 'hideTyping()'),
    'aiWidget.chipSend()'            => str_contains($c, 'chipSend('),
    'aiWidget.md() markdown parser'  => str_contains($c, 'md(raw)'),
    'aiWidget.uploadFiles()'         => str_contains($c, 'async uploadFiles()'),
    'aiWidget.restoreMessages()'     => str_contains($c, 'restoreMessages()'),
    'aiWidget.clearChat()'           => str_contains($c, 'clearChat()'),
    'aiWidget.retryLast()'           => str_contains($c, 'retryLast()'),
    'localStorage save'              => str_contains($c, 'localStorage.setItem'),
    'localStorage restore'           => str_contains($c, 'localStorage.getItem'),
    // Technical
    'DM Sans font loaded'            => str_contains($c, 'DM+Sans') || str_contains($c, 'DM Sans'),
    'Tabler icons loaded'            => str_contains($c, 'tabler-icons'),
    'CSRF token'                     => str_contains($c, 'X-CSRF-TOKEN'),
    '419 refresh'                    => str_contains($c, '419'),
    'No jQuery dep'                  => !str_contains($c, 'jQuery'),
    'No Bootstrap dep'               => !str_contains($c, 'bootstrap.'),
    '/ai/chat endpoint'              => str_contains($c, "'/ai/chat'"),
    '/ai/upload endpoint'            => str_contains($c, "'/ai/upload'"),
    'Scoped CSS reset'               => str_contains($c, '#ai-chat-widget *'),
    '@keyframes (3+ animations)'     => substr_count($c, '@keyframes') >= 3,
    '@media responsive'              => str_contains($c, '@media'),
    'DOMContentLoaded boot'          => str_contains($c, 'DOMContentLoaded'),
];

$pass = 0; $total = count($checks);
echo "=== AI Widget v3.0 — Full Validation ===\n\n";
foreach ($checks as $label => $ok) {
    echo ($ok ? '✅' : '❌') . " $label\n";
    if ($ok) $pass++;
}
$pct = round($pass/$total*100, 1);
echo "\n=== RESULT: $pass/$total ($pct%) ===\n";
if ($pass === $total) echo "🎉 ALL CLEAR — Widget v3.0 ready!\n";
else echo "⚠️  $".($total-$pass)." tests failed — review above\n";
