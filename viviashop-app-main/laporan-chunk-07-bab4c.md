
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
| Mei - Juni 2026 | Developer Magang | Optimasi varian produk, finalisasi AI agent, testing E2E, perbaikan stok reversal, dokumentasi handover | 190 | Sistem siap rilis, dokumentasi lengkap | Optimasi + testing + dokumentasi |

---

### Mata Kuliah: Magang Perencanaan Program (2 SKS)

Mata kuliah ini secara struktural mencakup perencanaan, persiapan, dan pembekalan sebelum serta selama pelaksanaan magang. Relevansinya terasa langsung sejak hari pertama.

Sebelum magang dimulai, saya menyusun proposal magang berdampak yang mendeskripsikan kompetensi yang saya bawa, ruang lingkup kontribusi yang direncanakan, dan indikator keberhasilan yang terukur. Proses ini menuntut pemahaman yang baik tentang kebutuhan mitra  -  sesuatu yang saya dapatkan dari observasi awal terhadap arsitektur Viviashop dan diskusi dengan pembimbing mitra Fanani Agung Widyanto.

Selama magang berlangsung, keterampilan perencanaan terus digunakan. Setiap hari saya harus memprioritaskan tugas dari antrian yang diberikan pembimbing mitra, mengestimasi waktu pengerjaan, dan melaporkan progres melalui logbook. Ketika menghadapi bug yang kompleks  -  seperti masalah signature key Midtrans pada Februari 2026 atau reversal stok pada Mei 2026  -  saya terbiasa membuat rencana investigasi sistematis sebelum mulai debugging, seperti memeriksa file log, mereproduksi masalah di lingkungan lokal, baru merumuskan solusi.

Pembekalan yang diberikan oleh Sub Direktorat Mobilitas Akademik UNESA sebelum keberangkatan juga menjadi bagian dari mata kuliah ini: etika kerja profesional, cara mengisi logbook yang baik, dan mekanisme pelaporan kepada DPL. Keterampilan-keterampilan administratif ini terasa sepele, tapi dalam praktiknya sangat membantu saya menjaga konsistensi selama empat bulan lebih.

Bukti nyata dari penerapan kompetensi perencanaan adalah 96 entri logbook yang terisi konsisten  -  bukan hanya sebagai kewajiban administratif, tetapi sebagai catatan kerja yang berguna ketika saya perlu mengingat apa yang sudah dikerjakan dan apa yang belum.

[FOTO/GAMBAR: Dokumentasi logbook harian yang disubmit ke sistem Mobilitas Akademik UNESA]

---

### Mata Kuliah: Magang Evaluasi Program (2 SKS)

Mata kuliah ini berkaitan dengan kemampuan mengevaluasi proses, hasil, dan dampak dari kegiatan magang. Evaluasi ini terjadi di dua level, yaitu evaluasi dari pembimbing mitra terhadap kinerja saya dan evaluasi mandiri terhadap proses pengembangan di Viviashop.

Dari sisi evaluasi oleh mitra, setiap beberapa minggu Fanani Agung Widyanto memberikan umpan balik atas kinerja saya  -  baik secara informal dalam diskusi harian maupun secara lebih formal menjelang akhir magang. Umpan balik ini mencakup kualitas kode yang saya tulis, kemampuan debug mandiri sebelum eskalasi, dan konsistensi dalam mengikuti konvensi kode yang berlaku di tim.

Dari sisi evaluasi mandiri, saya terbiasa merefleksikan keputusan teknis yang diambil. Misalnya, ketika saya memilih menambahkan eager loading untuk mengatasi N+1 query  -  bukannya menambahkan cache layer  -  saya harus mampu menjelaskan mengapa eager loading lebih tepat untuk kasus ini. Atau ketika saya mendiskusikan dengan senior apakah refaktor `AttributeVariantController` perlu menerapkan repository pattern  -  dan kami memutuskan belum perlu karena complexity overhead-nya tidak sebanding dengan skala proyek saat ini. Kemampuan mengevaluasi trade-off semacam ini adalah inti dari mata kuliah ini.

