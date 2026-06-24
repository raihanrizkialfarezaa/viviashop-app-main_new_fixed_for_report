@extends('frontend.layouts')
@section('content')
    <style>
        :root {
            --cart-green-900: #082d1c;
            --cart-green-800: #0d4f30;
            --cart-green-700: #147043;
            --cart-green-600: #1a8e56;
            --cart-green-500: #22c55e;
            --cart-green-50: #f0fdf4;
            --cart-ink: #0f172a;
            --cart-muted: #64748b;
            --cart-border: #e2e8f0;
            --r-lg: 20px;
            --r-xl: 28px;
            --t: 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cart-page-header {
            position: relative;
            margin-top: 18px;
            padding: 4.5rem 0 5.25rem;
            border-radius: 0 0 var(--r-xl) var(--r-xl);
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.15), transparent 30%),
                radial-gradient(circle at 80% 20%, rgba(34,197,94,0.12), transparent 25%),
                linear-gradient(135deg, #082d1c 0%, #0d4f30 50%, #1a8e56 100%);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(13,79,48,0.15);
        }

        .cart-page-header::after {
            content: '';
            position: absolute;
            right: -80px;
            top: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.1), rgba(255,255,255,0));
            pointer-events: none;
        }

        .cart-hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .cart-hero-kicker,
        .cart-panel-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .cart-hero-kicker {
            margin-bottom: 1.25rem;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .cart-page-header .breadcrumb {
            gap: 0.4rem;
        }

        .cart-page-header .breadcrumb-item,
        .cart-page-header .breadcrumb-item a {
            color: rgba(255,255,255,0.76) !important;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .cart-page-header .breadcrumb-item.active {
            color: #fff !important;
        }

        .cart-stage {
            position: relative;
            margin-top: -60px;
            padding-top: 0 !important;
        }

        .cart-surface,
        .cart-summary {
            border-radius: var(--r-xl);
            background: #fff;
            border: 1px solid var(--cart-border);
            box-shadow: 0 20px 40px rgba(15,81,50,0.04);
            transition: box-shadow var(--t);
        }

        .cart-alert-shell {
            padding: 12px;
        }

        .cart-alert-shell .alert {
            border-radius: 16px;
            border: none;
            margin: 0;
            font-weight: 600;
        }

        .cart-list-panel {
            padding: 24px;
        }

        .cart-panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .cart-panel-kicker {
            background: rgba(13,79,48,0.06);
            color: var(--cart-green-800);
            margin-bottom: 0.75rem;
        }

        .cart-panel-head h2,
        .cart-summary-head h2 {
            margin: 0 0 0.4rem;
            font-family: 'Raleway', sans-serif;
            font-size: clamp(1.5rem, 3.5vw, 2rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.02em;
            color: var(--cart-ink);
        }

        .cart-panel-head p,
        .cart-summary-head p {
            margin: 0;
            color: var(--cart-muted);
            line-height: 1.6;
            font-size: 0.92rem;
        }

        .cart-head-link,
        .btn-outline-soft {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 20px;
            border-radius: 999px;
            border: 1px solid rgba(13,79,48,0.12);
            background: rgba(255,255,255,0.96);
            color: var(--cart-green-800);
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            box-shadow: 0 8px 16px rgba(13,79,48,0.04);
            transition: all var(--t);
        }

        .cart-head-link:hover,
        .btn-outline-soft:hover {
            transform: translateY(-2px);
            color: #fff;
            background: var(--cart-green-800);
            border-color: var(--cart-green-800);
            box-shadow: 0 12px 24px rgba(13,79,48,0.15);
        }

        .cart-table {
            border-collapse: separate;
            border-spacing: 0 16px;
            width: 100%;
            margin-bottom: 1rem;
        }

        .cart-table thead th {
            border: 0;
            background: transparent;
            color: var(--cart-muted);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0 1.25rem 0.25rem;
        }

        .cart-item-row {
            background: #fff;
            box-shadow: 0 12px 24px rgba(15,81,50,0.03);
            border-radius: 18px;
            transition: all var(--t);
        }
        
        .cart-item-row:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 36px rgba(13,79,48,0.08);
            background: var(--cart-green-50);
        }

        .cart-table tbody td,
        .cart-table tbody th {
            vertical-align: middle;
            padding: 1.25rem;
            border-top: 0;
            border-bottom: 1px solid rgba(13,79,48,0.03);
            background: transparent;
        }

        .cart-table tbody th:first-child {
            border-top-left-radius: 18px;
            border-bottom-left-radius: 18px;
            width: 40%;
        }

        .cart-table tbody td:last-child {
            border-top-right-radius: 18px;
            border-bottom-right-radius: 18px;
        }

        .cart-line {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .product-thumb-sm {
            width: 86px;
            height: 86px;
            object-fit: cover;
            border-radius: 16px;
            background: #f8fafc;
            box-shadow: 0 8px 18px rgba(15,81,50,0.06);
            border: 1px solid var(--cart-border);
            transition: transform var(--t);
        }
        
        .cart-item-row:hover .product-thumb-sm {
            transform: scale(1.05);
        }

        .product-line-name {
            font-size: 0.95rem;
            color: var(--cart-ink);
            font-weight: 800;
            line-height: 1.35;
            margin-bottom: 0.35rem;
        }

        .product-line-meta {
            font-size: 0.78rem;
            color: var(--cart-muted);
            line-height: 1.5;
        }

        .line-pill-row {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .line-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 999px;
            background: #f8fafc;
            border: 1px solid var(--cart-border);
            color: var(--cart-ink);
            font-size: 0.7rem;
            font-weight: 700;
            width: fit-content;
        }

        .line-pill--accent {
            background: rgba(20,112,67,0.08);
            border-color: rgba(20,112,67,0.1);
            color: var(--cart-green-800);
        }

        /* Interactive Counter Widget */
        .qty-input-group {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #fff;
            border: 1px solid var(--cart-border);
            border-radius: 12px;
            padding: 4px;
            width: fit-content;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            transition: border-color var(--t), box-shadow var(--t);
        }
        
        .qty-input-group:focus-within {
            border-color: var(--cart-green-700);
            box-shadow: 0 6px 15px rgba(13,79,48,0.08);
        }

        .qty-control-btn {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: none;
            background: #f1f5f9;
            color: var(--cart-ink);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            padding: 0;
        }

        .qty-control-btn:hover:not(:disabled) {
            background: var(--cart-green-800) !important;
            color: #fff !important;
            box-shadow: 0 4px 10px rgba(13,79,48,0.18);
        }

        .qty-control-btn:active:not(:disabled) {
            transform: scale(0.9);
        }
        
        .qty-control-btn:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        .qty-value {
            width: 36px !important;
            border: none !important;
            background: transparent !important;
            text-align: center;
            font-weight: 800;
            font-size: 0.85rem;
            color: var(--cart-ink);
            padding: 0 !important;
            box-shadow: none !important;
            margin: 0 !important;
            outline: none !important;
        }

        .qty-value::-webkit-outer-spin-button,
        .qty-value::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .qty-value[type=number] {
            -moz-appearance: textfield;
        }

        .price-amount {
            font-weight: 800;
            color: var(--cart-green-800);
            font-size: 0.95rem;
            white-space: nowrap;
        }
        
        .line-total {
            color: var(--cart-ink);
            font-weight: 800;
        }

        .btn-delete-ajax {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important;
            background: #fff !important;
            border: 1px solid rgba(239,68,68,0.15) !important;
            box-shadow: 0 6px 12px rgba(239,68,68,0.05);
            transition: all var(--t);
            cursor: pointer;
            padding: 0;
            outline: none;
        }

        .btn-delete-ajax:hover {
            background: #fee2e2 !important;
            border-color: #fca5a5 !important;
            color: #b42318 !important;
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 10px 20px rgba(239,68,68,0.12);
        }

        .btn-delete-ajax:active {
            transform: translateY(0) scale(1);
        }

        .cart-helper-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 1.5rem;
        }

        .cart-helper-card {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding: 16px;
            border-radius: var(--r-lg);
            background: #fafcfb;
            border: 1px solid rgba(13,79,48,0.05);
            box-shadow: 0 8px 16px rgba(15,81,50,0.02);
        }

        .cart-helper-card i {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(13,79,48,0.08);
            color: var(--cart-green-800);
            font-size: 0.95rem;
        }

        .cart-helper-card strong {
            display: block;
            color: var(--cart-ink);
            font-size: 0.85rem;
            margin-bottom: 0.2rem;
            font-weight: 700;
        }

        .cart-helper-card span {
            display: block;
            color: var(--cart-muted);
            font-size: 0.78rem;
            line-height: 1.5;
        }

        .cart-summary {
            padding: 24px;
            position: sticky;
            top: 120px;
            box-shadow: 0 20px 40px rgba(15,81,50,0.05);
        }

        .cart-summary-head {
            margin-bottom: 1.5rem;
        }

        .summary-note {
            padding: 14px 16px;
            border-radius: 16px;
            background: var(--cart-green-50);
            color: var(--cart-green-800);
            border: 1px solid rgba(13,79,48,0.08);
            font-size: 0.8rem;
            line-height: 1.6;
            font-weight: 600;
            margin-bottom: 1.25rem;
        }

        .cart-summary .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--cart-border);
        }

        .cart-summary .summary-row small {
            color: var(--cart-muted);
            font-weight: 600;
            font-size: 0.82rem;
        }

        .cart-summary .summary-row strong,
        .cart-summary .summary-row span {
            color: var(--cart-ink);
            font-weight: 800;
            font-size: 0.9rem;
        }

        .summary-total-row {
            padding-top: 1.25rem !important;
            margin-top: 0.25rem;
            border-bottom: 0 !important;
        }

        .summary-total-row small {
            font-size: 0.9rem !important;
            color: var(--cart-ink) !important;
            font-weight: 800 !important;
        }

        .summary-total-row .summary-total {
            font-size: 1.35rem !important;
            color: var(--cart-green-800) !important;
        }

        .btn-gradient {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 52px;
            background: linear-gradient(135deg, var(--cart-green-800) 0%, var(--cart-green-600) 100%);
            border: none;
            color: #fff;
            font-weight: 800;
            font-size: 0.9rem;
            padding: 0 24px;
            border-radius: 16px;
            width: 100%;
            letter-spacing: 0.02em;
            box-shadow: 0 10px 25px rgba(13,79,48,0.22);
            transition: all var(--t);
        }

        .btn-gradient:hover {
            color: #fff;
            transform: translateY(-2.5px);
            box-shadow: 0 14px 32px rgba(13,79,48,0.3);
        }
        
        .btn-gradient:active {
            transform: translateY(0);
        }

        .cart-summary-actions {
            display: grid;
            gap: 10px;
            margin-top: 1.5rem;
        }

        .empty-cart {
            text-align: center;
            padding: 4rem 1.5rem;
        }

        .empty-cart-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 1.25rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 24px;
            background: var(--cart-green-50);
            color: var(--cart-green-800);
            font-size: 1.8rem;
            box-shadow: 0 10px 20px rgba(13,79,48,0.06);
            border: 1px solid rgba(13,79,48,0.08);
        }

        .empty-cart h4 {
            margin-bottom: 0.5rem;
            color: var(--cart-ink);
            font-weight: 800;
            font-size: 1.25rem;
        }

        .empty-cart p {
            max-width: 400px;
            margin: 0 auto 1.5rem;
            color: var(--cart-muted);
            line-height: 1.6;
            font-size: 0.88rem;
        }

        /* Table Row Deletion Fade Out Animation */
        .cart-item-row.row-fade-out {
            opacity: 0 !important;
            transform: translateX(-30px) scale(0.96) !important;
            background: #fff5f5 !important;
            box-shadow: 0 4px 12px rgba(239,68,68,0.08) !important;
        }

        /* Badge Pop Animation */
        @keyframes badgePop {
            0% { transform: scale(1); }
            50% { transform: scale(1.35); }
            100% { transform: scale(1); }
        }
        .badge-pop {
            animation: badgePop 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
        }

        /* SweetAlert Spring Transitions */
        @keyframes swalScaleIn {
            0% { transform: scale(0.95) translateY(8px); opacity: 0; }
            100% { transform: scale(1) translateY(0); opacity: 1; }
        }
        @keyframes swalScaleOut {
            0% { transform: scale(1) translateY(0); opacity: 1; }
            100% { transform: scale(0.95) translateY(8px); opacity: 0; }
        }
        .swal-custom-show {
            animation: swalScaleIn 0.25s cubic-bezier(0.34, 1.56, 0.64, 1) forwards !important;
        }
        .swal-custom-hide {
            animation: swalScaleOut 0.18s cubic-bezier(0.36, 0.07, 0.19, 0.97) forwards !important;
        }
        .swal2-popup {
            border-radius: 20px !important;
            font-family: inherit !important;
        }

        @media (max-width: 991px) {
            .cart-page-header {
                padding: 4rem 0 4.75rem;
            }

            .cart-list-panel,
            .cart-summary {
                padding: 20px;
                border-radius: var(--r-lg);
            }

            .cart-table thead {
                display: none;
            }

            .cart-table,
            .cart-table tbody,
            .cart-table tr,
            .cart-table td,
            .cart-table th {
                display: block;
                width: 100%;
            }

            .cart-table tbody tr {
                padding: 1.25rem;
                margin-bottom: 12px;
                border: 1px solid var(--cart-border);
                box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            }

            .cart-table tbody th,
            .cart-table tbody td {
                padding: 8px 0;
                border: none !important;
                border-radius: 0 !important;
            }

            .cart-table tbody th:first-child {
                width: 100%;
                padding-bottom: 14px;
                border-bottom: 1px solid rgba(0,0,0,0.05) !important;
            }

            .cart-table tbody td::before {
                content: attr(data-label);
                display: block;
                margin-bottom: 0.25rem;
                color: var(--cart-muted);
                font-size: 0.7rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .cart-line {
                align-items: center;
            }

            .cart-helper-grid {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
                margin-top: 0;
            }
        }

        @media (max-width: 575px) {
            .cart-page-header {
                border-radius: 0 0 var(--r-lg) var(--r-lg);
            }

            .cart-stage {
                margin-top: -45px;
            }

            .cart-hero-content h1 {
                font-size: 1.85rem;
            }

            .cart-panel-head {
                align-items: stretch;
            }

            .cart-head-link {
                width: 100%;
            }

            .cart-line {
                flex-direction: row;
                text-align: left;
            }

            .product-thumb-sm {
                width: 72px;
                height: 72px;
            }

            .qty-input-group {
                width: 100%;
                max-width: 130px;
            }

            .btn-delete-ajax {
                width: 100%;
                min-height: 44px;
                gap: 8px;
                border-radius: 12px !important;
            }

            .btn-delete-ajax::after {
                content: 'Hapus Item';
                color: #b42318;
                font-size: 0.85rem;
                font-weight: 700;
            }
        }
    </style>
    @php
        $cartLineCount = count($items);
    @endphp

    <div class="container-fluid page-header cart-page-header py-5">
        <div class="container">
            <div class="cart-hero-content text-center">
                <span class="cart-hero-kicker"><i class="fas fa-shopping-basket"></i> Keranjang Belanja</span>
                <h1 class="text-white display-6 fw-bold mb-3">Semua Item Anda Siap Checkout</h1>
                <p class="text-white-50 lead mb-3" style="font-size: 0.95rem;">Tampilan keranjang dibuat lebih fokus agar edit jumlah, cek total, dan lanjut ke pembayaran terasa lebih cepat di desktop maupun mobile.</p>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('shop') }}">Shop</a></li>
                    <li class="breadcrumb-item active text-white">Cart</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid cart-stage py-5">
        <div class="container pb-5">
            @if(session()->has('message'))
                <div class="cart-surface cart-alert-shell mb-4">
                    <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('message') }}</strong>
                    </div>
                </div>
            @endif

            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <div class="cart-surface cart-list-panel">
                        <div class="cart-panel-head">
                            <div>
                                <span class="cart-panel-kicker"><i class="fas fa-layer-group"></i> Ringkasan Item</span>
                                <h2>Keranjang Anda</h2>
                                <p>Tinjau item pesanan Anda sebelum melanjutkan ke proses checkout pembayaran.</p>
                            </div>
                            <a href="{{ url('shop') }}" class="cart-head-link"><i class="fas fa-plus"></i> Tambah Produk</a>
                        </div>

                        <!-- Table Container (Visible if cart has items) -->
                        <div class="cart-table-container" style="display: {{ $cartLineCount > 0 ? 'block' : 'none' }};">
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Info</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            @php
                                                $attributeText = null;
                                                if (isset($item->options['type']) && $item->options['type'] === 'configurable') {
                                                    $product = \App\Models\Product::find($item->options['product_id']);
                                                    $image = !empty($item->options['image']) ? asset('storage/' . $item->options['image']) : asset('themes/ezone/assets/img/cart/3.jpg');
                                                    $variant = \App\Models\ProductVariant::find($item->options['variant_id']);
                                                    $maxQty = $variant->stock ?? 1;
                                                    $displayName = $item->name;
                                                    $typeLabel = 'Varian aktif';
                                                    if (isset($item->options['attributes']) && !empty($item->options['attributes'])) {
                                                        $attributes = [];
                                                        foreach ($item->options['attributes'] as $attr => $value) {
                                                            $attributes[] = $attr . ': ' . $value;
                                                        }
                                                        $attributeText = implode(', ', $attributes);
                                                        $displayName .= ' (' . $attributeText . ')';
                                                    }
                                                } else {
                                                    $product = \App\Models\Product::find($item->options['product_id']);
                                                    $image = !empty($product && $product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg');
                                                    $maxQty = $product && $product->productInventory ? $product->productInventory->qty : 1;
                                                    $displayName = $product ? $product->name : $item->name;
                                                    $typeLabel = 'Produk siap beli';
                                                }
                                                $stockLabel = $maxQty > 10 ? 'Stok aman' : ($maxQty > 0 ? 'Stok terbatas' : 'Stok habis');
                                            @endphp
                                            <tr class="cart-item-row" data-row-id="{{ $item->rowId }}" data-price="{{ $item->price }}">
                                                <th scope="row">
                                                    <div class="cart-line">
                                                        <img src="{{ $image }}" class="product-thumb-sm" alt="{{ $displayName }}">
                                                        <div>
                                                            <div class="product-line-name">{{ Str::limit($displayName, 76) }}</div>
                                                            <div class="product-line-meta">SKU: {{ $item->options['sku'] ?? ($product->sku ?? 'N/A') }}</div>
                                                            @if($attributeText)
                                                                <div class="product-line-meta" style="color: var(--cart-green-800); font-weight: 700; margin-top: 2px;">{{ $attributeText }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </th>
                                                <td data-label="Info">
                                                    <div class="line-pill-row">
                                                        <span class="line-pill line-pill--accent"><i class="fas fa-tag"></i>{{ $typeLabel }}</span>
                                                        <span class="line-pill"><i class="fas fa-box"></i>{{ $stockLabel }}</span>
                                                    </div>
                                                </td>
                                                <td data-label="Harga">
                                                    <div class="price-amount">Rp. {{ number_format($item->price,0,',','.') }}</div>
                                                </td>
                                                <td data-label="Jumlah">
                                                    <div class="qty-input-group">
                                                        <button type="button" class="qty-control-btn qty-minus" aria-label="Kurangi">
                                                            <i class="fas fa-minus" style="font-size: 0.6rem;"></i>
                                                        </button>
                                                        <input type="number" class="qty-value" value="{{ $item->qty }}" min="1" max="{{ $maxQty }}" readonly>
                                                        <button type="button" class="qty-control-btn qty-plus" aria-label="Tambah">
                                                            <i class="fas fa-plus" style="font-size: 0.6rem;"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td data-label="Total">
                                                    <div class="price-amount line-total">Rp. {{ number_format($item->price * $item->qty, 0, ',', '.') }}</div>
                                                </td>
                                                <td data-label="Aksi">
                                                    <button type="button" class="btn-delete-ajax" data-row-id="{{ $item->rowId }}" data-name="{{ $displayName }}" aria-label="Hapus {{ $displayName }} dari keranjang">
                                                        <i class="fa fa-times text-danger"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Empty State Container (Visible if cart is empty) -->
                        <div class="empty-cart-container" style="display: {{ $cartLineCount > 0 ? 'none' : 'block' }};">
                            <div class="empty-cart">
                                <span class="empty-cart-icon"><i class="fas fa-shopping-basket"></i></span>
                                <h4>Keranjang belanja kosong</h4>
                                <p>Belum ada produk yang dimasukkan ke keranjang belanja Anda. Mari mulai menjelajahi katalog produk premium kami.</p>
                                <a href="{{ url('shop') }}" class="btn btn-outline-soft"><i class="fas fa-store me-1"></i> Lihat Katalog Produk</a>
                            </div>
                        </div>

                        <!-- Helper Footer Elements -->
                        <div class="cart-helper-grid">
                            <div class="cart-helper-card">
                                <i class="fas fa-shield-alt"></i>
                                <div>
                                    <strong>Checkout Lebih Aman & Cepat</strong>
                                    <span>Ringkasan pesanan dan total biaya diverifikasi secara instan sebelum melakukan proses pembayaran akhir.</span>
                                </div>
                            </div>
                            <div class="cart-helper-card">
                                <i class="fas fa-truck"></i>
                                <div>
                                    <strong>Pengiriman Siap Proses</strong>
                                    <span>Setiap perubahan jumlah item disinkronkan secara aman di latar belakang tanpa mengganggu sesi belanja Anda.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <div class="cart-summary-head">
                            <span class="cart-panel-kicker"><i class="fas fa-receipt"></i> Order Summary</span>
                            <h2>Ringkasan Biaya</h2>
                            <p>Estimasi total belanjaan Anda sebelum ongkos kirim dan diskon tambahan.</p>
                        </div>

                        <div class="summary-note">
                            <i class="fas fa-info-circle me-1"></i> Perubahan jumlah belanjaan akan diperbarui secara langsung (real-time) di panel ringkasan ini.
                        </div>

                        <div class="summary-row">
                            <small>Jumlah baris item</small>
                            <strong id="summary-line-count">{{ $cartLineCount }}</strong>
                        </div>
                        <div class="summary-row">
                            <small>Total item di keranjang</small>
                            <strong id="summary-total-items">{{ \Gloudemans\Shoppingcart\Facades\Cart::count() }}</strong>
                        </div>
                        <div class="summary-row">
                            <small>Subtotal</small>
                            <span id="summary-subtotal">Rp. {{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal(0, ",", ".") }}</span>
                        </div>
                        <div class="summary-row">
                            <small>Estimasi pengiriman</small>
                            <span>3-5 hari kerja</span>
                        </div>
                        <div class="summary-row summary-total-row">
                            <small>Total checkout</small>
                            <span class="summary-total" id="summary-total">Rp. {{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal(0, ",", ".") }}</span>
                        </div>

                        <div class="cart-summary-actions">
                            @if($cartLineCount > 0)
                                <a href="{{ url('orders/checkout') }}" class="btn btn-gradient" id="btn-checkout-link"><i class="fas fa-lock"></i> Lanjut ke Checkout</a>
                            @else
                                <a href="{{ url('shop') }}" class="btn btn-gradient"><i class="fas fa-store"></i> Mulai Belanja</a>
                            @endif
                            <a href="{{ url('shop') }}" class="btn-outline-soft"><i class="fas fa-arrow-left"></i> Kembali ke Katalog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-alt')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    // Price formatting helper
    function fmtPrice(val) {
        return 'Rp. ' + new Intl.NumberFormat('id-ID').format(val);
    }

    // Dynamic UI recalculation helper (Optimistic UI updates)
    function recalculateTotals() {
        let subtotal = 0;
        let totalItems = 0;
        let lineCount = 0;

        $('.cart-item-row').each(function() {
            const $row = $(this);
            const price = parseFloat($row.data('price')) || 0;
            const qty = parseInt($row.find('.qty-value').val()) || 0;
            
            subtotal += price * qty;
            totalItems += qty;
            lineCount++;
        });

        // Update checkout summary panel text
        $('#summary-line-count').text(lineCount);
        $('#summary-total-items').text(totalItems);
        $('#summary-subtotal').text(fmtPrice(subtotal));
        $('#summary-total').text(fmtPrice(subtotal));

        // Sync header counts
        document.querySelectorAll('.site-cart-badge, .site-mobile-action-badge').forEach(badge => {
            const prevCount = parseInt(badge.textContent) || 0;
            badge.textContent = totalItems;
            if (prevCount !== totalItems) {
                badge.classList.add('badge-pop');
                setTimeout(() => badge.classList.remove('badge-pop'), 400);
            }
        });

        // Toggle visibility of tables & empty state illustration
        if (lineCount === 0) {
            $('.cart-table-container').fadeOut(300, function() {
                $('.empty-cart-container').fadeIn(300);
            });
            $('.cart-summary-actions').html(`
                <a href="{{ url('shop') }}" class="btn btn-gradient"><i class="fas fa-store"></i> Mulai Belanja</a>
                <a href="{{ url('shop') }}" class="btn-outline-soft"><i class="fas fa-arrow-left"></i> Kembali ke Katalog</a>
            `);
        }
    }

    // Disable qty decrease button if current count is 1
    function syncMinusButtons() {
        $('.cart-item-row').each(function() {
            const $row = $(this);
            const qty = parseInt($row.find('.qty-value').val()) || 1;
            const $minusBtn = $row.find('.qty-minus');
            if (qty <= 1) {
                $minusBtn.prop('disabled', true);
            } else {
                $minusBtn.prop('disabled', false);
            }
        });
    }

    // Initialize layout configurations
    syncMinusButtons();

    // Qty Increment (+) Click Event
    $(document).on('click', '.qty-plus', function(e) {
        e.preventDefault();
        const $row = $(this).closest('.cart-item-row');
        const rowId = $row.data('row-id');
        const price = parseFloat($row.data('price')) || 0;
        const $input = $row.find('.qty-value');
        const maxQty = parseInt($input.attr('max')) || 9999;
        const currentQty = parseInt($input.val()) || 1;

        if (currentQty >= maxQty) {
            Swal.fire({
                title: 'Stok Terbatas',
                text: `Batas stok tersedia: ${maxQty} unit.`,
                icon: 'warning',
                confirmButtonColor: '#0d4f30',
                showClass: { popup: 'swal-custom-show' },
                hideClass: { popup: 'swal-custom-hide' }
            });
            return;
        }

        const newQty = currentQty + 1;
        $input.val(newQty);
        
        // Optimistic UI updates
        $row.find('.line-total').text(fmtPrice(price * newQty));
        syncMinusButtons();
        recalculateTotals();

        // Trigger asynchronous server save
        syncQtyToServer(rowId, newQty, currentQty, $input, price, $row);
    });

    // Qty Decrement (-) Click Event
    $(document).on('click', '.qty-minus', function(e) {
        e.preventDefault();
        const $row = $(this).closest('.cart-item-row');
        const rowId = $row.data('row-id');
        const price = parseFloat($row.data('price')) || 0;
        const $input = $row.find('.qty-value');
        const currentQty = parseInt($input.val()) || 1;

        if (currentQty <= 1) return;

        const newQty = currentQty - 1;
        $input.val(newQty);

        // Optimistic UI updates
        $row.find('.line-total').text(fmtPrice(price * newQty));
        syncMinusButtons();
        recalculateTotals();

        // Trigger asynchronous server save
        syncQtyToServer(rowId, newQty, currentQty, $input, price, $row);
    });

    // Debounced server updater logic
    let syncTimeout = null;
    function syncQtyToServer(rowId, qty, previousQty, $input, price, $row) {
        if (syncTimeout) clearTimeout(syncTimeout);
        
        $row.css('opacity', '0.7');

        syncTimeout = setTimeout(() => {
            fetch('/carts/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    cart_item_id: rowId,
                    quantity: qty
                })
            })
            .then(r => r.json())
            .then(d => {
                $row.css('opacity', '1');
                if (d.status === 'success') {
                    // Update layout values from database values
                    $('#summary-subtotal').text(fmtPrice(d.subtotal));
                    $('#summary-total').text(fmtPrice(d.subtotal));
                    $('#summary-total-items').text(d.cart_count);
                    $('#summary-line-count').text(d.cart_line_count);
                    
                    document.querySelectorAll('.site-cart-badge, .site-mobile-action-badge').forEach(badge => {
                        badge.textContent = d.cart_count;
                    });
                } else {
                    // Rollback optimistic values on failure
                    $input.val(previousQty);
                    $row.find('.line-total').text(fmtPrice(price * previousQty));
                    syncMinusButtons();
                    recalculateTotals();
                    
                    Swal.fire({
                        title: 'Gagal',
                        text: d.message || 'Gagal mengubah jumlah barang',
                        icon: 'error',
                        confirmButtonColor: '#0d4f30',
                        showClass: { popup: 'swal-custom-show' },
                        hideClass: { popup: 'swal-custom-hide' }
                    });
                }
            })
            .catch(err => {
                $row.css('opacity', '1');
                // Rollback optimistic values on failure
                $input.val(previousQty);
                $row.find('.line-total').text(fmtPrice(price * previousQty));
                syncMinusButtons();
                recalculateTotals();
                
                console.error('[Cart Update Error]:', err);
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan sistem saat mengubah jumlah.',
                    icon: 'error',
                    confirmButtonColor: '#0d4f30',
                    showClass: { popup: 'swal-custom-show' },
                    hideClass: { popup: 'swal-custom-hide' }
                });
            });
        }, 300);
    }

    // AJAX-based deletion Click Event
    $(document).on('click', '.btn-delete-ajax', function(e) {
        e.preventDefault();
        const $btn = $(this);
        const rowId = $btn.data('row-id');
        const name = $btn.data('name');
        const $row = $btn.closest('.cart-item-row');

        Swal.fire({
            title: 'Hapus Produk?',
            text: `Apakah Anda yakin ingin menghapus "${name}" dari keranjang?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            showClass: { popup: 'swal-custom-show' },
            hideClass: { popup: 'swal-custom-hide' }
        }).then((result) => {
            if (result.isConfirmed) {
                // Optimistically hide the row instantly
                $row.addClass('row-fade-out');
                
                // Fetch AJAX removal request
                fetch(`/carts/remove/${rowId}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(d => {
                    if (d.status === 'success') {
                        setTimeout(() => {
                            $row.remove();
                            recalculateTotals();
                            
                            // Apply confirmed totals from server database
                            $('#summary-subtotal').text(fmtPrice(d.subtotal));
                            $('#summary-total').text(fmtPrice(d.subtotal));
                            $('#summary-total-items').text(d.cart_count);
                            $('#summary-line-count').text(d.cart_line_count);
                            
                            document.querySelectorAll('.site-cart-badge, .site-mobile-action-badge').forEach(badge => {
                                badge.textContent = d.cart_count;
                                badge.classList.add('badge-pop');
                                setTimeout(() => badge.classList.remove('badge-pop'), 400);
                            });

                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Produk berhasil dihapus dari keranjang.',
                                icon: 'success',
                                timer: 1200,
                                showConfirmButton: false,
                                timerProgressBar: true,
                                showClass: { popup: 'swal-custom-show' },
                                hideClass: { popup: 'swal-custom-hide' }
                            });
                        }, 300);
                    } else {
                        // Restore row if failed
                        $row.removeClass('row-fade-out');
                        Swal.fire({
                            title: 'Gagal',
                            text: d.message || 'Gagal menghapus produk.',
                            icon: 'error',
                            confirmButtonColor: '#0d4f30',
                            showClass: { popup: 'swal-custom-show' },
                            hideClass: { popup: 'swal-custom-hide' }
                        });
                    }
                })
                .catch(err => {
                    // Restore row if failed
                    $row.removeClass('row-fade-out');
                    console.error('[Cart Remove Error]:', err);
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan sistem saat menghapus produk.',
                        icon: 'error',
                        confirmButtonColor: '#0d4f30',
                        showClass: { popup: 'swal-custom-show' },
                        hideClass: { popup: 'swal-custom-hide' }
                    });
                });
            }
        });
    });
});
</script>
@endpush