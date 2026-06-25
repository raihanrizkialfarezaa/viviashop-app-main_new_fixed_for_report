
## BAB IV
## PELAKSANAAN KEGIATAN YANG RELEVAN DENGAN KONVERSI MATA KULIAH

## 4.1 Aktivitas Harian yang Dikerjakan Selama di Mitra

Berikut adalah rincian aktivitas harian selama periode magang, disusun per bulan berdasarkan logbook yang telah disubmit ke sistem Mobilitas Akademik UNESA. Total durasi: **960 jam** selama 96 hari kerja (rata-rata 10 jam/hari).

---

### Tabel 1. Aktivitas Harian Januari 2026 (Minggu ke-4 s/d ke-5)

| Minggu | Posisi | Topik | Durasi (jam) | Target | Metode |
|---|---|---|---|---|---|
| 4 | Developer Magang | Onboarding: setup lingkungan development, meliputi instalasi Laravel, Node.js, konfigurasi database MySQL, orientasi codebase Viviashop | 10 | Lingkungan development berjalan di lokal | Observasi + studi dokumen |
| 4 | Developer Magang | Eksplorasi struktur Models (Product, Order, Category, EmployeePerformance) untuk membaca relasi antar model Eloquent | 10 | Memahami alur data utama sistem | Studi dokumen internal |
| 4 | Developer Magang | Belajar routing Laravel dengan menelusuri `routes/web.php` (1.151 baris), memahami middleware `AdminMiddleware` | 10 | Mampu menavigasi sistem routing | Studi dokumen + observasi |
| 4 | Developer Magang | Eksplorasi Admin `ProductController` dan `OrderController` untuk memahami pola CRUD, debugging error halaman produk | 10 | Bisa menjalankan fitur produk & order di lokal | Studi kode + debugging |
| 5 | Developer Magang | Mempelajari sistem variant produk, meliputi `Attribute`, `AttributeOption`, `AttributeVariant`, `ProductVariant`, `ProductAttributeValue` | 10 | Memahami relasi many-to-many varian | Studi kode + percobaan |
| 5 | Developer Magang | Belajar import/export data pada folder `app/Exports/`, `ProdukImport` (Laravel Excel), serta mencoba export produk ke Excel | 10 | Export produk berhasil | Studi kode + percobaan |

**Subtotal Januari 2026: 60 jam**

---

### Tabel 2. Aktivitas Harian Februari 2026

| Minggu | Posisi | Topik | Durasi (jam) | Target | Metode |
|---|---|---|---|---|---|
| 1 | Developer Magang | Setup fitur integrasi Instagram melalui `InstagramController`, OAuth flow, Facebook Developer Console | 10 | Memahami alur otorisasi Instagram | Studi kode + observasi |
| 1 | Developer Magang | Implementasi Login & Register, dengan eksplorasi `Auth/LoginController`, `RegisterController`, testing registrasi + fix validasi password | 10 | Alur auth berfungsi normal | Studi kode + testing |
| 1 | Developer Magang | Debugging `OrderController` (Admin) untuk memperbaiki eager loading relasi `OrderItem` yang hilang, tambah alert warning order belum bayar | 10 | Halaman order admin normal | Debugging |
| 1 | Developer Magang | Membuat fitur filter kategori di halaman produk customer menggunakan Ajax, `Frontend/ProductController`, fix route yang missing | 10 | Filter produk berjalan tanpa reload | Coding + debugging |
| 2 | Developer Magang | Pengenalan sistem AI Agent dengan membaca `GeminiClient`, `AIAgentService`, `ToolDispatcher`, uji `ScanCriticalStockTool` di chatbot | 10 | Memahami arsitektur AI agent | Studi kode + testing |
| 2 | Developer Magang | Testing Smart Print pada `SmartPrintConverterController`, `SmartPrintVariantService`, debug penyimpanan file (`FixPrintFileStorage` command) | 10 | Alur print order berjalan | Testing + debugging |
| 2 | Developer Magang | Testing modul Pembelian dan Supplier pada `PembelianController`, `PembelianDetailController`, coba export `LaporanExport` | 10 | Data pembelian tersimpan & dapat diekspor | Testing |
| 2 | Developer Magang | Eksplorasi Employee Performance pada `EmployeePerformanceController` (12 method), `EmployeePerformance`, `EmployeeBonus` | 10 | Memahami alur perhitungan bonus | Studi kode + observasi |
| 3 | Developer Magang | Belajar Artisan Command kustom dengan studi `app/Console/Commands/` (27 command), buat command log aktivitas sendiri | 10 | Command kustom berjalan di terminal | Coding + studi kode |
| 3 | Developer Magang | Implementasi upload gambar produk dengan `CloudinaryController`, `ProductImage`, konfigurasi API key, fix CORS | 10 | Upload gambar ke Cloudinary berhasil | Coding + debugging |
| 3 | Developer Magang | Diskusi arsitektur AI Tools mengenai `ToolRegistry`, `ToolDispatcher`, pola `ToolHandler` contract; implementasi tool sederhana (jam server) | 10 | Tool baru terdaftar dan berfungsi | Diskusi + coding |
| 3 | Developer Magang | Debug Cart dengan analisis duplikasi `CartControllerNew` vs `CartController`, perbaiki route, tambah update quantity via Ajax | 10 | Cart berjalan tanpa duplikasi | Debugging + refaktor |
| 4 | Developer Magang | Belajar integrasi Midtrans dengan membaca route payment, setup sandbox di `.env`, debug signature key | 10 | Simulasi transaksi berhasil | Studi kode + debugging |
| 4 | Developer Magang | Perbaikan dashboard admin untuk mengatasi grafik Chart.js yang tidak muncul, perbaiki endpoint API di `DashboardController` | 10 | Dashboard informatif dan normal | Debugging + coding |
| 4 | Developer Magang | Testing Stock Card pada `StockCardController`, `StockMovement`, `RekamanStok`; uji endpoint `ProductVariantController` API | 10 | Mutasi stok tercatat dengan benar | Testing |
| 4 | Developer Magang | Implementasi Testimonials dan Slide menggunakan `TestimonialsController`, `SlideController`, carousel `OwlCarousel` di frontend | 10 | Homepage lebih hidup dengan slider | Coding |

**Subtotal Februari 2026: 160 jam**

---

### Tabel 3. Aktivitas Harian Maret 2026

| Minggu | Posisi | Topik | Durasi (jam) | Target | Metode |
|---|---|---|---|---|---|
| 1 | Developer Magang | Debug API routes pada `api.php`, `ProductVariantController`; perbaiki query kolom yang tidak ada, uji dengan Postman | 10 | Semua endpoint API normal | Debugging |
| 1 | Developer Magang | Belajar modul Supplier dan PembelianDetail pada `SupplierController`, buat supplier baru, tambah Ajax search supplier | 10 | Supplier tersimpan dan bisa dicari | Coding + debugging |
| 1 | Developer Magang | Membantu migrasi sistem variant baru dengan menjalankan command `MigrateToNewVariantSystem`, update `ProductVariantService`, bersihkan data lama | 10 | Sistem variant baru kompatibel | Coding + testing |
| 1 | Developer Magang | Implementasi laporan revenue dan export PDF menggunakan `ReportController`, `ReportRevenue`, filter tanggal, integrasi DomPDF | 10 | Laporan revenue bulanan bisa diunduh | Coding |
| 2 | Developer Magang | Sistem shipment tracking menggunakan `ShipmentController`, RajaOngkir API, test hitung ongkir, tambah status pengiriman di admin | 10 | Kalkulasi ongkir berfungsi | Debugging + coding |
| 2 | Developer Magang | Debug wishlist pada `WishListController`, fix JavaScript error (route name salah), Ajax add/remove tanpa reload | 10 | Wishlist berfungsi tanpa reload | Debugging |
| 2 | Developer Magang | Setup environment production meliputi konfigurasi `.env`, `php artisan key:generate`, `storage:link`, migrate, cek firewall DB | 10 | Aplikasi siap di server production | DevOps |
| 2 | Developer Magang | Testing Print Type dan Paper Type pada `PrintTypeController`, `PaperTypeController`, `PrintOrder`; uji `CalculatePrintCostTool` | 10 | Alur smart print terverifikasi | Testing |
| 3 | Developer Magang | Code review + refaktor `AttributeVariantController` untuk memisahkan logic ke service, diskusi repository pattern dengan senior | 10 | Controller lebih ramping | Refaktor + diskusi |
| 3 | Developer Magang | Implementasi Form Request validation pada `AttributeRequest`, terapkan ke controller, custom error message | 10 | Validasi input lebih user-friendly | Coding |
| 3 | Developer Magang | Export laporan inventori ke Excel dengan `ReportInventory`, tambah kolom stok & harga, optimasi query dengan `chunk()` (5.000 baris) | 10 | Export 5.000 baris berhasil | Coding + optimasi |
| 3 | Developer Magang | Belajar + implementasi `AdminMiddleware` dengan mempelajari cara kerja, buat middleware log aktivitas admin | 10 | Middleware log aktif dan berfungsi | Studi kode + coding |
| 3 | Developer Magang | Debug cetak struk pada model `PrintFile` model, `PrintService` controller, jalankan `FixPrintFileStorage` command | 10 | Cetak struk berjalan lancar | Debugging |
| 4 | Developer Magang | Implementasi rekaman stok pada halaman admin history movement, `StockMovement`, `RekamanStok`, filter tanggal + tipe | 10 | History stok tampil dengan benar | Coding |
| 4 | Developer Magang | Pembuatan dokumentasi API internal dengan mencatat endpoint penting dari route list, parameter & response, dalam format Markdown | 10 | Dokumentasi API tersedia | Dokumentasi |
| 4 | Developer Magang | Testing mandiri AI Agent meliputi `ScanCriticalStockTool` (stok kritis), `CheckOrderStatusTool` (cek pesanan) | 10 | AI menjawab dengan akurat | Testing |
| 4 | Developer Magang | Belajar Event + Listener Laravel pada `EventServiceProvider`, buat `OrderCreated` + `SendNotification`, test dengan order baru | 10 | Event-driven notification berfungsi | Coding |
| 5 | Developer Magang | Testing bonus karyawan dengan `TestBonusSystemCommand`, halaman admin employee performance, fix tampilan summary | 10 | Data performa & bonus tampil benar | Testing + debugging |
| 5 | Developer Magang | Refaktor `StockManagementService` dengan melakukan konsolidasi `updateStock()`, tambah logging untuk debug | 10 | Service lebih modular & konsisten | Refaktor |
| 5 | Developer Magang | Belajar Axios dan Ajax untuk update cart quantity tanpa reload, endpoint `ProductVariantController`, fix CORS | 10 | Cart update real-time berfungsi | Coding + debugging |
| 5 | Developer Magang | Perbaikan PDF laporan dengan inline CSS, tambah logo perusahaan di header laporan PDF | 10 | PDF rapi sesuai standar | Coding |
| 5 | Developer Magang | Debug `DiagnoseEmployeeTrackingCommand` untuk memperbaiki typo kolom DB, jalankan `VerifyEmployeePerformancePageCommand` | 10 | Tracking karyawan normal | Debugging |
| 5 | Developer Magang | Implementasi fitur Attribute dan Opsi pada `AttributeController`, `AttributeOptionController`, Ajax tanpa reload, fix foreign key | 10 | Attribute & opsi dapat dikelola | Coding |
| 5 | Developer Magang | Fitur setting aplikasi (WFA Nyepi) pada `SettingController`, `Setting` model, cache helper, pengaturan toko | 10 | Pengaturan toko tersimpan & tampil | Coding |
| 5 | Developer Magang | Slide homepage pada `SlideController`, fitur urutan + aktif/nonaktif, fix responsive `OwlCarousel` | 10 | Slider homepage responsif | Coding |
| 5 | Developer Magang | Implementasi `SuggestSupplierTool` (WFA Idul Fitri) dengan mendaftarkannya ke `ToolRegistry`, unit test | 10 | Tool AI rekomendasi supplier aktif | Coding + testing |
| 5 | Developer Magang | Refaktor `PromptBuilder` + `Context` AI (WFA Idul Fitri) agar pembangunan prompt lebih dinamis, tambah context produk & order | 10 | Jawaban AI lebih relevan | Refaktor |

**Subtotal Maret 2026: 270 jam**

---

### Tabel 4. Aktivitas Harian April 2026

| Minggu | Posisi | Topik | Durasi (jam) | Target | Metode |
|---|---|---|---|---|---|
| 1 | Developer Magang | Testing + fixing modul PrintService, dengan debugging `PrintSession`, validasi file upload (tipe & ukuran) | 10 | Alur print order lancar | Testing + debugging |
| 1 | Developer Magang | PHPUnit testing dengan test `ProductController.index`, factory `Product`, jalankan `php artisan test` | 10 | Semua test case passing | Testing |
| 1 | Developer Magang | Implementasi modul Pengeluaran dengan `PengeluaranController`, `Pengeluaran` model, laporan keuangan (pemasukan vs pengeluaran) | 10 | Laporan keuangan sederhana tersedia | Coding |
| 1 | Developer Magang | Optimasi N+1 query `ProductController` dengan eager loading image/category/variant, pagination; load time: 5 detik → 1 detik | 10 | Halaman produk cepat | Optimasi |
| 2 | Developer Magang | Belajar Vite meliputi `npm run dev` hot reload, `npm run build` production bundle, edit CSS real-time | 10 | Alur asset compilation dipahami | Studi + percobaan |
| 2 | Developer Magang | Migrasi database ke server staging melalui ekspor lokal → import server, fix collation MySQL | 10 | Database staging siap | DevOps |
| 2 | Developer Magang | Testing alur order frontend → payment Midtrans, serta memperbaiki session hilang di `OrderController` (Frontend) | 10 | Order berhasil dan redirect ke sukses | Testing + debugging |
| 2 | Developer Magang | Refaktor `CategoryController` menjadi `CategoryService` dan menambahkan DataTables (sort + search) di admin | 10 | Controller ramping, view interaktif | Refaktor |
| 3 | Developer Magang | Implementasi fitur restock pada `ProductInventory`, `StockMovement`, notifikasi stok tipis via `ScanCriticalStockTool` | 10 | Stok terupdate dan tercatat | Coding |
| 3 | Developer Magang | Debug error 500 production (WFA Jumat Agung) pada remote server, cek log, jalankan `storage:link`, pasang log viewer | 10 | Error 500 teratasi | Debugging + DevOps |
| 3 | Developer Magang | Testing reset password + verifikasi email pada `ForgotPasswordController`, `ResetPasswordController`, fix token tidak valid | 10 | Alur reset password lancar | Testing + debugging |
| 3 | Developer Magang | Fitur profile user + upload avatar Cloudinary (WFA Paskah) pada `ProfileController`, validasi nama & email | 10 | User bisa update data diri | Coding |
| 3 | Developer Magang | Fitur brand produk menggunakan model `Brand` (sudah ada), buat halaman admin, tambah `brand_id` di form produk, update relasi `Product` | 10 | Produk bisa dikaitkan dengan brand | Coding |
| 4 | Developer Magang | Export laporan produk ke PDF menggunakan `ReportProduct`, DomPDF, tabel nama/kategori/harga/stok, filter kategori | 10 | PDF laporan produk rapi | Coding |
| 4 | Developer Magang | Debug checkout dan ongkir pada `CartController` (Frontend), fix API key RajaOngkir di `.env` | 10 | Ongkir muncul dan total sesuai | Debugging |
| 4 | Developer Magang | Finalisasi AI Agent untuk customer dengan mengintegrasikan chatbot ke frontend, sesuaikan dengan `AIAgentService` | 10 | Chatbot menjawab pertanyaan produk | Coding + testing |
| 4 | Developer Magang | Code review modul print dan refaktor `PrintServiceController`, serta menambahkan unit test `CalculatePrintCostTool` | 10 | Modul print siap staging | Refaktor + testing |
| 5 | Developer Magang | Belajar deployment manual dengan clone repo ke server, setup `.env`, `composer install`, migrate, setup cron `artisan schedule:run` | 10 | Panduan deployment tersedia | Dokumentasi + DevOps |
| 5 | Developer Magang | Export data user ke Excel menggunakan `UserExport`, filter role, tambah tombol di halaman admin user | 10 | Data user dapat diekspor | Coding |
| 5 | Developer Magang | Caching menggunakan `Cache` facade, TTL 10 menit, cache tag per kategori, load time halaman produk berkurang | 10 | Caching aktif dan efektif | Coding + optimasi |
| 5 | Developer Magang | Finalisasi laporan keuangan bulanan menggunakan `ReportController`, `LaporanExport`, grafik pendapatan & pengeluaran (Chart.js) | 10 | Laporan keuangan informatif | Coding |
| 5 | Developer Magang | Refaktor + bersihkan command console dengan memeriksa 27 command diperiksa, hapus duplikasi, tambah deskripsi | 10 | Folder Commands lebih rapi | Refaktor |
| 5 | Developer Magang | Dokumentasi pengguna meliputi panduan login, belanja, checkout, lacak pesanan dalam format Markdown | 10 | User manual tersedia untuk customer | Dokumentasi |
| 5 | Developer Magang | Belajar logging Laravel dengan Log Viewer, channel `daily`, tambah log di beberapa controller untuk tracking error | 10 | Error lebih mudah dilacak | Coding |
| 5 | Developer Magang | Testing dual input system menggunakan `TestDualInputSystemCommand`, `StressDualInputSystemCommand`, fix sinkronisasi di `OrderController` | 10 | Dual input order + print berfungsi | Testing + debugging |
| 5 | Developer Magang | Perbaikan UI/UX homepage pada navbar responsive, animasi hover CSS, lazy loading gambar produk | 10 | Tampilan homepage lebih modern | Coding |
| 5 | Developer Magang | SweetAlert2 untuk mengganti alert standar dengan SweetAlert di aksi: simpan, konfirmasi hapus, error validasi | 10 | Notifikasi lebih interaktif | Coding |
| 5 | Developer Magang | Finalisasi debugging sebelum launch dengan memeriksa semua fitur: order, produk, pembayaran, print, laporan; fix bug minor | 10 | Semua fitur siap untuk launch | Testing + debugging |

**Subtotal April 2026: 280 jam**

---

### Tabel 5. Aktivitas Harian Mei s.d. Juni 2026

| Minggu | Posisi | Topik | Durasi (jam) | Target | Metode |
|---|---|---|---|---|---|
| 1 | Developer Magang | Perbaikan dashboard admin untuk mengatasi grafik Chart.js tidak muncul, perbaiki URL API di JavaScript, tambah fallback data | 10 | Dashboard loading dengan baik | Debugging |
| 1 | Developer Magang | Mempelajari AI Agent system secara mendalam meliputi `GeminiClient`, `AIAgentService`, `ConversationStore`, 13 tool, pola `ToolDispatcher` | 10 | Memahami alur lengkap AI agent | Studi kode |
| 1 | Developer Magang | Implementasi `ScanCriticalStockTool` dengan integrasi ke route AI agent, fix format output, demo ke tim | 10 | Tool stok kritis siap digunakan | Coding + testing |
| 1 | Developer Magang | Perbaikan checkout (WFA Kenaikan Yesus) pada `CartControllerNew`, fix mismatch perubahan model `Shipment` | 10 | Checkout pilih alamat normal | Debugging |
| 2 | Developer Magang | Refactor `StockManagementService` untuk menggabungkan logika update stok dari order & pembelian, tambah unit test | 10 | Service stok konsisten | Refaktor + testing |
| 2 | Developer Magang | Testing modul Pembelian pada `PembelianController`, `PembelianDetail`, fix bug rounding subtotal di helper | 10 | Subtotal pembelian akurat | Testing + debugging |
| 2 | Developer Magang | Eksplorasi fitur laporan tambahan menggunakan `ReportController`, `ReportRevenue` Excel, tambah filter tanggal | 10 | Filter laporan berfungsi | Coding |
| 2 | Developer Magang | Bug fix halaman produk customer pada `Frontend/ProductController`, fix Cloudinary URL, tambah fallback gambar default | 10 | Gambar produk tampil normal | Debugging |
| 3 | Developer Magang | Setup integrasi Midtrans dengan konfigurasi sandbox di `.env`, debug signature key, simulasi flow pembayaran | 10 | Flow pembayaran berhasil disimulasikan | Testing + debugging |
| 3 | Developer Magang | Modul karyawan pada `EmployeePerformanceController`, input data bonus, jalankan `DiagnoseEmployeeTrackingCommand`, fix query anomali | 10 | Data karyawan akurat | Debugging |
| 3 | Developer Magang | Perbaikan slider homepage dan testimonial pada `SlideController`, `storage:link`, fix path gambar, tambah validasi rating | 10 | Slider dan testimonial normal | Debugging |
| 3 | Developer Magang | Optimasi query varian produk pada `ProductVariantController`, fix eager loading, tambah indexing DB; test 1.000 produk dummy | 10 | Load time turun signifikan | Optimasi |
| 4 | Developer Magang | Finalisasi Smart Print converter pada `SmartPrintVariantController`, `SmartPrintVariantService`, mock data RajaOngkir | 10 | Fitur smart print siap uji coba tim | Testing |
| 4 | Developer Magang | Testing E2E alur order menggunakan akun dummy, tambah ke cart, checkout, bayar Midtrans sandbox, cek callback URL | 10 | Alur order E2E berjalan | Testing |
| 4 | Developer Magang | Perbaikan modul stok (WFA Idul Adha) pada `StockMovement` reversal saat barang dikembalikan, `StockService`, tampilan stock card | 10 | Reversal stok berfungsi | Debugging + coding |
| 5 | Developer Magang | Update production app dengan setup `.env` production, migrate, `npm run build` (Vite), fix permission storage | 10 | App production terupdate | DevOps |
| 5 | Developer Magang | Final testing + bug fixing, seperti perbaikan `WishListController` (tidak sinkron setelah login), update dependencies `package.json` | 10 | Semua on track sebelum rilis | Testing + debugging |
| 5 | Developer Magang | Dokumentasi teknis + handover dengan menulis di Notion: alur AI agent, setup Midtrans, panduan QA; review kode rekan | 10 | Dokumentasi handover lengkap | Dokumentasi |
| 5 | Developer Magang | Kerja Remote finalisasi laporan akhir (WFA Hari Pancasila) dengan melakukan final push repo, update README, cek semua fitur di staging, pamit tim | 10 | Laporan selesai, magang berakhir | Dokumentasi |

**Subtotal Mei s.d. Juni 2026: 190 jam**

---

**Total Akumulatif: 60 + 160 + 270 + 280 + 190 = 960 jam**

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**
