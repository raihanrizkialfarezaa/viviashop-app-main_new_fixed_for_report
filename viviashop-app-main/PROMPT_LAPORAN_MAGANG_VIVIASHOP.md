# PROMPT: PEMBUATAN LAPORAN AKHIR MOBILITAS AKADEMIK MAGANG
# Viviashop — Universitas Negeri Surabaya (UNESA)
# Versi 3.0 — Sinkronisasi Penuh dengan Template Resmi UNESA
# ============================================================
# CARA PAKAI:
# Copy seluruh isi prompt ini dan paste ke AI agent (OpenCode, Cursor, dsb.)
# Pastikan working directory agent sudah di-set ke root folder viviashop-app-main
# ============================================================

---

## FASE 0 — INISIALISASI & LARANGAN KERAS

Kamu adalah mahasiswa yang sedang menulis laporan akhir magang dari nol berdasarkan project nyata yang kamu kerjakan. **Kamu dilarang mengarang, mengasumsikan, atau menulis klaim apapun yang tidak bisa dibuktikan langsung dari file di project ini.**

Sebelum menulis satu kata pun di laporan, kamu WAJIB menyelesaikan semua fase di bawah secara berurutan. Jangan skip fase apapun. Setiap kali kamu menemukan fakta penting, catat di "FACT SHEET" yang kamu kelola sendiri selama proses ini.

Laporan yang akan dibuat mengikuti **template resmi UNESA 7 Bab**. Struktur ini tidak boleh diubah, dikurangi, atau ditambah tanpa alasan yang jelas dari template.

---

## FASE 0.5 — BACA DATA ADMINISTRASI LAPORAN

Baca file `report-administration-data.json` yang ada di root project. File ini berisi data resmi yang sudah dikonfirmasi mahasiswa. Gunakan data ini untuk mengisi semua field identitas di laporan — **JANGAN gunakan placeholder untuk field yang sudah ada nilainya di file ini.**

### Mapping field ke laporan:

| Field di JSON | Digunakan untuk |
|---|---|
| `form.namaLengkap` | Nama penulis laporan |
| `form.nim` | NIM mahasiswa |
| `form.prodi` | Program studi |
| `form.fakultas` | Fakultas |
| `form.noTelepon` | Nomor telepon |
| `form.email` | Email mahasiswa |
| `form.alamat` | Alamat mahasiswa |
| `form.namaInstansi` | Nama resmi mitra (CV Sinar Agung Jaya) |
| `form.alamatInstansi` | Alamat mitra |
| `form.deskripsiInstansi` | Dasar penulisan BAB II sub-bab 2.1 |
| `form.periodeMagang` | Periode magang — tulis persis: "26 Januari 2026 s/d 1 Juni 2026" |
| `form.judulProyek` | Judul proyek resmi |
| `form.namaDosenPembimbing` | Nama dosen pembimbing lapangan |
| `form.nipDosenPembimbing` | NIP dosen pembimbing |
| `form.namaPembimbingMitra` | Nama pembimbing dari mitra |
| `form.namaKoordinatorProdi` | Nama koordinator prodi |
| `form.nipKoordinatorProdi` | NIP koordinator prodi |
| `form.tahun` | Tahun laporan |
| `mataKuliahKonversi` | Panduan penulisan BAB IV sub-bab 4.4 |

### Field yang tetap kosong (sudah dikonfirmasi tidak tersedia):
- `form.identitasPembimbingMitra` — pembimbing mitra tidak memiliki NIP/jabatan formal. Pada lembar pengesahan, kolom ini **dikosongkan** (tidak perlu placeholder teks).

### Field yang diabaikan:
- `form.aiProvider` — metadata internal aplikasi, tidak dimasukkan ke laporan dalam bentuk apapun.
- `nilai` pada mata kuliah — belum tersedia, abaikan.

### PENTING — Hierarki Entitas:
> **CV Sinar Agung Jaya** adalah nama instansi/perusahaan resmi tempat magang (induk).
> **Viviashop** adalah nama platform e-commerce dan nama project yang dikembangkan di dalam instansi tersebut.
>
> Aturan penggunaan:
> - Konteks **formal** (lembar pengesahan, nama mitra, profil instansi, surat) → gunakan **"CV Sinar Agung Jaya"**
> - Konteks **teknis** (nama sistem, nama aplikasi, nama project, deskripsi fitur, tech stack) → gunakan **"Viviashop"**
> - Jangan mencampurkan keduanya dalam satu kalimat tanpa penjelasan relasi.

---

## FASE 1 — PEMETAAN STRUKTUR PROJECT

Jalankan perintah berikut **satu per satu**, baca outputnya, baru lanjut ke perintah berikutnya:

```bash
# 1. Lihat keseluruhan struktur project
find . -maxdepth 3 -not -path '*/node_modules/*' -not -path '*/.git/*' -not -path '*/vendor/*' -not -path '*/.next/*' -not -path '*/dist/*' | sort

# 2. Identifikasi jenis project
cat package.json 2>/dev/null || cat composer.json 2>/dev/null || echo "Tidak ada package.json / composer.json di root"

# 3. Cek subfolder dengan package/composer sendiri
find . -maxdepth 2 -name "package.json" -not -path '*/node_modules/*' | head -20
find . -maxdepth 2 -name "composer.json" -not -path '*/vendor/*' | head -20

# 4. Cek konfigurasi sistem
cat .env.example 2>/dev/null || cat .env 2>/dev/null || echo "Tidak ada .env.example"
```

Catat ke FACT SHEET:
- [ ] Tech stack utama (framework, bahasa, database, versi eksak jika ada)
- [ ] Nama project resmi
- [ ] Jenis aplikasi (web app, mobile, API, e-commerce, dsb.)

---

## FASE 2 — BACA SEMUA DOKUMENTASI YANG ADA

```bash
# Temukan semua file dokumentasi
find . -name "*.md" -not -path '*/node_modules/*' -not -path '*/.git/*' | sort
find . -name "*.txt" -not -path '*/node_modules/*' | grep -i "doc\|readme\|panduan\|manual\|log" | head -20
```

Kemudian baca satu per satu — **jangan skip satupun**:
```bash
cat [nama_file.md]
```

Dari setiap file dokumentasi, ekstrak dan catat ke FACT SHEET:
- [ ] Deskripsi project / tujuan project
- [ ] Fitur-fitur yang disebutkan secara eksplisit
- [ ] Teknologi yang disebutkan
- [ ] Nama-nama entitas: user, admin, seller, buyer, dsb.
- [ ] Tantangan atau kendala yang disebutkan
- [ ] Proses pengembangan yang didokumentasikan
- [ ] Profil perusahaan/mitra jika ada (nama resmi, bidang usaha, visi/misi)

---

## FASE 3 — AUDIT KODE SUMBER

### 3a. Backend / API Layer
```bash
# Jika Laravel
ls app/Http/Controllers/ 2>/dev/null
ls app/Models/ 2>/dev/null
ls routes/ 2>/dev/null && cat routes/web.php routes/api.php 2>/dev/null | head -200

# Jika Next.js / Node
ls src/app/ 2>/dev/null || ls pages/ 2>/dev/null || ls app/ 2>/dev/null
find . -name "*.ts" -o -name "*.tsx" | grep -v node_modules | head -50

# Jika ada Prisma
cat prisma/schema.prisma 2>/dev/null | head -300
```

Catat ke FACT SHEET:
- [ ] Daftar controller/handler (nama PERSIS dari ls, bukan asumsi)
- [ ] Daftar model/entity (nama PERSIS)
- [ ] Daftar route/endpoint utama
- [ ] Skema database (tabel-tabel yang ada)

### 3b. Frontend / UI Layer
```bash
ls resources/views/ 2>/dev/null
ls src/components/ 2>/dev/null || ls components/ 2>/dev/null
ls src/app/ 2>/dev/null
find . -name "*.blade.php" -not -path '*/vendor/*' | head -30 2>/dev/null
find . -name "page.tsx" -o -name "page.jsx" 2>/dev/null | grep -v node_modules | head -20
```

Catat ke FACT SHEET:
- [ ] Halaman-halaman utama yang ada
- [ ] Alur navigasi yang bisa diidentifikasi
- [ ] Komponen UI yang signifikan

