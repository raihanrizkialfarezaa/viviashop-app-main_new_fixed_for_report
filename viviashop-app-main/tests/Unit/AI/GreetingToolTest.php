<?php

namespace Tests\Unit\AI;

use App\Services\AI\Context;
use App\Services\AI\Tools\GreetingTool;
use App\Services\AI\ToolResult;
use Illuminate\Http\Request;
use Tests\TestCase;

class GreetingToolTest extends TestCase
{
    private GreetingTool $tool;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tool = new GreetingTool();
    }

    private function makeContext(): Context
    {
        return new Context(
            user:              null,
            printSessionToken: null,
            cartInstance:      'default',
            requestId:         'test-123',
            isAdmin:           false,
            request:           Request::create('/'),
        );
    }

    public function test_name_returns_greeting(): void
    {
        $this->assertEquals('greeting', $this->tool->name());
    }

    public function test_description_is_not_empty(): void
    {
        $this->assertNotEmpty($this->tool->description());
    }

    public function test_required_role_is_public(): void
    {
        $this->assertEquals('public', $this->tool->requiredRole());
    }

    public function test_parameters_has_name_property(): void
    {
        $params = $this->tool->parameters();
        $this->assertArrayHasKey('properties', $params);
        $this->assertArrayHasKey('name', $params['properties']);
    }

    public function test_execute_returns_greeting_with_name(): void
    {
        $result = $this->tool->execute(['name' => 'Budi'], $this->makeContext());

        $this->assertInstanceOf(ToolResult::class, $result);
        $this->assertTrue($result->success);
        $this->assertEquals('Halo Budi! Ada yang bisa saya bantu?', $result->message);
    }

    public function test_execute_returns_greeting_with_guest_default(): void
    {
        $result = $this->tool->execute([], $this->makeContext());

        $this->assertTrue($result->success);
        $this->assertEquals('Halo Guest! Ada yang bisa saya bantu?', $result->message);
    }
}
