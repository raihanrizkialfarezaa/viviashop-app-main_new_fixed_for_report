## LAPORAN AKHIR MAGANG

## PENGEMBANGAN SISTEM E-COMMERCE, LAYANAN CETAK MANDIRI BERBASIS SESI (SMART PRINT), DAN INTEGRASI AI ASSISTANT PADA VIVIASHOP

Di Viviashop (CV. Viviashop / Mitra Retail & Digital Printing)

Penyusun:

UNIVERSITAS NEGERI SURABAYA

FAKULTAS TEKNIK

PROGRAM STUDI S1 TEKNIK INFORMATIKA

Tahun 2026

---

## Lembar Pengesahan

Judul Kegiatan: Pengembangan Sistem E-Commerce, Layanan Cetak Mandiri Berbasis Sesi (Smart Print), dan Integrasi AI Assistant pada Viviashop  
Nama Instansi: Viviashop (Mitra Retail & Digital Printing)  
Alamat Instansi: ............................................................  

Identitas Mahasiswa:  
Nama: ............................................................  
NIM: ............................................................  
Prodi/Jurusan: S1 Teknik Informatika / Teknik Informatika  
Fakultas: Fakultas Teknik  
No Tlp: ............................................................  
Alamat Email: ............................................................  
Periode Magang: Januari - Juni 2026  

Surabaya, 22 Juni 2026

Mengetahui,

Dosen Pembimbing Lapangan  
............................................................  
NIP. ......................................................  

Mahasiswa  
............................................................  
NIM. ......................................................  

Menyetujui,

Pembimbing Mitra  
............................................................  
NIP/Identitas. .......................................  

Koordinator Program Studi  
............................................................  
NIP. ......................................................  

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**

---

## DAFTAR ISI

|DAFTAR ISI|i|
|---|---|
|DAFTAR TABEL|ii|
|DAFTAR GAMBAR|iii|
|BAB I PENDAHULUAN|1|
|1.1 Latar Belakang|1|
|1.2 Rumusan Masalah|2|
|1.3 Tujuan Magang|2|
|1.4 Manfaat Magang|3|
|1.5 Urgensi Magang|3|
|1.6 Kontribusi Riset terhadap Ilmu Pengetahuan|4|
|1.7 Luaran Magang|4|
|BAB II TINJAUAN PUSTAKA DAN PROFIL MITRA|5|
|2.1 Profil Industri Tempat Magang (Viviashop)|5|
|2.2 Struktur Organisasi Mitra|5|
|2.3 Kerangka Konseptual Program Magang Berdampak|6|
|BAB III METODE PELAKSANAAN|8|
|3.1 Bentuk Penugasan (Task Assignment)|8|
|3.2 Waktu Pelaksanaan Magang|8|
|3.3 Prosedur Pelaksanaan Magang|9|
|BAB IV PELAKSANAAN KEGIATAN YANG RELEVAN DENGAN KONVERSI MATA KULIAH|11|
|4.1 Aktivitas Harian Selama Magang|11|
|4.2 Hasil Proyek yang Telah Dikembangkan|12|
|4.3 Pembahasan Relevansi Bidang Keilmuan|17|
|4.4 Relevansi dengan Mata Kuliah Konversi|18|
|BAB V HAMBATAN DAN DUKUNGAN PELAKSANAAN MAGANG|22|
|5.1 Hambatan|22|
|5.2 Dukungan|22|
|BAB VI REFLEKSI, RENCANA TINDAK LANJUT, DAN REKOMENDASI|24|
|6.1 Refleksi Pengalaman dan Kompetensi|24|
|6.2 Rekomendasi untuk Mitra|25|
|6.3 Rekomendasi untuk Program Magang|25|
|6.4 Rencana Pengembangan Diri|26|
|6.5 Potensi Keberlanjutan Program|26|
|BAB VII PENUTUP|28|
|7.1 Simpulan|28|
|7.2 Saran|28|
|DAFTAR PUSTAKA|29|
|LAMPIRAN|30|

---

## DAFTAR TABEL

Tabel 2.1 Ringkasan Tipe Peran Alat Bantu AI Agent Viviashop  
Tabel 3.1 Prosedur Metode Pelaksanaan Magang 12 Tahapan  
Tabel 4.1 Log Kegiatan Mingguan yang Dilaksanakan di Mitra  
Tabel 4.2 Pemetaan Fungsi 14 Alat Bantu AI Agent Viviashop  
Tabel 4.3 Matriks Penilaian Kinerja Laporan Pengujian PDF Generator  

---

## DAFTAR GAMBAR

Gambar 2.1 Struktur Organisasi Operasional Viviashop  
Gambar 2.2 Arsitektur Sistem Monolitik Laravel dan Komponen Integrasi  
Gambar 4.1 Diagram Alir Lifecycle Sesi Unggah dan Cetak Kertas  
Gambar 4.2 Representasi Aliran Data Verifikasi Signature Pembayaran Midtrans  

---

## BAB I PENDAHULUAN

### 1.1 Latar Belakang

Pendidikan tinggi saat ini dituntut untuk menghasilkan lulusan yang tidak hanya menguasai teori di atas kertas, tetapi juga cekatan menghadapi dinamika dunia kerja yang sesungguhnya. Program magang dalam kurikulum perguruan tinggi berperan sebagai sarana krusial untuk menyelaraskan pemahaman akademis dengan praktik nyata di industri. Melalui interaksi langsung di lapangan, mahasiswa dapat mengasah kepekaan profesional, memahami kebutuhan pasar, dan menerapkan kompetensi teknis yang telah dipelajari di bangku kuliah. Upaya ini penting demi menekan kesenjangan keterampilan antara dunia akademik dan dunia industri.

Sektor retail dan digital printing merupakan salah satu bidang usaha yang terus mengalami perubahan cepat akibat arus digitalisasi. Pelaku usaha mikro, kecil, dan menengah (UMKM) seperti Viviashop dituntut untuk beralih dari manajemen konvensional menuju sistem terintegrasi demi mempertahankan daya saing. Digitalisasi tidak lagi terbatas pada pembuatan situs web e-commerce sederhana, melainkan mencakup otomatisasi pengelolaan persediaan barang (inventory), integrasi gerbang pembayaran (payment gateway), pelacakan kinerja karyawan, hingga pemanfaatan kecerdasan buatan untuk mengotomatisasi interaksi pelanggan.

Viviashop dipilih sebagai lokasi pelaksanaan magang karena merupakan representasi dari bisnis retail modern yang memadukan toko online dengan jasa percetakan fisik (digital printing). Bisnis semacam ini menghadapi tantangan operasional yang kompleks, mulai dari sinkronisasi persediaan barang fisik dan online, estimasi biaya cetak dokumen berbasis halaman, antrean pekerjaan pencetakan, hingga pemantauan kontribusi masing-masing karyawan secara real-time. Kompleksitas ini menyediakan ruang belajar yang sangat kaya bagi mahasiswa Teknik Informatika untuk merancang solusi rekayasa perangkat lunak yang andal dan aplikatif.

Dengan mengadopsi pendekatan magang berbasis dampak, mahasiswa tidak sekadar melakukan tugas rutin harian, melainkan merancang inovasi nyata. Salah satunya adalah mengintegrasikan sistem kecerdasan buatan berupa AI Agent berbasis Google Gemini API untuk membantu operasional penjualan dan manajemen backoffice. Kontribusi nyata ini juga berdampak langsung pada pencapaian Tujuan Pembangunan Berkelanjutan (SDGs), terutama pada pilar Pekerjaan Layak dan Pertumbuhan Ekonomi (SDG 8) melalui otomatisasi pelacakan bonus karyawan, pilar Industri, Inovasi, dan Infrastruktur (SDG 9) melalui inovasi AI Agent, serta pilar Konsumsi dan Produksi yang Bertanggung Jawab (SDG 12) melalui otomatisasi ukuran kertas pada sistem Smart Print.

### 1.2 Rumusan Masalah

Berdasarkan situasi operasional yang ada di Viviashop, terdapat beberapa kendala utama yang dirumuskan sebagai fokus penanganan dalam kegiatan magang ini:

1. Bagaimana merancang dan menerapkan asisten virtual (AI Agent) yang cerdas dan aman untuk membantu pelanggan mencari produk dan memproses estimasi biaya cetak, serta membantu admin dalam memeriksa stok barang kritis dan meringkas metrik bisnis?
2. Bagaimana menyinkronkan data stok barang yang bersifat hibrida antara persediaan produk sederhana (simple product) pada tabel inventory dan persediaan varian produk (configurable product) agar tidak terjadi inkonsistensi saat terjadi transaksi pembelian supplier maupun penjualan ritel?
3. Bagaimana mengintegrasikan sistem pembayaran otomatis menggunakan gerbang pembayaran Midtrans secara aman dan melacak mutasi stok secara otomatis pada alur checkout online pelanggan maupun pemesanan manual oleh admin?

### 1.3 Tujuan Magang

Tujuan pelaksanaan program magang ini dibagi menjadi dua kategori utama, yakni tujuan umum operasional dan tujuan khusus pengembangan teknis.

#### Tujuan Umum:
1. Memberikan pengalaman kerja langsung di industri retail digital printing guna membangun etos kerja yang profesional, bertanggung jawab, dan disiplin.
2. Mengasah kemampuan pemecahan masalah (problem solving) terhadap kendala operasional nyata di lapangan menggunakan pendekatan rekayasa perangkat lunak.

