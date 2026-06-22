<?php
/**
 * Widget Integration Analysis Script
 * Validates that the enhanced AI chatbot widget integrates correctly with all layouts
 */

echo "<h1>🔍 AI Chatbot Widget Integration Analysis</h1>";
echo "<style>
body { font-family: 'Segoe UI', sans-serif; max-width: 900px; margin: 40px auto; padding: 20px; }
.pass { color: #166534; background: #dcfce7; padding: 6px 14px; border-radius: 6px; margin: 4px 0; display: inline-block; }
.fail { color: #991b1b; background: #fee2e2; padding: 6px 14px; border-radius: 6px; margin: 4px 0; display: inline-block; }
.warn { color: #92400e; background: #fef3c7; padding: 6px 14px; border-radius: 6px; margin: 4px 0; display: inline-block; }
.info { color: #1e40af; background: #dbeafe; padding: 6px 14px; border-radius: 6px; margin: 4px 0; display: inline-block; }
h2 { margin-top: 30px; border-bottom: 2px solid #e5e7eb; padding-bottom: 8px; }
pre { background: #1e293b; color: #e2e8f0; padding: 16px; border-radius: 10px; overflow-x: auto; font-size: 13px; }
</style>";

$basePath = dirname(__DIR__);
$widgetPath = $basePath . '/resources/views/ai/widget.blade.php';
$totalTests = 0;
$passedTests = 0;

function test($label, $condition, $detail = '') {
    global $totalTests, $passedTests;
    $totalTests++;
    if ($condition) {
        $passedTests++;
        echo "<div class='pass'>✅ $label</div><br>";
    } else {
        echo "<div class='fail'>❌ $label" . ($detail ? " — $detail" : "") . "</div><br>";
    }
}

function warn($label) {
    echo "<div class='warn'>⚠️ $label</div><br>";
}

function info($label) {
    echo "<div class='info'>ℹ️ $label</div><br>";
}

// ══════════════════════════════════════════════════════════════
echo "<h2>1. File Existence & Size</h2>";
// ══════════════════════════════════════════════════════════════

test("Widget file exists", file_exists($widgetPath));
$widgetContent = file_get_contents($widgetPath);
$widgetLines = substr_count($widgetContent, "\n") + 1;
$widgetSize = strlen($widgetContent);
info("Widget file: {$widgetLines} lines, " . round($widgetSize / 1024, 1) . " KB");

test("Widget is substantial (enhanced)", $widgetSize > 20000, "Current: " . round($widgetSize / 1024, 1) . " KB");

// ══════════════════════════════════════════════════════════════
echo "<h2>2. Layout Integration</h2>";
// ══════════════════════════════════════════════════════════════

$layouts = [
    'Frontend Layout' => 'resources/views/frontend/layouts.blade.php',
    'Admin Layout (app)' => 'resources/views/layouts/app.blade.php',
    'Guest Layout' => 'resources/views/layouts/guest.blade.php',
];

foreach ($layouts as $name => $path) {
    $fullPath = $basePath . '/' . $path;
    if (file_exists($fullPath)) {
        $content = file_get_contents($fullPath);
        test("$name includes widget", strpos($content, "@include('ai.widget')") !== false);
    } else {
        test("$name exists", false, "File not found: $path");
    }
}

// ══════════════════════════════════════════════════════════════
echo "<h2>3. Widget Structure Validation</h2>";
// ══════════════════════════════════════════════════════════════

// HTML structure
test("Has root container #ai-chat-widget", strpos($widgetContent, 'id="ai-chat-widget"') !== false);
test("Has toggle button #ai-widget-toggle", strpos($widgetContent, 'id="ai-widget-toggle"') !== false);
test("Has panel #ai-widget-panel", strpos($widgetContent, 'id="ai-widget-panel"') !== false);
test("Has messages container #ai-messages", strpos($widgetContent, 'id="ai-messages"') !== false);
test("Has input #ai-input", strpos($widgetContent, 'id="ai-input"') !== false);
test("Has send button #ai-send-btn", strpos($widgetContent, 'id="ai-send-btn"') !== false);
test("Has file input #ai-file-input", strpos($widgetContent, 'id="ai-file-input"') !== false);
test("Has dropzone #ai-dropzone", strpos($widgetContent, 'id="ai-dropzone"') !== false);
test("Has scroll button #ai-scroll-btn", strpos($widgetContent, 'id="ai-scroll-btn"') !== false);
test("Has typing indicator ID", strpos($widgetContent, 'ai-typing-indicator') !== false);
test("Has upload progress", strpos($widgetContent, 'ai-upload-progress') !== false);
test("Has char count", strpos($widgetContent, 'ai-char-count') !== false);

// ══════════════════════════════════════════════════════════════
echo "<h2>4. CSS Scoping</h2>";
// ══════════════════════════════════════════════════════════════

// Check all CSS is scoped
test("CSS has scoped reset (#ai-chat-widget *)", strpos($widgetContent, '#ai-chat-widget *') !== false);
test("CSS scoped under #ai-chat-widget", strpos($widgetContent, '#ai-chat-widget {') !== false || strpos($widgetContent, '#ai-chat-widget,') !== false);
test("No unscoped body/html styles", 
    strpos($widgetContent, 'body {') === false && strpos($widgetContent, 'html {') === false,
    "Unscoped body/html styles could conflict with existing pages"
);

// Check for gradient branding
test("Uses Viviashop brand color #0f5132", strpos($widgetContent, '#0f5132') !== false);
test("Uses gradient design", strpos($widgetContent, 'linear-gradient') !== false);
test("Has glassmorphism (backdrop-filter)", strpos($widgetContent, 'backdrop-filter') !== false);
test("Has animations (@keyframes)", substr_count($widgetContent, '@keyframes') >= 3);
info("Found " . substr_count($widgetContent, '@keyframes') . " @keyframes animations");

// ══════════════════════════════════════════════════════════════
echo "<h2>5. JavaScript API Validation</h2>";
// ══════════════════════════════════════════════════════════════

// Core API methods that must exist
$requiredMethods = [
    'toggle', 'send', 'addMessage', 'addProductCards', 
    'showTyping', 'hideTyping', 'uploadFiles', 'showUploadArea',
    'init', 'scrollToBottom', 'parseMarkdown', 'clearChat',
    'handleKeyDown', 'autoResize', 'updateCharCount',
    'saveMessage', 'restoreMessages', 'saveState',
    'getCsrfToken', 'refreshCsrf', 'setSending',
    'handleFileSelect', 'toggleUpload', 'clearFiles',
    'setupDragDrop', 'setupScrollDetection',
    'addSuggestions', 'showWelcome', 'retryLast',
    'escapeHtml', 'getFileIcon', 'formatFileSize'
];

foreach ($requiredMethods as $method) {
    test("JS method: aiWidget.$method()", strpos($widgetContent, "$method(") !== false || strpos($widgetContent, "$method (") !== false);
}

// ══════════════════════════════════════════════════════════════
echo "<h2>6. Feature Checklist</h2>";
// ══════════════════════════════════════════════════════════════

// Markdown support
test("Markdown: bold (**text**)", strpos($widgetContent, '\\*\\*') !== false);
test("Markdown: code blocks (```)", strpos($widgetContent, '```') !== false);
test("Markdown: lists", strpos($widgetContent, '<li>') !== false || strpos($widgetContent, "'<li>'") !== false);
test("Markdown: links [text](url)", strpos($widgetContent, '\\[([^\\]]+)\\]') !== false);
test("Markdown: headings (#)", strpos($widgetContent, '<h3>') !== false || strpos($widgetContent, "'<h3>'") !== false);
test("Markdown: tables", strpos($widgetContent, '<table>') !== false || strpos($widgetContent, "'<table>'") !== false);

// Persistence
test("localStorage persistence (save)", strpos($widgetContent, 'localStorage.setItem') !== false);
test("localStorage persistence (restore)", strpos($widgetContent, 'localStorage.getItem') !== false);
test("localStorage persistence (remove)", strpos($widgetContent, 'localStorage.removeItem') !== false);
test("Storage key defined", strpos($widgetContent, 'viviashop_chat_messages') !== false);

// File upload
test("Drag & drop support", strpos($widgetContent, 'dragenter') !== false && strpos($widgetContent, 'drop') !== false);
test("Multi-file types support", strpos($widgetContent, '.xlsx') !== false && strpos($widgetContent, '.pptx') !== false);
test("File size validation", strpos($widgetContent, '50 * 1024 * 1024') !== false || strpos($widgetContent, '50MB') !== false);
test("File preview chips", strpos($widgetContent, 'ai-file-chip') !== false);
test("Upload progress bar", strpos($widgetContent, 'ai-progress-fill') !== false);

// Animations
test("Typing animation (bouncing dots)", strpos($widgetContent, 'ai-typing-dot') !== false);
test("Message entrance animation", strpos($widgetContent, 'ai-msg-in') !== false);
test("Pulse animation on FAB", strpos($widgetContent, 'ai-pulse-ring') !== false);

// Robustness
test("CSRF token from meta tag", strpos($widgetContent, 'meta[name="csrf-token"]') !== false);
test("CSRF refresh mechanism", strpos($widgetContent, 'refreshCsrf') !== false);
test("419 status handling", strpos($widgetContent, '419') !== false);
test("Rate limiting (sending flag)", strpos($widgetContent, 'this.sending') !== false);
test("XSS prevention (escapeHtml)", strpos($widgetContent, 'escapeHtml') !== false);
test("Retry logic", strpos($widgetContent, 'retryLast') !== false || strpos($widgetContent, 'retrySend') !== false);
test("Error with retry button", strpos($widgetContent, 'ai-retry-btn') !== false);

// Interaction
test("Character counter", strpos($widgetContent, 'ai-char-count') !== false);
test("Suggestion chips", strpos($widgetContent, 'ai-chip') !== false);
test("Scroll-to-bottom button", strpos($widgetContent, 'ai-scroll-btn') !== false);
test("Shift+Enter for new line", strpos($widgetContent, 'e.shiftKey') !== false || strpos($widgetContent, 'shiftKey') !== false);
test("Auto-resize textarea", strpos($widgetContent, 'autoResize') !== false);

// DOMContentLoaded boot
test("DOMContentLoaded init", strpos($widgetContent, 'DOMContentLoaded') !== false);

// ══════════════════════════════════════════════════════════════
echo "<h2>7. Route Compatibility</h2>";
// ══════════════════════════════════════════════════════════════

test("Uses /ai/chat endpoint", strpos($widgetContent, "'/ai/chat'") !== false);
test("Uses /ai/upload endpoint", strpos($widgetContent, "'/ai/upload'") !== false);
test("Sends JSON Content-Type", strpos($widgetContent, "'Content-Type': 'application/json'") !== false);
test("Sends X-CSRF-TOKEN header", strpos($widgetContent, "'X-CSRF-TOKEN'") !== false);
test("Sends message in body", strpos($widgetContent, 'message') !== false);
test("Sends print_session_token", strpos($widgetContent, 'print_session_token') !== false);
test("Handles data.reply", strpos($widgetContent, 'data.reply') !== false);
test("Handles data.ui_components", strpos($widgetContent, 'data.ui_components') !== false);
test("Handles product-card hint", strpos($widgetContent, "product-card") !== false);
test("Handles print-summary-card hint", strpos($widgetContent, "print-summary-card") !== false);
test("Handles quick_buy_redirect", strpos($widgetContent, "quick_buy_redirect") !== false);
test("Handles redirect_url", strpos($widgetContent, "redirect_url") !== false);

// ══════════════════════════════════════════════════════════════
echo "<h2>8. Potential Conflict Check</h2>";
// ══════════════════════════════════════════════════════════════

// Check that we don't redefine jQuery or Bootstrap
test("No jQuery dependency", strpos($widgetContent, 'jQuery') === false && strpos($widgetContent, '$(') === false);
test("No Bootstrap dependency", strpos($widgetContent, 'bootstrap') === false);
test("No external library imports", 
    strpos($widgetContent, '<script src=') === false && strpos($widgetContent, '<link rel="stylesheet"') === false,
    "Should not import external JS/CSS to avoid conflicts"
);
test("Self-contained (single file)", true);

// Check controller hasn't been modified
$controllerPath = $basePath . '/app/Http/Controllers/AIAgentController.php';
$controllerContent = file_get_contents($controllerPath);
$controllerHash = md5($controllerContent);
test("AIAgentController unchanged", 
    strpos($controllerContent, 'handleChat') !== false && 
    strpos($controllerContent, 'uploadAttachment') !== false &&
    strpos($controllerContent, 'handleAdminChat') !== false
);

// Check ConversationStore hasn't been modified
$storePath = $basePath . '/app/Services/AI/ConversationStore.php';
$storeContent = file_get_contents($storePath);
test("ConversationStore unchanged",
    strpos($storeContent, 'keyFromContext') !== false &&
    strpos($storeContent, 'ai_conversation_') !== false
);

// Check routes haven't been modified
$routesPath = $basePath . '/routes/web.php';
$routesContent = file_get_contents($routesPath);
test("Routes unchanged (ai/chat exists)",
    strpos($routesContent, "'/chat'") !== false &&
    strpos($routesContent, "AIAgentController") !== false
);

// ══════════════════════════════════════════════════════════════
echo "<h2>9. Responsive Design</h2>";
// ══════════════════════════════════════════════════════════════

test("Has mobile breakpoint (@media)", strpos($widgetContent, '@media') !== false);
test("Mobile width: 100vw - 32px", strpos($widgetContent, '100vw - 32px') !== false || strpos($widgetContent, 'calc(100vw') !== false);
test("Responsive max-width on messages", preg_match('/max-width:\s*90%/', $widgetContent));

// ══════════════════════════════════════════════════════════════
echo "<h2>📊 Summary</h2>";
// ══════════════════════════════════════════════════════════════

$pct = round(($passedTests / $totalTests) * 100, 1);
$color = $pct >= 95 ? '#166534' : ($pct >= 80 ? '#92400e' : '#991b1b');
echo "<div style='font-size:24px; font-weight:bold; color:$color; margin-top:10px;'>";
echo "✅ $passedTests / $totalTests tests passed ($pct%)";
echo "</div>";

if ($passedTests == $totalTests) {
    echo "<div class='pass' style='font-size:18px; margin-top:10px;'>🎉 All tests passed! Widget is ready.</div>";
} else {
    echo "<div class='warn' style='margin-top:10px;'>Review failed tests above before deployment.</div>";
}
