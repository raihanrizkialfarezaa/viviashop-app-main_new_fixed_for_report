# PROMPT: PEMBUATAN LAPORAN AKHIR MOBILITAS AKADEMIK MAGANG
# Viviashop — Universitas Negeri Surabaya (UNESA)
# ============================================================
# CARA PAKAI:
# Copy seluruh isi prompt ini dan paste ke AI agent (OpenCode, Cursor, dsb.)
# Pastikan working directory agent sudah di-set ke root folder viviashop-app-main
# ============================================================

---

## FASE 0 — INISIALISASI & LARANGAN KERAS

Kamu adalah mahasiswa yang sedang menulis laporan akhir magang dari nol berdasarkan project nyata yang kamu kerjakan. **Kamu dilarang mengarang, mengasumsikan, atau menulis klaim apapun yang tidak bisa dibuktikan langsung dari file di project ini.**

Sebelum menulis satu kata pun di laporan, kamu WAJIB menyelesaikan semua fase di bawah secara berurutan. Jangan skip fase apapun. Setiap kali kamu menemukan fakta penting, catat di "FACT SHEET" yang kamu kelola sendiri selama proses ini.

---

## FASE 1 — PEMETAAN STRUKTUR PROJECT

Jalankan perintah berikut dan catat hasilnya di FACT SHEET:

```bash
# 1. Lihat keseluruhan struktur project
find . -maxdepth 3 -not -path '*/node_modules/*' -not -path '*/.git/*' -not -path '*/vendor/*' -not -path '*/.next/*' -not -path '*/dist/*' | sort

# 2. Identifikasi jenis project (Laravel? Next.js? Vue? dll)
cat package.json 2>/dev/null || cat composer.json 2>/dev/null || echo "Tidak ada package.json / composer.json di root"

# 3. Cek apakah ada subfolder dengan package/composer sendiri
find . -maxdepth 2 -name "package.json" -not -path '*/node_modules/*' | head -20
find . -maxdepth 2 -name "composer.json" -not -path '*/vendor/*' | head -20

# 4. Cek file .env.example untuk tahu konfigurasi sistem
cat .env.example 2>/dev/null || cat .env 2>/dev/null || echo "Tidak ada .env.example"
```

Dari hasil di atas, catat ke FACT SHEET:
- [ ] Tech stack utama (framework, bahasa, database)
- [ ] Nama project resmi
- [ ] Jenis aplikasi (web app, mobile, API, dsb.)

---

## FASE 2 — BACA SEMUA DOKUMENTASI YANG ADA

Baca SEMUA file markdown/dokumentasi yang ada di project ini:

```bash
# Temukan semua file dokumentasi
find . -name "*.md" -not -path '*/node_modules/*' -not -path '*/.git/*' | sort
find . -name "*.txt" -not -path '*/node_modules/*' | grep -i "doc\|readme\|panduan\|manual\|log" | head -20
```

Kemudian baca satu per satu:
```bash
# Baca setiap file .md yang ditemukan — JANGAN SKIP SATUPUN
cat [nama_file.md]
```

Dari setiap file dokumentasi, ekstrak dan catat ke FACT SHEET:
- [ ] Deskripsi project / tujuan project
- [ ] Fitur-fitur yang disebutkan secara eksplisit
- [ ] Teknologi yang disebutkan
- [ ] Nama-nama entitas: user, admin, seller, buyer, dsb.
- [ ] Tantangan atau kendala yang disebutkan
- [ ] Proses pengembangan yang didokumentasikan

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
find . -name "*.ts" -o -name "*.tsx" -not -path '*/node_modules/*' | head -50

# Jika ada Prisma
cat prisma/schema.prisma 2>/dev/null | head -300
```

Catat ke FACT SHEET:
- [ ] Daftar controller/handler yang ada (nama PERSIS dari ls, bukan asumsi)
- [ ] Daftar model/entity (nama PERSIS)
- [ ] Daftar route/endpoint utama
- [ ] Skema database (tabel-tabel yang ada)

### 3b. Frontend / UI Layer
```bash
# Temukan komponen/view utama
ls resources/views/ 2>/dev/null
ls src/components/ 2>/dev/null || ls components/ 2>/dev/null
ls src/app/ 2>/dev/null

