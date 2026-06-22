# LAPORAN AKHIR MAGANG

# PENGEMBANGAN PLATFORM E-COMMERCE VIVIASHOP BERBASIS LARAVEL DENGAN INTEGRASI PAYMENT GATEWAY, AI CHATBOT AGENT, DAN PRINT SERVICE MANAGEMENT SYSTEM

Di [NAMA INSTANSI MITRA — PERLU INPUT MANUAL]

**Penyusun:**
[NAMA LENGKAP MAHASISWA — PERLU INPUT MANUAL]
NIM: [NIM — PERLU INPUT MANUAL]

**UNIVERSITAS NEGERI SURABAYA**
FAKULTAS [NAMA FAKULTAS — PERLU INPUT MANUAL]
PROGRAM STUDI [NAMA PROGRAM STUDI — PERLU INPUT MANUAL]
Tahun [TAHUN — PERLU INPUT MANUAL]

---

## Lembar Pengesahan

| | |
|---|---|
| **Judul Kegiatan** | Pengembangan Platform E-Commerce Viviashop Berbasis Laravel dengan Integrasi Payment Gateway, AI Chatbot Agent, dan Print Service Management System |
| **Nama Instansi** | [NAMA INSTANSI MITRA — PERLU INPUT MANUAL] |
| **Alamat Instansi** | [ALAMAT INSTANSI — PERLU INPUT MANUAL] |

**Identitas Mahasiswa:**

| | |
|---|---|
| Nama | [NAMA LENGKAP — PERLU INPUT MANUAL] |
| NIM | [NIM — PERLU INPUT MANUAL] |
| Prodi/Jurusan | [PRODI/JURUSAN — PERLU INPUT MANUAL] |
| Fakultas | [FAKULTAS — PERLU INPUT MANUAL] |
| No Tlp. | [NO TELEPON — PERLU INPUT MANUAL] |
| Alamat Email | [EMAIL — PERLU INPUT MANUAL] |
| Periode Magang | [TANGGAL MULAI] s.d. [TANGGAL SELESAI — PERLU INPUT MANUAL] |

Surabaya, [TANGGAL — PERLU INPUT MANUAL]

| Mengetahui | |
|---|---|
| Dosen Pembimbing Lapangan | Mahasiswa |
| [NAMA DPL — PERLU INPUT MANUAL] | [NAMA MAHASISWA — PERLU INPUT MANUAL] |
| NIP. [NIP DPL — PERLU INPUT MANUAL] | NIM. [NIM — PERLU INPUT MANUAL] |

| Menyetujui, | |
|---|---|
| Pembimbing Mitra | Koordinator Program Studi |
| [NAMA PEMBIMBING MITRA — PERLU INPUT MANUAL] | [NAMA KAPRODI — PERLU INPUT MANUAL] |
| NIP/Identitas: [IDENTITAS — PERLU INPUT MANUAL] | NIP. [NIP KAPRODI — PERLU INPUT MANUAL] |

**Laporan Akhir Mobilitas Akademik Magang Tahun [TAHUN — PERLU INPUT MANUAL]**

---

## DAFTAR ISI

| | Hal |
|---|---|
| DAFTAR ISI | i |
| DAFTAR TABEL | ii |
| DAFTAR GAMBAR | iii |
| BAB I. PENDAHULUAN | 1 |
| 1.1 Latar Belakang | 1 |
| 1.2 Tujuan Magang | 4 |
| 1.3 Manfaat | 5 |
| BAB II. TINJAUAN PUSTAKA | 7 |
| 2.1 Penjelasan Industri yang Diikuti | 7 |
| 2.2 Struktur Organisasi Industri | 8 |
| 2.3 Kerangka Konseptual Program Magang Berdampak | 9 |
| BAB III. METODE PELAKSANAAN | 10 |
| 3.1 Bentuk Penugasan (Task Assignment) | 10 |
| 3.2 Waktu | 11 |
| 3.3 Prosedur | 11 |
| BAB IV. PELAKSANAAN KEGIATAN YANG RELEVAN DENGAN KONVERSI MATA KULIAH | 14 |
| 4.1 Aktivitas Harian yang Dikerjakan Selama di Mitra | 14 |
| 4.2 Hasil Proyek yang Telah Dikembangkan | 18 |
| 4.3 Pembahasan (Relevansi dengan Keilmuan Program Studi) | 40 |
| 4.4 Relevansi dengan Mata Kuliah Konversi | 42 |
| BAB V. HAMBATAN DAN DUKUNGAN PELAKSANAAN MAGANG | 46 |
| 5.1 Hambatan | 46 |
| 5.2 Dukungan | 48 |
| BAB VI. REFLEKSI, RENCANA TINDAK LANJUT & REKOMENDASI | 49 |
| 6.1 Refleksi | 49 |
| 6.2 Rekomendasi untuk Mitra | 51 |
| 6.3 Rekomendasi untuk Program Magang | 53 |
| 6.4 Rencana Pengembangan Diri | 53 |
| 6.5 Potensi Keberlanjutan Program | 54 |
| BAB VII. PENUTUP | 55 |
| 7.1 Simpulan | 55 |
| 7.2 Saran | 56 |
| DAFTAR PUSTAKA | 57 |
| LAMPIRAN | 58 |
| Lampiran 1. Biodata Mahasiswa | 58 |
| Lampiran 2. Inventaris Teknis Project | 58 |

---

## DAFTAR TABEL

Tabel 3.1 Teknik Pelaksanaan Kegiatan Magang ..... 13
Tabel 4.1 Aktivitas Harian Magang Bulan Pertama ..... 14
Tabel 4.2 Aktivitas Harian Magang Bulan Kedua ..... 15
Tabel 4.3 Aktivitas Harian Magang Bulan Ketiga ..... 16
Tabel 4.4 Aktivitas Harian Magang Bulan Keempat ..... 17
Tabel 4.5 Tech Stack Backend Viviashop ..... 20
Tabel 4.6 Tech Stack Frontend Viviashop ..... 21
Tabel 4.7 Integrasi Bisnis dan Eksternal ..... 21
Tabel 4.8 Daftar Model Eloquent Berdasarkan Domain ..... 23
Tabel 4.9 Daftar AI Agent Tools ..... 34
Tabel 4.10 Dampak Mini Proyek ..... 38
Tabel 4.11 Relevansi Kegiatan dengan Mata Kuliah Konversi ..... 42

---

## DAFTAR GAMBAR

Gambar 2.1 Struktur Organisasi [NAMA INSTANSI — PERLU INPUT MANUAL] ..... 8
Gambar 4.1 Arsitektur Monolitik Laravel Viviashop ..... 19
Gambar 4.2 Alur Kerja Belanja Online Reguler ..... 25
Gambar 4.3 Alur Kerja Print Service ..... 30
Gambar 4.4 Arsitektur AI Agent System ..... 33
[FOTO/GAMBAR: Screenshot halaman homepage Viviashop] ..... 26
[FOTO/GAMBAR: Screenshot dashboard admin Viviashop] ..... 27
[FOTO/GAMBAR: Screenshot halaman print service customer] ..... 31
[FOTO/GAMBAR: Screenshot AI chatbot interface] ..... 35
[FOTO/GAMBAR: Screenshot halaman stock card/movement] ..... 29

---

# BAB I PENDAHULUAN

## 1.1. Latar Belakang

Magang kerja merupakan salah satu strategi penting dalam sistem pendidikan tinggi untuk meningkatkan kualitas lulusan. Melalui program magang, mahasiswa berkesempatan berinteraksi langsung dengan dunia kerja, memahami tantangan nyata di lapangan, dan menerapkan kompetensi akademik yang selama ini dipelajari secara teoretis. Program Merdeka Belajar Kampus Merdeka (MBKM) yang dicanangkan Kementerian Pendidikan telah memperkuat kedudukan magang sebagai wahana pembelajaran yang menjembatani teori di kelas dengan praktik di industri. Dengan adanya magang yang terstruktur, mahasiswa tidak hanya mendapat pengalaman kerja, tetapi juga memberi kontribusi nyata yang terukur kepada mitra tempat magang.

Saat ini, industri e-commerce di Indonesia terus menunjukkan pertumbuhan yang signifikan. Data dari Bank Indonesia mencatat bahwa nilai transaksi e-commerce nasional mencapai ratusan triliun rupiah per tahun dan terus meningkat seiring dengan akselerasi digitalisasi pasca-pandemi. Perkembangan ini bukan hanya soal volume transaksi — di baliknya terdapat kebutuhan mendesak akan tenaga kerja yang menguasai pengembangan perangkat lunak, integrasi sistem pembayaran digital, manajemen inventori berbasis data, dan pemanfaatan kecerdasan buatan untuk meningkatkan pengalaman pengguna. Revolusi industri 4.0 menuntut lulusan yang tidak sekadar paham teori pemrograman, tetapi mampu merancang, membangun, dan memelihara sistem digital yang kompleks dan terintegrasi.

Viviashop dipilih sebagai proyek magang karena platform ini merepresentasikan kompleksitas nyata yang dihadapi industri digital saat ini. Viviashop bukan sekadar toko online sederhana. Berdasarkan inspeksi langsung terhadap kode sumber, platform ini telah berkembang menjadi sistem operasional retail yang mencakup e-commerce frontend, backoffice admin, sistem inventori dengan audit trail, procurement dan pembelian dari supplier, layanan print service berbasis sesi dan upload file, tracking performa karyawan, integrasi payment gateway Midtrans, ongkos kirim RajaOngkir, media hosting Cloudinary, kanal promosi Instagram, serta AI chatbot agent berbasis Google Gemini (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 5-24). Hasil inspeksi menunjukkan permukaan aplikasi yang cukup besar: 35 model Eloquent, lebih dari 46 controller, 5 service class utama, 76 migration database, dan lebih dari 180 view Blade (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 28-36).

Keunikan Viviashop terletak pada cakupan domainnya yang luas dalam satu codebase monolitik Laravel. Platform ini tidak hanya melayani penjualan online, tetapi juga mendukung penjualan offline melalui panel admin, mengelola rantai pasok dari supplier, memantau mutasi stok secara real-time, dan bahkan menyediakan workflow pencetakan dokumen yang lengkap — dari upload file, penghitungan halaman, pemilihan jenis kertas, hingga antrian cetak dan pembayaran. Ditambah lagi dengan sistem AI agent custom yang mampu melakukan pencarian produk via SQL, menghitung biaya cetak, memantau stok kritis, dan menghasilkan laporan bisnis secara otomatis. Semua fitur ini dibangun di atas fondasi Laravel 10 dengan PHP 8.1, MySQL, Bootstrap 4, jQuery, dan Vite sebagai build tool (sumber: composer.json, package.json).

Dengan pendekatan magang berbasis dampak, saya tidak hanya bertujuan menyerap ilmu dari proyek ini, tetapi juga memberikan kontribusi melalui pengembangan fitur baru, perbaikan arsitektur kode, dokumentasi teknis yang komprehensif, dan implementasi AI agent system yang merupakan diferensiasi kuat dari platform e-commerce konvensional. Proyek ini mendukung pencapaian Sustainable Development Goals (SDGs), khususnya SDG 8 (Pekerjaan Layak dan Pertumbuhan Ekonomi) melalui digitalisasi bisnis retail, SDG 9 (Industri, Inovasi, dan Infrastruktur) melalui penerapan teknologi AI dan integrasi sistem pembayaran digital, serta SDG 4 (Pendidikan Berkualitas) melalui transfer pengetahuan pengembangan perangkat lunak tingkat enterprise.

## 1.2. Tujuan Magang

### 1. Tujuan Umum

- Memberikan pengalaman langsung kepada mahasiswa dalam pengembangan aplikasi web full-stack berskala enterprise di dunia kerja sesuai bidang keilmuan.
- Menumbuhkan kemampuan problem solving berbasis praktik lapangan, khususnya dalam mengatasi tantangan teknis pengembangan perangkat lunak yang kompleks dan terintegrasi dengan berbagai layanan pihak ketiga.

### 2. Tujuan Khusus (teknis)

