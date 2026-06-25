
# LAPORAN AKHIR MAGANG

## PENGEMBANGAN SISTEM TERINTEGRASI E-COMMERCE DAN ERP VIVIASHOP BERBASIS ARSITEKTUR HYBRID CLOUD DAN PEMROSESAN TERDISTRIBUSI

Di CV Sinar Agung Jaya

Penyusun:

**Raihan Rizki Alfareza**
NIM: 23051204067

UNIVERSITAS NEGERI SURABAYA
FAKULTAS TEKNIK, PROGRAM STUDI S1 TEKNIK INFORMATIKA
Tahun 2026

---

## LEMBAR PENGESAHAN

**Judul Kegiatan:** Pengembangan Sistem Terintegrasi E-Commerce dan ERP Viviashop Berbasis Arsitektur Hybrid Cloud dan Pemrosesan Terdistribusi

**Nama Instansi:** CV Sinar Agung Jaya

**Alamat Instansi:** Tebu Ireng IV No.38, Cukir, Kec. Diwek, Kabupaten Jombang, Jawa Timur 61471

**Identitas Mahasiswa:**

| Field | Isian |
|---|---|
| Nama | Raihan Rizki Alfareza |
| NIM | 23051204067 |
| Prodi/Jurusan | S1 Teknik Informatika |
| Fakultas | Teknik |
| No. Tlp. | 085155228237 |
| Alamat | Jl. Ketintang Wiyata Gedung A10, Ketintang, Gayungan, Surabaya, East Java 60231 |
| Email | raihan.23067@mhs.unesa.ac.id |

**Periode Magang:** 26 Januari 2026 s/d 1 Juni 2026

---

Surabaya, Juni 2026

Mengetahui,

| Dosen Pembimbing Lapangan | Mahasiswa |
|---|---|
| | |
| | |
| **I Made Suartana, S.Kom., M.Kom.** | **Raihan Rizki Alfareza** |
| NIP. 198411242015041003 | NIM. 23051204067 |

Menyetujui,

| Pembimbing Mitra | Koordinator Program Studi |
|---|---|
| | |
| | |
| **Fanani Agung Widyanto** | **Paramitha Nerisafitra, S.ST., M.Kom.** |
| | NIP. 198905292019032013 |

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**

---

## DAFTAR ISI

| Bagian | Halaman |
|---|---|
| DAFTAR ISI | i |
| DAFTAR TABEL | ii |
| DAFTAR GAMBAR | iii |
| BAB I. PENDAHULUAN | 1 |
| 1.1 Latar Belakang | 1 |
| 1.2 Rumusan Masalah | 3 |
| 1.3 Tujuan Magang | 4 |
| 1.4 Manfaat Magang | 5 |
| 1.5 Urgensi Magang | 6 |
| 1.6 Kontribusi Riset terhadap Ilmu Pengetahuan | 6 |
| 1.7 Luaran Magang | 7 |
| BAB II. TINJAUAN PUSTAKA | 8 |
| 2.1 Penjelasan Industri yang Diikuti | 8 |
| 2.2 Struktur Organisasi Industri | 10 |
| 2.3 Kerangka Konseptual Program Magang Berdampak | 11 |
| BAB III. METODE PELAKSANAAN | 14 |
| 3.1 Bentuk Penugasan (Task Assignment) | 14 |
| 3.2 Waktu | 15 |
| 3.3 Prosedur | 15 |
| BAB IV. PELAKSANAAN KEGIATAN YANG RELEVAN DENGAN KONVERSI MATA KULIAH | 19 |
| 4.1 Aktivitas Harian yang Dikerjakan Selama di Mitra | 19 |
| 4.2 Hasil Proyek yang Telah Dikembangkan | 28 |
| 4.3 Pembahasan Mengenai Relevansi dengan Keilmuan Program Studi | 36 |
| 4.4 Relevansi dengan Mata Kuliah Konversi | 38 |
| BAB V. HAMBATAN DAN DUKUNGAN PELAKSANAAN MAGANG | 49 |
| 5.1 Hambatan | 49 |
| 5.2 Dukungan | 51 |
| BAB VI. REFLEKSI, RENCANA TINDAK LANJUT & REKOMENDASI | 52 |
| 6.1 Refleksi | 52 |
| 6.2 Rekomendasi untuk Mitra | 55 |
| 6.3 Rekomendasi untuk Program Magang | 56 |
| 6.4 Rencana Pengembangan Diri | 57 |
| 6.5 Potensi Keberlanjutan Program | 58 |
| BAB VII. PENUTUP | 59 |
| 7.1 Simpulan | 59 |
| 7.2 Saran | 60 |
| DAFTAR PUSTAKA | 62 |
| LAMPIRAN | 64 |

---

## DAFTAR TABEL

[DAFTAR TABEL, diisi setelah laporan selesai]

Tabel 1. Jadwal Aktivitas Harian Minggu ke-4 dan ke-5 Januari 2026
Tabel 2. Jadwal Aktivitas Harian Februari 2026
Tabel 3. Jadwal Aktivitas Harian Maret 2026
Tabel 4. Jadwal Aktivitas Harian April 2026
Tabel 5. Jadwal Aktivitas Harian Mei-Juni 2026
Tabel 6. Teknik Pelaksanaan Magang
Tabel 7. Ringkasan Mata Kuliah Konversi

---

## DAFTAR GAMBAR

[DAFTAR GAMBAR, diisi setelah laporan selesai]

Gambar 1. Struktur Organisasi CV Sinar Agung Jaya
Gambar 2. Arsitektur Sistem Viviashop
Gambar 3. Tampilan Dashboard Admin Viviashop
Gambar 4. Tampilan Antarmuka AI Agent Chatbot
Gambar 5. Alur Smart Print Service
Gambar 6. Tampilan Laporan Revenue
Gambar 7. Dokumentasi Aktivitas Magang

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**


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


## BAB II
## TINJAUAN PUSTAKA

## 2.1 Penjelasan Industri yang Diikuti

CV Sinar Agung Jaya adalah perusahaan yang berbasis di Kabupaten Jombang, Jawa Timur, dengan fokus pada penyediaan solusi terintegrasi untuk instansi pemerintah dan sektor swasta. Model bisnis perusahaan ini tidak bergantung pada satu lini tunggal, melainkan ada tiga pilar yang berjalan bersamaan dan saling mendukung.

Pilar pertama adalah pengadaan Alat Tulis Kantor (ATK) dan layanan cetak *on-demand*. CV Sinar Agung Jaya melayani kebutuhan cetak kustom untuk berbagai keperluan, mulai dari dokumen adminsitrasi instansi pemerintah dalam volume besar hingga pesanan retail individual. Di sinilah platform Viviashop mengambil peran sentral karena sistem print service yang dibangun di dalam platform ini menangani alur pesanan cetak secara digital, dari unggah file oleh pelanggan hingga perhitungan biaya dan pembayaran.

Pilar kedua adalah solusi Teknologi Informasi. Perusahaan menyediakan pengadaan perangkat keras komputer sekaligus mengembangkan perangkat lunak berbasis web untuk mendukung digitalisasi administrasi mitra. Viviashop adalah produk nyata dari lini bisnis ini, yaitu platform yang awalnya dibangun untuk mendukung operasional internal, kemudian berkembang menjadi sistem e-commerce yang juga dapat diakses oleh pelanggan eksternal.

Pilar ketiga adalah konveksi kebutuhan event dan operasional: produksi tas, rompi, jaket, dan seragam lapangan untuk lembaga-lembaga yang memerlukan perlengkapan seragam dalam jumlah besar. Lini ini lebih bersifat manufaktur tradisional, tetapi rantai pengadaan dan manajemen pesanannya juga diintegrasikan ke dalam sistem.

Ketiga lini ini terhubung melalui satu platform digital: Viviashop. Dari sudut pandang teknis, Viviashop adalah aplikasi web monolitik berbasis Laravel 10 yang mengelola seluruh alur bisnis, mulai dari katalog produk, keranjang belanja, checkout, payment gateway, manajemen stok, laporan keuangan, hingga dashboard performa karyawan. Platform ini berfungsi sebagai sistem ERP (Enterprise Resource Planning) terintegrasi untuk mendukung operasional CV Sinar Agung Jaya.

### Posisi e-Commerce dalam Ekosistem Bisnis CV Sinar Agung Jaya

E-commerce di Indonesia tumbuh pesat dalam satu dekade terakhir. Menurut berbagai laporan industri, nilai transaksi e-commerce Indonesia melampaui USD 50 miliar pada tahun 2023, dengan proyeksi pertumbuhan yang konsisten memasuki tahun 2026 (Statista, 2024). Pertumbuhan ini tidak hanya didominasi oleh platform besar seperti Tokopedia atau Shopee, tetapi juga mendorong ribuan bisnis skala menengah untuk membangun saluran penjualan digital sendiri, baik untuk menghindari ketergantungan pada marketplace pihak ketiga maupun untuk membangun pengalaman pelanggan yang lebih terkontrol.

CV Sinar Agung Jaya memilih jalur yang kedua. Dengan membangun Viviashop sebagai platform mandiri, perusahaan mendapatkan fleksibilitas penuh dalam menentukan alur bisnis, struktur harga, dan pengalaman pelanggan, sesuatu yang tidak mungkin dilakukan di dalam ekosistem marketplace. Keputusan untuk menggunakan Laravel sebagai framework backend juga mencerminkan pertimbangan teknis yang matang, mengingat ekosistem Laravel yang kaya (dari Sanctum untuk autentikasi API hingga maatwebsite/excel untuk ekspor laporan) memungkinkan pengembangan fitur-fitur bisnis yang spesifik tanpa harus membangun komponen dasar dari nol.

Produk dan layanan utama yang ditawarkan melalui Viviashop mencakup:

- **Produk fisik.** Barang-barang yang dikelola melalui modul e-commerce standar: katalog, varian, stok, dan checkout.
- **Layanan cetak (*Print Service*).** Pesanan cetak dokumen dengan sistem unggah file, pemilihan jenis kertas dan tipe cetak, kalkulasi biaya otomatis, dan pembayaran terintegrasi.
- **Smart Print.** Variasi layanan cetak yang menggunakan deteksi otomatis jenis kertas dan tipe cetak menggunakan `SmartPrintVariantService`.
- **Layanan pengadaan.** Melalui modul pembelian (`Pembelian`, `PembelianDetail`, `Supplier`) yang mengintegrasikan rantai pasokan ke dalam platform yang sama.