### 3c. Fitur Spesifik
```bash
# Autentikasi
grep -r "auth\|login\|register\|jwt\|session" --include="*.php" --include="*.ts" --include="*.tsx" -l 2>/dev/null | grep -v node_modules | head -20

# Payment / transaksi
grep -r "payment\|midtrans\|stripe\|order\|checkout\|cart" --include="*.php" --include="*.ts" --include="*.tsx" -l 2>/dev/null | grep -v node_modules | head -20

# Upload / media
grep -r "upload\|storage\|image\|file" --include="*.php" --include="*.ts" --include="*.tsx" -l 2>/dev/null | grep -v node_modules | head -20

# Integrasi API eksternal
grep -r "axios\|fetch\|http\|curl\|guzzle" --include="*.php" --include="*.ts" --include="*.tsx" -l 2>/dev/null | grep -v node_modules | head -20
```

Buka file-file yang ditemukan dan baca kontennya untuk memahami implementasi nyata. Catat nama file sumber untuk setiap fitur.

---

## FASE 4 — SUSUN FACT SHEET FINAL

Tampilkan FACT SHEET berikut sebelum menulis laporan:

```
========== FACT SHEET VIVIASHOP ==========

IDENTITAS PROJECT:
- Nama project: [dari file nyata]
- Nama perusahaan/mitra resmi: [dari dokumentasi]
- Bidang usaha mitra: [dari dokumentasi]
- Jenis aplikasi: [dari file nyata]
- Tech stack: [dari package.json / composer.json]
- Framework utama: [versi eksak jika ada]
- Database: [dari .env.example / prisma schema / config]

ENTITAS / MODULE YANG ADA (dari kode nyata):
- Model/Entity: [list dari folder Models / Prisma schema]
- Controller/Handler: [list dari folder Controllers / route handlers]
- Halaman utama: [list dari views / pages]

FITUR YANG TERIDENTIFIKASI (dengan sumber file):
1. [Nama fitur] — ditemukan di: [nama_file.ts/php]
2. [Nama fitur] — ditemukan di: [nama_file.ts/php]
... dst

INTEGRASI EKSTERNAL (dengan sumber file):
- [Nama layanan] — ditemukan di: [nama_file]

TANTANGAN / KENDALA (dari dokumentasi):
- [Kutip langsung dari file dokumentasi jika ada]

MATA KULIAH YANG RELEVAN (perlu konfirmasi manual dari mahasiswa):
- [PERLU INPUT MANUAL — daftar mata kuliah yang dikonversi dari magang ini]

INFORMASI YANG TIDAK DITEMUKAN DI KODE / DOKUMENTASI:
- [List hal yang tidak bisa diverifikasi — wajib dikosongkan atau ditandai]

==========================================
```

**STOP DI SINI.** Tampilkan FACT SHEET dulu dan minta konfirmasi. Jangan lanjut menulis laporan sebelum FACT SHEET dikonfirmasi benar.

---

## FASE 5 — PENULISAN LAPORAN

Setelah FACT SHEET dikonfirmasi, tulis laporan mengikuti **struktur 7 bab resmi** berikut secara PERSIS. Jangan tambah, kurangi, atau mengubah urutan bab dan sub-bab.

---

### STRUKTUR LAPORAN LENGKAP (7 BAB)

#### HALAMAN JUDUL
Tulis: Judul kegiatan yang telah dikembangkan, nama instansi magang, nama penyusun, universitas, fakultas, program studi, tahun.
→ Gunakan placeholder: `[JUDUL KEGIATAN]`, `[NAMA MAHASISWA]`, `[NIM]`, `[PRODI]`, `[FAKULTAS]`, `[TAHUN]`

#### LEMBAR PENGESAHAN
Wajib ada:
- Judul kegiatan
- Nama instansi & alamat instansi
- Identitas mahasiswa: Nama, NIM, Prodi/Jurusan, Fakultas, No. Tlp, Alamat, Email
- Periode magang
- Tanda tangan: Dosen Pembimbing Lapangan, Mahasiswa, Pembimbing Mitra, Koordinator Program Studi
→ Semua yang tidak diketahui: gunakan placeholder eksplisit seperti `[NAMA DOSEN PEMBIMBING]`, `[NIP]`, `[TANGGAL]`, dll.

#### DAFTAR ISI
Format tabel dua kolom (judul | nomor halaman). Konten tidak ditebalkan (non-bold), tanpa before/after space. Isi sesuai bab yang ada.

#### DAFTAR TABEL
Nomor tabel tidak di-bold, tanpa before/after space.
→ Tandai: `[DAFTAR TABEL — diisi setelah laporan selesai]`

#### DAFTAR GAMBAR
Nomor gambar tidak di-bold, tanpa before/after space.
→ Tandai: `[DAFTAR GAMBAR — diisi setelah laporan selesai]`

---

#### BAB I — PENDAHULUAN

##### 1.1 Latar Belakang
Wajib mencakup semua elemen berikut (berurutan):
1. **Peran strategis magang** dalam peningkatan kualitas lulusan dan kurikulum pendidikan tinggi — hubungkan dengan: peningkatan kompetensi praktis, menjembatani teori-praktik, pengalaman kerja nyata
2. **Kaitan dengan kebutuhan dunia kerja** — lulusan siap kerja, berdaya saing tinggi
3. **Nilai tambah magang berdampak** — bukan sekadar pengalaman, tapi berkontribusi ke mitra dan mendukung SDGs (sebutkan nomor SDGs yang relevan)
4. **Proyeksi industri** yang dijadikan lokasi magang — relevansi bidang industri ini di masa depan, kaitkan dengan isu strategis (revolusi industri 4.0, digitalisasi, ekonomi kreatif, dsb.), tambahkan data/tren bila ada
5. **Profil lokasi magang yang dipilih** — nama perusahaan (dari FACT SHEET), alasan pemilihan (keunggulan kompetitif, relevansi dengan prodi, ruang belajar nyata), perkuat dengan data capaian institusi jika tersedia
6. **Dampak yang diharapkan** — kontribusi nyata dan terukur: transfer pengetahuan, inovasi mini proyek, perbaikan proses kerja, dokumentasi best practices; sebutkan indikator keberhasilan dan alat ukur (logbook, survei, laporan harian)

##### 1.2 Rumusan Masalah
Rumuskan pertanyaan-pertanyaan penelitian/magang yang akan dijawab melalui pelaksanaan magang ini. Pertanyaan harus spesifik dan berkaitan dengan konteks project nyata (dari FACT SHEET). Contoh pola:
- Bagaimana proses [aspek kerja tertentu] di [nama mitra] saat ini, dan apa permasalahan yang dihadapi?
- Solusi atau fitur apa yang dapat dikembangkan untuk mengatasi permasalahan tersebut?
- Bagaimana dampak implementasi solusi tersebut terhadap [indikator tertentu] di lingkungan mitra?

##### 1.3 Tujuan Magang
Susun dalam dua kelompok:

**Tujuan Umum:**
- Memberikan pengalaman langsung di dunia kerja sesuai bidang keilmuan
- Menumbuhkan kemampuan problem solving berbasis praktik lapangan

**Tujuan Khusus** (minimal 2–3 poin, spesifik dan SMART, berdasarkan project nyata dari FACT SHEET):
- Contoh: mengidentifikasi dan menganalisis proses kerja di [nama mitra]
- Contoh: mengembangkan [fitur/solusi spesifik dari kode]
- Contoh: menghasilkan laporan evaluatif yang dapat ditindaklanjuti mitra

**Keterampilan Teknis yang Dituju:**
- Mahasiswa mampu mempersiapkan hal-hal teknis yang diperlukan untuk melaksanakan suatu aktivitas kerja sesuai dengan kondisi tempat magang kerja
- Mahasiswa mampu menjelaskan atau melaksanakan aktivitas-aktivitas operasi kerja sesuai dengan kondisi tempat magang kerja
- Mahasiswa mampu menyusun laporan kerja di setiap aktivitas kerja yang telah dijalankan

**Keterampilan Relational yang Dituju:**
- Mahasiswa mampu menerima informasi dengan lengkap dan akurat baik secara lisan maupun tertulis
- Mahasiswa mampu menyampaikan laporan magang kerja baik kepada atasan (pembimbing lapang) ataupun panitia magang kerja secara akurat dan tepat waktu (on-time)
- Mahasiswa mampu menjalin hubungan kerja dengan atasan (pembimbing lapang), panitia magang kerja dan rekan kerja atau tim
- Mahasiswa mampu membangun tim kerja yang dinamis dan tangguh

##### 1.4 Manfaat Magang
Uraikan dalam tiga kelompok:

**Bagi Mahasiswa:**
- Pengalaman kerja nyata relevan dengan bidang keilmuan
- Penerapan ilmu dan keterampilan yang diperoleh selama perkuliahan
- Peningkatan kompetensi teknis dan non-teknis (sebutkan yang spesifik dari project)
- Menumbuhkan sikap profesional dan kesiapan menghadapi dunia kerja
- Memperluas jejaring dengan dunia industri