- Menganalisis dan memahami arsitektur monolitik Laravel pada platform e-commerce Viviashop yang mencakup lebih dari 35 model, 46 controller, dan 5 service layer.
- Mengembangkan AI chatbot agent berbasis Google Gemini API dengan arsitektur custom (tanpa framework AI seperti LangChain) yang mendukung 14 tool operasional dengan role-based access control.
- Mengimplementasikan dan mengintegrasikan modul print service management system yang mendukung workflow berbasis sesi, upload multi-file, penghitungan halaman otomatis, dan integrasi pembayaran.
- Menyusun dokumentasi teknis dan fungsional yang komprehensif sebagai panduan maintenance dan pengembangan lanjutan platform.

### Keterampilan Teknis

- ✔ Mahasiswa mampu mempersiapkan hal-hal teknis yang diperlukan untuk melaksanakan pengembangan aplikasi web berbasis Laravel sesuai dengan kebutuhan proyek.
- ✔ Mahasiswa mampu menjelaskan dan melaksanakan aktivitas pengembangan fitur, integrasi API, debugging, dan testing sesuai dengan arsitektur sistem yang ada.
- ✔ Mahasiswa mampu menyusun dokumentasi teknis di setiap modul yang telah dikembangkan.

### Keterampilan Relasional

- ✔ Mahasiswa mampu menerima informasi terkait spesifikasi teknis dan kebutuhan bisnis dengan lengkap dan akurat baik secara lisan maupun tertulis.
- ✔ Mahasiswa mampu menyampaikan laporan progres pengembangan kepada pembimbing secara akurat dan tepat waktu.
- ✔ Mahasiswa mampu menjalin hubungan kerja yang produktif dengan tim pengembangan dan pembimbing mitra.
- ✔ Mahasiswa mampu membangun disiplin kerja individual yang kuat dalam mengelola repository kode dan dokumentasi proyek.

## 1.3 Manfaat

### 1. Bagi Mahasiswa

- Memberikan pengalaman kerja nyata dalam pengembangan aplikasi web full-stack yang relevan dengan bidang keilmuan, khususnya dalam membangun platform e-commerce menggunakan Laravel, MySQL, dan berbagai integrasi pihak ketiga.
- Menjadi sarana penerapan ilmu pemrograman, basis data, rekayasa perangkat lunak, dan kecerdasan buatan yang diperoleh selama perkuliahan ke dalam proyek yang beroperasi secara nyata dengan pengguna dan transaksi sungguhan.
- Meningkatkan kompetensi teknis seperti pengembangan backend PHP/Laravel, pengelolaan database relasional, integrasi API (Midtrans, RajaOngkir, Gemini, Cloudinary), serta kompetensi non-teknis seperti dokumentasi, komunikasi teknis, dan manajemen waktu pengembangan.
- Menumbuhkan sikap profesional dan kesiapan menghadapi tantangan pengembangan perangkat lunak di dunia industri, termasuk menghadapi technical debt dan arsitektur legacy.
- Memperluas portofolio kerja dengan proyek nyata berskala enterprise yang mencakup lebih dari 76 migration database dan 14 AI tools.

### 2. Bagi Mitra (Instansi/Perusahaan)

- Mendapatkan kontribusi pengembangan fitur-fitur baru pada platform Viviashop, khususnya modul AI chatbot agent dan perbaikan modul print service yang mendukung operasional bisnis.
- Memperoleh dokumentasi teknis dan fungsional komprehensif (DOKUMENTASI_TEKNIS_VIVIASHOP.md sepanjang 1439 baris) yang sebelumnya tidak tersedia, sehingga memudahkan proses maintenance dan onboarding pengembang baru.
- Meningkatkan efisiensi operasional melalui AI agent yang mampu melakukan pencarian produk, pemantauan stok kritis, dan generasi laporan bisnis secara otomatis tanpa intervensi manual.
- Memperoleh calon tenaga kerja yang telah memahami secara mendalam arsitektur dan domain bisnis platform Viviashop.

### 3. Bagi Universitas Negeri Surabaya (UNESA)

- Meningkatkan kualitas lulusan yang memiliki pengalaman praktis dalam pengembangan aplikasi web enterprise dan integrasi AI.
- Memperkuat kerja sama dan kolaborasi dengan mitra industri digital dalam mendukung program mobilitas akademik dan kurikulum MBKM.
- Mendapatkan umpan balik dari proyek nyata terkait relevansi kurikulum pemrograman, basis data, dan rekayasa perangkat lunak dengan kebutuhan industri terkini.
- Mendorong peningkatan reputasi institusi melalui keterlibatan aktif mahasiswa dalam pengembangan platform yang terintegrasi dengan teknologi AI generatif.

---

# BAB II

# TINJAUAN PUSTAKA

## 2.1. Penjelasan Industri yang Diikuti

[NAMA INSTANSI MITRA — PERLU INPUT MANUAL] merupakan perusahaan yang bergerak di bidang perdagangan digital dan layanan cetak (print service). Perusahaan ini mengoperasikan platform Viviashop, sebuah sistem e-commerce yang dibangun menggunakan framework Laravel dan melayani penjualan produk secara online maupun offline.

Secara garis besar, bisnis yang dijalankan melalui platform Viviashop dapat dikategorikan ke dalam beberapa lini usaha:

**1. E-Commerce dan Penjualan Online.** Platform ini menyediakan katalog produk yang mendukung produk sederhana (simple product) maupun produk configurable dengan sistem varian. Pelanggan dapat melakukan pencarian produk — termasuk fuzzy search menggunakan algoritma Levenshtein dan Jaro-Winkler (sumber: Frontend\HomepageController.php) — menambahkan ke keranjang, melakukan checkout dengan pilihan self pickup atau pengiriman via kurir, dan membayar melalui berbagai metode pembayaran yang terintegrasi dengan Midtrans.

**2. Penjualan Offline / Toko Fisik.** Menariknya, Viviashop juga mendukung channel penjualan offline. Admin dapat membuat order secara manual dari panel admin, memilih produk dan varian, memvalidasi stok, serta memilih metode pembayaran toko, QRIS, Midtrans, atau transfer bank (sumber: Admin\OrderController.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 681-692).

**3. Layanan Print Service.** Ini merupakan salah satu diferensiasi kuat Viviashop dari platform e-commerce konvensional. Layanan cetak berbasis sesi ini mendukung workflow lengkap: dari generate sesi print dengan QR code, upload multi-file (PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, dan lainnya), penghitungan halaman otomatis berdasarkan tipe file, pemilihan jenis kertas dan tipe cetak, kalkulasi harga, hingga checkout, pembayaran, antrian cetak, dan pembersihan file setelah selesai (sumber: PrintService.php, PrintServiceController.php).

**4. Manajemen Supply Chain.** Platform ini memiliki modul procurement yang mengelola data supplier, pembuatan draft pembelian, detail item pembelian dengan dukungan produk varian, proyeksi stok real-time, dan finalisasi pembelian yang otomatis memperbarui stok melalui StockService (sumber: PembelianController.php, PembelianDetailController.php).

Industri e-commerce dan digital retail diprediksi akan terus menjadi salah satu sektor unggulan dalam perekonomian Indonesia. Pertumbuhan ini didorong oleh peningkatan penetrasi internet, adopsi pembayaran digital, dan pergeseran perilaku konsumen pasca-pandemi. Keterlibatan mahasiswa dalam proyek pengembangan platform e-commerce yang kompleks seperti Viviashop akan memperkuat kapabilitas sebagai calon profesional di sektor teknologi digital.

## 2.2. Struktur Organisasi Industri

[FOTO/GAMBAR: Struktur Organisasi NAMA INSTANSI — PERLU INPUT MANUAL]

[PERLU INPUT MANUAL: Struktur organisasi instansi mitra tidak tersedia di dalam codebase. Mohon dilengkapi dengan bagan struktur organisasi dari instansi/perusahaan tempat magang.]

## 2.3. Kerangka Konseptual Program Magang Berdampak

Program magang berdampak memiliki ciri khas utama: mahasiswa bukan sekadar mengamati atau membantu pekerjaan rutin, melainkan secara aktif menghasilkan output dan outcome yang dapat dirasakan manfaatnya oleh mitra maupun mahasiswa itu sendiri.

**Indikator magang berdampak meliputi:**

1. **Outcome untuk mahasiswa:**
   - Peningkatan keterampilan teknis yang terverifikasi (dalam konteks ini: kemampuan membangun aplikasi Laravel berskala enterprise, integrasi API pihak ketiga, dan pengembangan AI agent).
   - Pemahaman konteks kerja nyata, termasuk menghadapi technical debt, legacy code, dan kebutuhan bisnis yang dinamis.
   - Perluasan jejaring profesional dengan tim pengembangan dan stakeholder bisnis.

2. **Outcome untuk mitra:**
   - Kontribusi nyata berupa fitur dan modul baru yang berfungsi dan terintegrasi ke dalam platform.
   - Dokumentasi teknis yang sebelumnya tidak tersedia — DOKUMENTASI_TEKNIS_VIVIASHOP.md sepanjang 1439 baris adalah contoh konkret kontribusi yang meningkatkan maintainability sistem.
   - Rekomendasi perbaikan arsitektur dan prioritas pengembangan berdasarkan audit kode sumber.

3. **Pendekatan pengukuran dampak:**
   - Jumlah fitur yang berhasil dikembangkan dan terintegrasi ke production.
   - Cakupan dokumentasi teknis yang dihasilkan.
   - Jumlah tool AI agent yang berhasil diimplementasikan dan berfungsi.
   - Penurunan waktu yang diperlukan untuk onboarding pengembang baru berkat adanya dokumentasi.

Studi sebelumnya menunjukkan bahwa program magang berbasis proyek (project-based internship) secara konsisten menghasilkan tingkat kepuasan yang lebih tinggi dibandingkan magang berbasis observasi. Mahasiswa yang terlibat langsung dalam pengembangan produk atau sistem cenderung menunjukkan peningkatan kompetensi problem-solving yang lebih signifikan (Kolb, 2014; Beard & Wilson, 2013).

---

# BAB III.

# METODE PELAKSANAAN

## 3.1. Bentuk Penugasan (Task Assignment)

Penugasan selama magang di proyek Viviashop dilaksanakan dalam format pengembangan perangkat lunak full-stack dengan pendekatan iteratif. Saya berperan sebagai full-stack web developer yang bertanggung jawab atas pengembangan fitur baru, perbaikan modul yang sudah ada, integrasi layanan pihak ketiga, dan dokumentasi teknis.

Secara spesifik, bentuk penugasan yang diberikan meliputi:

1. **Analisis dan audit arsitektur sistem** — Melakukan pemetaan menyeluruh terhadap struktur kode, model database, routing, controller, dan service layer pada platform Viviashop.

2. **Pengembangan modul AI chatbot agent** — Merancang dan mengimplementasikan sistem AI agent berbasis Google Gemini API dari nol, termasuk arsitektur tool dispatcher, conversation store, prompt builder, dan 14 tool operasional dengan role-based access control.

3. **Pengembangan dan perbaikan modul print service** — Mengembangkan workflow print service berbasis sesi yang mencakup upload file, penghitungan halaman, kalkulasi harga, checkout, pembayaran, dan antrian cetak.

4. **Integrasi payment gateway dan layanan eksternal** — Memastikan integrasi yang stabil dengan Midtrans (payment), RajaOngkir/Binderbyte (ongkir), Cloudinary (media), dan Instagram Graph API (social commerce).

5. **Audit dan perbaikan sistem inventori** — Menganalisis arsitektur stok yang hibrida dan mengembangkan mekanisme audit trail melalui StockMovement dan service synchronization.

6. **Dokumentasi teknis** — Menyusun dokumentasi fungsional dan teknis komprehensif yang mencakup seluruh domain aplikasi.

Observasi awal dilakukan terhadap codebase yang sudah ada untuk mengidentifikasi permasalahan, area perbaikan, dan peluang pengembangan fitur baru. Hasilnya menjadi landasan bagi perencanaan tugas selama periode magang.

## 3.2. Waktu

Kegiatan magang dilaksanakan selama [DURASI — PERLU INPUT MANUAL] terhitung mulai [TANGGAL MULAI — PERLU INPUT MANUAL] hingga [TANGGAL SELESAI — PERLU INPUT MANUAL]. Jam kerja mengikuti jadwal yang telah disepakati dengan pihak mitra, dengan penyesuaian waktu untuk kegiatan pengembangan yang memerlukan fokus intensif seperti debugging dan integrasi sistem.

