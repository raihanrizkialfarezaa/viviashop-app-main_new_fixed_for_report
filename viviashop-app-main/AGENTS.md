# Viviashop — Agent Guide

Laravel 10 / PHP 8.1+ / MySQL / Bootstrap 4 + jQuery e-commerce + print-service app with a custom Gemini-backed AI agent.

Full technical documentation available at `DOKUMENTASI_TEKNIS_VIVIASHOP.md` (1439 lines, Indonesian).

## Setup gotchas

- **No `.env.example`** — `composer.json` references one but it doesn't exist. Copy the working `.env`.
- **The committed `.env` contains real production credentials** (Midtrans live keys with `MIDTRANS_IS_PRODUCTION=true`, Cloudinary, Gemini, Instagram). Do not echo secret values back. Do not commit changes to `.env`. Treat any payment/Instagram/Cloudinary call from dev as hitting production.
- DB defaults to MySQL `u875841990_viviashop` on `127.0.0.1` with user `root` and empty password (Laragon-style). No SQLite fallback.
- Vite entry points: `resources/sass/app.scss` + `resources/js/app.js`. `npm run dev` / `npm run build`.
- `package.json` only exposes `dev`/`build`. No lint/format script. `laravel/pint` is in `require-dev` but unscripted.
- There is a **`mysql_readonly`** DB connection in `config/database.php` for AI SQL tools (uses `DB_READONLY_*` env vars, falls back to main DB creds). `config/database.php` sets `strict: false` with explicit modes.

## Dev commands

```
composer install
npm install
php artisan key:generate     # only if APP_KEY missing
php artisan migrate
php artisan db:seed
php artisan serve            # http://127.0.0.1:8000
npm run dev
```

## Tests (PHPUnit 10)

```
php vendor/bin/phpunit --testsuite Unit
php vendor/bin/phpunit --testsuite Feature
php vendor/bin/phpunit tests/Unit/AI
php vendor/bin/phpunit tests/Feature/AI
```

- 8 test files: `tests/Unit/AI/*` (3), `tests/Feature/AI/AIChatTest.php` (1), `tests/Unit/ExampleTest.php` (1), `tests/Feature/ExampleTest.php` (1), plus `TestCase.php` + `CreatesApplication.php`.
- `phpunit.xml` does **not** set `DB_CONNECTION=sqlite` — tests run against real MySQL DB. No in-memory DB.
- Legacy migration chain is fragile; do not rely on `RefreshDatabase`. Prefer `$this->withoutMiddleware()` and mock `AIAgentService`/`GeminiClient` so tests never hit Gemini, Midtrans, or RajaOngkir.

## Project Structure

```
app/
├── Console/Commands/        27 artisan commands
├── Exports/                 8 Excel export classes
├── Imports/                 1 Excel import class (ProdukImport)
├── Http/
│   ├── Controllers/
│   │   ├── Admin/           23 controllers (incl. EmployeePerformance, PrintService, SmartPrint, StockCard, Paper/PrintType)
│   │   ├── Api/             1 controller (ProductVariantController)
│   │   ├── Auth/            7 controllers (laravel/ui scaffold)
│   │   ├── Frontend/        7 controllers (CartControllerNew is a legacy duplicate)
│   │   └── Root/            10 controllers (AIAgent, Cloudinary, Instagram, Pembelian, PembelianDetail, Pengeluaran, PrintService, Setting, Supplier, Controller)
│   ├── Middleware/          10 middleware (AdminMiddleware aliased as `is_admin`)
│   └── Requests/            10 form requests
├── Models/                  35 Eloquent models
├── Services/                5 core services + Services/AI/ (13 tool files)
├── Exceptions/              2 files (Handler, OutOfStockException)
└── helpers.php              Autoloaded (format_uang, terbilang, tanggal_indonesia, tambah_nol_didepan)
```