Evaluasi yang lebih sistematis terjadi menjelang akhir magang, di mana saya melakukan *final testing* menyeluruh (28 - 29 Mei 2026) untuk memastikan semua fitur kritis berjalan dengan benar sebelum rilis update terbaru. Saya menjalankan suite test yang ada, memperbaiki bug yang ditemukan, dan mendokumentasikan hasilnya untuk tim QA.

[FOTO/GAMBAR: Dokumentasi proses final testing dan hasil evaluasi akhir]

---

### Mata Kuliah: Web Semantik (3 SKS)

Web Semantik sebagai mata kuliah membahas cara membuat konten web dapat dimengerti tidak hanya oleh manusia, tetapi juga oleh mesin  -  melalui struktur data yang terstandar, metadata yang bermakna, dan antarmuka yang dapat diakses secara programatik. Relevansinya dengan pekerjaan di Viviashop ada di beberapa titik.

Yang paling langsung adalah pengembangan API endpoint yang digunakan oleh frontend dan oleh sistem AI. Ketika saya mengerjakan perbaikan `api.php` dan `ProductVariantController` (Februari 2026), saya memastikan bahwa response JSON yang dikembalikan memiliki struktur yang konsisten  -  status code yang tepat, key yang bermakna, dan data yang terorganisir dengan hierarki yang logis. Ini adalah penerapan langsung dari prinsip API design yang bisa dikaitkan dengan konsep web semantik, di mana data yang tersedia melalui endpoint harus dapat diinterpretasikan secara akurat oleh klien mana pun yang mengonsumsinya.

Lebih jauh, integrasi AI Agent Viviashop dengan Google Gemini API menghadirkan dimensi web semantik yang lebih modern, khususnya mengenai bagaimana representasi data bisnis (produk, stok, order) distrukturkan dalam sistem prompt agar bisa diinterpretasikan dengan benar oleh model bahasa besar. Ketika saya merefaktor `PromptBuilder` dan `Context` (Maret 2026), secara praktis saya merancang skema semantik untuk menyampaikan konteks bisnis kepada LLM  -  agar model bisa "memahami" situasi dan memberikan respons yang relevan. Ini adalah aplikasi prinsip web semantik dalam konteks AI modern yang belum ada dalam literatur kuliah saya, tetapi sangat relevan secara konseptual.

Di sisi lain, pengerjaan fitur dokumentasi API internal (Maret 2026) juga mencerminkan kesadaran semantik, di mana endpoint yang terdokumentasi dengan jelas (nama, parameter, response) adalah endpoint yang dapat dipahami dan digunakan oleh pengembang lain tanpa perlu membaca kode sumbernya.

[FOTO/GAMBAR: Contoh struktur JSON response dari API Viviashop yang terdokumentasi]

---

### Mata Kuliah: Verifikasi dan Validasi Perangkat Lunak (3 SKS)

Mata kuliah ini mencakup teknik-teknik untuk memastikan perangkat lunak memenuhi spesifikasi (verifikasi) dan memenuhi kebutuhan pengguna (validasi). Saya menerapkan kedua aspek ini secara intensif selama magang.

*Verifikasi* dilakukan melalui pengujian unit dengan PHPUnit (Maret 2026)  -  saya menulis test untuk `ProductController.index` menggunakan model factory, menjalankan `php artisan test`, dan memperbaiki beberapa test case yang gagal. Saya juga menambahkan unit test untuk `SuggestSupplierTool` dan `CalculatePrintCostTool`. Meski codebase Viviashop tidak memiliki coverage test yang tinggi (sesuai catatan di AGENTS.md, tes berjalan di MySQL nyata bukan SQLite in-memory), setiap test yang saya tambahkan membantu menjaga kualitas kode di area yang saya sentuh.

*Validasi* dilakukan melalui serangkaian pengujian fungsional yang mensimulasikan perilaku pengguna nyata. Pengujian paling menyeluruh adalah sesi *end-to-end testing* pada 26 Mei 2026: saya membuat akun dummy, menambahkan produk ke keranjang, melakukan checkout, membayar menggunakan Midtrans sandbox, dan memverifikasi notifikasi berhasil diterima. Saya juga mendokumentasikan kendala kecil yang ditemukan (URL callback yang perlu disesuaikan) untuk ditindaklanjuti tim.