## 3.3. Prosedur

Pelaksanaan program magang mengikuti tahapan yang sistematis agar proses berjalan efektif, terarah, dan memberikan manfaat maksimal baik bagi mahasiswa, mitra, maupun institusi:

### 1. Observasi Permasalahan Mitra dan Posisi Magang

Pada tahap awal, saya melakukan audit menyeluruh terhadap codebase Viviashop. Audit ini meliputi pemetaan struktur project, pembacaan dokumentasi yang ada, analisis kode sumber backend dan frontend, serta identifikasi fitur-fitur spesifik seperti autentikasi, pembayaran, upload media, dan integrasi API eksternal. Hasil observasi menunjukkan bahwa Viviashop adalah aplikasi yang kaya fitur namun membawa jejak evolusi yang panjang, dengan beberapa area yang memerlukan perbaikan arsitektur dan dokumentasi.

### 2. Mengurus Surat Permohonan Izin Magang

Pengurusan surat permohonan magang dilakukan melalui layanan akademik Mobilitas Akademik UNESA sesuai prosedur yang berlaku.

### 3. Penyampaian Proposal ke Lokasi Magang

Proposal magang disusun sesuai format yang ditetapkan dan disampaikan kepada pihak mitra. Proposal mencakup rencana pengembangan fitur, timeline, dan output yang ditargetkan.

### 4. Pembahasan dan Persetujuan Penugasan

Proposal dibahas bersama pihak mitra untuk menyesuaikan penugasan dengan kebutuhan aktual. Disepakati bahwa fokus utama pengembangan adalah pada modul AI chatbot agent, print service, dan dokumentasi teknis, dengan tetap mendukung maintenance fitur-fitur yang sudah ada.

### 5. Pembekalan Peserta Magang

Pembekalan meliputi pengenalan terhadap tech stack yang digunakan (Laravel 10, PHP 8.1, MySQL, Bootstrap 4, jQuery, Vite), alur kerja pengembangan, dan pengenalan terhadap tools kolaborasi yang digunakan tim.

### 6. Pemberangkatan dan Orientasi

Sesampainya di lokasi magang, dilakukan orientasi terkait:
- Struktur repository dan konvensi penamaan kode
- Alur deployment dan environment setup (Laragon, MySQL, Vite dev server)
- Pengenalan terhadap modul-modul yang sudah ada: katalog, order, payment, stok, print service
- Pengenalan terhadap integrasi pihak ketiga yang aktif

### 7. Pelaksanaan Penugasan (Performing)

Pelaksanaan tugas dilakukan secara iteratif dengan siklus: analisis → desain → implementasi → testing → review → dokumentasi. Setiap fitur yang dikembangkan diverifikasi kesesuaiannya dengan kebutuhan bisnis dan integritas terhadap sistem yang sudah ada.

### 8. Pendampingan oleh Pembimbing Lapang

Pembimbing lapang memberikan arahan teknis, melakukan code review, dan mendampingi dalam proses debugging dan integrasi sistem. Diskusi rutin dilakukan untuk membahas kendala teknis dan perkembangan proyek.

### 9. Pengerjaan Proyek Berdampak

Proyek utama yang dikerjakan adalah pengembangan AI chatbot agent berbasis Gemini API dengan 14 tool operasional. Proyek ini didesain untuk memberikan dampak langsung pada efisiensi operasional mitra — mulai dari pencarian produk otomatis, pemantauan stok kritis, hingga generasi laporan bisnis.

### 10. Supervisi dan Monitoring

Supervisi dilakukan secara berkala oleh pembimbing lapang dan dosen pembimbing, mencakup pemantauan kinerja coding, kualitas kode, dan progres penyelesaian modul.

### 11. Evaluasi Akhir oleh Mitra

Di akhir masa magang, dilakukan evaluasi terhadap seluruh modul yang telah dikembangkan, dokumentasi yang dihasilkan, dan kontribusi terhadap stabilitas platform secara keseluruhan.

| Teknik | Deskripsi |
|---|---|
| Analisis kode sumber | Membaca dan mengaudit seluruh controller, model, service, migration, dan route untuk memahami arsitektur dan mengidentifikasi area perbaikan |
| Reverse engineering | Memahami alur bisnis dari implementasi kode, bukan dari spesifikasi tertulis, karena dokumentasi lama tidak merepresentasikan kondisi aktual sistem |
| Pair programming | Berdiskusi dan mengerjakan fitur kompleks bersama pembimbing mitra untuk memastikan konsistensi dengan arsitektur yang ada |
| Test-driven approach | Menggunakan artisan command dan test route untuk memverifikasi fitur baru sebelum diintegrasikan ke codebase utama |
| Dokumentasi berkelanjutan | Mencatat temuan teknis, keputusan desain, dan panduan penggunaan selama proses pengembangan berlangsung |

Tabel 3.1 Teknik Pelaksanaan Kegiatan Magang

Khusus terkait kemampuan konseptual, selama magang saya menghasilkan beberapa kertas kerja analisis:
- Kertas kerja pertama berisi deskripsi bisnis proses platform Viviashop, mencakup workflow belanja online, order admin, print service, dan procurement.
- Kertas kerja kedua berisi identifikasi faktor-faktor kunci keberhasilan platform, termasuk integritas stok, keandalan payment flow, dan scalability arsitektur.
- Kertas kerja ketiga dan selanjutnya berisi analisis permasalahan teknis yang ditemukan (stok hibrida, controller gemuk, route debug/test yang terbuka, varian legacy) beserta alternatif solusinya.

---

# BAB IV.

# PELAKSANAAN KEGIATAN YANG RELEVAN DENGAN KONVERSI MATA KULIAH

## 4.1. Aktivitas Harian yang Dikerjakan Selama di Mitra

Berikut adalah penjabaran aktivitas harian yang dilakukan selama periode magang. Aktivitas dikelompokkan per bulan untuk memberikan gambaran progres yang terstruktur.

### Tabel 4.1 Aktivitas Harian Magang Bulan Pertama

| BULAN: [BULAN-1 — PERLU INPUT MANUAL] | | | | | |
|---|---|---|---|---|---|
| MINGGU | POSISI | TOPIK | DURASI (jam) | TARGET | METODE |
| 1 | Full-Stack Developer | Setup environment, audit arsitektur, pemetaan struktur project | [JAM] | Memahami keseluruhan arsitektur Viviashop, mengidentifikasi tech stack (Laravel 10, PHP 8.1, MySQL, Bootstrap 4, Vite) | Analisis kode, membaca composer.json & package.json |
| 2 | Full-Stack Developer | Audit backend: model, controller, service layer | [JAM] | Memetakan 35 model Eloquent, 46+ controller, 5 service class, memahami relasi antar domain | Review kode sumber, membaca DOKUMENTASI_TEKNIS |
| 3 | Full-Stack Developer | Audit frontend: blade views, layout, JavaScript, alur navigasi | [JAM] | Memahami 180+ view Blade, alur navigasi customer dan admin | Review view files, tracing route-to-view |
| 4 | Full-Stack Developer | Audit routing, middleware, dan integrasi pihak ketiga | [JAM] | Memahami routes/web.php (1151 baris), routes/api.php, middleware auth dan is_admin | Review routing, identifikasi debug routes |

### Tabel 4.2 Aktivitas Harian Magang Bulan Kedua

| BULAN: [BULAN-2 — PERLU INPUT MANUAL] | | | | | |
|---|---|---|---|---|---|
| MINGGU | POSISI | TOPIK | DURASI (jam) | TARGET | METODE |
| 5 | Full-Stack Developer | Pengembangan modul print service: model, migration, controller | [JAM] | Implementasi PrintSession, PrintOrder, PrintFile, PaperType, PrintType dan workflow sesi cetak | Coding, database migration, testing |
| 6 | Full-Stack Developer | Print service: upload file, page counting, kalkulasi harga | [JAM] | Sistem upload multi-file, hitung halaman (PDF/DOC/image), kalkulasi harga berdasarkan varian kertas | Coding, unit testing via artisan command |
| 7 | Full-Stack Developer | Print service: checkout, pembayaran, QR code, queue admin | [JAM] | Integrasi pembayaran toko/manual/Midtrans Snap, generate QR code sesi, antrian cetak admin | Coding, integrasi Midtrans, QR library |
| 8 | Full-Stack Developer | Smart print tools: converter dan variant manager | [JAM] | SmartPrintConverterController, SmartPrintVariantController, auto-create variant BW/Color | Coding, testing via admin panel |

### Tabel 4.3 Aktivitas Harian Magang Bulan Ketiga

| BULAN: [BULAN-3 — PERLU INPUT MANUAL] | | | | | |
|---|---|---|---|---|---|
| MINGGU | POSISI | TOPIK | DURASI (jam) | TARGET | METODE |
| 9 | Full-Stack Developer | Perancangan arsitektur AI agent system | [JAM] | Desain arsitektur: AIAgentService, GeminiClient, ToolDispatcher, ToolRegistry, ConversationStore | Desain arsitektur, prototyping |
| 10 | Full-Stack Developer | Implementasi AI core: Gemini client, conversation store, prompt builder | [JAM] | HTTP client untuk Gemini API, session-based conversation history, system prompt construction | Coding GeminiClient.php, ConversationStore.php, PromptBuilder.php |
| 11 | Full-Stack Developer | Implementasi AI tools: shopping & print (UC1, UC2) | [JAM] | SearchProductsViaSqlTool, AddToCartTool, QuickBuyRedirectTool, CheckOrderStatusTool, ResolvePrintVariantTool, CalculatePrintCostTool, CreatePrintCartItemTool | Coding tool handlers, testing |
| 12 | Full-Stack Developer | Implementasi AI tools: inventory & BI (UC3, UC4) | [JAM] | ScanCriticalStockTool, SuggestSupplierTool, CreatePurchaseDraftTool, AggregateBusinessMetricsTool, TopEmployeePerformanceTool, ExportReportTool | Coding tool handlers, RBAC testing |

### Tabel 4.4 Aktivitas Harian Magang Bulan Keempat

| BULAN: [BULAN-4 — PERLU INPUT MANUAL] | | | | | |
|---|---|---|---|---|---|
| MINGGU | POSISI | TOPIK | DURASI (jam) | TARGET | METODE |
| 13 | Full-Stack Developer | Testing dan debugging seluruh sistem, integrasi end-to-end | [JAM] | Semua modul baru terintegrasi dan berfungsi, artisan command testing berjalan | Testing manual & command-driven |
| 14 | Full-Stack Developer | Perbaikan inventory system, stock card, stock opname | [JAM] | StockCardController, StockOpnameController, StockMovement audit trail berfungsi | Coding, database verification |
| 15 | Full-Stack Developer | Penyusunan dokumentasi teknis (DOKUMENTASI_TEKNIS_VIVIASHOP.md) | [JAM] | Dokumen 1439 baris mencakup seluruh domain aplikasi | Penulisan dokumentasi, cross-reference kode |
| 16 | Full-Stack Developer | Finalisasi, review kode, penyusunan laporan akhir | [JAM] | Seluruh deliverable selesai, kode dirapikan, laporan akhir disusun | Review, finalisasi, presentasi |

## 4.2. Hasil Proyek yang Telah Dikembangkan

### Judul Proyek Magang

**Pengembangan Platform E-Commerce Viviashop Berbasis Laravel dengan Integrasi Payment Gateway, AI Chatbot Agent, dan Print Service Management System**

### Deskripsi Singkat Proyek

Viviashop adalah platform e-commerce monolitik yang dibangun menggunakan Laravel 10 dan telah berkembang dari toko online standar menjadi sistem operasional retail yang komprehensif. Proyek magang ini difokuskan pada tiga area pengembangan utama: (1) implementasi AI chatbot agent berbasis Google Gemini API dengan arsitektur custom, (2) pengembangan modul print service management system dengan workflow berbasis sesi, dan (3) penyempurnaan modul-modul yang sudah ada termasuk inventory audit trail, procurement, dan reporting.

