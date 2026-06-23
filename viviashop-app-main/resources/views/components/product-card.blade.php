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

@php
    // Get real data from database
    $rating = $product->rating ?? 0; // Real rating from DB
    $ratingStars = floor($rating);
    $soldCount = $product->sold_count ?? 0; // Real sold count from DB
    
    // Check for brand to show official store badge
    $hasOfficialStore = $product?->brand?->name ?? false;
    
    // Calculate discount if applicable
    $hasDiscount = false;
    $discountPercent = 0;
    $originalPrice = null;
    $currentPrice = $product?->price ?? 0;
    
    // Check if discount fields exist and are valid
    if (isset($product->discount_price) && $product->discount_price > 0 && $product->discount_price < $currentPrice) {
        // Check if discount is within valid date range (if date fields exist)
        $now = now();
        $discountValid = true;
        
        if (isset($product->discount_starts_at) && $product->discount_starts_at && $now < $product->discount_starts_at) {
            $discountValid = false;
        }
        
        if (isset($product->discount_ends_at) && $product->discount_ends_at && $now > $product->discount_ends_at) {
            $discountValid = false;
        }
        
        if ($discountValid) {
            $hasDiscount = true;
            $originalPrice = $currentPrice;
            $currentPrice = $product->discount_price;
            $discountPercent = round((($originalPrice - $currentPrice) / $originalPrice) * 100);
        }
    }
    
    // Get free shipping threshold from settings (default 50000 if not set)
    $freeShippingThreshold = 50000; // Default value
    if (isset($settings) && isset($settings->free_shipping_threshold)) {
        $freeShippingThreshold = $settings->free_shipping_threshold;
    }
    $hasFreeShipping = $currentPrice >= $freeShippingThreshold;
    
    // Check if this is a hot/trending item
    $isTrending = $stockQuantity !== null && $stockQuantity <= 20 && $stockQuantity > 0;
    
    // Display helpers
    $showRating = $rating > 0; // Only show rating if it exists
    $soldCountDisplay = $soldCount > 0 ? number_format($soldCount) . '+ terjual' : '0 terjual';
    $ratingDisplay = $showRating ? number_format($rating, 1) : 'Belum ada rating';
@endphp

<div class="tkpd-card-enhanced">
    <a href="{{ $product ? route('shop-detail', $product->id) : '#' }}" class="tkpd-card-link-enhanced">
        
        <!-- Image Container with Badges -->
        <div class="tkpd-img-container">
            <img src="{{ $image }}" alt="{{ $product?->name ?? 'Product' }}" class="tkpd-img">
            
            <!-- Badge Collection - Top Left Corner -->
            <div class="tkpd-badges-top-left">
                @if($isTrending)
                    <span class="tkpd-badge-hot">
                        <i class="fas fa-fire"></i> Terlaris
                    </span>
                @endif
                
                @if($product?->type === 'configurable')
                    <span class="tkpd-badge-variant">
                        <i class="fas fa-layer-group"></i> {{ $product->productVariants->count() ?? 'Multi' }} Varian
                    </span>
                @endif
            </div>

            <!-- Top Right - Free Shipping Badge -->
            @if($hasFreeShipping)
                <div class="tkpd-badge-shipping">
                    <i class="fas fa-shipping-fast"></i> Gratis Ongkir
                </div>
            @endif

            <!-- Wishlist Heart Button - Top Right Corner -->
            <button class="tkpd-wishlist-btn" title="Tambah ke wishlist" onclick="event.preventDefault();">
                <i class="far fa-heart"></i>
            </button>

            <!-- Image Overlay on Hover -->
            <div class="tkpd-img-overlay">
                <div class="tkpd-overlay-actions">
                    <button class="tkpd-btn-quick-view" onclick="event.preventDefault();" title="Lihat cepat">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="tkpd-btn-quick-cart add-to-card"
                        product-id="{{ $product?->id ?? '' }}"
                        product-type="{{ $product?->type ?? 'simple' }}"
                        product-slug="{{ $product?->slug ?? '' }}"
                        title="Tambah ke keranjang">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>

            <!-- Stock Status Bar (Bottom of Image) -->
            @if($stockQuantity !== null && $stockQuantity <= 20 && $stockQuantity > 0)
                <div class="tkpd-stock-bar">
                    <div class="tkpd-stock-bar-fill" style="width: {{ ($stockQuantity / 20) * 100 }}%"></div>
                    <span class="tkpd-stock-text">
                        <i class="fas fa-bolt"></i> Tersisa {{ $stockQuantity }} pcs
                    </span>
                </div>
            @elseif($stockQuantity !== null && $stockQuantity === 0)
                <div class="tkpd-stock-bar tkpd-stock-bar--empty">
                    <span class="tkpd-stock-text">
                        <i class="fas fa-times-circle"></i> Stok Habis
                    </span>
                </div>
            @endif
        </div>

        <!-- Card Content Area -->
        <div class="tkpd-content">
            <!-- Official Store Badge -->
            @if($hasOfficialStore)
                <div class="tkpd-official-badge">
                    <i class="fas fa-check-circle"></i> 
                    <span>{{ $hasOfficialStore }}</span>
                </div>
            @endif

            <!-- Product Title with Better Typography -->
            <h3 class="tkpd-title">{{ $product?->name ?? 'Product Name' }}</h3>

            <!-- Price Section with Discount -->
            <div class="tkpd-price-section">
                @if($hasDiscount)
                    <div class="tkpd-price-original">Rp{{ number_format($originalPrice, 0, ',', '.') }}</div>
                    <div class="tkpd-price-row">
                        <span class="tkpd-price-current">Rp{{ number_format($currentPrice, 0, ',', '.') }}</span>
                        <span class="tkpd-discount-badge">{{ $discountPercent }}%</span>
                    </div>
                @else
                    <div class="tkpd-price-current">Rp{{ number_format($currentPrice, 0, ',', '.') }}</div>
                @endif
            </div>

            <!-- Rating and Sales Info -->
            <div class="tkpd-rating-row">
                <div class="tkpd-stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $ratingStars)
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="tkpd-rating-num">{{ $ratingDisplay }}</span>
                <span class="tkpd-divider">|</span>
                <span class="tkpd-sold-count">{{ $soldCountDisplay }}</span>
            </div>

            <!-- Location/Category Info -->
            <div class="tkpd-location-row">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $categoryName }}</span>
            </div>

            <!-- CTA Button (visible on mobile, on hover for desktop) -->
            <div class="tkpd-cta-section">
                <button class="tkpd-btn-add-cart add-to-card"
                    product-id="{{ $product?->id ?? '' }}"
                    product-type="{{ $product?->type ?? 'simple' }}"
                    product-slug="{{ $product?->slug ?? '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Tambah ke Keranjang</span>
                </button>
            </div>
        </div>
    </a>
</div>
