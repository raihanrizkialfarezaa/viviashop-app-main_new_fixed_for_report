# Generate Logbook Activities JSON — VIVIASHOP

> **File output:** `logbook-activities.json`
> **Prasyarat:** File `templates/logbook-activity-seed.ts` harus ada di direktori project ini.
>
> **Cara pakai:** Copy SELURUH isi file ini sebagai prompt ke AI agent di direktori project viviashop. AI akan menjalankan semua langkah di bawah secara berurutan.

---

## TUGAS

Generate file `logbook-activities.json` untuk periode magang viviashop berdasarkan template `logbook-activity-seed.ts`.

---

## LANGKAH WAJIB

Lakukan **berurutan dari [1] ke [6]**. Jangan skip satu langkah pun.

### [1] BACA & PAHAMI TEMPLATE

Buka file `templates/logbook-activity-seed.ts`. Baca **SELURUH isinya** — dari ATURAN #0 sampai SELF-VALIDATION CHECKLIST. Tidak boleh ada satu aturan pun yang terlewat. Jika tidak paham satu aturan, baca ulang sampai paham.

### [2] EKSPLORASI CODEBASE VIVIASHOP (CONTEXT GATHERING)

Jelajahi **SELURUH** direktori project ini. Baca file penting:

- `package.json`, `README.md`, `tsconfig.json`, `next.config.*`
- `prisma/schema.prisma`, semua folder `src/`
- API routes, components, hooks, lib, utils, services
- File konfigurasi, environment, middleware, semuanya

**Catat secara teliti:**

| Kategori | Hal yang dicatat |
|---|---|
| Stack teknologi | Framework, database, ORM, auth provider, UI library |
| Fitur yang SUDAH ADA | Halaman, API endpoint, komponen, integrasi third-party |
| Pola arsitektur | Monorepo? Microservices? Folder structure? |
| Alur bisnis utama | User flow dari halaman A ke B ke C |
| Library eksternal | Payment, shipping, upload, AI, email, analytics, dll |

> ⚠️ **ATURAN #0:** Data dari langkah ini adalah **SATU-SATUNYA sumber kebenaran**. Semua yang ditulis di logbook HARUS bisa diverifikasi ADA di codebase ini. JANGAN mengarang teknologi atau fitur yang tidak ada.

### [3] TENTUKAN PERIODE

```
Periode magang: YYYY-MM-DD sampai YYYY-MM-DD
Hanya hari Senin—Sabtu. Minggu dilewati.
Hari libur nasional di dalam periode tetap dibuatkan entry (remote/WFA).
Total hari kerja: ___ hari
```

> **User wajib mengisi tanggal mulai, tanggal selesai, dan jumlah hari kerja di atas sebelum prompt dijalankan.**

### [4] GENERATE ENTRIES

Untuk **SETIAP hari kerja**, buat **1 entry** dengan durasi tepat **480 menit** (8 jam).

Gunakan data dari langkah [2] untuk mengisi:

| Field | Aturan |
|---|---|
| `title` | Spesifik, maks 10 kata. Fokus pada KEGIATAN. Ikuti ATURAN #2. |
| `activityDate` | Format `YYYY-MM-DD`. Hanya Senin—Sabtu. |
| `durationMinutes` | Selalu `480` (8 jam penuh). |
| `description` | 100-200 kata. Gaya natural "saya ngerjain...". Cerita dari sisi DOING, bukan ANALYZING. Ikuti ATURAN #1 dan #3. |
| `screenshotGuidance` | Spesifik per hari, berbeda setiap hari. Sesuai aktivitas di description. Ikuti ATURAN #6. |