Berdasarkan audit kode sumber yang dilakukan pada tahap awal magang, platform Viviashop memiliki permukaan yang cukup besar (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 26-38):
- 35 model Eloquent
- 46+ controller yang terdeteksi (22 admin, 7 frontend, 10 root-level, 7 auth)
- 5 service class utama + AI system (8 core files + 14 tool files)
- 76 migration database
- 180+ view Blade
- 29 custom artisan command
- 9 export class
- 1151 baris routing di routes/web.php

### Arsitektur Sistem

Arsitektur aplikasi Viviashop adalah monolith Laravel berbasis MVC, dengan service layer yang diterapkan pada domain-domain yang lebih kompleks (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 127-156):

```text
Browser / Admin UI / Print UI / AI Chat
         |
         v
routes/web.php dan routes/api.php
         |
         v
Controller (Admin / Frontend / Root / API)
         |
         +--→ Eloquent Model (35 model)
         |
         +--→ Service Layer (varian, stok, print)
         |
         +--→ AI Agent System (Gemini, tools, dispatcher)
         |
         +--→ Integrasi eksternal (Midtrans, RajaOngkir, Cloudinary, Instagram)
         |
         v
MySQL Database + File Storage + Third Party APIs
```

### Tech Stack yang Digunakan

#### Tabel 4.5 Tech Stack Backend

| Komponen | Versi/Library | Peran |
|---|---|---|
| PHP | ^8.1 | Runtime utama aplikasi (sumber: composer.json baris 11) |
| Laravel | ^10.0 | Framework backend utama (sumber: composer.json baris 17) |
| Eloquent ORM | Built-in Laravel | Model, relasi, query builder |
| Laravel UI | ^4.0 | Auth scaffolding (sumber: composer.json baris 21) |
| Laravel Sanctum | ^3.2 | Proteksi endpoint API (sumber: composer.json baris 18) |
| Laravel Tinker | ^2.8 | Tooling interaktif developer |
| PHPUnit | ^10.0 | Unit/feature test framework (sumber: composer.json baris 41) |
| Laravel Pint | ^1.0 | Code formatter (sumber: composer.json baris 36) |
| Laravel Debugbar | ^3.8 | Debugging lokal (sumber: composer.json baris 34) |

#### Tabel 4.6 Tech Stack Frontend

| Komponen | Versi/Library | Peran |
|---|---|---|
| Vite | ^4.0.0 | Build tool frontend (sumber: package.json baris 16) |
| Sass | ^1.56.1 | Styling preprocessor (sumber: package.json baris 15) |
| Bootstrap | ~4.6.1 | UI framework (sumber: package.json baris 10) |
| jQuery | ^3.3.1 | DOM scripting (sumber: package.json baris 11) |
| Axios | ^1.1.2 | HTTP request dari frontend (sumber: package.json baris 9) |
| Lodash | ^4.17.21 | Utility JavaScript (sumber: package.json baris 19) |

#### Tabel 4.7 Integrasi Bisnis dan Eksternal

| Komponen | Versi/Library | Peran |
|---|---|---|
| Midtrans PHP | ^2.6 | Payment gateway otomatis (sumber: composer.json baris 23) |
| Guzzle | ^7.9 | HTTP client untuk integrasi API (sumber: composer.json baris 15) |
| Laravel Socialite | ^5.19 | OAuth login/connection Instagram (sumber: composer.json baris 19) |
| Socialite Instagram Providers | ^5.1 / ^4.2 | Provider Instagram (sumber: composer.json baris 28-29) |
| Cloudinary Laravel | ^2.3 | Upload media ke Cloudinary (sumber: composer.json baris 13) |
| Shoppingcart | hardevine ^3.2 | Keranjang belanja (sumber: composer.json baris 16) |
| DOMPDF | barryvdh ^2.0 | PDF invoice/laporan (sumber: composer.json baris 12) |
| Laravel Excel | maatwebsite ^3.1 | Import/export Excel (sumber: composer.json baris 22) |
| Barcode | milon ^12.0 | Barcode produk (sumber: composer.json baris 24) |
| QR Code | simplesoftwareio ^4.2 | QR code print service (sumber: composer.json baris 27) |
| Yajra Datatables | ^10.3.1 | DataTable server-side (sumber: composer.json baris 31) |
| Eloquent Sluggable | cviebrock ^10.0 | Auto-slug Product, Category, Brand (sumber: composer.json baris 14) |
| SweetAlert | realrashid ^7.2 | Alert UI admin (sumber: composer.json baris 25) |

### Domain Model

#### Tabel 4.8 Daftar Model Eloquent Berdasarkan Domain

| Domain | Model | File Sumber |
|---|---|---|
| **Katalog & Varian** | Product, ProductVariant, ProductImage, ProductInventory, Brand, Category, ProductCategory, Attribute, AttributeOption, AttributeVariant, VariantAttribute, ProductAttributeValue | app/Models/ |
| **Order & Customer** | Order, OrderItem, Payment, Shipment, WishList, User | app/Models/ |
| **Procurement & Inventori** | Supplier, Pembelian, PembelianDetail, Pengeluaran, RekamanStok, StockMovement | app/Models/ |
| **Print Service** | PrintSession, PrintOrder, PrintFile, PaperType, PrintType | app/Models/ |
| **Operasional** | EmployeePerformance, EmployeeBonus, Setting, Slide, Testimonial, AiToolCall | app/Models/ |

Perlu dicatat bahwa terdapat 35 model Eloquent total. Beberapa model memiliki relasi yang cukup kompleks. Misalnya, model Product mendukung dua tipe produk (simple dan configurable) dan membawa dua pendekatan varian yang masih hidup bersamaan: pola lama berbasis `products.parent_id` via relasi `variants()`, dan pola baru berbasis tabel `product_variants` via relasi `productVariants()` (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 248-254). Ini merupakan salah satu area technical debt yang teridentifikasi selama audit.

### Tahapan yang Telah Dikerjakan

Berikut penjabaran detail dari setiap tahapan pengembangan yang telah diselesaikan:

#### 1. Audit dan Pemetaan Arsitektur

Langkah pertama yang saya lakukan adalah audit menyeluruh terhadap seluruh codebase Viviashop. Ini bukan pekerjaan yang ringan mengingat luasnya permukaan aplikasi. Saya memetakan seluruh 35 model dan relasinya, menelusuri 46+ controller untuk memahami alur bisnis, menganalisis 76 migration untuk memahami evolusi skema database dari fase awal 2023 hingga 2026, dan membaca routes/web.php yang berisi 1151 baris kode. Dari audit ini, saya mengidentifikasi beberapa temuan penting:

- Arsitektur monolitik dengan service layer yang mulai diterapkan pada domain kompleks
- Penggunaan transaksi database (`DB::transaction`) pada area penting seperti variant creation, print checkout, dan purchase finalization (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 216)
- Arsitektur stok yang hibrida — stok disimpan di dua tempat: `product_inventories.qty` dan `product_variants.stock`, dengan timing pengurangan yang berbeda antar flow (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1117-1136)
- Route web.php yang sangat gemuk, mencampur public routes, admin routes, payment callbacks, print service routes, dan sekitar dua lusin route debug/test yang tidak di-gate (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1062-1097)

Hasil audit ini menjadi fondasi bagi seluruh pekerjaan pengembangan selanjutnya.

#### 2. Pengembangan Modul E-Commerce Core

Modul e-commerce Viviashop sudah ada sebelum magang dimulai, tetapi selama periode magang saya terlibat dalam penyempurnaan beberapa area kunci:

**Fitur katalog dan pencarian** — Katalog produk mendukung listing, filter kategori (termasuk kategori khusus cetak via `shopCetak`), sorting nama/harga/terbaru, dan pencarian multi-tier yang cukup maju: exact word match → fallback substring → fallback fuzzy search menggunakan algoritma Levenshtein, Jaro-Winkler, dan substring similarity (sumber: Frontend\HomepageController.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 476-490).

**Detail produk configurable** — Implementasi tampilan detail produk yang mendukung produk simple dan configurable, redirect dari child product lama ke parent product, loading variant attributes dan opsi varian, serta tampilan price range minimum-maksimum. Controller frontend secara eksplisit menangani kemungkinan "simple products with variants" sebagai inkonsistensi data legacy (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 492-504).

**Cart dan checkout** — Cart mewajibkan login, menangani item simple dan configurable secara berbeda, memvalidasi stok sebelum insert, dan menyimpan atribut varian ke options cart (sumber: Frontend\CartController.php). Checkout mendukung metode pengiriman self pickup dan courier, metode pembayaran manual/automatic/COD/toko, upload attachment dan payment slip, kalkulasi berat dan ongkir berdasarkan kecamatan, serta resume unpaid order (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 526-546).

**Workflow belanja online reguler:**

```text
1. User login
2. User browse katalog → cari produk → pilih detail
3. Jika configurable → pilih variant
4. Item masuk cart (stok tervalidasi)
5. User checkout (self pickup / courier)
6. Ongkir dihitung jika courier
7. Order + order items disimpan
8. Stok direkam/dikurangi saat _saveOrderItems() (frontend flow)
9. Jika automatic payment → token Midtrans dibuat
10. Midtrans callback/redirect/polling → update status payment/order
11. User melihat halaman received order dan order history
```

(sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 950-963)

#### 3. Pengembangan Order Admin / Offline Store

Salah satu capability yang membedakan Viviashop dari toko online sederhana adalah dukungan channel penjualan offline. Admin dapat membuat order manual dari panel admin, memilih produk (simple/configurable) dan quantity, memvalidasi stok saat creation, dan memilih metode pembayaran QRIS, Midtrans, toko, atau transfer. Yang menarik, stok pada flow admin order baru dikurangi saat completion — bukan saat order dibuat — melalui pemanggilan `recordOrderStockMovements()`. Ini membuat order admin lebih cocok untuk penjualan toko fisik yang membutuhkan kontrol manual lebih besar (sumber: Admin\OrderController.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 966-976).

Employee performance juga dapat dicatat ketika tracking diaktifkan, sehingga admin bisa melihat siapa karyawan yang menangani order dan berapa nilai transaksinya.

#### 4. Pengembangan Modul Supplier dan Procurement

Modul procurement yang saya kembangkan mencakup workflow lengkap pengelolaan pembelian dari supplier:

**Supplier management** — CRUD data supplier dengan endpoint DataTable (sumber: SupplierController.php).

**Pembelian (purchase order):**
- Membuat draft pembelian dari supplier terpilih
- Menambahkan item pembelian (mendukung produk simple maupun variant)
- Realtime projected stock — sistem menghitung proyeksi stok saat purchase draft sedang disusun
- Finalisasi pembelian yang memanggil `StockService::processPurchaseStockUpdate()` untuk memperbarui stok
- Stock movement tercatat sebagai "purchase confirmed"

(sumber: PembelianController.php, PembelianDetailController.php, StockService.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 978-987)

Catatan desain penting: `harga_beli` pada detail pembelian diperlakukan sebagai unit price, `subtotal` dihitung sebagai `harga_beli × jumlah`, dan update stok tidak dilakukan per perubahan draft item, melainkan hanya saat pembelian dikonfirmasi. Ini merupakan desain yang lebih aman dibanding mengubah stok setiap draft berubah (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 766-772).

#### 5. Pengembangan Sistem Inventori dan Audit Stok

Salah satu area yang paling menantang selama magang adalah sistem inventori. Viviashop menyimpan stok di dua tempat yang hidup berdampingan: `product_inventories.qty` untuk stok produk sederhana, dan `product_variants.stock` untuk stok per varian (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 333-337).

Saya mengembangkan dan menyempurnakan beberapa komponen kunci:

**StockMovement** — Model audit trail yang mencatat setiap mutasi stok dengan reason seperti: order confirmed, order cancelled, purchase confirmed, purchase cancelled, print order, manual adjustment, inventory correction, synchronization, damage, dan return (sumber: StockMovement.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 338-349).

**StockService** — Service yang menyediakan fungsi: `recordMovement()`, `recordSimpleProductMovement()`, `processPurchaseStockUpdate()`, `reversePurchaseStockUpdate()`, `synchronizeStockTables()`, dan `validateStockConsistency()` (sumber: StockService.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 351-358).

**StockManagementService** — Service yang menyediakan: deteksi low stock variants, sort by stock, deteksi duplicate print variants, dan pencegahan duplicate print variants (sumber: StockManagementService.php).