Keunggulan kompetitif Viviashop terletak pada integrasi yang erat antara sistem e-commerce, manajemen stok, laporan keuangan, dan kecerdasan buatan dalam satu platform. Chatbot AI berbasis Google Gemini yang terintegrasi di dalam sistem dapat memanggil 13 tool berbeda secara dinamis, dari pencarian produk berbasis SQL hingga pemindaian stok kritis dan pembuatan draft pembelian secara otomatis.

---

## 2.2 Struktur Organisasi Industri

[GAMBAR/BAGAN: Struktur Organisasi CV Sinar Agung Jaya, PERLU INPUT MANUAL dari pihak mitra]

Struktur organisasi formal CV Sinar Agung Jaya tidak terdokumentasikan secara eksplisit dalam materi yang dapat diakses selama magang. Berdasarkan pengamatan langsung dan interaksi dengan tim, pembagian kerja yang berlaku selama periode magang digambarkan di bawah ini.

- **Pimpinan / Owner.** Pengambil keputusan strategis, termasuk keputusan investasi teknologi dan arah pengembangan platform Viviashop.
- **Tim Pengembang Perangkat Lunak.** Bertanggung jawab atas pembangunan dan pemeliharaan platform Viviashop. Tim ini terdiri dari beberapa pengembang senior dan posisi magang yang diisi oleh mahasiswa UNESA.
- **Pembimbing Mitra.** Fanani Agung Widyanto, yang memimpin dan mengawasi tim pengembang serta menjadi narasumber teknis utama selama magang berlangsung.
- **Bagian Operasional.** Tim yang menangani pengadaan, konveksi, dan layanan cetak di sisi non-digital.
- **Mahasiswa Magang (posisi saya).** Ditempatkan di dalam tim pengembang, dengan akses penuh ke repository dan lingkungan pengembangan lokal, berkontribusi langsung pada pengembangan fitur dan perbaikan bug.

Sebagai mahasiswa magang, saya langsung terlibat aktif dengan mendapatkan akses ke repositori git untuk berpartisipasi dalam pengembangan platform. Pembimbing mitra berperan sebagai *tech lead*, memberikan arahan tugas, melakukan code review, dan membimbing penyelesaian kendala teknis.

[PERLU INPUT MANUAL, diagram resmi struktur organisasi dari manajemen CV Sinar Agung Jaya untuk dilampirkan sebagai gambar di laporan cetak]

---

## 2.3 Kerangka Konseptual Program Magang Berdampak

### Konsep dan Indikator Program Magang Berdampak

Program magang berdampak (*impactful internship*) menitikberatkan pada kontribusi langsung mahasiswa dalam menyelesaikan permasalahan di tempat mitra melalui penerapan kompetensi akademik (Purdue University, 2021; UNESA Panduan Mobilitas Akademik, 2024).

Indikator keberhasilannya mencakup dua sisi:

**Outcome untuk mahasiswa:**
- Perolehan keterampilan teknis yang terverifikasi secara praktis.
- Pemahaman konteks kerja nyata: bagaimana sebuah tim bekerja, bagaimana keputusan teknis diambil di bawah tekanan waktu, dan bagaimana mengelola prioritas yang saling bersaing
- Perluasan jaringan profesional melalui kolaborasi kerja tim secara langsung.

**Outcome untuk mitra:**
- Kontribusi yang terukur: fitur yang selesai, bug yang terperbaiki, dokumentasi yang tertulis
- Rekomendasi berbasis pengamatan dari perspektif orang luar yang segar, di mana mahasiswa yang baru masuk ke sistem sering kali melihat hal yang sudah tak lagi diperhatikan oleh tim internal
- Transfer pengetahuan: metodologi atau tools yang diperkenalkan mahasiswa dari lingkungan akademis yang kadang lebih terkini

### Landasan Teoritis yang Relevan dengan Proyek Viviashop

**Arsitektur MVC dalam Framework Laravel.** Laravel mengimplementasikan pola *Model-View-Controller* (MVC) sebagai arsitektur dasarnya. Pressman (2014) mendefinisikan MVC sebagai pola yang memisahkan representasi informasi dari cara pengguna berinteraksi dengannya. Dalam konteks Viviashop, Model direpresentasikan oleh 35 kelas Eloquent, View oleh template Blade, dan Controller oleh lebih dari 40 kelas controller yang tersebar dalam empat namespace (*Admin*, *Frontend*, *Api*, *Auth*).

**Service Layer Pattern.** Fowler (2002) dalam *Patterns of Enterprise Application Architecture* mendeskripsikan Service Layer sebagai lapisan yang mendefinisikan batas operasi aplikasi dan mengenkapsulasi logika bisnis yang tidak seharusnya berada di Controller. Viviashop mengimplementasikan pola ini melalui lima service utama: `StockManagementService`, `StockService`, `PrintService`, `ProductVariantService`, dan `SmartPrintVariantService`. Pola ini menjadi sangat relevan ketika saya merefaktor `StockManagementService` untuk menghilangkan duplikasi logika update stok.

**RESTful API dan Integrasi Layanan Eksternal.** Fielding (2000) mendefinisikan REST sebagai gaya arsitektur yang mengandalkan protokol HTTP dan sumber daya yang dapat diidentifikasi melalui URI. Viviashop mengintegrasikan tiga layanan eksternal berbasis API: Midtrans untuk pembayaran, RajaOngkir/Komerce untuk kalkulasi ongkir, dan Google Gemini untuk inferensi kecerdasan buatan. Pengelolaan ketiga integrasi ini menjadi bagian signifikan dari pekerjaan selama magang.

**Large Language Model sebagai Komponen Sistem.** Brown et al. (2020) memperkenalkan konsep *few-shot learning* dalam model bahasa besar, yang menjadi fondasi cara model Gemini bekerja dalam sistem AI agent Viviashop. Pola `ToolDispatcher` yang mengizinkan LLM untuk memanggil fungsi eksternal secara dinamis mencerminkan pendekatan *function calling* atau *tool use* yang mulai menjadi standar integrasi LLM ke dalam aplikasi bisnis (Schick et al., 2023).

**Pengujian Perangkat Lunak.** Sommerville (2019) membagi pengujian perangkat lunak menjadi pengujian unit, integrasi, dan sistem. Selama magang, saya berkontribusi pada ketiga level ini: menulis unit test untuk `ProductController` menggunakan PHPUnit, pengujian integrasi untuk alur order-payment dengan Midtrans sandbox, dan pengujian end-to-end untuk keseluruhan alur belanja dari akun dummy.

**Virtualisasi dan Deployment.** Dalam konteks Viviashop, deployment dilakukan secara manual ke server VPS, bukan menggunakan platform cloud terkelola. Proses ini mencakup kloning repository, konfigurasi `.env`, migrasi database, kompilasi aset dengan Vite (`npm run build`), dan setup cron job untuk artisan scheduler. Pengalaman ini memberikan pemahaman langsung tentang perbedaan antara lingkungan development dan production yang sering menjadi sumber bug tersembunyi.

### Pendekatan Pengukuran Dampak

Dampak dari keterlibatan mahasiswa diukur melalui tiga instrumen utama:

1. **Logbook harian**, yaitu 96 entri yang mencatat setiap aktivitas, dengan total durasi 960 jam. Logbook ini disubmit secara periodik ke sistem kampus dan diverifikasi oleh pembimbing lapangan.
2. **Output teknis yang terverifikasi**, berupa kode yang di-*commit* ke repository, fitur yang berfungsi, dan dokumentasi yang tersedia dapat ditelusuri dan diverifikasi secara independen.
3. **Evaluasi pembimbing mitra**, yaitu penilaian formal dari Fanani Agung Widyanto atas aspek teknis, kedisiplinan, komunikasi, dan dampak nyata dari pekerjaan yang diselesaikan.

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**


## BAB III
## METODE PELAKSANAAN

## 3.1 Bentuk Penugasan (Task Assignment)

Selama magang di CV Sinar Agung Jaya, saya ditempatkan sebagai software developer dalam tim pengembang perangkat lunak Viviashop, berkolaborasi dengan pengembang senior pada codebase aktif.

Tanggung jawab utama yang dibebankan mencakup beberapa area:

**Pengembangan fitur baru.** Saya dilibatkan dalam penambahan fungsionalitas yang memang sedang dalam rencana pengembangan tim, seperti implementasi tool baru untuk AI agent (`SuggestSupplierTool`), fitur export data user ke Excel, fitur brand produk, dan perbaikan sistem logging harian.

**Perbaikan bug (bug fixing).** Sebagian besar tugas harian bersifat reaktif dengan merespons laporan bug dari tim QA atau pembimbing mitra. Bug-bug yang saya tangani mencakup berbagai lapisan: dari query database yang salah (eager loading `OrderItem` yang hilang di `OrderController`), masalah path storage (storage tidak ter-link sehingga gambar tidak muncul), hingga masalah integrasi API (Midtrans signature key tidak terverifikasi, RajaOngkir API key tidak terbaca dari `.env`).

**Optimasi performa.** Di beberapa titik, saya mendapat tugas spesifik untuk memperbaiki performa halaman yang lambat, khususnya masalah N+1 query di `ProductController` dan query varian produk di panel admin. Pengujian dengan data dummy 1.000 produk menunjukkan penurunan waktu muat yang signifikan setelah penambahan eager loading dan indexing database.

**Refaktor kode.** Saya terlibat dalam beberapa sesi refaktor bersama senior, termasuk pemisahan logika bisnis dari `CategoryController` ke `CategoryService`, konsolidasi metode duplikat di `StockManagementService`, dan pembersihan puluhan artisan command yang tidak lagi digunakan.

**Pengujian.** Mulai dari unit test PHPUnit untuk `ProductController`, hingga pengujian integrasi sistem pembayaran Midtrans menggunakan akun sandbox, hingga pengujian end-to-end seluruh alur belanja dari browser.

**Dokumentasi.** Menulis dokumentasi teknis di Notion (alur AI agent, setup Midtrans, panduan QA), membuat panduan pengguna dalam format Markdown, dan berkontribusi pada dokumentasi API internal.

Sebelum mulai berkontribusi aktif, saya melakukan observasi awal selama tiga hari pertama (26 sampai 28 Januari 2026) dengan membaca dokumentasi teknis yang tersedia (`DOKUMENTASI_TEKNIS_VIVIASHOP.md`, 1.439 baris), mengeksplorasi struktur folder project, menelusuri file `routes/web.php` yang berisi lebih dari 1.150 baris route, dan mencoba menjalankan beberapa fitur di lingkungan development lokal.