Implementasi Form Request untuk validasi input juga masuk ke dalam domain mata kuliah ini. `AttributeRequest`, `ProductRequest`, `AIChatRequest`  -  setiap kelas request ini mendefinisikan aturan validasi yang memastikan data yang masuk ke sistem memenuhi struktur yang diharapkan sebelum diproses lebih lanjut. Saya membuat dan menyempurnakan beberapa kelas request ini, termasuk menambahkan custom error message yang lebih informatif bagi pengguna.

Pengujian dual input system (April 2026)  -  memastikan order produk dan order print dapat diproses dalam satu transaksi  -  adalah contoh pengujian integrasi untuk memverifikasi bahwa dua modul yang berbeda berinteraksi dengan benar ketika digunakan bersamaan.

[FOTO/GAMBAR: Contoh hasil output PHPUnit testing di Viviashop]

---

### Mata Kuliah: Konstruksi Perangkat Lunak (3 SKS)

Konstruksi Perangkat Lunak adalah mata kuliah yang paling langsung relevan dengan apa yang saya kerjakan setiap hari selama magang  -  ini adalah tentang membangun perangkat lunak yang benar-benar bekerja. Setiap baris kode yang saya tulis, setiap refaktor yang saya lakukan, dan setiap bug yang saya perbaiki adalah penerapan langsung dari prinsip-prinsip konstruksi perangkat lunak.

Jujur, di awal magang saya agak kewalahan membaca codebase Viviashop. Controller yang panjang, route yang lebih dari 1.150 baris, model dengan relasi yang bertingkat  -  ini jauh dari proyek kelas yang bisa dipelajari dalam satu malam. Butuh beberapa hari sebelum saya bisa mulai berkontribusi dengan keyakinan.

Prinsip *Don't Repeat Yourself* (DRY) menjadi panduan ketika saya merefaktor `StockManagementService`, mengingat ada beberapa metode yang secara substansi melakukan logika yang sama dari arah yang berbeda. Dengan menggabungkan logika ini, saya mengurangi kemungkinan bug yang disebabkan oleh perubahan di satu tempat tetapi tidak di tempat lain. Hal yang sama berlaku ketika saya memisahkan `CategoryService` dari `CategoryController`, karena controller yang bersih lebih mudah dibaca, diuji, dan dimodifikasi.

*Single Responsibility Principle* (SRP) terasa relevan ketika saya mengerjakan `AttributeVariantController` yang awalnya terlalu gemuk. Dengan memisahkan logika bisnis ke dalam service terpisah, controller menjadi lebih terfokus pada tugas koordinasi antara request dan response  -  bukan menjalankan logika bisnis secara langsung.

Penggunaan Vite sebagai bundler (saya pelajari pada Maret 2026) adalah bagian dari konstruksi sisi frontend untuk mengelola dependensi JavaScript dan CSS, memastikan perubahan terlihat secara instan di browser saat development (`npm run dev`), dan menghasilkan bundle yang dioptimasi untuk production (`npm run build`). Ini adalah proses konstruksi yang berbeda dari backend, tetapi tetap mengikuti prinsip yang sama, yaitu memisahkan development workflow dari production output.

Salah satu pelajaran berharga yang tidak ada di buku teks: ketika mengerjakan fitur baru di sistem yang sudah berjalan, selalu ada risiko *regresi*  -  sebuah perbaikan di satu tempat menyebabkan kerusakan di tempat lain. Pengalaman inilah yang membuat saya disiplin dalam menjalankan test setiap kali selesai membuat perubahan signifikan.

[FOTO/GAMBAR: Contoh kode sebelum dan sesudah refaktor StockManagementService]

---

### Mata Kuliah: Analisis dan Desain Perangkat Lunak (4 SKS)

Dengan bobot 4 SKS  -  paling besar di antara semua mata kuliah konversi  -  narasi untuk mata kuliah ini perlu lebih panjang dan mendalam, karena kontribusinya terhadap kompetensi yang saya kembangkan selama magang juga yang paling luas.