# Baca beberapa komponen kunci untuk memahami alur UI
find . -name "*.blade.php" -not -path '*/vendor/*' | head -30 2>/dev/null
find . -name "page.tsx" -o -name "page.jsx" 2>/dev/null | grep -v node_modules | head -20
```

Catat ke FACT SHEET:
- [ ] Halaman-halaman utama yang ada
- [ ] Alur navigasi yang bisa diidentifikasi
- [ ] Komponen UI yang signifikan

### 3c. Fitur Spesifik yang Wajib Ditelusuri
```bash
# Cari fitur autentikasi
grep -r "auth\|login\|register\|jwt\|session" --include="*.php" --include="*.ts" --include="*.tsx" -l 2>/dev/null | grep -v node_modules | head -20

# Cari fitur payment/transaksi
grep -r "payment\|midtrans\|stripe\|order\|checkout\|cart" --include="*.php" --include="*.ts" --include="*.tsx" -l 2>/dev/null | grep -v node_modules | head -20

# Cari fitur upload/media
grep -r "upload\|storage\|image\|file" --include="*.php" --include="*.ts" --include="*.tsx" -l 2>/dev/null | grep -v node_modules | head -20

# Cari integrasi API eksternal
grep -r "axios\|fetch\|http\|curl\|guzzle" --include="*.php" --include="*.ts" --include="*.tsx" -l 2>/dev/null | grep -v node_modules | head -20
```

Buka file-file yang ditemukan dan baca kontennya untuk memahami implementasi nyata.

---

## FASE 4 — BACA TEMPLATE LAPORAN

Baca file template laporan secara lengkap:

```bash
cat "Template Laporan Akhir Mobilitas Akademik Magang.md"
# atau nama file template yang ada
```

Dari template, ekstrak dan catat ke FACT SHEET:
- [ ] Struktur bab yang diharuskan (BAB I, II, III, dsb.)
- [ ] Sub-bab yang harus ada di tiap bab
- [ ] Format penulisan yang diminta (ukuran kertas, font, margin, dll)
- [ ] Kelengkapan dokumen yang diperlukan (lembar pengesahan, dll)
- [ ] Ketentuan khusus apapun yang ada di template

---

## FASE 5 — SUSUN FACT SHEET FINAL

Sebelum menulis laporan, tampilkan FACT SHEET yang sudah kamu kumpulkan dalam format ini:

```
========== FACT SHEET VIVIASHOP ==========

IDENTITAS PROJECT:
- Nama project: [dari file nyata]
- Jenis aplikasi: [dari file nyata]
- Tech stack: [dari package.json / composer.json]
- Framework utama: [versi eksak jika ada]
- Database: [dari .env.example / prisma schema / config]

ENTITAS / MODULE YANG ADA (dari kode nyata):
- Model/Entity: [list dari folder Models / Prisma schema]
- Controller/Handler: [list dari folder Controllers / route handlers]
- Halaman utama: [list dari views / pages]

FITUR YANG TERIDENTIFIKASI (dengan sumber file):
1. [Nama fitur] — ditemukan di: [nama_file.ts/php:baris]
2. [Nama fitur] — ditemukan di: [nama_file.ts/php:baris]
... dst

INTEGRASI EKSTERNAL (dengan sumber file):
- [Nama layanan] — ditemukan di: [nama_file]

TANTANGAN / KENDALA (dari dokumentasi):
- [kutip langsung dari file dokumentasi jika ada]

INFORMASI YANG TIDAK DITEMUKAN DI KODE / DOKUMENTASI:
- [List hal yang tidak bisa diverifikasi — WAJIB dikosongkan atau ditandai "perlu konfirmasi"]