---

## 3.2 Waktu

Kegiatan magang dilaksanakan selama **4 bulan lebih**, terhitung mulai **26 Januari 2026 hingga 1 Juni 2026**. Total durasi yang terlaksana adalah **960 jam** (setara dengan 57.600 menit), sebagaimana tercatat dalam 96 entri logbook yang disubmit ke sistem Mobilitas Akademik UNESA.

Jadwal kerja menyesuaikan dengan kebiasaan tim pengembang CV Sinar Agung Jaya:
- **Senin sampai Jumat:** hari kerja reguler, sekitar 8 hingga 10 jam per hari
- **Sabtu:** beberapa hari Sabtu digunakan untuk penyelesaian tugas tertentu (code review, optimasi, testing)
- **Hari libur nasional:** sebagian dijalankan sebagai *Work From Anywhere* (WFA), termasuk hari libur Nyepi, Idul Fitri, Jumat Agung, Paskah, Kenaikan Yesus Kristus, dan Idul Adha, untuk tugas-tugas yang bisa dikerjakan secara remote

Kegiatan magang berpusat di lokasi kerja CV Sinar Agung Jaya di Jombang, dengan fleksibilitas WFA untuk hari-hari tertentu yang telah dikoordinasikan dengan pembimbing mitra.

---

## 3.3 Prosedur

Pelaksanaan program magang mengikuti tahapan sistematis yang dirancang agar proses berjalan terarah dan memberikan manfaat maksimal bagi semua pihak. Tahapan-tahapan yang dilalui mencakup rangkaian proses di bawah ini.

**1. Observasi Permasalahan Mitra dan Posisi Magang**

Sebelum mengajukan proposal formal, saya melakukan observasi awal untuk memahami kebutuhan CV Sinar Agung Jaya. Dari sini teridentifikasi bahwa perusahaan sedang aktif membangun platform e-commerce Viviashop dan membutuhkan tenaga pengembang tambahan untuk mempercepat proses pengembangan. Posisi yang relevan adalah anggota tim pengembang perangkat lunak.

**2. Mengurus Surat Permohonan Izin Magang**

Permohonan izin magang diproses melalui layanan akademik Mobilitas Akademik UNESA. Dokumen administrasi yang diperlukan disiapkan dan diajukan sesuai prosedur yang berlaku.

**3. Penyampaian Proposal ke Lokasi Magang**

Proposal magang berdampak disusun dan disampaikan kepada CV Sinar Agung Jaya, mencakup rencana kontribusi, kompetensi yang dibawa, dan luaran yang diharapkan dari kedua belah pihak.

**4. Pembahasan dan Persetujuan Penugasan**

Proposal yang diajukan dibahas bersama pihak mitra. Fanani Agung Widyanto selaku pembimbing mitra menyampaikan lingkup penugasan, ekspektasi, dan standar kerja yang berlaku di tim. Hasil kesepakatan ini menjadi dasar pelaksanaan selama empat bulan ke depan.

**5. Pembekalan Peserta Magang oleh Sub Direktorat Mobilitas Akademik dan Program Studi**

Sebelum diberangkatkan, saya mengikuti pembekalan dari Sub Direktorat Mobilitas Akademik UNESA dan Program Studi Teknik Informatika. Materi pembekalan mencakup etika kerja di lingkungan industri, teknis pengisian logbook, dan pemahaman terhadap hak dan kewajiban mahasiswa magang.

**6. Pemberangkatan ke Lokasi**

Setelah pembekalan, saya berangkat ke lokasi magang di Jombang. Koordinasi awal dilakukan untuk memastikan kesiapan tim mitra dalam menerima peserta magang.

**7. Orientasi Tempat Magang**

Di hari pertama magang (26 Januari 2026), saya mengikuti orientasi yang mencakup pengenalan tim pengembang, akses ke repository project Viviashop, setup lingkungan development lokal (Laravel, Node.js, konfigurasi database MySQL dengan Laragon), dan pemahaman tentang aturan kerja internal tim.

**8. Pelaksanaan Penugasan (Performing)**

Sejak hari ketiga, saya mulai terlibat aktif dengan mengeksplorasi model-model Eloquent, mempelajari alur routing, dan berkontribusi pada perbaikan bug pertama. Tugas-tugas diberikan secara harian oleh pembimbing mitra, dengan tingkat kompleksitas yang meningkat seiring pemahaman saya terhadap sistem.

**9. Pendampingan oleh Pembimbing Lapang**

Fanani Agung Widyanto berperan sebagai *tech lead* yang memberikan arahan teknis, melakukan code review, dan mendampingi saya dalam proses adaptasi. Diskusi teknis berlangsung hampir setiap hari, baik secara formal maupun informal, dan menjadi bagian penting dari proses pembelajaran.

**10. Pengerjaan Proyek Berdampak**

Proyek utama yang menjadi fokus kontribusi adalah pengembangan dan penyempurnaan platform Viviashop secara menyeluruh: dari modul stok, AI agent, smart print, hingga laporan keuangan. Tidak ada satu proyek tunggal yang berdiri sendiri, melainkan kontribusi tersebar dalam bentuk rangkaian perbaikan dan penambahan fitur selama 960 jam.

**11. Supervisi dan Monitoring**

Selain pendampingan dari pembimbing mitra, dosen pembimbing lapangan I Made Suartana, S.Kom., M.Kom. melakukan supervisi berkala. Progres juga dimonitor melalui sistem logbook UNESA yang diisi setiap hari kerja.

**12. Evaluasi Akhir oleh Mitra**

Di akhir periode magang (menjelang 1 Juni 2026), pembimbing mitra memberikan evaluasi menyeluruh terhadap kinerja saya, yang mencakup aspek teknis (kualitas kode, kemampuan debugging, pemahaman arsitektur sistem), kedisiplinan (konsistensi pengisian logbook, ketepatan waktu), komunikasi, dan dampak nyata dari seluruh tugas yang diselesaikan.

---

### Teknik yang Digunakan

| Teknik | Deskripsi |
|---|---|
| Observasi langsung | Mengamati alur kerja tim pengembang, cara pengambilan keputusan teknis, standar code review, dan praktik deployment yang berlaku di lingkungan CV Sinar Agung Jaya. |
| Studi dokumen internal | Mengkaji `DOKUMENTASI_TEKNIS_VIVIASHOP.md` (1.439 baris), kode sumber aktif di repository, file konfigurasi `.env`, dan catatan teknis yang ada di dalam komentar kode. |
| Wawancara terstruktur dan informal | Dilakukan dengan Fanani Agung Widyanto selaku pembimbing mitra, baik dalam sesi formal diskusi tugas maupun percakapan teknis informal saat menghadapi masalah spesifik. |
| Diskusi kolaboratif | Diskusi rutin dengan pembimbing mitra dan rekan tim untuk membahas pendekatan teknis, memilih solusi yang paling sesuai dengan arsitektur yang ada, dan menyusun rekomendasi perbaikan. |
| Perancangan mini-proyek | Merancang dan mengimplementasikan solusi untuk masalah yang ditemukan, seperti konsolidasi `StockManagementService`, implementasi `SuggestSupplierTool`, dan optimasi query N+1, dengan skalabilitas yang terbatas namun berdampak nyata pada performa dan keandalan sistem. |

### Kertas Kerja yang Dihasilkan

Selain tugas teknis harian, setiap peserta magang diwajibkan menghasilkan kertas kerja yang disampaikan kepada pembimbing untuk menilai perkembangan kemampuan konseptual, yang meliputi beberapa topik di bawah ini.

- **Kertas Kerja 1:** Deskripsi bisnis proses CV Sinar Agung Jaya dan platform Viviashop, mencakup tiga pilar bisnis, alur transaksi e-commerce, dan integrasi sistem digital dengan operasional fisik perusahaan.
- **Kertas Kerja 2:** Identifikasi faktor-faktor kunci penentu keberhasilan usaha, mencakup keunggulan teknologi platform, kecepatan layanan, dan kemampuan perusahaan dalam membangun sistem digital mandiri yang tidak bergantung pada marketplace pihak ketiga.
- **Kertas Kerja 3 dan seterusnya:** Deskripsi dan analisis masalah teknis yang ditemukan selama magang, beserta alternatif pemecahannya, seperti masalah inkonistensi stok multi-layer, bottleneck N+1 query, dan tantangan integrasi AI agent dengan sistem yang sudah ada.

Semakin banyak kertas kerja yang dihasilkan, semakin sering saya melatih kemampuan konseptual dalam menganalisis masalah dan merumuskan solusi yang terstruktur. Peran pembimbing mitra dalam memberikan umpan balik yang mempertajam pemahaman saya tentang kondisi aktual di lapangan tidak bisa digantikan oleh belajar mandiri saja.

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**


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

**Temuan Teknis Pemeliharaan Sistem.** Pengelolaan stok multi-layer di Viviashop (tiga layer bersamaan dengan satu model legacy) menunjukkan akumulasi lapisan abstraksi akibat pengembangan secara iteratif. Kasus ini memberikan studi nyata mengenai *technical debt* yang terjadi dalam sistem berskala produksi.

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**


## 4.4 Relevansi dengan Mata Kuliah Konversi

Setelah melakukan kegiatan magang yang dibimbing oleh Dosen Pembimbing Lapangan, saya telah menyelesaikan rangkaian proyek pengembangan serta melaksanakan seluruh aktivitas harian yang menjadi tanggung jawab di lingkungan mitra. Berikut adalah uraian relevansi kegiatan magang dengan masing-masing mata kuliah yang dikonversi, sebagaimana yang telah disetujui oleh DPL dan Koordinator Program Studi.

---

### Tabel Ringkasan Kegiatan Magang dan Mata Kuliah Konversi

