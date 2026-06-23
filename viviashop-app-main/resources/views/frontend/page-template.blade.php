{{--
╔══════════════════════════════════════════════════════════════════════╗
║  VIVIASHOP — Design Pattern Template                                ║
║  ──────────────────────────────────────────────────────────────────  ║
║  This template serves as a blueprint for all frontend pages.        ║
║  It demonstrates the recommended patterns for:                      ║
║    • Section headers with kicker + title + subtitle + CTA           ║
║    • Grid layouts using Bootstrap 5 row/col                         ║
║    • Content cards with hover effects and glass-morphism             ║
║    • CTA banners with gradient backgrounds                          ║
║    • Proper spacing, typography, and color tokens                   ║
║                                                                     ║
║  Usage: Copy this file, rename, and uncomment sections as needed.   ║
║  Replace $items with your controller data.                          ║
╚══════════════════════════════════════════════════════════════════════╝
--}}

@extends('frontend.layouts')

@section('content')
    {{-- ═══════════════════════════════════════════════════════════════
         EXAMPLE: HERO BANNER (for landing/page-header)
         Use this for category pages, brand pages, or landing sections.
         The hero-wrapper class provides a full-width dark-green gradient.
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="hero-wrapper" style="background:
        radial-gradient(circle at top left, rgba(255, 255, 255, 0.16), transparent 30%),
        radial-gradient(circle at 82% 18%, rgba(32, 201, 151, 0.26), transparent 24%),
        linear-gradient(135deg, rgba(7, 44, 29, 0.96) 0%, rgba(15, 81, 50, 0.92) 44%, rgba(16, 185, 129, 0.78) 100%),
        url('{{ asset('path/to/bg.jpg') }}') center/cover no-repeat;">
        <div class="container hero-content">
            <div class="row align-items-center" style="min-height: 40vh;">
                <div class="col-lg-8 animate-up">
                    <div class="hero-kicker mb-4">
                        <i class="fas fa-tag"></i>
                        <span class="fw-bold fs-6">Kategori Produk</span>
                    </div>
                    <h1 class="hero-title" style="font-size: clamp(2.5rem, 5vw, 4rem);">
                        Judul Halaman
                    </h1>
                    <p class="hero-copy">
                        Deskripsi singkat tentang halaman ini.
                    </p>
                </div>
            </div>
        </div>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         SECTION HEADER (kicker + title + subtitle)
         Props:
           kicker  : optional small label above title
           title   : gradient heading
           subtitle: description text (max-width: 560px)
           link    : optional ['url' => ..., 'label' => ...]
           align   : 'start' (default) or 'center'
           row     : true — puts CTA on the right on lg screens
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <x-section-header
        kicker="Label Kategori"
        title="Judul Section"
        subtitle="Deskripsi section — max 2 kalimat menjelaskan konten di bawahnya."
        :link="['url' => route('shop'), 'label' => 'Lihat Semua']"
        align="center"
    />

    <x-section-header
        kicker="Produk Pilihan"
        title="Rekomendasi Kami"
        subtitle="Temukan produk pilihan dengan kualitas terbaik."
        :link="['url' => route('shop'), 'label' => 'Eksplor Semua']"
        :row="true"
    />
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         PRODUCT CARD GRID (4 columns)
         The product-card component handles badges, stock status,
         price display, and hover effects automatically.
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="container py-5">
        <x-section-header
            kicker="Produk"
            title="Produk Kami"
            subtitle="Koleksi produk terbaik untuk kebutuhan Anda."
            :link="['url' => route('shop'), 'label' => 'Semua Produk']"
            :row="true"
        />
        <div class="row product-grid">
            @foreach ($items as $product)
                @php
                    $image = $product->productImages->first()
                        ? asset('storage/' . $product->productImages->first()->path)
                        : asset('images/placeholder.jpg');
                    $catName = $product->categories->first()?->name ?? 'Umum';
                @endphp
                <div class="col-12 col-md-6 col-lg-3">
                    <x-product-card
                        :product="$product"
                        :image="$image"
                        :categoryName="$catName"
                        productKicker="Siap dipesan"
                        productHighlight="Checkout cepat"
                        availabilityLabel="Tersedia"
                        availabilityClass="product-stock-badge--success"
                        availabilityIcon="fas fa-check-circle"
                    />
                </div>
            @endforeach
        </div>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         FEATURE CARDS (4 columns, icon + title + description + tag)
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <x-feature-card
                    icon="shipping-fast"
                    title="Gratis Ongkir"
                    description="Nikmati pengiriman gratis minimal Rp 300.000."
                    tag="Benefit"
                    index="01"
                    foot="Minimal order tertentu"
                    :delay="0"
                />
            </div>
            <div class="col-md-6 col-lg-3">
                <x-feature-card
                    icon="shield-alt"
                    title="Aman &amp; Nyaman"
                    description="Transaksi terlindungi 100%."
                    tag="Proteksi"
                    index="02"
                    foot="Checkout aman"
                    :delay="1"
                />
            </div>
            <div class="col-md-6 col-lg-3">
                <x-feature-card
                    icon="headset"
                    title="Support 24/7"
                    description="Tim CS siap membantu kapanpun."
                    tag="Layanan"
                    index="03"
                    foot="Respon cepat"
                    :delay="2"
                />
            </div>
            <div class="col-md-6 col-lg-3">
                <x-feature-card
                    icon="redo-alt"
                    title="Garansi Revisi"
                    description="Kepuasan Anda prioritas kami."
                    tag="Jaminan"
                    index="04"
                    foot="Gratis revisi"
                    :delay="3"
                />
            </div>
        </div>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         SERVICE BANNERS (3 columns, gradient backgrounds)
         Color options: emerald | amber | blue
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="container py-5">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-4">
                <x-service-banner
                    color="emerald"
                    icon="boxes"
                    iconColor="text-success"
                    title="Judul Layanan"
                    description="Deskripsi singkat layanan."
                    badge="Promo"
                    badgeStyle="sun"
                    watermark="boxes"
                    watermarkPos="bottom-right"
                    :meta="[
                        ['icon' => 'store', 'text' => 'Info 1'],
                        ['icon' => 'bolt', 'text' => 'Info 2'],
                    ]"
                />
            </div>
            <div class="col-lg-4">
                <x-service-banner
                    color="amber"
                    icon="image"
                    iconColor="text-warning"
                    title="Layanan 2"
                    description="Deskripsi singkat."
                    badge="Gratis"
                    badgeStyle="mint"
                    watermark="image"
                    watermarkPos="top-left"
                    :offset="true"
                    :meta="[
                        ['icon' => 'ruler-combined', 'text' => 'Info 1'],
                    ]"
                />
            </div>
            <div class="col-lg-4">
                <x-service-banner
                    color="blue"
                    icon="book"
                    iconColor="text-primary"
                    title="Layanan 3"
                    description="Deskripsi singkat."
                    badge="Premium"
                    badgeStyle="rose"
                    watermark="book"
                    watermarkPos="top-right"
                    :meta="[
                        ['icon' => 'medal', 'text' => 'Info 1'],
                    ]"
                />
            </div>
        </div>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         STATS / METRICS (4 columns)
         Color options: green | teal | amber | blue
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-6 col-lg-3">
                <x-stat-card icon="boxes" number="500+" label="Produk" color="green" />
            </div>
            <div class="col-6 col-lg-3">
                <x-stat-card icon="layer-group" number="50+" label="Kategori" color="teal" />
            </div>
            <div class="col-6 col-lg-3">
                <x-stat-card icon="face-smile" number="1K+" label="Pelanggan" color="amber" />
            </div>
            <div class="col-6 col-lg-3">
                <x-stat-card icon="clock" number="24/7" label="Support" color="blue" />
            </div>
        </div>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         CTA / SOCIAL BANNER (full-width gradient)
         The content inside the component tags goes to the right column.
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="container py-5">
        <x-cta-section
            kicker="Label"
            kickerIcon="fab fa-instagram"
            title="Judul CTA <br>yang Menarik"
            description="Deskripsi ajakan aksi yang meyakinkan pengunjung."
            actionText="Tombol Aksi"
            actionUrl="https://example.com"
            actionIcon="fas fa-external-link-alt"
        >
            {{-- Right column content (image, card, embed, etc.) --}}
            <div style="width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 24px;"></div>
        </x-cta-section>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         CONTACT / LOCATION SECTION
         Use <x-contact-card /> for each info item.
         Map container uses .map-container + .map-fill classes.
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="container py-5">
        <div class="location-wrapper">
            <div class="row g-5">
                <div class="col-lg-5">
                    <span class="v-kicker mb-3"><i class="fas fa-map-marker-alt"></i> Lokasi Kami</span>
                    <h2 class="title-gradient mt-2 mb-3" style="font-size: clamp(1.8rem, 4vw, 2.4rem);">Temukan Kami</h2>
                    <p class="text-muted mb-4">Deskripsi lokasi.</p>

                    <x-contact-card icon="map-marker-alt" title="Alamat" detail="Jl. Contoh No. 123, Kota" />
                    <x-contact-card icon="phone" title="Telepon" detail="+62 812 3456 7890" />
                    <x-contact-card icon="envelope" title="Email" detail="info@example.com" />
                    <x-contact-card icon="clock" title="Jam Buka" detail="Sen - Sab: 08:00 - 17:00" />

                    <div class="contact-cta-group">
                        <a href="#" class="contact-cta contact-cta--primary">
                            <i class="fab fa-whatsapp fs-5"></i> Chat Kami
                        </a>
                        <a href="#" class="contact-cta contact-cta--outline">
                            <i class="fas fa-directions"></i> Rute
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 location-map-col position-relative">
                    <div class="map-container shadow-sm position-relative">
                        <div class="map-overlay-badge">
                            <i class="fas fa-map-pin"></i> Nama Tempat
                        </div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=..."
                            class="map-fill"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         CUSTOM CONTENT SECTION (v-stage wrapper)
         The v-stage class provides the premium gradient card container
         with subtle radial glow effects.
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="container py-5">
        <div class="v-stage" style="background:
            radial-gradient(circle at top left, rgba(32, 201, 151, 0.12), transparent 26%),
            radial-gradient(circle at bottom right, rgba(15, 81, 50, 0.08), transparent 34%),
            linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(244, 249, 246, 0.96));">
            <div class="row">
                <div class="col-12">
                    <p class="text-muted">Your content here.</p>
                </div>
            </div>
        </div>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         BASIC CONTENT SECTION (no v-stage, just spacing)
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <x-section-header
                    title="Privacy Policy"
                    subtitle="Last updated: January 2025"
                    align="center"
                />
                <div class="mt-5" style="max-width: 800px; margin: 0 auto;">
                    <p class="text-muted">Your content paragraph here.</p>
                </div>
            </div>
        </div>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
         ANIMATION UTILITY CLASSES
         Add .animate-up to any element to fade it in on scroll.
         Add .delay-1, .delay-2, .delay-3 for staggered animations.
         The IntersectionObserver JS is already included in the layout.
         ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="animate-up">This fades up on scroll</div>
    <div class="animate-up delay-2">This fades up with delay</div>
    --}}
@endsection

@push('script-alt')
    {{-- Page-specific JavaScript goes here --}}
    <script>
        // Your page-specific JS
    </script>
@endpush
