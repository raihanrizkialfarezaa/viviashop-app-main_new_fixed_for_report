@extends('frontend.layouts')

@section('title', 'Katalog Produk - VIVIA PrintShop')
@section('meta-description', 'Jelajahi katalog lengkap produk VIVIA PrintShop. Temukan berbagai produk berkualitas untuk kebutuhan kantor, sekolah, dan percetakan dengan harga terbaik.')
@section('meta-keywords', 'vivia printshop, katalog produk, alat tulis kantor, ATK, percetakan, amplop, kertas, pulpen, produk kantor')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #28a745 0%, #ffc107 100%);
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></svg>') repeat;
        z-index: 1;
    }
    
    .page-header .container {
        position: relative;
        z-index: 2;
    }
    
    .search-container {
        background: transparent;
        border-radius: 12px;
        padding: 0;
        margin-bottom: 1rem;
    }
    
    .search-input-group {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 6px 22px rgba(40, 167, 69, 0.08);
        border: 1px solid rgba(40,167,69,0.06);
    }
    
    .search-input {
        border: none;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        background: #fffef8;
        transition: all 0.25s ease;
    }
    
    .search-input:focus {
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(40,167,69,0.12);
    }
    
    .search-btn {
        background: #28a745;
        border: none;
        padding: 0.6rem 1rem;
        transition: all 0.18s ease;
        color: white;
        font-weight: 700;
        border-radius: 8px;
    }
    
    .search-btn:hover {
        transform: scale(1.05);
    }
    
    .sort-dropdown {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .sort-dropdown:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }
    
    .category-sidebar {
        background: #ffffff;
        border-radius: 14px;
        padding: 1rem 1rem 1.25rem 1rem;
        box-shadow: 0 10px 28px rgba(40,167,69,0.04);
        margin-bottom: 2rem;
        position: sticky;
        top: var(--sticky-safe-top, 110px);
        height: fit-content;
        max-height: calc(100vh - var(--sticky-safe-top, 110px) - 20px);
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior: contain;
        scrollbar-width: thin;
        scrollbar-color: rgba(15,81,50,0.34) rgba(15,81,50,0.08);
        z-index: 50;
        border: 1px solid rgba(40,167,69,0.06);
    }
    
    /* Custom scrollbar for category sidebar */
    .category-sidebar::-webkit-scrollbar {
        width: 6px;
    }
    
    .category-sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .category-sidebar::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--bs-primary), var(--bs-success));
        border-radius: 10px;
    }
    
    .category-sidebar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, var(--bs-success), var(--bs-primary));
    }
    
    .category-item {
        padding: 0.75rem 1rem;
        margin-bottom: 0.5rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .category-item:hover {
        background: rgba(40,167,69,0.04);
        border-left-color: #ffc107;
        transform: translateX(4px);
    }
    
    .category-item.active {
        background: linear-gradient(90deg, #28a745, #ffc107);
        border-left-color: #ffc107;
    }
    
    .category-item.active a {
        color: white !important;
        font-weight: bold;
    }
    
    .product-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 28px rgba(40,167,69,0.03);
        transition: all 0.28s ease;
        margin-bottom: 2rem;
        position: relative;
        border: 1px solid rgba(40,167,69,0.04);
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .product-image {
        position: relative;
        overflow: hidden;
        height: 250px;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    
    .product-card:hover .product-image img {
        transform: scale(1.1);
    }
    
    .product-category-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #28a745;
        color: white;
        padding: 0.35rem 0.85rem;
        border-radius: 14px;
        font-size: 0.82rem;
        font-weight: 700;
        box-shadow: 0 6px 18px rgba(40,167,69,0.06);
        z-index: 2;
    }
    
    .product-stock-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #28a745;
        color: white;
        padding: 0.35rem 0.7rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    
    .product-content {
        padding: 1.5rem;
    }
    
    .product-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.3;
        transition: color 0.3s ease;
    }
    
    .product-title:hover {
        color: var(--bs-primary);
    }
    
    .product-description {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        line-height: 1.5;
    }
    
    .product-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: #28a745;
        margin-bottom: 0.75rem;
    }
    
    .product-stock {
        display: inline-flex;
        align-items: center;
        color: var(--bs-success);
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .btn-add-cart {
        background: linear-gradient(90deg, #28a745 0%, #28a745 100%);
        border: none;
        color: white;
        padding: 0.6rem 1rem;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.22s ease;
        width: 100%;
    }
    
    .btn-add-cart:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(40,167,69,0.18);
        color: #ffffff !important;
        background: linear-gradient(90deg, #2ecc71 0%, #28a745 100%);
    }
    
    .reset-btn, .view-all-btn {
        background: #ffc107;
        border: none;
        color: #0b2a1a;
        padding: 0.55rem 1rem;
        border-radius: 18px;
        font-weight: 700;
        transition: all 0.18s ease;
        text-decoration: none;
    }
    
    .reset-btn:hover, .view-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        color: white;
    }
    
    .no-products {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    .no-products i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }
    
    .filter-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .filter-pill {
        background: #e9ecef;
        color: #495057;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .filter-pill:hover {
        background: var(--bs-primary);
        color: #fff;
        border-color: transparent;
        text-decoration: none;
    }
    
    .products-header {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .pagination .page-link {
        background: #ffffff;
        border: 1px solid rgba(40,167,69,0.08);
        color: #28a745;
        font-weight: 700;
        padding: 0.45rem 0.85rem;
        border-radius: 50px;
        transition: all 0.18s ease;
    }

    .pagination .page-item.active .page-link {
        background: #28a745;
        border-color: #28a745;
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(40,167,69,0.12);
    }

    .pagination .page-link:hover {
        background: #28a745;
        color: #ffffff;
        border-color: #28a745;
    }

    /* Force pagination to be horizontal, compact and centered */
    .pagination {
        display: flex;
        flex-wrap: nowrap;
        gap: 0.5rem;
        align-items: center;
        justify-content: center;
        list-style: none;
        padding-left: 0;
        margin: 0.5rem 0;
    }

    .pagination .page-item {
        display: inline-block;
    }

    /* Small previous/next buttons as square pills */
    .pagination .page-item .page-link {
        min-width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    /* Active page stronger green */
    .pagination .page-item.active .page-link {
        background: #28a745;
        border-color: #28a745;
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(40,167,69,0.18);
    }

    /* Disabled state subdued */
    .pagination .page-item.disabled .page-link {
        opacity: 0.45;
        cursor: default;
        background: #ffffff;
        color: rgba(40,167,69,0.45);
    }

    /* Responsive: allow wrapping on very small screens */
    @media (max-width: 420px) {
        .pagination { gap: 0.25rem; }
        .pagination .page-item .page-link { min-width: 34px; height: 34px; }
    }

    @media (max-width: 768px) {
        .product-image { height: 180px; }
        .product-title { font-size: 1.05rem; }
        .btn-add-cart { padding: 0.5rem; font-size: 0.95rem; }
        .search-input { padding: 0.6rem 0.8rem; }
        .pagination .page-link { padding: 0.35rem 0.6rem; font-size: 0.9rem; }
    }
    
    @media (max-width: 768px) {
        .product-card {
            margin-bottom: 1.5rem;
        }
        
        .search-container {
            padding: 1rem;
        }
        
        .category-sidebar {
            position: static !important;
            margin-bottom: 1rem;
            max-height: none;
            overflow-y: visible;
        }
    }
    
    @media (max-width: 992px) {
        .category-sidebar {
            top: var(--sticky-safe-top, 96px);
            max-height: calc(100vh - var(--sticky-safe-top, 96px) - 16px);
        }
    }

    /* Premium shop page overrides */
    .shop-page-header {
        position: relative;
        margin-top: 18px;
        padding: 4.5rem 0 5.5rem;
        border-radius: 0 0 48px 48px;
        background:
            radial-gradient(circle at top left, rgba(255, 255, 255, 0.18), transparent 28%),
            radial-gradient(circle at 85% 15%, rgba(74, 222, 128, 0.15), transparent 30%),
            radial-gradient(circle at 50% 80%, rgba(32, 201, 151, 0.1), transparent 40%),
            linear-gradient(135deg, rgba(5, 30, 20, 0.98) 0%, rgba(10, 60, 38, 0.95) 40%, rgba(15, 81, 50, 0.92) 65%, rgba(22, 163, 74, 0.85) 100%);
        box-shadow: inset 0 -1px 0 rgba(255,255,255,0.08), 0 4px 20px rgba(5,30,20,0.15);
        overflow: hidden;
    }

    .shop-page-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }

    .shop-page-header::after {
        content: '';
        position: absolute;
        right: -60px;
        top: -60px;
        width: 280px;
        height: 280px;
        background: radial-gradient(circle, rgba(74, 222, 128, 0.12), rgba(16, 185, 129, 0.06) 40%, transparent 70%);
        pointer-events: none;
    }

    .shop-page-header .breadcrumb {
        gap: 0.5rem;
    }

    .shop-page-header .breadcrumb-item,
    .shop-page-header .breadcrumb-item a {
        color: rgba(255,255,255,0.8) !important;
        text-decoration: none;
    }

    .shop-page-header .breadcrumb-item.active {
        color: #ffffff !important;
    }

    .search-container.shop-toolbar-card {
        position: relative;
        margin-top: -74px;
        margin-bottom: 2rem;
        padding: 22px;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.86);
        border: 1px solid rgba(255,255,255,0.52);
        box-shadow: 0 28px 56px rgba(15, 81, 50, 0.12);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        z-index: 2;
    }

    .shop-toolbar-copy {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .shop-toolbar-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #0f5132;
        font-size: 0.82rem;
        font-weight: 800;
        letter-spacing: 0.14em;
        text-transform: uppercase;
    }

    .shop-toolbar-title {
        margin: 0;
        font-family: 'Raleway', sans-serif;
        font-size: clamp(1.5rem, 3vw, 2.1rem);
        font-weight: 800;
        letter-spacing: -0.03em;
        color: #17382a;
    }

    .shop-toolbar-subtitle {
        margin: 0;
        color: #687c73;
        font-size: 0.95rem;
        line-height: 1.7;
    }

    .search-input-group {
        border-radius: 18px;
        box-shadow: 0 10px 28px rgba(15, 81, 50, 0.08);
        border: 1px solid rgba(15,81,50,0.08);
        background: rgba(255,255,255,0.94);
    }

    .search-input {
        min-height: 54px;
        padding: 0.85rem 1rem;
        background: transparent;
    }

    .search-btn {
        min-width: 52px;
        min-height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0f5132, #198754);
        box-shadow: 0 14px 24px rgba(15,81,50,0.16);
    }

    .sort-dropdown {
        min-height: 54px;
        border-radius: 16px;
        border: 1px solid rgba(15,81,50,0.1);
        box-shadow: 0 10px 24px rgba(15,81,50,0.05);
    }

    .reset-btn, .view-all-btn {
        background: rgba(255,255,255,0.92);
        border: 1px solid rgba(15,81,50,0.1);
        color: #17382a;
        box-shadow: 0 10px 22px rgba(15,81,50,0.06);
    }

    .reset-btn:hover, .view-all-btn:hover {
        color: #0f5132;
        background: rgba(236,253,245,0.96);
        box-shadow: 0 16px 28px rgba(15,81,50,0.12);
    }

    .filter-pill {
        background: rgba(209, 231, 221, 0.45);
        border: 1px solid rgba(15,81,50,0.08);
        color: #234536;
        font-weight: 700;
    }

    .filter-pill:hover {
        background: #0f5132;
        color: #fff;
        border-color: transparent;
    }

    .category-sidebar {
        border-radius: 28px;
        padding: 1.1rem 1.1rem 1.35rem;
        box-shadow: 0 24px 46px rgba(15,81,50,0.08);
        top: var(--sticky-safe-top, 118px);
        max-height: calc(100vh - var(--sticky-safe-top, 118px) - 26px);
        border: 1px solid rgba(15,81,50,0.08);
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
    }

    .category-item {
        border-left: 0;
        border: 1px solid transparent;
        border-radius: 16px;
        margin-bottom: 0.65rem;
    }

    .category-item:hover {
        background: rgba(209, 231, 221, 0.42);
        border-color: rgba(15,81,50,0.08);
        transform: translateX(0) translateY(-1px);
    }

    .category-item.active {
        background: linear-gradient(135deg, #0f5132, #198754);
        border-color: transparent;
        box-shadow: 0 16px 28px rgba(15,81,50,0.18);
    }

    .products-header.catalog-results-card {
        border-radius: 28px;
        padding: 1.4rem 1.5rem;
        box-shadow: 0 20px 42px rgba(15,81,50,0.07);
        border: 1px solid rgba(15,81,50,0.08);
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
    }

    .shop-products-grid {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 1.5rem;
    }

    .product-card {
        position: relative;
        border-radius: 32px;
        padding: 16px;
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
        border: 1px solid rgba(15,81,50,0.08);
        box-shadow: 0 20px 42px rgba(15,81,50,0.06);
        margin-bottom: 0;
        isolation: isolate;
    }

    .product-card::after {
        content: '';
        position: absolute;
        right: -54px;
        bottom: -80px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(209,231,221,0.88), rgba(209,231,221,0));
        opacity: 0.52;
        z-index: 0;
        transition: transform 0.35s ease, opacity 0.35s ease;
    }

    .product-card > * {
        position: relative;
        z-index: 1;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 34px 64px rgba(15,81,50,0.14);
        border-color: rgba(15,81,50,0.14);
    }

    .product-card:hover::after {
        transform: scale(1.08);
        opacity: 0.88;
    }

    .product-image-shell {
        position: relative;
        padding: 12px;
        border-radius: 28px;
        background: linear-gradient(180deg, rgba(242,247,244,0.96), rgba(255,255,255,0.94));
        border: 1px solid rgba(15,81,50,0.08);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 16px 28px rgba(15,81,50,0.05);
        margin-bottom: 18px;
    }

    .product-image {
        height: auto;
        aspect-ratio: 1;
        border-radius: 22px;
        background: radial-gradient(circle at top right, rgba(32,201,151,0.14), transparent 32%), linear-gradient(180deg, #f2f6f4 0%, #ffffff 100%);
    }

    .product-topbar {
        position: absolute;
        top: 14px;
        left: 14px;
        right: 14px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        z-index: 3;
    }

    .product-category-badge,
    .product-stock-badge {
        position: static;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border-radius: 999px;
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.02em;
        border: 1px solid rgba(255,255,255,0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 12px 20px rgba(15,81,50,0.06);
    }

    .product-category-badge {
        background: rgba(255,255,255,0.92);
        color: #0f5132;
    }

    .product-stock-badge {
        background: rgba(236,253,245,0.88);
        color: #0f5132;
    }

    .product-stock-badge--warning {
        background: rgba(255,251,235,0.94);
        color: #92400e;
    }

    .product-stock-badge--muted {
        background: rgba(243,244,246,0.94);
        color: #4b5563;
    }

    .product-image img {
        transition: transform 0.55s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .product-card:hover .product-image img {
        transform: scale(1.06);
    }

    .product-quick-link {
        position: absolute;
        left: 14px;
        right: 14px;
        bottom: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 46px;
        padding: 0 16px;
        border-radius: 999px;
        background: rgba(255,255,255,0.92);
        color: #163828;
        font-size: 0.9rem;
        font-weight: 800;
        text-decoration: none;
        box-shadow: 0 16px 28px rgba(15,81,50,0.08);
        transform: translateY(16px);
        opacity: 0;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
        z-index: 3;
    }

    .product-card:hover .product-quick-link {
        transform: translateY(0);
        opacity: 1;
    }

    .product-quick-link:hover {
        color: #0f5132;
        text-decoration: none;
    }

    .product-content {
        padding: 0.25rem 0 0;
    }

    .product-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        align-self: flex-start;
        margin-bottom: 12px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(15,81,50,0.06);
        color: #0f5132;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .product-title-link {
        text-decoration: none;
        color: inherit;
    }

    .product-title {
        font-family: 'Raleway', sans-serif;
        font-size: 1.28rem;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.02em;
        color: #1c3644;
        margin-bottom: 12px;
        transition: color 0.25s ease;
    }

    .product-description {
        color: #667970;
        font-size: 0.92rem;
        line-height: 1.72;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 18px;
    }

    .product-stock-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-radius: 999px;
        background: rgba(255,255,255,0.95);
        border: 1px solid rgba(15,81,50,0.08);
        box-shadow: 0 10px 20px rgba(15,81,50,0.05);
        color: #254636;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .product-stock-pill i {
        color: #198754;
    }

    .product-stock-pill--soft {
        background: rgba(209,231,221,0.36);
    }

    .product-footer {
        margin-top: auto;
        padding-top: 18px;
        border-top: 1px solid rgba(15,81,50,0.08);
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .product-price-stack {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .product-price-label {
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #7b8d85;
    }

    .product-price {
        font-family: 'Raleway', sans-serif;
        font-size: 1.52rem;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -0.03em;
        margin-bottom: 0;
    }

    .product-action-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .product-detail-btn {
        min-height: 48px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        background: rgba(15,81,50,0.06);
        border: 1px solid rgba(15,81,50,0.08);
        color: #234536;
        font-size: 0.9rem;
        font-weight: 800;
        text-decoration: none;
        transition: transform 0.25s ease, background-color 0.25s ease, color 0.25s ease;
    }

    .product-detail-btn:hover {
        color: #0f5132;
        background: rgba(209,231,221,0.72);
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-add-cart {
        min-height: 48px;
        padding: 0 16px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: linear-gradient(135deg, #0f5132, #198754);
        box-shadow: 0 16px 28px rgba(15,81,50,0.18);
    }

    .btn-add-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 22px 34px rgba(15,81,50,0.22);
        background: linear-gradient(135deg, #0f5132, #20a46b);
    }

    .no-products {
        border-radius: 28px;
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
        border: 1px solid rgba(15,81,50,0.08);
        box-shadow: 0 24px 46px rgba(15,81,50,0.08);
    }

    @media (max-width: 991.98px) {
        .shop-page-header {
            padding: 4.8rem 0 5.8rem;
        }

        .search-container.shop-toolbar-card {
            margin-top: -54px;
            padding: 18px;
            border-radius: 26px;
        }

        .category-sidebar {
            top: var(--sticky-safe-top, 98px);
            max-height: none;
        }
    }

    @media (max-width: 767.98px) {
        .shop-page-header {
            margin-top: 14px;
            padding: 4.4rem 0 5.4rem;
            border-radius: 0 0 28px 28px;
        }

        .search-container.shop-toolbar-card {
            margin-top: -40px;
            padding: 16px;
            border-radius: 22px;
        }

        .products-header.catalog-results-card {
            padding: 1.1rem 1rem;
            border-radius: 22px;
        }

        .product-image-shell {
            padding: 10px;
            border-radius: 24px;
        }

        .product-card {
            padding: 14px;
            border-radius: 26px;
        }

        .product-title {
            font-size: 1.14rem;
        }

        .product-description {
            -webkit-line-clamp: 2;
        }

        .product-stock-pill {
            width: 100%;
            justify-content: flex-start;
        }
    }

    @media (max-width: 575.98px) {
        .shop-toolbar-title {
            font-size: 1.4rem;
        }

        .product-action-row {
            grid-template-columns: 1fr;
        }

        .product-topbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-badge-row,
        .product-category-badge,
        .product-stock-badge {
            font-size: 0.68rem;
        }

        .product-quick-link {
            display: none;
        }
    }
</style>

<!-- Mobile Optimizations -->
<style>
    /* Mobile-First Enhancements */
    @media (max-width: 991.98px) {
        /* =============================================
           PREMIUM MOBILE FILTER TAB BAR
        ============================================= */
        @keyframes mobileFilterBarSlideUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }

        body {
            padding-bottom: calc(84px + env(safe-area-inset-bottom, 0px)) !important;
        }

        #ai-chat-widget {
            bottom: calc(88px + env(safe-area-inset-bottom, 0px)) !important;
            transition: bottom 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .mobile-filter-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 12px 16px calc(12px + env(safe-area-inset-bottom, 12px));
            background: rgba(255,255,255,0.96);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-top: 1px solid rgba(15, 81, 50, 0.08);
            box-shadow: 0 -8px 30px rgba(15, 81, 50, 0.12);
            transform: translateY(0);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            animation: mobileFilterBarSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .mobile-filter-tab-row {
            display: flex;
            gap: 8px;
        }

        .mobile-filter-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 11px 10px;
            border: 1.5px solid rgba(15,81,50,0.2);
            border-radius: 12px;
            background: #fff;
            color: #1a3c28;
            font-weight: 600;
            font-size: 0.88rem;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            letter-spacing: -0.01em;
        }

        .mobile-filter-btn i {
            font-size: 0.85rem;
        }

        .mobile-filter-btn.btn-filter-primary {
            background: linear-gradient(135deg, #0f5132 0%, #16a34a 100%);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 4px 14px rgba(15,81,50,0.3);
        }

        .mobile-filter-btn.btn-sort-primary {
            background: linear-gradient(135deg, #166534 0%, #15803d 100%);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 4px 14px rgba(22,101,52,0.25);
        }

        .mobile-filter-btn:active {
            transform: scale(0.95);
        }

        .mobile-filter-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            min-width: 18px;
            height: 18px;
            background: #ef4444;
            color: white;
            border-radius: 999px;
            padding: 0 5px;
            font-size: 0.65rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid #fff;
            box-shadow: 0 2px 6px rgba(239,68,68,0.4);
        }

        /* Mobile Filter Drawer - visibility managed by global CSS + JS */

        /* Better Touch Targets */
        .filter-pill {
            min-height: 44px;
            padding: 12px 16px;
            font-size: 0.9rem;
        }

        .category-item {
            min-height: 52px;
            padding: 14px 16px;
        }

        /* Mobile Product Grid Spacing */
        .product-grid {
            --bs-gutter-x: 12px;
            --bs-gutter-y: 16px;
        }

        /* Hide Desktop Elements on Mobile */
        .shop-toolbar-subtitle {
            display: none;
        }

        /* Mobile Header Compact */
        .shop-page-header {
            padding: 3rem 0 4rem !important;
        }

        .shop-page-header h1 {
            font-size: 1.75rem !important;
        }

        /* Mobile Toolbar Card */
        .shop-toolbar-card {
            margin-top: -40px !important;
            padding: 16px !important;
        }

        .shop-toolbar-title {
            font-size: 1.2rem !important;
        }

        /* Add bottom padding for fixed filter bar */
        body {
            padding-bottom: 88px;
        }

        /* Mobile Sort Form */
        #sortForm select {
            font-size: 0.9rem;
        }

        /* Compact Active Filters on Mobile */
        .filter-pills {
            max-height: 120px;
            overflow-y: auto;
        }

        /* Mobile Category Sidebar - hide on mobile, use mobile drawer */
        .category-sidebar {
            display: none !important;
        }

        /* On mobile: full-width product grid (no sidebar) */
        .col-lg-9 {
            width: 100% !important;
            max-width: 100% !important;
            flex: 0 0 100% !important;
        }
    }

    /* Tablet Optimizations */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .product-grid .col-6 {
            flex: 0 0 auto;
            width: 33.333333%;
        }
    }

    /* Small Mobile Optimizations */
    @media (max-width: 575.98px) {
        .filter-pill {
            font-size: 0.8rem;
            padding: 10px 12px;
        }

        .shop-toolbar-kicker {
            font-size: 0.7rem;
        }

        .reset-btn, .view-all-btn {
            width: 100%;
            margin-top: 8px;
        }
    }
</style>

<!-- ==========================================
     PREMIUM MOBILE FILTER DRAWER GLOBAL STYLES
     (outside @media so JS .active class works)
     ========================================== -->
<style>
    /* ---- Overlay / Backdrop ---- */
    .mobile-filter-drawer {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        pointer-events: none;
    }

    .mobile-filter-drawer.active {
        display: block !important;
        pointer-events: auto;
    }

    .mobile-filter-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0);
        transition: background 0.32s ease;
    }

    .mobile-filter-drawer.active .mobile-filter-backdrop {
        background: rgba(0,0,0,0.48);
    }

    /* ---- Bottom Sheet ---- */
    .mobile-filter-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        max-height: 92vh;
        background: #fff;
        border-radius: 20px 20px 0 0;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transform: translateY(102%);
        transition: transform 0.38s cubic-bezier(0.22, 1, 0.36, 1);
        box-shadow: 0 -12px 60px rgba(0,0,0,0.16);
    }

    .mobile-filter-drawer.active .mobile-filter-content {
        transform: translateY(0);
    }

    /* ---- Drag Handle ---- */
    .mf-drag-handle {
        flex-shrink: 0;
        display: flex;
        justify-content: center;
        padding: 10px 0 6px;
        cursor: grab;
    }
    .mf-drag-handle span {
        width: 36px;
        height: 4px;
        border-radius: 99px;
        background: #d1d5db;
    }

    /* ---- Header ---- */
    .mf-header {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 18px 12px;
        border-bottom: 1px solid #f3f4f6;
    }
    .mf-header-left {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .mf-header-title {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        letter-spacing: -0.02em;
    }
    .mf-header-subtitle {
        font-size: 0.72rem;
        color: #6b7280;
    }
    .mf-close-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: none;
        background: #f3f4f6;
        color: #374151;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background 0.15s, transform 0.15s;
    }
    .mf-close-btn:active { transform: scale(0.9); }
    .mf-close-btn:hover { background: #e5e7eb; }

    /* ---- Scrollable body ---- */
    .mf-body {
        flex: 1;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        padding: 16px 18px 8px;
    }

    /* ---- Section ---- */
    .mf-section {
        margin-bottom: 20px;
    }
    .mf-section-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #9ca3af;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* ---- Category icon-chip grid ---- */
    .mf-cat-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .mf-cat-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        border-radius: 8px;
        border: 1.5px solid #e5e7eb;
        background: #fafafa;
        color: #374151;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.18s ease;
        white-space: nowrap;
    }
    .mf-cat-chip i { font-size: 0.72rem; color: #9ca3af; }
    .mf-cat-chip:hover {
        background: #f0fdf4;
        border-color: #16a34a;
        color: #15803d;
    }
    .mf-cat-chip:hover i { color: #16a34a; }
    .mf-cat-chip.active {
        background: #0f5132;
        border-color: #0f5132;
        color: #fff;
    }
    .mf-cat-chip.active i { color: rgba(255,255,255,0.7); }

    /* ---- Price / general pill chips ---- */
    .mf-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .mf-chip {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 12px;
        border-radius: 8px;
        border: 1.5px solid #e5e7eb;
        background: #fafafa;
        color: #374151;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.18s ease;
        white-space: nowrap;
    }
    .mf-chip:hover {
        background: #f0fdf4;
        border-color: #16a34a;
        color: #15803d;
    }
    .mf-chip.active {
        background: #0f5132;
        border-color: #0f5132;
        color: #fff;
    }

    /* ---- Rating row ---- */
    .mf-rating-row {
        display: flex;
        gap: 6px;
        flex-wrap: nowrap;
        overflow-x: auto;
        padding-bottom: 2px;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .mf-rating-row::-webkit-scrollbar { display: none; }
    .mf-rating-chip {
        flex-shrink: 0;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        padding: 8px 14px;
        border-radius: 10px;
        border: 1.5px solid #e5e7eb;
        background: #fafafa;
        color: #374151;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.18s ease;
    }
    .mf-rating-chip .stars { font-size: 0.7rem; letter-spacing: 1px; color: #f59e0b; }
    .mf-rating-chip:hover {
        background: #fffbeb;
        border-color: #f59e0b;
    }
    .mf-rating-chip.active {
        background: #0f5132;
        border-color: #0f5132;
        color: #fff;
    }
    .mf-rating-chip.active .stars { color: #fde68a; }

    /* ---- Footer ---- */
    .mf-footer {
        flex-shrink: 0;
        display: flex;
        gap: 8px;
        padding: 12px 18px 20px;
        border-top: 1px solid #f3f4f6;
        background: #fff;
    }
    .mf-btn-reset {
        flex: 1;
        padding: 12px;
        border-radius: 12px;
        border: 1.5px solid #e5e7eb;
        background: #fff;
        color: #6b7280;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.18s;
        text-align: center;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    .mf-btn-reset:hover { background: #fef2f2; border-color: #fca5a5; color: #dc2626; }

    .mf-btn-apply {
        flex: 2;
        padding: 12px;
        border-radius: 12px;
        border: none;
        background: linear-gradient(135deg, #0f5132, #16a34a);
        color: #fff;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.18s;
        box-shadow: 0 4px 16px rgba(15,81,50,0.28);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .mf-btn-apply:active { transform: scale(0.97); }

    /* ---- Sort Drawer Sort Items ---- */
    .mf-sort-list {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .mf-sort-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 14px;
        border-radius: 12px;
        border: 1.5px solid transparent;
        background: transparent;
        color: #374151;
        font-size: 0.88rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.18s ease;
    }
    .mf-sort-item .mf-sort-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #f3f4f6;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        flex-shrink: 0;
        transition: all 0.18s;
    }
    .mf-sort-item span { flex: 1; }
    .mf-sort-item .mf-check { font-size: 0.8rem; color: #16a34a; opacity: 0; transition: opacity 0.18s; }
    .mf-sort-item:hover {
        background: #f9fafb;
        border-color: #e5e7eb;
    }
    .mf-sort-item:hover .mf-sort-icon { background: #ecfdf5; color: #15803d; }
    .mf-sort-item.active {
        background: #f0fdf4;
        border-color: #86efac;
        color: #0f5132;
        font-weight: 700;
    }
    .mf-sort-item.active .mf-sort-icon { background: #0f5132; color: #fff; }
    .mf-sort-item.active .mf-check { opacity: 1; }

    /* ---- Search input in drawer ---- */
    .mf-search-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f9fafb;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 0 12px;
        transition: border-color 0.18s;
    }
    .mf-search-wrap:focus-within {
        border-color: #16a34a;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
    }
    .mf-search-wrap i { color: #9ca3af; font-size: 0.85rem; flex-shrink: 0; }
    .mf-search-wrap input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 11px 0;
        font-size: 0.88rem;
        color: #111827;
        outline: none;
    }
    .mf-search-wrap input::placeholder { color: #d1d5db; }
    .mf-search-btn {
        flex-shrink: 0;
        padding: 6px 12px;
        border-radius: 7px;
        border: none;
        background: #0f5132;
        color: #fff;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s;
    }
    .mf-search-btn:hover { background: #16a34a; }
</style>

<!-- Enhanced Sidebar Styles -->
<style>
    /* Sidebar Section Headers */
    .sidebar-section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 16px;
        background: linear-gradient(135deg, #0f5132, #198754);
        color: white;
        border-radius: 12px 12px 0 0;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .sidebar-section-header i {
        font-size: 1.1rem;
    }

    /* Modern Category List */
    .category-list-modern {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 12px;
    }

    .category-item-modern {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 12px;
        background: white;
        border: 1px solid rgba(15,81,50,0.08);
        text-decoration: none;
        transition: all 0.25s ease;
        position: relative;
    }

    .category-item-modern:hover {
        background: rgba(236,253,245,0.5);
        border-color: rgba(15,81,50,0.2);
        transform: translateX(4px);
        text-decoration: none;
    }

    .category-item-modern.active {
        background: linear-gradient(135deg, #0f5132, #198754);
        border-color: transparent;
        box-shadow: 0 8px 20px rgba(15,81,50,0.2);
    }

    .category-item-modern.active .category-icon {
        background: rgba(15,81,50,0.15);
        color: #0f5132;
    }

    .category-item-modern.active .category-name,
    .category-item-modern.active .category-count,
    .category-item-modern.active .category-arrow {
        color: #0f5132 !important;
    }

    .category-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(15,81,50,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0f5132;
        font-size: 1rem;
        flex-shrink: 0;
        transition: all 0.25s ease;
    }

    .category-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .category-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: #1c3644;
        transition: color 0.25s ease;
    }

    .category-count {
        font-size: 0.75rem;
        color: #667970;
        transition: color 0.25s ease;
    }

    .category-arrow {
        color: #667970;
        font-size: 0.8rem;
        transition: all 0.25s ease;
    }

    .category-item-modern:hover .category-arrow {
        transform: translateX(4px);
        color: #0f5132;
    }

    .category-show-more {
        width: 100%;
        padding: 10px;
        border: 1px dashed rgba(15,81,50,0.2);
        border-radius: 10px;
        background: rgba(236,253,245,0.3);
        color: #0f5132;
        font-weight: 600;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
        cursor: pointer;
    }

    .category-show-more:hover {
        background: rgba(236,253,245,0.6);
        border-color: rgba(15,81,50,0.4);
    }

    .category-list-extra {
        margin-top: 8px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    /* Filter Option - Modern Pill Style */
    .filter-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 12px;
        background: #ffffff;
        border: 1.5px solid rgba(15,81,50,0.06);
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .filter-option::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: #0f5132;
        transform: scaleY(0);
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .filter-option:hover {
        background: rgba(236,253,245,0.5);
        border-color: rgba(15,81,50,0.15);
        transform: translateX(4px);
        text-decoration: none;
    }

    .filter-option.active {
        background: linear-gradient(135deg, rgba(15,81,50,0.06), rgba(25,135,84,0.04));
        border-color: #0f5132;
        box-shadow: 0 4px 16px rgba(15,81,50,0.12);
    }

    .filter-option.active::before {
        transform: scaleY(1);
    }

    /* Filter Checkbox - Animated */
    .filter-checkbox {
        flex-shrink: 0;
        color: #adb5bd;
        font-size: 1.2rem;
        transition: all 0.25s ease;
        width: 22px;
        text-align: center;
    }

    .filter-option:hover .filter-checkbox {
        color: #6c757d;
    }

    .filter-option.active .filter-checkbox {
        color: #0f5132;
        transform: scale(1.1);
    }

    /* Filter Label - Better Typography */
    .filter-label {
        flex: 1;
        font-size: 0.88rem;
        color: #1c3644;
        font-weight: 500;
        line-height: 1.4;
        transition: color 0.2s ease;
    }

    .filter-option:hover .filter-label {
        color: #0f5132;
    }

    .filter-option.active .filter-label {
        color: #0f5132;
        font-weight: 600;
    }

    /* Rating Stars - Large & Gold */
    .rating-stars {
        display: flex;
        align-items: center;
        gap: 3px;
        font-size: 1rem;
    }

    .rating-stars i {
        font-size: 1.05rem;
        transition: transform 0.2s ease;
    }

    .rating-stars i.text-warning {
        color: #f59e0b !important;
        filter: drop-shadow(0 1px 2px rgba(245,158,11,0.3));
    }

    .filter-option:hover .rating-stars i.text-warning {
        transform: scale(1.15);
    }

    .rating-stars span {
        font-size: 0.8rem;
        color: #667970;
        font-weight: 500;
        margin-left: 4px;
    }

    /* Stock Status - Color Coded */
    .filter-option .filter-label .fa-check-circle {
        color: #16a34a;
    }

    .filter-option .filter-label .fa-exclamation-circle {
        color: #f59e0b;
    }

    .filter-option.active .filter-label .fa-check-circle,
    .filter-option.active .filter-label .fa-exclamation-circle {
        color: inherit;
    }

    /* Sidebar Section - Improved Spacing */
    .sidebar-section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 18px;
        background: linear-gradient(135deg, #0a3d28, #166534);
        color: white;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 0.01em;
        position: relative;
        overflow: hidden;
    }

    .sidebar-section-header::after {
        content: '';
        position: absolute;
        right: -20px;
        top: -20px;
        width: 60px;
        height: 60px;
        background: radial-gradient(circle, rgba(255,255,255,0.08), transparent);
        pointer-events: none;
    }

    .sidebar-section-header i {
        font-size: 1rem;
        width: 20px;
        text-align: center;
    }

    .category-sidebar .border-bottom {
        border-color: rgba(15,81,50,0.08) !important;
    }

    .filter-section {
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding: 14px 14px 6px;
    }

    /* Category Items - More Premium */
    .category-item-modern {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 12px;
        background: transparent;
        border: 1.5px solid transparent;
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .category-item-modern::before {
        content: '';
        position: absolute;
        left: 0;
        top: 6px;
        bottom: 6px;
        width: 3px;
        background: #0f5132;
        border-radius: 3px;
        transform: scaleY(0);
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .category-item-modern:hover {
        background: rgba(236,253,245,0.5);
        border-color: rgba(15,81,50,0.1);
        transform: translateX(4px);
        text-decoration: none;
    }

    .category-item-modern:hover::before {
        transform: scaleY(1);
    }

    .category-item-modern.active {
        background: linear-gradient(135deg, rgba(15,81,50,0.06), rgba(25,135,84,0.04));
        border-color: rgba(15,81,50,0.15);
        box-shadow: 0 4px 16px rgba(15,81,50,0.08);
    }

    .category-item-modern.active::before {
        transform: scaleY(1);
    }

    .category-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(15,81,50,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0f5132;
        font-size: 0.95rem;
        flex-shrink: 0;
        transition: all 0.25s ease;
    }

    .category-item-modern:hover .category-icon {
        background: rgba(15,81,50,0.14);
        transform: scale(1.05);
    }

    .category-item-modern.active .category-icon {
        background: rgba(15,81,50,0.15);
        color: #0f5132;
    }

    .category-item-modern.active .category-name,
    .category-item-modern.active .category-count {
        color: #0f5132;
    }

    .category-name {
        font-weight: 600;
        font-size: 0.88rem;
        color: #02151fff;
        transition: color 0.25s ease;
    }

    .category-count {
        font-size: 0.72rem;
        color: #889f96;
        transition: color 0.25s ease;
    }

    .category-arrow {
        color: #c5d5ce;
        font-size: 0.75rem;
        transition: all 0.25s ease;
        opacity: 0.5;
    }

    .category-item-modern:hover .category-arrow {
        transform: translateX(4px);
        opacity: 1;
        color: #0f5132;
    }

    .category-item-modern.active .category-arrow {
        opacity: 1;
        color: #0f5132;
    }

    /* Show More Button */
    .category-show-more {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px dashed rgba(15,81,50,0.2);
        border-radius: 10px;
        background: rgba(236,253,245,0.2);
        color: #0f5132;
        font-weight: 600;
        font-size: 0.82rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
        cursor: pointer;
        margin-top: 4px;
    }

    .category-show-more:hover {
        background: rgba(236,253,245,0.6);
        border-color: rgba(15,81,50,0.4);
        border-style: solid;
    }

    /* Category Sidebar - Visual Container */
    .category-sidebar {
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
        border: 1px solid rgba(15,81,50,0.08);
        border-radius: 20px;
        box-shadow: 0 8px 28px rgba(15,81,50,0.06);
        /* Sticky positioning and scroll already defined in main CSS - don't override */
    }

    /* Inner wrapper for proper border-radius clipping */
    .category-sidebar-inner {
        border-radius: 20px;
        overflow: hidden;
    }

    /* Mobile Adjustments for Sidebar */
    @media (max-width: 991.98px) {
        .category-sidebar {
            margin-bottom: 16px;
        }

        .category-item-modern {
            padding: 10px 12px;
        }

        .category-icon {
            width: 34px;
            height: 34px;
            font-size: 0.85rem;
        }

        .category-name {
            font-size: 0.85rem;
        }

        .category-count {
            font-size: 0.7rem;
        }

        .filter-option {
            padding: 10px 12px;
        }

        .rating-stars i {
            font-size: 0.95rem;
        }
    }
</style>

    <!-- Hero Section CSS Enhancement -->
    <style>
        .shop-hero-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: rgba(255,255,255,0.15);
            color: white;
            font-size: 1.4rem;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .shop-hero-title {
            font-size: clamp(1.6rem, 4vw, 2.6rem);
            font-weight: 800;
            color: white;
            line-height: 1.2;
            letter-spacing: -0.03em;
            text-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }

        .shop-hero-subtitle {
            font-size: clamp(0.9rem, 1.2vw, 1.05rem);
            color: rgba(255,255,255,0.8);
            line-height: 1.6;
            max-width: 520px;
        }

        .shop-hero-stats {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .shop-hero-stat {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 999px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.12);
            color: white;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .shop-hero-stat i {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .shop-hero-badge {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            padding: 16px 20px;
            border-radius: 20px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 16px 32px rgba(0,0,0,0.1);
            color: #0f5132;
        }

        .shop-hero-badge-value {
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #0f5132, #16a34a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .shop-hero-badge-label {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6b7280;
        }

        @media (max-width: 767.98px) {
            .shop-hero-badge {
                display: none;
            }
            .shop-hero-stats {
                gap: 8px;
            }
            .shop-hero-stat {
                padding: 6px 12px;
                font-size: 0.78rem;
            }
            .shop-hero-icon {
                width: 42px;
                height: 42px;
                font-size: 1.1rem;
            }
        }
    </style>

    <div class="container-fluid page-header shop-page-header py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="shop-hero-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <ol class="breadcrumb mb-0" style="background: rgba(255,255,255,0.1); padding: 8px 16px; border-radius: 999px; backdrop-filter: blur(8px);">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-white-50"><i class="fas fa-home me-1"></i>Home</a></li>
                            <li class="breadcrumb-item active text-white fw-bold">Katalog Produk</li>
                        </ol>
                    </div>
                    <h1 class="shop-hero-title mb-3">
                        Jelajahi <span style="color: #86efac;">{{ $products->count() }}</span> Produk Pilihan
                    </h1>
                    <p class="shop-hero-subtitle mb-4">
                        Temukan produk berkualitas untuk kebutuhan cetak, ATK, dan perlengkapan kantor Anda dengan harga terbaik.
                    </p>
                    <div class="shop-hero-stats">
                        <div class="shop-hero-stat">
                            <i class="fas fa-box"></i>
                            <span>{{ $products->count() }} Produk</span>
                        </div>
                        <div class="shop-hero-stat">
                            <i class="fas fa-tags"></i>
                            <span>{{ $categories->count() }} Kategori</span>
                        </div>
                        <div class="shop-hero-stat">
                            <i class="fas fa-star text-warning"></i>
                            <span>Kualitas Premium</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <!-- Search and Filter Section -->
            <div class="search-container shop-toolbar-card">
                <div class="row g-3 align-items-end mb-3">
                    <div class="col-lg-5">
                        <div class="shop-toolbar-copy">
                            <span class="shop-toolbar-kicker"><i class="fas fa-sparkles"></i> Katalog Lengkap</span>
                            <h5 class="shop-toolbar-title mb-2">Jelajahi {{ $products->count() }} Produk Berkualitas</h5>
                            <p class="shop-toolbar-subtitle mb-0">Temukan produk terbaik dengan filter pintar dan pencarian toleran typo</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <form action="{{ route('shop') }}" method="GET" id="sortForm">
                            @foreach(request()->except(['sort', 'perPage', 'page']) as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $v)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <label class="form-label fw-bold text-primary mb-2 d-flex align-items-center">
                                <i class="fas fa-sort-amount-down me-2"></i>Urutkan Berdasarkan
                            </label>
                            <select name="sort" class="form-select sort-dropdown" onchange="document.getElementById('sortForm').submit()">
                                <option value="">Paling Relevan</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                            </select>
                        </form>
                    </div>
                    
                    <div class="col-lg-3 text-end">
                        @php
                            $hasFilters = request()->hasAny(['search', 'sort', 'price_min', 'price_max', 'rating', 'stock_status']) || Request::is('shopCategory*');
                        @endphp
                        @if($hasFilters)
                            <a href="{{ route('shop') }}" class="reset-btn w-100">
                                <i class="fas fa-sync-alt me-2"></i>Reset Semua Filter
                            </a>
                        @endif
                    </div>
                </div>
                
                <!-- Active Filters with Remove Buttons -->
                @if(request()->hasAny(['search', 'sort', 'price_min', 'price_max', 'rating', 'stock_status']) || Request::is('shopCategory*'))
                    <div class="mt-3 pt-3 border-top">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted small fw-bold"><i class="fas fa-bookmark me-1"></i> Filter Aktif ({{ collect([request('search'), request('sort'), request('price_min'), request('price_max'), request('rating'), request('stock_status'), Request::is('shopCategory*') ? 'category' : null])->filter()->count() }}):</span>
                            <a href="{{ route('shop') }}" class="text-danger text-decoration-none small">
                                <i class="fas fa-times-circle me-1"></i>Hapus Semua
                            </a>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            @if(request('search'))
                                <a href="{{ route('shop') }}?{{ http_build_query(request()->except(['search', 'page'])) }}" 
                                   class="filter-pill active" style="background: #0f5132; color: white; border-color: #0f5132;">
                                    <i class="fas fa-search me-1"></i>
                                    Pencarian: "{{ request('search') }}"
                                    <i class="fas fa-times ms-2"></i>
                                </a>
                            @endif
                            @if(request('sort'))
                                <a href="{{ route('shop') }}?{{ http_build_query(request()->except(['sort', 'page'])) }}" 
                                   class="filter-pill active" style="background: #0f5132; color: white; border-color: #0f5132;">
                                    <i class="fas fa-sort me-1"></i>
                                    @switch(request('sort'))
                                        @case('name_asc') Nama A-Z @break
                                        @case('name_desc') Nama Z-A @break
                                        @case('price_asc') Harga Terendah @break
                                        @case('price_desc') Harga Tertinggi @break
                                        @case('newest') Terbaru @break
                                        @case('popular') Terpopuler @break
                                        @case('rating') Rating Tertinggi @break
                                        @default {{ request('sort') }}
                                    @endswitch
                                    <i class="fas fa-times ms-2"></i>
                                </a>
                            @endif
                            @if(request('price_min') || request('price_max'))
                                <a href="{{ route('shop') }}?{{ http_build_query(request()->except(['price_min', 'price_max', 'page'])) }}" 
                                   class="filter-pill active" style="background: #0f5132; color: white; border-color: #0f5132;">
                                    <i class="fas fa-money-bill-wave me-1"></i>
                                    Harga: Rp{{ request('price_min') ? number_format(request('price_min'), 0, ',', '.') : '0' }} - Rp{{ request('price_max') ? number_format(request('price_max'), 0, ',', '.') : '∞' }}
                                    <i class="fas fa-times ms-2"></i>
                                </a>
                            @endif
                            @if(request('rating'))
                                <a href="{{ route('shop') }}?{{ http_build_query(request()->except(['rating', 'page'])) }}" 
                                   class="filter-pill active" style="background: #0f5132; color: white; border-color: #0f5132;">
                                    <i class="fas fa-star me-1"></i>
                                    Rating {{ request('rating') }}+
                                    <i class="fas fa-times ms-2"></i>
                                </a>
                            @endif
                            @if(request('stock_status'))
                                <a href="{{ route('shop') }}?{{ http_build_query(request()->except(['stock_status', 'page'])) }}" 
                                   class="filter-pill active" style="background: #0f5132; color: white; border-color: #0f5132;">
                                    <i class="fas fa-box me-1"></i>
                                    @if(request('stock_status') == 'available') Stok Tersedia
                                    @elseif(request('stock_status') == 'low') Stok Terbatas
                                    @else {{ request('stock_status') }}
                                    @endif
                                    <i class="fas fa-times ms-2"></i>
                                </a>
                            @endif
                            @if(Request::is('shopCategory*'))
                                @php
                                    $currentCategoryName = $categories->where('slug', request()->route('slug'))->first()->name ?? 'Kategori';
                                @endphp
                                <a href="{{ route('shop') }}?{{ http_build_query(request()->except(['page'])) }}" 
                                   class="filter-pill active" style="background: #0f5132; color: white; border-color: #0f5132;">
                                    <i class="fas fa-folder me-1"></i>
                                    Kategori: {{ $currentCategoryName }}
                                    <i class="fas fa-times ms-2"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            <!-- Main Content -->
            <div class="row g-4">
                <!-- Enhanced Professional Sidebar -->
                <div class="col-lg-3">
                    <div class="category-sidebar">
                        <div class="category-sidebar-inner">
                        <!-- Search Section -->
                        <div class="sidebar-section pb-3 mb-3 border-bottom">
                            <div class="sidebar-section-header">
                                <i class="fas fa-search"></i>
                                <span>Cari Produk</span>
                            </div>
                            <form action="{{ route('shop') }}" method="GET" class="px-3">
                                @foreach(request()->except(['search', 'page']) as $k => $v)
                                    @if(is_array($v))
                                        @foreach($v as $val)
                                            <input type="hidden" name="{{ $k }}[]" value="{{ $val }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                    @endif
                                @endforeach
                                <div class="search-input-group d-flex align-items-center">
                                    <input type="text" name="search" class="form-control search-input" 
                                           placeholder="Cari produk..." value="{{ request('search') }}" 
                                           aria-label="Cari produk">
                                    <button type="submit" class="btn search-btn ms-2">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <small class="text-muted d-block mt-2"><i class="fas fa-magic me-1"></i>Pencarian toleran typo</small>
                            </form>
                        </div>

                        <!-- Category Section -->
                        <div class="sidebar-section pb-3 mb-3 border-bottom">
                            <div class="sidebar-section-header">
                                <i class="fas fa-th-large"></i>
                                <span>Kategori</span>
                            </div>
                            <div class="category-list-modern px-2">
                                @php
                                    $currentCategory = request()->route('slug') ?? '';
                                    $categoryProductCounts = [];
                                    foreach ($categories as $cat) {
                                        $count = $products->filter(function($prod) use ($cat) {
                                            return $prod->categories && $prod->categories->id == $cat->id;
                                        })->count();
                                        $categoryProductCounts[$cat->id] = $count;
                                    }
                                @endphp
                                
                                <a href="{{ route('shop') }}" 
                                   class="category-item-modern {{ !$currentCategory ? 'active' : '' }}">
                                    <div class="category-icon"><i class="fas fa-th"></i></div>
                                    <div class="category-info">
                                        <span class="category-name">Semua Kategori</span>
                                        <span class="category-count">{{ $products->count() }} produk</span>
                                    </div>
                                    <i class="fas fa-chevron-right category-arrow"></i>
                                </a>
                                
                                @foreach ($categories->take(8) as $item)
                                    <a href="{{ route('shopCategory', $item->slug) }}" 
                                       class="category-item-modern {{ $currentCategory == $item->slug ? 'active' : '' }}">
                                        <div class="category-icon"><i class="fas fa-tag"></i></div>
                                        <div class="category-info">
                                            <span class="category-name">{{ $item->name }}</span>
                                            <span class="category-count">{{ $categoryProductCounts[$item->id] ?? 0 }} produk</span>
                                        </div>
                                        <i class="fas fa-chevron-right category-arrow"></i>
                                    </a>
                                @endforeach
                                
                                @if($categories->count() > 8)
                                    <button type="button" class="category-show-more" id="showMoreCategories">
                                        <i class="fas fa-chevron-down me-2"></i>
                                        <span>Lihat {{ $categories->count() - 8 }} kategori lainnya</span>
                                    </button>
                                    <div class="category-list-extra" style="display: none;">
                                        @foreach ($categories->skip(8) as $item)
                                            <a href="{{ route('shopCategory', $item->slug) }}" 
                                               class="category-item-modern {{ $currentCategory == $item->slug ? 'active' : '' }}">
                                                <div class="category-icon"><i class="fas fa-tag"></i></div>
                                                <div class="category-info">
                                                    <span class="category-name">{{ $item->name }}</span>
                                                    <span class="category-count">{{ $categoryProductCounts[$item->id] ?? 0 }} produk</span>
                                                </div>
                                                <i class="fas fa-chevron-right category-arrow"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Price Range Filter Section -->
                        <div class="sidebar-section pb-3 mb-3 border-bottom">
                            <div class="sidebar-section-header">
                                <i class="fas fa-money-bill-wave"></i>
                                <span>Rentang Harga</span>
                            </div>
                            <div class="filter-section">
                                @php
                                    $priceRanges = [
                                        ['label' => 'Di bawah Rp50.000', 'max' => 50000],
                                        ['label' => 'Rp50.000 - Rp100.000', 'min' => 50000, 'max' => 100000],
                                        ['label' => 'Rp100.000 - Rp250.000', 'min' => 100000, 'max' => 250000],
                                        ['label' => 'Rp250.000 - Rp500.000', 'min' => 250000, 'max' => 500000],
                                        ['label' => 'Di atas Rp500.000', 'min' => 500000],
                                    ];
                                @endphp
                                @foreach($priceRanges as $range)
                                    @php
                                        $isActive = false;
                                        if(isset($range['min']) && isset($range['max'])) {
                                            $isActive = request('price_min') == $range['min'] && request('price_max') == $range['max'];
                                        } elseif(isset($range['max'])) {
                                            $isActive = !request('price_min') && request('price_max') == $range['max'];
                                        } elseif(isset($range['min'])) {
                                            $isActive = request('price_min') == $range['min'] && !request('price_max');
                                        }
                                    @endphp
                                    <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['price_min', 'price_max', 'page']), array_filter(['price_min' => $range['min'] ?? null, 'price_max' => $range['max'] ?? null]))) }}" 
                                       class="filter-option {{ $isActive ? 'active' : '' }}">
                                        <div class="filter-checkbox">
                                            <i class="fas {{ $isActive ? 'fa-check-square' : 'fa-square' }}"></i>
                                        </div>
                                        <span class="filter-label">{{ $range['label'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Rating Filter Section -->
                        <div class="sidebar-section pb-3 mb-3 border-bottom">
                            <div class="sidebar-section-header">
                                <i class="fas fa-star"></i>
                                <span>Rating Produk</span>
                            </div>
                            <div class="filter-section">
                                @foreach([5, 4, 3, 2] as $ratingLevel)
                                    <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['rating', 'page']), ['rating' => $ratingLevel])) }}" 
                                       class="filter-option {{ request('rating') == $ratingLevel ? 'active' : '' }}">
                                        <div class="filter-checkbox">
                                            <i class="fas {{ request('rating') == $ratingLevel ? 'fa-check-square' : 'fa-square' }}"></i>
                                        </div>
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $ratingLevel ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                            <span class="ms-1">& Lebih</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Stock Filter Section -->
                        <div class="sidebar-section pb-3 mb-3 border-bottom">
                            <div class="sidebar-section-header">
                                <i class="fas fa-box"></i>
                                <span>Ketersediaan</span>
                            </div>
                            <div class="filter-section">
                                <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['stock_status', 'page']), ['stock_status' => 'available'])) }}" 
                                   class="filter-option {{ request('stock_status') == 'available' ? 'active' : '' }}">
                                    <div class="filter-checkbox">
                                        <i class="fas {{ request('stock_status') == 'available' ? 'fa-check-square' : 'fa-square' }}"></i>
                                    </div>
                                    <span class="filter-label">
                                        <i class="fas fa-check-circle text-success me-1"></i>Stok Tersedia
                                    </span>
                                </a>
                                <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['stock_status', 'page']), ['stock_status' => 'low'])) }}" 
                                   class="filter-option {{ request('stock_status') == 'low' ? 'active' : '' }}">
                                    <div class="filter-checkbox">
                                        <i class="fas {{ request('stock_status') == 'low' ? 'fa-check-square' : 'fa-square' }}"></i>
                                    </div>
                                    <span class="filter-label">
                                        <i class="fas fa-exclamation-circle text-warning me-1"></i>Stok Terbatas
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- Reset Filters -->
                        @if(request()->hasAny(['search', 'price_min', 'price_max', 'rating', 'stock_status']) || Request::is('shopCategory*'))
                            <div class="px-3 py-2">
                                <a href="{{ route('shop') }}" class="btn btn-outline-danger w-100">
                                    <i class="fas fa-undo me-2"></i>Reset Semua Filter
                                </a>
                            </div>
                        @endif
                            </div><!-- end category-sidebar-inner -->
                        </div><!-- end category-sidebar -->
                </div>
                
                <!-- Products Grid -->
                <div class="col-lg-9">
                    <!-- Products Header with Count -->
                    <div class="products-header catalog-results-card">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3">
                            <div class="flex-grow-1">
                                <h5 class="text-primary fw-bold mb-2 d-flex align-items-center gap-2">
                                    @if(request('search'))
                                        <i class="fas fa-search"></i>
                                        Hasil Pencarian
                                    @elseif(request()->route('slug'))
                                        <i class="fas fa-folder-open"></i>
                                        {{ $categories->where('slug', request()->route('slug'))->first()->name ?? 'Kategori' }}
                                    @else
                                        <i class="fas fa-store"></i>
                                        Semua Produk
                                    @endif
                                </h5>
                                @php
                                    $totalProducts = $products->count();
                                    $currentPage = request()->get('page', 1);
                                    $perPage = (int) request('perPage', 12);
                                    if (!in_array($perPage, [6,12,24,48])) { $perPage = 12; }
                                    $startItem = (($currentPage - 1) * $perPage) + 1;
                                    $endItem = min($currentPage * $perPage, $totalProducts);
                                @endphp
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-box-open me-1"></i>
                                        <strong class="text-dark">Menampilkan {{ $startItem }}-{{ $endItem }}</strong> dari <strong class="text-dark">{{ $totalProducts }}</strong> produk
                                    </p>
                                    @if(request('search'))
                                        <span class="badge" style="background: rgba(15,81,50,0.1); color: #0f5132;">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Pencarian toleran typo aktif
                                        </span>
                                    @endif
                                    @if(request()->hasAny(['price_min', 'price_max', 'rating', 'stock_status']))
                                        <span class="badge bg-success">
                                            <i class="fas fa-filter me-1"></i>
                                            Filter aktif
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <div class="text-muted small d-none d-lg-flex align-items-center">
                                    <i class="fas fa-sync-alt me-2"></i>
                                    <span>Diperbarui hari ini</span>
                                </div>
                                <div class="vr d-none d-lg-block" style="height: 24px;"></div>
                                <form method="GET" class="d-flex align-items-center gap-2">
                                    @foreach(request()->except('perPage') as $k => $v)
                                        @if(is_array($v))
                                            @foreach($v as $val)
                                                <input type="hidden" name="{{ $k }}[]" value="{{ $val }}">
                                            @endforeach
                                        @else
                                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                        @endif
                                    @endforeach
                                    <label class="text-muted small mb-0 d-none d-md-inline">Tampilkan:</label>
                                    <select name="perPage" class="form-select form-select-sm" onchange="this.form.submit()" aria-label="Hasil per halaman" style="width: auto;">
                                        @php $pp = (int) request('perPage', 12); @endphp
                                        <option value="6" {{ $pp==6 ? 'selected' : '' }}>6</option>
                                        <option value="12" {{ $pp==12 ? 'selected' : '' }}>12</option>
                                        <option value="24" {{ $pp==24 ? 'selected' : '' }}>24</option>
                                        <option value="48" {{ $pp==48 ? 'selected' : '' }}>48</option>
                                    </select>
                                    <span class="text-muted small d-none d-md-inline">per halaman</span>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Products Grid -->
                    <?php
                        use Illuminate\Pagination\LengthAwarePaginator;
                        $currentPage = request()->get('page', 1);
                        $perPage = (int) request('perPage', 12);
                        if (!in_array($perPage, [6,12,24,48])) { $perPage = 12; }
                        if ($products instanceof \Illuminate\Support\Collection) {
                            $items = $products->values()->all();
                            $total = $products->count();
                        } elseif (is_array($products)) {
                            $items = $products;
                            $total = count($items);
                        } elseif (is_object($products) && method_exists($products, 'all')) {
                            $items = $products->all();
                            $total = count($items);
                        } else {
                            $items = [];
                            $total = 0;
                        }
                        $offset = ($currentPage - 1) * $perPage;
                        $pagedData = array_slice($items, $offset, $perPage);
                        $paginator = new LengthAwarePaginator($pagedData, $total, $perPage, $currentPage, [
                            'path' => request()->url(),
                            'query' => request()->query()
                        ]);
                    ?>

                    <div class="row product-grid">
                        @forelse ($paginator as $row)
                            @php
                                $product = $row->products;
                                $categoryName = $row->categories->name ?? 'Tanpa kategori';
                                $image = !empty($product->productImages->first()) 
                                    ? asset('storage/'.$product->productImages->first()->path) 
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
                            <div class="col-6 col-md-4 col-lg-3">
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
                        @empty
                            <div class="col-12">
                                <div class="no-products">
                                    <i class="fas fa-search"></i>
                                    <h4 class="text-muted mb-3">Produk Tidak Ditemukan</h4>
                                    <p class="text-muted mb-4">
                                        @if(request('search'))
                                            Maaf, tidak ada produk yang cocok dengan pencarian "{{ request('search') }}".
                                            <br>Coba gunakan kata kunci lain atau periksa ejaan.
                                        @else
                                            Tidak ada produk tersedia saat ini.
                                        @endif
                                    </p>
                                    @if(request('search'))
                                        <a href="{{ route('shop') }}" class="btn btn-primary rounded-pill px-4">
                                            <i class="fas fa-arrow-left me-2"></i>
                                            Lihat Semua Produk
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $paginator->links('pagination::bootstrap-5') }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Filter Bar (Fixed Bottom) — Premium Tab Bar -->
    <div class="mobile-filter-bar d-lg-none">
        <div class="mobile-filter-tab-row">
            @php
                $activeFiltersCount = collect([
                    request('search'),
                    request('price_min'),
                    request('price_max'),
                    request('rating'),
                    request('stock_status'),
                    Request::is('shopCategory*') ? 'category' : null
                ])->filter()->count();
                $currentSort = request('sort', '');
                $sortLabels = ['newest'=>'Terbaru','popular'=>'Terpopuler','price_asc'=>'Termurah','price_desc'=>'Termahal','name_asc'=>'A-Z','name_desc'=>'Z-A','rating'=>'Rating'];
                $sortLabel = $currentSort ? ($sortLabels[$currentSort] ?? 'Sortir') : null;
            @endphp

            <button type="button" class="mobile-filter-btn {{ $activeFiltersCount > 0 ? 'btn-filter-primary' : '' }}" id="openMobileFilter">
                <i class="fas fa-sliders-h"></i>
                <span>Filter{{ $activeFiltersCount > 0 ? '' : '' }}</span>
                @if($activeFiltersCount > 0)
                    <span class="mobile-filter-badge">{{ $activeFiltersCount }}</span>
                @endif
            </button>

            <button type="button" class="mobile-filter-btn {{ $sortLabel ? 'btn-sort-primary' : '' }}" id="openMobileSort">
                <i class="fas fa-sort-amount-down"></i>
                <span>{{ $sortLabel ?? 'Urutkan' }}</span>
            </button>

            {{-- Quick search icon --}}
            <a href="#mobileSearchInput" class="mobile-filter-btn" id="openMobileSearch" onclick="event.preventDefault(); document.getElementById('mobileFilterDrawer').classList.add('active'); document.body.style.overflow='hidden'; setTimeout(()=>document.getElementById('mobileSearchInput').focus(),400);">
                <i class="fas fa-search"></i>
            </a>
        </div>
    </div>

    <!-- ==========================================
         PREMIUM MOBILE FILTER DRAWER
    =========================================== -->
    <div class="mobile-filter-drawer" id="mobileFilterDrawer">
        <div class="mobile-filter-backdrop" id="mobileFilterBackdrop"></div>
        <div class="mobile-filter-content" id="mobileFilterSheet">

            <!-- Drag Handle -->
            <div class="mf-drag-handle" id="mfDragHandle"><span></span></div>

            <!-- Header -->
            <div class="mf-header">
                <div class="mf-header-left">
                    <div class="mf-header-title"><i class="fas fa-sliders-h me-2" style="color:#0f5132;"></i>Filter Produk</div>
                    @php $totalActive = collect([request('search'), request('price_min'), request('price_max'), request('rating'), request('stock_status'), Request::is('shopCategory*') ? 'cat' : null])->filter()->count(); @endphp
                    @if($totalActive > 0)
                    <div class="mf-header-subtitle">{{ $totalActive }} filter aktif</div>
                    @else
                    <div class="mf-header-subtitle">Tidak ada filter aktif</div>
                    @endif
                </div>
                <button type="button" class="mf-close-btn" id="closeMobileFilter">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Scrollable body -->
            <div class="mf-body">

                <!-- SEARCH -->
                <div class="mf-section">
                    <div class="mf-section-label"><i class="fas fa-search"></i> Cari Produk</div>
                    <form action="{{ route('shop') }}" method="GET">
                        @foreach(request()->except(['search', 'page']) as $k => $v)
                            @if(is_array($v)) @foreach($v as $val)<input type="hidden" name="{{ $k }}[]" value="{{ $val }}">@endforeach
                            @else <input type="hidden" name="{{ $k }}" value="{{ $v }}">@endif
                        @endforeach
                        <div class="mf-search-wrap">
                            <i class="fas fa-search"></i>
                            <input type="text" id="mobileSearchInput" name="search" placeholder="Cari produk..." value="{{ request('search') }}" autocomplete="off">
                            <button type="submit" class="mf-search-btn">Cari</button>
                        </div>
                    </form>
                </div>

                <!-- CATEGORY -->
                <div class="mf-section">
                    <div class="mf-section-label"><i class="fas fa-th-large"></i> Kategori</div>
                    @php $currentCatSlug = request()->route('slug') ?? ''; @endphp
                    <div class="mf-cat-grid">
                        <a href="{{ route('shop') }}" class="mf-cat-chip {{ !$currentCatSlug ? 'active' : '' }}">
                            <i class="fas fa-th"></i> Semua
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('shopCategory', $cat->slug) }}" class="mf-cat-chip {{ $currentCatSlug == $cat->slug ? 'active' : '' }}">
                            <i class="fas fa-tag"></i> {{ $cat->name }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- PRICE RANGE -->
                <div class="mf-section">
                    <div class="mf-section-label"><i class="fas fa-wallet"></i> Rentang Harga</div>
                    <div class="mf-chips">
                        @foreach($priceRanges as $range)
                            @php
                                $isActive = false;
                                if(isset($range['min']) && isset($range['max'])) $isActive = request('price_min') == $range['min'] && request('price_max') == $range['max'];
                                elseif(isset($range['max'])) $isActive = !request('price_min') && request('price_max') == $range['max'];
                                elseif(isset($range['min'])) $isActive = request('price_min') == $range['min'] && !request('price_max');
                            @endphp
                            <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['price_min','price_max','page']), array_filter(['price_min' => $range['min'] ?? null,'price_max' => $range['max'] ?? null]))) }}"
                               class="mf-chip {{ $isActive ? 'active' : '' }}">
                                {{ $range['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- RATING -->
                <div class="mf-section">
                    <div class="mf-section-label"><i class="fas fa-star"></i> Rating Minimum</div>
                    <div class="mf-rating-row">
                        @foreach([5, 4, 3, 2] as $rl)
                        <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['rating','page']), ['rating' => $rl])) }}"
                           class="mf-rating-chip {{ request('rating') == $rl ? 'active' : '' }}">
                            <span class="stars">{{ str_repeat('★', $rl) }}{{ str_repeat('☆', 5-$rl) }}</span>
                            <span>{{ $rl }}+</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- STOCK -->
                <div class="mf-section">
                    <div class="mf-section-label"><i class="fas fa-box"></i> Ketersediaan</div>
                    <div class="mf-chips">
                        <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['stock_status','page']), ['stock_status' => 'available'])) }}"
                           class="mf-chip {{ request('stock_status') == 'available' ? 'active' : '' }}">
                            ✓ Stok Tersedia
                        </a>
                        <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['stock_status','page']), ['stock_status' => 'low'])) }}"
                           class="mf-chip {{ request('stock_status') == 'low' ? 'active' : '' }}">
                            ⚠ Stok Terbatas
                        </a>
                    </div>
                </div>

            </div><!-- /mf-body -->

            <!-- Footer -->
            <div class="mf-footer">
                <a href="{{ route('shop') }}" class="mf-btn-reset">
                    <i class="fas fa-rotate-left"></i> Reset
                </a>
                <button type="button" class="mf-btn-apply" id="applyMobileFilter">
                    <i class="fas fa-check"></i> Lihat Hasil
                </button>
            </div>

        </div><!-- /mobile-filter-content -->
    </div><!-- /mobileFilterDrawer -->

    <!-- ==========================================
         PREMIUM MOBILE SORT DRAWER
    =========================================== -->
    <div class="mobile-filter-drawer" id="mobileSortDrawer">
        <div class="mobile-filter-backdrop" id="mobileSortBackdrop"></div>
        <div class="mobile-filter-content">

            <!-- Drag Handle -->
            <div class="mf-drag-handle"><span></span></div>

            <!-- Header -->
            <div class="mf-header">
                <div class="mf-header-left">
                    <div class="mf-header-title"><i class="fas fa-arrow-up-wide-short me-2" style="color:#0f5132;"></i>Urutkan</div>
                    <div class="mf-header-subtitle">Pilih urutan tampilan produk</div>
                </div>
                <button type="button" class="mf-close-btn" id="closeMobileSort">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="mf-body" style="padding-bottom: 24px;">
                @php
                    $sortOptions = [
                        '' => ['label' => 'Paling Relevan', 'icon' => 'wand-magic-sparkles', 'desc' => 'Default terbaik'],
                        'newest' => ['label' => 'Terbaru', 'icon' => 'clock-rotate-left', 'desc' => 'Produk baru dulu'],
                        'popular' => ['label' => 'Terpopuler', 'icon' => 'fire', 'desc' => 'Paling banyak dilihat'],
                        'price_asc' => ['label' => 'Harga Terendah', 'icon' => 'arrow-down-1-9', 'desc' => 'Termurah di atas'],
                        'price_desc' => ['label' => 'Harga Tertinggi', 'icon' => 'arrow-up-9-1', 'desc' => 'Termahal di atas'],
                        'rating' => ['label' => 'Rating Tertinggi', 'icon' => 'star', 'desc' => 'Nilai terbaik'],
                        'name_asc' => ['label' => 'Nama A–Z', 'icon' => 'arrow-down-a-z', 'desc' => 'Alfabetis naik'],
                        'name_desc' => ['label' => 'Nama Z–A', 'icon' => 'arrow-up-z-a', 'desc' => 'Alfabetis turun'],
                    ];
                @endphp
                <div class="mf-sort-list">
                    @foreach($sortOptions as $sortValue => $sortData)
                    <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['sort','page']), $sortValue ? ['sort' => $sortValue] : [])) }}"
                       class="mf-sort-item {{ request('sort', '') == $sortValue ? 'active' : '' }}">
                        <div class="mf-sort-icon"><i class="fas fa-{{ $sortData['icon'] }}"></i></div>
                        <div style="flex:1; min-width:0;">
                            <div style="font-weight:600; font-size:0.875rem;">{{ $sortData['label'] }}</div>
                            <div style="font-size:0.72rem; color:#9ca3af; margin-top:1px;">{{ $sortData['desc'] }}</div>
                        </div>
                        <i class="fas fa-check mf-check"></i>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script-alt')