| Bulan | Posisi | Topik Utama | Durasi (jam) | Target | Metode |
|---|---|---|---|---|---|
| Januari 2026 | Developer Magang | Onboarding, eksplorasi arsitektur sistem, mempelajari Models, routing, Auth | 60 | Memahami fondasi sistem Viviashop | Observasi + studi kode |
| Februari 2026 | Developer Magang | Pengembangan fitur (filter produk, upload Cloudinary, dashboard), debug (Cart, OrderItem), eksplorasi AI Agent | 160 | Fitur baru berfungsi, bug teratasi | Coding + debugging + testing |
| Maret 2026 | Developer Magang | Refaktor (StockManagementService, CategoryController), implementasi tool AI baru, optimasi N+1 query, dokumentasi API | 270 | Kualitas kode meningkat, tool AI bertambah | Refaktor + coding + dokumentasi |
| April 2026 | Developer Magang | Finalisasi laporan keuangan, testing modul print, deployment staging, export Excel/PDF, SweetAlert2 | 280 | Modul laporan lengkap, staging siap | Coding + testing + DevOps |
| Mei s.d. Juni 2026 | Developer Magang | Optimasi varian produk, finalisasi AI agent, testing E2E, perbaikan stok reversal, dokumentasi handover | 190 | Sistem siap rilis, dokumentasi lengkap | Optimasi + testing + dokumentasi |

---

### Mata Kuliah: Magang Perencanaan Program (2 SKS)

Mata kuliah ini secara struktural mencakup perencanaan, persiapan, dan pembekalan sebelum serta selama pelaksanaan magang. Relevansinya terasa langsung sejak hari pertama.

Sebelum magang dimulai, saya menyusun proposal magang berdampak yang mendeskripsikan kompetensi yang saya bawa, ruang lingkup kontribusi yang direncanakan, dan indikator keberhasilan yang terukur. Proses ini menuntut pemahaman yang baik tentang kebutuhan mitra, sesuatu yang saya dapatkan dari observasi awal terhadap arsitektur Viviashop dan diskusi dengan pembimbing mitra Fanani Agung Widyanto.

Selama magang berlangsung, keterampilan perencanaan terus digunakan. Setiap hari saya harus memprioritaskan tugas dari antrian yang diberikan pembimbing mitra, mengestimasi waktu pengerjaan, dan melaporkan progres melalui logbook. Ketika menghadapi bug yang kompleks, seperti masalah signature key Midtrans pada Februari 2026 atau reversal stok pada Mei 2026, saya terbiasa membuat rencana investigasi sistematis sebelum mulai debugging, seperti memeriksa file log, mereproduksi masalah di lingkungan lokal, baru merumuskan solusi.

Pembekalan yang diberikan oleh Sub Direktorat Mobilitas Akademik UNESA sebelum keberangkatan juga menjadi bagian dari mata kuliah ini: etika kerja profesional, cara mengisi logbook yang baik, dan mekanisme pelaporan kepada DPL. Keterampilan-keterampilan administratif ini terasa sepele, tapi dalam praktiknya sangat membantu saya menjaga konsistensi selama empat bulan lebih.

Penerapan kompetensi perencanaan ditunjukkan melalui konsistensi pengisian 96 entri logbook harian sebagai catatan riwayat progres pekerjaan.

[FOTO/GAMBAR: Dokumentasi logbook harian yang disubmit ke sistem Mobilitas Akademik UNESA]

---

### Mata Kuliah: Magang Evaluasi Program (2 SKS)

Mata kuliah ini berkaitan dengan kemampuan mengevaluasi proses, hasil, dan dampak dari kegiatan magang. Evaluasi ini terjadi di dua level, yaitu evaluasi dari pembimbing mitra terhadap kinerja saya dan evaluasi mandiri terhadap proses pengembangan di Viviashop.

Dari sisi evaluasi oleh mitra, setiap beberapa minggu Fanani Agung Widyanto memberikan umpan balik atas kinerja saya, baik secara informal dalam diskusi harian maupun secara lebih formal menjelang akhir magang. Umpan balik ini mencakup kualitas kode yang saya tulis, kemampuan debug mandiri sebelum eskalasi, dan konsistensi dalam mengikuti konvensi kode yang berlaku di tim.

Dari sisi evaluasi mandiri, saya terbiasa merefleksikan keputusan teknis yang diambil. Misalnya, ketika saya memilih menambahkan eager loading untuk mengatasi N+1 query, bukannya menambahkan cache layer, saya harus mampu menjelaskan mengapa eager loading lebih tepat untuk kasus ini. Atau ketika saya mendiskusikan dengan senior apakah refaktor `AttributeVariantController` perlu menerapkan repository pattern, di mana kami memutuskan belum perlu karena complexity overhead-nya tidak sebanding dengan skala proyek saat ini. Kemampuan mengevaluasi trade-off semacam ini adalah inti dari mata kuliah ini.

Evaluasi yang lebih sistematis terjadi menjelang akhir magang, di mana saya melakukan *final testing* menyeluruh (28 sampai 29 Mei 2026) untuk memastikan semua fitur kritis berjalan dengan benar sebelum rilis update terbaru. Saya menjalankan suite test yang ada, memperbaiki bug yang ditemukan, dan mendokumentasikan hasilnya untuk tim QA.

[FOTO/GAMBAR: Dokumentasi proses final testing dan hasil evaluasi akhir]

---

### Mata Kuliah: Web Semantik (3 SKS)

Web Semantik sebagai mata kuliah membahas cara membuat konten web dapat dimengerti tidak hanya oleh manusia, tetapi juga oleh mesin, yaitu melalui struktur data yang terstandar, metadata yang bermakna, dan antarmuka yang dapat diakses secara programatik. Relevansinya dengan pekerjaan di Viviashop ada di beberapa titik.

Yang paling langsung adalah pengembangan API endpoint yang digunakan oleh frontend dan oleh sistem AI. Ketika saya mengerjakan perbaikan `api.php` dan `ProductVariantController` (Februari 2026), saya memastikan bahwa response JSON yang dikembalikan memiliki struktur yang konsisten, meliputi status code yang tepat, key yang bermakna, dan data yang terorganisir dengan hierarki yang logis. Ini adalah penerapan langsung dari prinsip API design yang bisa dikaitkan dengan konsep web semantik, di mana data yang tersedia melalui endpoint harus dapat diinterpretasikan secara akurat oleh klien mana pun yang mengonsumsinya.

Lebih jauh, integrasi AI Agent Viviashop dengan Google Gemini API menghadirkan dimensi web semantik yang lebih modern, khususnya mengenai bagaimana representasi data bisnis (produk, stok, order) distrukturkan dalam sistem prompt agar bisa diinterpretasikan dengan benar oleh model bahasa besar. Ketika saya merefaktor `PromptBuilder` dan `Context` (Maret 2026), secara praktis saya merancang skema semantik untuk menyampaikan konteks bisnis kepada LLM, sehingga model bisa "memahami" situasi dan memberikan respons yang relevan. Ini adalah aplikasi prinsip web semantik dalam konteks AI modern yang belum ada dalam literatur kuliah saya, tetapi sangat relevan secara konseptual.

Di sisi lain, pengerjaan fitur dokumentasi API internal (Maret 2026) juga mencerminkan kesadaran semantik, di mana endpoint yang terdokumentasi dengan jelas (nama, parameter, response) adalah endpoint yang dapat dipahami dan digunakan oleh pengembang lain tanpa perlu membaca kode sumbernya.

[FOTO/GAMBAR: Contoh struktur JSON response dari API Viviashop yang terdokumentasi]

---

### Mata Kuliah: Verifikasi dan Validasi Perangkat Lunak (3 SKS)

Mata kuliah ini mencakup teknik-teknik untuk memastikan perangkat lunak memenuhi spesifikasi (verifikasi) dan memenuhi kebutuhan pengguna (validasi). Saya menerapkan kedua aspek ini secara intensif selama magang.

*Verifikasi* dilakukan melalui pengujian unit dengan PHPUnit (Maret 2026), di mana saya menulis test untuk `ProductController.index` menggunakan model factory, menjalankan `php artisan test`, dan memperbaiki beberapa test case yang gagal. Saya juga menambahkan unit test untuk `SuggestSupplierTool` dan `CalculatePrintCostTool`. Meski codebase Viviashop tidak memiliki coverage test yang tinggi (sesuai catatan di AGENTS.md, tes berjalan di MySQL nyata bukan SQLite in-memory), setiap test yang saya tambahkan membantu menjaga kualitas kode di area yang saya sentuh.

*Validasi* dilakukan melalui serangkaian pengujian fungsional yang mensimulasikan perilaku pengguna nyata. Pengujian paling menyeluruh adalah sesi *end-to-end testing* pada 26 Mei 2026: saya membuat akun dummy, menambahkan produk ke keranjang, melakukan checkout, membayar menggunakan Midtrans sandbox, dan memverifikasi notifikasi berhasil diterima. Saya juga mendokumentasikan kendala kecil yang ditemukan (URL callback yang perlu disesuaikan) untuk ditindaklanjuti tim.

Implementasi Form Request untuk validasi input juga masuk ke dalam domain mata kuliah ini. `AttributeRequest`, `ProductRequest`, `AIChatRequest`, di mana setiap kelas request ini mendefinisikan aturan validasi yang memastikan data yang masuk ke sistem memenuhi struktur yang diharapkan sebelum diproses lebih lanjut. Saya membuat dan menyempurnakan beberapa kelas request ini, termasuk menambahkan custom error message yang lebih informatif bagi pengguna.

Pengujian dual input system (April 2026) untuk memastikan order produk dan order print dapat diproses dalam satu transaksi, yang merupakan contoh pengujian integrasi untuk memverifikasi bahwa dua modul yang berbeda berinteraksi dengan benar ketika digunakan bersamaan.

[FOTO/GAMBAR: Contoh hasil output PHPUnit testing di Viviashop]

---

### Mata Kuliah: Konstruksi Perangkat Lunak (3 SKS)

Konstruksi Perangkat Lunak adalah mata kuliah yang paling langsung relevan dengan apa yang saya kerjakan setiap hari selama magang, karena mata kuliah ini berfokus pada membangun perangkat lunak yang benar-benar bekerja. Setiap baris kode yang saya tulis, setiap refaktor yang saya lakukan, dan setiap bug yang saya perbaiki adalah penerapan langsung dari prinsip-prinsip konstruksi perangkat lunak.

Jujur, di awal magang saya agak kewalahan membaca codebase Viviashop. Controller yang panjang, route yang lebih dari 1.150 baris, model dengan relasi yang bertingkat, yang tentu saja jauh dari proyek kelas yang bisa dipelajari dalam satu malam. Butuh beberapa hari sebelum saya bisa mulai berkontribusi dengan keyakinan.

