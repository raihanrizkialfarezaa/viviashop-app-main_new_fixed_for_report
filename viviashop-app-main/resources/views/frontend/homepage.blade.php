@extends('frontend.layouts')
@section('content')
<!-- Hero Section (compact, Tokopedia-style banner) -->
<div class="hero-wrapper" style="background:
    radial-gradient(circle at top left, rgba(255, 255, 255, 0.12), transparent 30%),
    radial-gradient(circle at 82% 18%, rgba(32, 201, 151, 0.2), transparent 24%),
    linear-gradient(135deg, rgba(7, 44, 29, 0.96) 0%, rgba(15, 81, 50, 0.92) 44%, rgba(16, 185, 129, 0.78) 100%),
    url('{{ asset('atkah.jpg') }}') center/cover no-repeat;">
    <div class="container hero-content">
        <div class="row g-3 align-items-center">
            <div class="col-lg-6 animate-up">
                <div class="hero-kicker mb-3">
                    <i class="fas fa-print"></i>
                    <span class="fw-bold">Printshop premium untuk kebutuhan cetak & ATK</span>
                </div>
                <h1 class="hero-title">
                    Cetak lebih rapi,<br>
                    lebih cepat,<br>
                    dan terasa premium
                </h1>
                <p class="hero-copy">
                    Vivia PrintShop — solusi percetakan modern, layanan custom fleksibel, dan koleksi ATK lengkap.
                </p>
                <div class="hero-panel">
                    <span class="hero-panel-chip"><i class="fas fa-truck"></i> Pengiriman cepat & rapi</span>
                    <span class="hero-panel-chip"><i class="fas fa-palette"></i> Custom desain fleksibel</span>
                    <span class="hero-panel-chip"><i class="fas fa-store"></i> Belanja produk & cetak</span>
                </div>
                <div class="hero-actions">
                    <a href="{{ route('shop') }}" class="btn-premium shadow-sm">
                        Lihat Produk <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('shopCetak') }}" class="btn-hero-secondary">
                        Jelajahi Layanan
                    </a>
                    <span class="hero-note">
                        <i class="fas fa-shield-alt text-success"></i>
                        Proses cepat, hasil lebih bersih
                    </span>
                </div>
                <div class="hero-trust">
                    <span class="hero-trust-item"><i class="fas fa-check-circle"></i> 500+ pelanggan puas</span>
                    <span class="hero-trust-item"><i class="fas fa-map-marker-alt"></i> Toko di Cukir, Jombang</span>
                    <span class="hero-trust-item"><i class="fas fa-clock"></i> Respons cepat via WA</span>
                </div>
            </div>
            <div class="col-lg-6 animate-up delay-2">
                <div class="hero-visual">
                    <div class="hero-floating-card hero-floating-card--top d-none d-md-block">
                        <div class="hero-floating-title">
                            <i class="fas fa-medal"></i>
                            <span>Kualitas Terjamin</span>
                        </div>
                        <p class="hero-floating-text">Tinta pigment anti-luntur — hasil cetak tajam & tahan lama.</p>
                        <div class="hero-floating-stat-row">
                            <div class="hero-floating-stat">
                                <span class="hero-stat-num">500+</span>
                                <span class="hero-stat-label">Pelanggan</span>
                            </div>
                            <div class="hero-floating-stat-divider"></div>
                            <div class="hero-floating-stat">
                                <span class="hero-stat-num">4.9★</span>
                                <span class="hero-stat-label">Rating</span>
                            </div>
                            <div class="hero-floating-stat-divider"></div>
                            <div class="hero-floating-stat">
                                <span class="hero-stat-num">5th</span>
                                <span class="hero-stat-label">Tahun</span>
                            </div>
                        </div>
                    </div>
                    @php
                        $carouselItems = $slides->isNotEmpty()
                            ? $slides->map(fn($s) => ['src' => $s->image_url, 'label' => 'Promo'])
                            : $popular->take(4)->filter(fn($p) => $p->productImages->isNotEmpty())
                                      ->map(fn($p) => ['src' => asset('storage/' . $p->productImages->first()->path), 'label' => $p->name]);
                    @endphp
                    <div class="hero-carousel-shell">
                        @if($carouselItems->isNotEmpty())
                        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach ($carouselItems as $idx => $item)
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $idx }}" class="{{ $idx === 0 ? 'active' : '' }}" aria-label="Slide {{ $idx + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($carouselItems as $idx => $item)
                                    <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                                        <img src="{{ $item['src'] }}" class="d-block w-100" alt="{{ $item['label'] }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="hero-placeholder-visual">
                            <div class="hero-placeholder-inner">
                                <div class="hero-placeholder-badge"><i class="fas fa-print"></i> Percetakan & ATK Premium</div>
                                <div class="hero-placeholder-title">ViviaShop</div>
                                <div class="hero-placeholder-subtitle">Solusi cetak profesional di Cukir, Jombang</div>
                                <div class="hero-placeholder-chips">
                                    <span class="hero-placeholder-chip"><i class="fas fa-file-alt"></i> Dokumen & Brosur</span>
                                    <span class="hero-placeholder-chip"><i class="fas fa-id-card"></i> ID Card</span>
                                    <span class="hero-placeholder-chip"><i class="fas fa-calendar-alt"></i> Kalender</span>
                                    <span class="hero-placeholder-chip"><i class="fas fa-pencil-alt"></i> Alat Tulis</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="hero-floating-card hero-floating-card--bottom d-none d-md-block">
                        <div class="hero-floating-title">
                            <i class="fas fa-bolt"></i>
                            <span>Order Mudah & Cepat</span>
                        </div>
                        <p class="hero-floating-text">Pesan via website, WhatsApp, atau kunjungi toko langsung.</p>
                        <div class="hero-floating-chip"><i class="fas fa-clock"></i> Estimasi 1–3 hari kerja</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section (compact grid) -->
<div class="v-section">
    <div class="container">
        <div class="feature-stage">
            <div class="row g-2">
                <div class="col-md-6 col-lg-3">
                    <x-feature-card
                        icon="shipping-fast"
                        title="Gratis Ongkir"
                        description="Pengiriman gratis untuk belanja minimal Rp 300.000."
                        tag="Benefit"
                        index="01"
                        foot="Min. order tertentu"
                        :delay="0"
                    />
                </div>
                <div class="col-md-6 col-lg-3">
                    <x-feature-card
                        icon="shield-alt"
                        title="Aman & Nyaman"
                        description="Transaksi terlindungi dengan sistem pembayaran terenkripsi."
                        tag="Proteksi"
                        index="02"
                        foot="Checkout aman"
                        :delay="1"
                    />
                </div>
                <div class="col-md-6 col-lg-3">
                    <x-feature-card
                        icon="redo-alt"
                        title="Garansi Revisi"
                        description="Kepuasan prioritas — garansi revisi desain gratis."
                        tag="Fleksibel"
                        index="03"
                        foot="Koreksi leluasa"
                        :delay="2"
                    />
                </div>
                <div class="col-md-6 col-lg-3">
                    <x-feature-card
                        icon="headset"
                        title="Support 24/7"
                        description="CS siap membantu kendala kapanpun dan dimanapun."
                        tag="Responsif"
                        index="04"
                        foot="Tim siap bantu"
                        :delay="3"
                    />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Banner Section -->
<div class="v-section">
    <div class="container">
        <div class="row g-3 align-items-stretch">
            <div class="col-lg-4">
                <x-service-banner
                    color="emerald"
                    icon="boxes"
                    iconColor="text-success"
                    title="ATK Lengkap"
                    description="Solusi alat tulis kantor super lengkap"
                    badge="Tersedia"
                    badgeStyle="sun"
                    :meta="[
                        ['icon' => 'store', 'text' => 'Stok siap pilih'],
                        ['icon' => 'bolt', 'text' => 'Checkout cepat'],
                    ]"
                />
            </div>
            <div class="col-lg-4">
                <x-service-banner
                    color="amber"
                    icon="image"
                    iconColor="text-warning"
                    title="Cetak Banner"
                    description="Kualitas cetak spanduk revolusioner"
                    badge="Gratis Kirim"
                    badgeStyle="mint"
                    :offset="true"
                    :meta="[
                        ['icon' => 'ruler-combined', 'text' => 'Ukuran fleksibel'],
                        ['icon' => 'palette', 'text' => 'Warna lebih hidup'],
                    ]"
                />
            </div>
            <div class="col-lg-4">
                <x-service-banner
                    color="blue"
                    icon="book"
                    iconColor="text-primary"
                    title="Cetak Buku"
                    description="Hasil terjilid sempurna & jaminan mutu"
                    badge="Pro Quality"
                    badgeStyle="rose"
                    :meta="[
                        ['icon' => 'layer-group', 'text' => 'Finishing rapi'],
                        ['icon' => 'medal', 'text' => 'Kualitas konsisten'],
                    ]"
                />
            </div>
        </div>
    </div>