Analisis dan Desain Perangkat Lunak mengajarkan bagaimana memahami kebutuhan sistem (analisis) dan bagaimana menerjemahkan kebutuhan itu menjadi struktur yang bisa diimplementasikan (desain). Di Viviashop, saya berhadapan dengan sistem yang sudah didesain dan diimplementasikan oleh orang lain  -  tantangan yang berbeda tapi sama pentingnya, yaitu membaca dan memahami desain yang sudah ada.

**Membaca dan Memahami Desain yang Ada.** Di tiga hari pertama magang, saya menghabiskan waktu untuk memahami desain sistem yang sudah ada: membaca `DOKUMENTASI_TEKNIS_VIVIASHOP.md`, menelusuri diagram relasi antar model (yang perlu saya buat sendiri karena tidak ada diagram formal), dan memahami pola namespace yang digunakan (Admin/Frontend/Api/Auth). Ini adalah *reverse engineering* desain  -  dan ternyata memerlukan kemampuan analisis yang tidak kalah tinggi dari merancang dari nol.

**Analisis Masalah Stok Multi-Layer.** Ketika mengerjakan `StockManagementService`, saya harus melakukan analisis yang sistematis: mengidentifikasi semua titik di sistem yang melakukan operasi tulis ke stok (order baru, pembelian masuk, pengembalian barang), memetakan alur masing-masing, dan mengidentifikasi di mana terjadi inkonsistensi. Kemampuan analisis ini  -  menelusuri data flow dalam sistem yang kompleks  -  adalah inti dari mata kuliah ini.

**Desain AI Agent System.** Arsitektur AI agent Viviashop menunjukkan desain yang elegan: `ToolDispatcher` menggunakan pola *strategy*  -  ia tidak tahu cara kerja setiap tool, tapi tahu cara memilih dan memanggil tool yang tepat berdasarkan nama. `ToolRegistry` menyimpan peta nama ke implementasi. Setiap tool mengimplementasikan kontrak `ToolHandler`. Ini adalah contoh penerapan prinsip *Open/Closed Principle* (OCP) dari SOLID: sistem terbuka untuk ekstensi (tambah tool baru) tanpa memodifikasi kode yang sudah ada. Ketika saya mengimplementasikan `SuggestSupplierTool`, saya mengikuti pola yang sama  -  dan proses ini mengkonfirmasi pemahaman saya tentang keunggulan desain berbasis kontrak.

**Desain Database dan Relasi Model.** Viviashop menggunakan 35 model Eloquent dengan relasi yang bervariasi: one-to-many (Category → Product), many-to-many dengan pivot (Product ↔ AttributeOption melalui ProductAttributeValue), dan relasi polimorfik (ProductImage). Memahami dan bekerja dengan relasi-relasi ini  -  termasuk memilih kapan menggunakan eager loading vs. lazy loading  -  membutuhkan pemahaman mendalam tentang desain basis data relasional yang menjadi materi inti mata kuliah ini.

**Desain API yang Konsisten.** Ketika saya memperbaiki endpoint di `api.php` (Februari 2026) dan membuat dokumentasi API internal (Maret 2026), saya belajar tentang pentingnya konsistensi desain API: response structure yang konsisten, status code yang bermakna, dan error message yang informatif. Tanpa konsistensi ini, klien API  -  baik frontend maupun sistem AI agent  -  tidak bisa menulis kode yang reliable.

**Gap Antara Teori dan Praktik.** Satu hal yang tidak cukup ditekankan di mata kuliah: desain tidak pernah selesai. Setiap perubahan kebutuhan menghasilkan technical debt baru. Viviashop memiliki dua controller cart (`CartController` dan `CartControllerNew`), dua seeder brand (`BrandSeeder` dan `BrandSeederNew`), dan beberapa model legacy yang sudah tidak disarankan penggunaannya (`RekamanStok`). Ini bukan kegagalan desain  -  ini adalah hasil dari pengembangan iteratif di bawah tekanan waktu. Memahami ini mengubah cara saya melihat "desain yang baik": bukan yang sempurna dari awal, tetapi yang cukup baik untuk saat ini sambil membuka pintu untuk evolusi di masa depan.

