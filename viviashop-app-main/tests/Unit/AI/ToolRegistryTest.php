<?php

namespace Tests\Unit\AI;

use App\Services\AI\ToolRegistry;
use App\Services\AI\ToolResult;
use App\Services\AI\Context;
use App\Services\AI\Contracts\ToolHandler;
use Tests\TestCase;

class ToolRegistryTest extends TestCase
{
    private function makeStubTool(string $name, string $role): ToolHandler
    {
        return new class($name, $role) implements ToolHandler {
            public function __construct(private string $n, private string $r) {}
            public function name(): string { return $this->n; }
            public function description(): string { return 'stub'; }
            public function parameters(): array { return ['type' => 'object', 'properties' => []]; }
            public function requiredRole(): string { return $this->r; }
            public function execute(array $args, Context $ctx): ToolResult { return ToolResult::ok([]); }
        };
    }

    public function test_register_and_get_tool(): void
    {
        $registry = new ToolRegistry();
        $tool     = $this->makeStubTool('my_tool', 'public');

        $registry->register($tool);

        $this->assertSame($tool, $registry->get('my_tool'));
        $this->assertNull($registry->get('nonexistent'));
    }

    public function test_for_role_public_only_sees_public_tools(): void
    {
        $registry = new ToolRegistry();
        $registry->register($this->makeStubTool('pub_tool', 'public'));
        $registry->register($this->makeStubTool('auth_tool', 'auth'));
        $registry->register($this->makeStubTool('admin_tool', 'admin'));

        $visible = $registry->forRole('public');

        $this->assertCount(1, $visible);
        $this->assertTrue($visible->has('pub_tool'));
    }

    public function test_for_role_auth_sees_public_and_auth(): void
    {
        $registry = new ToolRegistry();
        $registry->register($this->makeStubTool('pub_tool', 'public'));
        $registry->register($this->makeStubTool('auth_tool', 'auth'));
        $registry->register($this->makeStubTool('admin_tool', 'admin'));

        $visible = $registry->forRole('auth');

        $this->assertCount(2, $visible);
        $this->assertTrue($visible->has('pub_tool'));
        $this->assertTrue($visible->has('auth_tool'));
        $this->assertFalse($visible->has('admin_tool'));
    }

    public function test_for_role_admin_sees_all(): void
    {
        $registry = new ToolRegistry();
        $registry->register($this->makeStubTool('pub_tool', 'public'));
        $registry->register($this->makeStubTool('auth_tool', 'auth'));
        $registry->register($this->makeStubTool('admin_tool', 'admin'));

        $visible = $registry->forRole('admin');

        $this->assertCount(3, $visible);
    }

    public function test_to_gemini_declarations_returns_correct_structure(): void
    {
        $registry = new ToolRegistry();
        $registry->register($this->makeStubTool('my_tool', 'public'));

        $decls = $registry->toGeminiDeclarations('public');

        $this->assertCount(1, $decls);
        $this->assertArrayHasKey('functionDeclarations', $decls[0]);
        $this->assertEquals('my_tool', $decls[0]['functionDeclarations'][0]['name']);
    }

    public function test_to_gemini_declarations_empty_when_no_tools_for_role(): void
    {
        $registry = new ToolRegistry();
        $registry->register($this->makeStubTool('admin_tool', 'admin'));

        $decls = $registry->toGeminiDeclarations('public');

        $this->assertEmpty($decls);
    }
}
