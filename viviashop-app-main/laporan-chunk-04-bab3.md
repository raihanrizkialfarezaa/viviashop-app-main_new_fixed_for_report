
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