==========================================
```

**STOP DI SINI.** Tampilkan FACT SHEET dulu. Jangan lanjut menulis laporan sebelum FACT SHEET dikonfirmasi benar.

---

## FASE 6 — PENULISAN LAPORAN

Setelah FACT SHEET selesai dan dikonfirmasi, tulis laporan dengan aturan berikut:

### ATURAN PENULISAN — WAJIB DIIKUTI

**A. Anti-halusinasi**
- Setiap klaim teknis HARUS ada sumbernya dari FACT SHEET
- Jika suatu informasi tidak ada di FACT SHEET → tulis "[PERLU KONFIRMASI MANUAL]" bukan mengarang
- Nama file, fungsi, tabel database — harus nama yang PERSIS ada di kode, bukan paraphrase atau generalisasi

**B. Gaya penulisan**
- Tulis seperti mahasiswa nyata yang menceritakan pengalamannya
- Hindari kalimat robotik: "Secara keseluruhan", "Kesimpulannya", "Selain itu", "Dengan demikian", "Oleh karena itu" (maksimal 2x per bab)
- Variasikan panjang kalimat — kadang pendek. Kadang lebih panjang karena konteks memang butuh penjelasan yang lebih detail.
- Boleh pakai kata informal sesekali yang wajar di konteks akademis: "ternyata", "cukup", "lumayan", "sebenarnya" — tapi tetap jaga tone profesional
- Tidak perlu setiap paragraf dibuka dengan kata transisi
- Boleh menulis dalam sudut pandang orang pertama ("Saya", "Penulis") sesuai panduan template

**C. Struktur**
- Ikuti PERSIS sistematika dari template laporan yang sudah dibaca di Fase 4
- Jangan tambah atau kurangi bab tanpa alasan yang jelas dari template
- Gunakan nomor bab dan sub-bab sesuai template

**D. Sitasi internal**
- Untuk klaim teknis penting, tambahkan catatan kecil di akhir kalimat dalam kurung: (lihat: NamaFile.php) atau (sumber: DOKUMENTASI_MAGANG_VIVIASHOP.md)
- Ini bukan untuk laporan akhir — ini untuk audit trail selama proses review

### FORMAT OUTPUT
- Tulis laporan dalam format Markdown (.md) lengkap dari Halaman Judul sampai Lampiran
- Gunakan heading yang sesuai: `# BAB I`, `## 1.1`, dst.
- Untuk tabel, gunakan format tabel Markdown
- Tandai dengan `[FOTO/GAMBAR: deskripsi]` di tempat yang seharusnya ada screenshot atau gambar

---

## FASE 7 — SELF-AUDIT SETELAH SELESAI

Setelah laporan selesai ditulis, lakukan audit mandiri:

```
AUDIT LAPORAN:

Bab I - Pendahuluan:
[ ] Semua fakta di latar belakang bisa diverifikasi dari dokumentasi project
[ ] Tujuan magang konsisten dengan template
[ ] Tidak ada klaim tentang fitur yang tidak ada di kode

Bab II - Gambaran Umum:
[ ] Nama perusahaan/instansi benar dan konsisten
[ ] Deskripsi platform sesuai dokumentasi
[ ] Tech stack sesuai package.json / composer.json

Bab III - Pelaksanaan:
[ ] Kegiatan yang ditulis mencerminkan fitur yang benar-benar ada
[ ] Tidak ada nama controller/model/tabel yang dikarang
[ ] Timeline masuk akal dan konsisten

Bab IV - Hasil:
[ ] Fitur yang "berhasil dikembangkan" memang ada buktinya di kode
[ ] Tidak ada klaim pencapaian yang tidak bisa diverifikasi

Ditemukan [N] klaim yang perlu dikonfirmasi manual:
1. ...
2. ...
```

Tampilkan hasil audit ini setelah laporan selesai.

---

## CATATAN UNTUK AI AGENT

1. Jika ada informasi yang memang tidak tersedia di project (misal: nama dosen pembimbing, NIM mahasiswa, tanggal mulai magang, nama perusahaan partner resmi) — **tulis placeholder yang jelas**: `[NAMA DOSEN PEMBIMBING]`, `[NIM]`, `[TANGGAL MULAI]`. Jangan mengarang.

2. Jika menemukan konflik antara dokumentasi dan kode nyata — **percayai kode nyata**, catat konfliknya di FACT SHEET.

3. Jika ada bagian template yang membutuhkan informasi yang sama sekali tidak ada di project — **tandai dengan `[PERLU INPUT MANUAL]`** dan tulis penjelasan singkat informasi apa yang dibutuhkan.

4. Eksekusi bash commands satu per satu, baca outputnya, baru lanjut ke command berikutnya. Jangan batch semua sekaligus tanpa membaca hasilnya.

---

*Prompt ini dibuat untuk memastikan laporan akhir magang yang dihasilkan 100% akurat, traceable, dan tidak mengandung halusinasi AI. Setiap klaim harus bisa dilacak ke sumber file yang nyata dalam project.*