<script>
$(document).ready(function() {
    // Smooth loading animation
    $('.product-card').hide().each(function(index) {
        $(this).delay(100 * index).fadeIn(500);
    });
    
    // Search input enhancements
    let searchTimeout;
    $('input[name="search"]').on('input', function() {
        const $input = $(this);
        const $form = $input.closest('form');
        
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            // Show typing indicator (optional)
            $input.removeClass('is-invalid').addClass('is-valid');
        }, 300);
    });
    
    // Form submission loading state
    $('form').on('submit', function() {
        const $submitBtn = $(this).find('button[type="submit"]');
        const originalHtml = $submitBtn.html();
        
        $submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Mencari...')
                  .prop('disabled', true);
        
        // Re-enable after 5 seconds as fallback
        setTimeout(function() {
            $submitBtn.html(originalHtml).prop('disabled', false);
        }, 5000);
    });
    
    // Category hover effects
    $('.category-item').hover(
        function() {
            $(this).find('i').addClass('fa-chevron-right').removeClass('fa-chevron-right');
        },
        function() {
            $(this).find('i').removeClass('fa-chevron-right').addClass('fa-chevron-right');
        }
    );
    
    // Product card hover effects
    $('.product-card').hover(
        function() {
            $(this).find('.btn-add-cart').removeClass('btn-add-cart').addClass('btn-add-cart-hover');
        },
        function() {
            $(this).find('.btn-add-cart-hover').removeClass('btn-add-cart-hover').addClass('btn-add-cart');
        }
    );
    
    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    // Smooth scroll to products when filtering
    if (window.location.search.includes('search=') || window.location.search.includes('sort=')) {
        $('html, body').animate({
            scrollTop: $('.products-header').offset().top - 100
        }, 800);
    }
});

