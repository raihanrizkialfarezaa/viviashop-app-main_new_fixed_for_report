/**
 * ================================================================
 * TEMPLATE: Logbook Activity Seed — untuk AI agent di VIVIASHOP
 * ================================================================
 *
 * TUJUAN:
 *   Template ini digunakan oleh AI agent di direktori project utama
 *   VIVIASHOP untuk menghasilkan file JSON berisi data kegiatan
 *   logbook yang AKURAT berdasarkan aktivitas NYATA di project.
 *
 *   Kenapa? Karena AI di project logbook tidak punya context tentang
 *   project viviashop — hasil generasi jadi ngaco. Dengan template
 *   ini, AI di viviashop (yang punya full context) bisa mengenerate
 *   data kegiatan logbook yang sesuai realita.
 *
 * CARA PAKAI:
 *   1. Letakkan file ini di direktori project viviashop
 *   2. Buka file ini, baca seluruh aturan (ATURAN #0 s/d #8 + VALIDASI +
 *      SELF-VALIDATION CHECKLIST) sampai paham betul. Semua aturan WAJIB
 *      dipatuhi — tidak ada toleransi.
 *   3. Jelajahi SELURUH direktori project viviashop dengan teliti. Baca
 *      file package.json, README, folder structure, konfigurasi, source
 *      code, migration, seed, semuanya. Catat semua teknologi, library,
 *      framework, fitur, stack, dan alur bisnis yang ADA secara NYATA
 *      di codebase. Ini jadi KONTEKS satu-satunya — tidak boleh ngarang.
 *   4. Jalankan prompt di bawah ini (copy-paste ke AI agent):
 *
 *      === PROMPT MULAI DARI SINI (copy semua) ===
 *
 *      TUGAS: Generate file logbook-activities.json untuk periode magang
 *      viviashop berdasarkan template logbook-activity-seed.ts.
 *
 *      LANGKAH WAJIB (lakukan berurutan, jangan skip):
 *
 *      [1] BACA & PAHAMI TEMPLATE
 *      Buka file templates/logbook-activity-seed.ts. Baca SELURUH isinya
 *      dari ATURAN #0 sampai SELF-VALIDATION CHECKLIST. Tidak boleh ada
 *      satu aturan pun yang terlewat. Jika tidak paham satu aturan, baca
 *      ulang sampai paham.
 *
 *      [2] EKSPLORASI CODEBASE VIVIASHOP (CONTEXT GATHERING)
 *      Jelajahi SELURUH direktori project ini. Baca file penting:
 *      package.json, README, tsconfig, next.config, prisma/schema,
 *      semua folder src/, API routes, components, hooks, lib, semuanya.
 *      Catat:
 *        - Stack teknologi: framework, database, ORM, auth, UI library
 *        - Fitur yang SUDAH ADA (bukan rencana): halaman, API endpoint,
 *          komponen, integrasi third-party
 *        - Pola arsitektur: monorepo? microservices? folder structure?
 *        - Alur bisnis utama: user flow dari halaman A ke B ke C
 *        - Library eksternal: payment, shipping, upload, AI, dll
 *      DATA INI adalah SATU-SATUNYA sumber kebenaran. Semua yang ditulis
 *      di logbook HARUS bisa diverifikasi ada di codebase ini.
 *
 *      [3] TENTUKAN PERIODE
 *      Periode magang: [ISI TANGGAL MULAI] sampai [ISI TANGGAL SELESAI].
 *      Hanya hari Senin—Sabtu. Minggu dilewati. Hari libur nasional
 *      di dalam periode tetap dibuatkan entry (remote/WFA).
 *      Total hari kerja: [HITUNG & ISI JUMLAH HARI]
 *
 *      [4] GENERATE ENTRIES
 *      Untuk SETIAP hari kerja, buat 1 entry dengan durasi tepat 480
 *      menit (8 jam). Gunakan data dari langkah [2] untuk mengisi:
 *        - title: spesifik, maks 10 kata, berdasarkan kegiatan nyata
 *          yang LOGIS dilakukan di fase magang pada tanggal tersebut
 *        - description: 100-200 kata, gaya natural "saya ngerjain..."
 *          Ikuti ATURAN #1 dan #3 — cerita dari sisi DOING, bukan ANALYZING
 *        - screenshotGuidance: spesifik per hari, berbeda setiap hari,
 *          sesuai dengan aktivitas di description. Ikuti ATURAN #6.
 *
 *      PROGRES PER MINGGU (ATURAN #5):
 *        Minggu 1-2: onboarding, setup, baca docs, belajar codebase
 *        Minggu 3-6: coding fitur, implementasi, diskusi tim
 *        Minggu 7+: testing, bug fixing, deployment, dokumentasi
 *
 *      VARIASI AKTIVITAS (ATURAN #4): Campur coding, meeting, belajar,
 *      testing, debugging, dokumentasi — jangan monoton.
 *
 *      [5] SELF-VALIDATION (WAJIB — lakukan sebelum menulis file)
 *      Scan SELURUH JSON output dan periksa SATU PER SATU:
 *      □ Tidak ada karakter "—" (U+2014, em dash) di field teks mana pun
 *      □ Setiap description 100-200 kata, gaya natural "saya ngerjain..."
 *      □ Setiap title maks 10 kata, spesifik, bukan generik
 *      □ Tidak ada jumlah baris file dalam description
 *      □ Tidak ada format poin/listing dalam description
 *      □ Tidak ada "mengidentifikasi", "menganalisis", "ditemukan bahwa"
 *      □ Tidak ada nge-list fitur kayak katalog
 *      □ Screenshot guidance berbeda untuk setiap hari
 *      □ Semua teknologi/fitur yang disebut ADA di codebase (cek ATURAN #0)
 *      □ Semua activityDate format YYYY-MM-DD, tidak ada Minggu
 *      □ Setiap entry durationMinutes = 480
 *      □ Total entry = total hari kerja dalam periode
 *
 *      Jika ada SATU checklist yang gagal, PERBAIKI dulu. Jangan lanjut
 *      ke langkah berikutnya sebelum semua checklist terpenuhi 100%.
 *
 *      [6] TULIS FILE
 *      Simpan sebagai: logbook-activities.json
 *      Format: JSON array of LogbookActivitySeed objects
 *      HANYA tulis JSON — tanpa markdown, tanpa penjelasan tambahan.
 *      JSON harus valid, bisa langsung di-parse dengan JSON.parse().
 *
 *      === PROMPT SELESAI ===
 *
 *   5. AI akan menghasilkan file logbook-activities.json
 *   6. Buka file tersebut, cek manual beberapa entry untuk memastikan
 *      kualitas (baca ATURAN #1 untuk contoh baik vs buruk)
 *   7. Copy file JSON ke project logbook
 *   8. Buka halaman /seed-import di logbook → upload file → import
 * ================================================================
 */

