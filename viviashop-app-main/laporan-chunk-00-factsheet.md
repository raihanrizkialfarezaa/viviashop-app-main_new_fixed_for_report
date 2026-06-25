
# FACT SHEET VIVIASHOP  -  CHUNK 0
# Sumber Kebenaran Tunggal  -  Jangan diubah tanpa koreksi eksplisit

========== FACT SHEET VIVIASHOP ==========

## IDENTITAS PROJECT

- **Nama project:** Viviashop (platform e-commerce & print service)
- **Judul resmi proyek:** Pengembangan Sistem Terintegrasi E-Commerce dan ERP Viviashop Berbasis Arsitektur Hybrid Cloud dan Pemrosesan Terdistribusi
- **Nama perusahaan/mitra resmi:** CV Sinar Agung Jaya
- **Alamat mitra:** Tebu Ireng IV No.38, Cukir, Kec. Diwek, Kabupaten Jombang, Jawa Timur 61471
- **Bidang usaha mitra:** Manufaktur dan penyedia solusi terintegrasi  -  pengadaan ATK & on-demand printing, solusi TI (hardware + software web), konveksi kebutuhan event & operasional
- **Jenis aplikasi:** Web application  -  e-commerce B2C + print service + ERP admin panel + AI chatbot
- **Framework utama:** Laravel 10 (PHP 8.1+)
- **Frontend:** Blade templates + Bootstrap 4 + jQuery + Vite (bundler)
- **Database:** MySQL (u875841990_viviashop, driver: mysql, strict: false)
- **Bahasa:** PHP 8.1+, JavaScript, SCSS
- **Asset bundler:** Vite  -  entry: `resources/sass/app.scss` + `resources/js/app.js`
- **Auth:** Laravel Auth scaffold (laravel/ui), session-based, AdminMiddleware (`is_admin` boolean flag)

---

## IDENTITAS MAHASISWA

- **Nama:** Raihan Rizki Alfareza
- **NIM:** 23051204067
- **Program Studi:** S1 Teknik Informatika
- **Fakultas:** Teknik
- **Universitas:** Universitas Negeri Surabaya (UNESA)
- **No. Telepon:** 085155228237
- **Email:** raihan.23067@mhs.unesa.ac.id
- **Alamat:** Jl. Ketintang Wiyata Gedung A10, Ketintang, Gayungan, Surabaya, East Java 60231

---

## IDENTITAS PEMBIMBING & KOORDINATOR

- **Dosen Pembimbing Lapangan:** I Made Suartana, S.Kom., M.Kom.
- **NIP DPL:** 198411242015041003
- **Pembimbing Mitra:** Fanani Agung Widyanto
- **Identitas Pembimbing Mitra:** (tidak tersedia  -  dikosongkan di lembar pengesahan)
- **Koordinator Program Studi:** Paramitha Nerisafitra, S.ST., M.Kom.
- **NIP Koordinator Prodi:** 198905292019032013
- **Tahun Laporan:** 2026

---

## PERIODE MAGANG

- **Periode resmi:** 26 Januari 2026 s/d 1 Juni 2026
- **Total durasi jam (dari logbook):** 960 jam (57.600 menit)
- **Hari pertama logbook:** 2026-01-26 (Onboarding & Setup Development)
- **Hari terakhir logbook:** 2026-06-01 (Kerja Remote Finalisasi Laporan)
- **Total entri logbook:** 96 entri

---

## MATA KULIAH KONVERSI (dari report-administration-data.json)

1. Magang Perencanaan Program  -  2 SKS
2. Magang Evaluasi Program  -  2 SKS
3. Web Semantik  -  3 SKS
4. Verifikasi dan Validasi Perangkat Lunak  -  3 SKS
5. Konstruksi Perangkat Lunak  -  3 SKS
6. Analisis dan Desain Perangkat Lunak  -  4 SKS
7. Virtualisasi dan Komputasi Awan  -  3 SKS
Total: 20 SKS

---

## MODEL / ENTITY (dari app/Models/  -  35 model)

Product, Category, Brand, Order, OrderItem, Cart, Payment, User,
ProductVariant, ProductImage, ProductInventory, ProductAttributeValue,
Attribute, AttributeOption, AttributeVariant, VariantAttribute,
Supplier, Pembelian, PembelianDetail, Pengeluaran,
StockMovement, RekamanStok,
PrintSession, PrintFile, PrintOrder, PrintType, PaperType,
EmployeePerformance, EmployeeBonus,
AiToolCall, Setting, Slide, Testimonial, Shipment, WishList

---

## CONTROLLER / HANDLER (dari app/Http/Controllers/)

### Admin (23 controller):
ProductController, CategoryController, BrandController, OrderController,
AttributeController, AttributeOptionController, AttributeVariantController,
DashboardController, ReportController, SlideController, TestimonialsController,
StockCardController, EmployeePerformanceController,
PrintServiceController (Admin), SmartPrintConverterController,
PrintTypeController, PaperTypeController, UserController,
CloudinaryController (Root), InstagramController (Root)

### Root (10 controller):
AIAgentController, CloudinaryController, InstagramController,
PembelianController, PembelianDetailController, PengeluaranController,
PrintServiceController (Root), SettingController, SupplierController, Controller

### Frontend (7 controller):
ProductController (Frontend), OrderController (Frontend),
CartController, CartControllerNew (legacy), WishListController,
CheckoutController, ShipmentController

### API (1 controller):
ProductVariantController

### Auth (7 controller):
LoginController, RegisterController, ForgotPasswordController,
ResetPasswordController, VerificationController, ProfileController, ConfirmPasswordController

---

## SERVICE LAYER (app/Services/)

| Service | Fungsi |
|---|---|
| StockManagementService | Cek ketersediaan, reduce/restore stok, reason tracking |
| StockService | Rekaman movement stok, kalkulasi stok realtime |
| PrintService | Upload file cetak, kalkulasi biaya, order, payment pipeline |
| ProductVariantService | Pembuatan produk konfigurabel, variant generation |
| SmartPrintVariantService | Auto-detect/fix paper_size / print_type untuk print variants |

---

## AI AGENT SYSTEM (app/Services/AI/  -  13 tool)

**Stack:** Google Gemini API  -  `config/ai.php`, env: `GEMINI_API_KEY`
**File inti:** AIAgentService.php, GeminiClient.php, ConversationStore.php, Context.php, PromptBuilder.php, ToolDispatcher.php, ToolRegistry.php, ToolResult.php

**Tools (13):**

| Tool | RBAC | Fungsi |
|---|---|---|
| SearchProductsViaSqlTool | public | SQL-based product search |
| AddToCartTool | auth | Tambah item ke cart |
| QuickBuyRedirectTool | auth | Redirect langsung ke checkout |
| CheckOrderStatusTool | auth | Cek status pesanan user |
| ResolvePrintVariantTool | public | Cari matching print variant |
| CalculatePrintCostTool | public | Kalkulasi biaya cetak |
| CreatePrintCartItemTool | auth | Tambah item cetak ke cart |
| ScanCriticalStockTool | admin | Scan produk stok kritis |
| SuggestSupplierTool | admin | Rekomendasi supplier untuk restock |
| CreatePurchaseDraftTool | admin | Auto-create draft pembelian |
| AggregateBusinessMetricsTool | admin | KPI revenue/order/produk |
| TopEmployeePerformanceTool | admin | Query top performer karyawan |
| ExportReportTool | admin | Generate URL download laporan |

**Dua surface:** `/ai/chat` (frontend, no auth) dan `/admin/ai-assistant/chat` (admin, is_admin guard)

---

## FITUR YANG TERIDENTIFIKASI (dengan sumber)

1. **Autentikasi multi-level**  -  `app/Http/Controllers/Auth/`, `AdminMiddleware.php`
2. **Manajemen Produk + Variant + Attribute**  -  `Admin/ProductController.php`, `AttributeController.php`, `AttributeOptionController.php`, `ProductVariant.php`, `ProductAttributeValue.php`
3. **Sistem Keranjang & Checkout**  -  `CartController.php`, `CartControllerNew.php` (legacy), `Frontend/OrderController.php`
4. **Integrasi Pembayaran Midtrans**  -  `config/midtrans.php`, routes `payments/notification`, `payments/completed`
5. **Print Service**  -  `PrintServiceController.php`, `PrintService.php`, `PrintSession.php`, `PrintFile.php`, `PrintOrder.php`, `PrintType.php`, `PaperType.php`
6. **Smart Print**  -  `SmartPrintConverterController.php`, `SmartPrintVariantService.php`
7. **Upload Gambar Cloudinary**  -  `CloudinaryController.php`, `ProductImage.php`
8. **Manajemen Stok (3 layer)**  -  `ProductInventory.php`, `ProductVariant.stock`, `StockMovement.php`, `RekamanStok.php` (legacy), `StockManagementService.php`, `StockService.php`
9. **Modul Pembelian/Pengadaan**  -  `PembelianController.php`, `PembelianDetailController.php`, `SupplierController.php`, `Pengeluaran.php`
10. **Employee Performance & Bonus**  -  `EmployeePerformanceController.php`, `EmployeePerformance.php`, `EmployeeBonus.php`
11. **AI Agent Chatbot**  -  seluruh `app/Services/AI/`, `AIAgentController.php`
12. **Laporan & Export**  -  `ReportController.php`, `Exports/ReportRevenue.php`, `ReportProduct.php`, `ReportPayment.php`, `ReportInventory.php`, `LaporanExport.php`, DomPDF
13. **Import Data**  -  `Imports/ProdukImport.php`
14. **Integrasi RajaOngkir/Komerce**  -  `config/ongkir.php`, `ShipmentController.php`
15. **Integrasi Instagram**  -  `InstagramController.php`, `config/instagram.php`
16. **Slide & Testimonial Homepage**  -  `SlideController.php`, `TestimonialsController.php`
17. **Dashboard Admin**  -  `DashboardController.php` + Chart.js di frontend
18. **Wishlist**  -  `WishListController.php`
19. **Pengaturan Toko**  -  `SettingController.php`, `Setting.php`
20. **27 Artisan Commands**  -  termasuk `ScanCriticalStockCommand`, `FixPrintFileStorage`, `MigrateToNewVariantSystem`, `DiagnoseEmployeeTrackingCommand`, dll.

---

## INTEGRASI EKSTERNAL

| Layanan | Package/Konfigurasi |
|---|---|
| Midtrans (payment) | `midtrans/midtrans-php`, `config/midtrans.php` |
| RajaOngkir / Komerce | `config/ongkir.php` |
| Google Gemini AI | Custom `GeminiClient.php`, `config/ai.php` |
| Cloudinary | `cloudinary-labs/cloudinary-laravel` |
| Instagram Graph API | `socialiteproviders/instagram`, `config/instagram.php` |
| Laravel Excel | `maatwebsite/excel`  -  import/export |
| DomPDF | `barryvdh/laravel-dompdf`  -  cetak PDF |
| DataTables | `yajra/laravel-datatables-oracle` |
| Sanctum | `laravel/sanctum`  -  API auth |
| SweetAlert2 | `realrashid/sweet-alert` |
| Chart.js | Frontend  -  grafik dashboard |
| OwlCarousel | Frontend  -  slider homepage |

---

## RINGKASAN AKTIVITAS LOGBOOK (96 entri, 960 jam total)

### Januari 2026 (Minggu 4 - 5: 26 - 31 Jan)
- 26 Jan: Onboarding, setup dev environment, Laravel + Node.js + DB config
- 27 Jan: Eksplorasi Models (Product, Order, Category, EmployeePerformance)
- 28 Jan: Belajar routing Laravel + AdminMiddleware
- 29 Jan: Eksplorasi Admin ProductController + OrderController
- 30 Jan: Sistem Variant Produk (Attribute, AttributeOption, ProductVariant)
- 31 Jan: Import/Export Laravel Excel (Exports/, ProdukImport)

### Februari 2026 (Minggu 1 - 4)
- 02 Feb: Instagram Integration (InstagramController, OAuth flow)
- 03 Feb: Login/Register Laravel Auth
- 04 Feb: Debug OrderController  -  eager loading OrderItem
- 05 Feb: Filter produk frontend  -  Ajax, Frontend/ProductController
- 06 Feb: Pengenalan AI Agent (GeminiClient, ToolDispatcher, SearchProductsViaSqlTool, ScanCriticalStockTool)
- 07 Feb: Testing Smart Print (SmartPrintConverterController, FixPrintFileStorage command)
- 09 Feb: Testing modul Pembelian + Supplier (PembelianController, LaporanExport)
- 10 Feb: Eksplorasi Employee Performance (EmployeePerformanceController, EmployeeBonus)
- 11 Feb: Belajar Artisan Command kustom (Commands/: FixPrintFileStorage, ScanCriticalStockCommand)
- 12 Feb: Upload gambar produk Cloudinary (CloudinaryController, ProductImage)
- 13 Feb: Diskusi arsitektur AI Tools (ToolRegistry, ToolDispatcher, ToolHandler contract)
- 14 Feb: Debug Cart (CartControllerNew vs CartController duplikasi)
- 16 Feb: Belajar payment Midtrans + debug signature key
- 17 Feb: Perbaikan dashboard admin  -  Chart.js, DashboardController, endpoint API baru
- 18 Feb: Testing Stock Card (StockCardController, StockMovement, RekamanStok)
- 19 Feb: Fitur Testimonials + Slide (TestimonialsController, SlideController, OwlCarousel)
- 20 Feb: Debug API routes (api.php, ProductVariantController API)
- 21 Feb: Modul Supplier + PembelianDetail (SupplierController, Ajax search)
- 23 Feb: Migrasi sistem variant baru (MigrateToNewVariantSystem command, ProductVariantService)
- 24 Feb: Laporan revenue + export PDF (ReportController, ReportRevenue, DomPDF)
- 25 Feb: Shipment tracking (ShipmentController, RajaOngkir API)
- 26 Feb: Debug wishlist (WishListController, Ajax fix)
- 27 Feb: Setup environment production (php artisan key:generate, storage:link, migrate)
- 28 Feb: Testing Print Type, Paper Type, CalculatePrintCostTool

### Maret 2026 (Minggu 1 - 5)
- 02 Mar: Code review + refaktor AttributeVariantController
- 03 Mar: Form Request validation (AttributeRequest, ProductRequest)
- 04 Mar: Export laporan inventori (ReportInventory, chunk query optimization)
- 05 Mar: Belajar AdminMiddleware + buat middleware log aktivitas
- 06 Mar: Debug cetak struk (PrintFile, PrintService, FixPrintFileStorage command)
- 07 Mar: Rekaman stok + history movement (StockMovement, RekamanStok, join query)
- 09 Mar: Dokumentasi API internal (endpoint list, markdown docs)
- 10 Mar: Testing mandiri AI Agent  -  ScanCriticalStockTool, CheckOrderStatusTool
- 11 Mar: Event dan Listener Laravel (OrderCreated, SendNotification)
- 12 Mar: Testing fitur bonus karyawan (TestBonusSystemCommand, EmployeePerformance view)
- 13 Mar: Refaktor StockManagementService (konsolidasi logika updateStock)
- 14 Mar: Axios Ajax  -  update cart quantity, endpoint ProductVariantController, CORS fix
- 16 Mar: Perbaikan cetak PDF laporan (inline CSS, logo perusahaan)
- 17 Mar: Debug DiagnoseEmployeeTrackingCommand  -  typo kolom DB, VerifyEmployeePerformancePageCommand
- 18 Mar: Fitur Attribute + Opsi (AttributeController, AttributeOptionController, Ajax)
- 19 Mar: Fitur Setting aplikasi (SettingController, Setting model, cache helper  -  WFA Nyepi)
- 20 Mar: Slide homepage  -  SlideController, urutan + aktif/nonaktif, OwlCarousel responsive
- 21 Mar: AI tool SuggestSupplierTool  -  ToolRegistry, unit test (WFA Idul Fitri)
- 22 Mar: Refaktor PromptBuilder + Context AI Services (WFA Idul Fitri)
- 23 Mar: Testing + fixing modul PrintService (PrintSession, validasi file upload)
- 24 Mar: PHPUnit testing  -  ProductController index, model factory
- 25 Mar: Modul Pengeluaran (PengeluaranController, Pengeluaran model, laporan keuangan)
- 26 Mar: Optimasi N+1 query ProductController  -  eager loading image/category/variant
- 27 Mar: Belajar Vite  -  npm run dev, npm run build, hot reload CSS
- 28 Mar: Migrasi database ke staging (mysql collation adjustment)
- 30 Mar: Testing alur order frontend → payment Midtrans (session bug fix)
- 31 Mar: Refaktor CategoryController + CategoryService (datatable, sort/search)

### April 2026 (Minggu 1 - 4)
- 02 Apr: Fitur restock produk (ProductInventory, StockMovement, ScanCriticalStockTool notifikasi)
- 03 Apr: Debug error 500 production  -  storage:link, log viewer (WFA Jumat Agung)
- 04 Apr: Testing reset password + verifikasi email (ForgotPasswordController, token fix)
- 05 Apr: Fitur profile user + upload avatar Cloudinary (ProfileController  -  WFA Paskah)
- 06 Apr: Fitur brand untuk produk (Brand model, relasi Product, halaman admin)
- 08 Apr: Export laporan produk ke PDF (ReportProduct, DomPDF, filter kategori)
- 09 Apr: Debug checkout + ongkir RajaOngkir (CartController, env API key fix)
- 10 Apr: Finalisasi AI Agent untuk customer (chatbot frontend, AIAgentService)
- 11 Apr: Code review modul print + refaktor PrintServiceController (unit test CalculatePrintCostTool)
- 13 Apr: Belajar deployment manual (clone repo, .env, composer install, cron artisan schedule)
- 15 Apr: Export data user ke Excel (UserExport, filter role, admin UI)
- 16 Apr: Caching  -  Cache facade, TTL 10 menit, cache tag per kategori
- 17 Apr: Finalisasi laporan keuangan bulanan (ReportController, LaporanExport, Chart.js)
- 20 Apr: Refaktor + bersihkan command console (27 commands, hapus duplikasi)
- 21 Apr: Dokumentasi pengguna  -  user manual (login, belanja, checkout, lacak pesanan)
- 22 Apr: Logging Laravel  -  Log Viewer, channel daily, log di beberapa controller
- 24 Apr: Testing dual input system (TestDualInputSystemCommand, OrderController sinkronisasi)
- 25 Apr: Perbaikan UI/UX frontend homepage (CSS responsive, animasi hover, lazy loading gambar)
- 27 Apr: SweetAlert2  -  integrasi notifikasi Ajax (sukses, konfirmasi hapus, error)
- 28 Apr: Finalisasi debugging sebelum launch (order, produk, pembayaran, print, laporan)

### Mei - Juni 2026 (Minggu 1 - 5)
- 11 Mei: Perbaikan dashboard admin  -  grafik Chart.js, endpoint DashboardController
- 12 Mei: Mempelajari AI agent system secara mendalam (GeminiClient, AIAgentService, semua tools)
- 13 Mei: Implementasi ScanCriticalStockTool  -  integrasi route, fix format output
- 14 Mei: Perbaikan checkout  -  CartControllerNew, Shipment model mismatch (WFA Kenaikan Yesus)
- 15 Mei: Refactor StockManagementService  -  gabungin logika, unit test stok
- 16 Mei: Testing modul Pembelian (PembelianController, PembelianDetail, bug rounding subtotal)
- 18 Mei: Eksplorasi fitur laporan tambahan (ReportController, ReportRevenue Excel, filter tanggal)
- 19 Mei: Bug fix halaman produk customer  -  Cloudinary URL, fallback gambar default
- 20 Mei: Setup integrasi Midtrans (sandbox, signature key, flow pembayaran)
- 21 Mei: Modul karyawan (EmployeePerformanceController, DiagnoseEmployeeTrackingCommand)
- 22 Mei: Perbaikan slider homepage + testimonial (SlideController, storage:link fix, rating validation)
- 23 Mei: Optimasi query varian produk  -  eager loading fix, database indexing, 1000 produk dummy
- 25 Mei: Finalisasi Smart Print converter (SmartPrintVariantController, mock data RajaOngkir)
- 26 Mei: Testing E2E alur order  -  akun dummy, cart, checkout, Midtrans sandbox, callback URL
- 27 Mei: Perbaikan modul stok  -  StockMovement reversal, stock card mutation display (WFA Idul Adha)
- 28 Mei: Update production app  -  .env production, migrate, Vite compile, storage permission fix
- 29 Mei: Final testing + bug fixing (WishListController sync bug post-login)
- 30 Mei: Dokumentasi teknis + handover (Notion: AI agent flow, Midtrans setup, panduan QA)
- 01 Jun: Finalisasi laporan akhir, final push repo, update README, cek semua fitur di staging (WFA Hari Pancasila)

---

## DESKRIPSI INSTANSI (dari report-administration-data.json)

CV Sinar Agung Jaya merupakan perusahaan manufaktur dan penyedia solusi terintegrasi yang berbasis di Jawa Timur. Tiga pilar bisnis utama:
1. **Pengadaan ATK & On-Demand Printing**  -  cetak kustom, ATK volume besar (B2B/B2C)
2. **Solusi Teknologi Informasi**  -  pengadaan hardware komputer + pengembangan software web
3. **Konveksi Kebutuhan Event & Operasional**  -  tas, rompi, jaket, seragam lapangan

Posisi: mitra vendor Jawa Timur  -  ketepatan spesifikasi, efisiensi pengadaan, standar operasional sektor publik & swasta.

---

## INFORMASI YANG TIDAK TERSEDIA DI KODE/DOKUMENTASI

- Struktur organisasi formal CV Sinar Agung Jaya → [PERLU INPUT MANUAL]
- Identitas formal pembimbing mitra (NIP/jabatan) → dikosongkan sesuai instruksi
- Nilai mata kuliah konversi → belum tersedia, diabaikan
- Foto dokumentasi aktivitas → [PERLU INPUT MANUAL  -  lampiran]
- Surat keterangan magang → [PERLU INPUT MANUAL  -  lampiran]
- Lembar penilaian dari pembimbing mitra → [PERLU INPUT MANUAL  -  lampiran]

==========================================