**Progres per minggu (ATURAN #5):**

| Minggu | Fokus kegiatan |
|---|---|
| 1–2 | Onboarding, setup environment, baca dokumentasi, belajar codebase |
| 3–6 | Coding fitur, implementasi, diskusi dengan tim |
| 7+ | Testing, bug fixing, persiapan deployment, dokumentasi |

**Variasi aktivitas (ATURAN #4):** Campur coding, meeting, belajar, testing, debugging, dokumentasi. Jangan monoton coding terus setiap hari.

### [5] SELF-VALIDATION ⚠️ WAJIB

**Lakukan SEBELUM menulis file.** Scan SELURUH JSON output dan periksa SATU PER SATU:

```
□ Tidak ada karakter "—" (U+2014, em dash) di field teks mana pun
□ Setiap description 100-200 kata, gaya natural "saya ngerjain..."
□ Setiap title maks 10 kata, spesifik, bukan generik ("Coding", "Meeting")
□ Tidak ada jumlah baris file dalam description
□ Tidak ada format poin/listing dalam description
□ Tidak ada "mengidentifikasi", "menganalisis", "ditemukan bahwa"
□ Tidak ada nge-list fitur kayak katalog ("aplikasi ini punya fitur: A, B, C")
□ Screenshot guidance berbeda untuk setiap hari (tidak boleh copy-paste)
□ Semua teknologi/fitur yang disebut ADA di codebase (cek ATURAN #0)
□ Semua activityDate format YYYY-MM-DD, tidak ada hari Minggu
□ Setiap entry durationMinutes = 480 (konsisten)
□ Total jumlah entry = total hari kerja dalam periode
```

> 🔴 **Jika ada SATU checklist yang gagal, PERBAIKI dulu. Jangan lanjut ke langkah [6] sebelum semua checklist terpenuhi 100%.**

### [6] TULIS FILE

```
Nama file: logbook-activities.json
Format: JSON array of LogbookActivitySeed objects
Aturan: HANYA tulis JSON — tanpa markdown, tanpa teks lain
        JSON harus valid, bisa langsung di-parse dengan JSON.parse()
```

---

## ATURAN PALING KERAS (NON-NEGOTIABLE)

1. **ATURAN #0** — Jangan mengarang. Semua harus ada di codebase viviashop.
2. **ATURAN #1** — Gaya penulisan manusiawi. Jangan kaya laporan teknis AI.
3. **ATURAN #8** — **NOL em dash (—)** di seluruh output. Jika ketemu satu saja, otomatis DITOLAK.

---

## CONTOH OUTPUT YANG BENAR

```json
[
  {
    "title": "Setup Development Environment Viviashop",
    "activityDate": "2026-06-01",
    "durationMinutes": 480,
    "description": "Hari pertama magang, saya fokus setup environment development dulu. Mulai dari install Node.js versi 20 LTS, PostgreSQL 16, sama Redis 7 di laptop. Lumayan lama juga proses instalasinya. Setelah itu saya clone repository viviashop dari GitHub dan setup environment variablesnya. Sempat bingung juga waktu setup docker-compose soalnya ada beberapa service yang conflict port. Akhirnya setelah ngulik lumayan lama, semua service berhasil jalan. Saya juga install extension VS Code yang diperlukan kayak ESLint, Prettier, sama Prisma. Besok rencananya mau mulai baca-baca dokumentasi projectnya.",
    "screenshotGuidance": {
      "buktiFisik": {
        "instruksi": "Ambil foto dari depan meja kerja. Monitor menampilkan VS Code dengan folder project viviashop terbuka dan terminal yang menunjukkan semua service Docker berjalan (docker ps). Pastikan jam di taskbar terlihat."
      },
      "onlineRemote": {
        "instruksi": "Buka terminal di VS Code, jalankan perintah 'docker ps' dan 'npm run dev'. Screenshot seluruh jendela terminal yang menampilkan container Docker yang running dan output dev server Next.js yang menunjukkan 'ready started server'. Pastikan path folder project terlihat.",
        "target": "Terminal VS Code - docker ps & npm run dev"
      }
    }
  }
]
```

> Perhatikan: description bergaya natural seperti mahasiswa nulis diary kerja. Tidak ada analisis teknis, tidak ada jumlah baris file, tidak ada em dash. Screenshot guidance spesifik sesuai aktivitas hari itu.
