# 📚 Dokumentasi Teknis - Viviashop

**Periode Magang:** Januari - Juni 2026
**Terakhir diupdate:** 22 Juni 2026

---

## 🤖 AI Agent System

### Overview

Viviashop menggunakan custom AI agent berbasis Google Gemini API untuk membantu customer dalam berbelanja dan admin dalam mengelola inventory.

### Arsitektur

```
┌─────────────┐
│   User      │
└──────┬──────┘
       │ HTTP Request
       ▼
┌─────────────────────┐
│  AIAgentService     │ ← Main orchestrator
├─────────────────────┤
│ - GeminiClient      │ ← API client
│ - ConversationStore │ ← Session management
│ - ToolDispatcher    │ ← Tool routing
│ - ToolRegistry      │ ← Tool registration
└──────┬──────────────┘
       │
       ▼
┌─────────────────────────────────┐
│         13 Tools                │
├─────────────────────────────────┤
│ UC1: Shopping                   │
│ - SearchProductsViaSqlTool      │
│ - AddToCartTool                 │
│ - QuickBuyRedirectTool          │
│ - CheckOrderStatusTool          │
│                                 │
│ UC2: Print Service              │
│ - ResolvePrintVariantTool       │
│ - CalculatePrintCostTool        │
│ - CreatePrintCartItemTool       │
│                                 │
│ UC3: Inventory Management       │
│ - ScanCriticalStockTool         │
│ - SuggestSupplierTool           │
│ - CreatePurchaseDraftTool       │
│                                 │
│ UC4: Business Intelligence      │
│ - AggregateBusinessMetricsTool  │
│ - TopEmployeePerformanceTool    │
│ - ExportReportTool              │
└─────────────────────────────────┘
```

### Konfigurasi

File: `config/ai.php`

```php
return [
    'gemini_api_key' => env('GEMINI_API_KEY'),
    'model' => env('GEMINI_MODEL', 'gemini-1.5-pro'),
    'max_tokens' => env('GEMINI_MAX_TOKENS', 8192),
];
```

### RBAC (Role-Based Access Control)

| Tool | Public | Auth | Admin |
|------|--------|------|-------|
| SearchProductsViaSqlTool | ✅ | ✅ | ✅ |
| AddToCartTool | ❌ | ✅ | ✅ |
| QuickBuyRedirectTool | ❌ | ✅ | ✅ |
| CheckOrderStatusTool | ❌ | ✅ | ✅ |
| ResolvePrintVariantTool | ✅ | ✅ | ✅ |
| CalculatePrintCostTool | ✅ | ✅ | ✅ |
| CreatePrintCartItemTool | ❌ | ✅ | ✅ |
| ScanCriticalStockTool | ❌ | ❌ | ✅ |
| SuggestSupplierTool | ❌ | ❌ | ✅ |
| CreatePurchaseDraftTool | ❌ | ❌ | ✅ |
| AggregateBusinessMetricsTool | ❌ | ❌ | ✅ |
| TopEmployeePerformanceTool | ❌ | ❌ | ✅ |
| ExportReportTool | ❌ | ❌ | ✅ |

### Testing

```bash
# Unit tests
php vendor/bin/phpunit tests/Unit/AI

# Feature tests
php vendor/bin/phpunit tests/Feature/AI/AIChatTest.php
```

> ⚠️ **Penting:** Semua write actions memerlukan explicit user confirmation (enforced in system prompt). Tests mock `AIAgentService` — no real Gemini calls.

---

## 💳 Midtrans Payment Integration

### Setup & Credentials

**Environment Variables:**

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxx
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

> ⚠️ **CRITICAL:** Production credentials ada di `.env` yang di-commit. Jangan echo secret values! Jangan commit perubahan ke `.env`.

### Flow Pembayaran

```
User Checkout → Create Order → Midtrans Snap Token → Payment Page
                                                           │
                               ┌───────────────────────────┘
                               ▼
                        Payment Success/Failed
                               │
                               ▼
                   Webhook ke /payments/notification
                               │
                               ▼
                   Update Order Status (pending → paid/failed)
                               │
                               ▼
                         Reduce Stock (if paid)
```

### Payment Statuses

