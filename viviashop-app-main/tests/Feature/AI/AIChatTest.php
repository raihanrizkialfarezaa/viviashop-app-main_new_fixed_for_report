<?php

namespace Tests\Feature\AI;

use App\Services\AI\AIAgentService;
use Tests\TestCase;

/**
 * Feature tests for the AI chat endpoints.
 *
 * Uses WithoutMiddleware to bypass the pre-existing broken migration chain
 * in the test database (add_payment_slip_to_orders_table references a
 * non-existent column). Auth/RBAC is verified via route middleware assertions.
 *
 * AIAgentService is mocked so no real Gemini API calls are made.
 */
class AIChatTest extends TestCase
{
    // -------------------------------------------------------------------------
    // POST /ai/chat — public frontend chat
    // -------------------------------------------------------------------------

    public function test_frontend_chat_returns_json_reply(): void
    {
        $this->mock(AIAgentService::class, function ($mock) {
            $mock->shouldReceive('run')
                 ->once()
                 ->andReturn([
                     'reply'         => 'Halo! Saya menemukan 3 produk.',
                     'tool_trace'    => [],
                     'ui_components' => [],
                 ]);
        });

        $response = $this->withoutMiddleware()
                         ->postJson('/ai/chat', ['message' => 'Cari kertas HVS']);

        $response->assertStatus(200)
                 ->assertJsonStructure(['success', 'reply', 'tool_trace', 'ui_components'])
                 ->assertJson(['success' => true]);
    }

    public function test_frontend_chat_requires_message(): void
    {
        $response = $this->withoutMiddleware()
                         ->postJson('/ai/chat', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['message']);
    }

    public function test_frontend_chat_rejects_message_over_2000_chars(): void
    {
        $response = $this->withoutMiddleware()
                         ->postJson('/ai/chat', ['message' => str_repeat('a', 2001)]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['message']);
    }

    // -------------------------------------------------------------------------
    // Route middleware registration checks (no DB needed)
    // -------------------------------------------------------------------------

    public function test_ai_chat_route_is_registered(): void
    {
        $routes = collect(\Illuminate\Support\Facades\Route::getRoutes()->getRoutes());
        $found  = $routes->first(fn ($r) => $r->getName() === 'ai.chat');

        $this->assertNotNull($found, 'Route ai.chat should be registered');
        $this->assertContains('POST', $found->methods());
    }

    public function test_ai_upload_route_requires_auth_middleware(): void
    {
        $routes = collect(\Illuminate\Support\Facades\Route::getRoutes()->getRoutes());
        $found  = $routes->first(fn ($r) => $r->getName() === 'ai.upload');

        $this->assertNotNull($found, 'Route ai.upload should be registered');
        $this->assertContains('auth', $found->gatherMiddleware());
    }

    public function test_admin_ai_console_route_requires_is_admin_middleware(): void
    {
        $routes = collect(\Illuminate\Support\Facades\Route::getRoutes()->getRoutes());
        $found  = $routes->first(fn ($r) => $r->getName() === 'admin.ai.console');

        $this->assertNotNull($found, 'Route admin.ai.console should be registered');
        $middleware = $found->gatherMiddleware();
        $this->assertContains('is_admin', $middleware);
    }

    public function test_admin_ai_chat_route_requires_is_admin_middleware(): void
    {
        $routes = collect(\Illuminate\Support\Facades\Route::getRoutes()->getRoutes());
        $found  = $routes->first(fn ($r) => $r->getName() === 'admin.ai.chat');

        $this->assertNotNull($found, 'Route admin.ai.chat should be registered');
        $middleware = $found->gatherMiddleware();
        $this->assertContains('is_admin', $middleware);
    }

    // -------------------------------------------------------------------------
    // Admin chat with mocked service
    // -------------------------------------------------------------------------

    public function test_admin_chat_returns_json_reply(): void
    {
        $this->mock(AIAgentService::class, function ($mock) {
            $mock->shouldReceive('run')
                 ->once()
                 ->andReturn([
                     'reply'         => 'Ditemukan 2 item stok kritis.',
                     'tool_trace'    => [['tool' => 'scan_critical_stock', 'success' => true]],
                     'ui_components' => [],
                 ]);
        });

        $response = $this->withoutMiddleware()
                         ->postJson('/admin/ai-assistant/chat', ['message' => 'Cek stok kritis']);

        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJsonPath('reply', 'Ditemukan 2 item stok kritis.');
    }
}
