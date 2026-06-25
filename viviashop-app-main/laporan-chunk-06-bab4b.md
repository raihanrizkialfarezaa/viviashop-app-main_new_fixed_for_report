
## 4.2 Hasil Proyek yang Telah Dikembangkan

Selama 960 jam magang di CV Sinar Agung Jaya, kontribusi utama saya terdistribusi ke dalam beberapa proyek pengembangan yang saling berkaitan. Karena Viviashop adalah sistem yang sudah berjalan, "proyek" di sini tidak berarti membangun dari nol, melainkan serangkaian intervensi teknis yang masing-masing memiliki tujuan, proses, dan dampak yang teridentifikasi.

---

### Proyek 1: Implementasi dan Pengembangan Sistem AI Agent Berbasis Gemini

**Judul Proyek:** Implementasi, Pengujian, dan Pengembangan Tool AI Agent Viviashop

**Deskripsi Singkat:**

Viviashop memiliki sistem AI agent yang dibangun di atas Google Gemini API. Sistem ini terdiri dari orchestrator (`AIAgentService`), klien HTTP ke Gemini (`GeminiClient`), penyimpan riwayat percakapan (`ConversationStore`), pembangun prompt (`PromptBuilder`), pemroses konteks (`Context`), dan dispatcher tool (`ToolDispatcher` + `ToolRegistry`). Ketika saya bergabung, sebagian besar arsitektur sudah ada, tetapi beberapa tool belum terintegrasi dengan baik dan perlu pengujian menyeluruh. Saya berkontribusi pada integrasi, pengujian, penambahan tool baru, dan perbaikan kualitas prompt.

**Tahapan yang Telah Dikerjakan:**

1. *Mempelajari arsitektur lengkap AI agent*, dengan membaca seluruh file di `app/Services/AI/` untuk memahami alur dari pesan pengguna ke tool call dan kembali ke respons. Pola `ToolDispatcher` yang merutekan pemanggilan tool berdasarkan nama yang diputuskan LLM menjadi temuan teknis yang menarik.
2. *Integrasi `ScanCriticalStockTool` ke dalam route AI agent*, di mana tool ini sudah ada tetapi belum terhubung ke route yang diakses publik. Saya perbaiki konfigurasi dan fix format output-nya agar bisa menampilkan daftar produk dengan stok di bawah ambang minimum secara rapi.
3. *Implementasi `SuggestSupplierTool`*, yaitu tool baru yang memberikan rekomendasi supplier berdasarkan produk yang stoknya kritis. Saya daftarkan ke `ToolRegistry`, uji di chatbot, dan tambahkan unit test sederhana untuk menjaga kualitas.
4. *Refaktor `PromptBuilder` dan `Context`*, untuk memperbaiki cara sistem membangun konteks dari data produk dan order agar jawaban AI lebih relevan dengan situasi terkini di platform.
5. *Pengujian mandiri semua 13 tool*, di mana skenario yang diuji meliputi pencarian produk (`SearchProductsViaSqlTool`), cek status pesanan (`CheckOrderStatusTool`), kalkulasi biaya cetak (`CalculatePrintCostTool`), scan stok kritis (`ScanCriticalStockTool`), dan rekomendasi supplier (`SuggestSupplierTool`).
6. *Integrasi chatbot ke frontend homepage*, untuk menyesuaikan tampilan chatbot dengan antarmuka Viviashop dan memastikan komunikasi antara frontend dan `AIAgentService` berjalan mulus.

**Hasil yang Dicapai:**

- Chatbot AI Viviashop berhasil menjawab pertanyaan produk, cek stok kritis, dan memberikan rekomendasi supplier secara dinamis, yang semuanya melalui tool call yang terkelola oleh `ToolDispatcher`.
- `SuggestSupplierTool` berhasil ditambahkan dan terdaftar di `ToolRegistry` dengan unit test yang passing.
- Format output `ScanCriticalStockTool` diperbaiki sehingga tampil rapi dan mudah dibaca oleh pengguna admin.
- Semua pemanggilan tool diaudit secara otomatis ke tabel `ai_tool_calls`, di mana riwayat ini bisa digunakan untuk monitoring dan debugging.

[FOTO/GAMBAR: Tangkapan layar antarmuka chatbot AI Viviashop yang menampilkan respons ScanCriticalStockTool]

**Dampak Kegiatan:**

- *Divisi/Unit yang Terdampak:* Tim operasional admin (pemantauan stok kritis menjadi lebih efisien), dan pelanggan frontend (bisa mendapat rekomendasi produk melalui chat).
- *Bukti/Output Proyek:* Kode tool di `app/Services/AI/`, unit test, dan entri di tabel `ai_tool_calls` yang terekam setiap kali tool dipanggil.

**Jenis Dampak Mini Proyek:**

*A. Dampak Sosial pada Penelitian dan Inovasi:*
- ☑ Mengembangkan teknologi/produk/konsep inovatif, di mana integrasi LLM (Large Language Model) ke dalam aplikasi e-commerce skala UMKM adalah pendekatan yang masih relatif baru di segmen ini.
- ☑ Menyusun rekomendasi berbasis hasil kajian, di mana `SuggestSupplierTool` menghasilkan rekomendasi berbasis data stok dan riwayat pembelian.

*B. Dampak Ekonomi pada Ekosistem Kewirausahaan:*
- ☑ Peningkatan pendapatan mitra, di mana chatbot yang membantu pelanggan menemukan produk dan melakukan pembelian berpotensi meningkatkan konversi penjualan.
- ☑ Pengembangan produk/jasa baru, yaitu AI agent sebagai fitur layanan baru yang membedakan Viviashop dari platform e-commerce generik.

*C. Keberlanjutan dalam Bidang SDGs:*
- Mendukung SDG 9 (Industri, Inovasi, dan Infrastruktur), khususnya melalui pengembangan infrastruktur digital yang inovatif untuk bisnis skala menengah.
- Ada rencana tindak lanjut: pengembangan lebih lanjut dari `CreatePurchaseDraftTool` dan `AggregateBusinessMetricsTool` untuk keperluan analitik bisnis yang lebih mendalam.

---

### Proyek 2: Optimasi Performa dan Perbaikan Sistem Manajemen Stok

**Judul Proyek:** Optimasi Query Database dan Konsolidasi Sistem Manajemen Stok Viviashop

**Deskripsi Singkat:**

Sistem manajemen stok Viviashop memiliki tiga layer yang beroperasi bersamaan: `ProductInventory` untuk produk non-varian, `ProductVariant.stock` untuk stok per varian, dan `StockMovement` sebagai audit log setiap mutasi. Ada juga `RekamanStok` sebagai model legacy yang tidak disarankan untuk digunakan lagi. Tantangannya: logika update stok tersebar di beberapa tempat, seperti di `OrderController`, di `PembelianController`, dan di beberapa titik lainnya, dengan potensi potensi inkonistensi jika salah satu jalur tidak diperbarui. Di sisi lain, halaman produk admin mengalami masalah N+1 query yang membuat waktu muat mencapai 5 detik.

**Tahapan yang Telah Dikerjakan:**

1. *Identifikasi masalah N+1 query*, dilakukan dengan mengamati log query di Laravel Debugbar, ditemukan bahwa `ProductController` (Admin) memuat setiap gambar, kategori, dan varian produk secara terpisah dalam loop. Ini menghasilkan ratusan query untuk halaman dengan 50 produk.
2. *Implementasi eager loading*, dengan menambahkan `with(['images', 'category', 'variants'])` pada query utama, disertai `pagination()` untuk membatasi jumlah data per halaman.
3. *Pengujian dengan data dummy*, di mana setelah diuji dengan 1.000 produk dummy, waktu muat turun dari sekitar 5 detik menjadi 1 detik.
4. *Refaktor `StockManagementService`*, dengan mengidentifikasi duplikasi metode `updateStock()` yang tersebar. Menggabungkan logika dari berbagai sumber (order dan pembelian) menjadi satu jalur yang konsisten, dengan penambahan logging untuk memudahkan debug.
5. *Implementasi halaman restock*, yaitu membuat halaman admin untuk input penambahan stok ke `ProductInventory` dengan pencatatan alasan yang tersimpan di `StockMovement`.
6. *Perbaikan reversal stok*, karena ditemukan bug di `StockMovement` saat barang dikembalikan, di mana stok tidak dikembalikan dengan benar. Saya tambahkan logika reversal yang tepat di `StockService`.
7. *Optimasi query varian produk* (Mei 2026), di mana halaman admin varian produk juga mengalami masalah serupa. Diperbaiki dengan `join` yang lebih efisien dan penambahan indexing di database.

**Hasil yang Dicapai:**

- Waktu muat halaman produk admin turun dari ~5 detik menjadi ~1 detik, diverifikasi dengan pengujian 1.000 produk dummy.
- `StockManagementService` menjadi satu-satunya sumber kebenaran untuk operasi update stok, sehingga tidak ada lagi duplikasi logika yang tersebar.
- Bug reversal stok saat pengembalian barang berhasil diperbaiki dan diverifikasi.
- Fitur restock produk dengan pencatatan movement tersedia di panel admin.