| Status | Keterangan |
|--------|-----------|
| `pending` | Order dibuat, belum bayar |
| `paid` | Pembayaran berhasil |
| `failed` | Pembayaran gagal |
| `expired` | Payment link expired |

### Webhook Handler

File: `app/Http/Controllers/Frontend/PaymentController.php`

```php
public function notification(Request $request)
{
    $notif = $request->all();
    $orderId = $notif['order_id'];
    $status = $notif['transaction_status'];

    $order = Order::where('code', $orderId)->first();

    if ($status == 'capture' || $status == 'settlement') {
        $order->payment_status = Order::PAID;
        $order->status = Order::CONFIRMED;
        // Reduce stock
    } else if ($status == 'pending') {
        $order->payment_status = Order::UNPAID;
    } else if ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
        $order->payment_status = Order::FAILED;
    }

    $order->save();
}
```

### Testing di Sandbox

**Test Card Numbers:**

| Card Number | 3DS | Result |
|-------------|-----|--------|
| 4811 1111 1111 1114 | Yes | Success |
| 4911 1111 1111 1113 | Yes | Challenge |
| 4411 1111 1111 1118 | No | Success |

**OTP untuk 3DS:** `112233`

### CSRF Exemption

File: `app/Http/Middleware/VerifyCsrfToken.php`

```php
protected $except = [
    'payments/notification',
    'payments/completed',
    'payments/failed',
    'payments/unfinish',
];
```

---

## 📦 Fitur Stock Opname

### Overview

Fitur untuk melakukan stock taking - membandingkan stok sistem dengan stok fisik, lalu menyesuaikan.

### Lokasi File

| File | Path |
|------|------|
| Controller | `app/Http/Controllers/Admin/StockOpnameController.php` |
| View | `resources/views/admin/stock-opname/index.blade.php` |
| Route | `/admin/stock-opname` |
| Command | `app/Console/Commands/TestStockOpnameCommand.php` |

### Flow

```
1. Admin buka /admin/stock-opname
2. Sistem load semua produk dengan stok saat ini
3. Admin input stok fisik untuk setiap produk
4. Sistem hitung selisih (physical - system) secara real-time
5. Admin klik "Proses Opname"
6. Sistem update stok:
   - Simple product → ProductInventory.qty
   - Configurable product → ProductVariant.stock (distribusi proporsional)
7. Catat di StockMovement (reason: inventory_correction)
8. Catat di RekamanStok (stok_awal, stok_sisa)
```

### Model yang Digunakan

**StockMovement** (`stock_movements`)

| Column | Type | Keterangan |
|--------|------|-----------|
| `variant_id` | FK | Reference ke product_variants |
| `movement_type` | enum | `in` / `out` |
| `quantity` | int | Jumlah pergerakan |
| `old_stock` | int | Stok sebelum |
| `new_stock` | int | Stok sesudah |
| `reason` | string | `inventory_correction` |
| `notes` | text | Catatan tambahan |

**RekamanStok** (`rekaman_stoks`)

| Column | Type | Keterangan |
|--------|------|-----------|
| `product_id` | FK | Reference ke products |
| `waktu` | timestamp | Waktu opname |
| `stok_awal` | int | Stok sistem sebelum |
| `stok_sisa` | int | Stok setelah opname |
| `stok_masuk` | int | (opsional) |
| `stok_keluar` | int | (opsional) |

### Logic Distribusi Stok (Configurable Products)

Jika produk punya 3 varian dengan stok [10, 20, 30] (total 60), dan physical stock = 90:

```
ratio = 90 / 60 = 1.5

variant1: 10 × 1.5 = 15
variant2: 20 × 1.5 = 30
variant3: 30 × 1.5 = 45
─────────────────────────
Total:                 90 ✅
```

### Testing

```bash
# Simulasi opname (transaction rollback — aman)
php artisan test:stock-opname

# Simulasi dengan custom adjustment range
php artisan test:stock-opname --adjust=10
```

---

## 📄 Fitur PDF Report Tester

### Overview

Tool untuk testing PDF report generation. Bisa diakses via UI admin atau artisan command.

### Lokasi File

