
## BAB I
## PENDAHULUAN

## 1.1 Latar Belakang

Perguruan tinggi di Indonesia saat ini berhadapan dengan tekanan yang nyata karena banyak lulusan yang secara akademis kompeten tetapi belum terbiasa dengan ritme kerja nyata. Program magang hadir sebagai jembatan  -  bukan pemanis di akhir kurikulum, melainkan ruang di mana teori benar-benar diuji. Melalui keterlibatan langsung di dunia kerja, mahasiswa memperoleh pengalaman yang tidak bisa direplikasi di dalam kelas, seperti merespons tenggat yang bergerak, bekerja dengan sistem yang sudah berjalan, dan membuat keputusan teknis dengan konsekuensi nyata. Untuk program studi S1 Teknik Informatika, magang bukan sekadar pelengkap SKS  -  ini adalah ujian apakah kemampuan yang dibangun selama tiga tahun perkuliahan cukup untuk menghadapi satu sprint pengembangan perangkat lunak di dunia nyata.

Industri teknologi informasi di Indonesia tumbuh dengan kecepatan yang konsisten melampaui rata-rata industri lain. Sektor e-commerce nasional mencatat nilai transaksi yang menembus ratusan triliun rupiah per tahun, dengan pertumbuhan pengguna digital yang terus meningkat seiring penetrasi internet ke wilayah-wilayah yang sebelumnya belum terjangkau. Di saat bersamaan, adopsi teknologi cloud, kecerdasan buatan, dan sistem integrasi API menjadi kebutuhan dasar, bukan lagi keunggulan diferensiatif. Dunia usaha  -  termasuk skala UMKM dan menengah  -  tidak lagi bisa menunda digitalisasi operasional mereka. Kondisi ini melahirkan permintaan yang tidak kecil terhadap tenaga pengembang perangkat lunak yang tidak hanya memahami sintaksis, tetapi juga mampu bekerja dalam ekosistem proyek yang kompleks.

CV Sinar Agung Jaya dipilih sebagai lokasi magang karena menawarkan ruang belajar yang langka, yaitu sebuah perusahaan yang secara aktif membangun platform digital milik sendiri untuk mendukung operasional bisnis riilnya. Platform Viviashop  -  yang dikembangkan di dalam perusahaan ini  -  bukan proyek sampingan atau prototipe. Ini adalah sistem produksi aktif yang menangani transaksi e-commerce, layanan cetak dokumen (print service), manajemen stok multi-layer, laporan keuangan, hingga chatbot berbasis kecerdasan buatan yang terintegrasi dengan Google Gemini API. Bergabung ke dalam tim pengembang Viviashop berarti langsung berhadapan dengan codebase Laravel 10 yang sudah berisi lebih dari 35 model Eloquent, 40+ controller, dan 27 artisan command  -  bukan proyek baru yang bisa dimulai dari nol dengan asumsi-asumsi yang nyaman. Kompleksitas ini menjadi daya tarik sekaligus tantangan yang memberikan nilai pembelajaran tertinggi.

Magang ini dirancang bukan hanya untuk menyerap pengalaman, tetapi untuk berkontribusi secara terukur. Kontribusi yang diharapkan bukan dari sudut pandang satu proyek besar yang diselesaikan sendirian, melainkan dari rangkaian perbaikan nyata, fitur yang ditambahkan, bug yang diperbaiki, dan dokumentasi yang ditulis  -  yang keseluruhannya terekam dalam logbook selama 960 jam. Pendekatan ini sejalan dengan prinsip program Magang Berdampak yang digagas UNESA, di mana mahasiswa bukan pengamat pasif di tempat mitra, melainkan kontributor aktif yang kehadiran dan karyanya meninggalkan jejak nyata. Indikator keberhasilan magang ini diukur melalui logbook harian yang terdokumentasi di sistem kampus, laporan akhir yang dapat dipertanggungjawabkan secara teknis, serta evaluasi dari pembimbing mitra atas kualitas kerja dan kedisiplinan selama periode berlangsung. Luaran yang dihasilkan  -  dari fitur-fitur yang dikembangkan hingga dokumentasi teknis yang disusun  -  menjadi bukti konkret bahwa 960 jam yang dihabiskan di CV Sinar Agung Jaya memberi dampak yang bisa diidentifikasi, bukan sekadar waktu yang terlewat.

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