// ================================================================
// PANDUAN GAYA PENULISAN AI (AI STYLE GUIDE)
// ================================================================
// AI agent HARUS mengikuti semua aturan di bawah ini saat menulis
// title, description, dan screenshotGuidance. Aturan ini menjamin
// hasil generasi terlihat NATURAL seperti benar-benar ditulis oleh
// mahasiswa magang, bukan seperti laporan teknis kaku hasil AI.

// --- ATURAN #0: JANGAN PERNAH MENGADA-ADA INFORMASI (CRITICAL) ---
// - Hanya gunakan informasi yang ADA di KONTEKS PROJECT VIVIASHOP
// - JANGAN menyebut nama perusahaan, produk, atau klien APAPUN yang
//   tidak ada di file/direktori project viviashop
// - JANGAN membuat asumsi: "mungkin perusahaan ini juga punya..."
// - JANGAN ngarang detail teknis yang tidak ada di codebase
// - Jika di codebase tidak ada payment gateway, jangan tulis soal
//   integrasi payment
// - LEBIH BAIK deskripsi agak umum daripada salah sebut produk/perusahaan
// - Ini ATURAN PALING KERAS — melanggar berarti data logbook salah semua
// - COBA CEK: Sebelum menulis tiap deskripsi, cek apakah semua teknologi,
//   fitur, dan detail yang disebut BENAR-BENAR ADA di codebase viviashop