</div>

<!-- Products Showcase -->
<div class="v-section--lg">
    <div class="container">
        <div class="product-stage">
            <x-section-header
                kicker="Koleksi Terbaik"
                title="Produk Unggulan Kami"
                subtitle="Temukan produk pilihan untuk kebutuhan cetak dan ATK."
                :link="['url' => route('shop'), 'label' => 'Eksplor Semua']"
                :row="true"
            />

            <div class="row product-grid">
                @foreach ($products as $product)
                    @php
                        $categoryName = $product->categories->first()?->name ?? 'Tanpa kategori';
                        $image = !empty($product->productImages->first())
                            ? asset('storage/' . $product->productImages->first()->path)
                            : asset('images/placeholder.jpg');
                        $hasInventory = $product->productInventory != null;
                        $stockQuantity = $hasInventory
                            ? ($product->type == 'configurable' ? $product->total_stock : ($product->productInventory->qty ?? 0))
                            : null;
                        $availabilityLabel = is_null($stockQuantity)
                            ? ($product->type == 'configurable' ? 'Pilih varian' : 'Lihat detail')
                            : ($stockQuantity > 10 ? 'Tersedia' : ($stockQuantity > 0 ? 'Stok terbatas' : 'Stok habis'));
                        $availabilityClass = is_null($stockQuantity)
                            ? 'product-stock-badge--neutral'
                            : ($stockQuantity > 10 ? 'product-stock-badge--success' : ($stockQuantity > 0 ? 'product-stock-badge--warning' : 'product-stock-badge--muted'));
                        $availabilityIcon = is_null($stockQuantity)
                            ? 'fas fa-info-circle'
                            : ($stockQuantity > 10 ? 'fas fa-check-circle' : ($stockQuantity > 0 ? 'fas fa-exclamation-circle' : 'fas fa-times-circle'));
                        $productKicker = $product->type == 'configurable' ? 'Pilihan varian' : 'Siap dipesan';
                        $productHighlight = $product->type == 'configurable' ? 'Lebih fleksibel' : 'Checkout cepat';
                    @endphp
                    <div class="col-6 col-md-6 col-lg-3">
                        <x-product-card
                            :product="$product"
                            :image="$image"
                            :categoryName="$categoryName"
                            :productKicker="$productKicker"
                            :productHighlight="$productHighlight"
                            :availabilityLabel="$availabilityLabel"
                            :availabilityClass="$availabilityClass"
                            :availabilityIcon="$availabilityIcon"
                            :stockQuantity="$stockQuantity"
                            :hasInventory="$hasInventory"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Instagram Section -->
<div class="v-section instagram-showcase">
    <div class="container">
        <!-- Section Header -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <div class="instagram-header-badge mb-3">
                    <i class="fab fa-instagram"></i>
                    <span>Komunitas Kami</span>
                </div>
                <h2 class="instagram-showcase-title mb-3">
                    Ikuti Perjalanan<br>
                    <span class="title-gradient">Visual Kami</span>
                </h2>
                <p class="instagram-showcase-desc mb-4">
                    Dapatkan inspirasi desain terbaru, behind-the-scenes proses cetak, tips kreatif, dan promo eksklusif langsung dari Instagram kami
                </p>
            </div>
        </div>

        <!-- Instagram Preview Card -->
        <div class="instagram-grid-wrapper">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6">
                    <div class="instagram-embed-card">
                        <div class="instagram-embed-wrapper">
                            <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/vivia_printshop/" 
                                data-instgrm-version="14" style="background:#FFF; border:0; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.1); margin: 0 auto; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                            </blockquote>
                            <script async src="//www.instagram.com/embed.js"></script>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced CTA Card -->
            <div class="instagram-cta-enhanced">
                <div class="instagram-cta-glow"></div>
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <div class="instagram-cta-left">
                            <div class="instagram-profile-section">
                                <div class="instagram-profile-avatar">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <div class="instagram-profile-info">
                                    <h3 class="instagram-profile-handle">@vivia_printshop</h3>
                                    <div class="instagram-verified-badge">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Official Account</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="instagram-stats-elegant">
                                <div class="instagram-stat-elegant">
                                    <div class="instagram-stat-number">500+</div>
                                    <div class="instagram-stat-label">Posts</div>
                                </div>
                                <div class="instagram-stat-elegant">
                                    <div class="instagram-stat-number">2K+</div>
                                    <div class="instagram-stat-label">Followers</div>
                                </div>
                                <div class="instagram-stat-elegant">
                                    <div class="instagram-stat-number">1.5K+</div>
                                    <div class="instagram-stat-label">Following</div>
                                </div>
                            </div>

                            <p class="instagram-bio">
                                <i class="fas fa-quote-left"></i>
                                Inspirasi desain terbaru, tips cetak profesional, dan promo eksklusif hanya untuk followers kami
                                <i class="fas fa-quote-right"></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="instagram-cta-right">
                            <a href="https://www.instagram.com/vivia_printshop/" target="_blank" class="instagram-follow-btn-elegant">
                                <span class="btn-gradient-overlay"></span>
                                <i class="fab fa-instagram"></i>
                                <span class="btn-text">Follow di Instagram</span>
                                <i class="fas fa-arrow-right btn-arrow"></i>
                            </a>
                            
                            <div class="instagram-perks">
                                <div class="instagram-perk-item">
                                    <i class="fas fa-gift"></i>
                                    <span>Promo eksklusif</span>
                                </div>
                                <div class="instagram-perk-item">
                                    <i class="fas fa-lightbulb"></i>
                                    <span>Tips desain gratis</span>
                                </div>
                                <div class="instagram-perk-item">
                                    <i class="fas fa-bell"></i>
                                    <span>Update terbaru</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Digital Catalog & Stats -->
<div class="v-section--lg">
    <div class="container">
        <x-section-header
            kicker='<i class="fas fa-book-open"></i> Katalog & Statistik'
            title="Katalog Digital"
            subtitle="Eksplor produk lengkap dengan katalog digital interaktif."
            align="center"
        />
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="catalog-wrapper">
                    <div class="catalog-header">
                        <div>
                            <h3 class="catalog-title">Katalog Produk</h3>
                            <p class="catalog-subtitle">Lihat semua produk dalam satu dokumen</p>
                        </div>
                        <a href="https://drive.google.com/uc?export=download&id=1G3sq9BUgN4RaRBgVOs6iTSASHrYHB6Ij" target="_blank" class="catalog-download-btn">
                            <i class="fas fa-download"></i> Unduh PDF
                        </a>
                    </div>
                    <div class="catalog-iframe-wrap">
                        <iframe class="w-100 h-100"
                                src="https://drive.google.com/file/d/1G3sq9BUgN4RaRBgVOs6iTSASHrYHB6Ij/preview?usp=sharing"
                                style="border: none;">
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <x-stat-card icon="boxes" number="500+" label="Produk Berkualitas" color="green" />
                    </div>
                    <div class="col-sm-6">
                        <x-stat-card icon="layer-group" number="50+" label="Kategori Tersedia" color="teal" />
                    </div>
                    <div class="col-sm-6">
                        <x-stat-card icon="face-smile" number="1K+" label="Pelanggan Puas" color="amber" />
                    </div>
                    <div class="col-sm-6">
                        <x-stat-card icon="clock" number="24/7" label="Layanan Support" color="blue" />
                    </div>
                </div>

                <div class="mt-3 p-3 text-white rounded-3 shadow-sm" style="background: linear-gradient(135deg, var(--v-primary), var(--v-secondary));">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-motorcycle fa-2x me-3" style="color: rgba(255,255,255,0.9);"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Akses Mudah!</h6>
                            <p class="mb-0 small" style="color: rgba(255,255,255,0.8);">Lokasi nyaman untuk semua kendaraan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Location Info -->
<div class="v-section--lg">
    <div class="container">
        <div class="location-wrapper">
            <div class="row g-4">
                <div class="col-lg-5">
                    <span class="v-kicker mb-2"><i class="fas fa-map-marker-alt"></i> Lokasi Kami</span>
                    <h2 class="title-gradient mt-2 mb-2" style="font-size: clamp(1.35rem, 2.5vw, 1.65rem); font-weight: 800;">Temukan VIVIA PrintShop</h2>
                    <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">Rasakan langsung kualitas produk kami dengan pelayanan prima dari staf ahli.</p>

                    <x-contact-card icon="map-marker-alt" title="Alamat Store" detail="Tebu Ireng IV No. 38, Cukir, Diwek, Kab. Jombang, Jawa Timur 61471" />
                    <x-contact-card icon="phone" title="Telepon & WhatsApp" :detail="optional($setting)->telepon ?? '+62 812 3456 7890'" />
                    <x-contact-card icon="envelope" title="Alamat Surat" :detail="optional($setting)->email ?? 'info@vivia.com'" />
                    <x-contact-card icon="clock" title="Jam Buka" detail="Senin - Sabtu: 08:00 - 17:00 WIB" />

                    <div class="contact-cta-group">
                        @php
                            $rawPhone = optional($setting)->telepon ?? '081234567890';
                            $waPhone = preg_replace('/^0/', '62', $rawPhone);
                        @endphp
                        <a href="https://wa.me/{{ $waPhone }}" target="_blank" class="contact-cta contact-cta--primary">
                            <i class="fab fa-whatsapp"></i> Chat Kami
                        </a>
                        <a href="{{ optional($setting)->maps_url ?? 'https://maps.app.goo.gl/FQkhHuk1vnFZzcHg8?g_st=aw' }}" target="_blank" class="contact-cta contact-cta--outline">
                            <i class="fas fa-directions"></i> Rute Lokasi
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 position-relative">
                    <div class="map-container">
                        <div class="map-overlay-badge">
                            <i class="fas fa-map-pin"></i> VIVIA PrintShop
                        </div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.6902460456313!2d112.2357296745512!3d-7.608646375209187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7841556bd5c5bb%3A0x4517452691764b02!2sVIVIA%20PrintShop!5e0!3m2!1sid!2sid!4v1751760890529!5m2!1sid!2sid"
                            class="map-fill"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script-alt')
<script>
    $('.change-the-class').click(function(e) {
        var idAddress = $('.class-address').attr('id');
        $('.class-change').attr('id', idAddress);
    });

    document.addEventListener("DOMContentLoaded", function() {
        const elements = document.querySelectorAll('.animate-up');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        });
        elements.forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
    });
</script>
@endpush
@endsection