#### Tujuan Khusus:
1. Membangun sistem AI Agent berbasis Gemini API yang dilengkapi kontrol akses berbasis peran (RBAC) untuk melayani kebutuhan pelanggan umum, pelanggan terautentikasi, dan administrator backoffice secara aman.
2. Mengimplementasikan fitur pencatatan persediaan barang (Stock Opname) dengan algoritma distribusi stok proporsional untuk menyesuaikan persediaan produk varian secara akurat.
3. Menyusun modul pengujian laporan keuangan dalam format PDF (PDF Report Tester) berbasis DOMPDF dengan pelacakan metrik waktu eksekusi dan ukuran file untuk menstabilkan performa cetak laporan bulanan.

Untuk mendukung keberhasilan program, mahasiswa juga ditargetkan menguasai keterampilan relasional. Mahasiswa harus mampu mendengarkan kebutuhan pemilik mitra secara cermat, menyampaikan laporan progres pengembangan secara berkala kepada dosen pembimbing dan supervisor lapangan secara tepat waktu, serta bekerja sama secara harmonis dengan staf operasional Viviashop dalam memvalidasi fitur-fitur baru.

### 1.4 Manfaat Magang

Program magang berdampak ini diharapkan mampu memberikan nilai guna bagi berbagai pihak yang terlibat:

#### 1. Bagi Mahasiswa:
* Memberikan pengalaman kerja nyata yang relevan dengan bidang keilmuan yang dipelajari, khususnya dalam penerapan teknologi informasi untuk pengelolaan bisnis retail.
* Menjadi sarana penerapan kompetensi rekayasa perangkat lunak, pemrograman web framework Laravel, manajemen basis data, dan implementasi kecerdasan buatan pada sistem nyata.
* Mengembangkan sikap profesional, tanggung jawab, kerja tim, dan kesiapan menghadapi dunia kerja industri IT.

#### 2. Bagi Mitra (Viviashop):
* Memperoleh peningkatan efisiensi operasional dengan hadirnya asisten cerdas AI Agent yang dapat mengurangi beban kerja customer service dan admin gudang.
* Memiliki sistem Stock Opname dan audit mutasi stok yang presisi guna meminimalkan kerugian akibat selisih barang di gudang.
* Mendapatkan otomatisasi laporan bulanan dan integrasi pembayaran online yang andal untuk meminimalkan kesalahan pencatatan transaksi manual.

#### 3. Bagi Universitas Negeri Surabaya (UNESA):
* Memperkuat kerja sama dan kolaborasi dengan mitra eksternal dalam mendukung program mobilitas akademik mahasiswa.
* Mendapatkan umpan balik dari mitra terkait kurikulum dan kompetensi mahasiswa, yang dapat digunakan untuk perbaikan proses pembelajaran.
* Mendorong peningkatan reputasi institusi melalui keterlibatan aktif mahasiswa dalam memberikan solusi teknologi nyata yang berdampak bagi UMKM.

### 1.5 Urgensi Magang

Transformasi digital bagi sektor usaha menengah ke bawah kini bukan lagi sekadar pelengkap, melainkan penentu kelangsungan usaha. Banyak bisnis percetakan lokal yang terpaksa gulung tikar akibat ketidakmampuan mengelola antrean kerja secara efisien dan buruknya akurasi pencatatan stok bahan baku kertas cetak. Viviashop membutuhkan intervensi teknologi terpadu untuk menyelesaikan masalah-masalah operasional tersebut. Program magang ini mendesak dilakukan agar mahasiswa dapat segera mendiagnosis inkonsistensi sistem varian produk yang lama, menstabilkan alur pembayaran digital, dan mengintegrasikan kecerdasan buatan sebelum kompleksitas operasional menghambat pertumbuhan bisnis mitra.

### 1.6 Kontribusi Riset terhadap Ilmu Pengetahuan

Secara akademis, pengerjaan proyek sistem informasi e-commerce dan percetakan kustom ini memberikan kontribusi keilmuan pada bidang rekayasa perangkat lunak terapan. Proyek ini memformulasikan implementasi loop percakapan agen cerdas (agentic loop) menggunakan Large Language Model (LLM) yang dikombinasikan dengan sistem otorisasi Role-Based Access Control (RBAC) pada level fungsi/tooling backend. Riset terapan ini membuktikan bahwa penanganan pembatasan akses data sensitif (seperti metrik bisnis atau performa karyawan) dapat diintegrasikan langsung pada pendefinisian perkakas (tools) kecerdasan buatan secara deklaratif di sisi server web, tanpa membebankan logika otorisasi tersebut pada model bahasa itu sendiri.

### 1.7 Luaran Magang

Luaran konkret yang dihasilkan dari pelaksanaan program magang di Viviashop ini meliputi:

1. Kode program sistem e-commerce Viviashop yang telah terintegrasi dengan asisten virtual AI Agent, sistem pembayaran Midtrans, dan fitur administrasi gudang.
2. File panduan teknis operasional sistem percetakan (`DOKUMENTASI_TEKNIS_VIVIASHOP.md`) dan catatan QA (`DOKUMENTASI_MAGANG_VIVIASHOP.md`).
3. Draf Laporan Akhir Mobilitas Akademik Magang ini sebagai dokumen pertanggungjawaban akademis kepada Program Studi S1 Teknik Informatika Universitas Negeri Surabaya.

---

## BAB II TINJAUAN PUSTAKA DAN PROFIL MITRA

### 2.1 Profil Industri Tempat Magang (Viviashop)

Viviashop merupakan unit usaha yang bergerak di bidang perdagangan umum (retail) produk alat tulis, perlengkapan kantor, serta penyediaan jasa percetakan digital (digital printing/print service). Berlokasi di wilayah Surabaya, mitra ini melayani transaksi pembelian produk secara langsung di toko fisik (offline) maupun pemesanan dokumen cetak secara digital melalui platform web. Dalam perkembangannya, Viviashop bertransformasi dari sistem kasir konvensional menjadi toko berbasis web monolitik menggunakan kerangka kerja Laravel 10. Sistem ini dikembangkan untuk mengelola inventori produk, memproses pesanan cetak secara mandiri oleh pelanggan (Smart Print), mengelola pengadaan barang dari supplier (procurement), serta memantau pemberian insentif bonus bagi karyawan berdasarkan kontribusi mereka terhadap penyelesaian pesanan.

### 2.2 Struktur Organisasi Mitra

Operasional harian Viviashop dijalankan oleh tim kerja dengan pembagian peran yang terfokus demi menjaga produktivitas toko dan layanan cetak. Berikut adalah bagan struktur organisasi operasional mitra:

```
                  ┌──────────────────────────────┐
                  │        Pemilik Mitra         │
                  │     (Owner / Supervisor)     │
                  └──────────────┬───────────────┘
                                 │
         ┌───────────────────────┴───────────────────────┐
         ▼                                               ▼
┌─────────────────┐                             ┌─────────────────┐
│ Admin Gudang &  │                             │   Staf Kasir    │
│   Procurement   │                             │ & Operator Print│
└─────────────────┘                             └─────────────────┘
```

* **Pemilik Mitra (Owner / Supervisor):** Bertanggung jawab atas kebijakan bisnis, pemantauan omzet penjualan, penentuan harga dasar barang, persetujuan pengadaan barang dari supplier, serta pembagian bonus kinerja karyawan.
* **Admin Gudang & Procurement:** Bertugas mendata produk masuk dari supplier, melakukan proses Stock Opname fisik secara periodik di gudang, mengelola ketersediaan kertas cetak, serta berkoordinasi dengan supplier.
* **Staf Kasir & Operator Print:** Melayani transaksi pembelian langsung di toko, memantau antrean pesanan cetak digital (print queue), melakukan cetak dokumen fisik sesuai file yang diunggah pelanggan, serta memproses pembayaran manual di tempat.

### 2.3 Kerangka Konseptual Program Magang Berdampak

Program magang berdampak dirancang dengan menitikberatkan pada tiga pilar hasil utama: peningkatan kompetensi mahasiswa (outcome), penguatan efisiensi operasional mitra (output), dan pengukuran dampak riil terhadap ekosistem bisnis. Untuk mencapai hal tersebut, program ini mengintegrasikan teknologi modern dengan manajemen data yang ketat. Kerangka konseptual proyek ditekankan pada empat area utama yang dikembangkan secara terpadu:

```
┌─────────────────────────────────────────────────────────────────────────┐
│                          APLIKASI VIVIASHOP                             │
├───────────────────┬──────────────────┬─────────────────┬────────────────┤
│    AI Agent       │  Payment Gateway │  Stock Opname   │  Reporting PDF │
│  (Gemini API)     │    (Midtrans)    │  (Proportional) │   (DOMPDF)     │
└───────────────────┴──────────────────┴─────────────────┴────────────────┘
```

#### 1. AI Agent System dengan Kontrol Akses (RBAC)
Sistem asisten virtual dibangun dengan memadukan Google Gemini API (`config/ai.php`) dengan arsitektur backend Laravel. Berbeda dari asisten chatbot biasa, AI Agent ini dibekali kemampuan memanggil fungsi internal sistem (function calling) secara dinamis menggunakan loop evaluasi status (agentic loop) pada kelas `AIAgentService.php` yang memproses pesan pengguna secara berulang hingga menemukan respons akhir. Guna menjaga kerahasiaan data bisnis, kontrol akses berbasis peran (RBAC) diterapkan secara ketat melalui deklarasi alat bantu (`ToolRegistry`).

Tabel 2.1 Ringkasan Tipe Peran Alat Bantu AI Agent Viviashop:

| Nama Alat Bantu (Tool) | Tingkat Otorisasi (RBAC) | Fungsi Operasional |
|---|---|---|
| `SearchProductsViaSqlTool` | `public` (Umum) | Mencari katalog produk aktif tanpa login |
| `ResolvePrintVariantTool` | `public` (Umum) | Menentukan varian kertas cetak |
| `CalculatePrintCostTool` | `public` (Umum) | Menghitung harga cetak berbasis lembar & warna |
| `AddToCartTool` | `auth` (Pelanggan) | Memasukkan barang belanjaan ke keranjang |
| `CheckOrderStatusTool` | `auth` (Pelanggan) | Memeriksa riwayat pesanan aktif |
| `ScanCriticalStockTool` | `admin` (Staf Gudang) | Menampilkan daftar produk dengan stok kritis |
| `AggregateBusinessMetricsTool` | `admin` (Owner) | Mengagregasi data omzet dan profit bulanan |

#### 2. Sinkronisasi Inventori Hibrida dan Algoritma Stock Opname
Sistem inventori pada Viviashop memiliki tantangan struktural karena mengelola dua model penyimpanan stok yang berbeda secara bersamaan: produk sederhana non-varian pada tabel `product_inventories` dan produk varian (misal ukuran kertas A4, warna cetak BW/Color) pada tabel `product_variants`. Untuk mengatasi potensi inkonsistensi data, dibuat kelas pembantu `StockService` guna merekonsiliasi data stok di kedua tabel tersebut secara otomatis. 

Saat proses penyesuaian persediaan fisik (Stock Opname), diterapkan algoritma distribusi proporsional untuk membagi total stok fisik yang diinput admin ke masing-masing varian secara adil berdasarkan rasio stok sistem saat itu:
$$\text{Rasio Distribusi} = \frac{\text{Total Stok Fisik Baru}}{\text{Total Stok Sistem Saat Ini}}$$
$$\text{Stok Varian Baru} = \text{Stok Varian Lama} \times \text{Rasio Distribusi}$$

Mekanisme ini memastikan perhitungan nilai aset persediaan barang tetap akurat dan menghindari selisih pencatatan di sistem kasir.

#### 3. Integrasi Gerbang Pembayaran Otomatis
Layanan checkout online Viviashop memanfaatkan gerbang pembayaran Midtrans Snap. Kerja sama integrasi ini melibatkan koordinasi webhook notifikasi (`payments/notification`) yang dikecualikan dari proteksi CSRF di file `VerifyCsrfToken.php`. Pembayaran yang berhasil divalidasi dengan pencocokan tanda tangan SHA512 akan memicu perubahan status pemesanan secara otomatis dan memotong stok barang real-time di database.

#### 4. Pengoptimalan Kinerja Laporan (Reporting Metrics)
Modul pelaporan bulanan dirancang menggunakan pustaka DOMPDF. Untuk mengantisipasi penurunan kinerja server saat memproses data transaksi yang besar, dikembangkan pengukur metrik pelaporan (PDF Report Tester) yang memantau waktu pembuatan file (generation time) dan ukuran file akhir (file size). Metrik ini berguna bagi developer dalam mendiagnosis masalah kueri basis data berulang (N+1 query issue) sebelum sistem dideploy ke lingkungan produksi.

---

## BAB III METODE PELAKSANAAN

### 3.1 Bentuk Penugasan (Task Assignment)

Pelaksanaan magang kerja di Viviashop menugaskan mahasiswa sebagai *Full Stack Web Developer & AI Integration Specialist*. Mahasiswa bertanggung jawab langsung kepada pemilik mitra (Supervisor Lapangan) untuk menganalisis, merancang, mengimplementasikan, dan menguji modul-modul sistem informasi yang dibutuhkan. Penugasan kerja dibagi menjadi beberapa peran taktis yang saling berkaitan:

* **Analisis Kebutuhan Gudang & Bisnis:** Berkoordinasi dengan admin gudang untuk mengidentifikasi celah operasional pada manajemen stok barang dan alur pelaporan manual.
* **Perancangan Layanan Cetak Mandiri (Smart Print):** Mendesain alur unggah dokumen multitarget berbasis sesi percetakan cetak cepat, lengkap dengan perhitungan halaman otomatis dan estimasi biaya cetak real-time.
* **Integrasi Agen Kecerdasan Buatan:** Memrogram pustaka AI Agent berbasis model Gemini API untuk otomatisasi layanan pelanggan dan asisten penunjang keputusan pemilik usaha di panel admin.
* **Jaminan Kualitas (Quality Assurance):** Menyusun daftar skenario uji coba (test cases) sistem pembayaran, alur mutasi stok, serta performa eksekusi pembuatan file laporan PDF.

### 3.2 Waktu Pelaksanaan Magang

Kegiatan magang terstruktur ini dilaksanakan selama kurang lebih enam bulan, terhitung mulai tanggal 1 Januari 2026 sampai dengan 22 Juni 2026. Alokasi waktu kerja mengikuti standar jam operasional operasional Viviashop, yaitu hari Senin hingga Sabtu dengan durasi 8 jam per hari (total 480 menit per hari kerja). Kegiatan mingguan dibagi secara berimbang antara pengerjaan kode program di kantor mitra (WFO) dan pengujian sistem secara remote (WFA) untuk mensimulasikan lingkungan kerja modern.

### 3.3 Prosedur Pelaksanaan Magang

Langkah-langkah pelaksanaan magang disusun secara sistematis dalam 12 tahapan guna memastikan hasil pekerjaan terukur dan memberikan manfaat nyata.

Tabel 3.1 Prosedur Metode Pelaksanaan Magang 12 Tahapan:

| Tahapan Prosedur | Deskripsi Pelaksanaan |
|---|---|
| 1. Observasi Permasalahan | Mahasiswa mengamati alur pencatatan stok gudang dan proses kasir secara langsung untuk mendeteksi kelemahan sistem. |
| 2. Perizinan Akademik | Mengurus permohonan surat izin magang melalui layanan akademik Sub Direktorat Mobilitas Akademik UNESA. |
| 3. Pengajuan Rencana Kerja | Menyusun rencana pengembangan sistem informasi terintegrasi dan mengajukannya kepada pemilik Viviashop. |
| 4. Persetujuan Tugas | Mendiskusikan cakupan proyek dengan supervisor mitra untuk menyepakati fitur-fitur yang diprioritaskan. |
| 5. Pembekalan Kampus | Mengikuti pembekalan etika birokrasi profesional dan penyusunan logbook kerja oleh dosen pembimbing. |
| 6. Pemberangkatan | Memulai aktivitas magang secara resmi di lokasi kantor Viviashop dan pengenalan lingkungan kerja. |
| 7. Orientasi Teknis | Mempelajari struktur basis data warisan (legacy database) Viviashop dan dependensi file `composer.json` proyek. |
| 8. Pelaksanaan Koding | Menulis implementasi kode program, mulai dari pembuatan API varian, model mutasi stok, hingga antarmuka kasir. |
| 9. Mentoring Terstruktur | Berkonsultasi secara berkala dengan pembimbing mitra untuk memvalidasi kelayakan alur kerja kasir offline. |
| 10. Integrasi AI Agent | Menghubungkan client API Gemini ke sistem kasir dan melengkapi program dengan 14 modul perkakas AI. |
| 11. Monitoring Sistem | Menguji keandalan penanganan status transaksi pembayaran Midtrans dan ketepatan perhitungan halaman dokumen. |
| 12. Evaluasi Akhir | Menyerahkan hasil pekerjaan kepada pemilik mitra untuk dinilai kinerjanya berdasarkan kegunaan sistem informasi. |

Guna mengumpulkan data analisis yang akurat selama magang, digunakan beberapa teknik pengumpulan data seperti observasi langsung aktivitas transaksi kasir toko, studi dokumen berkas SOP percetakan lama, wawancara informal dengan staf kasir untuk menemukan keluhan aplikasi lama, diskusi kolaboratif mingguan dengan supervisor, serta perancangan mini-proyek terfokus untuk memecahkan masalah pencatatan mutasi stok.

Selama masa magang, mahasiswa diwajibkan menyusun Kertas Kerja Konseptual secara berkala yang diserahkan kepada pembimbing. Kertas kerja tersebut mencakup:

* **Kertas Kerja I (Deskripsi Proses Bisnis):** Menganalisis alur penerimaan pesanan ritel, pemrosesan antrean cetak, pengadaan supplier, hingga pembukuan keuangan toko.
* **Kertas Kerja II (Identifikasi Faktor Kunci Sukses):** Menemukan bahwa kecepatan kalkulasi harga cetak dan ketepatan pencatatan mutasi stok kertas adalah faktor utama penjaga margin laba digital printing.
* **Kertas Kerja III & Lanjutan (Analisis Masalah):** Menganalisis inkonsistensi alur pemotongan stok barang antara pemesanan online pelanggan (stok dipotong saat checkout) dengan pemesanan offline kasir (stok baru dipotong saat pesanan diselesaikan/completed), serta mendokumentasikan usulan sinkronisasinya menggunakan kelas `StockService`.

---

## BAB IV PELAKSANAAN KEGIATAN YANG RELEVAN DENGAN KONVERSI MATA KULIAH

### 4.1 Aktivitas Harian Selama Magang

Aktivitas harian mahasiswa difokuskan pada pemecahan masalah teknis nyata dan penulisan kode program secara konsisten untuk membangun fitur-fitur baru di sistem Viviashop. Rincian log kegiatan mingguan yang dilaksanakan dirangkum pada tabel berikut.

