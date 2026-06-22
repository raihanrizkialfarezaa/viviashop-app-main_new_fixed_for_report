<?php

namespace Tests\Unit\AI;

use App\Services\AI\ToolResult;
use Tests\TestCase;

class ToolResultTest extends TestCase
{
    public function test_ok_creates_successful_result(): void
    {
        $result = ToolResult::ok(['key' => 'value'], 'product-card', 'Found 1 product.');

        $this->assertTrue($result->success);
        $this->assertEquals(['key' => 'value'], $result->data);
        $this->assertEquals('product-card', $result->uiHint);
        $this->assertEquals('Found 1 product.', $result->message);
    }

    public function test_error_creates_failed_result(): void
    {
        $result = ToolResult::error('Something went wrong.', ['debug' => true]);

        $this->assertFalse($result->success);
        $this->assertEquals('Something went wrong.', $result->message);
        $this->assertEquals(['debug' => true], $result->data);
        $this->assertEquals('', $result->uiHint);
    }

    public function test_to_array_returns_all_fields(): void
    {
        $result = ToolResult::ok(['x' => 1], 'metric-card', 'OK');
        $arr    = $result->toArray();

        $this->assertArrayHasKey('success', $arr);
        $this->assertArrayHasKey('data', $arr);
        $this->assertArrayHasKey('ui_hint', $arr);
        $this->assertArrayHasKey('message', $arr);
        $this->assertTrue($arr['success']);
        $this->assertEquals('metric-card', $arr['ui_hint']);
    }
}
