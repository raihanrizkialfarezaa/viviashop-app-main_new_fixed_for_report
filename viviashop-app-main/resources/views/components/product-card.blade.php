@props([
    'product' => null,
    'image' => '',
    'categoryName' => 'Tanpa kategori',
    'productKicker' => 'Siap dipesan',
    'productHighlight' => 'Checkout cepat',
    'availabilityLabel' => 'Tersedia',
    'availabilityClass' => 'product-stock-badge--success',
    'availabilityIcon' => 'fas fa-check-circle',
    'stockQuantity' => null,
    'hasInventory' => false,
])

<div class="product-card">
    <div class="product-visual-frame">
        <div class="product-badge-row">
            <div class="product-badge shadow-sm">
                <i class="fas fa-tag"></i> {{ $categoryName }}
            </div>
            <div class="product-stock-badge {{ $availabilityClass }}">
                <i class="{{ $availabilityIcon }}"></i> {{ $availabilityLabel }}
            </div>
        </div>
        <div class="product-img-wrapper">
            <img src="{{ $image }}" alt="{{ $product?->name ?? 'Product' }}">
        </div>
        <a href="{{ $product ? route('shop-detail', $product->id) : '#' }}" class="product-quick-link">
            Lihat detail <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <div class="product-card-body">
        <span class="product-kicker">{{ $productKicker }}</span>
        <a href="{{ $product ? route('shop-detail', $product->id) : '#' }}" class="product-title-link">
            <h3 class="product-title">{{ $product?->name ?? 'Product Name' }}</h3>
        </a>
        <p class="product-desc">{{ Str::limit($product?->short_description ?? '', 84) }}</p>

        <div class="product-meta-row">
            @if($hasInventory && $stockQuantity !== null)
                <span class="product-meta-pill">
                    <i class="fas fa-box"></i>
                    Stok {{ $stockQuantity }}
                </span>
            @endif
            <span class="product-meta-pill product-meta-pill--soft">
                <i class="fas fa-bolt"></i>
                {{ $productHighlight }}
            </span>
        </div>

        <div class="product-footer">
            <div class="product-price-stack">
                <span class="product-price-label">Harga</span>
                <div class="product-price">Rp {{ number_format($product?->price ?? 0) }}</div>
            </div>
            <div class="product-actions">
                <a href="{{ $product ? route('shop-detail', $product->id) : '#' }}" class="product-detail-link">Detail</a>
                <button class="add-cart-btn add-to-card"
                    product-id="{{ $product?->id ?? '' }}"
                    product-type="{{ $product?->type ?? 'simple' }}"
                    product-slug="{{ $product?->slug ?? '' }}">
                    <span>Tambah</span>
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
</div>