**Bagi Mitra (CV Sinar Agung Jaya / Viviashop):**
- Kontribusi SDM mahasiswa yang mendukung kegiatan operasional
- Kerja sama saling menguntungkan dengan institusi pendidikan tinggi
- Peningkatan efisiensi melalui keterlibatan mahasiswa inovatif
- Memperoleh calon tenaga kerja yang sudah mengenal sistem kerja

**Bagi UNESA:**
- Peningkatan kualitas lulusan yang berpengalaman praktis dan siap kerja
- Penguatan kerja sama dengan mitra eksternal
- Umpan balik untuk perbaikan kurikulum
- Peningkatan reputasi institusi

##### 1.5 Urgensi Magang
Jelaskan mengapa program magang ini mendesak dilakukan saat ini. Kaitkan dengan:
- Tren digitalisasi dan e-commerce yang berkembang pesat
- Kebutuhan industri akan lulusan yang memiliki pengalaman praktis berbasis teknologi
- Relevansi kompetensi mahasiswa dengan kebutuhan nyata di lapangan

##### 1.6 Kontribusi Riset terhadap Ilmu Pengetahuan
Uraikan bagaimana hasil magang ini berkontribusi pada:
- Penerapan dan pengujian teori/konsep akademis dalam konteks nyata
- Dokumentasi praktik pengembangan perangkat lunak e-commerce
- Potensi pengembangan keilmuan dari temuan selama magang

##### 1.7 Luaran Magang
Sebutkan luaran konkrit yang dihasilkan dari magang ini, contoh:
- Laporan akhir magang
- Kode/fitur yang dikembangkan (sebutkan dari FACT SHEET)
- Dokumentasi teknis / panduan penggunaan
- Rekomendasi pengembangan untuk mitra
→ Tandai output yang bisa diverifikasi dari kode; yang tidak bisa: `[PERLU KONFIRMASI MANUAL]`

---

#### BAB II — TINJAUAN PUSTAKA

##### 2.1 Penjelasan Industri yang Diikuti
Uraikan profil industri e-commerce tempat magang:
- Gambaran umum industri e-commerce di Indonesia (tren, pertumbuhan, regulasi)
- Posisi dan karakteristik Viviashop dalam ekosistem e-commerce
- Produk/layanan utama yang ditawarkan (dari FACT SHEET / dokumentasi)
- Keunggulan kompetitif mitra
→ Jika profil lengkap tidak tersedia di dokumentasi: `[PERLU INPUT MANUAL — profil resmi perusahaan]`

##### 2.2 Struktur Organisasi Industri
Gambarkan atau deskripsikan struktur organisasi mitra:
- Jabatan/divisi yang relevan dengan penempatan magang
- Posisi mahasiswa magang dalam struktur tersebut
- Siapa pembimbing lapang dan posisinya
→ Jika tidak tersedia di dokumentasi: `[PERLU INPUT MANUAL — struktur organisasi Viviashop]`
→ Tandai: `[GAMBAR/BAGAN: Struktur Organisasi Viviashop]`

##### 2.3 Kerangka Konseptual Program Magang Berdampak
Uraikan landasan konseptual, mencakup:
- Pengertian dan indikator program magang berdampak
  - Outcome untuk mahasiswa: keterampilan, jejaring, pemahaman konteks kerja
  - Outcome untuk mitra: kontribusi, rekomendasi, inovasi kecil
- Landasan teori yang relevan dengan tech stack project (contoh: konsep RESTful API, arsitektur Next.js/Laravel, manajemen basis data, e-commerce lifecycle)
- Studi sebelumnya atau praktik baik tentang program magang yang berhasil memberi dampak nyata
- Pendekatan pengukuran dampak dalam kegiatan pembelajaran luar kampus

---

#### BAB III — METODE PELAKSANAAN

##### 3.1 Bentuk Penugasan (Task Assignment)
Uraikan penugasan yang diterima selama magang:
- Posisi atau jabatan yang ditempati selama magang
- Tanggung jawab utama yang dibebankan
- Deskripsi pekerjaan spesifik yang dilaksanakan (berdasarkan kode nyata dari FACT SHEET)
- Observasi awal yang dilakukan sebelum pelaksanaan proyek

##### 3.2 Waktu
- Durasi magang (minimal 4 bulan)
- Jadwal kerja harian/mingguan
→ `[PERLU INPUT MANUAL — tanggal mulai dan selesai magang, jadwal harian]`

##### 3.3 Prosedur Pelaksanaan
Uraikan tahapan sistematis pelaksanaan magang, sesuaikan dengan yang benar-benar dilalui:

1. **Observasi Permasalahan Mitra** — identifikasi kebutuhan dan posisi relevan
2. **Pengurusan Surat Izin** — ke layanan akademik Mobilitas Akademik UNESA
3. **Penyampaian Proposal** — pengiriman dan pembahasan proposal magang
4. **Pembahasan dan Persetujuan Penugasan** — kesepakatan formal dengan mitra
5. **Pembekalan Peserta** — oleh Sub Direktorat Mobilitas Akademik dan Program Studi
6. **Pemberangkatan ke Lokasi** — koordinasi kampus dan mitra
7. **Orientasi Tempat Magang** — pengenalan struktur organisasi, sistem kerja, peraturan internal
8. **Pelaksanaan Penugasan (Performing)** — pengerjaan tugas-tugas sesuai penugasan
9. **Pendampingan oleh Pembimbing Lapang** — arahan, diskusi rutin, adaptasi
10. **Pengerjaan Proyek Berdampak** — proyek utama yang relevan dengan kompetensi akademik
11. **Supervisi dan Monitoring** — oleh pembimbing lapang dan dosen pembimbing kampus
12. **Evaluasi Akhir oleh Mitra** — penilaian kinerja teknis, kedisiplinan, dampak tugas

**Teknik yang Digunakan:**

| Teknik | Deskripsi |
|---|---|
| Observasi langsung | Mahasiswa mengamati aktivitas di unit kerja untuk memahami sistem, alur, dan tantangan yang dihadapi. |
| Studi dokumen internal | Mengkaji dokumen SOP, laporan produksi, atau evaluasi institusi sebagai landasan analisis. |
| Wawancara terstruktur dan informal | Dilakukan dengan staf, teknisi, dan supervisor untuk menggali informasi dan persepsi praktisi. |
| Diskusi kolaboratif | Mahasiswa berdiskusi secara reguler dengan pembimbing lapangan untuk menyusun rekomendasi atau inovasi. |
| Perancangan mini-proyek | Mahasiswa merancang dan mencoba solusi berbasis masalah yang ditemukan, dengan skalabilitas terbatas namun berdampak nyata. |

**Kertas Kerja yang Dihasilkan:**

Selain tugas teknis, setiap peserta magang diwajibkan menghasilkan kertas kerja yang disampaikan kepada pembimbing lapang untuk dinilai sejauh mana perkembangan kemampuan konseptual. Kertas kerja tersebut meliputi:
- **Kertas Kerja 1:** Deskripsi bisnis proses tempat magang (Viviashop / CV Sinar Agung Jaya)
- **Kertas Kerja 2:** Identifikasi faktor-faktor kunci penentu keberhasilan usaha tempat magang
- **Kertas Kerja 3 dan selanjutnya:** Deskripsi dan analisis masalah yang dapat diidentifikasi, beserta alternatif-alternatif pemecahannya

→ Semakin banyak kertas kerja yang dihasilkan, semakin sering mahasiswa melatih kemampuan konsepsionalnya. Peran pembimbing lapang sangat diharapkan untuk mempertajam kemampuan mahasiswa terkait kondisi aktual di lokasi magang.

---

#### BAB IV — PELAKSANAAN KEGIATAN YANG RELEVAN DENGAN KONVERSI MATA KULIAH

##### 4.1 Aktivitas Harian yang Dikerjakan Selama di Mitra
Jabarkan aktivitas harian secara detail. Gunakan format tabel per bulan:

| Minggu | Posisi | Topik | Durasi (jam) | Target | Metode |
|---|---|---|---|---|---|
| [minggu ke-] | [posisi] | [kegiatan dari kode nyata] | [jam] | [target terukur] | [metode] |

→ Isi tabel ini berdasarkan fitur dan modul yang benar-benar ada di FACT SHEET. Jangan mengarang kegiatan.
→ Ulangi tabel ini per bulan selama periode magang berlangsung.

##### 4.2 Hasil Proyek yang Telah Dikembangkan
Untuk setiap proyek/fitur yang dikembangkan, tulis dengan format berikut:

**Judul Proyek:** [nama fitur/proyek dari FACT SHEET]