[FOTO/GAMBAR: Diagram arsitektur sistem AI Agent Viviashop (AIAgentService, ToolDispatcher, ToolRegistry, ToolHandler)]

---

### Mata Kuliah: Virtualisasi dan Komputasi Awan (3 SKS)

Mata kuliah ini membahas konsep virtualisasi infrastruktur dan pemanfaatan layanan cloud untuk pengembangan dan deployment aplikasi. Relevansinya dengan pengalaman magang saya ada di dua dimensi, yaitu deployment tradisional berbasis VPS dan pemanfaatan layanan cloud pihak ketiga.

**Deployment ke Server VPS.** Proses yang saya pelajari dan jalani langsung selama magang  -  setup environment production, konfigurasi `.env`, `composer install`, `php artisan migrate`, `npm run build` untuk Vite, setup cron `php artisan schedule:run`  -  adalah siklus deployment yang berjalan di atas server VPS tanpa container atau orkestrasi yang otomatis. Ini berbeda dari model deployment yang diajarkan di kelas (yang mungkin lebih menekankan Docker atau platform PaaS), tapi sangat representatif dari realitas deployment di banyak bisnis skala menengah di Indonesia. Pengalaman ini mengajarkan tentang apa yang sebenarnya terjadi di bawah abstraksi layanan cloud yang sudah terkelola.

**Pemanfaatan Cloudinary sebagai CDN Cloud.** Upload dan pengambilan gambar produk di Viviashop menggunakan Cloudinary  -  layanan cloud penyimpanan dan pemrosesan media. Saya mengerjakan fitur upload gambar produk (Februari 2026) dan upload avatar profil pengguna (April 2026) yang keduanya mengandalkan Cloudinary API. Ini adalah contoh nyata dari arsitektur *hybrid*: aplikasi berjalan di VPS on-premise, tetapi menggunakan layanan cloud khusus untuk kebutuhan spesifik (penyimpanan dan distribusi media) yang tidak efisien jika dikelola sendiri.

**Pemanfaatan Google Gemini sebagai AI Cloud Service.** Integrasi dengan Google Gemini API adalah contoh paling jelas dari komputasi awan dalam konteks magang ini. Model inferensi berjalan di infrastruktur Google  -  tidak ada GPU, tidak ada model management yang perlu dilakukan tim Viviashop. Semua yang diperlukan adalah `GeminiClient` yang mengirimkan HTTP request dan menerima response. Pola ini  -  mengonsumsi kemampuan komputasi yang besar melalui API tanpa mengelola infrastrukturnya sendiri  -  adalah salah satu proposisi nilai utama komputasi awan yang paling terasa relevan dalam praktik.

**Midtrans sebagai Payment Cloud Service.** Integrasi pembayaran dengan Midtrans juga merupakan contoh pemanfaatan cloud service: pemrosesan transaksi yang aman, manajemen fraud detection, dan notifikasi callback semuanya ditangani oleh infrastruktur cloud Midtrans. Tim Viviashop hanya perlu mengintegrasikan SDK dan mengkonfigurasi webhook  -  ini adalah model *Software as a Service* (SaaS) dalam konteks yang sangat konkret.

Pengalaman bekerja dengan empat layanan cloud berbeda (Cloudinary, Gemini, Midtrans, RajaOngkir) dalam satu platform memberi saya pemahaman praktis tentang cara mengelola dependensi cloud, di mana setiap layanan memiliki konfigurasi berbeda di `.env`, penanganan kesalahan yang spesifik, dan biaya operasional yang harus dipertimbangkan dalam pengambilan keputusan arsitektur.

[FOTO/GAMBAR: Diagram arsitektur hybrid Viviashop yang menunjukkan integrasi layanan cloud (Cloudinary, Gemini, Midtrans, RajaOngkir)]

---

**Laporan Akhir Mobilitas Akademik Magang Tahun 2026**