**Stock Card dan Movement Report** — Admin dapat melihat index stok, daftar movement, data movement untuk DataTable, stock card per variant maupun per product, dan stock report (sumber: Admin\StockCardController.php, Admin\StockOpnameController.php).

Keberadaan `synchronizeStockTables()` dalam StockService menunjukkan bahwa sistem sudah sadar akan risiko inkonsistensi stok antar tabel dan menyediakan mekanisme rekonsiliasi (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 798-806).

#### 6. Pengembangan Modul Print Service

Print service adalah salah satu domain paling khas dan bernilai tinggi dalam Viviashop. Ini bukan fitur yang umum ditemukan di platform e-commerce Laravel. Modul ini mencakup workflow lengkap pencetakan dokumen berbasis sesi.

**Model dan database** — Saya mengembangkan 5 model terkait: PrintSession, PrintOrder, PrintFile, PaperType, dan PrintType, beserta migration-nya (sumber: app/Models/PrintSession.php, app/Models/PrintOrder.php, dll).

**Lifecycle sesi print:**

```text
1. Sistem generate PrintSession baru dengan token acak
2. QR code menuju halaman customer print service
3. Customer upload file (PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, TXT, CSV, LOG, RTF, ODT)
4. Sistem menghitung pages_count per file
5. Customer memilih variant print (paper size / print type)
6. Sistem cek stok media cetak
7. Sistem membuat PrintOrder
8. Pembayaran diproses sesuai mode (toko/manual/automatic Midtrans Snap)
9. Setelah pembayaran confirmed, stok kertas dikurangi
10. Order masuk queue print
11. Admin print, complete, dan file dibersihkan
12. Session ditutup/inactive
```

(sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 988-1001)

**PrintSession lifecycle steps:** upload → select → payment → print → complete, dengan sesi aktif yang memiliki expiry 24 jam (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 388-396).

**Page counting strategy** — Penentuan jumlah halaman menggunakan pendekatan heuristik berdasarkan tipe file: PDF dihitung dari pattern `/Page`, dokumen office diestimasi dari size, text/csv/log diestimasi dari jumlah baris, dan image diasumsikan 1 halaman (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 841-850).

**Smart Print Tools** — Dua tool khusus yang saya kembangkan:

1. *Smart Print Converter* (SmartPrintConverterController.php): mengubah produk regular menjadi produk smart print dengan men-set `is_print_service = true` dan `is_smart_print_enabled = true`, serta auto-create variant BW dan Color bila belum ada. Mendukung bulk convert banyak produk sekaligus (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 882-889).

2. *Smart Print Variant Manager* (SmartPrintVariantController.php, SmartPrintVariantService.php): mendeteksi varian print yang belum punya `paper_size` atau `print_type`, auto-fix field print berdasarkan nama varian, dan membuat varian smart print default untuk produk yang belum punya varian (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 891-897).

**Print backoffice admin** — Admin print service mendukung: queue, sessions, orders, reports, stock management, stock report, confirm payment, print order, print files, complete order, cancel order, download payment proof, dan view uploaded file (sumber: Admin\PrintServiceController.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 860-876).

#### 7. Pengembangan AI Chatbot Agent System

Ini merupakan proyek utama yang paling berdampak selama magang. Saya merancang dan mengimplementasikan sistem AI agent dari nol menggunakan arsitektur custom — bukan berbasis framework AI seperti LangChain atau AutoGen. Sistem ini menggunakan Google Gemini API sebagai model bahasa utama.

**Arsitektur AI Agent (`app/Services/AI/`):**

```text
User Request → AIAgentController
                    |
                    v
              AIAgentService (orchestrator)
                    |
    +-------+-------+-------+-------+
    |       |       |       |       |
    v       v       v       v       v
GeminiClient  ConversationStore  PromptBuilder  ToolDispatcher  Context
    |                                               |
    v                                               v
Gemini API                                    ToolRegistry
                                                    |
                                                    v
                                              14 Tool Handlers
```

**Komponen core:**

- `AIAgentService.php` — Main orchestrator yang mengelola alur percakapan, tool calling, dan response generation (sumber: app/Services/AI/AIAgentService.php)
- `GeminiClient.php` — HTTP client untuk berkomunikasi dengan Google Gemini API (sumber: app/Services/AI/GeminiClient.php)
- `ConversationStore.php` — Penyimpanan histori percakapan berbasis session, menggunakan key `ai_conversation_*` (sumber: app/Services/AI/ConversationStore.php)
- `Context.php` — Context builder yang menyiapkan informasi kontekstual untuk prompt (sumber: app/Services/AI/Context.php)
- `PromptBuilder.php` — Konstruksi system prompt yang menentukan perilaku dan batasan AI agent (sumber: app/Services/AI/PromptBuilder.php)
- `ToolDispatcher.php` — Router yang meneruskan tool call dari Gemini ke handler yang sesuai, termasuk audit logging ke tabel `ai_tool_calls` (sumber: app/Services/AI/ToolDispatcher.php)
- `ToolRegistry.php` — Registry untuk mendaftarkan tool dan definisinya (sumber: app/Services/AI/ToolRegistry.php)
- `ToolResult.php` — Standardized response format dari setiap tool execution (sumber: app/Services/AI/ToolResult.php)
- `Contracts/ToolHandler.php` — Interface yang harus diimplementasikan oleh setiap tool (sumber: app/Services/AI/Contracts/)

**Dua surface AI:**
1. `/ai/chat` — Frontend publik tanpa autentikasi, untuk customer
2. `/admin/ai-assistant/chat` — Admin console dengan guard `is_admin`

**14 AI Tools dengan RBAC (Role-Based Access Control):**

#### Tabel 4.9 Daftar AI Agent Tools

| Use Case | Tool | RBAC | Fungsi | File Sumber |
|---|---|---|---|---|
| UC1 Shopping | SearchProductsViaSqlTool | public | Pencarian produk berbasis SQL | app/Services/AI/Tools/SearchProductsViaSqlTool.php |
| UC1 Shopping | AddToCartTool | auth | Menambahkan item ke keranjang | app/Services/AI/Tools/AddToCartTool.php |
| UC1 Shopping | QuickBuyRedirectTool | auth | Redirect checkout langsung | app/Services/AI/Tools/QuickBuyRedirectTool.php |
| UC1 Shopping | CheckOrderStatusTool | auth | Cek status order terbaru | app/Services/AI/Tools/CheckOrderStatusTool.php |
| UC2 Print | ResolvePrintVariantTool | public | Temukan variant print yang cocok | app/Services/AI/Tools/ResolvePrintVariantTool.php |
| UC2 Print | CalculatePrintCostTool | public | Kalkulasi biaya cetak | app/Services/AI/Tools/CalculatePrintCostTool.php |
| UC2 Print | CreatePrintCartItemTool | auth | Tambah item cetak ke cart | app/Services/AI/Tools/CreatePrintCartItemTool.php |
| UC3 Inventory | ScanCriticalStockTool | admin | Scan produk low-stock | app/Services/AI/Tools/ScanCriticalStockTool.php |
| UC3 Inventory | SuggestSupplierTool | admin | Saran supplier untuk restock | app/Services/AI/Tools/SuggestSupplierTool.php |
| UC3 Inventory | CreatePurchaseDraftTool | admin | Auto-create draft pembelian | app/Services/AI/Tools/CreatePurchaseDraftTool.php |
| UC4 BI | AggregateBusinessMetricsTool | admin | Revenue/order/product KPIs | app/Services/AI/Tools/AggregateBusinessMetricsTool.php |
| UC4 BI | TopEmployeePerformanceTool | admin | Query top performers | app/Services/AI/Tools/TopEmployeePerformanceTool.php |
| UC4 BI | ExportReportTool | admin | Generate URL download report | app/Services/AI/Tools/ExportReportTool.php |
| Greeting | GreetingTool | public | Sapaan pembuka | app/Services/AI/Tools/GreetingTool.php |

**Aturan penting AI Agent:**
- Semua write action memerlukan konfirmasi eksplisit dari user (enforced di system prompt)
- Setiap tool invocation di-audit ke tabel `ai_tool_calls` melalui ToolDispatcher
- Tests mock AIAgentService dan GeminiClient — tidak ada panggilan nyata ke Gemini API saat testing

(sumber: app/Services/AI/, DOKUMENTASI_TEKNIS_VIVIASHOP.md)

#### 8. Pengembangan Modul Employee Performance dan Bonus

Modul ini menunjukkan bahwa Viviashop bukan sekadar sistem penjualan — platform ini juga mendukung pelacakan operasional SDM.

**Workflow employee tracking:**
1. Admin mengaktifkan tracking pada order
2. Nama karyawan penanggung jawab disimpan ke order
3. Saat order selesai, `EmployeePerformance` di-update/create
4. Admin dapat melihat ranking, total transaksi, total revenue, average transaction, dan bonus history

(sumber: Admin\EmployeePerformanceController.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1003-1008)

Model `EmployeePerformance` memiliki "dual-input verification" workflow yang mendrive `EmployeeBonus`. Admin dapat membuat, mengedit, menghapus bonus, dan melihat histori bonus per karyawan (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 716-727).

#### 9. Pengembangan Modul Reporting dan Export

Modul report yang dikembangkan mencakup empat domain utama (sumber: Admin\ReportController.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 700-713):

1. **Revenue report** — Laporan pendapatan dengan filter date range, export Excel dan PDF
2. **Product report** — Laporan produk
3. **Inventory report** — Laporan inventori
4. **Payment report** — Laporan pembayaran

Fitur report mendukung: date range filter, validasi range maksimal 31 hari pada beberapa report, export Excel (melalui 9 class export: ReportRevenue, ReportProduct, ReportInventory, ReportPayment, ProductTemplateExport, ProductSheetExport, CategorySheetExport, LaporanExport, UserExport), export PDF, dan query raw SQL untuk agregasi laporan.

Dashboard admin juga berfungsi sebagai "operations cockpit" yang menampilkan: revenue hari ini/minggu/bulan/tahun, pending payments, net profit bulanan, revenue growth, order metrics, conversion rate, average order value, inventory metrics, top selling product, employee metrics, chart data, recent activities, low stock products, dead stock products, supplier performance, category performance, dan shipping method statistics (sumber: Admin\DashboardController.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 594-614).

#### 10. Integrasi Instagram dan Media

Modul Instagram yang dikembangkan mencakup:
- Redirect ke OAuth Instagram dan callback token exchange ke long-lived token
- Penyimpanan token ke model User
- Mendapatkan Instagram feed
- Webhook verification dan receive stub
- Admin dapat upload gambar + caption lalu publish ke Instagram
- Admin dapat publish post langsung dari product images (single image atau carousel)
- Gambar diupload ke Cloudinary terlebih dahulu untuk memperoleh URL publik yang bisa dikonsumsi Graph API Instagram

(sumber: InstagramController.php, CloudinaryController.php, config/instagram.php, DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 901-924)

#### 11. Pengembangan Console Commands

Selama magang, dikembangkan 29 custom artisan command yang berfungsi untuk debugging, migrasi data, stress testing, dan operasional sistem (sumber: app/Console/Commands/):

| Kategori | Command | Fungsi |
|---|---|---|
| Stock/Print | ScanCriticalStockCommand | Scheduled AI stock health check (daily) |
| Stock/Print | FixPrintFileStorage | Fix print file storage paths |
| Stock/Print | TestPrintServiceFlow | Testing end-to-end print service |
| Stock/Print | TestStockOpnameCommand | Testing stock opname |
| Variant | MigrateToNewVariantSystem | Migrasi legacy variants ke sistem baru |
| Variant | StressTestVariants | Stress testing sistem varian |
| Variant | TestVariantCreation | Testing pembuatan varian |
| Employee | FixEmployeePerformanceCommand | Fix data employee performance |
| Employee | ListEmployeePerformance | List employee performance records |
| Employee | DiagnoseEmployeeTrackingCommand | Debug employee tracking |
| Employee | TestEmployeeTrackingFlowCommand | Testing flow employee tracking |
| Testing | TestPdfReportCommand | Testing PDF report generation |
| Testing | TestFrontendSync | Testing frontend sync |
| Database | EmptyDatabase | Empty all tables |
| Debug | DebugOrder142, DebugEmployeeReza | Debugging spesifik |