1. Mengidentifikasi dan menganalisis arsitektur sistem Viviashop secara menyeluruh  -  mencakup lapisan backend (Laravel 10), frontend (Blade + Bootstrap 4 + Vite), database (MySQL), dan integrasi layanan eksternal (Midtrans, RajaOngkir, Cloudinary, Google Gemini)  -  sehingga kontribusi pengembangan dapat dilakukan secara terarah dan tidak menimbulkan regresi.

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

- Pengalaman kerja nyata dalam proyek perangkat lunak berskala produksi  -  bukan proyek kelas yang bisa di-reset kapan saja.
- Penerapan langsung ilmu dari mata kuliah Konstruksi Perangkat Lunak, Analisis dan Desain Perangkat Lunak, Verifikasi dan Validasi Perangkat Lunak, Web Semantik, dan Virtualisasi dan Komputasi Awan dalam konteks kerja riil.
- Peningkatan kompetensi teknis: Laravel 10, MySQL query optimization, API integration, Vite asset bundling, PHPUnit testing, dan pengembangan sistem AI berbasis LLM (Gemini API).
- Kemampuan membaca, memahami, dan berkontribusi pada codebase yang sudah berjalan  -  keterampilan yang sangat berbeda dari memulai proyek dari nol.
- Jaringan profesional dengan tim pengembang di industri perangkat lunak Jawa Timur.

### Bagi Mitra (CV Sinar Agung Jaya / Viviashop)

- Kontribusi SDM mahasiswa yang mendukung percepatan pengembangan platform Viviashop  -  dari perbaikan bug yang tertunda hingga penambahan fitur baru yang dibutuhkan operasional.
- Kerja sama yang saling menguntungkan dengan UNESA sebagai institusi pendidikan tinggi, yang membuka peluang kolaborasi jangka panjang.
- Dokumentasi teknis yang lebih lengkap sebagai hasil langsung dari keterlibatan mahasiswa, termasuk panduan fitur AI agent dan alur pengujian sistem.
- Kandidat tenaga kerja yang sudah memahami arsitektur sistem, budaya kerja, dan standar pengembangan yang berlaku di tim.

### Bagi Universitas Negeri Surabaya (UNESA)

- Lulusan Teknik Informatika yang memiliki jam terbang nyata di lingkungan pengembangan perangkat lunak produksi, bukan hanya di lingkungan laboratorium.
- Penguatan kerja sama dengan mitra industri di sektor teknologi  -  CV Sinar Agung Jaya sebagai contoh kolaborasi yang produktif dan bisa direplikasi.
- Umpan balik kurikulum dari pengalaman nyata: kompetensi mana yang sudah cukup dipersiapkan oleh kurikulum, dan mana yang masih membutuhkan penguatan.
- Peningkatan reputasi institusi melalui mahasiswa yang memberikan kontribusi nyata kepada mitra.

---

## 1.5 Urgensi Magang

Kebutuhan akan pengembang perangkat lunak yang berpengalaman tidak menunggu mahasiswa lulus. Industri mengharapkan kandidat yang sudah pernah bersentuhan dengan kompleksitas sistem nyata  -  bukan hanya yang bisa menulis kode di lingkungan ideal. Viviashop mewakili jenis sistem yang dioperasikan ribuan bisnis digital skala menengah di Indonesia yang bersifat multi-modul, multi-integrasi, dan dioperasikan dengan tim kecil yang menuntut setiap anggotanya mampu berpindah konteks dengan cepat.

Program magang ini mendesak untuk dijalankan karena gap antara kemampuan yang diukur di kampus dan yang dibutuhkan industri masih cukup lebar. Kemampuan membaca codebase orang lain, bekerja dengan sistem legacy, mengelola konflik di version control, dan mendebug error di environment production adalah kompetensi yang hampir tidak bisa diajarkan di kelas  -  ia hanya bisa diperoleh melalui paparan langsung. Selama 960 jam magang di CV Sinar Agung Jaya, paparan itu terjadi setiap hari kerja, dalam bentuk tugas nyata dengan konsekuensi nyata.