| File | Path |
|------|------|
| Controller Methods | `app/Http/Controllers/Admin/ReportController.php` (`productPdf`, `testPdfUI`, `runPdfTest`) |
| Testing UI View | `resources/views/admin/reports/test-pdf.blade.php` |
| PDF Template | `resources/views/admin/reports/exports/pdf_product.blade.php` |
| Route | `/admin/reports/test-pdf` |
| Command | `app/Console/Commands/TestPdfReportCommand.php` |

### Flow

```
1. User buka /admin/reports/test-pdf
2. Pilih date range (start/end)
3. Klik "Run Test"
4. AJAX POST ke /admin/reports/test-pdf/run
5. Backend:
   - Query product report data (reuse dari ReportController@product)
   - Generate PDF dengan DOMPDF (barryvdh/laravel-dompdf)
   - Measure generation time & file size
6. Return JSON response
7. Frontend display results + metrics cards
```

### Response Format

**Success:**

```json
{
  "success": true,
  "status_code": 200,
  "message": "PDF berhasil digenerate",
  "file_size": "245 KB",
  "file_size_bytes": 250880,
  "generation_time": "1.23s",
  "num_products": 15,
  "download_url": "/admin/reports/product/pdf?start=...&end=..."
}
```

**Error:**

```json
{
  "success": false,
  "status_code": 500,
  "message": "View [admin.reports.exports.pdf_product] not found",
  "generation_time": "0.05s",
  "error_file": "app/Http/Controllers/Admin/ReportController.php",
  "error_line": 133,
  "code_snippet": "..."
}
```

### UI Features

- Date range picker (start/end)
- "Run Test" button dengan loading state
- Metrics cards: Status, HTTP Code, File Size, Generation Time
- Total Products counter + Download PDF link
- PDF Preview simulation (stylized table preview)
- Error display dengan code snippet + syntax highlighting

### Command Output

```bash
$ php artisan test:pdf-report

============================================
       PDF REPORT TESTER
============================================

1. Memeriksa registrasi route...
   ✅ Route "admin.reports.product.pdf" terdaftar

2. Men-generate PDF product report...
   Periode: 2026-06-01 - 2026-06-30
   📦 Data produk: 15 produk ditemukan
   ✅ PDF berhasil di-generate

3. Hasil Test:
   ┌─────────────────────────────────────┐
   │              RESULT                  │
   ├─────────────────────────────────────┤
   │  Status      : ✅ Success            │
   │  HTTP Code   : 200 OK                │
   │  File Size   :                2.45 KB │
   │  Time        :                  0.18s │
   │  Products    :                     15 │
   └─────────────────────────────────────┘

   💾 PDF tersimpan di: storage/app/reports/report-products.pdf
```

### Error Output

```bash
$ php artisan test:pdf-report

============================================
       PDF REPORT TESTER
============================================

1. Memeriksa registrasi route...
   ✅ Route "admin.reports.product.pdf" terdaftar

2. Men-generate PDF product report...

   ❌ Gagal meng-generate PDF

   Error: View [admin.reports.exports.pdf_product] not found
   File: /app/Http/Controllers/Admin/ReportController.php
   Line: 133
   Time: 0.05s

3. Error Analysis:

   📄 app/Http/Controllers/Admin/ReportController.php:133
   ────────────────────────────────────────────────────────────
      130:         $fileName = 'report-product-' . $startDate . '-' . $endDate . '.pdf';
      131:         $pdf = PDF::loadView('admin.reports.exports.pdf_product', compact(...));
      132:
   >> 133:         return $pdf->download($fileName);
      134:     }
   ────────────────────────────────────────────────────────────

❌ PDF Report Test FAILED
```

---

## 🧪 Panduan Testing untuk QA Team

### Preparation

**Database Seeding**

```bash
php artisan migrate:fresh --seed
```

**Test Accounts**

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@viviashop.com | password |
| Customer | customer@viviashop.com | password |

**Environment**

| Command | Description |
|---------|-------------|
| `php artisan serve` | Start server → http://localhost:8000 |
| `npm run dev` | Vite hot reload (CSS/JS) |

---

### Test Cases: Stock Opname

