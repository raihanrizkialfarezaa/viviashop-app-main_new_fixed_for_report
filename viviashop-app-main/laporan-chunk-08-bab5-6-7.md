
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