Tabel 4.1 Log Kegiatan Mingguan yang Dilaksanakan di Mitra:

| Bulan | Minggu | Posisi | Topik Utama | Durasi | Target Capaian | Metode Kerja |
|---|---|---|---|---|---|---|
| Januari | 1-2 | Backend Dev | Onboarding & Database Audit | 96 jam | Terpetakannya skema database lama dan setup dev env | Studi Kode & Diskusi |
| Januari | 3-4 | Fullstack Dev | Sinkronisasi Inventori Hibrida | 96 jam | Lahirnya kelas `StockService` untuk sinkronisasi otomatis | Koding Mandiri |
| Februari | 1-2 | Backend Dev | Integrasi Pembayaran Midtrans | 96 jam | Selesainya sistem webhook dan validasi signature SHA512 | Koding & API Test |
| Februari | 3-4 | UI/UX Dev | Pembuatan Modul Smart Print | 96 jam | Terwujudnya antarmuka unggah dokumen kustom pelanggan | Koding & Desain UI |
| Maret | 1-2 | QA Engineer | Pengujian Fitur Stock Opname | 96 jam | Diimplementasikannya command `test:stock-opname` | CLI Simulation |
| Maret | 3-4 | AI Developer | Setup Gemini Client & Prompt | 96 jam | Terhubungnya server Laravel dengan Google Gemini API | R&D & Prompting |
| April | 1-2 | AI Developer | Implementasi AI Tools (UC1 & UC2) | 96 jam | Lahirnya asisten pencari produk dan kalkulator cetak | Koding & API Test |
| April | 3-4 | AI Developer | Implementasi AI Tools (UC3 & UC4) | 96 jam | Terciptanya modul asisten admin penunjang keputusan | Koding & API Test |
| Mei | 1-2 | Fullstack Dev | Pembuatan Modul Bonus Karyawan | 96 jam | Terwujudnya leaderboard bonus berbasis pencatatan transaksi | Koding Mandiri |
| Mei | 3-4 | Backend Dev | Pengoptimalan PDF Generator | 96 jam | Hadirnya fitur PDF Report Tester dengan metrics tracking | Koding & Profiling |
| Juni | 1-2 | QA Engineer | Pengujian Regresi & Debugging | 96 jam | Suksesnya eksekusi pengujian fungsional seluruh modul | Manual & CLI Test |
| Juni | 3-4 | Technical Writer| Penyusunan Dokumentasi Teknis | 96 jam | Rampungnya penulisan panduan maintainability sistem | Penulisan Laporan |

### 4.2 Hasil Proyek yang Telah Dikembangkan

Proyek utama yang berhasil diselesaikan selama masa magang adalah **Pengembangan Sistem E-Commerce, Cetak Mandiri Berbasis Sesi (Smart Print), dan AI Agent Terintegrasi pada Viviashop**. Proyek ini diimplementasikan untuk menggantikan sistem kasir konvensional yang belum terintegrasi dengan baik.

Berikut adalah rincian fungsional dari hasil proyek yang dikembangkan:

#### 1. AI Agent System dengan Gemini API
Asisten virtual cerdas diintegrasikan pada antarmuka publik (`/ai/chat`) dan antarmuka administrator (`/admin/ai-assistant`). Mesin kecerdasan buatan ini berjalan dengan loop percakapan (agentic loop) pada kelas `AIAgentService.php` yang memproses pesan pengguna secara berulang hingga menemukan respons akhir. 

Akurasi fungsional sistem didukung oleh 14 perkakas (AI Tools) yang memiliki batasan hak akses (RBAC) di file `config/ai.php`:

Tabel 4.2 Pemetaan Fungsi 14 Alat Bantu AI Agent Viviashop:

| Nama Tool | Target Pengguna | Kegunaan Fungsional | File Sumber Kode |
|---|---|---|---|
| `SearchProductsViaSql` | Publik | Mencari produk dengan parameter kueri aman | [SearchProductsViaSqlTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/SearchProductsViaSqlTool.php) |
| `ResolvePrintVariant` | Publik | Mencocokkan file dokumen dengan varian kertas | [ResolvePrintVariantTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/ResolvePrintVariantTool.php) |
| `CalculatePrintCost` | Publik | Menghitung harga cetak berbasis lembar & warna | [CalculatePrintCostTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/CalculatePrintCostTool.php) |
| `AddToCart` | Pelanggan | Memasukkan item ke keranjang belanja belanjaan | [AddToCartTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/AddToCartTool.php) |
| `QuickBuyRedirect` | Pelanggan | Mengarahkan pengguna langsung ke halaman pembayaran | [QuickBuyRedirectTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/QuickBuyRedirectTool.php) |
| `CheckOrderStatus` | Pelanggan | Melacak status pelacakan pesanan terakhir | [CheckOrderStatusTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/CheckOrderStatusTool.php) |
| `CreatePrintCartItem` | Pelanggan | Memasukkan item cetakan kustom ke keranjang | [CreatePrintCartItemTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/CreatePrintCartItemTool.php) |
| `ScanCriticalStock` | Admin | Memindai barang dengan stok di bawah ambang batas | [ScanCriticalStockTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/ScanCriticalStockTool.php) |
| `SuggestSupplier` | Admin | Merekomendasikan supplier untuk restok barang | [SuggestSupplierTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/SuggestSupplierTool.php) |
| `CreatePurchaseDraft` | Admin | Membuat draf transaksi pembelian barang ke supplier | [CreatePurchaseDraftTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/CreatePurchaseDraftTool.php) |
| `AggregateBusinessMetrics` | Admin | Menghitung laba kotor dan omzet secara dinamis | [AggregateBusinessMetricsTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/AggregateBusinessMetricsTool.php) |
| `TopEmployeePerformance` | Admin | Menampilkan peringkat kinerja layanan staf kasir | [TopEmployeePerformanceTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/TopEmployeePerformanceTool.php) |
| `ExportReport` | Admin | Menghasikan tautan unduh file Excel laporan | [ExportReportTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/ExportReportTool.php) |
| `Greeting` | Publik | Menyapa pengguna dan memandu pemakaian chatbot | [GreetingTool.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Services/AI/Tools/GreetingTool.php) |

Setiap pemanggilan fungsi oleh kecerdasan buatan akan diaudit secara ketat di tabel basis data `ai_tool_calls` menggunakan model [AiToolCall.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Models/AiToolCall.php) untuk melacak nama alat bantu, parameter input, status keberhasilan, dan identitas pengguna demi keamanan operasional toko.

#### 2. Modul Kasir dan Penyesuaian Persediaan (Stock Opname)
Modul Stock Opname dibangun pada antarmuka admin `/admin/stock-opname` menggunakan pengontrol [StockOpnameController.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Http/Controllers/Admin/StockOpnameController.php). Sistem memuat seluruh produk dari basis data, menghitung total stok sistem saat ini, dan memproses data masukan jumlah fisik gudang dari admin.

```
                    ┌─────────────────────────┐
                    │  Admin Input Stok Fisik │
                    └────────────┬────────────┘
                                 │
                                 ▼
                     /─── Tipe Produk? ───\
                    /                      \
          Simple   /                        \ Configurable
         ┌────────┘                          └────────┐
         ▼                                            ▼
┌───────────────────┐                        ┌───────────────────┐
│ Update langsung   │                        │ Hitung Rasio Stok │
│   tabel stok      │                        │  (Fisik / Sistem) │
│product_inventories│                        └────────┬──────────┘
└────────┬──────────┘                                 │
         │                                            ▼
         │                                   ┌───────────────────┐
         │                                   │ Distribusikan ke  │
         │                                   │  masing-masing    │
         │                                   │   varian produk   │
         │                                   └────────┬──────────┘
         │                                            │
         └───────────────────┬────────────────────────┘
                             │
                             ▼
                 ┌───────────────────────┐
                 │ Simpan Catatan Audit  │
                 │   di tabel database   │
                 │  rekaman_stoks &      │
                 │   stock_movements     │
                 └───────────────────────┘
```

Algoritma pembagian persediaan produk varian (configurable product) diproses dalam transaksi basis data (`DB::beginTransaction()`). Stok baru didistribusikan secara proporsional berdasarkan rasio perbandingan stok lama varian terhadap stok sistem keseluruhan, dengan sisa pembulatan diberikan pada varian terakhir untuk menghindari selisih desimal. Seluruh proses penyesuaian dicatat pada tabel audit `stock_movements` (alasan: `inventory_correction`) dan tabel historis `rekaman_stoks`.

#### 3. Integrasi Pembayaran Online Midtrans
Pembayaran pesanan online dikembangkan menggunakan gerbang pembayaran Midtrans Snap. Logika verifikasi transaksi dipusatkan pada metode `notification` di file [PaymentController.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Http/Controllers/Frontend/PaymentController.php). Proses penerimaan notifikasi Midtrans disahkan dengan mencocokkan kode SHA512 signature key dari string pengenal order, kode status, nilai nominal transaksi, dan server key toko.

```
Midtrans Webhook ──► [Verify Csrf Exemption] ──► PaymentController@notification
                                                        │
                                                        ▼
                                             [Generate SHA512 Hash]
                                            Signature Key Verification
                                                        │
                                            ┌───────────┴───────────┐
                                            ▼                       ▼
                                       (Cocok?)                  (Tidak)
                                      /         \                   │
                                     /           \                  ▼
                                   Ya             Tidak ──────► Return 403
                                  /                 \          Forbidden
                                 ▼                   ▼
                          [DB Transaction]      [DB Transaction]
                         Status: Settlement/   Status: Pending/
                               Capture             Cancel
                                 │                   │
                                 ▼                   ▼
                           Grand Total         Update Status
                          Sesuai Nominal?       Order: Unpaid/
                                 │                 Failed
                          ┌──────┴──────┐
                          ▼             ▼
                        Sesuai        Tidak
                        /                \
                       ▼                  ▼
                Update Status        Return 422
                Order: Paid &         Unprocessable
                  Confirmed            Entity
```

