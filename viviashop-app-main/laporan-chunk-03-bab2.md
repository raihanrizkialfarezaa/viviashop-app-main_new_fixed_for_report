
## BAB II
## TINJAUAN PUSTAKA

## 2.1 Penjelasan Industri yang Diikuti

CV Sinar Agung Jaya adalah perusahaan yang berbasis di Kabupaten Jombang, Jawa Timur, dengan fokus pada penyediaan solusi terintegrasi untuk instansi pemerintah dan sektor swasta. Model bisnis perusahaan ini tidak bergantung pada satu lini tunggal, melainkan ada tiga pilar yang berjalan bersamaan dan saling mendukung.

Pilar pertama adalah pengadaan Alat Tulis Kantor (ATK) dan layanan cetak *on-demand*. CV Sinar Agung Jaya melayani kebutuhan cetak kustom untuk berbagai keperluan, mulai dari dokumen adminsitrasi instansi pemerintah dalam volume besar hingga pesanan retail individual. Di sinilah platform Viviashop mengambil peran sentral karena sistem print service yang dibangun di dalam platform ini menangani alur pesanan cetak secara digital, dari unggah file oleh pelanggan hingga perhitungan biaya dan pembayaran.

Pilar kedua adalah solusi Teknologi Informasi. Perusahaan menyediakan pengadaan perangkat keras komputer sekaligus mengembangkan perangkat lunak berbasis web untuk mendukung digitalisasi administrasi mitra. Viviashop adalah produk nyata dari lini bisnis ini, yaitu platform yang awalnya dibangun untuk mendukung operasional internal, kemudian berkembang menjadi sistem e-commerce yang juga dapat diakses oleh pelanggan eksternal.

Pilar ketiga adalah konveksi kebutuhan event dan operasional: produksi tas, rompi, jaket, dan seragam lapangan untuk lembaga-lembaga yang memerlukan perlengkapan seragam dalam jumlah besar. Lini ini lebih bersifat manufaktur tradisional, tetapi rantai pengadaan dan manajemen pesanannya juga diintegrasikan ke dalam sistem.

Ketiga lini ini terhubung melalui satu platform digital: Viviashop. Dari sudut pandang teknis, Viviashop adalah aplikasi web monolitik berbasis Laravel 10 yang mengelola seluruh alur bisnis, mulai dari katalog produk, keranjang belanja, checkout, payment gateway, manajemen stok, laporan keuangan, hingga dashboard performa karyawan. Platform ini bukan sekadar toko online; ini adalah sistem ERP (Enterprise Resource Planning) yang dirancang khusus untuk skala dan kebutuhan operasional CV Sinar Agung Jaya.

### Posisi e-Commerce dalam Ekosistem Bisnis CV Sinar Agung Jaya

E-commerce di Indonesia tumbuh pesat dalam satu dekade terakhir. Menurut berbagai laporan industri, nilai transaksi e-commerce Indonesia melampaui USD 50 miliar pada tahun 2023, dengan proyeksi pertumbuhan yang konsisten memasuki tahun 2026 (Statista, 2024). Pertumbuhan ini tidak hanya didominasi oleh platform besar seperti Tokopedia atau Shopee, tetapi juga mendorong ribuan bisnis skala menengah untuk membangun saluran penjualan digital sendiri, baik untuk menghindari ketergantungan pada marketplace pihak ketiga maupun untuk membangun pengalaman pelanggan yang lebih terkontrol.

CV Sinar Agung Jaya memilih jalur yang kedua. Dengan membangun Viviashop sebagai platform mandiri, perusahaan mendapatkan fleksibilitas penuh dalam menentukan alur bisnis, struktur harga, dan pengalaman pelanggan, sesuatu yang tidak mungkin dilakukan di dalam ekosistem marketplace. Keputusan untuk menggunakan Laravel sebagai framework backend juga mencerminkan pertimbangan teknis yang matang, mengingat ekosistem Laravel yang kaya (dari Sanctum untuk autentikasi API hingga maatwebsite/excel untuk ekspor laporan) memungkinkan pengembangan fitur-fitur bisnis yang spesifik tanpa harus membangun komponen dasar dari nol.

Produk dan layanan utama yang ditawarkan melalui Viviashop mencakup:

- **Produk fisik.** Barang-barang yang dikelola melalui modul e-commerce standar: katalog, varian, stok, dan checkout.
- **Layanan cetak (*Print Service*).** Pesanan cetak dokumen dengan sistem unggah file, pemilihan jenis kertas dan tipe cetak, kalkulasi biaya otomatis, dan pembayaran terintegrasi.
- **Smart Print.** Variasi layanan cetak yang menggunakan deteksi otomatis jenis kertas dan tipe cetak menggunakan `SmartPrintVariantService`.
- **Layanan pengadaan.** Melalui modul pembelian (`Pembelian`, `PembelianDetail`, `Supplier`) yang mengintegrasikan rantai pasokan ke dalam platform yang sama.

Keunggulan kompetitif Viviashop terletak pada integrasi yang erat antara sistem e-commerce, manajemen stok, laporan keuangan, dan kecerdasan buatan dalam satu platform. Chatbot AI berbasis Google Gemini yang terintegrasi di dalam sistem bukan sekadar asisten virtual dekoratif, melainkan dapat memanggil 13 tool yang berbeda secara dinamis, dari pencarian produk berbasis SQL hingga pemindaian stok kritis dan pembuatan draft pembelian secara otomatis.

---

## 2.2 Struktur Organisasi Industri

[GAMBAR/BAGAN: Struktur Organisasi CV Sinar Agung Jaya, PERLU INPUT MANUAL dari pihak mitra]

Struktur organisasi formal CV Sinar Agung Jaya tidak terdokumentasikan secara eksplisit dalam materi yang dapat diakses selama magang. Berdasarkan pengamatan langsung dan interaksi dengan tim, pembagian kerja yang berlaku selama periode magang digambarkan di bawah ini.

- **Pimpinan / Owner.** Pengambil keputusan strategis, termasuk keputusan investasi teknologi dan arah pengembangan platform Viviashop.
- **Tim Pengembang Perangkat Lunak.** Bertanggung jawab atas pembangunan dan pemeliharaan platform Viviashop. Tim ini terdiri dari beberapa pengembang senior dan posisi magang yang diisi oleh mahasiswa UNESA.
- **Pembimbing Mitra.** Fanani Agung Widyanto, yang memimpin dan mengawasi tim pengembang serta menjadi narasumber teknis utama selama magang berlangsung.
- **Bagian Operasional.** Tim yang menangani pengadaan, konveksi, dan layanan cetak di sisi non-digital.
- **Mahasiswa Magang (posisi saya).** Ditempatkan di dalam tim pengembang, dengan akses penuh ke repository dan lingkungan pengembangan lokal, berkontribusi langsung pada pengembangan fitur dan perbaikan bug.

Posisi mahasiswa magang dalam struktur ini bukan posisi observasional. Dari hari pertama, saya mendapat akses ke repository aktif dan mulai mengeksplorasi kode yang berjalan di lingkungan produksi. Pembimbing mitra berperan sebagai *tech lead*, memberikan arahan tugas, melakukan code review, dan menjadi tempat konsultasi ketika saya menghadapi masalah yang tidak bisa dipecahkan sendiri.

[PERLU INPUT MANUAL, diagram resmi struktur organisasi dari manajemen CV Sinar Agung Jaya untuk dilampirkan sebagai gambar di laporan cetak]

---

## 2.3 Kerangka Konseptual Program Magang Berdampak

### Konsep dan Indikator Program Magang Berdampak

Program magang berdampak (*impactful internship*) adalah model magang yang secara eksplisit mengukur dan merencanakan kontribusi nyata, bukan sekadar pengalaman pasif. Berbeda dengan model magang konvensional di mana mahasiswa cenderung mengamati dan mengerjakan tugas administratif, program magang berdampak mendorong mahasiswa untuk mengidentifikasi masalah nyata di tempat mitra dan berkontribusi pada penyelesaiannya melalui kompetensi akademis yang mereka miliki (Purdue University, 2021; UNESA Panduan Mobilitas Akademik, 2024).

Indikator keberhasilannya mencakup dua sisi:

**Outcome untuk mahasiswa:**
- Perolehan keterampilan teknis yang terverifikasi dan dapat dibuktikan (bukan sekadar pengakuan verbal)
- Pemahaman konteks kerja nyata: bagaimana sebuah tim bekerja, bagaimana keputusan teknis diambil di bawah tekanan waktu, dan bagaimana mengelola prioritas yang saling bersaing
- Perluasan jaringan profesional yang fungsional, tidak hanya mengenal nama, tetapi sudah bekerja bersama

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
