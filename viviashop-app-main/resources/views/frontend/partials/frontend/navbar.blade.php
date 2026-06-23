
<!-- Navbar start -->
@php
    $isHomePage = request()->url() === url('/');
    $cartItemCount = Request::is('register') ? 0 : ($countCart ?? 0);
@endphp
<style>
    body.site-menu-open {
        overflow: hidden;
        overscroll-behavior: none;
    }

    .site-menu-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(5, 30, 20, 0.45);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 1020;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    body.site-menu-open .site-menu-backdrop {
        opacity: 1;
        pointer-events: auto;
    }

    .site-header {
        position: sticky;
        top: 0;
        left: 0;
        right: 0;
        padding: 18px 0 0;
        background: transparent;
        z-index: 1030;
        transition: padding 0.24s ease;
    }

    .site-header--overlay {
        position: fixed;
    }

    .site-header:not(.site-header--overlay) ~ .page-header,
    .site-header:not(.site-header--overlay) ~ .hero-header {
        margin-top: 18px !important;
    }

    .site-nav-shell {
        position: relative;
        overflow: hidden;
        padding: 14px 18px;
        border-radius: 28px;
        border: 1px solid var(--v-glass-border);
        background: var(--v-glass-panel);
        box-shadow: var(--v-glass-shadow);
        backdrop-filter: blur(18px) saturate(145%);
        -webkit-backdrop-filter: blur(18px) saturate(145%);
        transition: background-color 0.24s ease, border-color 0.24s ease, box-shadow 0.24s ease, transform 0.24s ease;
    }

    .site-nav-shell::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.42) 0%, rgba(255, 255, 255, 0.14) 54%, rgba(209, 231, 221, 0.2) 100%);
        pointer-events: none;
    }

    .site-nav-shell > * {
        position: relative;
        z-index: 1;
    }

    .site-header--overlay .site-nav-shell {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.16);
        box-shadow: 0 24px 54px rgba(7, 30, 20, 0.24);
    }

    .site-header.is-scrolled .site-nav-shell {
        transform: translateY(-2px);
        background: var(--v-glass-panel-strong);
        border-color: rgba(15, 81, 50, 0.12);
        box-shadow: 0 26px 56px rgba(15, 81, 50, 0.18);
    }

    .site-header.is-menu-open .site-nav-shell {
        background: rgba(255, 255, 255, 0.94);
        border-color: rgba(15, 81, 50, 0.12);
        box-shadow: 0 28px 60px rgba(15, 81, 50, 0.18);
        overflow: visible;
    }

    .site-header--overlay.is-scrolled .site-nav-shell {
        background: rgba(255, 255, 255, 0.82);
        border-color: rgba(255, 255, 255, 0.3);
        box-shadow: 0 26px 56px rgba(7, 30, 20, 0.18);
    }

    .site-brand {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        min-width: 0;
    }

    .site-brand:hover {
        text-decoration: none;
    }

    .brand-mark {
        position: relative;
        width: 54px;
        height: 54px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(15, 81, 50, 0.98), rgba(32, 201, 151, 0.92));
        color: #fff;
        box-shadow: 0 14px 30px rgba(15, 81, 50, 0.24);
        border: 1px solid rgba(255, 255, 255, 0.18);
        flex: 0 0 auto;
    }

    .brand-mark::after {
        content: '';
        position: absolute;
        inset: 1px;
        border-radius: inherit;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.22), rgba(255, 255, 255, 0));
        pointer-events: none;
    }

    .brand-mark i {
        position: relative;
        z-index: 1;
        font-size: 1.15rem;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .brand-name {
        font-family: 'Raleway', sans-serif;
        font-size: 1.22rem;
        font-weight: 800;
        line-height: 1.05;
        color: #111827;
        letter-spacing: -0.03em;
        transition: color 0.24s ease;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .brand-name .bw-vivia {
        color: inherit;
    }

    .brand-name .bw-shop {
        color: var(--v-secondary);
        font-style: italic;
    }

    .site-header--overlay .brand-name .bw-shop {
        color: var(--v-accent);
    }

    .site-header--overlay.is-scrolled .brand-name .bw-shop,
    .site-header--overlay.is-menu-open .brand-name .bw-shop {
        color: var(--v-secondary);
    }

    .brand-subtitle {
        margin-top: 4px;
        color: #6b7280;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        transition: color 0.24s ease;
    }

    .site-header--overlay .brand-name,
    .site-header--overlay .site-nav-links .nav-link,
    .site-header--overlay .site-action-btn,
    .site-header--overlay .site-toggler {
        color: #ffffff;
    }

    .site-header--overlay .brand-subtitle {
        color: rgba(255, 255, 255, 0.72);
    }

    .site-header--overlay.is-scrolled .brand-name,
    .site-header--overlay.is-scrolled .site-nav-links .nav-link,
    .site-header--overlay.is-scrolled .site-action-btn,
    .site-header--overlay.is-menu-open .brand-name,
    .site-header--overlay.is-menu-open .site-nav-links .nav-link,
    .site-header--overlay.is-menu-open .site-action-btn {
        color: #1f2937;
    }

    .site-header--overlay.is-scrolled .brand-subtitle,
    .site-header--overlay.is-menu-open .brand-subtitle {
        color: #6b7280;
    }

    .site-toolbar {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-left: auto;
    }

    .site-collapse {
        position: relative;
    }

    .site-collapse-content {
        display: flex;
        align-items: center;
        gap: 18px;
        width: 100%;
    }

    .site-nav-links {
        gap: 8px;
        padding: 6px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.16);
        border: 1px solid rgba(255, 255, 255, 0.16);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.18);
    }

    .site-header.is-scrolled .site-nav-links,
    .site-header:not(.site-header--overlay) .site-nav-links,
    .site-header--overlay.is-scrolled .site-nav-links {
        background: rgba(255, 255, 255, 0.5);
        border-color: rgba(15, 81, 50, 0.08);
    }

    .site-nav-links .nav-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 46px;
        padding: 12px 18px;
        border-radius: 999px;
        color: #374151;
        font-weight: 700;
        border: 1px solid transparent;
        transition: all 0.25s ease;
    }

    .site-nav-links .nav-link:hover {
        background: rgba(255, 255, 255, 0.18);
        color: #0f5132;
        border-color: rgba(255, 255, 255, 0.16);
    }

    .site-header--overlay .site-nav-links .nav-link:hover {
        background: rgba(255, 255, 255, 0.14);
        color: #ffffff;
        border-color: rgba(255, 255, 255, 0.16);
    }

    .site-header--overlay.is-scrolled .site-nav-links .nav-link:hover {
        color: #0f5132;
    }

    .site-nav-links .nav-link.active {
        color: #ffffff !important;
        background: linear-gradient(135deg, #0f5132, #198754);
        border-color: transparent;
        box-shadow: 0 14px 24px rgba(15, 81, 50, 0.24);
    }

    .site-actions {
        gap: 10px;
        margin-left: 16px;
    }

    .site-mobile-tools {
        display: none;
        align-items: center;
        gap: 8px;
    }

    .site-action-btn {
        position: relative;
        width: 48px;
        height: 48px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #0f5132;
        background: rgba(255, 255, 255, 0.54);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 24px rgba(15, 81, 50, 0.08);
        transition: all 0.25s ease;
        text-decoration: none;
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
    }

    .site-header--overlay .site-action-btn {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.14);
        box-shadow: none;
    }

    .site-header--overlay.is-scrolled .site-action-btn {
        background: rgba(255, 255, 255, 0.54);
        border-color: rgba(15, 81, 50, 0.08);
        box-shadow: 0 10px 24px rgba(15, 81, 50, 0.08);
    }

    .site-action-btn:hover {
        color: #ffffff;
        background: linear-gradient(135deg, #0f5132, #198754);
        border-color: transparent;
        transform: translateY(-3px);
        box-shadow: 0 16px 28px rgba(15, 81, 50, 0.18);
    }

    .site-cart-badge {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 0;
        transform: translate(36%, -36%);
        box-shadow: 0 6px 14px rgba(15, 81, 50, 0.22);
        border: 2px solid rgba(255, 255, 255, 0.78);
    }

    .site-toggler {
        border: 0;
        width: 48px;
        height: 48px;
        border-radius: 18px;
        background: linear-gradient(135deg, #0f5132, #198754);
        color: #ffffff;
        box-shadow: 0 14px 28px rgba(15, 81, 50, 0.18);
        transition: transform 0.24s ease, box-shadow 0.24s ease;
    }

    .site-toggler:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 30px rgba(15, 81, 50, 0.22);
    }

    .site-toggler:focus {
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
    }

    .site-toggler .fa-bars {
        color: #ffffff !important;
    }

    .site-toggler span {
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: inline-block;
    }

    .site-header.is-menu-open .site-toggler span {
        transform: rotate(90deg);
    }

    .site-header.is-menu-open .site-toggler .fa-bars::before {
        content: "\f00d" !important;
    }

    .site-mobile-panel {
        display: none;
    }

    @keyframes siteMenuPanelIn {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes siteMenuItemIn {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 1199.98px) {
        :root {
            --site-header-offset: 100px;
        }

        .site-toolbar {
            gap: 8px;
        }

        .site-mobile-tools {
            display: flex;
        }

        .site-collapse {
            margin-top: 16px;
            padding: 20px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(15, 81, 50, 0.08);
            box-shadow: 0 30px 60px rgba(15, 81, 50, 0.16), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            max-height: calc(100vh - var(--site-header-offset, 100px) - 24px);
            overflow-y: auto;
            overscroll-behavior: contain;
        }

        .site-collapse-content {
            flex-direction: column;
            align-items: stretch;
            gap: 16px;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .site-collapse.show .site-collapse-content,
        .site-collapse.collapsing .site-collapse-content {
            opacity: 1;
            transform: translateY(0);
        }

        .site-collapse.show {
            animation: siteMenuPanelIn 0.32s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .site-menu-mobile-header {
            font-size: 0.78rem;
            font-weight: 800;
            color: #8c9b94;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            margin-bottom: 6px;
            padding-left: 4px;
        }

        .site-nav-links {
            width: 100%;
            margin-bottom: 8px;
            padding: 0;
            background: transparent;
            border: 0;
            box-shadow: none;
        }

        .site-nav-links a {
            opacity: 0; /* Animated entry */
        }

        .site-nav-links .nav-link,
        .site-header--overlay .site-nav-links .nav-link,
        .site-header--overlay.is-scrolled .site-nav-links .nav-link {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            color: #2d3748;
            min-height: 52px;
            font-size: 0.96rem;
            font-weight: 700;
            border-radius: 16px;
            padding: 12px 16px;
            margin-bottom: 8px;
            background: rgba(15, 81, 50, 0.03);
            border: 1px solid rgba(15, 81, 50, 0.05);
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .site-nav-links .nav-link:hover,
        .site-header--overlay .site-nav-links .nav-link:hover,
        .site-header--overlay.is-scrolled .site-nav-links .nav-link:hover {
            background: rgba(209, 231, 221, 0.45);
            color: #0f5132;
            border-color: rgba(15, 81, 50, 0.12);
            transform: translateX(4px);
        }

        .site-nav-links .nav-link.active,
        .site-header--overlay .site-nav-links .nav-link.active,
        .site-header--overlay.is-scrolled .site-nav-links .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0f5132, #198754);
            border-color: transparent;
            box-shadow: 0 12px 24px rgba(15, 81, 50, 0.2);
            transform: none;
        }

        .nav-link-icon-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: rgba(15, 81, 50, 0.08);
            color: #0f5132;
            margin-right: 12px;
            transition: all 0.22s ease;
        }

        .nav-link.active .nav-link-icon-wrapper {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .nav-link-chevron {
            font-size: 0.8rem;
            opacity: 0.45;
            transition: all 0.22s ease;
        }

        .nav-link:hover .nav-link-chevron {
            opacity: 0.8;
            transform: translateX(2px);
        }

        .nav-link.active .nav-link-chevron {
            color: #ffffff;
            opacity: 0.9;
        }

        .site-actions {
            margin-left: 0;
            width: 100%;
            justify-content: flex-start;
        }

        .site-mobile-panel {
            display: block;
            width: 100%;
            margin-top: 4px;
            padding-top: 14px;
            border-top: 1px solid rgba(15, 81, 50, 0.08);
            opacity: 0;
        }

        .site-collapse.show .site-nav-links a:nth-child(1) { animation: siteMenuItemIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) 0.04s both; }
        .site-collapse.show .site-nav-links a:nth-child(2) { animation: siteMenuItemIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) 0.08s both; }
        .site-collapse.show .site-nav-links a:nth-child(3) { animation: siteMenuItemIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) 0.12s both; }
        .site-collapse.show .site-nav-links a:nth-child(4) { animation: siteMenuItemIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) 0.16s both; }
        .site-collapse.show .site-nav-links a:nth-child(5) { animation: siteMenuItemIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) 0.20s both; }
        .site-collapse.show .site-nav-links a:nth-child(6) { animation: siteMenuItemIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) 0.24s both; }
        .site-collapse.show .site-mobile-panel { animation: siteMenuItemIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) 0.28s both; }

        .site-mobile-action-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .site-mobile-action-card {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            min-height: 64px;
            padding: 14px 16px;
            border: 1px solid rgba(15, 81, 50, 0.08);
            border-radius: 20px;
            background: rgba(248, 250, 251, 0.92);
            color: #1f2937;
            text-decoration: none;
            box-shadow: 0 14px 28px rgba(15, 81, 50, 0.08);
            transition: transform 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease, background-color 0.24s ease;
        }

        .site-mobile-action-card:hover {
            color: #0f5132;
            transform: translateY(-2px);
            border-color: rgba(15, 81, 50, 0.14);
            background: rgba(236, 253, 245, 0.96);
            box-shadow: 0 18px 32px rgba(15, 81, 50, 0.12);
        }

        .site-mobile-action-card--wide {
            grid-column: 1 / -1;
        }

        .site-mobile-action-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(15, 81, 50, 0.16), rgba(32, 201, 151, 0.18));
            color: #0f5132;
            flex: 0 0 auto;
        }

        .site-mobile-action-copy {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .site-mobile-action-label {
            font-weight: 800;
            line-height: 1.1;
        }

        .site-mobile-action-text {
            margin-top: 3px;
            font-size: 0.76rem;
            color: #6b7280;
            line-height: 1.35;
        }

        .site-mobile-action-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            min-width: 22px;
            height: 22px;
            padding: 0 6px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 18px rgba(15, 81, 50, 0.16);
        }

        .site-header--overlay .site-collapse {
            background: rgba(255, 255, 255, 0.94);
        }

        .site-header:not(.site-header--overlay) ~ .page-header,
        .site-header:not(.site-header--overlay) ~ .hero-header {
            margin-top: 14px !important;
        }
    }

    @media (max-width: 767.98px) {
        :root {
            --site-header-offset: 92px;
        }

        .site-header {
            padding-top: 14px;
        }

        .site-nav-shell {
            padding: 12px;
            border-radius: 24px;
        }

        .site-brand {
            flex: 1 1 auto;
            max-width: calc(100% - 108px);
            padding-right: 8px;
        }

        .site-actions {
            gap: 8px;
        }

        .site-action-btn,
        .site-toggler {
            width: 46px;
            height: 46px;
            border-radius: 16px;
        }

        .brand-mark {
            width: 46px;
            height: 46px;
            border-radius: 16px;
        }

        .brand-name {
            font-size: 1.02rem;
        }

        .brand-subtitle {
            font-size: 0.68rem;
            letter-spacing: 0.14em;
        }

        .site-mobile-action-grid {
            grid-template-columns: 1fr;
        }

        .site-mobile-action-card--wide {
            grid-column: auto;
        }
    }

    @media (max-width: 479.98px) {
        :root {
            --site-header-offset: 84px;
        }

        .site-header {
            padding-top: 12px;
        }

        .site-brand {
            max-width: calc(100% - 102px);
        }

        .brand-subtitle {
            display: none;
        }

        .brand-name {
            font-size: 0.96rem;
        }

        .site-collapse {
            margin-top: 12px;
            padding: 14px;
            max-height: calc(100vh - 92px);
        }

        .site-mobile-action-card {
            padding: 13px 14px;
            min-height: 60px;
        }

        .site-mobile-action-icon {
            width: 40px;
            height: 40px;
        }

        .site-header:not(.site-header--overlay) ~ .page-header,
        .site-header:not(.site-header--overlay) ~ .hero-header {
            margin-top: 12px !important;
        }
    }
