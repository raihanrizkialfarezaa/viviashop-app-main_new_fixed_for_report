<?php

namespace Tests\Unit\AI;

use App\Services\AI\AIAgentService;
use App\Services\AI\ConversationStore;
use App\Services\AI\Context;
use App\Services\AI\GeminiClient;
use App\Services\AI\PromptBuilder;
use App\Services\AI\ToolDispatcher;
use App\Services\AI\ToolRegistry;
use App\Services\AI\ToolResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Mockery;
use Tests\TestCase;

class AIAgentServiceTest extends TestCase
{
    private const FALLBACK_REPLY = 'Maaf, AI belum dapat memberikan jawaban yang valid. Silakan coba lagi.';

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_run_returns_fallback_reply_when_gemini_throws(): void
    {
        [$service, $gemini, $dispatcher, $store] = $this->makeService();
        $ctx = $this->makeContext();

        $store->shouldReceive('keyFromContext')
            ->once()
            ->with($ctx)
            ->andReturn('guest_test');
        $store->shouldReceive('get')
            ->once()
            ->with('guest_test')
            ->andReturn([]);
        $store->shouldReceive('set')
            ->once()
            ->with('guest_test', Mockery::on(function (array $history): bool {
                return count($history) === 2
                    && ($history[0]['role'] ?? null) === 'user'
                    && ($history[0]['parts'][0]['text'] ?? null) === 'Cari kertas HVS'
                    && ($history[1]['role'] ?? null) === 'model'
                    && ($history[1]['parts'][0]['text'] ?? null) === self::FALLBACK_REPLY;
            }));

        $gemini->shouldReceive('generateContent')
            ->once()
            ->andThrow(new \RuntimeException('timeout'));

        $dispatcher->shouldReceive('dispatch')->never();

        $result = $service->run('Cari kertas HVS', $ctx, 'frontend');

        $this->assertSame(self::FALLBACK_REPLY, $result['reply']);
        $this->assertSame([], $result['tool_trace']);
        $this->assertSame([], $result['ui_components']);
    }

    public function test_run_returns_fallback_reply_when_gemini_response_is_empty(): void
    {
        [$service, $gemini, $dispatcher, $store] = $this->makeService();
        $ctx = $this->makeContext();

        $store->shouldReceive('keyFromContext')
            ->once()
            ->with($ctx)
            ->andReturn('guest_test');
        $store->shouldReceive('get')
            ->once()
            ->with('guest_test')
            ->andReturn([]);
        $store->shouldReceive('set')
            ->once()
            ->with('guest_test', Mockery::on(function (array $history): bool {
                return count($history) === 2
                    && ($history[0]['role'] ?? null) === 'user'
                    && ($history[1]['role'] ?? null) === 'model'
                    && ($history[1]['parts'][0]['text'] ?? null) === self::FALLBACK_REPLY;
            }));

        $gemini->shouldReceive('generateContent')
            ->once()
            ->andReturn([]);

        $gemini->shouldReceive('extractFunctionCall')
            ->once()
            ->with([])
            ->andReturnNull();
        $gemini->shouldReceive('extractText')
            ->once()
            ->with([])
            ->andReturn('');

        $dispatcher->shouldReceive('dispatch')->never();

        $result = $service->run('Cek stok produk', $ctx, 'frontend');

        $this->assertSame(self::FALLBACK_REPLY, $result['reply']);
        $this->assertSame([], $result['tool_trace']);
        $this->assertSame([], $result['ui_components']);
    }

    public function test_run_returns_fallback_reply_when_max_turns_are_exhausted(): void
    {
        $originalMaxTurns = config('ai.agent.max_turns');
        Config::set('ai.agent.max_turns', 1);

        try {
            [$service, $gemini, $dispatcher, $store] = $this->makeService();
            $ctx = $this->makeContext(true);

            $store->shouldReceive('keyFromContext')
                ->once()
                ->with($ctx)
                ->andReturn('guest_test');
            $store->shouldReceive('get')
                ->once()
                ->with('guest_test')
                ->andReturn([]);
            $store->shouldReceive('set')
                ->once()
                ->with('guest_test', Mockery::on(function (array $history): bool {
                    return count($history) === 4
                        && ($history[0]['role'] ?? null) === 'user'
                        && ($history[1]['role'] ?? null) === 'model'
                        && isset($history[1]['parts'][0]['functionCall'])
                        && ($history[2]['role'] ?? null) === 'user'
                        && isset($history[2]['parts'][0]['functionResponse'])
                        && ($history[3]['role'] ?? null) === 'model'
                        && ($history[3]['parts'][0]['text'] ?? null) === self::FALLBACK_REPLY;
                }));

            $gemini->shouldReceive('generateContent')
                ->once()
                ->andReturn([
                    'candidates' => [
                        [
                            'content' => [
                                'parts' => [
                                    [
                                        'functionCall' => [
                                            'name' => 'scan_critical_stock',
                                            'args' => ['limit' => 5],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]);

            $gemini->shouldReceive('extractFunctionCall')
                ->once()
                ->with(Mockery::type('array'))
                ->andReturn([
                    'name' => 'scan_critical_stock',
                    'args' => ['limit' => 5],
                ]);

            $dispatcher->shouldReceive('dispatch')
                ->once()
                ->with('scan_critical_stock', ['limit' => 5], $ctx)
                ->andReturn(ToolResult::ok(['count' => 1], '', 'Found 1 item.'));

            $result = $service->run('Cek stok kritis', $ctx, 'admin');

            $this->assertSame(self::FALLBACK_REPLY, $result['reply']);
            $this->assertCount(1, $result['tool_trace']);
            $this->assertSame('scan_critical_stock', $result['tool_trace'][0]['tool']);
            $this->assertSame([], $result['ui_components']);
        } finally {
            Config::set('ai.agent.max_turns', $originalMaxTurns);
        }
    }

    private function makeService(): array
    {
        $gemini = Mockery::mock(GeminiClient::class);
        $registry = new ToolRegistry();
        $dispatcher = Mockery::mock(ToolDispatcher::class);
        $promptBuilder = new PromptBuilder();
        $store = Mockery::mock(ConversationStore::class);

        return [
            new AIAgentService($gemini, $registry, $dispatcher, $promptBuilder, $store),
            $gemini,
            $dispatcher,
            $store,
        ];
    }

    private function makeContext(bool $isAdmin = false): Context
    {
        return new Context(
            user: null,
            printSessionToken: null,
            cartInstance: 'default',
            requestId: 'req-test',
            isAdmin: $isAdmin,
            request: Request::create('/'),
        );
    }
}