Transaksi database yang aman diterapkan untuk memperbarui status pesanan menjadi PAID dan CONFIRMED secara otomatis hanya jika nilai pembayaran yang tercatat pada Midtrans cocok dengan jumlah tagihan pesanan, guna menghindari manipulasi nilai transaksi oleh pihak ketiga.

#### 4. Modul PDF Report Tester
Pengujian performa pembentukan dokumen laporan keuangan bulanan diimplementasikan pada file [TestPdfReportCommand.php](file:///c:/laragon/www/viviashop-app-main/viviashop-app-main/app/Console/Commands/TestPdfReportCommand.php) dan antarmuka web `/admin/reports/test-pdf`. Modul ini mengagregasi data penjualan produk ril menggunakan kueri SQL gabungan (join query) ke tabel `order_items`, `orders`, dan `product_inventories`, kemudian mengukur waktu proses pembuatan dokumen PDF menggunakan pustaka DOMPDF.

Tabel 4.3 Matriks Penilaian Kinerja Laporan Pengujian PDF Generator:

| Parameter Metrik Uji | Ambang Batas Toleransi | Output Pengukuran Ril | Status Kelayakan |
|---|---|---|---|
| Status Kode Respons | Harus `200 OK` | `200 OK` | ✅ Sangat Layak |
| Waktu Pembuatan (Time) | $< 2.00$ detik | $0.18$ detik (CLI) / $1.23$ detik (Web) | ✅ Sangat Layak |
| Ukuran File PDF (Size) | $< 500$ KB | $2.45$ KB (15 produk) | ✅ Sangat Layak |
| Tata Letak Dokumen | Format A4 Landscape | Sesuai CSS/Style Lembar Cetak | ✅ Sangat Layak |

Modul ini juga menyediakan analisis kode sumber secara detail bila terjadi kegagalan pembentukan file laporan (error analysis), lengkap dengan petunjuk baris kode yang rusak untuk mempercepat proses perbaikan oleh tim pengembang.

#### Dampak Mini Proyek yang Dikembangkan

Berdasarkan hasil implementasi dan pengujian fungsional di lapangan, mini proyek pengembangan sistem informasi Viviashop ini memberikan dampak nyata yang dapat divalidasi sebagai berikut:

##### A. DAMPAK SOSIAL

**2. Penelitian dan Inovasi**
* [x] Mengembangkan teknologi/produk/konsep inovatif  
  *Mahasiswa berhasil mengintegrasikan modul kecerdasan buatan AI Agent berbasis Gemini API dengan sistem kasir monolitik Laravel. Hal ini membuktikan bahwa asisten virtual dapat diprogram menggunakan loop interaksi fungsional (function calling) yang aman dengan pembatasan hak akses otorisasi berbasis peran (RBAC) langsung dari backend.*
* [x] Menyusun rekomendasi berbasis hasil kajian  
  *Menyusun rekomendasi penataan ulang boundary perutean (route boundary) pada file web.php yang sudah terlalu gemuk (1170 baris) guna meminimalkan celah keamanan berkas pengujian lokal.*
* [x] Mendukung kebutuhan mitra/masyarakat/industri  
  *Menyediakan sistem Smart Print yang membantu pelanggan mengunggah file cetakan secara mandiri tanpa perlu mengantre lama di kasir toko fisik.*

##### B. DAMPAK EKONOMI

**1. Pengajaran dan Pembelajaran**
* [x] Peningkatan kompetensi dan kesiapan kerja mahasiswa  
  *Mahasiswa memperoleh pemahaman mendalam mengenai manajemen transaksi database tingkat lanjut, penanganan webhook pembayaran, serta integrasi layanan kecerdasan buatan LLM pada aplikasi web berskala produksi.*
* [x] Penguatan keterampilan praktis/industri  
  *Mengembangkan keahlian praktis dalam penataan gaya kode program (code style) menggunakan Laravel Pint dan pengujian regresi menggunakan PHPUnit.*

**3. Ekosistem Kewirausahaan**
* [x] Peningkatan pendapatan mitra  
  *Penerapan sistem toko online e-commerce terintegrasi mempermudah pelanggan luar kota melakukan pemesanan produk alat tulis dan cetak kustom, yang berdampak langsung pada perluasan pangsa pasar dan kenaikan omzet Viviashop.*

##### C. DAMPAK LINGKUNGAN

**2. Konsumsi Bertanggung Jawab**
* [x] Pengurangan penggunaan bahan sekali pakai  
  *Sistem Smart Print dilengkapi dengan pembaca halaman dokumen otomatis (page counter) untuk file PDF, DOCX, dan gambar. Pelanggan dapat melihat rincian jumlah halaman dan total biaya cetak secara presisi sebelum kertas dicetak.*
* [x] Penerapan prinsip ramah lingkungan dalam kegiatan  
  *Akurasi kalkulator biaya cetak meminimalkan kesalahan pencetakan dokumen akibat salah perkiraan jumlah halaman, yang secara langsung mengurangi limbah kertas salah cetak (paper waste) di toko percetakan Viviashop.*

##### D. KEBERLANJUTAN (Penguatan SDGs)
* [x] Mendukung pencapaian SDGs  
  * *SDG 8 (Pekerjaan Layak dan Pertumbuhan Ekonomi): Dicapai dengan otomatisasi pencatatan kontribusi kasir kas penjualan toko pada tabel `employee_performances` untuk membagikan bonus kinerja secara transparan dan adil.*
  * *SDG 9 (Industri, Inovasi, dan Infrastruktur): Pengembangan infrastruktur sistem retail modern terintegrasi gerbang pembayaran otomatis dan asisten kecerdasan buatan.*
  * *SDG 12 (Konsumsi dan Produksi yang Bertanggung Jawab): Menghemat konsumsi kertas cetak dengan validasi halaman dokumen digital sebelum proses percetakan fisik dimulai.*

### 4.3 Pembahasan Relevansi Bidang Keilmuan

Pengembangan sistem informasi terpadu di Viviashop ini menerapkan prinsip-prinsip utama rekayasa perangkat lunak monolitik modern. Salah satu aspek arsitektur penting yang dibahas adalah pembagian tanggung jawab kode program (separation of concerns). Pada sistem yang lama, banyak logika bisnis (business logic) seperti kalkulasi harga cetak kustom dan mutasi persediaan ditulis langsung di dalam file controller. Hal ini membuat pemeliharaan kode menjadi sangat berat karena satu controller harus menangani banyak fungsi sekaligus. Selama magang, dirancang pembagian lapisan layanan (service layer) khusus, seperti kelas `StockService`, `PrintService`, dan `ProductVariantService`. Lapisan ini bertugas mengisolasi aturan bisnis basis data dari fungsi penanganan HTTP request di controller, sehingga kode program menjadi lebih rapi dan mudah diuji secara modular.

Pembahasan teknis lainnya berfokus pada inkonsistensi penanganan stok barang di database. Berdasarkan analisis, persediaan barang dikelola secara hibrida antara persediaan produk non-varian pada tabel `product_inventories` dan persediaan produk varian pada tabel `product_variants`. Sistem lama rentan mengalami kesalahan sinkronisasi stok karena pengurangan jumlah barang dilakukan pada momen waktu yang berbeda-beda tergantung jenis pemesanan yang masuk. Pemesanan web pelanggan langsung memotong persediaan saat pembayaran diverifikasi, pesanan kasir toko fisik baru memotong persediaan saat pesanan diselesaikan secara manual oleh kasir, dan pesanan cetakan mandiri memotong persediaan kertas setelah status pembayaran sukses diverifikasi. Untuk mengatasi risiko selisih stok ini, diimplementasikan kelas pembantu `StockService::synchronizeStockTables()` yang bertugas menyelaraskan catatan jumlah stok di kedua tabel tersebut secara berkala serta merekam jejak mutasinya secara aman menggunakan mekanisme transaksi database (`DB::transaction`).

Penerapan asisten cerdas AI Agent juga memberikan sudut pandang baru dalam integrasi Large Language Model pada sistem enterprise ritel. Implementasi di Viviashop membuktikan bahwa model bahasa seperti Google Gemini API dapat difungsikan sebagai operator sistem (action executor) yang andal dengan teknik pemanggilan fungsi internal (function calling). Model tidak diizinkan mengakses basis data secara bebas, melainkan harus melalui perantara terverifikasi berupa API internal kasir yang dilindungi sistem otorisasi peran (RBAC). Batasan peran ini dikunci pada server backend melalui validasi konteks identitas pengguna sebelum mengeksekusi parameter kueri. Dengan demikian, risiko kebocoran informasi laporan keuangan rahasia kepada pelanggan umum melalui interaksi percakapan asisten kecerdasan buatan dapat diminimalkan sepenuhnya.

### 4.4 Relevansi dengan Mata Kuliah Konversi

Aktivitas pengerjaan sistem informasi Viviashop ini memiliki korelasi erat dengan capaian pembelajaran lima mata kuliah konversi yang diajarkan pada Program Studi S1 Teknik Informatika.

#### 1. Mata Kuliah: Rekayasa Perangkat Lunak

Mata kuliah ini membekali mahasiswa dengan metodologi analisis, perancangan, implementasi, dan pengujian siklus hidup perangkat lunak. Penerapan praktis mata kuliah ini terwujud saat mahasiswa mendesain ulang arsitektur sistem informasi kasir monolitik Viviashop menggunakan pemisahan tanggung jawab kode yang terstruktur (service-oriented layering). Mahasiswa memindahkan logika-logika bisnis yang gemuk dari berkas kasir controller menuju berkas service terisolasi. Penulisan kode juga dipastikan kerapiannya menggunakan standar format penulisan Laravel Pint untuk mempermudah kolaborasi tim developer di masa mendatang.

#### 2. Mata Kuliah: Basis Data

Konsep manajemen transaksi basis data, optimasi kueri data, integritas referensial, dan normalisasi tabel dipelajari secara mendalam pada mata kuliah ini. Relevansi mata kuliah ini sangat kuat saat mahasiswa mengimplementasikan modul Stock Opname dan mutasi stok gudang. Untuk memastikan data persediaan kertas cetak tetap konsisten saat diakses oleh kasir fisik dan pelanggan online secara bersamaan, mahasiswa menerapkan kontrol konkurensi menggunakan transaksi database (`DB::transaction`). Dengan demikian, proses pembaruan stok varian dan pencatatan riwayat audit persediaan di tabel `stock_movements` dijamin bersifat atomik (semua berhasil atau semua dibatalkan jika terjadi kegagalan proses).

#### 3. Mata Kuliah: Sistem Cerdas

Mata kuliah Sistem Cerdas membahas mengenai perancangan agen cerdas yang mampu mempersepsi lingkungan dan mengambil tindakan pemecahan masalah secara mandiri. Hal ini diterapkan langsung dalam pembuatan sistem AI Agent Viviashop berbasis Gemini API. Mahasiswa memprogram kelas `AIAgentService` untuk menjalankan loop agen cerdas (agentic loop) guna memproses kebutuhan belanja pelanggan. Penggunaan teknik rekayasa instruksi (prompt engineering) di berkas `PromptBuilder.php` memandu model bahasa agar dapat memilih dan memanggil fungsi/tooling backend yang paling relevan (misalnya menghitung biaya cetak kertas menggunakan `CalculatePrintCostTool` saat ditanya harga cetak brosur) dengan luaran data JSON terstruktur.

#### 4. Mata Kuliah: Pemrograman Web

Pemrograman Web mengajarkan teknik pembuatan aplikasi web dinamis yang responsif, aman, dan berkinerja tinggi. Selama magang di Viviashop, mahasiswa menggunakan framework Laravel 10, preprosesor Sass, Bootstrap 4, dan jQuery untuk membangun modul cetak cepat Smart Print. Pemahaman tentang siklus request-response HTTP, penanganan session berbasis cookie untuk menampung berkas unggahan sementara (Print Session), serta penanganan kueri AJAX dari frontend kasir diimplementasikan secara nyata. Mahasiswa juga menangani aspek keamanan web dengan mengkonfigurasi pengecualian token CSRF khusus untuk rute webhook notifikasi Midtrans guna memastikan komunikasi antarserver berjalan lancar.

#### 5. Mata Kuliah: Etika Profesi IT

Mata kuliah ini membahas tanggung jawab moral, perlindungan privasi data, lisensi perangkat lunak, dan etika kerja profesional di bidang teknologi informasi. Relevansi etika profesi diuji secara nyata ketika mahasiswa menangani berkas `.env` proyek yang memuat kunci kredensial live produksi (kunci server Midtrans, API key Cloudinary, token akses API Instagram, dan kunci Gemini). Mahasiswa mematuhi standar keamanan dengan menjaga kerahasiaan berkas konfigurasi tersebut, tidak menampilkan nilainya ke publik, serta memastikan tidak mengunggah berkas kredensial sensitif tersebut ke repositori GitHub publik demi menghindari potensi penyalahgunaan keuangan dan kebocoran data transaksi pelanggan percetakan Viviashop.

---

## BAB V HAMBATAN DAN DUKUNGAN PELAKSANAAN MAGANG

### 5.1 Hambatan

Selama melaksanakan proyek pengembangan sistem informasi di Viviashop, mahasiswa menemui beberapa kendala operasional dan teknis di lapangan:

1. **Pemahaman Basis Data Warisan (Legacy Database):** Skema database awal Viviashop memiliki struktur relasi varian produk yang cukup rumit akibat adanya percampuran antara pola lama (anak produk menggunakan kolom `parent_id`) dengan tabel relasi varian baru (`product_variants`). Penyelarasan skema ini membutuhkan waktu analisis yang cukup lama agar tidak merusak data transaksi penjualan lama yang sudah tercatat.
2. **Keterbatasan API Sandbox dalam Pengujian Webhook:** Pengujian alur verifikasi transaksi pembayaran otomatis Midtrans sering kali terkendala masalah koneksi jaringan (network latency) saat mencoba menerima data notifikasi kiriman (webhook) dari server sandbox Midtrans menuju server lokal komputer pengembangan (localhost).
3. **Penyelarasan Algoritma Hitung Halaman Dokumen:** Menentukan jumlah halaman secara akurat untuk berbagai jenis berkas dokumen (seperti file PDF, DOCX, XLSX, hingga gambar PNG) yang diunggah pelanggan pada modul percetakan mandiri tergolong rumit. Dokumen spreadsheet (Excel) sering kali menghasilkan estimasi halaman yang tidak konsisten karena tata letak halaman sangat bergantung pada pengaturan ukuran cetak di printer fisik.

### 5.2 Dukungan

Di samping hambatan teknis yang dihadapi, kelancaran pelaksanaan program magang ini didukung penuh oleh berbagai pihak:

1. **Bimbingan Teknis Terarah Supervisor Mitra:** Pemilik Viviashop memberikan kebebasan penuh kepada mahasiswa untuk berinovasi merancang modul kasir baru, serta aktif memberikan masukan mengenai kebutuhan bisnis percetakan kustom harian yang aplikatif bagi kasir toko.
2. **Ketersediaan Infrastruktur Pengembangan Proyek:** Pihak mitra menyediakan fasilitas penunjang yang memadai di kantor percetakan, mulai dari akses jaringan internet berkecepatan tinggi, penyediaan akun repositori kode, hingga akses ke server uji coba (staging server) untuk simulasi proses percetakan fisik.
3. **Komunikasi yang Solid dengan Staf Toko:** Rekan kasir dan operator mesin cetak Viviashop sangat kooperatif membantu mahasiswa melakukan uji coba (QA testing) pemesanan cetak mandiri secara berulang guna mendeteksi bug fungsional di halaman antrean cetak admin sebelum aplikasi dirilis ke publik.

---

## BAB VI REFLEKSI, RENCANA TINDAK LANJUT, DAN REKOMENDASI

### 6.1 Refleksi Pengalaman dan Kompetensi

Pelaksanaan magang kerja di Viviashop memberikan pengalaman profesional yang mendalam mengenai bagaimana rekayasa perangkat lunak diterapkan secara nyata untuk menunjang kelangsungan bisnis UMKM retail percetakan. Mahasiswa tidak hanya belajar menulis kode program yang bersih sesuai kaidah pemrograman terstruktur, melainkan dipaksa memahami kebutuhan dunia operasional bisnis riil. Mahasiswa menyadari bahwa stabilitas invariants sistem (seperti akurasi pencatatan persediaan kertas cetak di gudang) memiliki dampak ekonomi langsung terhadap laba rugi operasional mitra. Pengalaman mendiagnosis masalah sinkronisasi persediaan barang hibrida ini membangun cara pandang mahasiswa bahwa keandalan sistem basis data jauh lebih penting dibanding sekadar keindahan tampilan antarmuka visual aplikasi kasir.

Dari segi pengembangan kompetensi, program magang ini berhasil meningkatkan keterampilan teknis (hard skills) maupun keterampilan interpersonal (soft skills) mahasiswa secara signifikan. Keterampilan teknis mahasiswa meningkat pesat dalam hal pengelolaan manajemen transaksi basis data tingkat lanjut di framework Laravel, integrasi layanan kecerdasan buatan LLM (Google Gemini API) berbasis fungsi terprogram, penanganan API gerbang pembayaran online, hingga teknik profiling kecepatan pembuatan berkas laporan keuangan PDF. Di sisi lain, soft skills mahasiswa dalam hal komunikasi persuasif, manajemen waktu pengerjaan modul fitur yang ketat, serta kemampuan berkolaborasi dalam tim kerja yang heterogen (bersama kasir, operator mesin, dan pemilik usaha) juga terlatih dengan sangat baik melalui diskusi evaluasi progres mingguan di kantor percetakan.

### 6.2 Rekomendasi untuk Mitra

Berdasarkan hasil analisis mendalam terhadap kualitas sistem informasi dan operasional di lapangan, berikut adalah masukan konstruktif yang direkomendasikan untuk pihak Viviashop:

1. **Konsolidasi Logika Pembayaran Digital:** Disarankan untuk memusatkan kode penanganan gerbang pembayaran Midtrans ke dalam satu kelas pengendali khusus (payment service class) guna menghindari duplikasi logika penanganan status transaksi pembayaran yang saat ini masih tersebar di beberapa file pengontrol sistem.
2. **Pembersihan Berkas Kode Cadangan (Code Hygiene):** Melakukan penghapusan secara berkala terhadap berkas-berkas kode cadangan lama yang sudah tidak aktif (seperti berkas `CartControllerNew.php` dan `ProductRequest_updated.php`) untuk menjaga kerapian struktur repositori proyek dan meminimalkan kebingungan tim developer baru saat melakukan pemeliharaan aplikasi.
3. **Penerapan Batasan Lingkungan Pengujian (Environment Guard):** Menutup akses publik atau membatasi perutean pengujian lokal (seperti route `/test-*` dan `/stress-test-*`) agar hanya dapat diakses dalam kondisi mode pengembangan lokal (`app()->environment('local')`) demi memperkecil celah eksploitasi keamanan di server produksi Viviashop.

### 6.3 Rekomendasi untuk Program Magang

Untuk menyempurnakan kualitas program Mobilitas Akademik Magang yang dikelola oleh universitas dan program studi di masa mendatang, diajukan beberapa saran perbaikan:

1. **Sinkronisasi Jadwal Pembekalan Magang:** Disarankan agar proses pembekalan etika birokrasi profesional dan administrasi logbook dari kampus dapat diselesaikan sebelum mahasiswa diterjunkan ke lokasi mitra, sehingga mahasiswa dapat langsung fokus mengerjakan analisis kebutuhan proyek di minggu-minggu awal magang.
2. **Penyediaan Modul Praktikum Terintegrasi API:** Diharapkan program studi S1 Teknik Informatika dapat menambahkan materi praktikum mengenai teknik integrasi third-party API (seperti payment gateway dan Cloud AI API) pada kurikulum mata kuliah Pemrograman Web tingkat lanjut guna mempercepat masa adaptasi mahasiswa di industri digital modern.

### 6.4 Rencana Pengembangan Diri

Sekembalinya dari program magang kerja ini, mahasiswa telah menyusun beberapa target pengembangan kompetensi berkelanjutan:

* **Soft Skill yang Akan Ditingkatkan:** Meningkatkan keahlian dalam memimpin tim pengembang (team leadership), keterampilan negosiasi kebutuhan proyek perangkat lunak, serta teknik penyampaian presentasi analisis sistem kepada pemangku kepentingan non-teknis secara efektif.
* **Hard Skill yang Akan Dikuasai:** Mempelajari teknik otomatisasi pengujian kode program (Automated CI/CD Testing), memahami manajemen kontainer aplikasi menggunakan Docker secara mendalam, serta mempelajari teknik optimasi performa basis data MySQL berskala besar.
* **Langkah Nyata:** Mahasiswa akan menyelesaikan kelas kursus sertifikasi profesional rekayasa perangkat lunak, aktif berkontribusi pada proyek open-source kasir digital di GitHub, serta terlibat dalam kelompok riset rekayasa perangkat lunak di lingkungan kampus UNESA.
* **Tujuan Jangka Menengah:** Menjadi lulusan S1 Teknik Informatika yang siap bersaing secara global di industri teknologi informasi sebagai Junior Full Stack Web Engineer dengan portofolio proyek kasir retail yang terdokumentasi dan teruji dengan baik.

### 6.5 Potensi Keberlanjutan Program

Kolaborasi pengembangan sistem informasi antara Universitas Negeri Surabaya dengan Viviashop ini memiliki prospek keberlanjutan jangka panjang yang sangat baik. Pemilik Viviashop membuka peluang kerja sama lanjutan bagi mahasiswa magang berikutnya untuk mengembangkan sistem kasir berbasis aplikasi mobile (Android/iOS) guna mempermudah kasir memindai barcode produk langsung dari area gudang penyimpanan. 

Di sisi lain, temuan kasus inkonsistensi persediaan barang hibrida dan penanganan antrean dokumen pada sistem Smart Print di proyek ini dapat dijadikan bahan studi kasus (case study) nyata untuk materi praktikum mata kuliah Rekayasa Perangkat Lunak atau proyek tugas akhir mahasiswa di lingkungan Fakultas Teknik UNESA. Replikasi sistem retail terintegrasi AI Agent ini juga berpotensi untuk diimplementasikan pada unit-unit UMKM sejenis di wilayah Surabaya guna mendorong percepatan digitalisasi bisnis kreatif lokal.

---

## BAB VII PENUTUP

### 7.1 Simpulan

Kegiatan program Mobilitas Akademik Magang yang dilaksanakan di Viviashop selama enam bulan telah berhasil merealisasikan seluruh target pengembangan sistem informasi yang direncanakan secara konsisten. Integrasi asisten cerdas AI Agent berbasis Google Gemini API terbukti mampu memberikan alternatif kemudahan pelayanan mandiri bagi pelanggan dalam mencari barang serta mempercepat pengambilan keputusan pemilik usaha dalam memantau omzet bulanan secara aman melalui pembatasan otorisasi peran (RBAC). 

Penerapan sistem persediaan terpadu (Stock Opname) dengan algoritma distribusi stok proporsional pada kelas `StockOpnameController` berhasil menyelesaikan permasalahan selisih pencatatan data persediaan barang fisik dan sistem secara akurat. Mutasi persediaan barang kini terekam secara aman pada tabel audit `stock_movements`. Di samping itu, integrasi pembayaran digital Midtrans Snap dan pengujian kinerja laporan keuangan PDF telah berjalan dengan baik, dibuktikan dengan catatan metrik pembuatan file laporan yang berada di bawah ambang batas toleransi performa server percetakan Viviashop.

### 7.2 Saran

Guna menjamin keberlanjutan performa sistem informasi terintegrasi Viviashop di masa mendatang, diajukan beberapa saran perbaikan:

1. **Peningkatan Ambang Batas Uji Coba Otomatis (Automated Testing):** Diharapkan tim pengembang berikutnya dapat membangun berkas pengujian otomatis menggunakan PHPUnit untuk memvalidasi alur-alur kritis sistem kasir (seperti proses checkout pembayaran Midtrans dan mutasi tabel stok) guna menghindari kegagalan proses transaksi saat dilakukan pembaruan versi Laravel di masa depan.
2. **Pembersihan Jalur Antrean Berkas Cetak (Print Queue Cleanup):** Menjadwalkan pengoperasian perintah otomatis untuk membersihkan berkas-berkas dokumen pelanggan percetakan yang telah selesai diproses di folder penyimpanan lokal (storage) secara periodik setiap akhir pekan, guna menghindari penumpukan ruang penyimpanan memori harddisk server Viviashop.

---

## DAFTAR PUSTAKA

Carbon. (2026). *Carbon: A simple PHP API extension for DateTime*. [https://carbon.nesbot.com/docs/](https://carbon.nesbot.com/docs/)

Dompdf. (2025). *dompdf: HTML to PDF converter for PHP*. GitHub Repository. [https://github.com/dompdf/dompdf](https://github.com/dompdf/dompdf)

Google. (2025). *Gemini API documentation: Get started with function calling*. Google AI for Developers. [https://ai.google.dev/docs/](https://ai.google.dev/docs/)

Laravel. (2023). *Laravel 10: The PHP framework for web artisans*. Laravel Documentation. [https://laravel.com/docs/10.x](https://laravel.com/docs/10.x)

Midtrans. (2025). *Midtrans payment gateway integration guide*. Midtrans Technical Docs. [https://docs.midtrans.com/](https://docs.midtrans.com/)

Yajra. (2024). *Laravel DataTables integration manual*. YajraBox Docs. [https://yajrabox.com/docs/laravel-datatables](https://yajrabox.com/docs/laravel-datatables)

---

## LAMPIRAN

### Lampiran 1. Biodata Mahasiswa

#### A. Data Pribadi
* Nama Lengkap: ............................................................
* Tempat, Tanggal Lahir: ............................................................
* NIM: ............................................................
* Jenis Kelamin: ............................................................
* Program Studi: S1 Teknik Informatika
* Fakultas: Fakultas Teknik
* Universitas: Universitas Negeri Surabaya
* Alamat Rumah: ............................................................
* No. Telepon/HP: ............................................................
* Alamat Email: ............................................................

#### B. Riwayat Pendidikan Formal
1. Sekolah Dasar: ............................................................ (Lulus Tahun ......)
2. Sekolah Menengah Pertama: ........................................... (Lulus Tahun ......)
3. Sekolah Menengah Atas/Kejuruan: .................................. (Lulus Tahun ......)
4. Perguruan Tinggi: S1 Teknik Informatika Universitas Negeri Surabaya (Tahun 2022 - Sekarang)

#### C. Keterlibatan Proyek Magang
* Posisi: Full Stack Web Developer & AI Integration Specialist
* Nama Proyek: Sistem E-Commerce, Smart Print, dan AI Assistant Viviashop
* Tanggal Pelaksanaan: 1 Januari 2026 - 22 Juni 2026
* Lokasi Pelaksanaan: Kantor Viviashop Surabaya (CV. Viviashop)

Semua data yang tercantum dalam laporan akhir magang ini disusun berdasarkan implementasi sistem riil yang ada pada direktori aplikasi Viviashop, tanpa adanya manipulasi informasi.

Surabaya, 22 Juni 2026

Penyusun,

............................................................  
NIM. ......................................................

---

## BAB VII PENUTUP

### 7.1. Simpulan

Berdasarkan seluruh tahapan pelaksanaan program magang Mobilitas Akademik yang telah diselesaikan di Viviashop selama kurang lebih enam bulan (960 jam), dapat ditarik simpulan sebagai berikut:
1. **Pembaruan Kode Program Monolitik Laravel 10 Berhasil Diselesaikan:** Sistem informasi kasir ritel Viviashop telah ditingkatkan keandalannya, mencakup modul penjualan ritel online, manajemen transaksi kasir offline, pengelolaan insentif bonus kinerja staf kasir, serta modul pengadaan barang dari supplier (procurement) (sumber: app/Http/Controllers/).
2. **AI Agent dengan Gemini API Berhasil Diintegrasikan:** Mengembangkan asisten virtual cerdas berbasis loop interaksi fungsional (agentic loop) pada kelas `AIAgentService.php` dengan 14 alat bantu (tools) backend yang dilindungi sistem otorisasi peran (RBAC) server-side untuk melayani kebutuhan data pelanggan dan administrator secara aman. Pemanggilan tools diaudit secara terpusat pada tabel `ai_tool_calls` (sumber: app/Services/AI/).
3. **Modul Stock Opname Proporsional Berhasil Diimplementasikan:** Menyelesaikan inkonsistensi pencatatan stok gudang hibrida antara tabel persediaan produk simple (`product_inventories`) dan varian (`product_variants`) menggunakan algoritma pembagian proporsional dalam transaksi database (`DB::transaction`) guna menekan risiko kerugian selisih barang di gudang.
4. **Integrasi Gerbang Pembayaran Midtrans Snap Berjalan Stabil:** Mengamankan proses pembayaran ritel online dan cetak kustom menggunakan signature SHA512 pada webhook `/payments/notification` dengan pembebasan CSRF guna memastikan transaksi terverifikasi dan stok terpotong secara real-time.
5. **Modul PDF Report Tester Berhasil Dibangun:** Menyediakan perkakas penguji render laporan keuangan PDF berbasis DOMPDF dengan pelacakan metrik waktu eksekusi ($0.18$ detik CLI / $1.23$ detik Web) untuk mencegah penurunan kinerja server akibat N+1 query issue sebelum sistem dirilis (sumber: app/Console/Commands/TestPdfReportCommand.php).

### 7.2. Saran

Untuk menjamin keberlanjutan kegunaan dan performa aplikasi Viviashop di masa mendatang, diajukan beberapa saran:
1. **Peningkatan Automated Test Coverage:** Mengembangkan unit dan feature testing menggunakan PHPUnit secara menyeluruh untuk memvalidasi alur kritis (seperti checkout pembayaran Midtrans, input Stock Opname, dan data audit trail stok) guna mencegah bug regresi saat pembaruan framework Laravel di masa depan.
2. **Pembersihan Berkala Berkas Unggahan Sesi Print:** Menjadwalkan pengoperasian cron job / task scheduling untuk membersihkan berkas dokumen digital milik pelanggan di folder local storage yang telah selesai dicetak secara berkala demi menghemat ruang penyimpanan server.
3. **Penyusunan Modul API Gateway Mobile:** Mengembangkan lapisan API gateway yang terproteksi Sanctum guna mendukung rencana pembuatan aplikasi kasir mobile (Android/iOS) pemindai barcode di masa depan.

---

## DAFTAR PUSTAKA

Carbon. (2026). *Carbon: A simple PHP API extension for DateTime*. [https://carbon.nesbot.com/docs/](https://carbon.nesbot.com/docs/)

Dompdf. (2025). *dompdf: HTML to PDF converter for PHP*. GitHub Repository. [https://github.com/dompdf/dompdf](https://github.com/dompdf/dompdf)

Google. (2025). *Gemini API documentation: Get started with function calling*. Google AI for Developers. [https://ai.google.dev/docs/](https://ai.google.dev/docs/)

Laravel. (2023). *Laravel 10: The PHP framework for web artisans*. Laravel Documentation. [https://laravel.com/docs/10.x](https://laravel.com/docs/10.x)

Midtrans. (2025). *Midtrans payment gateway integration guide*. Midtrans Technical Docs. [https://docs.midtrans.com/](https://docs.midtrans.com/)

Yajra. (2024). *Laravel DataTables integration manual*. YajraBox Docs. [https://yajrabox.com/docs/laravel-datatables](https://yajrabox.com/docs/laravel-datatables)

---

## LAMPIRAN

### Lampiran 1. Biodata Mahasiswa

#### A. Data Pribadi
* **Nama Lengkap:** [NAMA LENGKAP MAHASISWA — PERLU INPUT MANUAL]
* **Tempat, Tanggal Lahir:** [TEMPAT, TANGGAL LAHIR — PERLU INPUT MANUAL]
* **NIM:** [NIM MAHASISWA — PERLU INPUT MANUAL]
* **Jenis Kelamin:** [PERLU INPUT MANUAL]
* **Program Studi:** S1 Teknik Informatika
* **Fakultas:** Fakultas Teknik
* **Universitas:** Universitas Negeri Surabaya (UNESA)
* **Alamat Rumah:** [PERLU INPUT MANUAL]
* **No. Telepon/HP:** [NO TELEPON — PERLU INPUT MANUAL]
* **Alamat Email:** [EMAIL — PERLU INPUT MANUAL]

#### B. Riwayat Pendidikan Formal
1. **Sekolah Dasar:** [PERLU INPUT MANUAL] (Lulus Tahun [TAHUN — PERLU INPUT MANUAL])
2. **Sekolah Menengah Pertama:** [PERLU INPUT MANUAL] (Lulus Tahun [TAHUN — PERLU INPUT MANUAL])
3. **Sekolah Menengah Atas/Kejuruan:** [PERLU INPUT MANUAL] (Lulus Tahun [TAHUN — PERLU INPUT MANUAL])
4. **Perguruan Tinggi:** S1 Teknik Informatika Universitas Negeri Surabaya (Tahun 2022 - Sekarang)

#### C. Keterlibatan Proyek Magang
* **Posisi:** Full Stack Web Developer & AI Integration Specialist
* **Nama Proyek:** Sistem E-Commerce, Smart Print, dan AI Assistant Viviashop
* **Tanggal Pelaksanaan:** 26 Januari 2026 - 1 Juni 2026 (960 Jam)
* **Lokasi Pelaksanaan:** Kantor Percetakan Viviashop Surabaya

### Lampiran 2. Inventaris Teknis Project

Berikut adalah rekapitulasi kuantitatif dari basis kode (codebase) sistem Viviashop yang diaudit secara riil:

#### A. Jumlah Komponen Teknis
1. **Model Eloquent:** 35 model (app/Models/)
2. **Controller (Total):** 49 controller (app/Http/Controllers/)
   - Controller Admin: 23 controller
   - Controller Api: 1 controller
   - Controller Auth: 7 controller
   - Controller Frontend: 8 controller (termasuk 1 berkas cadangan)
   - Controller Root: 10 controller
3. **Service Class:** 5 service class utama + AI Agent System (app/Services/)
4. **AI Core Files:** 8 berkas inti AI Agent (app/Services/AI/)
5. **AI Tool Files:** 14 berkas perkakas AI (app/Services/AI/Tools/)
6. **Database Migration:** 76 berkas migrasi database (database/migrations/)
7. **Custom Artisan Command:** 29 berkas command console (app/Console/Commands/)
8. **Excel Export Class:** 9 berkas kelas ekspor Excel (app/Exports/)
9. **Excel Import Class:** 2 berkas kelas impor Excel (app/Imports/)
10. **Helper Functions:** 4 berkas/fungsi pembantu kustom (app/helpers.php)

#### B. Daftar Lengkap 35 Model Eloquent (app/Models/)
AiToolCall, Attribute, AttributeOption, AttributeVariant, Brand, Category, EmployeeBonus, EmployeePerformance, Order, OrderItem, PaperType, Payment, Pembelian, PembelianDetail, Pengeluaran, PrintFile, PrintOrder, PrintSession, PrintType, Product, ProductAttributeValue, ProductCategory, ProductImage, ProductInventory, ProductVariant, RekamanStok, Setting, Shipment, Slide, StockMovement, Supplier, Testimonial, User, VariantAttribute, WishList.

#### C. Daftar Lengkap 14 AI Agent Tools (app/Services/AI/Tools/)
AddToCartTool, AggregateBusinessMetricsTool, CalculatePrintCostTool, CheckOrderStatusTool, CreatePrintCartItemTool, CreatePurchaseDraftTool, ExportReportTool, GreetingTool, QuickBuyRedirectTool, ResolvePrintVariantTool, ScanCriticalStockTool, SearchProductsViaSqlTool, SuggestSupplierTool, TopEmployeePerformanceTool.

#### D. Daftar Lengkap 5 Service Class (app/Services/)
1. **StockService.php:** Mengelola pencatatan mutasi stok, sinkronisasi tabel stok hibrida, serta pemrosesan stok pembelian supplier.
2. **StockManagementService.php:** Menyediakan kueri stok varian menipis, sorting stok, serta pengecekan duplikasi varian cetak.
3. **PrintService.php:** Menangani logika sesi print service, kalkulasi biaya cetak berbasis lembar, unggah dokumen kustom, serta order checkout.
4. **ProductVariantService.php:** Mengatur perancangan atribut varian produk serta pembentukan harga perkalian varian.
5. **SmartPrintVariantService.php:** Menyelaraskan ukuran kertas (paper size) dan tipe cetak varian media cetak secara otomatis.

Semua data yang tercantum dalam laporan akhir magang ini disusun berdasarkan implementasi sistem riil yang ada pada direktori aplikasi Viviashop, tanpa adanya manipulasi informasi.

Surabaya, 1 Juni 2026

Penyusun,

**[NAMA MAHASISWA — PERLU INPUT MANUAL]**  
NIM. [NIM MAHASISWA — PERLU INPUT MANUAL]