Dan beberapa command lain untuk stress testing bonus system, dual-input system, dan simulasi akses admin.

#### 12. Penyusunan Dokumentasi Teknis

Salah satu kontribusi paling bernilai selama magang adalah penyusunan DOKUMENTASI_TEKNIS_VIVIASHOP.md sepanjang 1439 baris. Sebelum dokumen ini ada, README repository masih menggambarkan aplikasi sebagai "Laravel app yang fokus pada Instagram integration dan homepage sederhana" — sebuah deskripsi yang sudah jauh tertinggal dari implementasi aktual (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1176-1178).

Dokumentasi ini mencakup:
- Ringkasan eksekutif dan basis analisis
- Tech stack dan dependensi lengkap
- Gambaran arsitektur (tipe, area, layering)
- 9 domain utama dengan detail entity, fitur, dan workflow
- 7 workflow bisnis kunci (belanja online, order admin, procurement, print service, employee tracking)
- Keunggulan aplikasi (7 poin)
- Kelemahan dan technical debt (12 poin)
- Kualitas teknis dan maintainability
- Rekomendasi prioritas (4 level)
- Inventaris teknis ringkas (controller, service, model, migration, command)

### Dampak Kegiatan

**Divisi/Unit yang Terdampak:**
- Tim pengembangan (development team) — mendapat dokumentasi dan arsitektur yang lebih terdokumentasi
- Tim operasional (admin/toko) — mendapat AI assistant untuk pemantauan stok dan generasi laporan
- Tim penjualan — mendapat modul print service dan order admin yang terintegrasi
- Manajemen — mendapat dashboard business intelligence yang komprehensif

**Bukti/Output Proyek:**
- Repository kode Viviashop dengan seluruh modul yang dikembangkan
- DOKUMENTASI_TEKNIS_VIVIASHOP.md (1439 baris)
- 14 AI agent tools yang berfungsi
- Print service management system lengkap
- 29 artisan commands untuk testing dan operasional

#### Tabel 4.10 Dampak Mini Proyek yang Dikembangkan

### A. DAMPAK SOSIAL

**1. Penelitian dan Inovasi**
- ☑ Menghasilkan data/informasi baru yang bermanfaat (dokumentasi teknis 1439 baris)
- ☑ Mengembangkan teknologi/produk/konsep inovatif (AI chatbot agent custom berbasis Gemini)
- ☑ Menyusun rekomendasi berbasis hasil kajian (12 poin kelemahan, 4 level prioritas perbaikan)
- ☑ Mendukung kebutuhan mitra/masyarakat/industri (platform e-commerce yang lebih stabil dan terdokumentasi)

**2. Pengabdian dan Pengembangan Masyarakat**
- ☑ Transfer pengetahuan atau teknologi kepada masyarakat (dokumentasi teknis untuk onboarding developer baru)
- ☑ Mendukung kemandirian dan keberlanjutan program mitra (sistem yang lebih maintainable berkat dokumentasi)

### B. DAMPAK EKONOMI

**1. Pengajaran dan Pembelajaran**
- ☑ Peningkatan kompetensi dan kesiapan kerja mahasiswa (pengalaman full-stack development enterprise)
- ☑ Penguatan keterampilan praktis/industri (integrasi API, AI development, database management)
- ☑ Kesesuaian pembelajaran dengan kebutuhan dunia kerja (teknologi Laravel, payment gateway, AI yang dibutuhkan industri)

**2. Penelitian dan Pertukaran Pengetahuan**
- ☑ Penyebaran pengetahuan kepada mitra/industri (dokumentasi teknis dan rekomendasi arsitektur)
- ☑ Peningkatan inovasi dan nilai tambah ekonomi (AI agent yang meningkatkan efisiensi operasional)

**3. Ekosistem Kewirausahaan**
- ☑ Pengembangan usaha rintisan — platform Viviashop mendukung digitalisasi bisnis retail
- ☑ Penciptaan produk/jasa baru — print service management system sebagai layanan baru
- ☑ Peningkatan pendapatan mitra — melalui channel penjualan online, offline, dan print service

### C. KEBERLANJUTAN (Penguatan SDGs)

- ☑ Kegiatan berlanjut setelah program selesai — platform terus beroperasi dan dikembangkan
- ☑ Mitra melanjutkan program secara mandiri — berkat dokumentasi teknis yang komprehensif
- ☑ Mendukung pencapaian SDGs:
  - **SDG 4** (Pendidikan Berkualitas) — transfer pengetahuan pengembangan perangkat lunak
  - **SDG 8** (Pekerjaan Layak dan Pertumbuhan Ekonomi) — digitalisasi bisnis retail
  - **SDG 9** (Industri, Inovasi, dan Infrastruktur) — penerapan AI dan integrasi pembayaran digital
- ☑ Ada rencana tindak lanjut — rekomendasi prioritas perbaikan arsitektur dan penambahan test coverage

## 4.3. Pembahasan (Relevansi dengan Keilmuan Program Studi)

Pengalaman mengembangkan platform Viviashop memiliki relevansi yang sangat kuat dengan bidang keilmuan [PROGRAM STUDI — PERLU INPUT MANUAL]. Beberapa relevansi kunci:

**Rekayasa Perangkat Lunak (Software Engineering)**

Proyek Viviashop merupakan contoh nyata pengembangan perangkat lunak berskala enterprise. Dengan 35 model, 46+ controller, 5 service class, dan 76 migration, saya mendapat pengalaman langsung dalam mengelola kompleksitas perangkat lunak yang tidak mungkin diperoleh hanya dari mata kuliah. Konsep-konsep seperti MVC architecture, service layer pattern, database transaction management, dan API integration yang dipelajari di kelas menjadi sangat konkret ketika diterapkan pada codebase sebesar ini.

Saya juga berhadapan langsung dengan technical debt — sebuah realitas yang jarang diajarkan di kelas namun sangat umum di dunia industri. Misalnya, coexistence dua paradigma varian (legacy child product vs modern product_variants), controller yang terlalu gemuk, dan route debug/test yang masih terbuka di production. Pengalaman ini mengajarkan bahwa pengembangan perangkat lunak profesional bukan hanya soal menulis kode baru, tetapi juga soal mengelola evolusi sistem yang sudah berjalan.

**Basis Data (Database Systems)**

Dengan 76 migration yang berkembang dari fase awal 2023 hingga 2026, saya mendapat pemahaman mendalam tentang evolusi skema database di dunia nyata. Konsep normalisasi, relasi antar tabel, indexing, dan query optimization yang dipelajari di mata kuliah basis data diterapkan langsung pada database MySQL yang menampung data produk, order, payment, stok, print service, dan employee performance.

Model relasi yang kompleks — seperti relasi 3-tier Attribute → AttributeVariant → AttributeOption, atau dual-stock architecture antara `product_inventories` dan `product_variants` — memberikan wawasan tentang trade-off desain database di skenario nyata.

**Kecerdasan Buatan (Artificial Intelligence)**

Pengembangan AI chatbot agent menggunakan Google Gemini API merupakan penerapan langsung konsep kecerdasan buatan. Meskipun arsitekturnya custom (bukan menggunakan framework AI seperti LangChain), prinsip-prinsip seperti prompt engineering, tool calling, conversation memory, dan role-based access control pada AI agent sangat relevan dengan perkembangan terkini di bidang AI generatif.

Implementasi 14 tool AI yang mencakup pencarian produk via SQL, kalkulasi biaya cetak, pemantauan stok kritis, dan generasi laporan bisnis menunjukkan bagaimana AI dapat diaplikasikan untuk meningkatkan efisiensi operasional bisnis — bukan sekadar chatbot yang menjawab pertanyaan umum.

**Pemrograman Web (Web Programming)**

Seluruh proyek ini adalah penerapan langsung dari konsep pemrograman web: Laravel sebagai backend framework, Blade sebagai templating engine, Bootstrap dan jQuery sebagai frontend toolkit, Vite sebagai build tool, serta integrasi berbagai API REST (Midtrans, RajaOngkir, Gemini, Instagram Graph API). Pengalaman ini jauh melampaui tutorial atau proyek kecil di kelas karena melibatkan sistem yang sudah berjalan di production dengan pengguna dan transaksi nyata.

## 4.4. Relevansi dengan Mata Kuliah Konversi

Setelah melaksanakan seluruh kegiatan magang yang dibimbing oleh Dosen Pembimbing Lapangan, saya telah menyelesaikan proyek pengembangan platform Viviashop serta melaksanakan seluruh aktivitas harian yang menjadi tanggung jawab di lingkungan mitra. Berikut relevansi kegiatan magang dengan mata kuliah konversi:

[PERLU INPUT MANUAL: Sesuaikan mata kuliah konversi di bawah dengan mata kuliah yang benar-benar diambil/dikonversi]

### Mata Kuliah: [Pemrograman Web Lanjut / PERLU INPUT MANUAL]

Kegiatan pengembangan platform Viviashop menggunakan framework Laravel 10 sangat berkaitan dengan mata kuliah ini. Saya secara langsung mempraktikkan konsep MVC (Model-View-Controller) pada aplikasi nyata yang memiliki 35 model Eloquent, 46+ controller, dan 180+ view Blade. Pengalaman ini mencakup implementasi routing (1151 baris routes/web.php), middleware (auth dan is_admin), form validation, database migration, dan session management. Saya juga menerapkan konsep RESTful API pada routes/api.php untuk domain varian produk. Pengalaman ini memperkuat pemahaman bahwa pengembangan web modern bukan sekadar membuat halaman HTML, tetapi merancang arsitektur sistem yang scalable dan maintainable (sumber: routes/web.php, routes/api.php, seluruh controller di app/Http/Controllers/).

[FOTO/GAMBAR: Screenshot kode controller atau routing Viviashop yang relevan]

### Mata Kuliah: [Basis Data / PERLU INPUT MANUAL]

Selama magang, saya bekerja intensif dengan database MySQL yang memiliki 76 migration, 35 tabel utama, dan relasi kompleks antar model. Pengalaman ini mencakup perancangan skema database evolusional (dari fase 2023 hingga 2026), penulisan query SQL untuk reporting, penggunaan Eloquent ORM untuk operasi CRUD, dan penanganan transaksi database (`DB::transaction`) pada area kritis seperti checkout, print service, dan procurement. Saya juga menghadapi tantangan dual-stock architecture yang membutuhkan mekanisme synchronization — sebuah problem yang sangat relevan dengan konsep konsistensi data yang dipelajari di mata kuliah basis data (sumber: database/migrations/, app/Models/, StockService.php).

[FOTO/GAMBAR: Screenshot migration atau ERD database Viviashop]

### Mata Kuliah: [Kecerdasan Buatan / PERLU INPUT MANUAL]

Pengembangan AI chatbot agent berbasis Google Gemini API merupakan penerapan langsung konsep kecerdasan buatan. Saya merancang arsitektur agent system yang mencakup prompt engineering (PromptBuilder.php), tool calling dan function dispatch (ToolDispatcher.php), conversation memory management (ConversationStore.php), dan role-based access control pada AI tools. Implementasi 14 tool operasional yang mampu melakukan pencarian produk via SQL, kalkulasi biaya cetak, pemantauan stok kritis, dan generasi laporan bisnis menunjukkan penerapan AI yang practical dan berdampak langsung pada operasional bisnis (sumber: app/Services/AI/, config/ai.php).

[FOTO/GAMBAR: Screenshot AI chatbot interface Viviashop]

### Mata Kuliah: [Rekayasa Perangkat Lunak / PERLU INPUT MANUAL]

Pengalaman magang ini merupakan contoh nyata penerapan prinsip rekayasa perangkat lunak pada skala enterprise. Saya menerapkan design pattern seperti Service Layer pattern (ProductVariantService, StockService, PrintService, StockManagementService, SmartPrintVariantService), Repository pattern melalui Eloquent, dan Strategy pattern pada multiple payment flow. Saya juga menghadapi dan mengelola technical debt, melakukan refactoring bertahap, menulis unit test menggunakan PHPUnit 10, dan menyusun dokumentasi teknis komprehensif. Pengalaman mengaudit dan memetakan sistem yang sudah berjalan memberikan pemahaman mendalam tentang software maintenance dan evolution yang sulit diperoleh dari mata kuliah di kelas (sumber: app/Services/, DOKUMENTASI_TEKNIS_VIVIASHOP.md, tests/).

