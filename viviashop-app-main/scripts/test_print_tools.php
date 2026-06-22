<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\AI\ToolRegistry;

$registry = app(ToolRegistry::class);

echo "=== Public Allowed Tools ===\n";
foreach ($registry->forRole('public') as $name => $tool) {
    echo "- $name ({$tool->requiredRole()})\n";
}

echo "\n=== Auth Allowed Tools ===\n";
foreach ($registry->forRole('auth') as $name => $tool) {
    echo "- $name ({$tool->requiredRole()})\n";
}

echo "\n=== Config File Tool Roles ===\n";
$configRoles = config('ai.tool_roles');
foreach ($configRoles as $name => $role) {
    echo "- $name: $role\n";
}