**TC001: Load Stock Opname Page**
1. Navigate to `/admin/stock-opname`
2. **Expected:** Table dengan list produk, stok sistem (kolom), input stok fisik
3. **Verify:** Produk ter-load sesuai data di database

**TC002: Input Physical Stock (Increase)**
1. Set physical stock untuk produk "AMPLOP" dari 2000 → 2100
2. **Expected:** Difference badge berubah jadi `+100` dengan warna hijau
3. **Verify:** Counter "changed" bertambah 1

**TC003: Input Physical Stock (Decrease)**
1. Set physical stock untuk produk lain dari 50 → 30
2. **Expected:** Difference badge berubah jadi `-20` dengan warna merah
3. **Verify:** Field input berubah warna (highlight kuning)

**TC004: Process Opname (Multiple Changes)**
1. Set physical stock berbeda untuk 3+ produk
2. Click **Proses Opname**
3. **Expected:** Loading spinner → success alert muncul
4. **Verify:**
   ```sql
   SELECT * FROM rekaman_stoks ORDER BY id DESC LIMIT 3;
   SELECT * FROM stock_movements WHERE reason = 'inventory_correction' ORDER BY id DESC LIMIT 3;
   ```

**TC005: Configurable Product — Show Variants**
1. Cari produk dengan badge "Configurable"
2. Klik icon 👁️ (eye) di samping nama produk
3. **Expected:** Modal muncul dengan detail varian (paper_size, print_type, stock)
4. **Verify:** Data varian sesuai dengan database

**TC006: Configurable Product — Process Opname**
1. Set physical stock untuk produk configurable
2. Proses opname
3. **Expected:** Stok terdistribusi proporsional ke semua varian
4. **Verify:** Sum of all variant stocks = physical stock yang di-input

**TC007: No Changes — Skip**
1. Klik **Proses Opname** tanpa mengubah apapun
2. **Expected:** Alert "Tidak ada perubahan stok untuk diproses"
3. **Verify:** Tidak ada data baru di rekaman_stoks / stock_movements

**TC008: Reset Form**
1. Ubah beberapa physical stock
2. Klik **Reset**
3. **Expected:** Semua input kembali ke nilai system stock, difference = 0
4. **Verify:** Counter "changed" = 0

**TC009: Select/Deselect Products**
1. Uncheck beberapa checkbox produk
2. Klik **Proses Opname**
3. **Expected:** Hanya produk yang ter-check yang diproses
4. **Verify:** Data di database sesuai dengan produk yang dicentang

**TC010: Select All Checkbox**
1. Uncheck "Select All" di header tabel
2. **Expected:** Semua checkbox produk ikut ter-uncheck
3. Click "Select All" lagi → semua ter-check kembali

**TC011: Artisan Command (Simulation)**
```bash
php artisan test:stock-opname
php artisan test:stock-opname --adjust=10
```
1. **Expected:** Console output dengan tabel produk, adjustment, result
2. **Verify:** Output menunjukkan "Transaction rolled back — no actual changes"
3. **Verify:** Database tidak berubah

---

### Test Cases: PDF Report Tester

**TC101: Load PDF Tester Page**
1. Navigate to `/admin/reports/test-pdf`
2. **Expected:** Date range pickers (Start Date, End Date), "Run Test" button
3. **Verify:** Default dates = start of month / end of month

**TC102: Run Test (Success)**
1. Klik **Run Test**
2. **Expected:**
   - Status badge: "Running..." (warna warning, animasi pulse)
   - Loading spinner muncul
   - Setelah 1-5 detik: Status berubah "Success" (hijau)
   - Metrics cards: HTTP 200, File Size, Generation Time, Total Products
   - Preview tabel produk muncul
   - Download PDF link aktif

**TC103: Download PDF**
1. Setelah test sukses, klik **Download PDF**
2. **Expected:** Browser download file `report-product-YYYY-MM-DD-YYYY-MM-DD.pdf`
3. **Verify:** Buka file PDF — struktur sesuai (header, period, tabel data, footer)

**TC104: Custom Date Range**
1. Set start: `2026-01-01`, end: `2026-01-31`
2. Click **Run Test**
3. **Expected:** Product count berbeda dengan default (month to date)
4. **Verify:** File size juga berbeda

