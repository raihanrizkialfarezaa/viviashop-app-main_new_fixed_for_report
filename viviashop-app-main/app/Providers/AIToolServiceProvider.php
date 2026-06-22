<?php

namespace App\Providers;

use App\Services\AI\AIAgentService;
use App\Services\AI\ConversationStore;
use App\Services\AI\GeminiClient;
use App\Services\AI\PromptBuilder;
use App\Services\AI\ToolDispatcher;
use App\Services\AI\ToolRegistry;

// Tools
use App\Services\AI\Tools\GreetingTool;

// UC1 — Customer Shopping
use App\Services\AI\Tools\SearchProductsViaSqlTool;
use App\Services\AI\Tools\AddToCartTool;
use App\Services\AI\Tools\QuickBuyRedirectTool;
use App\Services\AI\Tools\CheckOrderStatusTool;

// UC2 — Intelligent Print
use App\Services\AI\Tools\ResolvePrintVariantTool;
use App\Services\AI\Tools\CalculatePrintCostTool;
use App\Services\AI\Tools\CreatePrintCartItemTool;

// UC3 — Inventory & Reorder
use App\Services\AI\Tools\ScanCriticalStockTool;
use App\Services\AI\Tools\SuggestSupplierTool;
use App\Services\AI\Tools\CreatePurchaseDraftTool;

// UC4 — BI & Performance
use App\Services\AI\Tools\AggregateBusinessMetricsTool;
use App\Services\AI\Tools\TopEmployeePerformanceTool;
use App\Services\AI\Tools\ExportReportTool;

use Illuminate\Support\ServiceProvider;

class AIToolServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Core singletons
        $this->app->singleton(GeminiClient::class);
        $this->app->singleton(PromptBuilder::class);
        $this->app->singleton(ConversationStore::class);

        // ToolRegistry — register all tools
        $this->app->singleton(ToolRegistry::class, function ($app) {
            $registry = new ToolRegistry();

            $registry->register($app->make(GreetingTool::class));

            // UC1
            $registry->register($app->make(SearchProductsViaSqlTool::class));
            $registry->register($app->make(AddToCartTool::class));
            $registry->register($app->make(QuickBuyRedirectTool::class));
            $registry->register($app->make(CheckOrderStatusTool::class));

            // UC2
            $registry->register($app->make(ResolvePrintVariantTool::class));
            $registry->register($app->make(CalculatePrintCostTool::class));
            $registry->register($app->make(CreatePrintCartItemTool::class));

            // UC3
            $registry->register($app->make(ScanCriticalStockTool::class));
            $registry->register($app->make(SuggestSupplierTool::class));
            $registry->register($app->make(CreatePurchaseDraftTool::class));

            // UC4
            $registry->register($app->make(AggregateBusinessMetricsTool::class));
            $registry->register($app->make(TopEmployeePerformanceTool::class));
            $registry->register($app->make(ExportReportTool::class));

            return $registry;
        });

        $this->app->singleton(ToolDispatcher::class);
        $this->app->singleton(AIAgentService::class);
    }

    public function boot(): void
    {
        //
    }
}