// --- ATURAN #1: GAYA PENULISAN MANUSIAWI (PENTING BANGET) ---
//
// ⛔ YANG HARUS DIHINDARI (ANTI-PATTERN):
//   - Nyebut JUMLAH BARIS file: "sekitar 1439 baris", "file yang ternyata X baris"
//   - Nge-list fitur kaya brochure: "aplikasi ini punya fitur: A, B, C..."
//   - Nge-list struktur folder/controller/model/service seperti dokumentasi teknis
//   - "Saya mempelajari daftar controller, model, dan service yang ada"
//   - "Saya catat poin-poin penting", "Saya dokumentasikan temuan saya"
//   - "Saya mengidentifikasi bahwa...", "Ditemukan bahwa...", "Saya menganalisis..."
//   - Bahasa laporan magang formal: "Berdasarkan hasil pengamatan..."
//   - Nulis deskripsi kayak README: ngejelasin fitur satu-satu, arsitektur, alur kode
//   - Pakai em dash (—) sebagai pemisah kalimat
//   - Nge-list pake titik dua kaya katalog: "Ada dua permukaan: A dan B"
//   - Nge-list nama file/class/tools secara teknis: "ada ServiceA, ServiceB, dan 13 tools"
//
// ✅ YANG HARUS DILAKUKAN:
//   - Ceritain APA YANG KAMU LAKUKAN hari ini, bukan apa yang kamu temukan di kode
//   - Fokus ke KEGIATAN: bikin, ngerjain, nyoba, belajar, diskusi, testing, debugging
//   - Boleh ada kendala: "sempat bingung", "agak pusing", "cukup rumit"
//   - Boleh ada kesan: "lumayan puas", "masih perlu belajar lagi", "besok lanjut lagi"
//   - Pakai kata natural: saya, hari ini, setelah itu, ternyata, agak, cukup, lumayan
//   - Tulis dalam PARAGRAF — jangan format poin/listing
//   - Tulis dari sisi DOING, bukan ANALYZING
//
// ❌ CONTOH BURUK (JANGAN DITIRU):
//   "Hari ini saya fokus baca dokumentasi teknis yang cukup panjang. Saya pelajari
//   daftar controller, model, dan service yang ada. Ternyata aplikasi ini punya
//   banyak fitur: manajemen produk, pesanan, cetak, integrasi Midtrans, RajaOngkir,
//   Cloudinary, dan lainnya. Saya catat poin-poin penting."
//
//   "Hari ini saya mempelajari file routes/web.php yang ternyata 1151 baris. Saya
//   mengidentifikasi bahwa rute admin didefinisikan dalam group auth."
//
// ✅ CONTOH BAIK (TIRU GAYA INI):
//   "Hari ini saya baca-baca dokumentasi project biar paham alur kerjanya. Cukup
//   banyak juga ternyata fiturnya, ada manajemen produk, pesanan, integrasi
//   pembayaran, dan beberapa fitur lainnya. Lumayan pusing bacanya tapi mulai
//   kebayang alurnya. Besok rencananya mau mulai coba koding fitur kecil-kecilan
//   dulu."
//
//   "Hari ini saya lanjut ngerjain fitur login. Agak stuck di bagian validasi
//   token, tapi setelah tanya senior akhirnya ketemu solusinya. Saya pakai JWT
//   untuk handle authentikasinya."
//
//   "Hari ini saya belajar routing Laravel. Cukup paham bedanya method GET dan POST
//   buat endpoint. Saya coba bikin beberapa route sederhana dulu buat latihan."

// --- ATURAN #2: CARA MENULIS TITLE ---
// - Gunakan bahasa Indonesia yang baik dan profesional
// - Judul HARUS SPESIFIK dan DESKRIPTIF (bukan generik seperti "Bekerja" atau "Meeting")
// - Maksimal 10 kata
// - Hindari kata-kata yang terlalu teknis jika tidak perlu
// - Fokus pada KEGIATAN yang dilakukan, bukan hasil
// - JANGAN pakai em dash (—) dalam title
//
// Contoh transformasi:
//   "coding" → "Implementasi Fitur Login pada Aplikasi Web"
//   "meeting" → "Diskusi Progres Project dengan Tim Backend"
//   "belajar" → "Mempelajari Framework React untuk Dashboard Admin"
//
// ❌ BURUK:  "Coding", "Kerja", "Meeting", "Belajar"
// ✅ BAIK:   "Implementasi Payment Gateway Midtrans di Halaman Checkout"
// ✅ BAIK:   "Optimasi Performa Halaman Produk dengan React.memo & Lazy Loading"
// ✅ BAIK:   "Debugging Error 500 pada API Endpoint Produk"
// ✅ BAIK:   "Setup Database PostgreSQL dan Konfigurasi Prisma ORM"