</style>
<div class="container-fluid site-header {{ $isHomePage ? 'site-header--overlay' : '' }}" data-site-header>
    <div class="container px-3 px-lg-0">
        <nav class="navbar navbar-expand-xl site-nav-shell">
            <a href="{{ url('/') }}" class="site-brand">
                <span class="brand-mark">
                    <i class="fas fa-print"></i>
                </span>
                <span class="brand-text">
                    <span class="brand-name"><span class="bw-vivia">Vivia</span><span class="bw-shop">Shop</span></span>
                    <span class="brand-subtitle">Percetakan & ATK</span>
                </span>
            </a>
            <div class="site-toolbar">
                <div class="site-mobile-tools d-xl-none">
                    <a href="{{ route('carts.index') }}" class="site-action-btn" aria-label="Keranjang">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="badge bg-success text-white site-cart-badge">{{ $cartItemCount }}</span>
                    </a>
                </div>
                <button class="navbar-toggler site-toggler" type="button" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Buka menu navigasi">
                    <span class="fa fa-bars"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse site-collapse" id="navbarCollapse">
                <div class="site-collapse-content">
                    <div class="site-menu-mobile-header d-xl-none">Menu Utama</div>
                    <div class="navbar-nav mx-auto site-nav-links">
                        <a href="{{ url('/') }}" class="nav-item {{ $isHomePage ? 'active' : '' }} nav-link" {{ $isHomePage ? 'aria-current="page"' : '' }}>
                            <span class="nav-link-icon-wrapper d-xl-none"><i class="fas fa-home"></i></span>
                            <span>Home</span>
                            <i class="fas fa-chevron-right ms-auto d-xl-none nav-link-chevron"></i>
                        </a>
                        <a href="{{ route('shop') }}" class="nav-item {{ Request::is('shop*') && !Request::is('shopCetak*') ? 'active' : '' }} nav-link" {{ Request::is('shop*') && !Request::is('shopCetak*') ? 'aria-current="page"' : '' }}>
                            <span class="nav-link-icon-wrapper d-xl-none"><i class="fas fa-th-large"></i></span>
                            <span>Products</span>
                            <i class="fas fa-chevron-right ms-auto d-xl-none nav-link-chevron"></i>
                        </a>
                        <a href="{{ route('shopCetak') }}" class="nav-item {{ Request::is('shopCetak*') ? 'active' : '' }} nav-link" {{ Request::is('shopCetak*') ? 'aria-current="page"' : '' }}>
                            <span class="nav-link-icon-wrapper d-xl-none"><i class="fas fa-print"></i></span>
                            <span>Layanan Cetak</span>
                            <i class="fas fa-chevron-right ms-auto d-xl-none nav-link-chevron"></i>
                        </a>
                        @auth
                            <a href="{{ url('carts') }}" class="nav-item {{ Request::is('carts*') ? 'active' : '' }} nav-link" {{ Request::is('carts*') ? 'aria-current="page"' : '' }}>
                                <span class="nav-link-icon-wrapper d-xl-none"><i class="fas fa-shopping-cart"></i></span>
                                <span>Carts</span>
                                <i class="fas fa-chevron-right ms-auto d-xl-none nav-link-chevron"></i>
                            </a>
                            <a href="{{ url('orders') }}" class="nav-item {{ Request::is('orders*') ? 'active' : '' }} nav-link" {{ Request::is('orders*') ? 'aria-current="page"' : '' }}>
                                <span class="nav-link-icon-wrapper d-xl-none"><i class="fas fa-file-invoice-dollar"></i></span>
                                <span>Orders</span>
                                <i class="fas fa-chevron-right ms-auto d-xl-none nav-link-chevron"></i>
                            </a>
                            <a href="{{ route('frontend.print-service') }}" class="nav-item {{ Request::is('smart-print*') ? 'active' : '' }} nav-link" {{ Request::is('smart-print*') ? 'aria-current="page"' : '' }}>
                                <span class="nav-link-icon-wrapper d-xl-none"><i class="fas fa-magic"></i></span>
                                <span>Smart Print</span>
                                <i class="fas fa-chevron-right ms-auto d-xl-none nav-link-chevron"></i>
                            </a>
                        @endauth
                    </div>
                    <div class="site-mobile-panel d-xl-none">
                        <div class="site-mobile-action-grid">
                            <button type="button" class="site-mobile-action-card site-mobile-action-card--wide" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Cari produk">
                                <span class="site-mobile-action-icon">
                                    <i class="fas fa-search"></i>
                                </span>
                                <span class="site-mobile-action-copy">
                                    <span class="site-mobile-action-label">Cari Produk</span>
                                    <span class="site-mobile-action-text">Buka pencarian cepat dari menu utama</span>
                                </span>
                            </button>
                            <a href="{{ route('carts.index') }}" class="site-mobile-action-card" aria-label="Lihat keranjang">
                                <span class="site-mobile-action-icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </span>
                                <span class="site-mobile-action-copy">
                                    <span class="site-mobile-action-label">Keranjang</span>
                                    <span class="site-mobile-action-text">Lihat item yang siap checkout</span>
                                </span>
                                <span class="badge bg-success text-white site-mobile-action-badge">{{ $cartItemCount }}</span>
                            </a>
                            <a href="{{ route('profile') }}" class="site-mobile-action-card" aria-label="Buka akun">
                                <span class="site-mobile-action-icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span class="site-mobile-action-copy">
                                    <span class="site-mobile-action-label">Akun</span>
                                    <span class="site-mobile-action-text">Masuk atau kelola profil Anda</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-xl-flex align-items-center site-actions">
                        <button type="button" class="site-action-btn d-none d-lg-inline-flex" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Cari produk">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('carts.index') }}" class="site-action-btn" aria-label="Keranjang">
                            <i class="fas fa-shopping-bag"></i>
                            <span class="badge bg-success text-white site-cart-badge">{{ $cartItemCount }}</span>
                        </a>
                        <a href="{{ route('profile') }}" class="site-action-btn" aria-label="Akun">
                            <i class="fas fa-user"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->