**TC105: Run Test — No Data**
1. Set date range ke periode tanpa transaksi
2. Click **Run Test**
3. **Expected:** Success tetap (PDF tetap di-generate), Total Products = 0
4. **Verify:** Preview table kosong

**TC106: Artisan Command**
```bash
php artisan test:pdf-report
php artisan test:pdf-report --start=2026-01-01 --end=2026-01-31
```
1. **Expected:** Output dengan ANSI colors (hijau/merah/kuning), box ASCII formatting
2. **Verify:** route check, query, generation time, file size
3. **Verify:** `storage/app/reports/report-products.pdf` tersimpan

**TC107: Artisan Command — Route Not Found**
- Jika route dihapus, command harus mendeteksi dan memberi warning
- **Expected:** "⚠️ Route `admin.reports.product.pdf` tidak ditemukan"

---

### Test Cases: Midtrans Payment (Sandbox)

**TC201: Checkout Flow**
1. Add product to cart
2. Proceed to checkout
3. Fill shipping information
4. Pilih payment method "Midtrans"
5. Click "Pay Now"
6. **Expected:** Redirect ke Midtrans Snap Payment Page

**TC202: Successful Payment**
1. Di Snap page, masukkan test card:
   - Card Number: `4811 1111 1111 1114`
   - CVV: `123`
   - Expiry: `01/27`
2. Click "Pay"
3. Jika diminta 3DS OTP: `112233`
4. **Expected:** Redirect ke halaman success
5. **Verify:**
   - Order status: `paid`
   - Payment status: `paid`
   - Stock produk berkurang
   - Email confirmation terkirim

**TC203: Failed Payment**
1. Gunakan card yang akan decline atau batalkan di tengah
2. **Expected:** Redirect ke halaman failed
3. **Verify:**
   - Order status: `failed` atau tetap `pending`
   - Stock TIDAK berkurang

**TC204: Webhook Notification**
```bash
curl -X POST http://localhost:8000/payments/notification \
  -H "Content-Type: application/json" \
  -d '{
    "order_id": "ORD-001",
    "transaction_status": "settlement",
    "payment_type": "credit_card",
    "gross_amount": "150000.00"
  }'
```
1. **Expected:** Response 200 OK
2. **Verify:** Order status di database berubah sesuai payload

**TC205: CSRF Exemption**
1. Coba POST ke `/payments/notification` tanpa CSRF token
2. **Expected:** Berhasil 200 (bukan 419)
3. **Verify:** File `VerifyCsrfToken.php` sudah include path-nya

---

### Test Cases: AI Agent

**TC301: Product Search (Public)**
1. Buka `/ai/chat`
2. Chat: "Cari printer Brother"
3. **Expected:** AI menjawab dengan daftar produk Brother dari database
4. **Verify:** Tool `SearchProductsViaSqlTool` terpanggil

**TC302: Product Search — Not Found**
1. Chat: "Cari produk XYZ123"
2. **Expected:** AI menjawab produk tidak ditemukan

**TC303: Add to Cart (Unauthenticated — Should Fail)**
1. Sebagai guest (belum login), chat: "Tambahkan AMPLOP 10 pcs ke cart"
2. **Expected:** AI merespons "Please login first" atau sejenisnya
3. **Verify:** Tool `AddToCartTool` tidak dipanggil (RBAC)

**TC304: Add to Cart (Authenticated)**
1. Login sebagai customer
2. Chat: "Tambahkan AMPLOP 10 pcs ke cart"
3. **Expected:** AI mengkonfirmasi item ditambahkan ke cart
4. **Verify:** Cart berisi produk AMPLOP dengan qty 10

**TC305: Check Order Status**
1. Login, chat: "Cek status pesanan terbaru saya"
2. **Expected:** AI menampilkan status order terakhir user
3. **Verify:** Tool `CheckOrderStatusTool` terpanggil

**TC306: Stock Check (Admin Only)**
1. Login sebagai admin, chat: "Produk apa yang stoknya kritis?"
2. **Expected:** AI menjawab dengan list produk low stock
3. **Verify:** Tool `ScanCriticalStockTool` terpanggil