Prinsip *Don't Repeat Yourself* (DRY) menjadi panduan ketika saya merefaktor `StockManagementService`, mengingat ada beberapa metode yang secara substansi melakukan logika yang sama dari arah yang berbeda. Dengan menggabungkan logika ini, saya mengurangi kemungkinan bug yang disebabkan oleh perubahan di satu tempat tetapi tidak di tempat lain. Hal yang sama berlaku ketika saya memisahkan `CategoryService` dari `CategoryController`, karena controller yang bersih lebih mudah dibaca, diuji, dan dimodifikasi.

*Single Responsibility Principle* (SRP) terasa relevan ketika saya mengerjakan `AttributeVariantController` yang awalnya terlalu gemuk. Dengan memisahkan logika bisnis ke dalam service terpisah, controller menjadi lebih terfokus pada tugas koordinasi antara request dan response, bukan menjalankan logika bisnis secara langsung.

Penggunaan Vite sebagai bundler (saya pelajari pada Maret 2026) adalah bagian dari konstruksi sisi frontend untuk mengelola dependensi JavaScript dan CSS, memastikan perubahan terlihat secara instan di browser saat development (`npm run dev`), dan menghasilkan bundle yang dioptimasi untuk production (`npm run build`). Ini adalah proses konstruksi yang berbeda dari backend, tetapi tetap mengikuti prinsip yang sama, yaitu memisahkan development workflow dari production output.

Salah satu pelajaran berharga yang tidak ada di buku teks: ketika mengerjakan fitur baru di sistem yang sudah berjalan, selalu ada risiko *regresi*, di mana sebuah perbaikan di satu tempat berpotensi menyebabkan kerusakan di tempat lain. Pengalaman inilah yang membuat saya disiplin dalam menjalankan test setiap kali selesai membuat perubahan signifikan.

[FOTO/GAMBAR: Contoh kode sebelum dan sesudah refaktor StockManagementService]

---

### Mata Kuliah: Analisis dan Desain Perangkat Lunak (4 SKS)

Dengan bobot 4 SKS, yaitu paling besar di antara semua mata kuliah konversi, narasi untuk mata kuliah ini perlu lebih panjang dan mendalam, karena kontribusinya terhadap kompetensi yang saya kembangkan selama magang juga yang paling luas.

Analisis dan Desain Perangkat Lunak mengajarkan bagaimana memahami kebutuhan sistem (analisis) dan bagaimana menerjemahkan kebutuhan itu menjadi struktur yang bisa diimplementasikan (desain). Di Viviashop, saya berhadapan dengan sistem yang sudah didesain dan diimplementasikan oleh orang lain, yang menjadi tantangan berbeda tapi sama pentingnya, yaitu membaca dan memahami desain yang sudah ada.

**Membaca dan Memahami Desain yang Ada.** Di tiga hari pertama magang, saya menghabiskan waktu untuk memahami desain sistem yang sudah ada: membaca `DOKUMENTASI_TEKNIS_VIVIASHOP.md`, menelusuri diagram relasi antar model (yang perlu saya buat sendiri karena tidak ada diagram formal), dan memahami pola namespace yang digunakan (Admin/Frontend/Api/Auth). Ini adalah *reverse engineering* desain, yang ternyata memerlukan kemampuan analisis yang tidak kalah tinggi dari merancang dari nol.

**Analisis Masalah Stok Multi-Layer.** Ketika mengerjakan `StockManagementService`, saya harus melakukan analisis yang sistematis: mengidentifikasi semua titik di sistem yang melakukan operasi tulis ke stok (order baru, pembelian masuk, pengembalian barang), memetakan alur masing-masing, dan mengidentifikasi di mana terjadi inkonsistensi. Kemampuan analisis ini, yaitu menelusuri data flow dalam sistem yang kompleks, merupakan inti dari mata kuliah ini.

**Desain AI Agent System.** Arsitektur AI agent Viviashop menunjukkan desain yang elegan: `ToolDispatcher` menggunakan pola *strategy*, di mana ia tidak tahu cara kerja setiap tool, tapi tahu cara memilih dan memanggil tool yang tepat berdasarkan nama. `ToolRegistry` menyimpan peta nama ke implementasi. Setiap tool mengimplementasikan kontrak `ToolHandler`. Ini adalah contoh penerapan prinsip *Open/Closed Principle* (OCP) dari SOLID: sistem terbuka untuk ekstensi (tambah tool baru) tanpa memodifikasi kode yang sudah ada. Ketika saya mengimplementasikan `SuggestSupplierTool`, saya mengikuti pola yang sama, dan proses ini mengkonfirmasi pemahaman saya tentang keunggulan desain berbasis kontrak.

**Desain Database dan Relasi Model.** Viviashop menggunakan 35 model Eloquent dengan relasi yang bervariasi: one-to-many (Category → Product), many-to-many dengan pivot (Product ↔ AttributeOption melalui ProductAttributeValue), dan relasi polimorfik (ProductImage). Memahami dan bekerja dengan relasi-relasi ini, termasuk memilih kapan menggunakan eager loading atau lazy loading, membutuhkan pemahaman mendalam tentang desain basis data relasional yang menjadi materi inti mata kuliah ini.

**Desain API yang Konsisten.** Ketika saya memperbaiki endpoint di `api.php` (Februari 2026) dan membuat dokumentasi API internal (Maret 2026), saya belajar tentang pentingnya konsistensi desain API: response structure yang konsisten, status code yang bermakna, dan error message yang informatif. Tanpa konsistensi ini, klien API, baik frontend maupun sistem AI agent, tidak bisa menulis kode yang reliable.

**Evaluasi Evolusi Desain Sistem.** Dalam praktik pengembangan industri, desain sistem terus berevolusi seiring perubahan kebutuhan bisnis, yang berpotensi memunculkan *technical debt*. Hal ini terlihat pada keberadaan kelas redundan seperti `CartControllerNew` dan `BrandSeederNew` di Viviashop. Kondisi ini menggambarkan bahwa desain perangkat lunak dalam skala produksi dituntut adaptif dan dapat dievolusikan secara iteratif.

[FOTO/GAMBAR: Diagram arsitektur sistem AI Agent Viviashop (AIAgentService, ToolDispatcher, ToolRegistry, ToolHandler)]

---

### Mata Kuliah: Virtualisasi dan Komputasi Awan (3 SKS)

Mata kuliah ini membahas konsep virtualisasi infrastruktur dan pemanfaatan layanan cloud untuk pengembangan dan deployment aplikasi. Relevansinya dengan pengalaman magang saya ada di dua dimensi, yaitu deployment tradisional berbasis VPS dan pemanfaatan layanan cloud pihak ketiga.

**Deployment ke Server VPS.** Proses yang saya pelajari dan jalani langsung selama magang, seperti setup environment production, konfigurasi `.env`, `composer install`, `php artisan migrate`, `npm run build` untuk Vite, dan setup cron `php artisan schedule:run`, merupakan siklus deployment yang berjalan di atas server VPS tanpa container atau orkestrasi yang otomatis. Ini berbeda dari model deployment yang diajarkan di kelas (yang mungkin lebih menekankan Docker atau platform PaaS), tapi sangat representatif dari realitas deployment di banyak bisnis skala menengah di Indonesia. Pengalaman ini mengajarkan tentang apa yang sebenarnya terjadi di bawah abstraksi layanan cloud yang sudah terkelola.

**Pemanfaatan Cloudinary sebagai CDN Cloud.** Upload dan pengambilan gambar produk di Viviashop menggunakan Cloudinary, yaitu layanan cloud penyimpanan dan pemrosesan media. Saya mengerjakan fitur upload gambar produk (Februari 2026) dan upload avatar profil pengguna (April 2026) yang keduanya mengandalkan Cloudinary API. Ini adalah contoh nyata dari arsitektur *hybrid*: aplikasi berjalan di VPS on-premise, tetapi menggunakan layanan cloud khusus untuk kebutuhan spesifik (penyimpanan dan distribusi media) yang tidak efisien jika dikelola sendiri.

**Pemanfaatan Google Gemini sebagai AI Cloud Service.** Integrasi dengan Google Gemini API adalah contoh paling jelas dari komputasi awan dalam konteks magang ini. Model inferensi berjalan di infrastruktur Google tanpa memerlukan GPU maupun manajemen model dari sisi tim Viviashop. Semua yang diperlukan adalah `GeminiClient` yang mengirimkan HTTP request dan menerima response. Pola ini, yaitu mengonsumsi kemampuan komputasi yang besar melalui API tanpa mengelola infrastrukturnya sendiri, menjadi salah satu proposisi nilai utama komputasi awan yang paling terasa relevan dalam praktik.

**Midtrans sebagai Payment Cloud Service.** Integrasi pembayaran dengan Midtrans juga merupakan contoh pemanfaatan cloud service: pemrosesan transaksi yang aman, manajemen fraud detection, dan notifikasi callback semuanya ditangani oleh infrastruktur cloud Midtrans. Tim Viviashop hanya perlu mengintegrasikan SDK dan mengkonfigurasi webhook, yang merupakan contoh model *Software as a Service* (SaaS) dalam konteks yang sangat konkret.

Pengalaman bekerja dengan empat layanan cloud berbeda (Cloudinary, Gemini, Midtrans, RajaOngkir) dalam satu platform memberi saya pemahaman praktis tentang cara mengelola dependensi cloud, di mana setiap layanan memiliki konfigurasi berbeda di `.env`, penanganan kesalahan yang spesifik, dan biaya operasional yang harus dipertimbangkan dalam pengambilan keputusan arsitektur.

[FOTO/GAMBAR: Diagram arsitektur hybrid Viviashop yang menunjukkan integrasi layanan cloud (Cloudinary, Gemini, Midtrans, RajaOngkir)]

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**


## BAB V
## HAMBATAN DAN DUKUNGAN PELAKSANAAN MAGANG

## 5.1 Hambatan

Berikut beberapa hambatan nyata yang saya hadapi selama di lapangan, diurutkan dari yang paling mengganggu produktivitas:

Hambatan awal yang dirasakan pada awal magang adalah kompleksitas codebase. Sistem Viviashop memiliki 35 model Eloquent dengan relasi bertingkat, 40 controller dalam empat namespace, serta file `routes/web.php` sepanjang 1.150 baris yang berisi rute pengujian. Proses pemahaman alur data dasar sistem memerlukan waktu penyesuaian sebelum kontribusi aktif dapat dilakukan.

Yang memperumit situasi: tidak ada diagram arsitektur formal dan tidak ada `.env.example` (seperti yang tercatat di dokumentasi teknis). Saya harus membangun pemahaman dari kode itu sendiri, dan hal tersebut membutuhkan waktu pengerjaan tambahan.