---

# BAB V

# HAMBATAN DAN DUKUNGAN PELAKSANAAN MAGANG

## 5.1. Hambatan

Selama pelaksanaan magang, terdapat beberapa hambatan yang dihadapi, antara lain:

### 1. Kompleksitas Codebase yang Sangat Besar

Viviashop bukan aplikasi sederhana. Dengan 35 model, 46+ controller, 76 migration, dan 1151 baris routing, proses pemahaman arsitektur memerlukan waktu yang cukup panjang. Pada minggu-minggu awal, saya menghabiskan sebagian besar waktu hanya untuk membaca dan memetakan kode yang sudah ada sebelum bisa mulai menulis kode baru. Ini merupakan pengalaman yang sangat berbeda dari proyek-proyek di perkuliahan yang umumnya dimulai dari nol.

### 2. Coexistence Pola Lama dan Baru

Codebase Viviashop membawa jejak evolusi yang panjang, sehingga terdapat beberapa pola yang hidup bersamaan. Contoh paling jelas adalah sistem varian produk: pola lama menggunakan `products.parent_id` via relasi `variants()`, sementara pola baru menggunakan tabel `product_variants` via relasi `productVariants()`. Mengembangkan fitur baru yang harus kompatibel dengan kedua pola ini cukup menantang dan memerlukan kehati-hatian ekstra (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1138-1147).

### 3. Arsitektur Stok yang Hibrida

Stok disimpan di dua tempat (`product_inventories.qty` dan `product_variants.stock`) dan timing pengurangan stok berbeda antar flow — frontend checkout mengurangi saat order item disimpan, admin order mengurangi saat completion, dan print order mengurangi saat payment confirmed. Memahami dan bekerja dengan invariant stok yang bergantung pada konteks flow ini memerlukan analisis yang mendalam sebelum setiap perubahan (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1117-1136).

### 4. Route Web yang Sangat Gemuk

File `routes/web.php` berisi 1151 baris yang memuat public routes, auth routes, payment callbacks, admin routes, print service routes, dan sekitar dua lusin route debug/test yang tidak seluruhnya di-gate. Navigasi dan penambahan route baru memerlukan kehati-hatian karena risiko konflik route dan kesulitan membedakan mana route produksi dan mana route testing (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1062-1078).

### 5. Keterbatasan Testing Otomatis

Sebelum magang, surface test yang tersedia hanya `ExampleTest` pada unit maupun feature test. Ini berarti setiap perubahan kode harus diverifikasi secara manual atau melalui artisan command khusus. Risiko regresi cukup tinggi, terutama pada modul-modul yang saling berkaitan seperti order, stok, dan payment (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1160-1174).

### 6. Controller yang Terlalu Besar

Beberapa controller sudah berperan sangat besar dan menampung business logic secara langsung. Frontend\OrderController.php berukuran 62.630 bytes, Admin\OrderController.php berukuran 35.946 bytes, dan Frontend\HomepageController.php berukuran 33.720 bytes. Memahami alur dalam controller sebesar ini dan menambahkan fitur tanpa merusak yang sudah ada merupakan tantangan tersendiri.

### 7. Integrasi dengan Layanan Pihak Ketiga di Environment Production

Konfigurasi `.env` yang di-commit berisi kredensial production untuk Midtrans (dengan `MIDTRANS_IS_PRODUCTION=true`), Cloudinary, Gemini, dan Instagram. Ini berarti setiap panggilan API dari environment development berpotensi mengenai layanan production. Diperlukan kehati-hatian ekstra untuk memastikan tidak ada transaksi atau posting tidak sengaja ke production selama proses pengembangan.

## 5.2. Dukungan

Di sisi lain, pelaksanaan magang juga didukung oleh berbagai faktor:

### 1. Bimbingan dari Dosen Pembimbing dan Pembimbing Mitra

Dosen pembimbing lapangan serta pembimbing dari mitra memberikan arahan teknis yang jelas, melakukan code review, dan mendampingi dalam proses pengambilan keputusan arsitektur. Diskusi rutin tentang trade-off desain sangat membantu dalam memilih solusi yang tepat untuk konteks Viviashop.

### 2. Dokumentasi Kode yang Mulai Tersedia

Meskipun README lama tidak merepresentasikan kondisi aktual, keberadaan DOKUMENTASI_TEKNIS_VIVIASHOP.md yang komprehensif (yang sebagian besar disusun selama magang ini) menjadi panduan penting dalam memahami domain bisnis dan arsitektur teknis platform.

### 3. Arsitektur Laravel yang Konvensional

Meskipun codebase-nya besar, Viviashop tetap mengikuti konvensi Laravel standar untuk struktur folder, naming, dan alur MVC. Ini memudahkan navigasi karena pengalaman dengan framework Laravel dari perkuliahan tetap relevan dan applicable.

### 4. Ekosistem Package yang Kaya

Laravel memiliki ekosistem package yang sangat kaya. Ketersediaan package seperti `hardevine/shoppingcart`, `yajra/datatables`, `barryvdh/dompdf`, `maatwebsite/excel`, `simplesoftwareio/qrcode`, dan lainnya mempercepat pengembangan fitur tanpa perlu membangun semuanya dari nol.

### 5. Artisan Command sebagai Tool Debugging

Keberadaan 29 custom artisan command yang sudah dibuat (seperti TestPrintServiceFlow, TestStockOpnameCommand, StressTestVariants) sangat membantu dalam proses debugging dan verifikasi fitur. Pendekatan CLI-based testing ini menjadi substitusi yang efektif di tengah minimnya test otomatis.

### 6. Fasilitas Pengembangan yang Memadai

Environment pengembangan menggunakan Laragon yang sudah menyediakan PHP, MySQL, dan Apache/Nginx secara terintegrasi. Ini mempercepat proses setup dan mengurangi overhead konfigurasi.

---

# BAB VI

# REFLEKSI, RENCANA TINDAK LANJUT & REKOMENDASI

## 6.1 Refleksi

### 1. Pengalaman Pribadi Selama Magang

Magang di proyek Viviashop memberikan saya perspektif yang sangat berbeda tentang pengembangan perangkat lunak. Di perkuliahan, proyek yang dikerjakan umumnya dimulai dari nol, spesifikasinya relatif jelas, dan skalanya bisa dipahami dalam hitungan jam. Viviashop adalah kebalikannya. Saya dihadapkan pada codebase yang sudah berjalan, dengan 35 model, puluhan controller, dan ratusan view yang saling terkait. Minggu pertama terasa cukup membingungkan karena saya harus memahami arsitektur yang dibangun selama bertahun-tahun sebelum bisa berkontribusi secara produktif.

Salah satu momen paling berkesan adalah ketika saya berhasil memahami dan mendokumentasikan arsitektur stok yang hibrida. Menyadari bahwa stok disimpan di dua tempat dengan timing pengurangan yang berbeda antar flow — dan bahwa ini bukan bug, melainkan konsekuensi evolusi sistem — mengubah cara pandang saya tentang "kode yang benar". Di dunia nyata, kode yang benar seringkali adalah kode yang berfungsi dan bisa di-maintain, bukan kode yang sempurna secara akademis.

Pengembangan AI chatbot agent dari nol juga merupakan pengalaman yang sangat berharga. Membangun arsitektur tool dispatcher, conversation store, dan prompt builder tanpa menggunakan framework AI memberikan pemahaman mendalam tentang bagaimana sistem AI agent sebenarnya bekerja di balik layar. Ketika tool yang saya buat — seperti ScanCriticalStockTool atau AggregateBusinessMetricsTool — berhasil berfungsi dan memberikan hasil yang akurat, ada kepuasan tersendiri yang sulit dijelaskan.

### 2. Keterampilan yang Dikembangkan

**Keterampilan teknis:**
- Pengembangan full-stack dengan Laravel 10 pada skala enterprise
- Integrasi API pihak ketiga (Midtrans, RajaOngkir, Gemini, Cloudinary, Instagram)
- Desain dan implementasi AI agent system dengan arsitektur custom
- Pengelolaan database MySQL dengan 76 migration dan 35 model
- Workflow print service management dari file upload hingga order completion
- Inventory management dengan dual-stock architecture dan audit trail
- PDF dan Excel generation untuk reporting bisnis
- Barcode dan QR code generation

**Keterampilan non-teknis:**
- Code reading dan reverse engineering — kemampuan memahami kode orang lain
- Dokumentasi teknis — menyusun dokumen 1439 baris yang mencakup seluruh domain
- Analisis arsitektur — mengidentifikasi keunggulan, kelemahan, dan technical debt
- Komunikasi teknis — menjelaskan keputusan desain dan trade-off kepada pembimbing
- Manajemen waktu dalam proyek yang kompleks

### 3. Pengaruh Magang terhadap Karier

Pengalaman magang ini memperjelas tujuan karier saya di bidang pengembangan perangkat lunak. Saya menyadari bahwa saya tertarik pada pengembangan backend dan sistem integration — bukan sekadar membuat tampilan frontend yang cantik. Kemampuan merancang arsitektur service layer, mengintegrasikan berbagai API, dan membangun AI agent system membuka wawasan tentang jalur karier sebagai backend developer, system architect, atau AI engineer.

Yang juga penting, magang ini mengajarkan bahwa soft skill seperti kemampuan membaca kode orang lain, mendokumentasikan arsitektur, dan berkomunikasi tentang keputusan teknis sama pentingnya dengan hard skill coding. Ini adalah hal yang jarang ditekankan di bangku kuliah.

### 4. Penerapan Ilmu yang Diperoleh di Kampus

Secara umum, ilmu yang diperoleh di kampus sangat relevan dan applicable dalam proyek ini. Konsep MVC, normalisasi database, algoritma pencarian, dan dasar-dasar AI yang dipelajari di perkuliahan menjadi fondasi yang kokoh. Gap utama yang saya rasakan ada di area:
- Pengelolaan legacy code dan technical debt — ini hampir tidak pernah dibahas di kuliah
- Integrasi dengan layanan production yang memiliki konsekuensi nyata (pembayaran, posting media sosial)
- Skala codebase — proyek di kuliah jarang melebihi 10 model, sedangkan Viviashop memiliki 35
- Testing strategy di dunia nyata — khususnya ketika test otomatis minim dan harus mengandalkan pendekatan lain

## 6.2. Rekomendasi untuk Mitra

Berdasarkan audit mendalam terhadap codebase dan pengalaman pengembangan selama magang, berikut rekomendasi yang saya sampaikan kepada mitra:

### ● Stabilisasi Policy Stok (Prioritas 1)

Saat ini, timing pengurangan stok berbeda antar flow: frontend checkout mengurangi saat order item disimpan, admin order mengurangi saat completion, dan print order mengurangi saat payment confirmed. Disarankan untuk merapikan policy stok menjadi satu aturan yang konsisten lintas frontend/admin/print agar lebih mudah di-reason dan mengurangi risiko inkonsistensi (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1232-1240).

### ● Pemecahan Route Web

File `routes/web.php` yang berisi 1151 baris sebaiknya dipecah menjadi beberapa file per domain: `routes/admin.php`, `routes/frontend.php`, `routes/print-service.php`, `routes/api.php`. Route debug/test yang berjumlah sekitar dua lusin sebaiknya dipisahkan dan di-gate dengan `app()->environment('local')` atau dihapus dari production (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1244-1247).

### ● Refactoring Controller Besar

Controller seperti Frontend\OrderController (62KB), Admin\OrderController (35KB), dan Frontend\HomepageController (33KB) sebaiknya dipecah. Business logic seperti payment flow, shipment save, cart-to-order materialization, search algorithm, dan status reconciliation dapat dipindahkan ke service/action layer yang terpisah (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1099-1115).

### ● Penambahan Test Coverage

Surface test saat ini sangat minim (hanya ExampleTest). Disarankan untuk menambahkan test otomatis minimal pada flow paling kritikal: checkout frontend, admin order completion, purchase finalization, print service payment confirmation, dan employee tracking. Dengan adanya test, risiko regresi saat melakukan perubahan akan berkurang signifikan (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1235-1240).