**TC307: Business Metrics (Admin Only)**
1. Login sebagai admin
2. Chat: "Tampilkan revenue bulan ini"
3. **Expected:** AI menampilkan grafik/metrik revenue
4. **Verify:** Tool `AggregateBusinessMetricsTool` terpanggil

**TC308: Print Service — Calculate Cost**
1. Chat: "Berapa harga print A4 BW?"
2. **Expected:** AI menjawab dengan perhitungan biaya print
3. **Verify:** Tool `CalculatePrintCostTool` terpanggil

**TC309: Print Service — Create Cart Item**
1. Login, chat: "Saya mau print 10 lembar A4 warna"
2. **Expected:** AI menambahkan print item ke cart
3. **Verify:** Tool `CreatePrintCartItemTool` terpanggil

---

### Bug Report Template

```
Bug ID: BUG-XXX
Severity: Critical / High / Medium / Low
Module: Stock Opname / PDF Tester / Payment / AI Agent
Environment: Local / Staging / Production
Browser (if relevant): Chrome / Firefox / Edge

Steps to Reproduce:
1. ...
2. ...
3. ...

Expected Result:
...

Actual Result:
...

Screenshots / Screen Recording:
[Attach]

Console Errors / Logs:
```

Log yang perlu dicek:
```bash
# Laravel log
storage/logs/laravel.log

# Browser console
F12 → Console tab

# Network requests
F12 → Network tab
```

---

## 📝 Code Review Notes (22 Juni 2026)

**Review untuk:** `feature/variant-price-calculation`

| | |
|---|---|
| **Reviewed by** | [Nama Anda] |
| **Date** | 22 Juni 2026 |
| **Branch** | `feature/variant-price-calculation` |
| **Files** | 5 modified, 2 new |

### ✅ Approved dengan Minor Suggestions

**Strengths:**
- Logic perhitungan variant price sudah benar
- Test coverage bagus (85%)
- Code readable, well-structured
- Mengikuti pattern yang sudah ada (ProductVariantService)

**Suggestions:**

**1. Performance Concern** (`ProductVariantService.php:125`)

```php
// Current (N+1 query — akan query database berulang kali)
foreach ($product->variants as $variant) {
    $variant->attributes; // lazy load per variant
}

// Suggested (eager load sekali)
$product->load('variants.attributes');
foreach ($product->variants as $variant) {
    $variant->attributes; // already loaded, no extra query
}
```

**2. Edge Case Handling** (`calculatePrice()` method)

Perlu handle case ketika `base_price = 0` — bisa return error atau fallback ke default price untuk menghindari division by zero.

**3. Documentation**

Add PHPDoc untuk method `distributePrice()` — explain algoritma distribusi proporsional dan parameter-parameternya.

**4. Test Coverage**

| Missing Test | Impact |
|-------------|--------|
| Variant dengan price multiplier = 0 | Division by zero |
| Product tanpa variants | Empty collection |
| Negative price | Validasi gagal |

**Action Items:**
- [ ] Fix N+1 query issue (eager loading)
- [ ] Add edge case handling untuk base_price = 0
- [ ] Add PHPDoc untuk method `distributePrice()`
- [ ] Add missing test cases
- [ ] Run full test suite sebelum merge
- [ ] Re-request review

---

## ⚙️ Catatan Penting Lainnya

### Environment Setup

```bash
# Install dependencies
composer install
npm install

# Setup environment
php artisan key:generate

# Database
php artisan migrate
php artisan db:seed

# Development
php artisan serve    # http://127.0.0.1:8000
npm run dev

# Production build
npm run build
```

### Database Notes

- MySQL dengan user `root` dan empty password (Laragon default)
- DB connection ada dua: `mysql` (main) dan `mysql_readonly` (untuk AI SQL tools)
- `strict: false` dengan explicit modes di `config/database.php`
- Tidak ada SQLite fallback

### Important Files

| File | Notes |
|------|-------|
| `.env` | Contains real production credentials — **DO NOT COMMIT** |
| `routes/web.php` | 1163 lines — auth/admin/frontend mixed |
| `app/helpers.php` | Autoloaded helpers (format_uang, terbilang, etc.) |
| `AGENTS.md` | Agent guide with full project context |

