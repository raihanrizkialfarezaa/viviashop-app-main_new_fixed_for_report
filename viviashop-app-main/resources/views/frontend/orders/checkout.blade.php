@extends('frontend.layouts')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        :root {
            --checkout-green-900: #082d1c;
            --checkout-green-800: #0d4f30;
            --checkout-green-700: #147043;
            --checkout-green-600: #1a8e56;
            --checkout-green-500: #22c55e;
            --checkout-green-50: #f0fdf4;
            --checkout-ink: #0f172a;
            --checkout-muted: #64748b;
            --checkout-border: #e2e8f0;
            --checkout-bg-light: #f8fafc;
            --r-lg: 16px;
            --r-xl: 24px;
            --t: 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .checkout-page-header {
            position: relative;
            margin-top: 18px;
            padding: 3.5rem 0 4.5rem;
            border-radius: 0 0 var(--r-xl) var(--r-xl);
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.15), transparent 30%),
                radial-gradient(circle at 80% 20%, rgba(34,197,94,0.12), transparent 25%),
                linear-gradient(135deg, #082d1c 0%, #0d4f30 50%, #1a8e56 100%);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(13,79,48,0.15);
        }

        .checkout-page-header::after {
            content: '';
            position: absolute;
            right: -80px;
            top: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.1), rgba(255,255,255,0));
            pointer-events: none;
        }

        .checkout-hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .checkout-hero-kicker,
        .checkout-shell-kicker {
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

        .checkout-hero-kicker {
            margin-bottom: 1.25rem;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .checkout-page-header .breadcrumb {
            gap: 0.4rem;
        }

        .checkout-page-header .breadcrumb-item,
        .checkout-page-header .breadcrumb-item a {
            color: rgba(255,255,255,0.76) !important;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .checkout-page-header .breadcrumb-item.active {
            color: #fff !important;
        }

        .checkout-stage {
            position: relative;
            margin-top: -50px;
            padding-top: 0 !important;
        }

        .checkout-surface {
            border-radius: var(--r-xl);
            background: #fff;
            border: 1px solid var(--checkout-border);
            box-shadow: 0 12px 30px rgba(15, 81, 50, 0.03);
            transition: all var(--t);
        }

        .checkout-form-shell,
        .checkout-summary-shell,
        .checkout-payment-shell {
            padding: 24px;
        }

        .checkout-sticky-stack {
            position: sticky;
            top: var(--sticky-safe-top, 110px);
        }

        .checkout-shell-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 1.25rem;
        }

        .checkout-shell-kicker {
            background: rgba(13,79,48,0.06);
            color: var(--checkout-green-800);
            margin-bottom: 0.75rem;
        }

        .checkout-shell-head h2 {
            margin: 0 0 0.4rem;
            font-family: 'Raleway', sans-serif;
            font-size: clamp(1.5rem, 3.5vw, 2rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.02em;
            color: var(--checkout-ink);
        }

        .checkout-shell-head p {
            margin: 0;
            color: var(--checkout-muted);
            line-height: 1.6;
            font-size: 0.92rem;
        }

        .checkout-shell-badge,
        .info-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid var(--checkout-border);
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            color: var(--checkout-green-800);
            font-weight: 700;
            font-size: 0.78rem;
        }

        .checkout-resume-alert {
            border-radius: 16px;
            border: none;
            margin-bottom: 1.25rem;
            background: var(--checkout-green-50);
            color: var(--checkout-green-800);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(13,79,48,0.03);
            font-size: 0.9rem;
        }

        .checkout-subcard,
        .summary-panel {
            padding: 24px;
            border-radius: var(--r-lg);
            background: var(--checkout-bg-light);
            border: 1px solid var(--checkout-border);
            margin-top: 20px;
            transition: all var(--t);
        }

        .checkout-subcard + .checkout-subcard,
        .checkout-payment-shell,
        .summary-panel,
        .place-order-wrap {
            margin-top: 1rem;
        }

        .checkout-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.75rem;
            color: var(--checkout-ink);
            font-size: 1.05rem;
            font-weight: 800;
        }

        .checkout-card-title i {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(13,79,48,0.06);
            color: var(--checkout-green-800);
            font-size: 1rem;
        }

        .checkout-card-copy {
            margin: 0 0 1.25rem;
            color: var(--checkout-muted);
            font-size: 0.88rem;
            line-height: 1.6;
        }

        .form-item {
            margin-bottom: 0;
        }

        .form-item label,
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--checkout-ink);
            font-size: 0.88rem;
            font-weight: 700;
        }

        .required {
            color: #ef4444;
        }

        .form-control,
        .form-select {
            min-height: 48px;
            border-radius: 12px;
            border: 1.5px solid var(--checkout-border);
            background: #fff;
            color: var(--checkout-ink);
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.01);
            padding-inline: 16px;
            transition: all var(--t);
            font-size: 0.95rem;
        }

        textarea.form-control {
            min-height: 100px;
            padding-top: 12px;
            resize: vertical;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--checkout-green-600);
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.12);
            outline: none;
        }

        .checkout-preview-card {
            padding: 14px;
            border-radius: 14px;
            background: #fff;
            border: 1px dashed var(--checkout-border);
        }

        .img-preview {
            border-radius: 10px;
            border: 1px solid var(--checkout-border);
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }

        .checkout-option-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .checkout-payment-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .checkout-option-card {
            position: relative;
            display: block;
            cursor: pointer;
            margin: 0;
        }

        .checkout-choice-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checkout-option-body {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            border-radius: 16px;
            border: 1.5px solid var(--checkout-border);
            background: #fff;
            transition: all var(--t);
            height: 100%;
        }

        .checkout-choice-input:checked + .checkout-option-body {
            border-color: var(--checkout-green-600);
            background: var(--checkout-green-50);
            box-shadow: 0 8px 20px rgba(13, 79, 48, 0.05);
        }

        .checkout-option-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: var(--checkout-muted);
            font-size: 1.1rem;
            flex-shrink: 0;
            transition: all var(--t);
        }

        .checkout-option-icon i {
            font-family: "Font Awesome 5 Free" !important;
            font-weight: 900 !important;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1;
        }

        .checkout-choice-input:checked + .checkout-option-body .checkout-option-icon {
            background: var(--checkout-green-800);
            color: #fff;
        }

        .checkout-option-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .checkout-option-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--checkout-ink);
        }

        .checkout-option-desc {
            font-size: 0.8rem;
            color: var(--checkout-muted);
            margin-top: 2px;
            line-height: 1.4;
        }

        .checkout-order-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .checkout-order-item {
            display: grid;
            grid-template-columns: 64px 1fr auto;
            gap: 16px;
            padding: 14px;
            border-radius: 16px;
            background: #fff;
            border: 1px solid var(--checkout-border);
            align-items: center;
        }

        .order-thumb {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--checkout-border);
        }

        .checkout-order-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 0;
        }

        .order-line-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--checkout-ink);
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .order-line-meta {
            font-size: 0.8rem;
            color: var(--checkout-muted);
        }

        .order-line-foot {
            display: flex;
            align-items: center;
        }

        .order-price-qty {
            font-size: 0.82rem;
            color: var(--checkout-muted);
            font-weight: 500;
        }

        .order-line-total {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--checkout-green-800);
            text-align: right;
            white-space: nowrap;
        }

        .summary-note {
            padding: 12px 16px;
            border-radius: 14px;
            background: rgba(13,79,48,0.03);
            color: var(--checkout-muted);
            border: 1px solid var(--checkout-border);
            font-size: 0.82rem;
            line-height: 1.5;
        }

        .summary-panel .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-block: 12px;
            border-bottom: 1px dashed var(--checkout-border);
        }

        .summary-panel .summary-row:last-child {
            border-bottom: none;
        }

        .summary-panel .summary-row small {
            font-size: 0.88rem;
            color: var(--checkout-muted);
            font-weight: 500;
        }

        .summary-panel .summary-row strong,
        .summary-panel .summary-row span {
            font-size: 0.92rem;
            color: var(--checkout-ink);
        }

        .total-amount {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--checkout-green-800);
            letter-spacing: -0.02em;
        }

        .total-amount-note {
            font-size: 0.78rem;
            color: var(--checkout-muted);
            margin-top: 4px;
            line-height: 1.4;
        }

        #place-order-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 52px;
            background: linear-gradient(135deg, var(--checkout-green-800), var(--checkout-green-600));
            color: #fff !important;
            border: 0;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all var(--t);
            box-shadow: 0 6px 20px rgba(13, 79, 48, 0.15);
        }

        #place-order-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 79, 48, 0.25);
        }

        #place-order-btn:active {
            transform: translateY(0);
        }

        #place-order-btn:disabled {
            opacity: 0.6;
            transform: none;
            box-shadow: none;
            cursor: not-allowed;
        }

        .checkout-empty-state {
            padding: 2rem 0;
            text-align: center;
            color: var(--checkout-muted);
            font-size: 0.95rem;
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

        @media (max-width: 1199px) {
            .checkout-sticky-stack {
                top: var(--sticky-safe-top, 100px);
            }
        }

        @media (max-width: 991px) {
            .checkout-page-header {
                padding: 3rem 0 4rem;
            }

            .checkout-sticky-stack {
                position: static;
            }

            .checkout-form-shell,
            .checkout-summary-shell,
            .checkout-payment-shell {
                padding: 20px;
            }

            .checkout-shell-head {
                flex-direction: column;
                gap: 8px;
            }
        }

        @media (max-width: 767px) {
            .checkout-page-header {
                padding: 2.5rem 0 3.5rem !important;
                border-radius: 0 0 var(--r-lg) var(--r-lg) !important;
            }
            .checkout-stage {
                margin-top: -40px !important;
            }
            .checkout-hero-content h1 {
                font-size: 1.5rem !important;
            }
            .checkout-hero-content p {
                font-size: 0.85rem !important;
            }
            .checkout-surface {
                border-radius: var(--r-lg) !important;
            }
            .checkout-form-shell,
            .checkout-summary-shell,
            .checkout-payment-shell {
                padding: 16px !important;
            }
            .checkout-subcard,
            .summary-panel {
                padding: 14px !important;
                border-radius: 14px !important;
                margin-top: 12px !important;
            }
            .checkout-card-title {
                font-size: 0.95rem !important;
                margin-bottom: 0.5rem !important;
            }
            .checkout-card-title i {
                width: 32px !important;
                height: 32px !important;
                border-radius: 8px !important;
                font-size: 0.9rem !important;
            }
            .checkout-card-copy {
                font-size: 0.82rem !important;
                margin-bottom: 0.75rem !important;
            }
            .form-label,
            .form-item label {
                font-size: 0.82rem !important;
                margin-bottom: 0.4rem !important;
            }
            .form-control,
            .form-select {
                min-height: 42px !important;
                font-size: 0.88rem !important;
                border-radius: 10px !important;
                padding-inline: 12px !important;
            }
            textarea.form-control {
                min-height: 80px !important;
            }
            .checkout-option-grid {
                gap: 10px !important;
            }
            .checkout-option-body {
                padding: 10px 12px !important;
                border-radius: 12px !important;
                gap: 8px !important;
            }
            .checkout-option-icon {
                width: 32px !important;
                height: 32px !important;
                border-radius: 8px !important;
                font-size: 0.95rem !important;
            }
            .checkout-option-title {
                font-size: 0.82rem !important;
            }
            .checkout-option-desc {
                display: none !important;
            }
            .info-badge {
                font-size: 0.72rem !important;
                padding: 4px 8px !important;
            }
            .checkout-order-item {
                grid-template-columns: 50px 1fr auto !important;
                gap: 10px !important;
                padding: 10px !important;
                border-radius: 12px !important;
            }
            .order-thumb {
                width: 50px !important;
                height: 50px !important;
                border-radius: 8px !important;
            }
            .order-line-name {
                font-size: 0.82rem !important;
            }
            .order-price-qty {
                font-size: 0.75rem !important;
            }
            .order-line-total {
                font-size: 0.85rem !important;
            }
            .summary-panel .summary-row {
                padding-block: 8px !important;
            }
            .summary-panel .summary-row small {
                font-size: 0.8rem !important;
            }
            .summary-panel .summary-row strong,
            .summary-panel .summary-row span {
                font-size: 0.82rem !important;
            }
            .total-amount {
                font-size: 1.4rem !important;
            }
            .total-amount-note {
                font-size: 0.72rem !important;
            }
            #place-order-btn {
                min-height: 44px !important;
                font-size: 0.88rem !important;
                border-radius: 10px !important;
            }
        }

        /* Select2 Premium Theme Overrides */
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            height: 48px !important;
            border: 1.5px solid var(--checkout-border) !important;
            border-radius: 12px !important;
            display: flex !important;
            align-items: center !important;
            padding-left: 8px !important;
            transition: all var(--t) !important;
            background-color: #fff !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--checkout-ink) !important;
            font-size: 0.95rem !important;
            font-weight: 500 !important;
            padding-left: 8px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: var(--checkout-muted) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px !important;
            right: 12px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: var(--checkout-muted) transparent transparent transparent !important;
            border-width: 6px 5px 0 5px !important;
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent var(--checkout-muted) transparent !important;
            border-width: 0 5px 6px 5px !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: var(--checkout-green-600) !important;
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.12) !important;
            outline: none !important;
        }

        /* Dropdown styling */
        .select2-dropdown {
            border: 1.5px solid var(--checkout-border) !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
            overflow: hidden !important;
            z-index: 9999 !important;
            background-color: #fff !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1.5px solid var(--checkout-border) !important;
            border-radius: 8px !important;
            height: 38px !important;
            padding: 6px 12px !important;
            outline: none !important;
            font-size: 0.9rem !important;
            transition: all var(--t) !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            border-color: var(--checkout-green-600) !important;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1) !important;
        }

        .select2-results__options {
            max-height: 220px !important; /* Limits list height and triggers scroll paginate */
        }

        .select2-container--default .select2-results__option {
            padding: 10px 16px !important;
            font-size: 0.92rem !important;
            color: var(--checkout-ink) !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: var(--checkout-green-800) !important;
            color: #fff !important;
        }

        .select2-container--default .select2-results__option[aria-selected="true"] {
            background-color: var(--checkout-green-50) !important;
            color: var(--checkout-green-800) !important;
            font-weight: 700 !important;
        }

        /* Responsive Mobile Overrides */
        @media (max-width: 767px) {
            .select2-container--default .select2-selection--single {
                height: 42px !important;
                border-radius: 10px !important;
            }
            
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                font-size: 0.88rem !important;
            }
            
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 42px !important;
            }
            
            .select2-dropdown {
                border-radius: 10px !important;
            }
            
            .select2-container--default .select2-results__option {
                padding: 8px 12px !important;
                font-size: 0.85rem !important;
            }
        }
    </style>

    @php
        $subtotal = isset($resumeOrder) && $resumeOrder ? ($resumeOrder->base_total_price ?? 0) : (int)\Gloudemans\Shoppingcart\Facades\Cart::subtotal(0,'','');
        $cartLineCount = count($items);
    @endphp

    <div class="container-fluid page-header checkout-page-header py-5">
        <div class="container">
            <div class="checkout-hero-content text-center">
                <span class="checkout-hero-kicker"><i class="fas fa-lock"></i> Checkout</span>
                <h1 class="text-white display-5 fw-bold mb-3">Finalisasi Pesanan Dengan Tampilan Lebih Premium</h1>
                <p class="text-white-50 lead mb-3">Form, pilihan pengiriman, metode pembayaran, dan ringkasan order dirapikan supaya proses checkout terasa lebih jelas tanpa mengubah logic yang sudah berjalan.</p>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('carts') }}">Cart</a></li>
                    <li class="breadcrumb-item active text-white">Checkout</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid checkout-stage py-5">
        <div class="container pb-5">
            <form action="{{ route('orders.checkout') }}" method="post" enctype="multipart/form-data" id="checkout-form" onsubmit="return handleFormSubmit(event)">
                @csrf
                @if(isset($resumeOrder) && $resumeOrder)
                    <input type="hidden" name="resume_order_id" value="{{ $resumeOrder->id }}">
                @endif

                <div class="row g-4 align-items-start">
                    <div class="col-md-12 col-lg-7 col-xl-7">
                        <div class="checkout-surface checkout-form-shell">
                            <div class="checkout-shell-head">
                                <div>
                                    <span class="checkout-shell-kicker"><i class="fas fa-id-card"></i> Data Pemesan</span>
                                    <h2>Billing Details</h2>
                                    <p>Lengkapi identitas, alamat, dan preferensi pengiriman dengan layout yang lebih rapi agar pengecekan data terasa lebih cepat.</p>
                                </div>
                                <span class="checkout-shell-badge"><i class="fas fa-bag-shopping"></i>{{ $cartLineCount }} baris item</span>
                            </div>

                            @if(isset($resumeOrder) && $resumeOrder)
                                <div class="alert checkout-resume-alert">Resuming previous order #{{ $resumeOrder->code }}. You can complete payment or edit details before placing order.</div>
                            @endif

                            <div class="checkout-subcard">
                                <div class="checkout-card-title"><i class="fa fa-user"></i><span>Informasi Kontak</span></div>
                                <p class="checkout-card-copy">Data kontak Anda untuk konfirmasi pesanan dan koordinasi pengambilan/pengiriman.</p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-item w-100">
                                            <label>Nama Lengkap <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_first_name : auth()->user()->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label>No. Telepon / WhatsApp <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_phone : auth()->user()->phone) }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-item">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="email" value="{{ old('email', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_email : auth()->user()->email) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-subcard">
                                <div class="checkout-card-title"><i class="fa fa-truck"></i><span>Metode Pengiriman</span></div>
                                <p class="checkout-card-copy">Pilih ambil langsung di toko atau kirim ke alamat Anda menggunakan layanan kurir.</p>

                                <div class="checkout-option-grid">
                                    <label class="checkout-option-card" for="delivery-self">
                                        <input type="radio" class="form-check-input checkout-choice-input" id="delivery-self" name="delivery_method" value="self" checked>
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-store"></i></span>
                                            <span class="checkout-option-content">
                                                <span class="checkout-option-title">Self Pickup</span>
                                                <span class="checkout-option-desc">Ambil langsung di toko tanpa ongkir tambahan.</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="checkout-option-card" for="delivery-courier">
                                        <input type="radio" class="form-check-input checkout-choice-input" id="delivery-courier" name="delivery_method" value="courier">
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-truck"></i></span>
                                            <span class="checkout-option-content">
                                                <span class="checkout-option-title">Courier Delivery</span>
                                                <span class="checkout-option-desc">Kirim ke alamat tujuan dengan pilihan layanan ongkir.</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div id="shipping-address-section" style="display: none; margin-top: 20px;">
                                <div class="checkout-subcard">
                                    <div class="checkout-card-title"><i class="fas fa-map-marker-alt"></i><span>Alamat & Layanan Pengiriman</span></div>
                                    <p class="checkout-card-copy">Lengkapi alamat tujuan pengiriman Anda dan tentukan layanan kurir yang ingin digunakan.</p>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-item">
                                                <label class="form-label">Alamat Lengkap <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="address1" value="{{ old('address1', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_address1 : auth()->user()->address1) }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-item">
                                                <label class="form-label">Detail Alamat / Catatan Patokan (Optional)</label>
                                                <input type="text" class="form-control" name="address2" value="{{ old('address2', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_address2 : auth()->user()->address2) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-item">
                                                <label>Kode Pos <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="postcode" value="{{ old('postcode', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_postcode : auth()->user()->postcode) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-item">
                                                <label>Provinsi <span class="required">*</span></label>
                                                <select name="province_id" class="form-control form-select" id="shipping-province">
                                                    <option value="">-- Pilih Provinsi --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-item">
                                                <label>Kota / Kabupaten <span class="required">*</span></label>
                                                <select name="shipping_city_id" class="form-control form-select" id="shipping-city">
                                                    <option value="">-- Pilih Kota --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-item">
                                                <label>Kecamatan <span class="required">*</span></label>
                                                <select name="shipping_district_id" class="form-control form-select" id="shipping-district">
                                                    <option value="">-- Pilih Kecamatan --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12" id="shipping-row">
                                            <div class="form-item">
                                                <label class="form-label">Layanan Pengiriman <span class="required">*</span></label>
                                                <select class="form-control form-select" id="shipping-cost-option" name="shipping_service">
                                                    <option value="">-- Select Delivery Method First --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-subcard">
                                <div class="checkout-card-title"><i class="fas fa-paperclip"></i><span>Catatan & Lampiran</span></div>
                                <p class="checkout-card-copy">Tambahkan instruksi khusus untuk pesanan Anda, atau unggah lampiran berkas jika diperlukan.</p>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-item">
                                            <label>Order Notes (Optional)</label>
                                            <textarea class="form-control" name="note" rows="4">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-item">
                                            <label>Order Attachments (Optional)</label>
                                            <input type="file" id="image" class="form-control" name="attachments">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-item d-none image-item checkout-preview-card">
                                            <label for="">Preview Image</label>
                                            <img src="" class="img-preview img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-5 col-xl-5">
                        <div class="checkout-sticky-stack">
                            <div class="checkout-surface checkout-summary-shell">
                                <div class="checkout-shell-head">
                                    <div>
                                        <span class="checkout-shell-kicker"><i class="fas fa-receipt"></i> Order Review</span>
                                        <h2>Ringkasan Pesanan</h2>
                                        <p>Item, subtotal, dan total pembayaran dalam satu panel invoice ringkas.</p>
                                    </div>
                                    <span class="checkout-shell-badge"><i class="fas fa-layer-group"></i> {{ $cartLineCount }} item</span>
                                </div>

                                <div class="summary-note">Verifikasi item dan nominal akhir di bawah ini sebelum menekan tombol order.</div>

                                <div class="checkout-order-list mt-3">
                                    @forelse ($items as $item)
                                        @php
                                            $attributeText = null;
                                            if (isset($item->options['type']) && $item->options['type'] === 'configurable') {
                                                $product = \App\Models\Product::find($item->options['product_id']);
                                                $image = !empty($item->options['image']) ? asset('storage/' . $item->options['image']) : asset('themes/ezone/assets/img/cart/3.jpg');
                                                $displayName = $item->name;
                                                if (isset($item->options['attributes']) && !empty($item->options['attributes'])) {
                                                    $attributes = [];
                                                    foreach ($item->options['attributes'] as $attr => $value) {
                                                        $attributes[] = $attr . ': ' . $value;
                                                    }
                                                    $attributeText = implode(', ', $attributes);
                                                    $displayName .= ' (' . $attributeText . ')';
                                                }
                                            } else {
                                                $product = $item->model;
                                                if (!$product && isset($item->options['product_id'])) {
                                                    $product = \App\Models\Product::find($item->options['product_id']);
                                                }
                                                if (!$product) {
                                                    $product = \App\Models\Product::find($item->id);
                                                }

                                                $image = asset('themes/ezone/assets/img/cart/3.jpg');
                                                if ($product && $product->productImages->isNotEmpty()) {
                                                    $image = asset('storage/'.$product->productImages->first()->path);
                                                } elseif (!empty($item->options['image'])) {
                                                    $image = asset('storage/' . $item->options['image']);
                                                }

                                                $displayName = $product ? $product->name : $item->name;
                                            }
                                        @endphp
                                        <div class="checkout-order-item">
                                            <img src="{{ $image }}" class="order-thumb" alt="{{ $displayName }}">
                                            <div class="checkout-order-details">
                                                <div class="order-line-name" title="{{ $displayName }}">{{ $displayName }}</div>
                                                @if($attributeText)
                                                    <div class="order-line-meta">{{ $attributeText }}</div>
                                                @endif
                                                <div class="order-line-foot">
                                                    <span class="order-price-qty">
                                                        Rp. {{ number_format($item->price,0,',','.') }} &times; {{ $item->qty }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="order-line-total">Rp. {{ number_format($item->price * $item->qty, 0, ',', '.') }}</div>
                                        </div>
                                    @empty
                                        <div class="checkout-empty-state">Keranjang belanja kosong!</div>
                                    @endforelse
                                </div>

                                <div class="summary-panel">
                                    <div class="summary-row">
                                        <small>Subtotal</small>
                                        <strong>Rp. {{ number_format($subtotal,0,',','.') }}</strong>
                                    </div>
                                    <div class="summary-row">
                                        <small>Delivery</small>
                                        <span class="summary-delivery-value fw-bold">Self Pickup (Rp 0)</span>
                                    </div>
                                    <div class="summary-row">
                                        <small>Unique Payment Code</small>
                                        <span class="text-success fw-bold">+ Rp. {{ number_format($unique_code,0,',','.') }}</span>
                                        <input type="hidden" name="unique_code" value="{{ $unique_code }}" class="unique_code">
                                    </div>
                                    <div class="summary-row" style="flex-direction: column; align-items: flex-start; gap: 4px;">
                                        <small>Total Pembayaran</small>
                                        <div class="total-amount">Rp. {{ number_format((int)$subtotal + (int)$unique_code, 0, ',', '.') }}</div>
                                        <p class="total-amount-note">Nominal transfer harus presisi sampai digit terakhir agar verifikasi sukses.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-surface checkout-payment-shell">
                                <div class="checkout-card-title"><i class="fa fa-credit-card"></i><span>Metode Pembayaran</span></div>
                                <p class="checkout-card-copy">Pilih salah satu opsi pembayaran terintegrasi di bawah ini.</p>

                                <div class="checkout-payment-list">
                                    <label class="checkout-option-card" for="Transfer-1">
                                        <input type="radio" class="form-check-input payment-option checkout-choice-input" id="Transfer-1" name="payment_method" value="manual" checked>
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-university"></i></span>
                                            <span class="checkout-option-content">
                                                <span class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                                                    <span class="checkout-option-title">Bank Transfer Manual</span>
                                                    <span class="info-badge">BCA: 01401840112</span>
                                                </span>
                                                <span class="checkout-option-desc">Transfer manual ke rekening Ahmad Sambudi. Konfirmasi instan setelah unggah struk.</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="checkout-option-card" for="Automatic-1">
                                        <input type="radio" class="form-check-input payment-option checkout-choice-input" id="Automatic-1" name="payment_method" value="automatic">
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-bolt"></i></span>
                                            <span class="checkout-option-content">
                                                <span class="checkout-option-title">Automatic Payment (Midtrans)</span>
                                                <span class="checkout-option-desc">Bayar via E-Wallet (GoPay, OVO), QRIS, Virtual Account, atau Kartu Kredit.</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="checkout-option-card" for="COD-1">
                                        <input type="radio" class="form-check-input payment-option checkout-choice-input" id="COD-1" name="payment_method" value="cod">
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-money-bill-wave"></i></span>
                                            <span class="checkout-option-content">
                                                <span class="checkout-option-title">Cash on Delivery (COD)</span>
                                                <span class="checkout-option-desc">Bayar tunai di tempat saat kurir menyerahkan produk ke alamat Anda.</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="checkout-option-card" for="Store-1">
                                        <input type="radio" class="form-check-input payment-option checkout-choice-input" id="Store-1" name="payment_method" value="toko">
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-store"></i></span>
                                            <span class="checkout-option-content">
                                                <span class="checkout-option-title">Bayar Di Toko</span>
                                                <span class="checkout-option-desc">Ambil pesanan Anda langsung di toko fisik ViviaShop dan lakukan pembayaran tunai/debit.</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="place-order-wrap">
                                    <input type="hidden" name="total_amount" class="total-amount-input" value="{{ (int)$subtotal }}">
                                    <button type="submit" id="place-order-btn" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary"><i class="fas fa-lock"></i> Place Order</button>
                                    <div id="loading-indicator" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script-alt')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function loadProvinces() {
            console.log('Loading provinces...');
            console.log('jQuery available:', typeof $ !== 'undefined');
            console.log('CSRF token:', $('meta[name="csrf-token"]').attr('content'));

            var apiUrl = "{{ url('api/provinces') }}" + '?t=' + Date.now();
            console.log('API URL:', apiUrl);

            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    console.log('Making request to:', apiUrl);
                    $('#shipping-province').html('<option value="">Loading provinces...</option>').trigger('change');
                },
                success: function(response) {
                    console.log('Provinces response:', response);
                    var options = '<option value="">-- Pilih Provinsi --</option>';

                    if (Array.isArray(response)) {
                        response.forEach(function(item) {
                            if (item && (item.id !== undefined && item.name !== undefined)) {
                                var selected = item.id == '{{ auth()->user()->province_id }}' ? 'selected' : '';
                                options += '<option value="' + item.id + '" ' + selected + '>' + item.name + '</option>';
                            }
                        });
                    } else if (response && typeof response === 'object') {
                        for (var id in response) {
                            if (response.hasOwnProperty(id)) {
                                var name = response[id];
                                var selected = id == '{{ auth()->user()->province_id }}' ? 'selected' : '';
                                options += '<option value="' + id + '" ' + selected + '>' + name + '</option>';
                            }
                        }
                    } else {
                        console.error('Unexpected provinces response format');
                    }

                    $('#shipping-province').html(options).trigger('change');
                    console.log('Province options updated, total options:', $('#shipping-province option').length);

                    var selectedProvinceId = $('#shipping-province').val();
                    if (selectedProvinceId) {
                        console.log('Auto-loading cities for selected province:', selectedProvinceId);
                        loadCities(selectedProvinceId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error loading provinces:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    console.error('Status Code:', xhr.status);
                    console.error('Ready State:', xhr.readyState);
                    $('#shipping-province').html('<option value="">Error loading provinces</option>').trigger('change');
                },
                complete: function(xhr, status) {
                    console.log('AJAX request completed with status:', status);
                }
            });
        }

        function loadCities(provinceId) {
            console.log('Loading cities for province:', provinceId);
            var cityUrl = "{{ url('api/cities') }}/" + provinceId + '?t=' + Date.now();
            $.ajax({
                url: cityUrl,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    console.log('Making request to:', cityUrl);
                    $('#shipping-city').html('<option value="">Loading cities...</option>').trigger('change');
                },
                success: function(response) {
                    console.log('Cities response received:', response);
                    var options = '<option value="">-- Pilih Kota --</option>';
                    if (response && Array.isArray(response)) {
                        console.log('Processing cities array with', response.length, 'items');
                        $.each(response, function(index, city) {
                            var selected = city.id == '{{ auth()->user()->city_id }}' ? 'selected' : '';
                            options += '<option value="' + city.id + '" ' + selected + '>' + city.name + '</option>';
                        });
                    }
                    $('#shipping-city').html(options).trigger('change');
                    console.log('City options updated, total options:', $('#shipping-city option').length);
                    
                    var selectedCityId = $('#shipping-city').val();
                    if (selectedCityId) {
                        console.log('Auto-loading districts for selected city:', selectedCityId);
                        loadDistricts(selectedCityId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error loading cities:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    $('#shipping-city').html('<option value="">Error loading cities</option>').trigger('change');
                }
            });
        }

        function loadDistricts(cityId) {
            console.log('Loading districts for city:', cityId);
            var districtUrl = "{{ url('api/districts') }}/" + cityId + '?t=' + Date.now();
            $.ajax({
                url: districtUrl,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    console.log('Making request to:', districtUrl);
                    $('#shipping-district').html('<option value="">Loading districts...</option>').trigger('change');
                },
                success: function(response) {
                    console.log('Districts response received:', response);
                    var options = '<option value="">-- Pilih Kecamatan --</option>';
                    if (response && Array.isArray(response)) {
                        console.log('Processing districts array with', response.length, 'items');
                        $.each(response, function(index, district) {
                            var selected = district.id == '{{ auth()->user()->district_id }}' ? 'selected' : '';
                            options += '<option value="' + district.id + '" ' + selected + '>' + district.name + '</option>';
                        });
                    }
                    $('#shipping-district').html(options).trigger('change');
                    console.log('District options updated, total options:', $('#shipping-district option').length);
                    
                    var selectedDistrictId = $('#shipping-district').val();
                    if (selectedDistrictId) {
                        console.log('Auto-loading shipping costs for selected district:', selectedDistrictId);
                        var deliveryMethod = $('input[name="delivery_method"]:checked').val();
                        if (deliveryMethod === 'courier') {
                            getShippingCostOptions(selectedDistrictId);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error loading districts:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    $('#shipping-district').html('<option value="">Error loading districts</option>').trigger('change');
                }
            });
        }

        function getShippingCostOptions(district_id) {
            console.log('Getting shipping costs for district_id:', district_id);
            $('#shipping-cost-option').html('<option value="">Loading shipping costs...</option>');
            
            $.ajax({
                url: "{{ route('orders.shippingCost') }}",
                type: 'POST',
                data: {
                    district_id: district_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Shipping API response:', response);
                    var options = '<option value="">-- Select Shipping Service --</option>';
                    
                    if (response.results && response.results.length > 0) {
                        $.each(response.results, function(index, result) {
                            var displayName = result.service + ' - Rp. ' + number_format(result.cost) + ' (' + result.etd + ')';
                            var valueData = {
                                service: result.service,
                                cost: result.cost,
                                etd: result.etd,
                                courier: result.courier
                            };
                            var value = JSON.stringify(valueData).replace(/"/g, '&quot;');
                            options += '<option value="' + value + '">' + displayName + '</option>';
                        });
                    } else {
                        console.warn('No shipping results found in response');
                        options += '<option value="">No shipping options available</option>';
                    }
                    
                    $('#shipping-cost-option').html(options);
                    
                    // Update total amount after shipping options are loaded
                    console.log('📦 Shipping options loaded, updating total...');
                    updateTotalAmount();
                    
                    // Force trigger change event to ensure total updates
                    setTimeout(function() {
                        console.log('🔄 Delayed total update...');
                        updateTotalAmount();
                    }, 100);
                },
                error: function(xhr, status, error) {
                    console.error('Shipping API error:', {
                        status: status,
                        error: error,
                        response: xhr.responseText,
                        statusCode: xhr.status
                    });
                    $('#shipping-cost-option').html('<option value="">Error loading shipping costs</option>');
                }
            });
        }

        function number_format(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function showWarning(title, message, focusElement) {
            Swal.fire({
                title: title,
                text: message,
                icon: 'warning',
                confirmButtonColor: '#0d4f30',
                showClass: { popup: 'swal-custom-show' },
                hideClass: { popup: 'swal-custom-hide' }
            }).then(function() {
                if (focusElement) {
                    $(focusElement).focus();
                }
            });
        }

        function updateTotalAmount() {
            var subtotal = parseInt("{{ (int)\Gloudemans\Shoppingcart\Facades\Cart::subtotal(0,'','') }}");
            var uniqueCode = parseInt($('.unique_code').val()) || 0;
            var shippingCost = 0;
            
            var deliveryMethod = $('input[name="delivery_method"]:checked').val();
            
            if (deliveryMethod === 'self') {
                shippingCost = 0;
                $('.summary-delivery-value').text('Self Pickup (Rp 0)');
            } else if (deliveryMethod === 'courier') {
                var selectedShipping = $('#shipping-cost-option').val();
                
                if (selectedShipping) {
                    try {
                        var unescapedShipping = selectedShipping.replace(/&quot;/g, '"');
                        var shippingData = JSON.parse(unescapedShipping);
                        shippingCost = parseInt(shippingData.cost) || 0;
                        $('.summary-delivery-value').text(shippingData.courier.toUpperCase() + ' - ' + shippingData.service + ' (Rp ' + number_format(shippingCost) + ')');
                    } catch (e) {
                        shippingCost = 0;
                        $('.summary-delivery-value').text('Courier Delivery (Rp 0)');
                    }
                } else {
                    $('.summary-delivery-value').text('Courier (Select Service)');
                }
            }
            
            var total = subtotal + uniqueCode + shippingCost;
            
            $('.total-amount').text('Rp. ' + number_format(total));
            $('.total-amount-input').val(total);
        }

        $(document).ready(function(){
            console.log('🚀 CHECKOUT PAGE INITIALIZED');
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize Select2 dropdowns
            $('#shipping-province').select2({
                placeholder: "-- Pilih Provinsi --",
                allowClear: false,
                width: '100%'
            });
            $('#shipping-city').select2({
                placeholder: "-- Pilih Kota / Kabupaten --",
                allowClear: false,
                width: '100%'
            });
            $('#shipping-district').select2({
                placeholder: "-- Pilih Kecamatan --",
                allowClear: false,
                width: '100%'
            });
            
            // Initialize form state
            var initialMethod = $('input[name="delivery_method"]:checked').val() || 'self';
            if (initialMethod === 'self') {
                $('#shipping-address-section').hide();
                $('#shipping-address-section').find('input, select').prop('disabled', true).removeAttr('required').trigger('change');
            } else {
                $('#shipping-address-section').show();
                $('#shipping-address-section').find('input, select').prop('disabled', false).attr('required', 'required').trigger('change');
                $('input[name="address2"]').removeAttr('required'); // Address line 2 is always optional
            }
            $('#shipping-cost-option').html('<option value="">-- Select Delivery Method First --</option>');
            
            // Always load provinces on page load
            if ($('#shipping-province option').length <= 1) {
                loadProvinces();
            }
            
            // Initialize total amount calculation
            updateTotalAmount();
            
            $('#shipping-province').on('change', function() {
                var province_id = $(this).val();
                if (province_id) {
                    loadCities(province_id);
                } else {
                    $('#shipping-city').html('<option value="">-- Pilih Kota --</option>');
                    $('#shipping-district').html('<option value="">-- Pilih Kecamatan --</option>');
                }
            });
            
            $('#shipping-city').on('change', function() {
                var city_id = $(this).val();
                if (city_id) {
                    loadDistricts(city_id);
                } else {
                    $('#shipping-district').html('<option value="">-- Pilih Kecamatan --</option>');
                }
                
                var deliveryMethod = $('input[name="delivery_method"]:checked').val();
                if (deliveryMethod === 'courier') {
                    $('#shipping-cost-option').html('<option value="">-- Select District First --</option>');
                    updateTotalAmount();
                }
            });
            
            $('#shipping-district').on('change', function() {
                var district_id = $(this).val();
                var deliveryMethod = $('input[name="delivery_method"]:checked').val();
                
                if (deliveryMethod === 'courier' && district_id) {
                    getShippingCostOptions(district_id);
                } else if (deliveryMethod === 'courier') {
                    $('#shipping-cost-option').html('<option value="">-- Select District First --</option>');
                    updateTotalAmount();
                }
            });
            
            $('input[name="delivery_method"]').on('change', function() {
                var method = $(this).val();
                if (method === 'self') {
                    $('#shipping-address-section').slideUp(300);
                    $('#shipping-address-section').find('input, select').prop('disabled', true).removeAttr('required').trigger('change');
                    updateTotalAmount();
                } else if (method === 'courier') {
                    $('#shipping-address-section').slideDown(300);
                    $('#shipping-address-section').find('input, select').prop('disabled', false).attr('required', 'required').trigger('change');
                    $('input[name="address2"]').removeAttr('required'); // Address line 2 is always optional

                    if ($('#shipping-province option').length <= 1) {
                        loadProvinces();
                    } else {
                        var selectedProvinceId = $('#shipping-province').val();
                        if (selectedProvinceId) loadCities(selectedProvinceId);
                    }

                    $('#shipping-cost-option').html('<option value="">-- Select District First --</option>');
                    updateTotalAmount();
                }
            });

            $('#shipping-cost-option').on('change', function() {
                updateTotalAmount();
            });

            $('.payment-option').on('change', function() {
                $('.payment-option').not(this).prop('checked', false);
                $(this).prop('checked', true);
            });
        });

        function handleFormSubmit(event) {
            event = event || window.event;
            if (event && event.preventDefault) event.preventDefault();
            else window.event.returnValue = false;

            console.log('Form submission handler triggered');

            // Prevent double submission
            var submitButton = $('#place-order-btn');
            if (submitButton.prop('disabled')) {
                return false;
            }

            // Validate form
            if (!validateForm()) {
                return false;
            }

            // Set loading state in button
            submitButton.prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin me-2"></i> Processing Order...');

            var deliveryMethod = $('input[name="delivery_method"]:checked').val();
            
            if (deliveryMethod === 'self') {
                $('#shipping-province').removeAttr('name');
                $('#shipping-city').removeAttr('name');
                $('#shipping-district').removeAttr('name');
                $('#shipping-cost-option').removeAttr('name');
            }
            
            if (!$('input[name="unique_code"]').length) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'unique_code',
                    value: '0'
                }).appendTo('#checkout-form');
            }
            
            var formData = new FormData($('#checkout-form')[0]);
            var ajaxUrl = $('#checkout-form').attr('action');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            function handleSuccess(resp) {
                console.log('Checkout success:', resp);
                if (resp && resp.success) {
                    if (resp.payment_url) {
                        window.location.href = resp.payment_url;
                        return;
                    }
                    if (resp.redirect) {
                        window.location.href = resp.redirect;
                        return;
                    }
                    window.location.reload();
                } else {
                    Swal.fire({
                        title: 'Gagal Memproses Pesanan',
                        text: resp.message || 'Terjadi kesalahan saat memproses pesanan Anda.',
                        icon: 'error',
                        confirmButtonColor: '#0d4f30',
                        showClass: { popup: 'swal-custom-show' },
                        hideClass: { popup: 'swal-custom-hide' }
                    });
                    submitButton.prop('disabled', false).html('<i class="fas fa-lock"></i> Place Order');
                }
            }

            function handleError(xhrText) {
                console.error('Checkout failed:', xhrText);
                var errorMsg = 'Terjadi kesalahan sistem saat memproses pesanan Anda. Silakan coba lagi.';
                try {
                    var json = typeof xhrText === 'string' ? JSON.parse(xhrText) : xhrText;
                    if (json.message) {
                        errorMsg = json.message;
                    }
                } catch (e) {}

                Swal.fire({
                    title: 'Kesalahan Sistem',
                    text: errorMsg,
                    icon: 'error',
                    confirmButtonColor: '#0d4f30',
                    showClass: { popup: 'swal-custom-show' },
                    hideClass: { popup: 'swal-custom-hide' }
                });
                submitButton.prop('disabled', false).html('<i class="fas fa-lock"></i> Place Order');
            }

            // AJAX POST using jQuery or fetch
            if (window.jQuery && $.ajax) {
                $.ajax({
                    url: ajaxUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(resp) {
                        handleSuccess(resp);
                    },
                    error: function(xhr, status, err) {
                        handleError(xhr.responseText || status);
                    }
                });
            } else {
                var fetchHeaders = {
                    'X-Requested-With': 'XMLHttpRequest'
                };
                if (csrfToken) fetchHeaders['X-CSRF-TOKEN'] = csrfToken;

                fetch(ajaxUrl, {
                    method: 'POST',
                    headers: fetchHeaders,
                    body: formData,
                    credentials: 'same-origin'
                }).then(function(response) {
                    return response.text().then(function(text) {
                        try {
                            var json = text ? JSON.parse(text) : {};
                            if (response.ok) {
                                handleSuccess(json);
                            } else {
                                handleError(text);
                            }
                        } catch (e) {
                            handleError(text);
                        }
                    });
                }).catch(function(err) {
                    handleError(err);
                });
            }

            // Re-enable button after 15s in case of silent failure
            setTimeout(function() {
                if (submitButton.prop('disabled')) {
                    submitButton.prop('disabled', false).html('<i class="fas fa-lock"></i> Place Order');
                }
            }, 15000);

            return false;
        }

        function validateForm() {
            var deliveryMethod = $('input[name="delivery_method"]:checked').val();
            var paymentMethod = $('input[name="payment_method"]:checked').val();
            
            var name = $('input[name="name"]').val();
            var address1 = $('input[name="address1"]').val();
            var phone = $('input[name="phone"]').val();
            var email = $('input[name="email"]').val();
            var postcode = $('input[name="postcode"]').val();
            
            if (!name || name.trim() === '') {
                showWarning('Nama Wajib Diisi', 'Silakan masukkan nama lengkap Anda.', 'input[name="name"]');
                return false;
            }
            
            if (deliveryMethod === 'courier') {
                if (!address1 || address1.trim() === '') {
                    showWarning('Alamat Wajib Diisi', 'Silakan masukkan alamat pengiriman Anda.', 'input[name="address1"]');
                    return false;
                }
            }
            
            if (!phone || phone.trim() === '') {
                showWarning('No. Telepon Wajib Diisi', 'Silakan masukkan nomor telepon Anda untuk koordinasi pengiriman.', 'input[name="phone"]');
                return false;
            }
            
            if (!email || email.trim() === '') {
                showWarning('Email Wajib Diisi', 'Silakan masukkan alamat email Anda.', 'input[name="email"]');
                return false;
            }
            
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.trim())) {
                showWarning('Format Email Salah', 'Silakan masukkan alamat email yang valid (contoh: user@example.com).', 'input[name="email"]');
                return false;
            }
            
            if (deliveryMethod === 'courier') {
                if (!postcode || postcode.trim() === '') {
                    showWarning('Kode Pos Wajib Diisi', 'Silakan masukkan kode pos alamat Anda.', 'input[name="postcode"]');
                    return false;
                }
            }
            
            if (!deliveryMethod) {
                showWarning('Metode Pengiriman', 'Silakan pilih metode pengiriman terlebih dahulu.', null);
                return false;
            }
            
            if (!paymentMethod) {
                showWarning('Metode Pembayaran', 'Silakan pilih metode pembayaran terlebih dahulu.', null);
                return false;
            }
            
            if (deliveryMethod === 'courier') {
                var province = $('#shipping-province').val();
                var city = $('#shipping-city').val();
                var district = $('#shipping-district').val();
                var shippingService = $('#shipping-cost-option').val();
                
                if (!province || province === '') {
                    showWarning('Provinsi Belum Dipilih', 'Silakan pilih provinsi tujuan pengiriman.', '#shipping-province');
                    return false;
                }
                
                if (!city || city === '') {
                    showWarning('Kota Belum Dipilih', 'Silakan pilih kota tujuan pengiriman.', '#shipping-city');
                    return false;
                }
                
                if (!district || district === '') {
                    showWarning('Kecamatan Belum Dipilih', 'Silakan pilih kecamatan tujuan pengiriman.', '#shipping-district');
                    return false;
                }
                
                if (!shippingService || shippingService === '') {
                    showWarning('Layanan Kurir Belum Dipilih', 'Silakan pilih salah satu layanan kurir yang tersedia.', '#shipping-cost-option');
                    return false;
                }
            }
            
            updateTotalAmount();
            return true;
        }
    </script>
@endpush