**2. Inkonistensi Teknis yang Sudah Ada di Sistem (Technical Debt)**

Beberapa bagian sistem memiliki duplikasi yang sedikit membingungkan di awal: ada `CartController` dan `CartControllerNew` untuk fungsi yang hampir sama, ada `BrandSeeder` dan `BrandSeederNew`, ada tiga layer stok yang tidak selalu konsisten satu sama lain, dan ada model `RekamanStok` yang merupakan legacy dari `StockMovement`. Ketika pertama kali menemukan duplikasi ini, saya tidak langsung tahu mana yang "benar" untuk digunakan.

Hambatan ini pada akhirnya menjadi pelajaran tentang technical debt di sistem nyata: ia ada, ia tidak akan hilang seketika, dan cara terbaik menghadapinya adalah mendokumentasikannya (bukan pura-pura tidak ada) sambil secara bertahap memperbaikinya ketika ada kesempatan.

**3. Keterbatasan Akses ke Informasi Sistem yang Sensitif**

Beberapa konfigurasi sistem, terutama credential Midtrans production, kunci API Instagram, dan beberapa konfigurasi server, hanya bisa diakses oleh anggota tim inti. Ini wajar dari perspektif keamanan, tetapi sempat menjadi hambatan ketika saya perlu memverifikasi perilaku sistem di environment tertentu. Untuk kasus-kasus ini, saya bergantung pada pembimbing mitra untuk mendapatkan informasi yang diperlukan, yang kadang perlu menunggu jadwal yang tepat.

**4. Tantangan Debugging di Environment Produksi**

Beberapa bug yang dilaporkan hanya muncul di lingkungan production, sehingga tidak bisa direproduksi di lokal. Bug error 500 pada Jumat Agung (April 2026), misalnya, disebabkan oleh file storage yang hilang di server production, sebuah kendala yang tidak terjadi di development lokal karena adanya perbedaan setup storage. Debugging masalah semacam ini memerlukan akses remote ke server, yang menambah kompleksitas tersendiri.

**5. Keterbatasan Coverage Test yang Ada**

Seperti yang dicatat dalam dokumentasi teknis, Viviashop tidak memiliki database SQLite untuk pengujian, sehingga semua test berjalan terhadap database MySQL nyata. Ini membuat penulisan test menjadi lebih hati-hati (tidak bisa sembarangan melakukan `RefreshDatabase`) dan coverage test yang ada tidak setinggi yang idealnya. Akibatnya, ketika saya membuat perubahan di satu bagian sistem, tidak selalu ada jaring pengaman test yang bisa segera memperingatkan jika ada regresi.

---

## 5.2 Dukungan

Di sisi lain, beberapa faktor pendukung secara signifikan membantu kelancaran aktivitas magang saya.

**1. Bimbingan Teknis dari Pembimbing Mitra yang Intensif**

Fanani Agung Widyanto memberikan bimbingan yang jauh lebih intensif dari yang saya bayangkan sebelumnya. Hampir setiap hari ada diskusi teknis, baik tentang tugas yang sedang dikerjakan, pendekatan yang dipilih, atau konteks bisnis yang saya perlu pahami agar bisa berkontribusi lebih tepat. Ketika saya menghadapi masalah yang tidak bisa saya selesaikan sendiri dalam waktu wajar, beliau selalu tersedia untuk menunjukkan arah yang benar tanpa langsung memberikan jawaban. Pendekatan ini merupakan cara bimbingan yang menurut saya lebih efektif untuk pembelajaran jangka panjang.

**2. Arsitektur Sistem yang Dirancang dengan Cukup Baik**

Meski ada technical debt, arsitektur dasar Viviashop cukup terstruktur. Penggunaan pola MVC yang konsisten, service layer yang terdefinisi, form request yang terpisah, dan pola AI agent yang elegan, semuanya memudahkan saya untuk memahami "di mana seharusnya sesuatu berada" ketika perlu menambahkan fitur baru atau memperbaiki yang sudah ada. Sistem yang terstruktur dengan baik adalah lingkungan belajar yang lebih baik daripada sistem yang ditulis asal jadi.

**3. Akses Penuh ke Repository dan Lingkungan Development**

Dari hari pertama, saya mendapat akses penuh ke repository aktif. Ini berarti saya bisa belajar dari semua perubahan yang pernah dilakukan, bisa membaca commit history untuk memahami *mengapa* sesuatu dibuat seperti itu, dan bisa langsung berkontribusi tanpa hambatan akses. Kepercayaan ini dari tim adalah dukungan yang sangat berarti.

**4. Fleksibilitas Kerja (WFA untuk Hari Libur Nasional)**

Tim CV Sinar Agung Jaya memberikan fleksibilitas untuk bekerja dari rumah (*Work From Anywhere*) pada hari-hari libur nasional yang jatuh di tengah periode magang. Ini memungkinkan saya untuk tetap produktif dan memenuhi target jam magang tanpa harus mengorbankan momen penting, sambil tetap menyelesaikan tugas yang memang bisa dikerjakan secara remote.

**5. Bimbingan Akademis dari Dosen Pembimbing Lapangan**

I Made Suartana, S.Kom., M.Kom. memberikan bimbingan dari sisi akademis yang membantu saya menjaga perspektif keilmuan di tengah rutinitas pekerjaan teknis sehari-hari. Bimbingan ini membantu saya untuk tidak sekadar "mengerjakan tugas" tetapi juga memaknai apa yang sedang saya pelajari dalam konteks program studi.

---

## BAB VI
## REFLEKSI, RENCANA TINDAK LANJUT & REKOMENDASI

## 6.1 Refleksi

### 1. Pengalaman Pribadi Selama Magang

Magang di CV Sinar Agung Jaya memberikan pengalaman belajar intensif melalui penyelesaian berbagai kendala teknis pada sistem produksi setiap harinya.

Pada awal magang, pemahaman alur kerja Viviashop memerlukan waktu penyesuaian yang cukup karena skala sistem yang memiliki 35 model Eloquent, puluhan controller, serta rute web yang melebihi 1.150 baris.

Pengalaman ini melatih kemampuan membaca, menganalisis, dan memodifikasi kode program yang sudah ada. Keterampilan ini sangat penting dalam industri karena sebagian besar waktu pengembangan dihabiskan untuk memelihara codebase yang berjalan.

Tantangan yang paling berkesan adalah ketika menghadapi bug yang hanya muncul di production dan tidak bisa direproduksi di lokal. Kasus error 500 di server production (April 2026) mengajarkan saya tentang pentingnya logging yang baik, sebab tanpa informasi log yang memadai, pencarian bug di production akan terasa sangat menyulitkan. Setelah kasus itu, saya selalu memastikan untuk menambahkan log yang bermakna di setiap controller yang saya modifikasi.

Pengalaman yang paling memuaskan? Ketika optimasi N+1 query di `ProductController` berhasil menurunkan waktu muat dari 5 detik menjadi 1 detik, sebuah hasil yang diverifikasi langsung dengan data dummy. Ada kepuasan yang spesifik ketika solusi yang Anda rancang benar-benar menghasilkan perbedaan yang terukur.

### 2. Keterampilan yang Dikembangkan

**Keterampilan teknis yang berkembang secara signifikan:**

- *Laravel 10 secara mendalam.* Dari sekadar tahu cara membuat CRUD sederhana, menjadi mampu memahami lifecycle request, middleware, event/listener, artisan command, service layer, dan queue. Lebih penting: saya jadi paham bagaimana berbagai komponen ini berinteraksi satu sama lain di dalam sistem yang sudah kompleks.
- *Database query optimization.* Eager loading, indexing, dan `chunk()` untuk data besar bukan lagi konsep abstrak. Saya sudah merasakan langsung perbedaannya.
- *API integration.* Mengelola tiga integrasi berbeda (Midtrans, RajaOngkir, Gemini) mengajarkan banyak tentang penanganan error di batas sistem, manajemen credential, dan cara debugging masalah yang terjadi di jaringan.
- *PHPUnit testing.* Dari sekadar tahu cara menjalankan test, menjadi bisa menulis test yang meaningful dan memahami kapan test itu perlu dan kapan justru kontraproduktif.
- *Sistem AI/LLM integration.* Ini yang paling baru: memahami cara kerja `ToolDispatcher` dan pola *function calling* di LLM, lalu mengimplementasikan tool baru yang sesuai dengan pola tersebut.

**Keterampilan interpersonal yang berkembang:**

- *Manajemen prioritas di lingkungan multi-tugas.* Setiap hari ada beberapa tugas yang bisa dikerjakan, dan tidak semuanya bisa diselesaikan hari itu juga. Belajar memilih mana yang paling kritis dan mengomunikasikannya ke pembimbing adalah keterampilan yang perlu dilatih.
- *Komunikasi teknis yang efektif.* Menjelaskan masalah teknis kepada pembimbing dengan cara yang cukup jelas agar bisa mendapat arah yang tepat, tanpa terlalu banyak detail yang tidak perlu.
- *Ketahanan terhadap ketidakpastian.* Banyak hari di mana saya tidak tahu jawaban atas masalah yang sedang dihadapi. Belajar untuk tetap sistematis dan tidak panik dalam kondisi seperti ini adalah keterampilan non-teknis yang sangat berharga.

### 3. Pengaruh Magang terhadap Karier

Sebelum magang, pandangan saya tentang karier di bidang pengembangan perangkat lunak masih cukup abstrak. Saya hanya tahu ingin bekerja di sektor teknologi tanpa memahami peran spesifik yang sesuai dengan minat saya.

Pengalaman magang ini memperjelas arah karier saya di bidang rekayasa perangkat lunak. Saya menemukan ketertarikan pada pengembangan full-stack dan integrasi kecerdasan buatan (LLM) pada aplikasi bisnis skala produksi.

Selain itu, optimasi database, integrasi API pihak ketiga, dan pengembangan antarmuka pengguna merupakan kompetensi utama yang dikembangkan secara mendalam untuk mendukung kesiapan kerja.

### 4. Penerapan Ilmu yang Diperoleh di Kampus

Konsep MVC yang dipelajari di perkuliahan diterapkan langsung dalam struktur pembagian tanggung jawab di codebase. Prinsip SOLID juga memandu proses refaktorisasi service dan implementasi tool AI baru agar tetap modular.