### Credentials yang Ada di `.env`

- Midtrans LIVE keys (`MIDTRANS_IS_PRODUCTION=true`)
- Cloudinary API keys
- Gemini API key
- Instagram OAuth credentials
- RajaOngkir API keys

> ⚠️ **Treat all payment/Instagram/Cloudinary calls from dev as hitting PRODUCTION!**

### Legacy Duplicates — Jangan Diedit Blindly

| Live Version | Legacy Version |
|-------------|----------------|
| `CartController.php` | `CartControllerNew.php` |
| `ProductRequest.php` | `ProductRequest_updated.php` |
| `BrandSeeder.php` | `BrandSeederNew.php` |
| `ProductVariantSeeder.php` | `ProductVariantSeederNew.php` |

### Stock Tracking — Tiga Tempat

| Table | Untuk |
|-------|-------|
| `product_inventories` | Non-variant (simple) products |
| `product_variants.stock` | Per-variant (configurable) products |
| `stock_movements` | Audit log semua perubahan stok |

### CSV Exemptions (from CSRF)

```
- payments/notification
- payments/completed
- payments/failed
- payments/unfinish
```

---

## 🎓 Lessons Learned

### Technical

1. **Transaction Management** penting untuk data consistency — Stock Opname menggunakan `DB::transaction()` agar atomic
2. **CSRF Exemption** diperlukan untuk webhook dari third-party (Midtrans notification)
3. **Chunked Write Protocol** untuk file >300 lines — strategi write file besar dengan split
4. **RBAC di AI Agent** harus ditest thoroughly — setiap tool punya akses level berbeda
5. **Eager Loading** penting untuk performance — hindari N+1 query
6. **DOMPDF** untuk PDF generation — config paper size, orientation, dan output

### Best Practices

1. Selalu **rollback** di artisan command testing untuk avoid data corruption
2. **Mock external API** (Gemini, Midtrans) di unit tests agar tidak kena rate limit / biaya
3. **Log semua payment transactions** untuk debugging dan audit trail
4. **Validate input** di controller AND request class — defense in depth
5. **Jangan commit .env** — selalu gunakan `.env.example`
6. **Gunakan named routes** (`route('admin.xxx')`) daripada hardcoded URL

### Debugging Tips

```bash
# 1. Check Laravel log
tail -f storage/logs/laravel.log

# 2. Verify routes
php artisan route:list --path=admin

# 3. Quick DB queries
php artisan tinker
> Product::count()
> Order::where('status', 'pending')->get();

# 4. Debug AJAX
# Chrome DevTools → Network tab → XHR filter

# 5. Clear caches
php artisan config:clear
php artisan route:clear
php artisan cache:clear

# 6. Check route names
php artisan route:list --name=admin.stock*

# 7. PHP syntax check
php -l app/Http/Controllers/...php
```

---

## 📚 Resources

### Internal

| Resource | Location |
|----------|----------|
| AGENTS.md | Root project |
| Technical Docs (full) | `DOKUMENTASI_TEKNIS_VIVIASHOP.md` |
| Dokumentasi Magang (ini) | `DOKUMENTASI_MAGANG_VIVIASHOP.md` |

### External

| Service | Documentation |
|---------|---------------|
| Midtrans | https://docs.midtrans.com |
| Google Gemini | https://ai.google.dev/docs |
| Laravel 10 | https://laravel.com/docs/10.x |
| DOMPDF | https://github.com/dompdf/dompdf |
| Yajra DataTables | https://yajrabox.com/docs/laravel-datatables |
| Maatwebsite Excel | https://docs.laravel-excel.com |
| Cloudinary | https://cloudinary.com/documentation/laravel |

---

## 🙏 Penutup

> Senang bisa menyelesaikan magang dengan baik. Semua fitur yang dikerjakan sudah ter-deliver, tested, dan documented. Tim QA bisa langsung pakai panduan ini untuk testing.
>
> Terima kasih atas kesempatan belajar dan berkontribusi di project Viviashop!

---

*Dokumentasi ini dibuat sebagai referensi untuk maintenance dan knowledge transfer.*
*Last updated: 22 Juni 2026*