// --- ATURAN #3: CARA MENULIS DESCRIPTION ---
// - Tulis dalam bentuk PARAGRAF natural, bukan poin-poin atau format narasi AI
// - Gunakan bahasa Indonesia yang SANTAL PROFESIONAL — seperti mahasiswa nulis diary kerja
// - Jelaskan: APA yang dikerjakan → BAGAIMANA prosesnya → KENDALA yang dihadapi →
//   HASIL yang dicapai
// - Panjang 100-200 kata per deskripsi
// - Awali dengan gambaran singkat hari ini ngapain
// - Ceritakan prosesnya: mulai dari mana, nemu masalah apa, gimana nyelesainnya
// - Sebut tools/teknologi yang dipake secara NATURAL (bukan di-force atau di-list)
// - Akhiri dengan hasil atau kesan hari ini
// - JANGAN format poin/listing atau nge-list pake titik dua
// - JANGAN PERNAH pakai em dash (—) dalam teks description
//
// CONTOH DESCRIPTION YANG BAGUS:
//   "Hari ini saya lanjut ngerjain fitur manajemen user yang kemarin sempat
//   terhenti. Saya mulai dengan bikin halaman daftar user pake DataTables biar
//   bisa sorting dan search. Cukup rumit juga ternyata soalnya harus nyambungin
//   ke endpoint API yang udah ada. Sempat bingung soal pagination, tapi setelah
//   baca dokumentasi akhirnya bisa. Saya juga nambahin fitur edit profile biar
//   user bisa ganti data mereka sendiri. Lumayan puas sama hasil hari ini,
//   meskipun masih ada beberapa bug kecil yang belum kehandle."

// --- ATURAN #4: VARIASI AKTIVITAS ---
// Jangan monoton. Campur kegiatannya:
//   - Coding / implementasi fitur
//   - Meeting / diskusi dengan tim
//   - Belajar / research / eksplorasi codebase
//   - Testing / debugging / bug fixing
//   - Code review
//   - Dokumentasi
//   - Deployment / CI/CD setup

// --- ATURAN #5: PROGRES PER MINGGU (BIAR KELIATAN REAL) ---
// - Minggu awal (1-2): onboarding, baca dokumentasi, setup project, belajar codebase
// - Minggu tengah (3-6): mulai coding, implementasi fitur, diskusi sama tim
// - Minggu akhir (7-8+): testing, bug fixing, persiapan deployment, dokumentasi

// --- ATURAN #6: SCREENSHOT GUIDANCE (WAJIB SPESIFIK PER HARI) ---
// Setiap entry WAJIB punya field screenshotGuidance dengan 2 opsi:
// buktiFisik dan onlineRemote. Instruksi harus SPESIFIK sesuai aktivitas
// hari itu — BUKAN template copy-paste.
//
// RULE PALING KERAS:
// - APA YANG DISURUH SCREENSHOT HARUS ADA di deskripsi kegiatan
// - Misal deskripsi bilang "bikin halaman login", maka onlineRemote harus
//   nyuruh screenshot halaman login, URL /login, kode login — BUKAN nyuruh
//   screenshot dashboard
// - Jika deskripsi bilang "testing API pake Postman", onlineRemote harus
//   nyuruh screenshot Postman dengan endpoint spesifik dan response
// - JANGAN PERNAH nyuruh screenshot sesuatu yang tidak disebut di deskripsi
// - SETIAP HARI instruksi HARUS BERBEDA sesuai aktivitas hari itu
// - TIDAK BOLEH ada 2 hari dengan instruksi yang sama persis
//
// BUKTI FISIK:
//   - Posisi/sudut kamera: dari mana motretnya (depan monitor, samping, dll)
//   - Apa yang harus terlihat di layar monitor saat difoto
//   - Pastikan waktu/jam di taskbar atau jam tangan ikut terlihat
//   - Contoh: "Ambil foto dari arah depan meja kerja. Monitor menampilkan VS
//     Code dengan file UserController.php terbuka. Pastikan jam di taskbar
//     pojok kanan bawah ikut terfoto sebagai bukti waktu."
//
// ONLINE REMOTE — pilih salah satu mode yang sesuai aktivitas:
//
//   Mode Halaman Web:
//   - URL lengkap halaman yang harus dibuka (http://localhost:3000/admin/...)
//   - Bagian mana dari halaman yang difokuskan (form, tabel, modal, alert)
//   - Kondisi/data apa yang harus sudah tampil di halaman
//
//   Mode Postman/API:
//   - Method HTTP (GET/POST/PUT/DELETE)
//   - Endpoint URL lengkap
//   - Request body / headers yang dikirim
//   - Response yang diharapkan (status code, body)
//
//   Mode Code Editor:
//   - Nama file lengkap beserta path (app/Http/Controllers/UserController.php)
//   - Bagian kode spesifik yang jadi fokus (fungsi store() baris 25-45)
//   - Sidebar editor sebaiknya terlihat
//
//   Mode Terminal:
//   - Perintah/command yang dijalankan
//   - Output yang dihasilkan
//
//   Mode Dokumentasi:
//   - Nama file dokumen atau link
//   - Bagian spesifik dari dokumen yang relevan