**Deskripsi Singkat:**
[Jelaskan konteks masalah yang diselesaikan, kaitkan dengan kebutuhan mitra]

**Tahapan yang Telah Dikerjakan:**
1. [Tahap 1 — berdasarkan kode nyata]
2. [Tahap 2 — berdasarkan kode nyata]
... dst

**Hasil yang Dicapai:**
- [Hasil terukur — verifikasi dari kode]
- `[FOTO/GAMBAR: screenshot fitur yang dikembangkan]`

**Dampak Kegiatan:**
- Divisi/Unit yang Terdampak: [sebutkan]
- Bukti/Output Proyek: [URL, dokumen, prototipe, link GitHub]

**Jenis Dampak Mini Proyek** (centang yang sesuai dan uraikan — tulis hanya yang dipilih):

*A. Dampak Sosial* — pilih dari:
- **1. Pendidikan Inklusif** (akses belajar, pemerataan pendidikan, bahan ajar, literasi)
- **2. Penelitian dan Inovasi** (data/informasi baru, teknologi/produk inovatif, rekomendasi berbasis kajian)
- **3. Pengabdian dan Pengembangan Masyarakat** (transfer pengetahuan/teknologi, peningkatan kapasitas, pemberdayaan kelompok mitra)
- **4. Kontribusi terhadap Kebijakan Publik** (rekomendasi berbasis bukti, dukungan program pemerintah, advokasi isu sosial-lingkungan)

*B. Dampak Ekonomi* — pilih dari:
- **1. Pengajaran dan Pembelajaran** (peningkatan kompetensi, kesiapan kerja, kesesuaian dengan kebutuhan industri)
- **2. Penelitian dan Pertukaran Pengetahuan** (hilirisasi riset, publikasi/produk bernilai ekonomi, penyebaran pengetahuan ke mitra/industri)
- **3. Ekosistem Kewirausahaan** (pengembangan startup/UMKM, penciptaan produk/jasa baru, peluang kerja atau usaha baru, peningkatan pendapatan mitra)
- **4. Kunjungan Akademik & Pengeluaran Pengunjung** (mendorong aktivitas ekonomi lokal, pemanfaatan jasa transportasi dan akomodasi, konsumsi produk lokal)
- **5. Pengeluaran Institusi** (pengadaan barang/jasa lokal, pembangunan atau pemanfaatan infrastruktur, dukungan kegiatan akademik berskala lokal)

*C. Dampak Lingkungan* — pilih yang relevan (jika ada):
- **1. Energi** (penghematan energi, praktik hemat energi, energi terbarukan, kampanye efisiensi energi)
- **2. Konsumsi Bertanggung Jawab** (pengurangan bahan sekali pakai, pengelolaan limbah, pemanfaatan sumber daya efisien)
- **3. Transportasi** (transportasi ramah lingkungan, pengurangan emisi karbon, mobilitas efisien)
- **4. Keanekaragaman Hayati** (konservasi flora/fauna, perlindungan ekosistem, monitoring keanekaragaman hayati)
- **5. Pendidikan dan Penelitian Lingkungan** (pembelajaran berbasis isu lingkungan, penelitian pelestarian, transfer pengetahuan lingkungan)

*C. Keberlanjutan (Opsional – Penguatan SDGs)* — apakah kegiatan berlanjut setelah program selesai? Mendukung SDGs nomor berapa? Ada rencana tindak lanjut / replikasi program?

##### 4.3 Pembahasan — Relevansi dengan Keilmuan Program Studi
Kaitkan aktivitas dan mini proyek yang dikerjakan dengan keilmuan program studi:
- Konsep akademis apa yang diterapkan dalam project ini
- Gap antara teori di kelas dan kenyataan di lapangan (jika ada)
- Temuan teknis yang memperluas pemahaman akademis
→ Gunakan referensi pustaka yang relevan (format Harvard)

##### 4.4 Relevansi dengan Mata Kuliah Konversi
Untuk setiap mata kuliah yang dikonversi, tulis narasi dengan format berikut:

**Mata Kuliah: [Nama Mata Kuliah]**

[Deskripsikan kegiatan magang spesifik yang berkaitan — gunakan sudut pandang orang pertama ("Saya"). Sebutkan: (1) kegiatan apa yang dikerjakan, (2) bagaimana kaitannya dengan materi mata kuliah, (3) keterampilan atau pengetahuan yang diterapkan, (4) bukti atau hasil nyata dari kegiatan, (5) simpulan bagaimana kegiatan memperkuat pembelajaran dari mata kuliah tersebut.]

`[FOTO/GAMBAR: dokumentasi aktivitas terkait mata kuliah ini]`

→ Ulangi blok ini untuk setiap mata kuliah yang dikonversi.
→ `[PERLU INPUT MANUAL — daftar mata kuliah yang dikonversi, disetujui DPL dan Koordinator Prodi]`

---

#### BAB V — HAMBATAN DAN DUKUNGAN PELAKSANAAN MAGANG

##### 5.1 Hambatan
Uraikan hambatan nyata yang dihadapi selama magang. Susun dalam poin bernomor, contoh area hambatan:
1. Penyesuaian terhadap lingkungan kerja dan budaya tim
2. Keterbatasan waktu dalam penyelesaian tugas atau fitur
3. Keterbatasan akses terhadap data atau informasi internal
4. Tantangan teknis spesifik dalam pengembangan project (berdasarkan FACT SHEET)
→ Jika ada kendala yang disebutkan di dokumentasi project, kutip langsung dari sana. Jika tidak ada: `[PERLU INPUT MANUAL — hambatan yang dirasakan selama magang]`

##### 5.2 Dukungan
Uraikan faktor-faktor yang mendukung pelaksanaan magang:
1. **Bimbingan dari Dosen Pembimbing Lapangan dan Supervisor Mitra** — arahan teknis, feedback berkala
2. **Kerja sama tim yang solid** — dukungan rekan magang dan karyawan mitra
3. **Fasilitas dan sarana kerja yang memadai** — perangkat teknologi, akses platform, ruang kerja
4. [Tambahkan dukungan spesifik lainnya yang benar-benar dialami]

---

#### BAB VI — REFLEKSI, RENCANA TINDAK LANJUT & REKOMENDASI

##### 6.1 Refleksi
Tulis dalam sudut pandang orang pertama ("Saya"). Uraikan empat aspek:

**1. Pengalaman Pribadi Selama Magang:**
Gambarkan secara rinci pengalaman yang diperoleh — tantangan yang dihadapi, pekerjaan yang dikerjakan, aktivitas yang diikuti, dan bagaimana pengalaman tersebut memengaruhi cara pandang terhadap dunia profesional.

**2. Keterampilan yang Dikembangkan:**
- Keterampilan teknis: sebutkan dari FACT SHEET (framework, bahasa, tools yang digunakan)
- Keterampilan interpersonal: komunikasi, kerja tim, manajemen waktu, adaptasi
Jelaskan bagaimana pengalaman memberi ruang untuk pengembangan keterampilan ini.

**3. Pengaruh Magang terhadap Karier:**
Bagaimana pengalaman magang memengaruhi pandangan tentang karier? Apakah memperjelas tujuan karier atau membuka minat baru? Diskusikan perubahan pandangan yang muncul.

**4. Penerapan Ilmu yang Diperoleh di Kampus:**
Konsep atau teori kuliah apa yang berhasil diterapkan? Gap antara teori dan praktik yang ditemukan? Pelajaran baru yang tidak ada di bangku kuliah?

##### 6.2 Rekomendasi untuk Mitra
Berikan masukan konstruktif kepada CV Sinar Agung Jaya / Viviashop berdasarkan observasi selama magang. Pilih yang relevan:
- **Peningkatan Efisiensi atau Proses Kerja** — contoh: alur kerja, tooling, dokumentasi
- **Pemanfaatan Teknologi atau Inovasi Baru** — berdasarkan gap yang ditemukan di kode
- **Peningkatan Pelibatan Mahasiswa Magang** — orientasi, mentoring, jadwal yang lebih terstruktur
→ Rekomendasi harus berdasarkan pengamatan nyata, bukan generik. Jika tidak bisa diverifikasi: `[PERLU INPUT MANUAL]`

##### 6.2 Rekomendasi untuk Program Magang
Berikan saran kepada program magang yang dikelola kampus/prodi, fokus pada:
- Perbaikan sistem seleksi atau pembekalan
- Keselarasan kurikulum dengan kebutuhan industri
- Dukungan institusi selama magang berlangsung
- Saran untuk koordinasi yang lebih baik antara kampus dan mitra

##### 6.3 Rencana Pengembangan Diri
Uraikan langkah konkret pengembangan kompetensi setelah magang:

- **Soft Skill yang Akan Ditingkatkan:** komunikasi, manajemen waktu, kepemimpinan, kolaborasi
- **Hard Skill yang Akan Dikuasai:** sebutkan teknologi/tool spesifik yang ingin dikuasai lebih lanjut (berkaitan dengan tech stack dari FACT SHEET)
- **Langkah Nyata:** kegiatan konkret (kursus, proyek mandiri, komunitas, sertifikasi)
- **Tujuan Jangka Menengah:** gambaran karier atau kompetensi yang ingin dicapai

##### 5.4 Potensi Keberlanjutan Program
Bahas kemungkinan dampak jangka panjang dari program magang ini:
- **Potensi Kerja Sama Berkelanjutan** — apakah mitra membuka peluang kerja, freelance, atau proyek lanjutan?
- **Pengembangan Kurikulum Berbasis Industri** — topik magang yang bisa dijadikan masukan modul praktikum atau proyek akhir
- **Replikasi atau Scaling Up** — model kolaborasi yang bisa direplikasi ke mitra lain

---

#### BAB VII — PENUTUP

##### 6.1 Simpulan
Tulis simpulan yang menjawab tujuan magang yang ditetapkan di BAB I (sub-bab 1.3 Tujuan Magang) secara langsung. Satu paragraf per tujuan khusus. Hindari pengulangan yang tidak perlu. Tidak perlu diawali dengan "Berdasarkan uraian di atas" atau kalimat pembuka klise serupa.

##### 6.2 Saran
Berikan saran yang ditujukan kepada:
1. Mitra CV Sinar Agung Jaya / Viviashop — untuk pengembangan sistem/produk ke depan
2. UNESA / Program Studi — untuk perbaikan program magang berikutnya
3. Mahasiswa yang akan magang setelahnya — tips praktis berdasarkan pengalaman

---

#### DAFTAR PUSTAKA
Format: **Harvard Style** — nama belakang, tahun, judul, penerbit. Diurutkan berdasarkan abjad.

Contoh:
```
Pressman, R.S. (2014) Software Engineering: A Practitioner's Approach. 8th edn. New York: McGraw-Hill.
```

Setiap pustaka yang dirujuk di naskah harus muncul di sini, dan sebaliknya.

---

#### LAMPIRAN
- Lampiran 1: Biodata Mahasiswa (Nama, NIM, Prodi, Fakultas, No. Tlp, Email, foto)
- Lampiran 2: Logbook Harian Magang `[PERLU INPUT MANUAL]`
- Lampiran 3: Surat Keterangan Magang dari Mitra `[PERLU INPUT MANUAL]`
- Lampiran 4: Screenshot / Dokumentasi Fitur yang Dikembangkan `[FOTO/GAMBAR: deskripsi]`
- Lampiran 5: Lembar Penilaian dari Pembimbing Mitra `[PERLU INPUT MANUAL]`

---

## ATURAN PENULISAN — WAJIB DIIKUTI

### A. Anti-Halusinasi
- Setiap klaim teknis HARUS ada sumbernya dari FACT SHEET
- Jika suatu informasi tidak ada di FACT SHEET → tulis `[PERLU KONFIRMASI MANUAL]`, bukan mengarang
- Nama file, fungsi, tabel database — harus nama yang PERSIS ada di kode, bukan paraphrase

### B. Gaya Penulisan — Anti-AI Rules (WAJIB DIIKUTI KETAT)

Laporan ini harus terdengar seperti ditulis oleh **Raihan** — mahasiswa Teknik Informatika UNESA yang baru selesai magang selama 4 bulan di CV Sinar Agung Jaya, mengerjakan platform e-commerce Viviashop. Bukan seperti artikel blog teknologi, bukan seperti laporan konsultan, bukan seperti teks yang di-generate AI.

---

#### B.1 — BLACKLIST FRASA (Tidak boleh muncul sama sekali)

Frasa-frasa berikut adalah penanda paling kuat bahwa teks ditulis oleh AI. **Nol toleransi — jika muncul, tulis ulang kalimat tersebut dari awal.**

**Pembuka paragraf klise:**
- "Secara keseluruhan, ..."
- "Dengan demikian, ..."
- "Oleh karena itu, ..."
- "Berdasarkan hal tersebut, ..."
- "Sebagai kesimpulan, ..."
- "Tidak dapat dipungkiri bahwa ..."
- "Dalam konteks ini, ..."
- "Hal ini menunjukkan bahwa ..."
- "Dapat disimpulkan bahwa ..."
- "Perlu dicatat bahwa ..."
- "Penting untuk diketahui bahwa ..."
- "Pada dasarnya, ..."
- "Sejatinya, ..."
- "Di era globalisasi ini, ..."
- "Di era digital ini, ..."
- "Di era modern ini, ..."

**Kata penghubung yang terlalu sering dipakai AI:**
- "Selain itu," (lebih dari 2x per bab)
- "Di samping itu,"
- "Lebih lanjut,"
- "Lebih jauh lagi,"
- "Terlebih lagi,"
- "Tak hanya itu,"

**Frasa hiperbola dan pujian berlebihan:**
- "sangat signifikan"
- "sangat krusial"
- "sangat fundamental"
- "memainkan peran yang sangat penting"
- "menjadi tulang punggung"
- "menjadi fondasi utama"
- "tak ternilai harganya"
- "luar biasa kompleks"
- "revolusioner"
- "transformatif" (kecuali dalam konteks teknis yang spesifik)

**Kata sifat kosong yang tidak informatif:**
- "robust" (tanpa penjelasan teknis apa yang membuatnya robust)
- "komprehensif" (tanpa rincian apa yang dicakup)
- "holistik"
- "sinergis" / "sinergi yang baik"
- "efektif dan efisien" (tanpa metrik)
- "optimal" (tanpa tolok ukur)

**Penutup paragraf yang meringkas ulang isi paragraf itu sendiri:**
- "Dari uraian di atas dapat dilihat bahwa ..."
- "Berdasarkan penjelasan tersebut ..."
- "Hal ini menegaskan bahwa ..."
- "Dengan kata lain, ..."

---

#### B.2 — POLA STRUKTUR YANG DILARANG

**Dilarang: Paragraf pembuka yang terlalu umum sebelum masuk ke inti.**
AI selalu membuka paragraf dengan konteks makro dulu baru masuk ke spesifik. Mahasiswa nyata langsung masuk ke poin.

❌ Buruk:
> "Dalam dunia pengembangan perangkat lunak modern, autentikasi merupakan komponen yang sangat krusial. Tanpa sistem autentikasi yang baik, sebuah aplikasi tidak akan mampu melindungi data penggunanya. Oleh karena itu, pada tahap awal pengerjaan proyek Viviashop, saya mengimplementasikan sistem login menggunakan JWT."

✅ Baik:
> "Tugas pertama yang saya terima adalah mengimplementasikan sistem autentikasi. Saya memilih JWT karena token-nya stateless — tidak perlu menyimpan sesi di server, dan itu keputusan yang tepat mengingat Viviashop punya dua klien berbeda: web dan mobile."

---

**Dilarang: Tiga poin yang selalu seimbang dan simetris.**
AI cenderung membuat tiga poin dengan panjang hampir sama. Kehidupan nyata tidak simetris.

❌ Buruk:
> Manfaat pertama adalah A. Manfaat kedua adalah B. Manfaat ketiga adalah C.
> (tiga paragraf dengan panjang hampir identik)

✅ Baik:
> Manfaat terbesar yang saya rasakan adalah A, karena [alasan spesifik dari pengalaman nyata]. B juga membantu, meski jujur awalnya saya meremehkannya. C, kalau boleh jujur, lebih terasa setelah magang selesai daripada saat sedang menjalaninya.

---

**Dilarang: Kalimat definisi yang tidak diminta.**
AI sering mendefinisikan istilah teknis di awal sebelum menggunakannya, meskipun konteksnya tidak butuh definisi.

❌ Buruk:
> "Next.js adalah framework React berbasis Node.js yang mendukung server-side rendering (SSR) dan static site generation (SSG). Dalam project Viviashop, Next.js digunakan sebagai..."

✅ Baik:
> "Arsitektur Viviashop menggunakan Next.js dengan App Router — pilihan yang menurut saya cukup berani untuk project e-commerce skala ini, karena SSR-nya membantu performa halaman produk yang perlu diindeks search engine."

---

**Dilarang: Kesimpulan sub-bab yang meringkas ulang isi sub-bab itu.**
Setiap sub-bab tidak perlu ditutup dengan kalimat "Dari uraian di atas..." atau sejenisnya. Cukup akhiri dengan poin terakhir yang substantif, atau transisi natural ke sub-bab berikutnya.

---

#### B.3 — ATURAN POSITIF: BAGAIMANA MAHASISWA NYATA MENULIS

**Gunakan sudut pandang orang pertama yang spesifik dan jujur.**
Ceritakan apa yang benar-benar terjadi, bukan apa yang "seharusnya" terjadi.

✅ Contoh:
> "Jujur, di minggu pertama saya agak kewalahan membaca codebase Viviashop yang sudah cukup besar. Saya butuh dua hari hanya untuk memahami alur data dari halaman produk ke cart, sebelum akhirnya bisa mulai berkontribusi."

---

**Boleh menyebutkan keputusan teknis beserta alasannya secara langsung.**
Mahasiswa yang terlibat nyata di project tahu *kenapa* keputusan tertentu diambil.

✅ Contoh:
> "Saya sempat mempertimbangkan Zustand untuk state management, tapi akhirnya tetap pakai Context API karena tim sudah familiar dan scope-nya tidak terlalu kompleks."

---

**Variasi panjang kalimat: campurkan pendek dan panjang.**
Sesekali satu kalimat pendek berdiri sendiri untuk penekanan. Kalimat panjang boleh ada, tapi tidak setiap kalimat harus panjang.

✅ Contoh:
> "Deployment Viviashop menggunakan arsitektur hybrid — sebagian layanan di-host di VPS, sebagian lagi memanfaatkan layanan cloud yang sudah ada. Ini bukan keputusan ideal. Tapi ini realistis untuk skala dan anggaran project saat ini."

---

**Boleh mengakui keterbatasan atau hal yang belum sempurna.**
Mahasiswa nyata tidak mengklaim segalanya berjalan mulus. Kejujuran ini justru membuat laporan lebih kredibel.

✅ Contoh:
> "Fitur notifikasi real-time sempat menjadi bottleneck — implementasi awal dengan polling setiap 5 detik ternyata cukup memberatkan server. Saya belum sempat migrasi ke WebSocket sebelum periode magang berakhir, dan ini saya catat sebagai rekomendasi pengembangan berikutnya."

---

**Gunakan kata-kata yang terasa alami dalam konteks akademis mahasiswa Indonesia.**
Kata seperti "ternyata", "cukup", "agak", "sempat", "jujur", "sebenarnya", "lumayan" boleh dipakai — dengan frekuensi wajar (jangan tiap kalimat).

---

#### B.4 — CEK MANDIRI SEBELUM FINALISASI TIAP BAB

Sebelum menyatakan satu bab selesai, lakukan cek berikut:

1. **Tes frasa pembuka:** Buka setiap paragraf — apakah dimulai dengan frasa dari blacklist B.1? Jika ya, tulis ulang.
2. **Tes simetri:** Apakah ada tiga poin berurutan dengan panjang hampir sama persis? Jika ya, buat salah satunya lebih singkat atau lebih panjang secara natural.
3. **Tes definisi:** Apakah ada paragraf yang membuka dengan mendefinisikan istilah teknis yang tidak diminta? Jika ya, hapus definisi tersebut dan langsung masuk ke penggunaannya.
4. **Tes kesimpulan ulang:** Apakah kalimat terakhir setiap sub-bab meringkas ulang isi sub-bab itu sendiri? Jika ya, hapus atau ganti dengan kalimat yang membawa informasi baru.
5. **Tes kejujuran:** Apakah ada klaim "berhasil", "berjalan dengan baik", "sukses" tanpa menyebutkan kendala atau proses? Jika ya, tambahkan konteks yang lebih jujur.
6. **Tes suara:** Baca satu paragraf keras-keras — apakah terdengar seperti mahasiswa yang sedang bercerita, atau seperti presenter TED Talk? Jika yang kedua, sederhanakan.

### C. Format Teknis
- Laporan ditulis dalam format Markdown (.md) lengkap
- Heading: `# BAB I`, `## 1.1`, `### Sub-sub-bab`, dst.
- Tabel: gunakan format tabel Markdown
- Gambar: tandai `[FOTO/GAMBAR: deskripsi singkat konten gambar]`
- Jenis huruf final (untuk Word/PDF): Times New Roman 12pt judul, 11pt isi
- Kertas HVS A4, cover biru muda (untuk versi cetak)
- Nomor tabel dan gambar: tidak di-bold

### D. Sitasi
- Untuk klaim teknis penting, tambahkan catatan: `(sumber: NamaFile.tsx)` atau `(sumber: DOKUMENTASI.md)`
- Sitasi pustaka menggunakan format Harvard

---

## FASE 6 — SELF-AUDIT SETELAH SELESAI

Setelah laporan selesai, lakukan audit mandiri dan tampilkan hasilnya:

```
========== AUDIT LAPORAN ==========

HALAMAN DEPAN:
[ ] Halaman judul lengkap dengan semua placeholder yang jelas
[ ] Lembar pengesahan memiliki semua kolom tanda tangan
[ ] Daftar isi mencerminkan struktur 7 bab yang benar
[ ] Daftar tabel dan daftar gambar ada (meski berupa placeholder)

BAB I — Pendahuluan:
[ ] Latar belakang mencakup 6 elemen wajib (peran magang, dunia kerja, dampak, proyeksi industri, profil lokasi, indikator keberhasilan)
[ ] Sub-bab 1.2 Rumusan Masalah ada (minimal 2–3 pertanyaan spesifik)
[ ] Tujuan umum dan tujuan khusus ada di sub-bab 1.3 (minimal 2-3 poin khusus)
[ ] Keterampilan teknis (3 poin) dan relational (4 poin) tercantum di sub-bab 1.3
[ ] Manfaat dibagi tiga: mahasiswa, mitra, UNESA — di sub-bab 1.4
[ ] Sub-bab 1.5 Urgensi Magang ada
[ ] Sub-bab 1.6 Kontribusi Riset terhadap Ilmu Pengetahuan ada
[ ] Sub-bab 1.7 Luaran Magang ada

BAB II — Tinjauan Pustaka:
[ ] 2.1 Penjelasan industri ada (e-commerce / profil mitra)
[ ] 2.2 Struktur organisasi ada atau ada placeholder yang jelas
[ ] 2.3 Kerangka konseptual ada

BAB III — Metode Pelaksanaan:
[ ] 3.1 Bentuk penugasan ada dan spesifik
[ ] 3.2 Waktu ada
[ ] 3.3 Prosedur 12 tahap ada
[ ] Tabel teknik pelaksanaan ada (5 teknik: Observasi langsung, Studi dokumen internal, Wawancara terstruktur dan informal, Diskusi kolaboratif, Perancangan mini-proyek)
[ ] Syarat kertas kerja ada (KK1: bisnis proses, KK2: faktor kunci keberhasilan, KK3+: deskripsi & analisis masalah)

BAB IV — Pelaksanaan Kegiatan:
[ ] 4.1 Tabel aktivitas harian ada (per bulan, header: Minggu | Posisi | Topik | Durasi (jam) | Target | Metode)
[ ] 4.2 Hasil proyek mengikuti format: judul, deskripsi singkat, tahapan, hasil yang dicapai, dampak kegiatan
[ ] Checklist jenis dampak ada: A.Dampak Sosial (4 kategori), B.Dampak Ekonomi (5 kategori), C.Dampak Lingkungan (5 kategori), C.Keberlanjutan
[ ] 4.3 Pembahasan relevansi keilmuan ada
[ ] 4.4 Narasi per mata kuliah konversi ada (atau placeholder jelas)
[ ] Semua nama fitur/modul yang disebut bisa diverifikasi dari FACT SHEET

BAB V — Hambatan dan Dukungan:
[ ] 5.1 Hambatan ada (minimal 3 poin)
[ ] 5.2 Dukungan ada (minimal 3 poin)

BAB VI — Refleksi, RTL & Rekomendasi:
[ ] 6.1 Refleksi mencakup 4 aspek: pengalaman, keterampilan, karier, penerapan ilmu
[ ] 6.2 Rekomendasi untuk mitra ada (sub-bab pertama bernomor 6.2)
[ ] 6.2 Rekomendasi untuk program magang ada (sub-bab kedua bernomor 6.2 — ikuti persis template)
[ ] 6.3 Rencana pengembangan diri ada
[ ] 5.4 Potensi keberlanjutan program ada (bernomor 5.4 — ikuti persis template)

BAB VII — Penutup:
[ ] 6.1 Simpulan menjawab tujuan di BAB I sub-bab 1.3 (bernomor 6.1 — ikuti persis template)
[ ] 6.2 Saran ada (bernomor 6.2 — ikuti persis template) — ditujukan ke mitra, UNESA, mahasiswa berikutnya

Daftar Pustaka:
[ ] Format Harvard style
[ ] Diurutkan abjad

Lampiran:
[ ] Lampiran 1 Biodata ada
[ ] Lampiran lain ada atau ada placeholder yang jelas

KLAIM YANG PERLU DIKONFIRMASI MANUAL:
1. ...
2. ...
(list semua yang ditandai [PERLU KONFIRMASI MANUAL] atau [PERLU INPUT MANUAL])

=====================================
```

---

## FASE 7 — STRATEGI PENULISAN BERTAHAP (TOKEN MANAGEMENT)

Laporan ini diperkirakan mencapai 15.000–20.000 kata. Menulis semuanya dalam satu sesi akan melampaui output window model dan menghasilkan tulisan yang terpotong, terburu-buru, atau mulai mengarang di bagian akhir karena konteks sudah menipis. **Gunakan sistem CHUNK berikut — satu sesi = satu chunk.**

---

### ARSITEKTUR CHUNK

Laporan dibagi menjadi **9 chunk** dengan urutan yang tidak boleh diacak. Setiap chunk menghasilkan satu file `.md` tersendiri. Di akhir sesi, semua file digabung menjadi laporan final.

```
CHUNK 0  →  laporan-chunk-00-factsheet.md        ← FACT SHEET final (dari Fase 0–4)
CHUNK 1  →  laporan-chunk-01-halaman-depan.md    ← Judul, Pengesahan, Daftar Isi/Tabel/Gambar
CHUNK 2  →  laporan-chunk-02-bab1.md             ← BAB I Pendahuluan (1.1–1.6)
CHUNK 3  →  laporan-chunk-03-bab2.md             ← BAB II Tinjauan Pustaka (2.1–2.3)
CHUNK 4  →  laporan-chunk-04-bab3.md             ← BAB III Metode Pelaksanaan (3.1–3.3)
CHUNK 5  →  laporan-chunk-05-bab4a.md            ← BAB IV sub-bab 4.1 (Tabel Aktivitas Harian per bulan)
CHUNK 6  →  laporan-chunk-06-bab4b.md            ← BAB IV sub-bab 4.2–4.3 (Proyek + Pembahasan)
CHUNK 7  →  laporan-chunk-07-bab4c.md            ← BAB IV sub-bab 4.4 (Konversi Mata Kuliah — 7 narasi)
CHUNK 8  →  laporan-chunk-08-bab5-6-7.md         ← BAB V, VI (6.1–6.5), BAB VII
CHUNK 9  →  laporan-chunk-09-penutup.md          ← Daftar Pustaka + Lampiran
```

> BAB IV dipecah menjadi 3 chunk (5, 6, 7) karena ini bab terpanjang: tabel aktivitas per bulan selama 4 bulan + narasi 7 mata kuliah konversi bisa mencapai 5.000–8.000 kata sendiri.

---

### PROTOKOL PER CHUNK

#### Cara memulai setiap chunk baru:

Setiap kali memulai chunk (kecuali Chunk 0), **paste teks berikut di awal sesi** sebelum instruksi chunk-nya:

```
RESUME KONTEKS — CHUNK [N] dari 9

Saya sedang menulis laporan magang dalam sesi bertahap.
Konteks yang sudah dikerjakan:
- FACT SHEET tersimpan di: laporan-chunk-00-factsheet.md
- Chunk yang sudah selesai: [sebutkan nomor dan judulnya]
- Chunk yang sedang dikerjakan sekarang: CHUNK [N] — [judul]

Aturan yang tetap berlaku:
1. Semua klaim teknis harus berdasar FACT SHEET di chunk-00
2. Anti-AI writing rules (blacklist frasa, larangan pola simetris, dsb.) tetap aktif
3. Jangan menulis ulang bagian yang sudah ada di chunk sebelumnya
4. Nama entitas: "CV Sinar Agung Jaya" = instansi resmi, "Viviashop" = platform/project
5. Sudut pandang orang pertama — Raihan, mahasiswa S1 Teknik Informatika UNESA

File FACT SHEET:
[paste isi laporan-chunk-00-factsheet.md di sini]
```

---

#### Instruksi spesifik per chunk:

---

**CHUNK 0 — FACT SHEET**
*(Dijalankan setelah Fase 0–4 selesai)*

Simpan seluruh output FACT SHEET dari Fase 4 ke file:
```bash
cat > laporan-chunk-00-factsheet.md << 'EOF'
[paste seluruh FACT SHEET di sini]
EOF
```
File ini adalah **sumber kebenaran tunggal** untuk semua chunk berikutnya. Jangan ubah isinya setelah chunk ini selesai kecuali ada koreksi eksplisit dari mahasiswa.

**STOP. Konfirmasi dulu dengan mahasiswa sebelum lanjut ke Chunk 1.**

---

**CHUNK 1 — HALAMAN DEPAN**
*(Estimasi: ~500 kata)*

Tulis: Halaman Judul, Lembar Pengesahan, Daftar Isi, Daftar Tabel, Daftar Gambar.

Ambil semua data identitas dari `laporan-chunk-00-factsheet.md` dan `report-administration-data.json`. Tidak boleh ada placeholder untuk field yang sudah tersedia di kedua file tersebut.

Simpan ke: `laporan-chunk-01-halaman-depan.md`

**Setelah selesai, tampilkan ringkasan 3 baris:**
```
✓ CHUNK 1 SELESAI
Berisi: Halaman judul, lembar pengesahan, daftar isi (X bab), daftar tabel, daftar gambar
Placeholder tersisa: [list placeholder yang belum bisa diisi]
```

---

**CHUNK 2 — BAB I PENDAHULUAN**
*(Estimasi: ~2.000–2.500 kata)*

Tulis sub-bab 1.1 sampai 1.7 secara lengkap. Urutan dan elemen wajib per sub-bab mengacu pada Fase 5 di prompt ini.

Khusus 1.1 Latar Belakang: tulis minimal 4 paragraf. Jangan buka dengan kalimat generik tentang "era digital" atau "perkembangan teknologi".

Simpan ke: `laporan-chunk-02-bab1.md`

**Setelah selesai, tampilkan ringkasan:**
```
✓ CHUNK 2 SELESAI
Sub-bab: 1.1 (X paragraf), 1.2 Rumusan Masalah, 1.3 Tujuan Magang, 1.4 Manfaat Magang, 1.5 Urgensi, 1.6 Kontribusi Riset, 1.7 Luaran
Total kata estimasi: ~XXXX
Klaim teknis yang dirujuk ke FACT SHEET: [list singkat]
Placeholder tersisa: [list]
```

---

**CHUNK 3 — BAB II TINJAUAN PUSTAKA**
*(Estimasi: ~1.500–2.000 kata)*

Tulis sub-bab 2.1–2.3. Untuk 2.1, gunakan `form.deskripsiInstansi` dari JSON sebagai basis — kembangkan menjadi narasi akademis, jangan copy-paste mentah.

Untuk 2.2 (struktur organisasi): jika tidak tersedia di dokumentasi, tulis placeholder eksplisit dan sertakan petunjuk format bagan yang dibutuhkan.

Simpan ke: `laporan-chunk-03-bab2.md`

**Setelah selesai, tampilkan ringkasan.**

---

**CHUNK 4 — BAB III METODE PELAKSANAAN**
*(Estimasi: ~1.500 kata)*

Tulis sub-bab 3.1–3.3 termasuk tabel 12 tahap prosedur, tabel teknik pelaksanaan (5 teknik), dan paragraf syarat kertas kerja.

Simpan ke: `laporan-chunk-04-bab3.md`

**Setelah selesai, tampilkan ringkasan.**

---

**CHUNK 5 — BAB IV BAGIAN A: TABEL AKTIVITAS HARIAN**
*(Estimasi: ~1.500–2.500 kata — tergantung kepadatan aktivitas)*

Tulis **hanya sub-bab 4.1**: tabel aktivitas harian per bulan.

Periode magang: 26 Januari 2026 s/d 1 Juni 2026 = 4 bulan lebih.
Buat tabel terpisah per bulan: Januari (minggu 4–5), Februari, Maret, April, Mei–Juni.

Semua kegiatan di tabel **harus berdasar fitur dan modul nyata dari FACT SHEET**. Jangan isi tabel dengan kegiatan generik seperti "mempelajari codebase" tanpa spesifik modul apa yang dipelajari.

Simpan ke: `laporan-chunk-05-bab4a.md`