Gap yang dirasakan adalah kurangnya penekanan pada kemampuan membaca dan menganalisis kode yang sudah ada dalam penugasan akademis. Di industri, pemeliharaan codebase lama merupakan aktivitas utama pengembang.

Bekerja dengan codebase yang sudah berjalan juga mengenalkan saya pada konsep *technical debt* skala industri, di mana modifikasi sistem harus memperhatikan dampak dan dependensi dengan fitur yang sudah ada sebelumnya.

---

## 6.2 Rekomendasi untuk Mitra

Berdasarkan observasi selama hampir lima bulan bekerja dengan sistem Viviashop, saya merumuskan beberapa rekomendasi teknis untuk keberlanjutan platform Viviashop.

**1. Penambahan Test Coverage yang Lebih Sistematis**

Saat ini, codebase Viviashop tidak memiliki coverage test yang memadai. Semua test berjalan di database MySQL nyata (bukan SQLite in-memory), dan `RefreshDatabase` tidak disarankan karena chain migrasi yang fragile. Kondisi ini membuat setiap perubahan kode membawa risiko regresi yang sulit terdeteksi dini. Solusi yang saya sarankan adalah menginvestasikan waktu untuk setup database test terpisah dan meningkatkan coverage secara bertahap, dimulai dari fungsi-fungsi bisnis yang paling kritis (order processing, stock management, payment callback).

**2. Dokumentasi Arsitektur Formal**

Tidak ada diagram arsitektur yang tersedia saat saya bergabung. Onboarding membutuhkan waktu lebih lama dari seharusnya karena saya harus membangun pemahaman arsitektur dari kode itu sendiri. Dokumen sederhana yang menggambarkan namespace, alur request utama, dan posisi masing-masing service akan sangat mempersingkat waktu onboarding anggota tim baru, termasuk mahasiswa magang berikutnya.

**3. Konsolidasi File-file Legacy**

Beberapa file legacy (`CartControllerNew.php`, `ProductRequest_updated.php`, `BrandSeederNew.php`, dan sekitar 12 skrip di folder `scripts/`) masih ada di repository tapi tidak digunakan secara aktif. Menghapus atau mengarsipkan file-file ini akan membuat repository lebih bersih dan mengurangi kebingungan bagi anggota tim baru.

**4. Penerapan Environment Staging yang Lebih Terstruktur**

Saat ini batas antara staging dan production tidak selalu jelas, terutama untuk konfigurasi Midtrans yang menggunakan live keys bahkan di lingkungan development. Memisahkan konfigurasi ini dengan lebih tegas (misalnya dengan `.env.staging` yang selalu menggunakan sandbox keys) akan mengurangi risiko transaksi uji yang tidak sengaja mempengaruhi akun production.

**5. Struktur Orientasi untuk Mahasiswa Magang Berikutnya**

Satu hal yang terasa kurang di awal adalah panduan onboarding yang terstruktur. Saya harus menemukan sendiri cara setup lingkungan, cara menjalankan fitur-fitur dasar, dan mana controller/model yang "aktif" versus yang legacy. Panduan singkat (bahkan hanya satu halaman Markdown) yang menjelaskan hal-hal ini akan sangat membantu mahasiswa magang berikutnya.

---

## 6.3 Rekomendasi untuk Program Magang

Pengalaman mengikuti program Magang Berdampak UNESA juga memberikan beberapa masukan yang kiranya bisa menjadi bahan pertimbangan:

**1. Pembekalan Teknis yang Lebih Spesifik per Bidang**

Pembekalan yang ada saat ini bersifat umum, mencakup etika kerja, cara pengisian logbook, dan mekanisme pelaporan. Untuk mahasiswa Teknik Informatika yang akan bekerja di lingkungan pengembangan perangkat lunak, tambahan pembekalan teknis yang spesifik akan sangat membantu, seperti tata cara bekerja dengan repository Git dalam tim, dasar-dasar code review, serta teknik membaca kode orang lain.

**2. Mekanisme Konsultasi DPL yang Lebih Terstruktur**

Jadwal konsultasi dengan Dosen Pembimbing Lapangan yang lebih terstruktur (misalnya, meeting bulanan yang terjadwal) akan membantu mahasiswa yang mungkin ragu untuk menghubungi DPL secara proaktif. Ketepatan waktu dan kualitas bimbingan sangat bergantung pada mekanisme komunikasi yang disepakati di awal.

**3. Fleksibilitas Pengakuan Jam Kerja di Hari Libur Nasional**

Dengan model magang yang memungkinkan WFA di hari libur nasional, perlu ada kejelasan tentang bagaimana jam kerja di hari libur tersebut dihitung dan dicatat dalam logbook. Selama ini saya mengisi logbook seperti hari kerja biasa, tetapi tidak ada panduan eksplisit tentang ini.

**4. Pengayaan Kurikulum dengan Studi Kasus Sistem Nyata**

Gap terbesar yang saya rasakan antara kuliah dan dunia kerja adalah pengalaman bekerja dengan sistem yang sudah ada. Menyertakan satu atau dua studi kasus dari sistem nyata (tidak harus yang sempurna, bahkan yang memiliki technical debt justru lebih realistis) sebagai bahan kuliah akan mempersiapkan mahasiswa lebih baik untuk realitas di lapangan.

---

## 6.4 Rencana Pengembangan Diri

**Soft Skill yang Akan Ditingkatkan:**

- *Komunikasi tertulis teknis.* Selama magang, saya menyadari bahwa kemampuan menulis dokumentasi yang jelas dan efisien adalah aset yang sering diremehkan. Saya berencana untuk lebih sering berlatih menulis dokumentasi teknis, bukan hanya kode.
- *Manajemen prioritas.* Mengelola beberapa tugas dengan urgensi yang berbeda adalah keterampilan yang perlu terus diasah. Saya akan mulai menggunakan sistem manajemen tugas yang lebih eksplisit (Notion, Linear, atau Jira) untuk proyek-proyek personal.
- *Kepemimpinan teknis.* Saya ingin bisa memimpin diskusi teknis, bukan hanya berpartisipasi di dalamnya. Langkah pertama: aktif berkontribusi di code review proyek open source.

**Hard Skill yang Akan Dikuasai:**

- *Docker dan container orchestration.* Selama magang, deployment dilakukan secara manual ke VPS. Saya ingin memahami cara mengelola lingkungan dengan container, yang akan membuat proses deployment lebih konsisten dan reproducible.
- *Testing yang lebih dalam.* Menulis test yang baik ternyata bukan hal yang trivial. Saya berencana untuk mempelajari lebih dalam tentang pengujian berbasis properti (*property-based testing*) dan pengujian kontrak API.
- *LLM integration patterns.* Pengalaman dengan Gemini API di Viviashop membuka minat yang kuat. Saya ingin memahami lebih dalam tentang pola-pola integrasi LLM ke dalam aplikasi bisnis: RAG (*Retrieval-Augmented Generation*), *function calling*, dan *agent orchestration*.
- *TypeScript dan ekosistem JavaScript modern.* Sebagian besar pekerjaan frontend di Viviashop masih menggunakan jQuery. Saya ingin memperkuat pemahaman tentang framework JavaScript modern untuk memiliki opsi yang lebih luas.

**Langkah Nyata:**

- Mengikuti kursus *Docker for Developers* dalam 3 bulan ke depan.
- Membangun satu proyek mandiri yang mengintegrasikan LLM (misalnya, chatbot sederhana dengan tool calling) untuk mengkonsolidasi pemahaman yang diperoleh selama magang.
- Berkontribusi ke proyek open source berbasis Laravel, mulai dari memperbaiki bug kecil sebelum mengajukan fitur baru.
- Menyelesaikan sertifikasi Laravel melalui program resmi Laracasts atau Laravel Certification.

**Tujuan Jangka Menengah:**

Dalam dua tahun ke depan, saya ingin memiliki portofolio yang mencerminkan kemampuan *full-stack development* yang matang, khususnya dalam konteks aplikasi web yang mengintegrasikan AI. Saya juga tertarik untuk berkontribusi pada proyek-proyek yang memiliki dampak nyata bagi UMKM di Indonesia, karena pengalaman di Viviashop menunjukkan betapa besarnya nilai yang bisa diberikan teknologi yang tepat untuk bisnis skala menengah.

---

## 6.5 Potensi Keberlanjutan Program

**Potensi Kerja Sama Berkelanjutan**

CV Sinar Agung Jaya secara aktif mengembangkan platform Viviashop, yang berarti selalu ada ruang untuk kontribusi pengembang tambahan. Menjelang akhir magang, ada diskusi informal tentang kemungkinan keterlibatan paruh waktu atau freelance untuk modul-modul yang belum sempat diselesaikan, khususnya pengembangan lebih lanjut dari fitur AI agent dan integrasi Instagram. Ini mengindikasikan bahwa hubungan kerja tidak harus berhenti di tanggal 1 Juni 2026.

**Pengembangan Kurikulum Berbasis Industri**

Pengalaman bekerja dengan sistem AI agent berbasis LLM yang diintegrasikan ke dalam aplikasi web Laravel adalah topik yang belum banyak masuk ke kurikulum Teknik Informatika di Indonesia. Topik ini, yang membahas cara merancang arsitektur *tool use* untuk LLM, cara menulis prompt yang efektif untuk konteks bisnis tertentu, serta pengelolaan riwayat percakapan dalam sistem stateful, sangat layak dijadikan modul praktikum atau proyek akhir semester.

Selain itu, pengalaman bekerja dengan sistem manajemen stok multi-layer dan tantangan konsistensi data yang menyertainya bisa menjadi studi kasus yang kaya untuk mata kuliah Basis Data Lanjut atau Rekayasa Perangkat Lunak.

**Replikasi atau Scaling Up**

Model kolaborasi ini, di mana mahasiswa Teknik Informatika ditempatkan di perusahaan yang sedang aktif membangun platform digital, memiliki potensi replikasi yang baik. Banyak UMKM dan perusahaan menengah di Indonesia yang sedang dalam proses digitalisasi dan membutuhkan tenaga pengembang, tetapi tidak memiliki anggaran untuk mempekerjakan pengembang senior penuh waktu. Program magang yang terstruktur dengan baik bisa menjadi solusi *win-win* yang menguntungkan kedua belah pihak.

Persyaratannya meliputi penyediaan bimbingan teknis yang memadai dari tim mitra serta mekanisme evaluasi kontribusi mahasiswa yang terukur.

---

## BAB VII
## PENUTUP

## 7.1 Simpulan