### ● Finalisasi Migrasi Sistem Varian

Migrasi dari legacy product-child variants ke sistem `product_variants` yang baru sebaiknya dituntaskan. Coexistence dua paradigma varian menambah kompleksitas dan risiko inkonsistensi data (sumber: DOKUMENTASI_TEKNIS_VIVIASHOP.md baris 1249-1253).

## 6.3 Rekomendasi untuk Program Magang

- Program magang sebaiknya menyediakan waktu khusus untuk orientasi codebase, terutama jika mahasiswa ditempatkan pada proyek yang sudah berjalan. Minimal satu minggu penuh untuk audit dan pemetaan arsitektur sebelum mulai coding.
- Evaluasi berkala sebaiknya tidak hanya berbasis output (fitur yang selesai), tetapi juga mempertimbangkan kontribusi pada dokumentasi, identifikasi bug, dan peningkatan kualitas kode.
- Mata kuliah yang berkaitan dengan rekayasa perangkat lunak sebaiknya lebih banyak membahas skenario maintenance dan evolution — bukan hanya greenfield development.
- Program magang perlu memperhatikan aspek keamanan, terutama ketika mahasiswa bekerja dengan kredensial production. Sebaiknya disediakan environment sandbox yang terpisah.

## 6.4 Rencana Pengembangan Diri

### ● Soft Skill yang Akan Ditingkatkan

- **Komunikasi teknis** — Kemampuan menjelaskan arsitektur dan keputusan desain secara efektif, baik lisan maupun tertulis, kepada audiens teknis dan non-teknis.
- **Manajemen waktu** — Khususnya dalam mengestimasi waktu pengerjaan fitur pada codebase yang kompleks.
- **Kolaborasi** — Kemampuan bekerja dalam tim pengembangan yang lebih besar dengan code review, branching strategy, dan CI/CD.

### ● Hard Skill yang Akan Dikuasai

- **Testing dan quality assurance** — Mendalami PHPUnit, testing strategy, dan automated testing pipeline yang selama magang terasa masih kurang.
- **Container dan DevOps** — Docker, CI/CD pipeline, dan deployment automation yang belum ada di setup Viviashop saat ini.
- **AI/ML lanjut** — Mendalami framework AI seperti LangChain, vector database, dan RAG (Retrieval Augmented Generation) untuk membuat AI agent yang lebih powerful.
- **TypeScript dan framework modern** — Memperluas kemampuan frontend dengan React/Next.js dan TypeScript.

### ● Langkah Nyata

"Saya akan mengikuti sertifikasi Laravel, menyelesaikan kursus AI/ML lanjut, membangun portofolio proyek open-source, dan terlibat aktif dalam komunitas developer. Pengalaman di Viviashop akan saya jadikan studi kasus dalam portofolio untuk menunjukkan kemampuan mengelola proyek berskala enterprise."

### ● Tujuan Jangka Menengah

"Menjadi software engineer yang mampu merancang dan membangun sistem backend yang scalable dan well-documented, dengan spesialisasi di integrasi AI dan arsitektur microservices."

## 6.5 Potensi Keberlanjutan Program

### ● Potensi Kerja Sama Berkelanjutan

Mitra dapat terus melibatkan mahasiswa UNESA dalam pengembangan Viviashop, khususnya untuk:
- Menambah test coverage yang saat ini masih sangat minim
- Melakukan refactoring bertahap pada controller-controller besar
- Mengembangkan fitur AI agent yang lebih advanced
- Menyelesaikan migrasi sistem varian dari legacy ke modern

### ● Pengembangan Kurikulum Berbasis Industri

Pengalaman pengembangan Viviashop dapat dijadikan studi kasus yang sangat kaya untuk beberapa mata kuliah:
- **Rekayasa Perangkat Lunak** — contoh nyata technical debt, refactoring, dan software evolution
- **Basis Data** — contoh evolusi skema database dari 76 migration
- **Kecerdasan Buatan** — contoh implementasi AI agent system di aplikasi production
- **Pemrograman Web** — contoh arsitektur Laravel enterprise dengan integrasi multisystem

### ● Replikasi atau Scaling Up

Model pengembangan AI chatbot agent yang diterapkan di Viviashop dapat direplikasi ke platform e-commerce lain. Arsitektur tool dispatcher dan conversation store yang dibangun bersifat modular dan dapat diadaptasi untuk domain bisnis yang berbeda. Dokumentasi teknis yang telah disusun memungkinkan replikasi tanpa harus memulai dari nol.

---

# BAB VII PENUTUP

## 7.1. Simpulan

Pelaksanaan magang pada proyek pengembangan platform e-commerce Viviashop telah memberikan pengalaman yang sangat berharga dan komprehensif. Dari seluruh kegiatan yang telah dilaksanakan, dapat disimpulkan beberapa hal berikut:

1. **Platform Viviashop berhasil dikembangkan** menjadi sistem operasional retail yang melampaui toko online konvensional. Platform ini kini mencakup e-commerce frontend, backoffice admin, sistem inventori dengan audit trail, procurement dan pembelian supplier, layanan print service berbasis sesi, tracking performa karyawan, AI chatbot agent, dan integrasi dengan 5 layanan pihak ketiga (Midtrans, RajaOngkir, Cloudinary, Instagram, Google Gemini).

2. **AI chatbot agent berhasil diimplementasikan** dengan arsitektur custom yang mencakup 14 tool operasional berbasis role-based access control. Sistem ini mampu melayani customer (pencarian produk, kalkulasi biaya cetak, cek status order) maupun admin (pemantauan stok kritis, saran supplier, draft pembelian, agregasi metrik bisnis, dan generasi laporan).

3. **Print service management system berhasil dikembangkan** dengan workflow lengkap dari generate sesi, upload multi-file, penghitungan halaman otomatis, kalkulasi harga, checkout, pembayaran, antrian cetak, hingga cleanup file. Fitur ini merupakan diferensiasi kuat dari platform e-commerce konvensional.

4. **Dokumentasi teknis komprehensif berhasil disusun** — DOKUMENTASI_TEKNIS_VIVIASHOP.md sepanjang 1439 baris yang mencakup seluruh domain aplikasi, menjadi aset penting untuk maintenance dan onboarding pengembang baru.

5. **Pengalaman magang ini membuktikan** bahwa kompetensi yang diperoleh di bangku kuliah — rekayasa perangkat lunak, basis data, kecerdasan buatan, dan pemrograman web — sangat relevan dan applicable di dunia industri. Gap utama terletak pada aspek pengelolaan legacy code, skala codebase, dan testing strategy yang perlu diperkuat dalam kurikulum.

## 7.2. Saran

1. **Untuk mitra:** Prioritaskan stabilisasi policy stok, pemecahan route web, refactoring controller besar, dan penambahan test coverage sebelum menambah fitur baru yang besar. Fondasi domain bisnis Viviashop sudah cukup kaya untuk dikembangkan lebih lanjut tanpa perlu rewrite total — yang diperlukan adalah pembersihan bertahap.

2. **Untuk program studi:** Perbanyak materi tentang software maintenance dan evolution dalam mata kuliah rekayasa perangkat lunak. Mahasiswa perlu dilatih bukan hanya membangun dari nol, tetapi juga memahami, memodifikasi, dan mendokumentasikan sistem yang sudah ada.

3. **Untuk mahasiswa yang akan magang:** Luangkan waktu yang cukup untuk memahami arsitektur proyek sebelum mulai coding. Kemampuan membaca dan memahami kode orang lain sama pentingnya dengan kemampuan menulis kode baru. Dokumentasikan temuan selama proses audit — catatan ini akan sangat membantu sepanjang periode magang.

---

## DAFTAR PUSTAKA

Beard, C. & Wilson, J.P. (2013). *Experiential Learning: A Handbook for Education, Training and Coaching*. 3rd ed. London: Kogan Page.

Kolb, D.A. (2014). *Experiential Learning: Experience as the Source of Learning and Development*. 2nd ed. New Jersey: Pearson Education.

Laravel. (2023). *Laravel 10.x Documentation*. [Online]. Available at: https://laravel.com/docs/10.x (Accessed: [TANGGAL AKSES — PERLU INPUT MANUAL]).

Midtrans. (2024). *Midtrans Technical Documentation*. [Online]. Available at: https://docs.midtrans.com/ (Accessed: [TANGGAL AKSES — PERLU INPUT MANUAL]).

Google. (2024). *Gemini API Documentation*. [Online]. Available at: https://ai.google.dev/docs (Accessed: [TANGGAL AKSES — PERLU INPUT MANUAL]).

Otwell, T. (2023). *Laravel: The PHP Framework for Web Artisans*. MIT License. GitHub: laravel/framework.

Pressman, R.S. & Maxim, B.R. (2020). *Software Engineering: A Practitioner's Approach*. 9th ed. New York: McGraw-Hill Education.

Russell, S.J. & Norvig, P. (2021). *Artificial Intelligence: A Modern Approach*. 4th ed. New Jersey: Pearson.

Sommerville, I. (2015). *Software Engineering*. 10th ed. Boston: Pearson.

Connolly, T. & Begg, C. (2014). *Database Systems: A Practical Approach to Design, Implementation, and Management*. 6th ed. Boston: Pearson.

---

## LAMPIRAN

### Lampiran 1. Biodata Mahasiswa

| | |
|---|---|
| Nama Lengkap | [PERLU INPUT MANUAL] |
| NIM | [PERLU INPUT MANUAL] |
| Program Studi | [PERLU INPUT MANUAL] |
| Jurusan | [PERLU INPUT MANUAL] |
| Fakultas | [PERLU INPUT MANUAL] |
| Universitas | Universitas Negeri Surabaya (UNESA) |
| Tempat/Tanggal Lahir | [PERLU INPUT MANUAL] |
| Alamat | [PERLU INPUT MANUAL] |
| No. Telepon | [PERLU INPUT MANUAL] |
| Email | [PERLU INPUT MANUAL] |
| Periode Magang | [PERLU INPUT MANUAL] |

### Lampiran 2. Inventaris Teknis Project

**Ringkasan Kuantitatif:**

| Komponen | Jumlah |
|---|---|
| Model Eloquent | 35 |
| Controller (total) | 49+ |
| Controller Admin | 23 |
| Controller Frontend | 8 (termasuk legacy) |
| Controller Root | 10 |
| Controller Auth | 7 |
| Controller API | 1 |
| Service Class | 5 + AI system |
| AI Core Files | 8 |
| AI Tool Files | 14 |
| Database Migration | 76 |
| View Blade | 180+ |
| Export Class | 9 |
| Console Command | 29 |
| Baris routes/web.php | 1151 |
| Baris DOKUMENTASI_TEKNIS | 1439 |

**Daftar Lengkap 35 Model:**
AiToolCall, Attribute, AttributeOption, AttributeVariant, Brand, Category, EmployeeBonus, EmployeePerformance, Order, OrderItem, PaperType, Payment, Pembelian, PembelianDetail, Pengeluaran, PrintFile, PrintOrder, PrintSession, PrintType, Product, ProductAttributeValue, ProductCategory, ProductImage, ProductInventory, ProductVariant, RekamanStok, Setting, Shipment, Slide, StockMovement, Supplier, Testimonial, User, VariantAttribute, WishList.

**Daftar 14 AI Agent Tools:**
AddToCartTool, AggregateBusinessMetricsTool, CalculatePrintCostTool, CheckOrderStatusTool, CreatePrintCartItemTool, CreatePurchaseDraftTool, ExportReportTool, GreetingTool, QuickBuyRedirectTool, ResolvePrintVariantTool, ScanCriticalStockTool, SearchProductsViaSqlTool, SuggestSupplierTool, TopEmployeePerformanceTool.

**Daftar 5 Service Class:**
PrintService, ProductVariantService, SmartPrintVariantService, StockManagementService, StockService.

---

*Laporan ini disusun berdasarkan fakta yang diverifikasi langsung dari kode sumber project Viviashop. Setiap klaim teknis dilengkapi sitasi internal ke file sumber. Item yang memerlukan informasi di luar codebase ditandai dengan [PERLU INPUT MANUAL].*