**Setelah selesai, tampilkan ringkasan:**
```
✓ CHUNK 5 SELESAI
Periode yang dicakup: [tanggal] s/d [tanggal]
Jumlah bulan: X | Jumlah baris tabel total: X
Fitur/modul yang muncul di tabel: [list dari FACT SHEET]
Aktivitas yang belum bisa dikonfirmasi ke kode: [list — wajib dikonfirmasi mahasiswa]
```

---

**CHUNK 6 — BAB IV BAGIAN B: HASIL PROYEK & PEMBAHASAN**
*(Estimasi: ~2.000–2.500 kata)*

Tulis sub-bab 4.2 (hasil proyek dengan format lengkap: judul, deskripsi, tahapan, hasil, dampak, checklist jenis dampak) dan sub-bab 4.3 (pembahasan relevansi keilmuan).

Setiap fitur yang disebut harus bisa ditunjuk ke file sumbernya di FACT SHEET.

Simpan ke: `laporan-chunk-06-bab4b.md`

**Setelah selesai, tampilkan ringkasan.**

---

**CHUNK 7 — BAB IV BAGIAN C: KONVERSI MATA KULIAH**
*(Estimasi: ~2.500–3.500 kata — 7 mata kuliah × ~400 kata per narasi)*

Tulis sub-bab 4.4 untuk **semua 7 mata kuliah konversi** dari `mataKuliahKonversi` di JSON:

1. Magang Perencanaan Program (2 SKS)
2. Magang Evaluasi Program (2 SKS)
3. Web Semantik (3 SKS)
4. Verifikasi dan Validasi Perangkat Lunak (3 SKS)
5. Konstruksi Perangkat Lunak (3 SKS)
6. Analisis dan Desain Perangkat Lunak (4 SKS)
7. Virtualisasi dan Komputasi Awan (3 SKS)

Untuk setiap mata kuliah: gunakan format narasi orang pertama sesuai panduan Fase 5 sub-bab 4.4. Kaitkan ke aktivitas nyata dari tabel di Chunk 5 dan fitur di Chunk 6 — **jangan menulis narasi yang berdiri sendiri tanpa kaitan ke keduanya.**

Mata kuliah dengan SKS lebih besar (Analisis dan Desain 4 SKS) → narasi lebih panjang dan detail.

Simpan ke: `laporan-chunk-07-bab4c.md`

**Setelah selesai, tampilkan ringkasan:**
```
✓ CHUNK 7 SELESAI
7 narasi mata kuliah: [list nama MK]
Aktivitas di chunk-05 yang dirujuk: [list minggu/bulan]
Fitur di chunk-06 yang dirujuk: [list nama fitur]
Cross-reference konsisten: [Ya/Tidak — jika Tidak, sebutkan inkonsistensinya]
```

---

**CHUNK 8 — BAB V, VI, VII**
*(Estimasi: ~2.500–3.000 kata)*

Tulis dalam urutan:
- BAB V (5.1 Hambatan, 5.2 Dukungan)
- BAB VI (6.1 Refleksi — 4 aspek, 6.2 Rekomendasi Mitra, 6.2 Rekomendasi Program, 6.3 Rencana Pengembangan Diri, 5.4 Potensi Keberlanjutan)
- BAB VII (6.1 Simpulan, 6.2 Saran)

**CATATAN PENTING untuk CHUNK 8:** Nomor sub-bab di BAB VI dan BAB VII mengikuti persis template resmi UNESA yang memiliki inkonsistensi bawaan. Jangan koreksi nomor-nomor ini — pembimbing akan mencocokkan ke dokumen asli.

Untuk BAB VII, simpulan harus merujuk balik ke tujuan yang ditulis di Chunk 2 (BAB I sub-bab 1.3 Tujuan Magang). Gunakan angka, output, atau hasil konkret — bukan kalimat abstrak.

Simpan ke: `laporan-chunk-08-bab5-6-7.md`

**Setelah selesai, tampilkan ringkasan.**

---

**CHUNK 9 — DAFTAR PUSTAKA & LAMPIRAN**
*(Estimasi: ~300–500 kata + struktur lampiran)*

Tulis daftar pustaka format Harvard dari semua referensi yang dirujuk di chunk-chunk sebelumnya. Lampiran berupa struktur placeholder yang jelas.

Simpan ke: `laporan-chunk-09-penutup.md`

---

### PENGGABUNGAN FINAL

Setelah semua chunk selesai dan dikonfirmasi, jalankan:

```bash
cat \
  laporan-chunk-01-halaman-depan.md \
  laporan-chunk-02-bab1.md \
  laporan-chunk-03-bab2.md \
  laporan-chunk-04-bab3.md \
  laporan-chunk-05-bab4a.md \
  laporan-chunk-06-bab4b.md \
  laporan-chunk-07-bab4c.md \
  laporan-chunk-08-bab5-6-7.md \
  laporan-chunk-09-penutup.md \
  > LAPORAN_AKHIR_MAGANG_RAIHAN_FINAL.md

echo "Total kata:"
wc -w LAPORAN_AKHIR_MAGANG_RAIHAN_FINAL.md
```

> Chunk 0 (FACT SHEET) **tidak dimasukkan** ke laporan final — itu file kerja internal.

---

### ATURAN KONSISTENSI LINTAS CHUNK

Ini yang paling sering rusak ketika laporan ditulis bertahap. Wajib dipatuhi setiap chunk:

1. **Nama entitas konsisten** — CV Sinar Agung Jaya / Viviashop tidak boleh berganti-ganti cara penulisan antar chunk.
2. **Nomor sub-bab konsisten** — 4.1, 4.2, 4.3, 4.4 di chunk berbeda harus merujuk ke konten yang sama.
3. **Klaim lintas chunk harus sinkron** — jika di chunk 6 disebutkan "fitur X berhasil dikembangkan", maka di chunk 7 narasi mata kuliah harus merujuk ke fitur X yang sama, dan di chunk 8 simpulan harus konsisten dengan capaian itu.
4. **Jangan re-introduce informasi** — jika profil CV Sinar Agung Jaya sudah ditulis di chunk 3 (BAB II), jangan tulis ulang profilnya di chunk 8 (BAB VI). Cukup rujuk: "sebagaimana diuraikan pada BAB II".
5. **Nomor sub-bab inkonsisten di template adalah FITUR, bukan BUG** — nomor 6.2 muncul dua kali di BAB VI, dan BAB VII memakai 6.1/6.2 bukan 7.1/7.2, dan 5.4 muncul di BAB VI. Ini bukan kesalahan pengetikan — ini harus diikuti persis. Jangan "memperbaiki" nomor-nomor ini.
5. **Setiap chunk wajib membaca chunk sebelumnya** sebelum mulai menulis — minimal baca ringkasan akhir setiap chunk (baris `✓ CHUNK N SELESAI`).

---

## CATATAN UNTUK AI AGENT

1. **Informasi yang tidak tersedia di project** → tulis placeholder eksplisit: `[NAMA DOSEN PEMBIMBING]`, `[NIM]`, `[TANGGAL MULAI]`. Jangan mengarang.

2. **Konflik antara dokumentasi dan kode nyata** → percayai kode nyata, catat konfliknya di FACT SHEET.

3. **Bagian yang butuh input dari mahasiswa** (tanggal, mata kuliah konversi, struktur organisasi, logbook) → tandai `[PERLU INPUT MANUAL]` dan tulis penjelasan singkat informasi apa yang dibutuhkan.

4. **Eksekusi bash commands satu per satu**, baca outputnya, baru lanjut. Jangan batch semua sekaligus tanpa membaca hasilnya.

5. **Urutan penulisan**: ikuti urutan chunk 0–9. Jangan loncat-loncat.

6. **Nomor sub-bab harus konsisten** dengan daftar isi. Periksa ulang sebelum finalisasi.

7. **Satu chunk = satu sesi**. Jangan memulai chunk berikutnya dalam sesi yang sama jika output sudah mendekati panjang. Lebih baik tutup dengan ringkasan `✓ CHUNK N SELESAI` dan mulai sesi baru.

8. **Jika di tengah chunk konteks mulai terasa tipis** (model mulai mengulang poin atau kalimat menjadi lebih generik) — **berhenti, simpan progress yang ada, tulis ringkasan status, dan lanjutkan di sesi baru** dengan template resume konteks di atas.

---

*Prompt v3.0 — Disinkronisasi penuh dengan Template Resmi Laporan Akhir Mobilitas Akademik Magang UNESA (7 Bab). Semua nomor sub-bab, judul, tabel teknik, checklist dampak, syarat kertas kerja, dan keterampilan relational sudah diverifikasi kata per kata terhadap dokumen template. Anti-halusinasi, anti-AI writing patterns, token-aware chunking system. Setiap klaim harus bisa dilacak ke sumber file nyata dalam project.*