// Add to cart functionality enhancement
$(document).on('click', '.add-to-card', function(e) {
    e.preventDefault();
    
    const $btn = $(this);
    const originalHtml = $btn.html();
    
    // Visual feedback
    $btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Menambahkan...')
        .prop('disabled', true);
    
    // Simulate adding to cart (replace with actual functionality)
    setTimeout(function() {
        $btn.html('<i class="fas fa-check me-2"></i>Ditambahkan!')
            .removeClass('btn-add-cart')
            .addClass('btn-success');
        
        setTimeout(function() {
            $btn.html(originalHtml)
                .removeClass('btn-success')
                .addClass('btn-add-cart')
                .prop('disabled', false);
        }, 2000);
    }, 1000);
});

// =============================================
// Mobile Filter & Sort Drawer Functionality
// =============================================
$(document).ready(function() {

    function openDrawer($drawer) {
        // Close any other open drawer first
        $('.mobile-filter-drawer.active').not($drawer).removeClass('active');
        $drawer.addClass('active');
        $('body').css('overflow', 'hidden');
    }

    function closeDrawer($drawer) {
        $drawer.removeClass('active');
        // Only restore scroll if no other drawer is open
        if ($('.mobile-filter-drawer.active').length === 0) {
            $('body').css('overflow', '');
        }
    }

    // --- Filter Drawer ---
    $('#openMobileFilter').on('click', function(e) {
        e.preventDefault();
        openDrawer($('#mobileFilterDrawer'));
    });

    $('#closeMobileFilter, #mobileFilterBackdrop').on('click', function() {
        closeDrawer($('#mobileFilterDrawer'));
    });

    $('#applyMobileFilter').on('click', function() {
        closeDrawer($('#mobileFilterDrawer'));
    });

    // --- Sort Drawer ---
    $('#openMobileSort').on('click', function(e) {
        e.preventDefault();
        openDrawer($('#mobileSortDrawer'));
    });

    $('#closeMobileSort, #mobileSortBackdrop').on('click', function() {
        closeDrawer($('#mobileSortDrawer'));
    });

    // --- Close on ESC key ---
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDrawer($('.mobile-filter-drawer.active'));
        }
    });

    // --- Swipe down to close ---
    var touchStartY = 0;
    $(document).on('touchstart', '.mobile-filter-content', function(e) {
        touchStartY = e.originalEvent.touches[0].clientY;
    });
    $(document).on('touchend', '.mobile-filter-content', function(e) {
        var touchEndY = e.originalEvent.changedTouches[0].clientY;
        var diff = touchEndY - touchStartY;
        // Swipe down by > 80px when at top of content → close
        if (diff > 80 && $(this).scrollTop() === 0) {
            closeDrawer($(this).closest('.mobile-filter-drawer'));
        }
    });



    // --- Show More Categories (desktop sidebar) ---
    $('#showMoreCategories').on('click', function() {
        var $btn = $(this);
        var $extraList = $('.category-list-extra');
        var $icon = $btn.find('i');
        if ($extraList.is(':visible')) {
            $extraList.slideUp(300);
            $icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            $btn.find('span').text('Lihat ' + $extraList.find('.category-item-modern').length + ' kategori lainnya');
        } else {
            $extraList.slideDown(300);
            $icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            $btn.find('span').text('Sembunyikan kategori');
        }
    });
});
</script>

<style>
.btn-add-cart-hover {
    background: linear-gradient(90deg, #2ecc71 0%, #28a745 100%) !important;
    color: #ffffff !important;
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(40,167,69,0.18) !important;
    border: none !important;
}

.is-valid {
    border-color: var(--bs-success) !important;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25) !important;
}

.search-input:focus.is-valid {
    border-color: var(--bs-success) !important;
    box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1) !important;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(13, 110, 253, 0); }
    100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0); }
}

.btn-add-cart:focus {
    animation: pulse 1.5s infinite;
}

.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush
