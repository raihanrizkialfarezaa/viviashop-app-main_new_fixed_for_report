
## BAB I
## PENDAHULUAN

## 1.1 Latar Belakang

Program magang bertujuan menyelaraskan kompetensi akademis mahasiswa dengan kebutuhan industri teknologi informasi. Melalui keterlibatan langsung dalam operasional mitra, mahasiswa memperoleh pengalaman praktis seperti mengelola siklus pengembangan perangkat lunak, berkolaborasi dalam tim, serta menyelesaikan masalah teknis pada sistem produksi aktif. Bagi Program Studi S1 Teknik Informatika, hal ini menjadi sarana konversi mata kuliah berbasis implementasi proyek nyata di industri.

Industri teknologi informasi di Indonesia tumbuh dengan kecepatan yang konsisten melampaui rata-rata industri lain. Sektor e-commerce nasional mencatat nilai transaksi yang menembus ratusan triliun rupiah per tahun, dengan pertumbuhan pengguna digital yang terus meningkat seiring penetrasi internet ke wilayah-wilayah yang sebelumnya belum terjangkau. Di saat bersamaan, adopsi teknologi cloud, kecerdasan buatan, dan sistem integrasi API menjadi kebutuhan dasar, bukan lagi keunggulan diferensiatif. Dunia usaha, termasuk skala UMKM dan menengah, tidak lagi bisa menunda digitalisasi operasional mereka. Kondisi ini melahirkan permintaan yang tidak kecil terhadap tenaga pengembang perangkat lunak yang tidak hanya memahami sintaksis, tetapi juga mampu bekerja dalam ekosistem proyek yang kompleks.

CV Sinar Agung Jaya dipilih sebagai lokasi magang karena secara aktif mengembangkan dan mengoperasikan platform e-commerce serta print service mandiri bernama Viviashop. Platform ini merupakan sistem produksi aktif yang mengintegrasikan transaksi e-commerce, manajemen stok, laporan keuangan, dan asisten kecerdasan buatan berbasis Google Gemini API. Pengembangan dilakukan pada codebase Laravel 10 dengan struktur kompleks yang meliputi 35 model Eloquent, 40 controller, dan 27 artisan command. Hal ini memberikan tantangan teknis nyata bagi mahasiswa dalam memahami dan memodifikasi sistem skala produksi.

Kegiatan magang ini berfokus pada kontribusi teknis langsung melalui perbaikan sistem, pengembangan fitur, penanganan bug, dan penyusunan dokumentasi teknis. Pelaksanaan magang mengacu pada program Magang Berdampak S1 Teknik Informatika UNESA dengan durasi 960 jam kerja. Kinerja dan progres kerja dievaluasi berdasarkan dokumentasi logbook harian pada sistem universitas, laporan akhir pertanggungjawaban teknis, serta penilaian kompetensi kerja dari pembimbing mitra.

---

## 1.2 Rumusan Masalah

Berdasarkan observasi awal terhadap kondisi dan kebutuhan CV Sinar Agung Jaya serta lingkup proyek Viviashop yang dijalani selama magang, beberapa pertanyaan yang menjadi fokus pelaksanaan kegiatan ini adalah:

1. Bagaimana arsitektur sistem e-commerce dan ERP Viviashop yang sudah berjalan saat ini, dan di mana letak celah teknis yang perlu diperbaiki atau dikembangkan lebih lanjut?
2. Fitur-fitur apa yang dapat dikembangkan, diperbaiki, atau dioptimasi selama periode magang untuk meningkatkan keandalan sistem dan pengalaman pengguna platform Viviashop?
3. Bagaimana sistem manajemen stok multi-layer (mencakup `ProductInventory`, `ProductVariant.stock`, dan `StockMovement`) dapat dikelola secara konsisten agar tidak menimbulkan inkonistensi data di antara ketiga layer tersebut?
4. Bagaimana sistem AI Agent berbasis Google Gemini yang terintegrasi ke dalam Viviashop dapat dikembangkan dan diuji sehingga mampu memberikan respons yang akurat dan relevan untuk kebutuhan operasional bisnis (mulai dari pencarian produk hingga pemindaian stok kritis)?
5. Bagaimana dampak keterlibatan mahasiswa magang dalam pengembangan Viviashop terhadap kualitas dan kelengkapan fitur platform, serta kompetensi teknis mahasiswa yang bersangkutan?

---

## 1.3 Tujuan Magang

### Tujuan Umum

- Memberikan pengalaman langsung kepada mahasiswa di dunia kerja nyata, khususnya dalam konteks pengembangan perangkat lunak berbasis web untuk e-commerce dan sistem ERP.
- Menumbuhkan kemampuan *problem solving* berbasis praktik lapangan, di mana setiap masalah teknis yang muncul harus dipecahkan dengan analisis mandiri sebelum eskalasi ke tim senior.

### Tujuan Khusus

1. Mengidentifikasi dan menganalisis arsitektur sistem Viviashop secara menyeluruh, mencakup lapisan backend (Laravel 10), frontend (Blade + Bootstrap 4 + Vite), database (MySQL), dan integrasi layanan eksternal (Midtrans, RajaOngkir, Cloudinary, Google Gemini), sehingga kontribusi pengembangan dapat dilakukan secara terarah dan tidak menimbulkan regresi.

2. Mengembangkan, memperbaiki, dan mengoptimasi fitur-fitur konkret dalam platform Viviashop selama periode magang 960 jam, yang mencakup modul e-commerce (produk, cart, order, payment), modul print service, modul stok manajemen, modul pelaporan, modul AI agent, dan modul performa karyawan.

3. Menghasilkan dokumentasi teknis yang dapat ditindaklanjuti oleh tim pengembang, termasuk catatan alur AI agent, prosedur setup Midtrans, panduan QA untuk modul-modul kritis, dan panduan pengguna untuk customer.

### Keterampilan Teknis yang Dituju

- Mahasiswa mampu mempersiapkan hal-hal teknis yang diperlukan untuk melaksanakan suatu aktivitas kerja sesuai dengan kondisi tempat magang kerja.
- Mahasiswa mampu menjelaskan atau melaksanakan aktivitas-aktivitas operasi kerja sesuai dengan kondisi tempat magang kerja.
- Mahasiswa mampu menyusun laporan kerja di setiap aktivitas kerja yang telah dijalankan.

### Keterampilan Relasional yang Dituju

- Mahasiswa mampu menerima informasi dengan lengkap dan akurat baik secara lisan maupun tertulis.
- Mahasiswa mampu menyampaikan laporan magang kerja baik kepada atasan (pembimbing lapang) ataupun panitia magang kerja secara akurat dan tepat waktu (*on-time*).
- Mahasiswa mampu menjalin hubungan kerja dengan atasan (pembimbing lapang), panitia magang kerja, dan rekan kerja atau tim.
- Mahasiswa mampu membangun tim kerja yang dinamis dan tangguh.

---

## 1.4 Manfaat Magang

### Bagi Mahasiswa

- Pengalaman kerja dalam proyek perangkat lunak berskala produksi.
- Penerapan langsung ilmu dari mata kuliah Konstruksi Perangkat Lunak, Analisis dan Desain Perangkat Lunak, Verifikasi dan Validasi Perangkat Lunak, Web Semantik, dan Virtualisasi dan Komputasi Awan dalam konteks kerja riil.
- Peningkatan kompetensi teknis: Laravel 10, MySQL query optimization, API integration, Vite asset bundling, PHPUnit testing, dan pengembangan sistem AI berbasis LLM (Gemini API).
- Kemampuan membaca, memahami, dan berkontribusi pada codebase yang sudah berjalan, sebuah keterampilan yang sangat berbeda dari memulai proyek dari nol.
- Jaringan profesional dengan tim pengembang di industri perangkat lunak Jawa Timur.

### Bagi Mitra (CV Sinar Agung Jaya / Viviashop)

- Kontribusi SDM mahasiswa yang mendukung percepatan pengembangan platform Viviashop, mulai dari perbaikan bug yang tertunda hingga penambahan fitur baru yang dibutuhkan operasional.
- Kerja sama yang saling menguntungkan dengan UNESA sebagai institusi pendidikan tinggi, yang membuka peluang kolaborasi jangka panjang.
- Dokumentasi teknis yang lebih lengkap sebagai hasil langsung dari keterlibatan mahasiswa, termasuk panduan fitur AI agent dan alur pengujian sistem.
- Kandidat tenaga kerja yang sudah memahami arsitektur sistem, budaya kerja, dan standar pengembangan yang berlaku di tim.

### Bagi Universitas Negeri Surabaya (UNESA)

- Lulusan Teknik Informatika yang memiliki jam terbang nyata di lingkungan pengembangan perangkat lunak produksi, bukan hanya di lingkungan laboratorium.
- Penguatan kerja sama dengan mitra industri di sektor teknologi, dengan CV Sinar Agung Jaya sebagai contoh kolaborasi yang produktif dan bisa direplikasi.
- Umpan balik kurikulum dari pengalaman nyata: kompetensi mana yang sudah cukup dipersiapkan oleh kurikulum, dan mana yang masih membutuhkan penguatan.
- Peningkatan reputasi institusi melalui mahasiswa yang memberikan kontribusi nyata kepada mitra.

---

## 1.5 Urgensi Magang

Kebutuhan akan pengembang perangkat lunak yang berpengalaman tidak menunggu mahasiswa lulus. Industri mengharapkan kandidat yang sudah pernah bersentuhan dengan kompleksitas sistem nyata, bukan hanya yang bisa menulis kode di lingkungan ideal. Viviashop mewakili jenis sistem yang dioperasikan ribuan bisnis digital skala menengah di Indonesia yang bersifat multi-modul, multi-integrasi, dan dioperasikan dengan tim kecil yang menuntut setiap anggotanya mampu berpindah konteks dengan cepat.

Program magang ini mendesak untuk dijalankan karena gap antara kemampuan yang diukur di kampus dan yang dibutuhkan industri masih cukup lebar. Kemampuan membaca codebase orang lain, bekerja dengan sistem legacy, mengelola konflik di version control, dan mendebug error di environment production adalah kompetensi yang hampir tidak bisa diajarkan di kelas, melainkan hanya bisa diperoleh melalui paparan langsung. Selama 960 jam magang di CV Sinar Agung Jaya, paparan itu terjadi setiap hari kerja, dalam bentuk tugas nyata dengan konsekuensi nyata.

---

## 1.6 Kontribusi Riset terhadap Ilmu Pengetahuan

Magang ini bukan penelitian formal, tetapi pengalaman yang dijalani menghasilkan kontribusi yang relevan untuk pengembangan keilmuan Teknik Informatika dalam beberapa aspek:

**Penerapan dan pengujian konsep akademis dalam konteks nyata.** Konsep-konsep dari mata kuliah Konstruksi Perangkat Lunak, seperti *refactoring*, *service layer pattern*, dan *separation of concerns*, diuji dan diterapkan langsung ketika merapikan `StockManagementService`, memisahkan `CategoryService` dari `CategoryController`, dan merefaktor `AttributeVariantController`. Hasilnya bukan hanya kode yang lebih rapi, tetapi pemahaman yang lebih dalam tentang kapan sebuah abstraksi *perlu* dilakukan dan kapan ia hanya menambah kompleksitas yang tidak perlu.

**Dokumentasi praktik pengembangan perangkat lunak e-commerce dengan integrasi AI.** Arsitektur sistem AI agent yang diimplementasikan dalam Viviashop, dengan pola `ToolDispatcher` → `ToolRegistry` → `ToolHandler` yang menggantungkan 13 tool pada satu orchestrator `AIAgentService`, adalah contoh nyata dari integrasi LLM ke dalam aplikasi web monolitik. Dokumentasi alur ini menjadi referensi berharga untuk pengembangan sistem serupa.

**Temuan tentang manajemen stok multi-layer dalam e-commerce.** Sistem Viviashop menggunakan tiga layer stok secara bersamaan (`ProductInventory`, `ProductVariant.stock`, dan `StockMovement`), dengan `RekamanStok` sebagai model legacy yang sudah tidak disarankan digunakan. Tantangan menjaga konsistensi antar-layer ini menjadi temuan teknis yang relevan untuk kajian arsitektur database di e-commerce.

---

## 1.7 Luaran Magang

Pelaksanaan program magang berdampak selama 960 jam di CV Sinar Agung Jaya menghasilkan beberapa luaran konkret. Luaran ini dibagi menjadi dua kategori utama, yaitu luaran wajib untuk memenuhi aspek administratif akademis di Universitas Negeri Surabaya, dan luaran tambahan yang memberikan nilai guna praktis bagi keberlanjutan sistem Viviashop milik mitra.

### 1. Luaran Wajib (Akademik)

- **Laporan Akhir Magang.** Dokumen tertulis (laporan ini) yang menyajikan dokumentasi utuh mengenai seluruh aktivitas, analisis kebutuhan sistem, detail implementasi fitur, pembahasan keterkaitan praktis dengan mata kuliah konversi, serta evaluasi kritis atas tantangan yang dihadapi di lapangan.
- **Sertifikat Penyelesaian dan Lembar Penilaian Mitra.** Berkas resmi dari CV Sinar Agung Jaya yang ditandatangani oleh Fanani Agung Widyanto selaku pembimbing mitra. Dokumen ini memuat nilai kelayakan kinerja pada aspek kompetensi teknis, kedisiplinan, etika, dan komunikasi.
- **Rekaman Logbook Harian Terverifikasi.** Laporan aktivitas harian sebanyak 96 entri yang diinput secara berkala pada sistem Mobilitas Akademik UNESA, mencatat akumulasi 57.600 menit waktu kerja nyata yang telah disetujui oleh Dosen Pembimbing Lapangan.

### 2. Luaran Tambahan (Teknis dan Operasional)

- **Kontribusi Kode Program pada Repositori Git Viviashop.** Penulisan dan modifikasi kode program yang bersih dan modular yang telah di-push ke repositori Git aktif milik mitra. Kontribusi kode ini mencakup beberapa area pengembangan berikut:
  * *Modul AI Assistant*, mencakup implementasi tool baru `SuggestSupplierTool` lengkap dengan unit test, integrasi `ScanCriticalStockTool` ke dalam pipeline AI agent, serta refaktorisasi `PromptBuilder` dan `Context` untuk meningkatkan akurasi respons Google Gemini API.
  * *Optimasi Database dan Performa*, mencakup eliminasi masalah N+1 query pada `ProductController` yang menurunkan load time halaman dari 5 detik menjadi 1 detik, serta penerapan indexing query pada varian produk.
  * *Modul Stok dan Keuangan*, mencakup refaktorisasi `StockManagementService` untuk menyatukan logika mutasi stok transaksi, perbaikan state pada `WishListController`, serta pembuatan modul ekspor data pengguna ke Excel (`UserExport`).
  * *Perbaikan Bug dan Antarmuka*, mencakup penyesuaian `CartControllerNew` dengan model pengiriman `Shipment`, validasi rating pada testimoni pelanggan, dan penanganan bug reset password.
- **Dokumentasi Teknis Internal pada Notion dan Markdown Workspace.** Penyusunan panduan pengembangan yang ditulis dalam format Markdown untuk mempermudah pemeliharaan sistem di masa mendatang. Dokumen ini meliputi panduan integrasi payment gateway Midtrans (tahapan konfigurasi API key sandbox dan production), berkas dokumentasi API internal (daftar endpoint, metode request, skema parameter, dan contoh respons JSON), serta panduan operasional sistem AI Agent Viviashop untuk keperluan orientasi developer baru.
- **Panduan Pengguna (User Manual).** Panduan praktis bagi customer untuk mempermudah navigasi belanja, mulai dari proses pembuatan akun, transaksi belanja produk fisik, pemesanan cetak dokumen pada print service, checkout dengan payment gateway, hingga pelacakan status pesanan.

---
---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**