<div class="site-menu-backdrop"></div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var siteHeader = document.querySelector('[data-site-header]');
        var collapseElement = document.getElementById('navbarCollapse');
        var rootStyle = document.documentElement;

        if (!siteHeader) {
            return;
        }

        var syncStickyOffsets = function () {
            var headerRect = siteHeader.getBoundingClientRect();
            var minTop = window.innerWidth >= 1200 ? 118 : (window.innerWidth >= 992 ? 108 : (window.innerWidth >= 768 ? 96 : 88));
            var safeGap = window.innerWidth >= 1200 ? 16 : 12;
            var stickyTop = Math.max(minTop, Math.round(headerRect.bottom + safeGap));

            rootStyle.style.setProperty('--site-header-offset', stickyTop + 'px');
            rootStyle.style.setProperty('--sticky-safe-top', stickyTop + 'px');
        };

        var syncMenuState = function (isOpen) {
            siteHeader.classList.toggle('is-menu-open', !!isOpen);
            document.body.classList.toggle('site-menu-open', !!isOpen && window.innerWidth < 1200);
            syncStickyOffsets();
        };

        var syncHeaderState = function () {
            siteHeader.classList.toggle('is-scrolled', window.scrollY > 16);
            syncStickyOffsets();
        };

        if (collapseElement) {
            syncMenuState(collapseElement.classList.contains('show'));

            // Handlers for BS collapse event triggers if triggered programmatically
            collapseElement.addEventListener('show.bs.collapse', function () {
                syncMenuState(true);
            });

            collapseElement.addEventListener('hide.bs.collapse', function () {
                syncMenuState(false);
            });

            // Robust manual click toggler
            var toggler = document.querySelector('.site-toggler');
            if (toggler) {
                toggler.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var isOpen = collapseElement.classList.contains('show');
                    if (isOpen) {
                        collapseElement.classList.remove('show');
                        toggler.setAttribute('aria-expanded', 'false');
                        toggler.classList.add('collapsed');
                        syncMenuState(false);
                    } else {
                        collapseElement.classList.add('show');
                        toggler.setAttribute('aria-expanded', 'true');
                        toggler.classList.remove('collapsed');
                        syncMenuState(true);
                    }
                });
            }

            // Close menu when clicking on links inside
            collapseElement.querySelectorAll('.nav-link, .site-mobile-action-card').forEach(function (element) {
                element.addEventListener('click', function () {
                    if (window.innerWidth >= 1200 || !collapseElement.classList.contains('show')) {
                        return;
                    }
                    collapseElement.classList.remove('show');
                    if (toggler) {
                        toggler.setAttribute('aria-expanded', 'false');
                        toggler.classList.add('collapsed');
                    }
                    syncMenuState(false);
                });
            });

            // Close menu when clicking outside of the header area
            document.addEventListener('click', function (e) {
                if (window.innerWidth < 1200 && collapseElement.classList.contains('show')) {
                    if (!siteHeader.contains(e.target)) {
                        collapseElement.classList.remove('show');
                        if (toggler) {
                            toggler.setAttribute('aria-expanded', 'false');
                            toggler.classList.add('collapsed');
                        }
                        syncMenuState(false);
                    }
                }
            });
        }

        syncStickyOffsets();
        syncHeaderState();
        window.addEventListener('scroll', syncHeaderState, { passive: true });
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1200) {
                syncMenuState(false);
            }
            syncHeaderState();
        }, { passive: true });
    });
</script>