// --- ATURAN #7: BAHASA ---
// - Bahasa Indonesia yang baik, santai profesional
// - Kayak nulis diary kantoran

// --- ATURAN #8: LARANGAN EM DASH (—) — WAJIB 100% (CRITICAL) ---
// EM DASH (—, Unicode U+2014, Alt+0151) DILARANG KERAS di SELURUH
// teks output — tidak boleh muncul SATU KALI PUN di file JSON.
//
// Field yang WAJIB BEBAS dari karakter — (U+2014):
//   - title
//   - description
//   - screenshotGuidance.buktiFisik.instruksi
//   - screenshotGuidance.onlineRemote.instruksi
//   - screenshotGuidance.onlineRemote.target
//
// JANGAN GUNAKAN TANDA PISAH PANJANG SAMA SEKALI.
// Gunakan alternatif berikut sebagai pengganti:
//   - Titik (.) lalu spasi dan kalimat baru
//   - Koma (,) untuk pemisah klausa
//   - Tanda hubung pendek (-) untuk range/rentang (contoh: "10-15 menit")
//   - Tanda kurung (...) untuk keterangan tambahan
//
// SEBELUM FINAL OUTPUT, LAKUKAN SELF-CHECK:
//   Cari karakter "—" di seluruh JSON yang akan kamu output.
//   Jika ketemu SATU SAJA → HARUS DIGANTI sebelum output difinalisasi.
//   Ini NON-NEGOTIABLE. Output yang mengandung "—" = OTOMATIS DITOLAK.
//
// ❌ SALAH:   "Saya bikin fitur login — tapi masih ada bug."
// ✅ BENAR:   "Saya bikin fitur login, tapi masih ada bug."
// ❌ SALAH:   "Halaman dashboard — yang menampilkan grafik — sudah jadi."
// ✅ BENAR:   "Halaman dashboard yang menampilkan grafik sudah jadi."
// ❌ SALAH:   "Saya coba pake library baru — ternyata dokumentasinya kurang."
// ✅ BENAR:   "Saya coba pake library baru, ternyata dokumentasinya kurang."

// ================================================================
// INTERFACE & FORMAT OUTPUT
// ================================================================

/**
 * Interface untuk SATU entri kegiatan logbook.
 * AI agent WAJIB mengisi semua field REQUIRED.
 */
export interface LogbookActivitySeed {
  /** [REQUIRED]
   *  Judul kegiatan. Lihat ATURAN #2 dan ATURAN #8.
   *  Maksimal 10 kata, spesifik, fokus pada KEGIATAN, BEBAS em dash.
   *  JANGAN: "Coding", "Kerja", "Meeting"
   *  LAKUKAN: "Implementasi Fitur Login dengan NextAuth.js" */
  title: string

  /** [REQUIRED]
   *  Tanggal kegiatan — format STRICT: "YYYY-MM-DD"
   *  Contoh: "2026-06-15"
   *  Hanya hari Senin—Sabtu (Minggu libur). */
  activityDate: string