Tujuan khusus pertama magang ini adalah mengidentifikasi dan menganalisis arsitektur sistem Viviashop secara menyeluruh agar kontribusi pengembangan dapat dilakukan secara terarah. Tujuan ini tercapai karena saya berhasil memahami ekosistem 35 model Eloquent, empat namespace controller, lima service layer, 13 tool AI agent, serta tujuh integrasi layanan eksternal. Pemahaman ini menjadi fondasi dari seluruh kontribusi teknis yang dilakukan selama 960 jam magang, sehingga tidak ada perbaikan atau penambahan fitur yang dilakukan tanpa terlebih dahulu memahami konteks sistem yang ada.

Tujuan khusus kedua adalah mengembangkan, memperbaiki, dan mengoptimasi fitur-fitur konkret dalam platform Viviashop. Tujuan ini juga tercapai dengan bukti-bukti konkret, seperti keberhasilan optimasi N+1 query yang menurunkan waktu muat dari 5 detik menjadi 1 detik, implementasi `SuggestSupplierTool` yang terdaftar di `ToolRegistry` dengan unit test yang passing, konsolidasi `StockManagementService` yang menghilangkan duplikasi logika update stok, perbaikan 96 bug dan penambahan fitur yang terdokumentasi dalam logbook, serta keberhasilan sistem berjalan stabil setelah *final testing* secara menyeluruh menjelang akhir periode magang.

Tujuan khusus ketiga adalah menghasilkan dokumentasi teknis yang dapat ditindaklanjuti. Hasilnya mencakup dokumentasi alur AI agent dan prosedur Midtrans setup yang tersimpan di Notion, panduan QA untuk modul kritis, panduan pengguna untuk customer dalam format Markdown, dan dokumentasi API internal yang mencatat endpoint penting beserta parameter dan struktur responsenya. Dokumentasi ini sudah digunakan oleh tim selama proses handover.

---

## 7.2 Saran

**Untuk CV Sinar Agung Jaya / Viviashop:**

Investasi waktu untuk meningkatkan test coverage dan membuat dokumentasi arsitektur formal akan menghasilkan manfaat yang signifikan, tidak hanya untuk mempercepat onboarding anggota baru, tetapi juga untuk mengurangi risiko regresi setiap kali ada perubahan di sistem. Konsolidasi file-file legacy yang masih ada di repository juga akan mengurangi kebingungan dan menurunkan beban kognitif tim. Untuk pengembangan AI agent ke depan, saya merekomendasikan untuk mengeksplorasi `CreatePurchaseDraftTool` dan `AggregateBusinessMetricsTool` yang sudah ada tetapi belum dioptimalkan sepenuhnya, karena kedua tool ini memiliki potensi besar untuk mendukung pengambilan keputusan bisnis berbasis data.

**Untuk UNESA / Program Studi Teknik Informatika:**

Fokus kurikulum disarankan memberikan porsi lebih besar pada kemampuan membaca dan menganalisis codebase yang sudah ada, serta menyertakan studi kasus pemeliharaan sistem dengan batasan arsitektur riil.

**Untuk Mahasiswa yang Akan Magang Setelahnya:**

Saran bagi mahasiswa magang berikutnya meliputi: meluangkan waktu awal untuk memahami struktur codebase secara teratur, aktif berkonsultasi mengenai kendala teknis secara sistematis, serta mencatat entri logbook harian secara detail dan spesifik guna mempermudah penyusunan laporan pertanggungjawaban.

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**


## DAFTAR PUSTAKA

Brown, T.B., Mann, B., Ryder, N., Subbiah, M., Kaplan, J., Dhariwal, P., Neelakantan, A., Shyam, P., Sastry, G., Askell, A., Agarwal, S., Herbert-Voss, A., Krueger, G., Henighan, T., Child, R., Ramesh, A., Ziegler, D.M., Wu, J., Winter, C., Hesse, C., Chen, M., Sigler, E., Litwin, M., Gray, S., Chess, B., Clark, J., Berner, C., McCandlish, S., Radford, A., Sutskever, I. and Amodei, D. (2020) 'Language Models are Few-Shot Learners', *Advances in Neural Information Processing Systems*, 33, pp. 1877-1901.

Date, C.J. (2004) *An Introduction to Database Systems*. 8th edn. Boston: Pearson Education.

Fielding, R.T. (2000) *Architectural Styles and the Design of Network-Based Software Architectures*. PhD Thesis. University of California, Irvine. Available at: https://www.ics.uci.edu/~fielding/pubs/dissertation/top.htm (Accessed: 20 June 2026).

Fowler, M. (2002) *Patterns of Enterprise Application Architecture*. Boston: Addison-Wesley.

Laravel (2024) *Laravel 10.x Documentation*. Available at: https://laravel.com/docs/10.x (Accessed: 26 January 2026).

Martin, R.C. (2008) *Clean Code: A Handbook of Agile Software Craftsmanship*. Upper Saddle River: Prentice Hall.

Midtrans (2024) *Midtrans Technical Documentation*. Available at: https://docs.midtrans.com (Accessed: 20 February 2026).

Pressman, R.S. (2014) *Software Engineering: A Practitioner's Approach*. 8th edn. New York: McGraw-Hill.

Purdue University (2021) *Best Practices for High-Impact Internships*. West Lafayette: Purdue University Career Center.

Richardson, L. and Ruby, S. (2007) *RESTful Web Services*. Sebastopol: O'Reilly Media.

Schick, T., Dwivedi-Yu, J., Dessì, R., Raileanu, R., Lomeli, M., Zettlemoyer, L., Cancedda, N. and Scialom, T. (2023) 'Toolformer: Language Models Can Teach Themselves to Use Tools', *arXiv preprint arXiv:2302.04761*.

Sommerville, I. (2019) *Software Engineering*. 10th edn. Hoboken: Pearson.

Statista (2024) *E-commerce in Indonesia, Statistics & Facts*. Available at: https://www.statista.com/topics/7789/e-commerce-in-indonesia/ (Accessed: 15 June 2026).

Universitas Negeri Surabaya (2024) *Panduan Mobilitas Akademik Magang Berdampak UNESA*. Surabaya: Sub Direktorat Mobilitas Akademik UNESA.

---

## LAMPIRAN

### Lampiran 1. Biodata Mahasiswa

**Nama Lengkap:** Raihan Rizki Alfareza

**NIM:** 23051204067

**Program Studi:** S1 Teknik Informatika

**Fakultas:** Teknik

**Universitas:** Universitas Negeri Surabaya (UNESA)

**No. Telepon:** 085155228237

**Email:** raihan.23067@mhs.unesa.ac.id

**Alamat:** Jl. Ketintang Wiyata Gedung A10, Ketintang, Gayungan, Surabaya, East Java 60231

[FOTO/GAMBAR: Foto resmi mahasiswa, PERLU DILAMPIRKAN]

---

### Lampiran 2. Logbook Harian Magang

Logbook harian magang tersedia dalam sistem Mobilitas Akademik UNESA dengan 96 entri yang mencakup periode 26 Januari 2026 hingga 1 Juni 2026. Total durasi tercatat: **960 jam (57.600 menit)**.

Contoh entri logbook yang disubmit ke sistem kampus:

**Tanggal:** 26 Januari 2026
**Judul:** Onboarding dan Setup Lingkungan Development
**Deskripsi:** Hari pertama magang di CV Sinar Agung Jaya. Dikenalin sama tim developer dan dikasih akses ke repository project Vivia App. Setup lingkungan development mulai dari install Laravel, Node.js, dan konfigurasi database lokal. Cukup lancar, cuma sempat bingung bedain branch staging sama production. Sorenya baca dokumentasi project biar paham alur bisnisnya.
**Durasi:** 600 menit (10 jam)

---

**Tanggal:** 1 Juni 2026
**Judul:** Kerja Remote Finalisasi Laporan
**Deskripsi:** Hari libur Hari Lahir Pancasila, kerja WFA. Selesaikan laporan akhir magang dan kumpulkan. Bantu final push ke repo, update README. Cek satu kali lagi semua fitur yang dikerjakan sudah berfungsi di staging. Pamit sama tim. Selesai sudah masa magang, banyak pelajaran berharga.
**Durasi:** 600 menit (10 jam)

[PERLU DILAMPIRKAN: Cetak/screenshot seluruh logbook dari sistem Mobilitas Akademik UNESA]

---

### Lampiran 3. Surat Keterangan Magang dari Mitra

[PERLU INPUT MANUAL, Surat keterangan resmi dari CV Sinar Agung Jaya yang ditandatangani oleh perwakilan perusahaan (Fanani Agung Widyanto) dan distempel perusahaan, menyatakan bahwa Raihan Rizki Alfareza (NIM: 23051204067) telah menyelesaikan magang di CV Sinar Agung Jaya dari 26 Januari 2026 hingga 1 Juni 2026]

---

### Lampiran 4. Screenshot / Dokumentasi Fitur yang Dikembangkan

[FOTO/GAMBAR: Screenshot dashboard admin Viviashop]

[FOTO/GAMBAR: Screenshot antarmuka AI Agent chatbot Viviashop, menampilkan respons tool ScanCriticalStockTool]

[FOTO/GAMBAR: Screenshot halaman laporan revenue dengan grafik Chart.js]

[FOTO/GAMBAR: Screenshot sistem print service, alur pilih jenis cetak dan kalkulasi biaya]

[FOTO/GAMBAR: Screenshot perbandingan waktu muat halaman produk sebelum dan sesudah optimasi query]

[FOTO/GAMBAR: Screenshot output PHPUnit testing yang passing]

---

### Lampiran 5. Lembar Penilaian dari Pembimbing Mitra

[PERLU INPUT MANUAL, Lembar penilaian yang diisi dan ditandatangani oleh Fanani Agung Widyanto selaku Pembimbing Mitra dari CV Sinar Agung Jaya, mencakup penilaian aspek: teknis (kualitas kode, kemampuan debugging, pemahaman arsitektur), kedisiplinan, komunikasi, dan dampak nyata dari tugas yang diselesaikan]

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**

---

*Laporan ini disusun oleh Raihan Rizki Alfareza (NIM: 23051204067) sebagai syarat penyelesaian program Mobilitas Akademik Magang S1 Teknik Informatika, Fakultas Teknik, Universitas Negeri Surabaya. Semua klaim teknis dalam laporan ini dapat diverifikasi dari kode sumber platform Viviashop dan logbook harian yang tersimpan di sistem UNESA.*