[FOTO/GAMBAR: Perbandingan waktu muat halaman produk admin sebelum dan sesudah optimasi]

**Dampak Kegiatan:**

- *Divisi/Unit yang Terdampak:* Tim admin yang setiap hari bekerja di panel admin, di mana produktivitas meningkat karena tidak perlu menunggu halaman lambat.
- *Bukti/Output Proyek:* Commit refaktor di repository, log query yang menunjukkan penurunan jumlah query.

**Jenis Dampak Mini Proyek:**

*B. Dampak Ekonomi pada Pengajaran dan Pembelajaran:*
- ☑ Penguatan keterampilan praktis/industri, sebagai pengalaman nyata menerapkan teknik optimasi database yang dipelajari di mata kuliah Analisis dan Desain Perangkat Lunak.
- ☑ Kesesuaian pembelajaran dengan kebutuhan dunia kerja, mengingat masalah N+1 query adalah salah satu masalah paling umum di aplikasi web produksi.

*B. Dampak Ekonomi pada Ekosistem Kewirausahaan:*
- ☑ Peningkatan pendapatan mitra, karena admin yang bekerja lebih cepat berarti lebih sedikit waktu yang terbuang untuk menunggu halaman, dan pengawasan stok yang lebih akurat mengurangi risiko kekurangan atau kelebihan stok.

---

### Proyek 3: Pengembangan Modul Laporan dan Ekspor Data

**Judul Proyek:** Finalisasi dan Pengembangan Modul Laporan Keuangan dan Ekspor Data Viviashop

**Deskripsi Singkat:**

Viviashop memiliki modul laporan yang dikelola oleh `ReportController` dengan dukungan dari delapan kelas ekspor, antara lain `ReportRevenue`, `ReportProduct`, `ReportPayment`, `ReportInventory`, `ProductTemplateExport`, `ProductSheetExport`, `LaporanExport`, dan `CategorySheetExport`. Saya terlibat dalam pengembangan dan penyempurnaan modul ini, dari penambahan filter tanggal hingga perbaikan tampilan PDF dan penambahan fitur export user.

**Tahapan yang Telah Dikerjakan:**

1. *Implementasi filter tanggal di laporan revenue*, dengan menambahkan filter tanggal di `ReportController` sehingga pengguna dapat memilih periode pelaporan.
2. *Export laporan revenue ke PDF*, dilakukan dengan mengintegrasikan `ReportRevenue` dengan DomPDF (`barryvdh/laravel-dompdf`), membuat view PDF dengan tabel yang rapi dan filter yang sesuai.
3. *Export laporan produk ke PDF*, menggunakan `ReportProduct` dengan filter kategori, tabel nama/kategori/harga/stok.
4. *Export laporan inventori ke Excel*, menggunakan `ReportInventory` dengan kolom stok dan harga, optimasi query menggunakan `chunk()` untuk menangani 5.000 baris data.
5. *Finalisasi laporan keuangan bulanan*, yaitu berupa `LaporanExport` dengan grafik pendapatan dan pengeluaran menggunakan Chart.js di frontend, data diambil dari tabel `orders` dan `pengeluarans`.
6. *Export data user ke Excel*, dengan membuat `UserExport`, filter berdasarkan role, dengan kolom yang diekspor yaitu nama, email, role, serta tanggal daftar.
7. *Perbaikan tampilan PDF laporan*, yaitu menambahkan logo perusahaan di header, memperbaiki inline CSS agar styling terbawa ke PDF.

**Hasil yang Dicapai:**

- Laporan revenue, produk, dan inventori dapat diekspor ke Excel dan PDF dengan filter yang berfungsi.
- Export inventori berhasil menangani 5.000 baris data tanpa timeout menggunakan `chunk()`.
- Laporan keuangan bulanan menampilkan grafik yang informatif.
- Data user dapat diekspor ke Excel dengan filter role.

[FOTO/GAMBAR: Tampilan halaman laporan revenue Viviashop dengan grafik dan opsi ekspor]

**Dampak Kegiatan:**

- *Divisi/Unit yang Terdampak:* Manajemen dan tim keuangan CV Sinar Agung Jaya, yang kini memiliki akses ke laporan yang lebih lengkap dan dapat disesuaikan.
- *Bukti/Output Proyek:* File laporan Excel dan PDF yang dapat diunduh dari panel admin.

**Jenis Dampak Mini Proyek:**

*B. Dampak Ekonomi pada Penelitian dan Pertukaran Pengetahuan:*
- ☑ Penyebaran pengetahuan kepada mitra/industri, di mana laporan yang terstruktur membantu manajemen dalam pengambilan keputusan berbasis data.
- ☑ Peningkatan inovasi dan nilai tambah ekonomi, karena laporan keuangan yang lebih baik mendukung analisis profitabilitas yang lebih akurat.

---

## 4.3 Pembahasan Mengenai Relevansi dengan Keilmuan Program Studi

Pengalaman bekerja pada platform Viviashop selama 960 jam memberikan kesempatan untuk mengamati langsung bagaimana konsep-konsep yang dipelajari di Program Studi Teknik Informatika UNESA bekerja, dan kadang tidak bekerja, dalam konteks sistem produksi nyata.

**Rekayasa Perangkat Lunak dalam Skala Nyata.** Pressman (2014) dan Sommerville (2019) sama-sama menekankan pentingnya pemisahan tanggung jawab (*separation of concerns*) sebagai prinsip utama dalam desain perangkat lunak. Di Viviashop, prinsip ini diimplementasikan melalui *service layer* (lima service utama), *form request* untuk validasi (10 kelas di `app/Http/Requests/`), dan pemisahan antara namespace Admin, Frontend, dan Api untuk controller. Namun di sisi lain, saya juga menemukan beberapa pelanggaran prinsip ini yang sudah ada sebelum saya bergabung: logika bisnis yang tersebar di controller, duplikasi di `StockManagementService`, dan controller yang terlalu panjang seperti `EmployeePerformanceController` dengan 12 method. Gap antara teori dan realitas ini tidak berarti sistem itu buruk, melainkan mencerminkan kenyataan bahwa sistem yang dibangun di bawah tekanan waktu selalu membawa technical debt yang perlu dikelola.

**Database dan Query Optimization.** Teori relational database yang dipelajari di kuliah memberikan fondasi untuk memahami masalah N+1 query di Viviashop, tetapi pengalaman aktual menambahkan dimensi yang tidak ada di kelas: bagaimana mengukur masalahnya (Laravel Debugbar), bagaimana menentukan solusi yang paling tepat (eager loading vs. join), dan bagaimana memverifikasi hasilnya dengan data nyata (1.000 produk dummy). Menurut Date (2004), indexing adalah salah satu teknik optimasi paling fundamental dalam sistem database relasional, di mana penerapannya di query varian produk mengkonfirmasi hal ini secara langsung.

**Integrasi API dan Arsitektur Layanan.** Pengalaman bekerja dengan tiga integrasi API berbeda (Midtrans, RajaOngkir, Google Gemini) mengajarkan hal yang jarang dibahas di kelas: bagaimana menangani kegagalan API secara *graceful*, bagaimana mengelola credential di `.env` untuk lingkungan yang berbeda, dan bagaimana men-debug masalah yang terjadi di batas sistem (seperti signature key Midtrans yang tidak valid karena perbedaan format string). Richardson dan Ruby (2007) menyebut tantangan ini sebagai "batas sistem terbuka", sehingga menghadapinya langsung memberikan pemahaman yang tidak bisa didapatkan dari membaca dokumentasi saja.

**Sistem AI Berbasis LLM.** Integrasi Google Gemini ke dalam Viviashop membuka wawasan tentang bagaimana model bahasa besar digunakan dalam konteks aplikasi bisnis nyata. Schick et al. (2023) mendeskripsikan pola *tool use*, di mana LLM bisa memanggil fungsi eksternal secara dinamis, sebagai salah satu kemampuan paling signifikan dari LLM generasi terbaru. Arsitektur `ToolDispatcher` di Viviashop adalah implementasi langsung dari pola ini, dan bekerja dengannya memberikan pemahaman praktis tentang cara mengintegrasikan AI ke dalam workflow bisnis yang sudah ada.

**Temuan Teknis yang Memperluas Pemahaman Akademis.** Satu temuan yang cukup menarik: pengelolaan stok multi-layer di Viviashop (tiga layer bersamaan dengan satu model legacy) menunjukkan bahwa sistem yang dibangun secara iteratif sering kali mengakumulasi lapisan abstraksi yang tidak selalu kohesif. Ini adalah realitas technical debt yang baru bisa dipahami setelah berhadapan langsung dengannya, bukan sekadar membacanya tentangnya di buku.

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**