  /** [REQUIRED]
   *  Durasi kegiatan dalam MENIT (integer positif).
   *  480 = 8 jam (sehari penuh)  |  360 = 6 jam
   *  240 = 4 jam                 |  120 = 2 jam
   *  60  = 1 jam
   *  Total per hari sebaiknya ~480 menit (8 jam kerja). */
  durationMinutes: number

  /** [REQUIRED]
   *  Deskripsi kegiatan. Lihat ATURAN #3 dan ATURAN #8.
   *  HARUS: 100-200 kata, natural, cerita dari sisi DOING.
   *  DILARANG KERAS: format poin, analisis teknis, jumlah baris
   *  file, em dash, "mengidentifikasi", "menganalisis". */
  description: string

  /** [REQUIRED]
   *  Panduan screenshot bukti kegiatan. Lihat ATURAN #6 dan ATURAN #8.
   *  HARUS spesifik per hari, tidak boleh copy-paste antar hari.
   *  SEMUA field instruksi & target HARUS BEBAS em dash. */
  screenshotGuidance: {
    buktiFisik: {
      instruksi: string
    }
    onlineRemote: {
      instruksi: string
      target: string
    }
  }
}

// ================================================================
// FORMAT OUTPUT — AI agent harus menghasilkan JSON SEPERTI INI:
// ================================================================
//
// Simpan sebagai: logbook-activities.json
//
// PERHATIKAN: Contoh di bawah ini sudah menerapkan gaya penulisan
// natural sesuai ATURAN #3 (description menggunakan bahasa santai
// profesional, cerita dari sisi DOING, bukan analisis teknis).
//
// [
//   {
//     "title": "Setup Development Environment Viviashop",
//     "activityDate": "2026-06-01",
//     "durationMinutes": 480,
//     "description": "Hari pertama magang, saya fokus setup environment development dulu. Mulai dari install Node.js versi 20 LTS, PostgreSQL 16, sama Redis 7 di laptop. Lumayan lama juga proses instalasinya. Setelah itu saya clone repository viviashop dari GitHub dan setup environment variablesnya. Sempat bingung juga waktu setup docker-compose soalnya ada beberapa service yang conflict port. Akhirnya setelah ngulik lumayan lama, semua service berhasil jalan. Saya juga install extension VS Code yang diperlukan kayak ESLint, Prettier, sama Prisma. Besok rencananya mau mulai baca-baca dokumentasi projectnya.",
//     "screenshotGuidance": {
//       "buktiFisik": {
//         "instruksi": "Ambil foto dari depan meja kerja. Monitor menampilkan VS Code dengan folder project viviashop terbuka dan terminal yang menunjukkan semua service Docker berjalan (docker ps). Pastikan jam di taskbar terlihat."
//       },
//       "onlineRemote": {
//         "instruksi": "Buka terminal di VS Code, jalankan perintah 'docker ps' dan 'npm run dev'. Screenshot seluruh jendela terminal yang menampilkan container Docker yang running dan output dev server Next.js yang menunjukkan 'ready started server'. Pastikan path folder project terlihat.",
//         "target": "Terminal VS Code - docker ps & npm run dev"
//       }
//     }
//   },
//   {
//     "title": "Eksplorasi Codebase dan Arsitektur Viviashop",
//     "activityDate": "2026-06-02",
//     "durationMinutes": 360,
//     "description": "Hari ini saya mulai baca-baca dokumentasi dan eksplorasi codebase viviashop. Cukup banyak juga ternyata yang harus dipelajari. Saya coba pahami struktur foldernya dulu, terus lanjut liat gimana alur data dari frontend ke backend. Agak pusing juga di awal soalnya ini proyek cukup besar, tapi setelah beberapa jam mulai kebayang alurnya. Saya catat beberapa hal penting yang perlu dipahami lebih dalem buat besok. Siangnya saya diskusi sama mentor buat nanya beberapa hal yang masih bikin bingung.",
//     "screenshotGuidance": {
//       "buktiFisik": {
//         "instruksi": "Ambil foto dari depan meja kerja. Monitor menampilkan VS Code dengan folder structure viviashop di sidebar kiri dan salah satu file kode yang sedang dibaca di panel utama. Pastikan jam di taskbar terlihat."
//       },
//       "onlineRemote": {
//         "instruksi": "Buka VS Code dengan folder project viviashop. Buka file README.md atau dokumentasi arsitektur project. Screenshot seluruh jendela VS Code yang menampilkan struktur folder di sidebar dan isi dokumentasi di panel utama. Pastikan file tab keliatan.",
//         "target": "VS Code - Struktur Folder & Dokumentasi Viviashop"
//       }
//     }
//   },
//   {
//     "title": "Implementasi Halaman Produk Detail",
//     "activityDate": "2026-06-03",
//     "durationMinutes": 480,
//     "description": "Hari ini saya mulai bikin halaman detail produk. Mulai dari bikin layout dasarnya dulu, terus nambahin image gallery pake library react-image-gallery. Cukup tricky juga ternyata setting carouselnya biar responsif di mobile. Lanjut bikin variant selector buat ukuran sama warna produk, pakai React state management buat handle perubahan variant. Sorenya saya integrasiin sama API backend buat ambil data produk real. Sempat error 500 gara-gara field yang missing di response, tapi setelah debugging ketemu dan langsung saya benerin. Hasilnya halaman udah bisa nampilin data produk lengkap dengan gallery dan variant selector, meskipun masih perlu refinement buat bagian loading state dan error handlingnya.",
//     "screenshotGuidance": {
//       "buktiFisik": {
//         "instruksi": "Ambil foto dari depan meja kerja. Monitor menampilkan VS Code dengan file halaman detail produk terbuka. Pastikan jam di taskbar terlihat."
//       },
//       "onlineRemote": {
//         "instruksi": "Buka browser ke http://localhost:3000/products/[id]. Screenshot seluruh halaman detail produk yang menampilkan image gallery, variant selector (ukuran dan warna), quantity input, dan tombol Add to Cart. Pastikan URL bar keliatan di screenshot.",
//         "target": "http://localhost:3000/products/[id]"
//       }
//     }
//   }
// ]
//
// ================================================================
// VALIDASI — pastikan data JSON yang dihasilkan memenuhi:
// ================================================================
// - Setiap object punya field: title, activityDate, durationMinutes,
//   description, screenshotGuidance (dengan buktiFisik & onlineRemote)
// - activityDate format YYYY-MM-DD (string, bukan Date object)
// - durationMinutes integer > 0
// - Tidak ada duplikasi title + activityDate yang sama
// - Total entri mencerminkan periode magang (misal 60 hari kerja =
//   minimal 60 entri, 1 entry per hari dengan total ~480 menit)
// - Setiap hari (kecuali Minggu & hari libur nasional yang sudah
//   di-skip) harus punya entry
// - Description TIDAK BOLEH mengandung: jumlah baris file, daftar
//   file/class teknis, format poin/listing, kata "mengidentifikasi",
//   "menganalisis", "ditemukan bahwa", atau em dash (—)
// - SEMUA field teks (title, description, screenshotGuidance.*.instruksi,
//   screenshotGuidance.*.target) WAJIB BEBAS dari karakter em dash (—)
//   — cek ATURAN #8, ini non-negotiable
// - Screenshot guidance harus berbeda untuk setiap hari (tidak boleh
//   ada copy-paste instruksi yang sama antar hari)
// - Semua teknologi/fitur yang disebut di description harus BENAR-BENAR
//   ADA di codebase viviashop (cek ATURAN #0)
//
// ================================================================
// SELF-VALIDATION CHECKLIST (LAKUKAN SEBELUM FINAL OUTPUT):
// ================================================================
// Sebelum menulis file JSON final, scan seluruh output dan pastikan:
// □ Tidak ada karakter "—" (U+2014) di field teks mana pun
// □ Setiap description 100-200 kata, natural, gaya "saya ngerjain..."
// □ Setiap title maksimal 10 kata, spesifik
// □ Tidak ada sebutan jumlah baris file
// □ Tidak ada format poin/listing dalam description
// □ Tidak ada kalimat "saya mengidentifikasi", "saya menganalisis"
// □ Screenshot guidance spesifik dan berbeda untuk setiap hari
// □ Semua teknologi yang disebut ada di codebase viviashop
// □ durationMinutes = 480 untuk setiap entry (konsisten)