Legacy duplicates — do not edit blindly:
- `app/Http/Controllers/Frontend/CartControllerNew.php` (live: `CartController.php`)
- `app/Http/Requests/Admin/ProductRequest_updated.php` (live: `ProductRequest.php`)
- `database/seeders/BrandSeederNew.php`, `ProductVariantSeederNew.php`
- Loose root scripts: `create_missing_tables.php`, `debug.php`, `mark_migrations.php`, `migrate.php`, `test_ai_integration.php`, `find_app_js.php`, `cek.js`, `index.html`, `viviashop_chatbot_*.html`, `u875841990_viviashop (3).sql`. None wired in.
- `scripts/` dir — 12 standalone test/validation scripts (Gemini, print tools, chatbot stress tests, model inspection). Not wired into the app; treat as historical artifacts.

## Routing notes

- `routes/web.php` is **1151 lines** with auth/admin/frontend mixed together. Around two dozen ungated `/test-*`, `/debug-*`, `/check-order-142`, `/employee-performance-summary`, `/stress-test-*` routes log in an admin via `Auth::login(...)` and run controller code directly. They live outside any middleware group and ship in production. Do not add to them; gate or remove if you touch them.
- Admin area is `Route::group(['middleware' => ['auth', 'is_admin'], 'prefix' => 'admin', 'as' => 'admin.'])` starting around `routes/web.php:812`.
- Public AI chat is mounted under `Route::middleware('web')->prefix('ai')`; admin AI console under `['auth', 'is_admin']` at `/admin/ai-assistant/chat`.
- `routes/api.php` is small (≈55 lines) and Sanctum-gated only on write endpoints; reads (`{product}/variants`, `low-stock`, etc.) are public.
- `is_admin` is the only custom middleware alias and just checks `auth()->user()->is_admin` (`app/Http/Middleware/AdminMiddleware.php:18`); it assumes the user is already authenticated, so always pair it with `auth`.
- Ungated `/instagram/*` routes handle OAuth callback, webhook, and product posting to Instagram.
- CSRF exemption in `VerifyCsrfToken.php` for: `payments/notification`, `payments/completed`, `payments/failed`, `payments/unfinish`.
- Public location endpoints (provinces/cities/districts) at `/api/provinces`, `/api/cities/{province_id}`, `/api/districts/{city_id}`.

## Models (35 total in `app/Models/`)

Discoverable via `Get-ChildItem app\Models`. Quirks worth knowing:

- `User` has an `is_admin` boolean flag — there is no role/permission system, no `Spatie\Permission`, just that flag.
- `Product` carries two boolean flags `is_print_service` and `is_smart_print` that control which controller surface uses it; `Product`, `Category`, `Brand` use `cviebrock/eloquent-sluggable`.
- `Order` uses soft deletes (callers in `routes/web.php` rely on `Order::withTrashed()`); statuses are pending/processed/shipped/delivered/cancelled and there is a `shipping_adjustment` column for manual fee tweaks.
- Stock lives in three places: `ProductInventory` (simple non-variant stock), `ProductVariant.stock` (per-variant), and the audit log `StockMovement`. `RekamanStok` is a legacy stock-recording model — prefer `StockMovement`.
- Attributes are a 3-tier tree: `Attribute` -> `AttributeVariant` -> `AttributeOption`, with `VariantAttribute` as the pivot tying `ProductVariant` -> `AttributeOption`. `ProductAttributeValue` is a separate per-product extra-attribute table, not the same thing.
- Procurement uses Indonesian names: `Pembelian` (purchase) / `PembelianDetail` (purchase line item) / `Pengeluaran` (expense) / `Supplier`. They are wired via the root-namespace controllers, not `Admin\`.
- `EmployeePerformance` has a "dual-input verification" workflow that drives `EmployeeBonus`. There are several artisan helpers and ungated `/test-*` routes that exercise this; do not assume the simple model alone is the source of truth.
- Print pipeline is session-based: `PrintSession` -> `PrintFile` -> `PrintOrder`, allowing guest checkout. `PrintType` and `PaperType` are lookup tables.
- `AiToolCall` is an audit log written by `ToolDispatcher` for every AI tool invocation.

## Service Layer

| Service | Purpose |
|---------|---------|
| `StockManagementService` | Stock availability checks, reduce/restore stock, reason tracking |
| `StockService` | Stock movement recording, realtime stock calculations |
| `PrintService` | Core print service logic (upload, calculate, order, payment pipeline) |
| `ProductVariantService` | Configurable product creation, variant generation, attribute handling |
| `SmartPrintVariantService` | Auto-detect/fix `paper_size` / `print_type` for print variants |

Custom exception: `OutOfStockException` in `app/Exceptions/`. Thrown by stock services when inventory is insufficient.

## AI Agent System (custom — not LangChain)

**Stack**: Google Gemini API (`config/ai.php`, env `GEMINI_API_KEY`)

**Two surfaces**: `/ai/chat` (frontend, no auth) and `/admin/ai-assistant/chat` (admin, `is_admin` guard)

**Architecture** (`app/Services/AI/`):
- `AIAgentService.php` — Main orchestrator
- `GeminiClient.php` — HTTP client for Gemini API
- `ConversationStore.php` — Session-based conversation history (`ai_conversation_*`)
- `Context.php` — Context builder for prompts
- `PromptBuilder.php` — System prompt construction
- `ToolDispatcher.php` — Tool routing and execution
- `ToolRegistry.php` — Tool registration
- `ToolResult.php` — Standardized tool response
- `Contracts/ToolHandler.php` — Tool interface

**13 Tools** with RBAC (`public`/`auth`/`admin`):

| UC | Tool | RBAC | Function |
|----|------|------|----------|
| UC1 Shopping | `SearchProductsViaSqlTool` | public | SQL-based product search |
| UC1 Shopping | `AddToCartTool` | auth | Add item to cart |
| UC1 Shopping | `QuickBuyRedirectTool` | auth | Direct checkout redirect |
| UC1 Shopping | `CheckOrderStatusTool` | auth | Look up the user's most recent orders |
| UC2 Print | `ResolvePrintVariantTool` | public | Find matching print variant |
| UC2 Print | `CalculatePrintCostTool` | public | Calculate print job cost |
| UC2 Print | `CreatePrintCartItemTool` | auth | Add print item to cart |
| UC3 Inventory | `ScanCriticalStockTool` | admin | Scan low-stock products |
| UC3 Inventory | `SuggestSupplierTool` | admin | Suggest suppliers for restock |
| UC3 Inventory | `CreatePurchaseDraftTool` | admin | Auto-create purchase draft |
| UC4 BI | `AggregateBusinessMetricsTool` | admin | Revenue/order/product KPIs |
| UC4 BI | `TopEmployeePerformanceTool` | admin | Top performers query |
| UC4 BI | `ExportReportTool` | admin | Generate report download URL |

**Key rules**:
- All write actions require explicit user confirmation (enforced in system prompt)
- Tool invocations are audited in `ai_tool_calls` table
- Tests mock `AIAgentService` — no real Gemini calls

## Console Commands (27)

Located in `app/Console/Commands/`. Key commands:

| Command | Purpose |
|---------|---------|
| `ai:scan-critical-stock` | Scheduled AI stock health check (daily) |
| `test:realtime-stock` / `debug:realtime-stock` / `test:manual-realtime` | Realtime stock testing |
| `test:dashboard` / `stress:dashboard` / `integration:dashboard` | Dashboard testing |
| `test:reports` | Report profit calculation testing |
| `migrate:new-variant-system` (alias `MigrateToNewVariantSystem`) | Migrate legacy variants to new system |
| `fix:print-file-storage` (alias `FixPrintFileStorage`) | Fix print file storage paths |
| `fix:employee-performance` (alias `FixEmployeePerformanceCommand`) | Fix employee performance data |
| `employee:list` (alias `ListEmployeePerformance`) | List employee performance records |
| `diagnose:employee-tracking` (alias `DiagnoseEmployeeTrackingCommand`) | Debug employee tracking |
| `EmptyDatabase` | Empty all tables |

Plus stress/debug/test commands for: bonus system, dual-input system, variants, print service, employee performance page, order 142/143, admin access simulation.

## Helpers (autoloaded via `composer.json`)

`app/helpers.php`:
- `format_uang($value)` — Format as Indonesian currency (Rp 1.000.000)
- `terbilang($value)` — Convert number to Indonesian words
- `tanggal_indonesia($date)` — Format date in Indonesian locale
- `tambah_nol_didepan($value, $threshold)` — Zero-pad numbers

## Key Integrations

| Service | Package | Config | Env |
|---------|---------|--------|-----|
| Midtrans | `midtrans/midtrans-php` | `config/midtrans.php` | `MIDTRANS_*` |
| RajaOngkir | binderbyte + komerce API | `config/ongkir.php` | `RAJAONGKIR_*` |
| Google Gemini | Custom client | `config/ai.php` | `GEMINI_*` |
| Cloudinary | `cloudinary-labs/cloudinary-laravel` | - | `CLOUDINARY_*` |
| Instagram | `socialiteproviders/instagram` | `config/instagram.php` | `INSTAGRAM_*` |
| Instagram Basic | `socialiteproviders/instagram-basic` | - | - |
| Shopping Cart | `hardevine/shoppingcart` | `config/cart.php` | Facade: `Cart` |
| DataTables | `yajra/laravel-datatables-oracle` | `config/datatables.php` | Server-side tables |
| Excel | `maatwebsite/excel` | `config/excel.php` | Import/export |
| PDF | `barryvdh/laravel-dompdf` | `config/dompdf.php` | Invoice/report generation |
| Barcode | `milon/barcode` | - | Product barcode generation |
| QR Code | `simplesoftwareio/simple-qrcode` | - | QR code generation |
| Sluggable | `cviebrock/eloquent-sluggable` | `config/sluggable.php` | Auto-slug for Product, Category, Brand |
| Sanctum | `laravel/sanctum` | `config/sanctum.php` | API token auth |
| SweetAlert | `realrashid/sweet-alert` | - | Admin UI notifications |
| Debugbar | `barryvdh/laravel-debugbar` | `config/debugbar.php` | Dev debugging |
| Socialite | `laravel/socialite` | - | OAuth providers |
| Guzzle | `guzzlehttp/guzzle` | - | HTTP client |

## Database Seeders

Located in `database/seeders/`:

`AdminSeeder`, `UserSeeder`, `CategorySeeder`, `ProductSeeder`, `SettingSeeder`, `AttributeSeeder`, `BrandSeeder`, `BrandSeederNew`, `ProductVariantSeeder`, `ProductVariantSeederNew`, `PrintServiceProductSeeder`, `EmployeePerformanceSeeder`

## Exports & Imports

**Exports** (`app/Exports/`):
- `ReportRevenue` — Revenue report Excel export
- `ReportProduct` — Product report Excel export
- `ReportPayment` — Payment report Excel export
- `ReportInventory` — Inventory report Excel export
- `ProductTemplateExport` — Product import template
- `ProductSheetExport` — Product data sheet
- `LaporanExport` — General report export
- `CategorySheetExport` — Category data sheet

**Imports** (`app/Imports/`):
- `ProdukImport` — Product import from Excel

## Views Structure

`resources/views/` mirrors the controller layout: `admin/` (one folder per CRUD area), `frontend/` (auth, carts, orders, products, shop, smart-print, wishlists), plus `ai/`, `instagram/`, `print-service/`, `errors/`, `layouts/`. Discoverable directly; nothing in here works differently from a normal Laravel Blade tree.

## Form Requests

- `app/Http/Requests/AI/AIChatRequest.php` (used by both AI surfaces)
- `app/Http/Requests/Admin/{Attribute,AttributeOption,AttributeVariant,Category,ProductImage,Product,Slide}Request.php`
- `app/Http/Requests/Admin/ProductRequest_updated.php` is **legacy** — the live one is `ProductRequest.php`
- `app/Http/Requests/ProfileUpdateRequest.php`

## What's NOT in this repo

- No CI/CD (no `.github/`)
- No `.env.example` (copy from working `.env`)
- No lint, format, or typecheck script wired into `package.json` or `composer.json`
- No SQLite test DB; `phpunit.xml` runs against the real MySQL DB