---

## 1.6 Kontribusi Riset terhadap Ilmu Pengetahuan

Magang ini bukan penelitian formal, tetapi pengalaman yang dijalani menghasilkan kontribusi yang relevan untuk pengembangan keilmuan Teknik Informatika dalam beberapa aspek:

**Penerapan dan pengujian konsep akademis dalam konteks nyata.** Konsep-konsep dari mata kuliah Konstruksi Perangkat Lunak  -  seperti *refactoring*, *service layer pattern*, dan *separation of concerns*  -  diuji dan diterapkan langsung ketika merapikan `StockManagementService`, memisahkan `CategoryService` dari `CategoryController`, dan merefaktor `AttributeVariantController`. Hasilnya bukan hanya kode yang lebih rapi, tetapi pemahaman yang lebih dalam tentang kapan sebuah abstraksi *perlu* dilakukan dan kapan ia hanya menambah kompleksitas yang tidak perlu.

**Dokumentasi praktik pengembangan perangkat lunak e-commerce dengan integrasi AI.** Arsitektur sistem AI agent yang diimplementasikan dalam Viviashop  -  dengan pola `ToolDispatcher` → `ToolRegistry` → `ToolHandler` yang menggantungkan 13 tool pada satu orchestrator `AIAgentService`  -  adalah contoh nyata dari integrasi LLM ke dalam aplikasi web monolitik. Dokumentasi alur ini menjadi referensi berharga untuk pengembangan sistem serupa.

**Temuan tentang manajemen stok multi-layer dalam e-commerce.** Sistem Viviashop menggunakan tiga layer stok secara bersamaan (`ProductInventory`, `ProductVariant.stock`, dan `StockMovement`), dengan `RekamanStok` sebagai model legacy yang sudah tidak disarankan digunakan. Tantangan menjaga konsistensi antar-layer ini menjadi temuan teknis yang relevan untuk kajian arsitektur database di e-commerce.

---

## 1.7 Luaran Magang

Berikut adalah luaran konkret yang dihasilkan selama dan setelah periode magang:

1. **Laporan akhir magang**  -  dokumen ini, yang mendokumentasikan seluruh proses, temuan teknis, dan refleksi selama 960 jam di CV Sinar Agung Jaya.

2. **Kontribusi kode ke platform Viviashop** (dapat diverifikasi dari logbook dan repository):
   - Perbaikan N+1 query di `ProductController`  -  load time turun dari ~5 detik menjadi ~1 detik
   - Optimasi query varian produk dengan database indexing  -  diuji dengan 1.000 produk dummy
   - Implementasi dan perbaikan sistem caching menggunakan Laravel Cache facade dengan TTL 10 menit
   - Integrasi `ScanCriticalStockTool` ke dalam route AI agent + fix format output
   - Implementasi `SuggestSupplierTool` dengan unit test
   - Refaktor `StockManagementService`  -  konsolidasi logika update stok dari berbagai titik transaksi
   - Perbaikan `WishListController`  -  sinkronisasi state wishlist setelah login
   - Export data user ke Excel (UserExport) dengan filter role
   - Perbaikan alur reset password (`ForgotPasswordController`, token generation)
   - Fix bug checkout  -  penyesuaian `CartControllerNew` dengan perubahan model `Shipment`
   - Implementasi fitur brand untuk produk  -  halaman admin, relasi di `Product` model
   - Perbaikan slider homepage + testimonial  -  storage link, rating validation
   - Berbagai perbaikan UI dan bug lainnya yang terdokumentasi dalam 96 entri logbook

3. **Dokumentasi teknis** (disusun di Notion dan dalam markdown project):
   - Alur sistem AI agent Viviashop
   - Prosedur setup Midtrans (sandbox dan production)
   - Panduan QA untuk modul-modul kritis (order, payment, print service)
   - Panduan pengguna customer (login, belanja, checkout, lacak pesanan)
   - Dokumentasi API internal (endpoint list dengan parameter dan response)

4. **Rekomendasi pengembangan** untuk mitra CV Sinar Agung Jaya berdasarkan observasi teknis selama magang  -  sebagaimana diuraikan pada BAB VI.

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**
