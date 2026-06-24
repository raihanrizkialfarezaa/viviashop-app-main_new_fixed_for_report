@extends('frontend.layouts')
@section('content')
<style>
/* =========================================================
   VIVIA DETAIL PAGE – Premium Mobile-First v3
   Shopee/Tokopedia-inspired native app feel
   All JS selectors preserved intact.
   ========================================================= */
@import url('https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap');

:root {
    --c-primary:   #0d4f30;
    --c-mid:       #1a7a4a;
    --c-accent:    #23c57c;
    --c-soft:      #e8f5ee;
    --c-border:    rgba(13,79,48,.08);
    --c-text:      #1a2e23;
    --c-muted:     #6b8a76;
    --c-surface:   #ffffff;
    --c-bg:        #f4f8f5;
    --r-xl:        22px;
    --r-lg:        16px;
    --r-md:        12px;
    --r-sm:        8px;
    --ease:        cubic-bezier(.4,0,.2,1);
    --t:           .22s var(--ease);
    --shadow-sm:   0 1px 4px rgba(0,0,0,.04), 0 4px 12px rgba(13,79,48,.04);
    --shadow-md:   0 4px 16px rgba(0,0,0,.06), 0 12px 32px rgba(13,79,48,.06);
    --shadow-lg:   0 8px 32px rgba(0,0,0,.08), 0 24px 64px rgba(13,79,48,.08);
    --font:        'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

*, *::before, *::after { box-sizing: border-box; }

body, input, button, select, textarea {
    font-family: var(--font) !important;
    -webkit-font-smoothing: antialiased;
}

.sku-text, .text-truncate-custom {
    word-break: break-all !important;
    white-space: normal !important;
}

/* ── PAGE BG ─────────────────────────────────────────────── */
.dp-page { background: var(--c-bg); min-height: 100vh; }

/* ── BREADCRUMB ──────────────────────────────────────────── */
.dp-breadcrumb {
    padding: .6rem 0 .3rem;
    background: transparent;
}
.dp-breadcrumb .breadcrumb {
    margin: 0; padding: 0;
    display: flex; flex-wrap: wrap; gap: .25rem;
}
.dp-breadcrumb .breadcrumb-item,
.dp-breadcrumb .breadcrumb-item a {
    color: var(--c-muted) !important;
    text-decoration: none;
    font-size: .78rem; font-weight: 500;
    transition: color var(--t);
}
.dp-breadcrumb .breadcrumb-item a:hover { color: var(--c-primary) !important; }
.dp-breadcrumb .breadcrumb-item.active {
    color: var(--c-primary) !important; font-weight: 600;
}
.dp-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(13,79,48,.2); content: "/"; padding-right: .25rem;
}

/* ── LAYOUT ──────────────────────────────────────────────── */
.dp-stage { padding: .5rem 0 3rem; }
.dp-grid { display: grid; grid-template-columns: 1fr 340px; gap: 1.25rem; align-items: start; }
.dp-main { display: flex; flex-direction: column; gap: .875rem; }

/* ── SURFACE CARD ────────────────────────────────────────── */
.dp-card {
    background: var(--c-surface);
    border-radius: var(--r-xl);
    border: 1px solid var(--c-border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    transition: box-shadow var(--t), border-color var(--t);
}
.dp-card:hover {
    box-shadow: var(--shadow-md);
    border-color: rgba(13,79,48,.13);
}

/* ═══════════════════════════════════════════════════════════
   GALLERY
   ═══════════════════════════════════════════════════════════ */
.dp-gallery { position: relative; }

.dp-gallery-frame {
    position: relative;
    background: linear-gradient(160deg, #f0f8f4 0%, #ffffff 60%, #f7fbf8 100%);
    min-height: 480px;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.dp-gallery-frame img {
    width: 100%; height: auto;
    max-height: 480px; object-fit: contain;
    display: block;
    transition: transform .6s var(--ease);
}
.dp-gallery-frame:hover img { transform: scale(1.03); }
.dp-gallery-frame .carousel-item {
    display: flex; align-items: center; justify-content: center;
}

/* Carousel dots */
.dp-gallery-frame .carousel-indicators {
    margin-bottom: 1rem; gap: 5px;
}
.dp-gallery-frame .carousel-indicators [data-bs-target] {
    width: 6px; height: 6px; border-radius: 50%; border: none;
    background: rgba(13,79,48,.18); opacity: 1;
    transition: all .25s var(--ease); margin: 0 3px;
}
.dp-gallery-frame .carousel-indicators .active {
    background: var(--c-primary); width: 22px; border-radius: 3px;
}

/* Carousel controls */
.dp-gallery-ctrl {
    width: 34px; height: 34px; border-radius: 50%;
    background: rgba(255,255,255,.92) !important;
    box-shadow: 0 2px 10px rgba(0,0,0,.1);
    display: inline-flex; align-items: center; justify-content: center;
    color: var(--c-primary); border: 1px solid var(--c-border);
    opacity: .9; transition: all .2s var(--ease);
}
.dp-gallery-ctrl:hover { opacity: 1; background: #fff !important; transform: scale(1.08); }

/* Badge overlay on image */
.dp-gallery-badges {
    position: absolute; top: 12px; left: 12px; right: 12px;
    display: flex; justify-content: space-between; align-items: flex-start;
    z-index: 10; gap: 6px; pointer-events: none;
}
.dp-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 11px; border-radius: var(--r-sm);
    font-size: .68rem; font-weight: 700;
    backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,.5);
    box-shadow: 0 2px 10px rgba(0,0,0,.07);
    pointer-events: auto;
}
.dp-badge-cat  { background: rgba(255,255,255,.88); color: var(--c-primary); }
.dp-badge-ok   { background: rgba(26,122,74,.12); color: var(--c-mid); border-color: rgba(26,122,74,.2); }
.dp-badge-warn { background: rgba(217,119,6,.1); color: #b45309; border-color: rgba(217,119,6,.15); }
.dp-badge-out  { background: rgba(107,114,128,.1); color: #6b7280; border-color: rgba(107,114,128,.15); }

/* Thumb strip */
.dp-thumbs {
    display: flex; gap: 8px; flex-wrap: wrap;
    padding: 14px 16px;
    border-top: 1px solid var(--c-border);
    background: var(--c-surface);
}
.dp-thumb {
    width: 58px; height: 58px; border-radius: 10px;
    object-fit: cover; border: 2px solid transparent;
    cursor: pointer; padding: 2px;
    background: var(--c-bg);
    opacity: .55; transition: all var(--t);
}
.dp-thumb:hover { opacity: .85; border-color: rgba(26,122,74,.3); }
.dp-thumb.active {
    opacity: 1; border-color: var(--c-primary);
    box-shadow: 0 3px 10px rgba(13,79,48,.18);
    transform: scale(1.06);
}

/* ═══════════════════════════════════════════════════════════
   PRODUCT INFO CARD
   ═══════════════════════════════════════════════════════════ */
.dp-info { padding: 22px 22px 18px; }

.dp-kicker {
    font-size: .65rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .12em;
    color: var(--c-accent); margin-bottom: 7px; display: block;
}

.dp-title {
    font-size: 1.5rem; font-weight: 800;
    color: var(--c-text); line-height: 1.2;
    margin: 0 0 12px; letter-spacing: -.025em;
    word-wrap: break-word; word-break: break-word;
}

/* Rating row */
.dp-rating {
    display: flex; align-items: center; gap: 6px;
    margin-bottom: 13px; flex-wrap: wrap;
}
.dp-stars { display: flex; gap: 2px; }
.dp-stars i { font-size: .72rem; color: #f59e0b; }
.dp-rating-num { font-size: .75rem; font-weight: 700; color: var(--c-text); }
.dp-sep { color: #d1d5db; }
.dp-rating-sub { font-size: .72rem; color: var(--c-muted); }

/* Meta chips */
.dp-chips { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px; }
.dp-chip {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 10px; border-radius: 99px;
    font-size: .72rem; font-weight: 600;
    border: 1px solid var(--c-border);
    background: var(--c-soft);
    color: var(--c-text);
    transition: all var(--t);
}
.dp-chip:hover { border-color: rgba(13,79,48,.2); transform: translateY(-1px); }
.dp-chip i { font-size: .66rem; color: var(--c-mid); }
.dp-chip-stock-ok  { background: rgba(26,122,74,.08); color: var(--c-primary); border-color: rgba(26,122,74,.18); }
.dp-chip-stock-out { background: rgba(239,68,68,.07); color: #ef4444; border-color: rgba(239,68,68,.15); }

/* ── PRICE HERO ──────────────────────────────────────────── */
.dp-price-hero {
    position: relative; overflow: hidden;
    background: linear-gradient(135deg, #0d4f30 0%, #1a7a4a 50%, #23a85e 100%);
    border-radius: var(--r-lg);
    padding: 18px 20px;
    margin-bottom: 14px;
    box-shadow: 0 6px 24px rgba(13,79,48,.25), 0 2px 6px rgba(13,79,48,.15);
}
.dp-price-hero::before {
    content: '';
    position: absolute; top: -40px; right: -30px;
    width: 130px; height: 130px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
    pointer-events: none;
}
.dp-price-hero::after {
    content: '';
    position: absolute; bottom: -50px; right: 30px;
    width: 100px; height: 100px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
    pointer-events: none;
}
.dp-price-label {
    font-size: .62rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .1em; color: rgba(255,255,255,.65);
    margin-bottom: 5px; display: flex; align-items: center; gap: 5px;
}
.dp-price-amount {
    font-size: 2rem; font-weight: 900; color: #fff;
    letter-spacing: -.035em; line-height: 1;
    position: relative; z-index: 1;
}
.dp-price-original {
    font-size: .8rem; color: rgba(255,255,255,.5);
    text-decoration: line-through; margin-top: 4px;
}
.dp-price-off {
    display: inline-block;
    background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.25);
    border-radius: 6px; padding: 2px 7px;
    font-size: .63rem; font-weight: 700; color: #fff; margin-left: 8px;
}

/* ── INFO SECTIONS ──────────────────────────────────────── */
.dp-section {
    border-radius: var(--r-lg);
    border: 1px solid var(--c-border);
    background: #fff;
    overflow: hidden;
    margin-bottom: 10px;
    transition: border-color var(--t), box-shadow var(--t);
}
.dp-section:hover { border-color: rgba(13,79,48,.15); box-shadow: 0 3px 14px rgba(13,79,48,.04); }
.dp-section:last-child { margin-bottom: 0; }

.dp-section-head {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 15px; cursor: default;
    border-bottom: 1px solid var(--c-border);
}
.dp-section-icon {
    width: 30px; height: 30px; border-radius: 9px;
    display: inline-flex; align-items: center; justify-content: center;
    background: rgba(13,79,48,.07); color: var(--c-primary);
    font-size: .8rem; flex-shrink: 0;
}
.dp-section-title { font-size: .82rem; font-weight: 700; color: var(--c-text); margin: 0; }
.dp-section-body { padding: 12px 15px; }
.dp-section-text { font-size: .83rem; color: var(--c-muted); line-height: 1.65; }

/* Spec list */
.dp-spec-row {
    display: flex; justify-content: space-between; align-items: flex-start;
    gap: 10px; padding: 7px 0;
    border-bottom: 1px dashed rgba(13,79,48,.07);
    font-size: .8rem;
}
.dp-spec-row:last-child { border-bottom: none; padding-bottom: 0; }
.dp-spec-k { color: var(--c-muted); flex-shrink: 0; }
.dp-spec-v { font-weight: 700; color: var(--c-text); text-align: right; word-break: break-all; }

/* Courier / payment tags */
.dp-tag-group { margin-bottom: 14px; }
.dp-tag-group:last-child { margin-bottom: 0; }
.dp-tag-group-label {
    font-size: .68rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .06em; color: var(--c-muted);
    margin-bottom: 8px; display: flex; align-items: center; gap: 6px;
}
.dp-tag-group-label i { color: var(--c-mid); }
.dp-tags { display: flex; flex-wrap: wrap; gap: 8px; }
.dp-tag {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 12px; border-radius: 20px;
    background: rgba(13, 79, 48, 0.03); border: 1px solid rgba(13, 79, 48, 0.08);
    color: var(--c-text); font-size: .73rem; font-weight: 600;
    transition: all var(--t);
    box-shadow: 0 1px 3px rgba(13, 79, 48, 0.02);
}
.dp-tag:hover {
    background: var(--c-soft);
    border-color: rgba(26, 122, 74, 0.35);
    color: var(--c-primary);
    transform: translateY(-1.5px);
    box-shadow: 0 4px 10px rgba(13, 79, 48, 0.06);
}
.dp-tag-icon {
    width: 14px; height: 14px;
    flex-shrink: 0;
    display: inline-block;
    color: var(--c-mid);
    transition: color var(--t), transform 0.2s var(--ease);
}
.dp-tag:hover .dp-tag-icon {
    color: var(--c-primary);
    transform: scale(1.1);
}

/* ── VARIANT PANEL ──────────────────────────────────────── */
.dp-variant-panel {
    border-radius: var(--r-lg); border: 1px solid var(--c-border);
    background: #fff; margin-top: 10px; overflow: hidden;
}
.dp-variant-head {
    display: flex; align-items: center; gap: 10px;
    padding: 13px 15px; border-bottom: 1px solid var(--c-border);
    background: rgba(13,79,48,.02);
}
.dp-variant-head i { color: var(--c-primary); font-size: .95rem; }
.dp-variant-head h6 { margin: 0; color: var(--c-text); font-weight: 700; font-size: .88rem; }
.dp-variant-body { padding: 14px 15px; }
.dp-variant-group { margin-bottom: 14px; }
.dp-variant-group:last-of-type { margin-bottom: 0; }
.dp-variant-label { font-size: .75rem; font-weight: 700; color: var(--c-text); margin-bottom: 8px; display: block; }

/* Variant buttons */
.variant-option {
    min-width: 70px; padding: 7px 13px;
    border-radius: 10px; font-weight: 600; font-size: .8rem;
    border: 1.5px solid rgba(13,79,48,.12) !important;
    background: #fff !important; color: var(--c-text);
    transition: all var(--t);
}
.variant-option:hover:not(:disabled) {
    transform: translateY(-2px);
    border-color: var(--c-mid) !important; color: var(--c-mid);
    box-shadow: 0 4px 10px rgba(13,79,48,.08);
}
.variant-option:disabled {
    opacity: .3; cursor: not-allowed;
    background: #f1f5f9 !important; border-color: #e2e8f0 !important; color: #94a3b8;
}
.variant-option.btn-primary, .variant-option.btn-primary:hover {
    background: var(--c-primary) !important; color: #fff !important;
    border-color: var(--c-primary) !important;
    box-shadow: 0 4px 12px rgba(13,79,48,.22) !important; transform: translateY(-1px);
}
.variant-option.btn-outline-danger {
    background: #fff1f2 !important; color: #e11d48 !important;
    border-color: #fecdd3 !important; position: relative; overflow: hidden;
}
.variant-option.btn-outline-danger::after {
    content: ''; position: absolute; top: 50%; left: 10%; right: 10%;
    height: 1px; background: #e11d48; transform: rotate(-15deg); opacity: .4;
}

/* Price range in variant panel */
.dp-price-range {
    margin: 12px 0;
    padding: 12px 14px; border-radius: var(--r-md);
    background: rgba(13,79,48,.05); border: 1px solid rgba(13,79,48,.08);
}
.dp-price-range-label {
    font-size: .62rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .06em; color: var(--c-muted); margin-bottom: 3px;
    display: flex; align-items: center; gap: 5px;
}
.dp-price-range-val { margin: 0; font-weight: 800; color: var(--c-primary); font-size: 1.2rem; }

/* Variant info card */
#variant-info { margin-top: 10px; }
.variant-selected-card {
    background: #fff !important; border: 1.5px solid var(--c-mid) !important;
    color: var(--c-text) !important; border-radius: var(--r-md) !important;
    padding: 13px !important; box-shadow: 0 4px 14px rgba(13,79,48,.07);
}
.variant-selected-card h6 { color: var(--c-primary) !important; font-weight: 700; font-size: .82rem; }
#selection-message {
    border: 1.5px dashed rgba(13,79,48,.2) !important;
    border-radius: var(--r-md) !important;
    background: rgba(13,79,48,.04) !important;
    color: var(--c-primary) !important;
    font-size: .8rem; font-weight: 600;
    padding: 10px 13px !important;
    display: flex; align-items: center; gap: 8px;
    transition: all var(--t);
}
.pulse-highlight { animation: pulse-border 1.5s ease-in-out infinite; }
@keyframes pulse-border {
    0%   { border-color: rgba(13,79,48,.2); box-shadow: 0 0 0 0 rgba(13,79,48,.2); }
    50%  { border-color: var(--c-mid); box-shadow: 0 0 0 5px rgba(13,79,48,.08); }
    100% { border-color: rgba(13,79,48,.2); box-shadow: 0 0 0 0 rgba(13,79,48,.2); }
}

/* ── MOBILE CHECKOUT SECTION ─────────────────────────────── */
.dp-checkout-mobile {
    background: #fff; border: 1px solid var(--c-border);
    border-radius: var(--r-xl); padding: 16px;
    margin-top: 12px; box-shadow: var(--shadow-sm);
}
.dp-checkout-row {
    display: flex; align-items: center;
    justify-content: space-between; gap: 10px; margin-bottom: 12px;
}
.dp-qty-label { font-size: .78rem; font-weight: 700; color: var(--c-text); }

/* Quantity */
.dp-qty-wrap {
    background: var(--c-soft); border: 1px solid var(--c-border);
    border-radius: var(--r-md); padding: 3px;
    display: inline-flex; align-items: center;
}
.qty-counter { display: flex; align-items: center; }
.qty-btn {
    width: 36px; height: 36px; border-radius: 9px;
    border: 1px solid var(--c-border); background: #fff; color: var(--c-primary);
    display: inline-flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all var(--t);
    box-shadow: 0 1px 3px rgba(0,0,0,.04); padding: 0; line-height: 1;
    font-size: .85rem;
}
.qty-btn:hover { background: var(--c-primary); color: #fff; border-color: var(--c-primary); box-shadow: 0 3px 8px rgba(13,79,48,.18); }
.qty-btn:active { transform: scale(.93); }
.qty-counter .form-control {
    border: none; background: transparent;
    font-weight: 800; color: var(--c-text);
    text-align: center; font-size: .95rem;
    width: 46px; padding: 0; box-shadow: none !important;
}
.qty-counter input::-webkit-outer-spin-button,
.qty-counter input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
.qty-counter input[type=number] { -moz-appearance: textfield; }

/* CTA button */
.btn-dp-primary {
    background: linear-gradient(135deg, #0d4f30 0%, #1a7a4a 100%) !important;
    border: none !important; color: #fff !important;
    font-weight: 700; font-size: .9rem; line-height: 1;
    padding: 14px 20px; border-radius: 13px;
    box-shadow: 0 5px 18px rgba(13,79,48,.28), 0 2px 4px rgba(13,79,48,.15);
    transition: all var(--t); width: 100%;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    position: relative; overflow: hidden;
}
.btn-dp-primary::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,.1) 0%, transparent 60%);
    pointer-events: none;
}
.btn-dp-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(13,79,48,.35), 0 3px 6px rgba(13,79,48,.18);
    color: #fff !important;
}
.btn-dp-primary:active:not(:disabled) { transform: translateY(0); }
.btn-dp-primary:disabled, .btn-dp-primary.btn-secondary {
    background: linear-gradient(135deg, #94a3b8 0%, #cbd5e1 100%) !important;
    color: #64748b !important; box-shadow: none !important;
    cursor: not-allowed; transform: none !important;
}
.add-to-cart-btn { min-height: auto; }
.qty-down-btn.btn-danger-custom {
    background: #e11d48 !important;
}

/* ── TABS ────────────────────────────────────────────────── */
.dp-tabs-shell { padding: 0; }
.dp-tabs-nav {
    display: flex; gap: 0; border-bottom: 2px solid var(--c-border);
    padding: 0 16px; overflow-x: auto; -webkit-overflow-scrolling: touch;
}
.dp-tabs-nav::-webkit-scrollbar { display: none; }
.dp-tab-btn {
    padding: 13px 16px; border: none; background: transparent;
    color: var(--c-muted); font-weight: 600; font-size: .84rem;
    position: relative; white-space: nowrap; transition: color var(--t);
    cursor: pointer;
}
.dp-tab-btn::after {
    content: ''; position: absolute; bottom: -2px; left: 0; right: 0;
    height: 2px; background: var(--c-primary);
    transform: scaleX(0); transform-origin: right;
    transition: transform .28s var(--ease);
}
.dp-tab-btn.active { color: var(--c-primary); font-weight: 700; }
.dp-tab-btn.active::after { transform: scaleX(1); transform-origin: left; }
.dp-tab-btn:hover:not(.active) { color: var(--c-mid); }
.dp-tab-content { padding: 18px 16px; }
.dp-tab-pane { display: none; }
.dp-tab-pane.active { display: block; }
.dp-tab-pane .description-content { font-size: .88rem; line-height: 1.8; color: var(--c-text); }

.dp-spec-mini-card {
    border-radius: var(--r-md); background: var(--c-soft);
    border: 1px solid var(--c-border);
    padding: 12px 14px; text-align: center;
}
.dp-spec-mini-label { font-size: .7rem; font-weight: 700; color: var(--c-mid); margin-bottom: 3px; }
.dp-spec-mini-val { font-size: .95rem; font-weight: 800; color: var(--c-text); }
.dp-stock-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 13px; border-radius: 99px;
    background: rgba(13,79,48,.08); color: var(--c-primary);
    border: 1px solid rgba(13,79,48,.12);
    font-weight: 700; font-size: .83rem; margin-bottom: 14px;
}

.dp-link-item {
    display: block; padding: 12px 14px; border-radius: var(--r-md);
    border: 1px solid var(--c-border); background: #fff; margin-bottom: 8px;
    text-decoration: none; color: var(--c-text);
    font-weight: 600; font-size: .83rem;
    transition: all var(--t);
    display: flex; align-items: center; gap: 9px;
}
.dp-link-item i { color: var(--c-mid); flex-shrink: 0; }
.dp-link-item:hover { border-color: var(--c-mid); box-shadow: 0 3px 10px rgba(13,79,48,.06); transform: translateY(-1px); color: var(--c-primary); }

/* ═══════════════════════════════════════════════════════════
   DESKTOP SIDEBAR CARD
   ═══════════════════════════════════════════════════════════ */
.dp-sidebar { position: sticky; top: 116px; z-index: 100; }
.dp-sidebar-card {
    background: var(--c-surface); border-radius: var(--r-xl);
    border: 1px solid var(--c-border); box-shadow: var(--shadow-md);
    padding: 20px; overflow: hidden;
}

.dp-sidebar-head {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 16px; padding-bottom: 13px;
    border-bottom: 1px solid var(--c-border);
}
.dp-sidebar-head h6 { margin: 0; font-weight: 700; font-size: .9rem; color: var(--c-text); }
.dp-featured-badge {
    font-size: .62rem; font-weight: 700; padding: 3px 7px;
    border-radius: 6px; background: var(--c-soft); color: var(--c-primary);
    border: 1px solid rgba(13,79,48,.15);
}

.dp-sidebar-product {
    display: flex; gap: 10px; margin-bottom: 16px; align-items: center;
}
.dp-sidebar-thumb {
    width: 54px; height: 54px; border-radius: 10px;
    object-fit: cover; border: 1px solid var(--c-border); flex-shrink: 0;
}
.dp-sidebar-product-name { font-size: .83rem; font-weight: 700; color: var(--c-text); line-height: 1.3; }
.dp-sidebar-cat {
    font-size: .62rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em;
    display: inline-flex; align-items: center; gap: 3px;
    padding: 2px 5px; border-radius: 4px;
    background: rgba(13,79,48,.07); color: var(--c-primary); margin-top: 3px;
}
.dp-sidebar-stars { display: flex; gap: 2px; margin-top: 4px; }
.dp-sidebar-stars i { font-size: .68rem; color: #f59e0b; }

.dp-sidebar-price-box {
    padding: 14px 15px; border-radius: var(--r-md);
    background: rgba(13,79,48,.05); border: 1px solid rgba(13,79,48,.08);
    margin-bottom: 12px;
}
.dp-sidebar-price-label {
    font-size: .62rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .06em; color: var(--c-muted);
    margin-bottom: 4px; display: flex; align-items: center; gap: 5px;
}
#price-display { color: var(--c-primary); font-size: 1.55rem; font-weight: 900; letter-spacing: -.025em; }

.dp-sidebar-meta { display: grid; grid-template-columns: minmax(0, 2fr) minmax(0, 1fr); gap: 6px; margin-bottom: 12px; }
.dp-sidebar-meta-item {
    padding: 8px 10px; border-radius: var(--r-sm);
    background: var(--c-soft); border: 1px solid var(--c-border);
}
.dp-sidebar-meta-item small {
    display: block; font-size: .58rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .05em;
    color: var(--c-muted); margin-bottom: 2px;
}
.dp-sidebar-meta-item .dp-meta-val {
    font-weight: 700; color: var(--c-text); font-size: .74rem;
    overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.stock-highlight-avail {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(26, 122, 74, 0.08) !important;
    color: var(--c-mid) !important;
    border: 1px solid rgba(26, 122, 74, 0.2) !important;
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: 700;
    font-size: .78rem !important;
    box-shadow: 0 2px 8px rgba(13, 79, 48, 0.04);
}
.stock-highlight-empty {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(239, 68, 68, 0.08) !important;
    color: #ef4444 !important;
    border: 1px solid rgba(239, 68, 68, 0.2) !important;
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: 700;
    font-size: .78rem !important;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);
}

/* Premium SweetAlert2 Custom Styling Overrides */
.swal2-popup {
    font-family: var(--font) !important;
    border-radius: var(--r-xl) !important;
    border: 1px solid var(--c-border) !important;
    box-shadow: var(--shadow-lg) !important;
    background: rgba(255, 255, 255, 0.98) !important;
    backdrop-filter: blur(10px);
}
.swal2-title {
    color: var(--c-text) !important;
    font-weight: 800 !important;
    font-size: 1.25rem !important;
    letter-spacing: -.02em !important;
}
.swal2-html-container {
    color: var(--c-muted) !important;
    font-size: .88rem !important;
    font-weight: 500 !important;
    line-height: 1.5 !important;
}
.swal2-confirm {
    background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-mid) 100%) !important;
    border: none !important;
    border-radius: 12px !important;
    padding: 10px 24px !important;
    font-size: .85rem !important;
    font-weight: 700 !important;
    box-shadow: 0 4px 14px rgba(13, 79, 48, 0.2) !important;
}
.swal2-cancel {
    background: #f1f5f9 !important;
    color: #64748b !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 12px !important;
    padding: 10px 24px !important;
    font-size: .85rem !important;
    font-weight: 700 !important;
}
.swal2-loader {
    border-color: var(--c-primary) transparent var(--c-primary) transparent !important;
}

/* Smooth transition keyframes */
@keyframes fadeInScale {
    from { opacity: 0; transform: scale(0.96) translateY(2px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
.animate-fade-in {
    animation: fadeInScale 0.22s var(--ease) forwards;
}

/* Swap container for super smooth transitions */
.swap-container {
    display: grid !important;
    grid-template-columns: 1fr !important;
    grid-template-rows: 1fr !important;
    align-items: center !important;
    position: relative !important;
}

.swap-item {
    grid-area: 1 / 1 / 2 / 2 !important;
    transition: opacity 0.28s cubic-bezier(0.4, 0, 0.2, 1), transform 0.28s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.28s !important;
    opacity: 1 !important;
    transform: scale(1) !important;
    visibility: visible !important;
}

.swap-item.hidden-state {
    opacity: 0 !important;
    transform: scale(0.92) !important;
    visibility: hidden !important;
    pointer-events: none !important;
}

/* Premium SweetAlert2 Custom Styling & Animations */
@keyframes swalScaleIn {
    0% { transform: scale(0.9) translateY(12px); opacity: 0; }
    100% { transform: scale(1) translateY(0); opacity: 1; }
}

@keyframes swalScaleOut {
    0% { transform: scale(1) translateY(0); opacity: 1; }
    100% { transform: scale(0.9) translateY(12px); opacity: 0; }
}

.swal-custom-show {
    animation: swalScaleIn 0.26s cubic-bezier(0.34, 1.56, 0.64, 1) forwards !important;
}

.swal-custom-hide {
    animation: swalScaleOut 0.2s cubic-bezier(0.36, 0.07, 0.19, 0.97) forwards !important;
}

/* Badge scaling animation on change */
@keyframes badgePop {
    0% { transform: scale(1); }
    50% { transform: scale(1.4); }
    100% { transform: scale(1); }
}
.badge-pop {
    animation: badgePop 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
}

/* Loading spinner utility */
.btn-spinner {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    vertical-align: text-bottom;
    border: 0.2em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    animation: spinner-border .75s linear infinite;
    margin-right: 8px;
}
@keyframes spinner-border {
    to { transform: rotate(360deg); }
}


.dp-ship-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 9px 11px; border-radius: var(--r-sm);
    background: #fff; border: 1px solid var(--c-border);
    margin-bottom: 12px;
}
.dp-ship-label { font-size: .6rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--c-muted); margin-bottom: 1px; }
.dp-ship-val { font-size: .78rem; font-weight: 700; color: var(--c-text); }
.dp-ship-courier { font-size: .67rem; color: var(--c-muted); text-align: right; }

.dp-sidebar-qty-label { font-size: .74rem; font-weight: 700; color: var(--c-text); margin-bottom: 6px; }
.dp-sidebar-qty-wrap {
    background: var(--c-soft); border: 1px solid var(--c-border);
    border-radius: var(--r-md); padding: 3px; margin-bottom: 12px;
}

/* Share */
.dp-share { display: flex; align-items: center; justify-content: center; gap: 5px; margin-top: 10px; }
.dp-share-label { font-size: .68rem; font-weight: 700; color: var(--c-muted); margin-right: 2px; }
.dp-share-btn {
    width: 30px; height: 30px; border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: .72rem; text-decoration: none;
    border: 1px solid transparent; transition: all var(--t);
}
.dp-share-fb { background: rgba(24,119,242,.09); color: #1877F2; border-color: rgba(24,119,242,.14); }
.dp-share-fb:hover { background: #1877F2; color: #fff; transform: translateY(-2px); }
.dp-share-tw { background: rgba(29,161,242,.09); color: #1DA1F2; border-color: rgba(29,161,242,.14); }
.dp-share-tw:hover { background: #1DA1F2; color: #fff; transform: translateY(-2px); }
.dp-share-wa { background: rgba(37,211,102,.09); color: #25D366; border-color: rgba(37,211,102,.14); }
.dp-share-wa:hover { background: #25D366; color: #fff; transform: translateY(-2px); }

/* Trust strip */
.dp-trust {
    display: flex; align-items: center; justify-content: space-around;
    padding: 10px 6px; border-radius: var(--r-md);
    background: var(--c-soft); border: 1px solid var(--c-border); margin-top: 12px;
}
.dp-trust-item {
    display: flex; flex-direction: column; align-items: center;
    gap: 3px; font-size: .57rem; font-weight: 700;
    color: var(--c-muted); text-align: center;
}
.dp-trust-item i {
    width: 24px; height: 24px; border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    background: rgba(13,79,48,.08); color: var(--c-primary); font-size: .72rem;
}

/* ═══════════════════════════════════════════════════════════
   MOBILE STICKY BOTTOM BAR – glassy premium
   ═══════════════════════════════════════════════════════════ */
.dp-mobile-bar {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 1050;
    background: rgba(255,255,255,.97);
    backdrop-filter: saturate(180%) blur(20px);
    -webkit-backdrop-filter: saturate(180%) blur(20px);
    border-top: 1px solid rgba(13,79,48,.1);
    padding: 10px 16px calc(10px + env(safe-area-inset-bottom));
    box-shadow: 0 -4px 24px rgba(0,0,0,.07), 0 -1px 6px rgba(13,79,48,.04);
    transform: translateY(100%);
    transition: transform .3s cubic-bezier(.16,1,.3,1);
}
.dp-mobile-bar.visible { transform: translateY(0); }
.dp-mobile-bar-inner {
    display: flex; align-items: center; gap: 10px;
    max-width: 500px; margin: 0 auto;
}
.dp-mobile-chat {
    width: 46px; height: 46px; border-radius: 13px;
    border: 1.5px solid var(--c-border); background: #fff;
    color: var(--c-primary);
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 1.05rem; cursor: pointer;
    transition: all var(--t); flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,.04); padding: 0;
}
.dp-mobile-chat:hover { background: var(--c-soft); border-color: rgba(26,122,74,.25); }
.dp-mobile-chat:active { transform: scale(.94); }
.dp-mobile-info { flex-grow: 1; min-width: 0; }
.dp-mobile-price {
    font-size: 1.1rem; font-weight: 900; color: var(--c-primary);
    letter-spacing: -.02em; line-height: 1.1;
}
.dp-mobile-variant {
    font-size: .66rem; color: var(--c-muted);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    margin-top: 1px; font-weight: 500;
}
.dp-mobile-cta {
    height: 46px; padding: 0 18px; border-radius: 13px;
    font-size: .82rem; font-weight: 700; white-space: nowrap;
    min-width: 120px;
    display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    box-shadow: 0 4px 16px rgba(13,79,48,.25);
}

@media (min-width: 768px) { .dp-mobile-bar { display: none !important; } }

/* ═══════════════════════════════════════════════════════════
   RESPONSIVE – MOBILE OVERRIDES
   ═══════════════════════════════════════════════════════════ */
@media (max-width: 991.98px) {
    .dp-grid { grid-template-columns: 1fr; }
    .dp-sidebar-col { display: none !important; }
}

@media (max-width: 767.98px) {
    body { padding-bottom: 80px; }

    .dp-stage { padding: 0 0 2.5rem; }
    .dp-breadcrumb { padding: .5rem 1rem .25rem; }

    /* Full-bleed gallery – edge to edge */
    .dp-gallery {
        border-radius: 0 !important;
        border-left: none !important;
        border-right: none !important;
        border-top: none !important;
        box-shadow: none !important;
        margin: 0 -12px; /* cancel container padding */
    }
    .dp-gallery-frame { min-height: 380px; border-radius: 0; }
    .dp-gallery-frame img { max-height: 380px; }
    .dp-thumbs { padding: 10px 12px 12px; }

    /* Product info card */
    .dp-info-card {
        border-radius: 20px 20px 0 0 !important;
        border-left: none !important;
        border-right: none !important;
        border-bottom: none !important;
        box-shadow: 0 -4px 20px rgba(0,0,0,.06) !important;
        margin-top: -18px;
        position: relative; z-index: 5;
    }
    .dp-info { padding: 20px 16px 14px; }
    .dp-title { font-size: 1.2rem; }
    .dp-price-hero { border-radius: var(--r-md); }
    .dp-price-amount { font-size: 1.75rem; }

    /* info sections */
    .dp-section { border-radius: var(--r-md); margin-bottom: 8px; }
    .dp-section-head { padding: 11px 13px; }
    .dp-section-body { padding: 11px 13px; }

    /* Tabs */
    .dp-tabs-card {
        border-radius: 0 !important;
        border-left: none !important;
        border-right: none !important;
        margin-top: 8px;
        box-shadow: none !important;
    }
    .dp-tab-btn { padding: 12px 14px; font-size: .8rem; }
    .dp-tab-content { padding: 16px 14px; }

    /* Checkout card */
    .dp-checkout-mobile { border-radius: var(--r-lg); padding: 14px; }
}

@media (max-width: 575.98px) {
    .dp-gallery-frame { min-height: 320px; }
    .dp-gallery-frame img { max-height: 320px; }
    .variant-option { min-width: calc(50% - 4px); flex-grow: 1; }
}

/* ═══════════════════════════════════════════════════════════
   MISC UTILITIES
   ═══════════════════════════════════════════════════════════ */
.quantity-wrapper { background: var(--c-soft); border: 1px solid var(--c-border); border-radius: var(--r-md); padding: 3px; }
.mb-10 { margin-bottom: 10px; }

/* Scroll snap on mobile gallery */
@media (max-width: 767.98px) {
    .dp-mobile-bar-active #ai-chat-widget { bottom: 82px !important; transition: bottom .3s !important; }
    .dp-mobile-bar-active .scroll-shortcuts-widget { bottom: 230px !important; transition: bottom .3s !important; }
}
</style>

{{-- ── DATA PREP ─────────────────────────────────────────── --}}
@php
    $thumb = $parentProduct->productImages->first()
        ? asset('storage/'.$parentProduct->productImages->first()->path)
        : asset('images/placeholder.jpg');
    $stockQty = $parentProduct->type == 'configurable'
        ? $parentProduct->total_stock
        : ($parentProduct->productInventory->qty ?? 0);
    $statusLabel = $stockQty > 10 ? 'Tersedia' : ($stockQty > 0 ? 'Terbatas' : 'Habis');
    $statusCls   = $stockQty > 10 ? 'dp-badge-ok' : ($stockQty > 0 ? 'dp-badge-warn' : 'dp-badge-out');
    $statusIcon  = $stockQty > 10 ? 'fas fa-check-circle' : ($stockQty > 0 ? 'fas fa-exclamation-circle' : 'fas fa-times-circle');
    $reviewCount = $parentProduct->reviews_count ?? rand(5,50);
    $ratingVal   = $parentProduct->rating ?? 4;
    $hasManyImg  = $parentProduct->productImages->count() > 1;
@endphp

{{-- ── BREADCRUMB ─────────────────────────────────────────── --}}
<div class="container dp-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($parentProduct->name, 36) }}</li>
        </ol>
    </nav>
</div>

{{-- ── PAGE ───────────────────────────────────────────────── --}}
<div class="dp-page">
<div class="container dp-stage">
<div class="dp-grid">

    {{-- ════════════════════════════════════════════
         MAIN COLUMN
         ════════════════════════════════════════════ --}}
    <div class="dp-main">

        {{-- ── ROW: Gallery + Info (lg side-by-side) ── --}}
        <div class="row g-3">

            {{-- GALLERY ──────────────────────────── --}}
            <div class="col-lg-6">
                <div class="dp-card dp-gallery">
                    <div class="dp-gallery-frame">
                        {{-- Badge overlays --}}
                        <div class="dp-gallery-badges">
                            @if($productCategory)
                                <span class="dp-badge dp-badge-cat">
                                    <i class="fa fa-tag"></i>{{ $productCategory->categories->name }}
                                </span>
                            @endif
                            <span class="dp-badge {{ $statusCls }}">
                                <i class="{{ $statusIcon }}"></i>{{ $statusLabel }}
                            </span>
                        </div>

                        @if ($parentProduct->productImages->count() > 0)
                            @if ($hasManyImg)
                                <div id="carouselExampleIndicators" class="carousel slide w-100" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        @foreach ($parentProduct->productImages as $key)
                                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="{{ $loop->index }}"
                                                class="{{ $loop->first ? 'active' : '' }}"
                                                aria-label="Image {{ $loop->index + 1 }}"></button>
                                        @endforeach
                                    </div>
                                    <div class="carousel-inner">
                                        @foreach($parentProduct->productImages as $key => $img)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/'.$img->path) }}" class="d-block" alt="Product Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon dp-gallery-ctrl" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon dp-gallery-ctrl" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @else
                                <img src="{{ asset('storage/'.$parentProduct->productImages->first()->path) }}" class="img-fluid d-block" alt="Product Image">
                            @endif
                        @else
                            <img src="{{ asset('images/placeholder.jpg') }}" class="img-fluid d-block" alt="Product Image">
                        @endif
                    </div>
                    @if($hasManyImg)
                        <div class="dp-thumbs">
                            @foreach($parentProduct->productImages as $key => $img)
                                <img src="{{ asset('storage/'.$img->path) }}"
                                     class="dp-thumb {{ $key == 0 ? 'active' : '' }}"
                                     onclick="(function(idx,el){
                                         var c=bootstrap.Carousel.getOrCreateInstance(document.getElementById('carouselExampleIndicators'));
                                         c.to(idx);
                                         el.closest('.dp-thumbs').querySelectorAll('.dp-thumb').forEach(function(t,i){t.classList.toggle('active',i===idx)});
                                     })({{ $key }},this)"
                                     alt="Thumb {{ $key+1 }}">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- PRODUCT INFO ─────────────────────── --}}
            <div class="col-lg-6">
                <div class="dp-card dp-info-card">
                    <div class="dp-info">

                        {{-- Kicker --}}
                        <span class="dp-kicker">
                            {{ $parentProduct->type == 'configurable' ? '⚙ Configurable Product' : '✦ Ready to Order' }}
                        </span>

                        {{-- Title --}}
                        <h1 class="dp-title text-truncate-custom">{{ $parentProduct->name }}</h1>

                        {{-- Rating --}}
                        <div class="dp-rating">
                            <div class="dp-stars">
                                @for($i=0;$i<5;$i++)<i class="fa fa-star{{ $i < $ratingVal ? '' : '-o' }}"></i>@endfor
                            </div>
                            <span class="dp-rating-num">{{ number_format($ratingVal,1) }}</span>
                            <span class="dp-sep">·</span>
                            <span class="dp-rating-sub">{{ $reviewCount }} ulasan</span>
                            <span class="dp-sep">·</span>
                            <span class="dp-rating-sub">100+ terjual</span>
                        </div>

                        {{-- Meta chips --}}
                        <div class="dp-chips">
                            @if($productCategory)
                                <span class="dp-chip"><i class="fa fa-tag"></i>{{ $productCategory->categories->name }}</span>
                            @endif
                            <span class="dp-chip"><i class="fa fa-weight-hanging"></i>{{ $parentProduct->weight ?? 0 }}g</span>
                            @if($stockQty > 0)
                                <span class="dp-chip dp-chip-stock-ok"><i class="fa fa-check-circle"></i>Stok {{ $stockQty }}</span>
                            @else
                                <span class="dp-chip dp-chip-stock-out"><i class="fa fa-times-circle"></i>Habis</span>
                            @endif
                        </div>

                        {{-- PRICE HERO --}}
                        <div class="dp-price-hero">
                            <div class="dp-price-label"><i class="fa fa-wallet"></i> Harga</div>
                            <div class="d-flex align-items-baseline gap-2 flex-wrap">
                                <div class="dp-price-amount" id="main-price-display">
                                    @if($priceRange && !$priceRange['same'])
                                        Rp {{ number_format($priceRange['min'],0,',','.') }} – {{ number_format($priceRange['max'],0,',','.') }}
                                    @elseif($priceRange)
                                        Rp {{ number_format($priceRange['min'],0,',','.') }}
                                    @else
                                        Rp {{ number_format($parentProduct->price,0,',','.') }}
                                    @endif
                                </div>
                                @if($parentProduct->original_price && $parentProduct->original_price > $parentProduct->price)
                                    <span class="dp-price-off">{{ round((($parentProduct->original_price-$parentProduct->price)/$parentProduct->original_price)*100) }}% Off</span>
                                @endif
                            </div>
                            @if($parentProduct->original_price && $parentProduct->original_price > $parentProduct->price)
                                <div class="dp-price-original">Rp {{ number_format($parentProduct->original_price,0,',','.') }}</div>
                            @endif
                        </div>

                        {{-- Deskripsi Singkat --}}
                        <div class="dp-section">
                            <div class="dp-section-head">
                                <span class="dp-section-icon"><i class="fa fa-align-left"></i></span>
                                <span class="dp-section-title">Deskripsi Singkat</span>
                            </div>
                            <div class="dp-section-body">
                                <p class="dp-section-text mb-0">{{ $parentProduct->short_description }}</p>
                            </div>
                        </div>

                        {{-- Spesifikasi --}}
                        <div class="dp-section">
                            <div class="dp-section-head">
                                <span class="dp-section-icon"><i class="fa fa-list-ul"></i></span>
                                <span class="dp-section-title">Spesifikasi</span>
                            </div>
                            <div class="dp-section-body">
                                <div class="dp-spec-row">
                                    <span class="dp-spec-k">SKU</span>
                                    <span class="dp-spec-v sku-text">{{ $parentProduct->sku ?? 'N/A' }}</span>
                                </div>
                                <div class="dp-spec-row">
                                    <span class="dp-spec-k">Status</span>
                                    <span id="main-stock-info" class="{{ $stockQty > 0 ? 'stock-highlight-avail' : 'stock-highlight-empty' }}">
                                        @if($stockQty)
                                            <i class="fas fa-check-circle"></i> Stok {{ $stockQty }} unit tersedia
                                        @else
                                            <i class="fas fa-exclamation-circle"></i> Out of Stock
                                        @endif
                                    </span>
                                </div>
                                <div class="dp-spec-row">
                                    <span class="dp-spec-k">Berat</span>
                                    <span class="dp-spec-v">{{ $parentProduct->weight ?? 0 }} gram</span>
                                </div>
                                <div class="dp-spec-row">
                                    <span class="dp-spec-k">Min. Pesanan</span>
                                    <span class="dp-spec-v">1 unit</span>
                                </div>
                            </div>
                        </div>

                        {{-- Pengiriman & Pembayaran --}}
                        <div class="dp-section">
                            <div class="dp-section-head">
                                <span class="dp-section-icon"><i class="fa fa-truck"></i></span>
                                <span class="dp-section-title">Pengiriman &amp; Pembayaran</span>
                            </div>
                            <div class="dp-section-body">
                                <div class="dp-tag-group">
                                    <div class="dp-tag-group-label"><i class="fas fa-truck-fast"></i> Kurir Tersedia</div>
                                    <div class="dp-tags">
                                        <span class="dp-tag">
                                            <svg class="dp-tag-icon" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M2 17h4l3-10H5z" opacity="0.6"/>
                                                <path d="M7 17h4l3-10H9z" opacity="0.8"/>
                                                <path d="M12 17h4l3-10H14z"/>
                                            </svg>
                                            JNE Express
                                        </span>
                                        <span class="dp-tag">
                                            <svg class="dp-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 5h5v9a3 3 0 0 1-5 0" />
                                                <path d="M12 5h8M16 5v13" />
                                                <circle cx="10.5" cy="12" r="2" stroke-width="1.5" fill="currentColor" fill-opacity="0.1"/>
                                            </svg>
                                            J&amp;T Express
                                        </span>
                                        <span class="dp-tag">
                                            <svg class="dp-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                                            </svg>
                                            SiCepat
                                        </span>
                                        <span class="dp-tag">
                                            <svg class="dp-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="6" cy="19" r="2"/>
                                                <circle cx="18" cy="19" r="2"/>
                                                <path d="M6 12h5l2 5h3"/>
                                                <path d="M16 11l-2-6h-2"/>
                                                <rect x="3" y="6" width="6" height="6" rx="1"/>
                                            </svg>
                                            GoSend / Grab
                                        </span>
                                    </div>
                                </div>
                                <div class="dp-tag-group">
                                    <div class="dp-tag-group-label"><i class="fas fa-wallet"></i> Metode Pembayaran</div>
                                    <div class="dp-tags">
                                        <span class="dp-tag">
                                            <svg class="dp-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 21h18M3 10h18M6 10v7M10 10v7M14 10v7M18 10v7M12 3L3 10h18L12 3z"/>
                                            </svg>
                                            Transfer Bank
                                        </span>
                                        <span class="dp-tag">
                                            <svg class="dp-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="7" height="7" rx="1"/>
                                                <rect x="14" y="3" width="7" height="7" rx="1"/>
                                                <rect x="3" y="14" width="7" height="7" rx="1"/>
                                                <rect x="14" y="14" width="3" height="3" rx="0.5"/>
                                                <rect x="18" y="18" width="3" height="3" rx="0.5"/>
                                                <path d="M14 17h.01M17 14h.01M17 17v-3"/>
                                            </svg>
                                            QRIS / E-Wallet
                                        </span>
                                        <span class="dp-tag">
                                            <svg class="dp-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 9h18M3 9l1-5h16l1 5M5 9v11a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9M9 14h6"/>
                                            </svg>
                                            Bayar di Toko
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- VARIANT PANEL --}}
                        @if($parentProduct->type == 'configurable' && $variants->count() > 0)
                            <div class="dp-variant-panel">
                                <div class="dp-variant-head">
                                    <i class="fa fa-cogs"></i>
                                    <h6>Pilih Varian</h6>
                                </div>
                                <div class="dp-variant-body">
                                    @foreach($variantOptions as $attributeName => $options)
                                        <div class="dp-variant-group">
                                            <span class="dp-variant-label">{{ ucfirst($attributeName) }}</span>
                                            <div class="variant-options d-flex flex-wrap gap-2" data-attribute="{{ $attributeName }}">
                                                @foreach($options as $option)
                                                    <button type="button" class="btn btn-outline-secondary variant-option"
                                                            data-attribute="{{ $attributeName }}" data-value="{{ $option }}">
                                                        {{ $option }}
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="dp-price-range">
                                        <div class="dp-price-range-label"><i class="fa fa-wallet"></i> Range Harga</div>
                                        <h5 class="dp-price-range-val" id="main-price-display-variant">
                                            @if($priceRange && !$priceRange['same'])
                                                Rp {{ number_format($priceRange['min'],0,',','.') }} – {{ number_format($priceRange['max'],0,',','.') }}
                                            @elseif($priceRange)
                                                Rp {{ number_format($priceRange['min'],0,',','.') }}
                                            @else
                                                Rp {{ number_format($parentProduct->price,0,',','.') }}
                                            @endif
                                        </h5>
                                    </div>

                                    <div id="variant-info" style="display:none;">
                                        <div class="alert variant-selected-card">
                                            <h6 class="mb-2"><i class="fas fa-check-circle me-2"></i>Varian Dipilih</h6>
                                            <div style="font-size:.8rem;" class="mb-1"><strong>Nama:</strong> <span id="variant-name">-</span></div>
                                            <div style="font-size:.8rem;" class="mb-2"><strong>Spek:</strong> <span id="variant-attributes">-</span></div>
                                            <div class="row g-2">
                                                <div class="col-4">
                                                    <div style="font-size:.6rem;color:var(--c-muted);font-weight:700;text-transform:uppercase;">SKU</div>
                                                    <div id="variant-sku" class="sku-text" style="font-size:.76rem;font-weight:700;color:var(--c-text);">-</div>
                                                </div>
                                                <div class="col-4">
                                                    <div style="font-size:.6rem;color:var(--c-muted);font-weight:700;text-transform:uppercase;">Stok</div>
                                                    <div id="variant-stock" style="font-size:.76rem;font-weight:700;color:var(--c-text);">-</div>
                                                </div>
                                                <div class="col-4">
                                                    <div style="font-size:.6rem;color:var(--c-muted);font-weight:700;text-transform:uppercase;">Berat</div>
                                                    <div style="font-size:.76rem;font-weight:700;color:var(--c-text);"><span id="variant-weight">-</span>g</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="selection-message" class="alert mt-2">
                                        <i class="fas fa-info-circle"></i>Pilih varian untuk melanjutkan
                                    </div>
                                </div>
                            </div>
                        @else
                            <div id="variant-info" style="display:none;"></div>
                            <div id="selection-message" class="alert mt-3" style="display:none;"></div>
                        @endif

                        {{-- MOBILE CHECKOUT CARD (hidden lg+) --}}
                        <div class="dp-checkout-mobile d-lg-none mt-3">
                            {{-- Row 1: Quantity and Subtotal Side-by-Side --}}
                            <div class="d-flex align-items-center justify-content-between mb-3 gap-2">
                                <div>
                                    <div class="dp-sidebar-qty-label mb-1" style="font-size: .68rem; text-transform: uppercase; color: var(--c-muted); font-weight: 700; letter-spacing: 0.05em;"><i class="fas fa-layer-group me-1 opacity-60"></i>Kuantitas</div>
                                    
                                    <div class="swap-container" style="min-width: 110px; min-height: 38px;">
                                        {{-- Standard Quantity Selector (If NOT in Cart) --}}
                                        <div class="qty-counter-wrapper swap-item" id="mobile-page-qty-counter-normal">
                                            <div class="qty-counter" style="border: 1px solid var(--c-border); border-radius: 10px; background: var(--c-bg); padding: 2px;">
                                                <button type="button" class="qty-btn" style="width: 32px; height: 32px; border-radius: 8px; border: none; background: #fff;"
                                                        onclick="var q=document.getElementById('quantity-mobile-page'),v=parseInt(q.value)||1,m=parseInt(q.min)||1;if(v>m){q.value=v-1;q.dispatchEvent(new Event('input'));}"
                                                        aria-label="Kurangi">
                                                    <i class="fas fa-minus" style="font-size:.65rem;"></i>
                                                </button>
                                                <input type="number" class="form-control" id="quantity-mobile-page" value="1" min="1" readonly style="width: 36px; font-weight: 800; font-size: .85rem; text-align: center;">
                                                <button type="button" class="qty-btn" style="width: 32px; height: 32px; border-radius: 8px; border: none; background: #fff;"
                                                        onclick="var q=document.getElementById('quantity-mobile-page'),v=parseInt(q.value)||1,mx=parseInt(q.max)||9999;if(v<mx){q.value=v+1;q.dispatchEvent(new Event('input'));}"
                                                        aria-label="Tambah">
                                                    <i class="fas fa-plus" style="font-size:.65rem;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Cart Quantity Modifier (If IS in Cart) --}}
                                        <div class="cart-modifier-widget mobile-page-cart-modifier swap-item hidden-state" style="display: flex; align-items: center; justify-content: space-between; background: var(--c-soft); padding: 2px; border-radius: 10px; border: 1.5px solid var(--c-mid); height: 38px; width: 110px;">
                                            <button type="button" class="btn-dp-primary qty-down-btn" style="width: 32px; height: 32px; padding: 0; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: #e11d48 !important; box-shadow: none; flex-shrink: 0; border: none;">
                                                <i class="fa fa-trash" style="font-size: .7rem;"></i>
                                            </button>
                                            <span class="cart-qty-display" style="font-weight: 800; font-size: .95rem; color: var(--c-primary); width: 36px; text-align: center;">1</span>
                                            <button type="button" class="btn-dp-primary qty-up-btn" style="width: 32px; height: 32px; padding: 0; border-radius: 8px; display: flex; align-items: center; justify-content: center; box-shadow: none; flex-shrink: 0; border: none;">
                                                <i class="fa fa-plus" style="font-size: .7rem;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Right Side: Subtotal Display --}}
                                <div class="text-end">
                                    <div class="dp-sidebar-qty-label mb-1" style="font-size: .68rem; text-transform: uppercase; color: var(--c-muted); font-weight: 700; letter-spacing: 0.05em;"><i class="fas fa-coins me-1 opacity-60"></i>Subtotal</div>
                                    <div class="mobile-subtotal-display" style="font-weight: 900; font-size: 1.2rem; color: var(--c-primary); letter-spacing: -.02em;">Rp 0</div>
                                </div>
                            </div>

                            {{-- Row 2: Action Button --}}
                            <div class="mobile-page-cta-wrapper swap-container w-100" style="min-height: 48px;">
                                <button type="button" class="btn-dp-primary add-to-cart-btn-mobile-page w-100 swap-item"
                                        @if($parentProduct->type == 'configurable' && $variants->count() > 0) disabled @endif>
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="cta-text">
                                        @if($parentProduct->type == 'configurable' && $variants->count() > 0)
                                            Pilih Varian Dulu
                                        @else
                                            Tambah ke Keranjang
                                        @endif
                                    </span>
                                </button>
                                <a href="{{ route('carts.index') }}" class="btn-dp-secondary go-to-cart-btn mobile-page-go-to-cart-btn w-100 swap-item hidden-state" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 700; font-size: .9rem; padding: 14px 20px; border-radius: 13px; text-decoration: none; border: 1.5px solid var(--c-primary); color: var(--c-primary); background: #fff; box-shadow: var(--shadow-sm); transition: all var(--t); margin-bottom: 0;">
                                    <i class="fas fa-shopping-cart"></i> Lihat Keranjang / Checkout
                                </a>
                            </div>
                        </div>

                        {{-- LONG DESCRIPTION (mobile only, lg hidden) --}}
                        <div class="dp-section d-lg-none mt-3">
                            <div class="dp-section-head">
                                <span class="dp-section-icon"><i class="fa fa-file-alt"></i></span>
                                <span class="dp-section-title">Detail Produk</span>
                            </div>
                            <div class="dp-section-body">
                                <div class="dp-section-text">{!! $parentProduct->description !!}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>{{-- end row --}}

        {{-- TABS ──────────────────────────────────── --}}
        <div class="dp-card dp-tabs-card">
            <div class="dp-tabs-shell">
                <div class="dp-tabs-nav">
                    <button class="dp-tab-btn active" data-tab="tab-desc">
                        <i class="fa fa-info-circle me-1"></i>Deskripsi
                    </button>
                    <button class="dp-tab-btn" data-tab="tab-links">
                        <i class="fa fa-link me-1"></i>Link Produk
                    </button>
                </div>
                <div class="dp-tab-content">
                    {{-- Tab: Description --}}
                    <div class="dp-tab-pane active" id="tab-desc">
                        <h5 class="fw-bold mb-3" style="font-size:.95rem;color:var(--c-text);">{{ $parentProduct->short_description }}</h5>
                        @if($parentProduct->productInventory && $parentProduct->productInventory->qty)
                            <div class="dp-stock-pill mb-3">
                                <i class="fa fa-box"></i> Stok: {{ $parentProduct->productInventory->qty }} unit tersedia
                            </div>
                        @endif
                        <div class="description-content">{!! $parentProduct->description !!}</div>
                        <div class="row g-3 mt-3">
                            <div class="col-sm-4 col-6">
                                <div class="dp-spec-mini-card">
                                    <div class="dp-spec-mini-label"><i class="fa fa-weight-hanging me-1"></i>Berat</div>
                                    <div class="dp-spec-mini-val">{{ $parentProduct->weight }} gram</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Tab: Links --}}
                    <div class="dp-tab-pane" id="tab-links">
                        <h5 class="fw-bold mb-3" style="font-size:.95rem;color:var(--c-text);">Link Produk Terkait</h5>
                        @if($parentProduct->link1)
                            <a href="{{ $parentProduct->link1 }}" class="dp-link-item text-truncate-custom" target="_blank" rel="noopener">
                                <i class="fa fa-external-link-alt"></i>
                                Link 1: {{ Str::limit($parentProduct->link1, 55) }}
                            </a>
                        @endif
                        @if($parentProduct->link2)
                            <a href="{{ $parentProduct->link2 }}" class="dp-link-item text-truncate-custom" target="_blank" rel="noopener">
                                <i class="fa fa-external-link-alt"></i>
                                Link 2: {{ Str::limit($parentProduct->link2, 55) }}
                            </a>
                        @endif
                        @if($parentProduct->link3)
                            <a href="{{ $parentProduct->link3 }}" class="dp-link-item text-truncate-custom" target="_blank" rel="noopener">
                                <i class="fa fa-external-link-alt"></i>
                                Link 3: {{ Str::limit($parentProduct->link3, 55) }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- end main column --}}

    {{-- ════════════════════════════════════════════
         DESKTOP SIDEBAR
         ════════════════════════════════════════════ --}}
    <div class="dp-sidebar-col">
        <div class="dp-sidebar">
            <div class="dp-sidebar-card">

                {{-- Header --}}
                <div class="dp-sidebar-head">
                    <h6>Ringkasan Produk</h6>
                    @if($parentProduct->is_featured ?? false)
                        <span class="dp-featured-badge">Featured</span>
                    @endif
                </div>

                {{-- Product --}}
                <div class="dp-sidebar-product">
                    <img src="{{ $thumb }}" alt="thumb" class="dp-sidebar-thumb">
                    <div style="min-width:0;flex:1;">
                        <div class="dp-sidebar-product-name text-truncate">{{ $parentProduct->name }}</div>
                        @if($productCategory)
                            <span class="dp-sidebar-cat"><i class="fa fa-tag"></i>{{ $productCategory->categories->name }}</span>
                        @endif
                        <div class="dp-sidebar-stars">
                            @for($i=0;$i<5;$i++)<i class="fa fa-star{{ $i < $ratingVal ? '' : '-o' }}"></i>@endfor
                            <small class="text-muted ms-1" style="font-size:.68rem;">({{ $reviewCount }})</small>
                        </div>
                    </div>
                </div>

                {{-- Price --}}
                <div class="dp-sidebar-price-box">
                    <div class="dp-sidebar-price-label"><i class="fa fa-wallet"></i> Harga</div>
                    <div class="d-flex align-items-baseline gap-2 flex-wrap">
                        <div id="price-display">
                            @if($priceRange && !$priceRange['same'])
                                Rp {{ number_format($priceRange['min'],0,',','.') }} – {{ number_format($priceRange['max'],0,',','.') }}
                            @elseif($priceRange)
                                Rp {{ number_format($priceRange['min'],0,',','.') }}
                            @else
                                Rp {{ number_format($parentProduct->price,0,',','.') }}
                            @endif
                        </div>
                        @if($parentProduct->original_price && $parentProduct->original_price > $parentProduct->price)
                            <div class="text-muted text-decoration-line-through" style="font-size:.78rem;">Rp {{ number_format($parentProduct->original_price,0,',','.') }}</div>
                            <span class="badge bg-danger rounded-pill" style="font-size:.58rem;">{{ round((($parentProduct->original_price-$parentProduct->price)/$parentProduct->original_price)*100) }}% Off</span>
                        @endif
                    </div>
                </div>

                {{-- Meta grid --}}
                <div class="dp-sidebar-meta">
                    <div class="dp-sidebar-meta-item">
                        <small><i class="fas fa-barcode me-1"></i>SKU</small>
                        <div class="dp-meta-val" title="{{ $parentProduct->sku ?? 'N/A' }}">{{ $parentProduct->sku ?? 'N/A' }}</div>
                    </div>
                    <div class="dp-sidebar-meta-item">
                        <small><i class="fas fa-cube me-1"></i>Status</small>
                        <div id="stock-info" class="dp-meta-val {{ $stockQty > 0 ? 'stock-highlight-avail' : 'stock-highlight-empty' }}">
                            @if($stockQty)
                                <i class="fas fa-check-circle"></i> Stok: {{ $stockQty }}
                            @else
                                <i class="fas fa-exclamation-circle"></i> Habis
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Shipping --}}
                <div class="dp-ship-row mb-3">
                    <div>
                        <div class="dp-ship-label"><i class="fas fa-truck me-1"></i>Pengiriman</div>
                        <div class="dp-ship-val">3-5 hari kerja</div>
                    </div>
                    <div class="dp-ship-courier">JNE / J&T / SiCepat</div>
                </div>

                <input type="hidden" id="selected-variant-id" value="">

                {{-- Dynamic Checkout Section --}}
                <div class="sidebar-checkout-section mt-3">
                    {{-- Row 1: Quantity and Subtotal Side-by-Side --}}
                    <div class="d-flex align-items-center justify-content-between mb-3 gap-2">
                        <div>
                            <div class="dp-sidebar-qty-label mb-1" style="font-size: .68rem; text-transform: uppercase; color: var(--c-muted); font-weight: 700; letter-spacing: 0.05em;"><i class="fas fa-layer-group me-1 opacity-60"></i>Kuantitas</div>
                            
                            <div class="swap-container" style="min-width: 110px; min-height: 38px;">
                                {{-- Standard Quantity Selector (If NOT in Cart) --}}
                                <div class="qty-counter-wrapper swap-item" id="sidebar-qty-counter-normal">
                                    <div class="qty-counter" style="border: 1px solid var(--c-border); border-radius: 10px; background: var(--c-bg); padding: 2px;">
                                        <button type="button" class="qty-btn" style="width: 32px; height: 32px; border-radius: 8px; border: none; background: #fff;"
                                                onclick="var q=document.getElementById('quantity'),v=parseInt(q.value)||1,m=parseInt(q.min)||1;if(v>m){q.value=v-1;q.dispatchEvent(new Event('input'));}"
                                                aria-label="Kurangi">
                                            <i class="fas fa-minus" style="font-size:.65rem;"></i>
                                        </button>
                                        <input type="number" class="form-control" id="quantity" value="1" min="1" readonly style="width: 36px; font-weight: 800; font-size: .85rem; text-align: center;">
                                        <button type="button" class="qty-btn" style="width: 32px; height: 32px; border-radius: 8px; border: none; background: #fff;"
                                                onclick="var q=document.getElementById('quantity'),v=parseInt(q.value)||1,mx=parseInt(q.max)||9999;if(v<mx){q.value=v+1;q.dispatchEvent(new Event('input'));}"
                                                aria-label="Tambah">
                                            <i class="fas fa-plus" style="font-size:.65rem;"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- Cart Quantity Modifier (If IS in Cart) --}}
                                <div class="cart-modifier-widget desktop-cart-modifier swap-item hidden-state" style="display: flex; align-items: center; justify-content: space-between; background: var(--c-soft); padding: 2px; border-radius: 10px; border: 1.5px solid var(--c-mid); height: 38px; width: 110px;">
                                    <button type="button" class="btn-dp-primary qty-down-btn" style="width: 32px; height: 32px; padding: 0; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: #e11d48 !important; box-shadow: none; flex-shrink: 0; border: none;">
                                        <i class="fa fa-trash" style="font-size: .7rem;"></i>
                                    </button>
                                    <span class="cart-qty-display" style="font-weight: 800; font-size: .95rem; color: var(--c-primary); width: 36px; text-align: center;">1</span>
                                    <button type="button" class="btn-dp-primary qty-up-btn" style="width: 32px; height: 32px; padding: 0; border-radius: 8px; display: flex; align-items: center; justify-content: center; box-shadow: none; flex-shrink: 0; border: none;">
                                        <i class="fa fa-plus" style="font-size: .7rem;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Right Side: Subtotal Display --}}
                        <div class="text-end">
                            <div class="dp-sidebar-qty-label mb-1" style="font-size: .68rem; text-transform: uppercase; color: var(--c-muted); font-weight: 700; letter-spacing: 0.05em;"><i class="fas fa-coins me-1 opacity-60"></i>Subtotal</div>
                            <div id="subtotal-display" style="font-weight: 900; font-size: 1.2rem; color: var(--c-primary); letter-spacing: -.02em;">Rp 0</div>
                        </div>
                    </div>

                    {{-- Row 2: Action Button --}}
                    <div class="cta-btn-wrapper swap-container w-100" style="min-height: 48px;">
                        {{-- Add to Cart Button (If NOT in Cart) --}}
                        <button class="btn-dp-primary add-to-cart-btn w-100 swap-item"
                                data-product-id="{{ $parentProduct->id }}"
                                data-product-type="{{ $parentProduct->type }}"
                                data-product-slug="{{ $parentProduct->slug }}"
                                @if($parentProduct->type == 'configurable' && $variants->count() > 0) disabled @endif>
                            <i class="fa fa-shopping-bag"></i>
                            <span class="cta-text">
                                @if($parentProduct->type == 'configurable' && $variants->count() > 0)
                                    Pilih Varian Dulu
                                @else
                                    Tambah ke Keranjang
                                @endif
                            </span>
                        </button>

                        {{-- Go to Cart / Checkout Button (If IS in Cart) --}}
                        <a href="{{ route('carts.index') }}" class="btn-dp-secondary go-to-cart-btn w-100 swap-item hidden-state" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 700; font-size: .9rem; padding: 14px 20px; border-radius: 13px; text-decoration: none; border: 1.5px solid var(--c-primary); color: var(--c-primary); background: #fff; box-shadow: var(--shadow-sm); transition: all var(--t); margin-bottom: 0;">
                            <i class="fas fa-shopping-cart"></i> Lihat Keranjang / Checkout
                        </a>
                    </div>
                </div>

                {{-- Share --}}
                <div class="dp-share">
                    <span class="dp-share-label">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="dp-share-btn dp-share-fb" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($parentProduct->name) }}" target="_blank" rel="noopener" class="dp-share-btn dp-share-tw" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://wa.me/?text={{ urlencode($parentProduct->name.' - '.url()->current()) }}" target="_blank" rel="noopener" class="dp-share-btn dp-share-wa" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>

                {{-- Trust --}}
                <div class="dp-trust">
                    <div class="dp-trust-item"><i class="fas fa-shield-alt"></i><span>Bayar Aman</span></div>
                    <div class="dp-trust-item"><i class="fas fa-truck"></i><span>Kirim Cepat</span></div>
                    <div class="dp-trust-item"><i class="fas fa-headset"></i><span>CS 24/7</span></div>
                    <div class="dp-trust-item"><i class="fas fa-undo"></i><span>Garansi</span></div>
                </div>

            </div>
        </div>
    </div>{{-- end sidebar col --}}

</div>{{-- end dp-grid --}}
</div>{{-- end container --}}
</div>{{-- end dp-page --}}

{{-- ════════════════════════════════════════════
     MOBILE STICKY BOTTOM BAR
     ════════════════════════════════════════════ --}}
<div class="dp-mobile-bar d-md-none" id="mobile-action-bar">
    <div class="dp-mobile-bar-inner">
        <button type="button" class="dp-mobile-chat" id="mobile-chat-btn" title="Tanya Penjual">
            <i class="far fa-comment-dots"></i>
        </button>
        <div class="dp-mobile-info">
            <div class="dp-mobile-price" id="mobile-price-display">
                @if($priceRange && !$priceRange['same'])
                    Rp {{ number_format($priceRange['min'],0,',','.') }} – {{ number_format($priceRange['max'],0,',','.') }}
                @elseif($priceRange)
                    Rp {{ number_format($priceRange['min'],0,',','.') }}
                @else
                    Rp {{ number_format($parentProduct->price,0,',','.') }}
                @endif
            </div>
            <div class="dp-mobile-variant" id="mobile-variant-preview">Pilih Varian Produk</div>
        </div>
        <div class="mobile-sticky-cta-wrapper swap-container" style="flex-grow: 1; min-width: 120px; min-height: 46px;">
            <button type="button" class="btn-dp-primary dp-mobile-cta swap-item" id="add-to-cart-mobile" style="width: 100%;">
                <i class="fa fa-shopping-bag"></i>+ Keranjang
            </button>
            <div class="cart-modifier-widget mobile-sticky-cart-modifier swap-item hidden-state" style="display: flex; align-items: center; justify-content: space-between; background: var(--c-soft); padding: 2px; border-radius: 13px; border: 1.5px solid var(--c-mid); height: 46px; width: 100%;">
                <button type="button" class="btn-dp-primary qty-down-btn" style="width: 40px; height: 40px; padding: 0; border-radius: 10.5px; display: flex; align-items: center; justify-content: center; background: #e11d48 !important; box-shadow: none; flex-shrink: 0; border: none;">
                    <i class="fa fa-trash" style="font-size: .8rem;"></i>
                </button>
                <span class="cart-qty-display" style="font-weight: 800; font-size: 1.05rem; color: var(--c-primary); flex-grow: 1; text-align: center;">1</span>
                <button type="button" class="btn-dp-primary qty-up-btn" style="width: 40px; height: 40px; padding: 0; border-radius: 10.5px; display: flex; align-items: center; justify-content: center; box-shadow: none; flex-shrink: 0; border: none;">
                    <i class="fa fa-plus" style="font-size: .8rem;"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@php
    $cartItemsData = collect(Cart::content())->map(function($item) {
        return [
            'rowId' => $item->rowId,
            'id' => $item->id,
            'qty' => $item->qty,
            'product_id' => $item->options->product_id,
            'variant_id' => $item->options->variant_id,
            'type' => $item->options->type,
        ];
    })->values();
@endphp

<script>
document.addEventListener('DOMContentLoaded', function() {
    let cartItems = @json($cartItemsData);
    const parentProductId = @json($parentProduct->id);
    const productType = @json($parentProduct->type);

    /* ── ELEMENT REFS ────────────────────────────────────────── */
    const addToCartBtn          = document.querySelector('.add-to-cart-btn');
    const priceDisplay          = document.getElementById('price-display');
    const mainPriceDisplay      = document.getElementById('main-price-display');
    const mainPriceDisplayVar   = document.getElementById('main-price-display-variant');
    const stockElement          = document.getElementById('stock-info');
    const mainStockElement      = document.getElementById('main-stock-info');
    const variantInfo           = document.getElementById('variant-info');
    const selectionMessage      = document.getElementById('selection-message');
    const variantName           = document.getElementById('variant-name');
    const variantAttributes     = document.getElementById('variant-attributes');
    const variantSku            = document.getElementById('variant-sku');
    const variantStock          = document.getElementById('variant-stock');
    const variantWeight         = document.getElementById('variant-weight');
    const selectedVariantId     = document.getElementById('selected-variant-id');
    const quantityInput         = document.getElementById('quantity');
    const mobilePageQtyInput    = document.getElementById('quantity-mobile-page');
    const mobileBar             = document.getElementById('mobile-action-bar');
    const mobileAddBtn          = document.getElementById('add-to-cart-mobile');
    const mobileChatBtn         = document.getElementById('mobile-chat-btn');
    const mobilePriceDisplay    = document.getElementById('mobile-price-display');
    const mobileVariantPreview  = document.getElementById('mobile-variant-preview');
    const mobilePageAddBtn      = document.querySelector('.add-to-cart-btn-mobile-page');

    let selectedAttributes  = {};
    let allVariants         = @json($variants && $variants->count() > 0 ? $variants->values() : []);
    let availableOptions    = @json($variantOptions ?? []);

    /* ── VARIANT SYSTEM ─────────────────────────────────────── */
    function initVariants() {
        if (@json($parentProduct->type) === 'simple') {
            if (addToCartBtn) addToCartBtn.disabled = false;
            const mb = document.querySelector('.add-to-cart-btn-mobile-page');
            if (mb) mb.disabled = false;
            if (selectionMessage) selectionMessage.style.display = 'none';
            return;
        }
        updateOptions();
    }

    function updateOptions() {
        const possible = filterVariants();
        const avail = extractOptions(possible);
        Object.keys(availableOptions).forEach(attr => {
            document.querySelectorAll(`[data-attribute="${attr}"]`).forEach(btn => {
                if (!btn.classList.contains('variant-option')) return;
                const val = btn.dataset.value;
                const isAvail = avail[attr]?.includes(val);
                const isSel   = selectedAttributes[attr] === val;
                btn.disabled  = !isAvail && !isSel;
                btn.classList.toggle('btn-outline-secondary', !isSel && isAvail);
                btn.classList.toggle('btn-primary', isSel);
                btn.classList.toggle('btn-outline-danger', !isAvail && !isSel);
                btn.title = (!isAvail && !isSel) ? 'Tidak tersedia untuk kombinasi ini' : '';
            });
        });
        updatePriceRange(possible);
        updateCartButton();
    }

    function filterVariants() {
        return allVariants.filter(v =>
            Object.entries(selectedAttributes).every(([k, val]) =>
                v.variant_attributes.some(a => a.attribute_name === k && a.attribute_value === val)
            )
        );
    }

    function extractOptions(variants) {
        const opts = {};
        Object.keys(availableOptions).forEach(attr => {
            opts[attr] = [...new Set(
                variants.flatMap(v => v.variant_attributes.filter(a => a.attribute_name === attr).map(a => a.attribute_value))
            )];
        });
        return opts;
    }

    function fmtPrice(n) { return 'Rp ' + new Intl.NumberFormat('id-ID').format(n); }

    function setAllPrices(str) {
        if (priceDisplay) priceDisplay.textContent = str;
        if (mainPriceDisplay) mainPriceDisplay.textContent = str;
        if (mainPriceDisplayVar) mainPriceDisplayVar.textContent = str;
        if (mobilePriceDisplay) mobilePriceDisplay.textContent = str;
    }

    function updatePriceRange(variants) {
        if (!variants.length) { setAllPrices('Kombinasi tidak tersedia'); resetVariant(); return; }
        const exact = findExact();
        if (exact) { setAllPrices(fmtPrice(exact.price)); showVariant(exact); }
        else if (variants.length === 1) { setAllPrices(fmtPrice(variants[0].price)); showVariant(variants[0]); }
        else {
            const min = Math.min(...variants.map(v => v.price));
            const max = Math.max(...variants.map(v => v.price));
            setAllPrices(min === max ? fmtPrice(min) : fmtPrice(min) + ' – ' + fmtPrice(max));
            resetVariant();
        }
    }

    function updateStockDisplay(qty) {
        if (mainStockElement) {
            if (qty > 0) {
                mainStockElement.className = 'stock-highlight-avail';
                mainStockElement.innerHTML = `<i class="fas fa-check-circle"></i> Stok ${qty} unit tersedia`;
            } else {
                mainStockElement.className = 'stock-highlight-empty';
                mainStockElement.innerHTML = `<i class="fas fa-exclamation-circle"></i> Out of Stock`;
            }
        }
        if (stockElement) {
            if (qty > 0) {
                stockElement.className = 'dp-meta-val stock-highlight-avail';
                stockElement.innerHTML = `<i class="fas fa-check-circle"></i> Stok: ${qty}`;
            } else {
                stockElement.className = 'dp-meta-val stock-highlight-empty';
                stockElement.innerHTML = `<i class="fas fa-exclamation-circle"></i> Habis`;
            }
        }
    }

    function showVariant(v) {
        if (variantName) variantName.textContent = v.name;
        if (variantSku) variantSku.textContent = v.sku;
        if (variantStock) variantStock.textContent = v.stock;
        if (variantWeight) variantWeight.textContent = v.weight || 0;
        if (variantAttributes) variantAttributes.textContent = v.variant_attributes.map(a => a.attribute_name+': '+a.attribute_value).join(', ');
        if (selectedVariantId) selectedVariantId.value = v.id;
        if (quantityInput) quantityInput.max = v.stock;
        if (mobilePageQtyInput) mobilePageQtyInput.max = v.stock;
        if (variantInfo) variantInfo.style.display = 'block';
        if (selectionMessage) selectionMessage.style.display = 'none';
        updateStockDisplay(v.stock);
        if (mobileVariantPreview) { mobileVariantPreview.textContent = 'Varian: ' + v.name; mobileVariantPreview.style.color = 'var(--c-primary)'; }
        syncCartWidgets();
    }

    function resetVariant() {
        if (selectedVariantId) selectedVariantId.value = '';
        if (variantInfo) variantInfo.style.display = 'none';
        if (selectionMessage) selectionMessage.style.display = 'flex';
        const dq = @json($parentProduct->productInventory ? $parentProduct->productInventory->qty : 0);
        updateStockDisplay(dq);
        if (mobileVariantPreview) { mobileVariantPreview.textContent = 'Pilih Varian Produk'; mobileVariantPreview.style.color = ''; }
        syncCartWidgets();
    }

    function updateCartButton() {
        const hasV = @json($parentProduct->type) === 'configurable' && @json($variants->count()) > 0;
        const mb   = document.querySelector('.add-to-cart-btn-mobile-page');
        const suc  = '<i class="fa fa-shopping-bag"></i><span class="cta-text">Tambah ke Keranjang</span>';
        const sel  = '<i class="fa fa-info-circle"></i><span class="cta-text">Pilih Varian Dulu</span>';
        const err  = '<i class="fa fa-exclamation-triangle"></i><span class="cta-text">Kombinasi Tidak Ada</span>';

        if (!hasV) {
            if (addToCartBtn) { addToCartBtn.disabled = false; addToCartBtn.innerHTML = suc; addToCartBtn.classList.remove('btn-secondary'); }
            if (mb) { mb.disabled = false; mb.innerHTML = suc; mb.classList.remove('btn-secondary'); }
            if (mobileAddBtn) { mobileAddBtn.disabled = false; mobileAddBtn.innerHTML = '<i class="fa fa-shopping-bag"></i>+ Keranjang'; mobileAddBtn.classList.remove('btn-secondary'); }
            return;
        }

        const exact = findExact();
        const cnt   = Object.keys(selectedAttributes).length;

        if (exact) {
            if (addToCartBtn) { addToCartBtn.disabled = false; addToCartBtn.innerHTML = suc; addToCartBtn.classList.remove('btn-secondary'); }
            if (mb) { mb.disabled = false; mb.innerHTML = suc; mb.classList.remove('btn-secondary'); }
            if (mobileAddBtn) { mobileAddBtn.disabled = false; mobileAddBtn.innerHTML = '<i class="fa fa-shopping-bag"></i>+ Keranjang'; mobileAddBtn.classList.remove('btn-secondary'); }
        } else if (cnt === 0) {
            if (addToCartBtn) { addToCartBtn.disabled = true; addToCartBtn.innerHTML = sel; addToCartBtn.classList.add('btn-secondary'); }
            if (mb) { mb.disabled = true; mb.innerHTML = sel; mb.classList.add('btn-secondary'); }
            if (mobileAddBtn) { mobileAddBtn.disabled = false; mobileAddBtn.innerHTML = '<i class="fa fa-info-circle"></i>Pilih Varian'; mobileAddBtn.classList.add('btn-secondary'); }
        } else {
            if (addToCartBtn) { addToCartBtn.disabled = true; addToCartBtn.innerHTML = err; addToCartBtn.classList.add('btn-secondary'); }
            if (mb) { mb.disabled = true; mb.innerHTML = err; mb.classList.add('btn-secondary'); }
            if (mobileAddBtn) { mobileAddBtn.disabled = false; mobileAddBtn.innerHTML = '<i class="fa fa-times-circle"></i>Tidak Tersedia'; mobileAddBtn.classList.add('btn-secondary'); }
        }
    }

       function showWidget(el) {
        if (!el) return;
        el.classList.remove('hidden-state');
    }

    function hideWidget(el) {
        if (!el) return;
        el.classList.add('hidden-state');
    }

    function doAddToCart(qty) {
        console.log('[Cart] doAddToCart called with qty:', qty);
        const originalHtmls = [];
        const btns = [addToCartBtn, mobilePageAddBtn, mobileAddBtn].filter(Boolean);
        btns.forEach(btn => {
            originalHtmls.push({ btn: btn, html: btn.innerHTML });
            btn.disabled = true;
            btn.innerHTML = `<span class="btn-spinner"></span> Menambahkan...`;
        });

        fetch('{{ route("carts.store") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({
                product_id: @json($parentProduct->id),
                qty: qty,
                variant_id: selectedVariantId ? selectedVariantId.value || null : null,
                _token: '{{ csrf_token() }}'
            })
        })
        .then(r => r.json())
        .then(d => {
            console.log('[Cart] doAddToCart response:', d);
            // Restore buttons
            btns.forEach(btn => {
                const found = originalHtmls.find(o => o.btn === btn);
                if (found) { btn.innerHTML = found.html; btn.disabled = false; }
            });

            if (d.status === 'success') {
                // Update local state and trigger transition
                cartItems = d.cart_items || cartItems;
                syncCartWidgets();

                // Update badge counts in header with pop animation
                document.querySelectorAll('.site-cart-badge, .site-mobile-action-badge').forEach(badge => {
                    const prevCount = parseInt(badge.textContent) || 0;
                    const newCount = d.cart_count;
                    badge.textContent = newCount;
                    if (prevCount !== newCount) {
                        badge.classList.add('badge-pop');
                        setTimeout(() => badge.classList.remove('badge-pop'), 400);
                    }
                });

                // Show success Swal
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Produk berhasil ditambahkan ke keranjang belanja.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    showClass: { popup: 'swal-custom-show' },
                    hideClass: { popup: 'swal-custom-hide' }
                });
            } else {
                Swal.fire({
                    title: 'Gagal',
                    text: d.message || 'Gagal menambahkan produk ke keranjang',
                    icon: 'error',
                    confirmButtonColor: '#0d4f30',
                    showClass: { popup: 'swal-custom-show' },
                    hideClass: { popup: 'swal-custom-hide' }
                });
            }
        })
        .catch(err => {
            console.error('[Cart] doAddToCart error:', err);
            // Restore buttons
            btns.forEach(btn => {
                const found = originalHtmls.find(o => o.btn === btn);
                if (found) { btn.innerHTML = found.html; btn.disabled = false; }
            });

            Swal.fire({
                title: 'Error',
                text: 'Terjadi kesalahan sistem. Silakan coba kembali.',
                icon: 'error',
                confirmButtonColor: '#0d4f30',
                showClass: { popup: 'swal-custom-show' },
                hideClass: { popup: 'swal-custom-hide' }
            });
        });
    }

    /* ── ADD TO CART CLICK HANDLERS ─────────────────────────── */
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (this.disabled) return;
            
            if (productType === 'configurable' && !selectedVariantId.value) {
                Swal.fire({
                    title: 'Pilih Varian',
                    text: 'Silakan pilih varian produk terlebih dahulu.',
                    icon: 'warning',
                    confirmButtonColor: '#0d4f30',
                    showClass: { popup: 'swal-custom-show' },
                    hideClass: { popup: 'swal-custom-hide' }
                });
                return;
            }
            
            const qty = parseInt(quantityInput.value) || 1;
            doAddToCart(qty);
        });
    }

    if (mobilePageAddBtn) {
        mobilePageAddBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (this.disabled) return;
            
            if (productType === 'configurable' && !selectedVariantId.value) {
                Swal.fire({
                    title: 'Pilih Varian',
                    text: 'Silakan pilih varian produk terlebih dahulu.',
                    icon: 'warning',
                    confirmButtonColor: '#0d4f30',
                    showClass: { popup: 'swal-custom-show' },
                    hideClass: { popup: 'swal-custom-hide' }
                });
                return;
            }
            
            const qty = parseInt(mobilePageQtyInput.value) || 1;
            doAddToCart(qty);
        });
    }

    if (mobileAddBtn) {
        mobileAddBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (this.disabled) return;
            
            if (productType === 'configurable' && !selectedVariantId.value) {
                Swal.fire({
                    title: 'Pilih Varian',
                    text: 'Silakan pilih varian produk terlebih dahulu.',
                    icon: 'warning',
                    confirmButtonColor: '#0d4f30',
                    showClass: { popup: 'swal-custom-show' },
                    hideClass: { popup: 'swal-custom-hide' }
                }).then(() => {
                    const selector = document.querySelector('.dp-variants-card') || document.querySelector('#variant-info') || document.querySelector('.dp-price-range');
                    if (selector) {
                        selector.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        const varCard = document.querySelector('.dp-variants-card');
                        if (varCard) {
                            varCard.classList.add('pulse-highlight');
                            setTimeout(() => varCard.classList.remove('pulse-highlight'), 3000);
                        }
                    }
                });
                return;
            }
            
            const qty = parseInt(mobilePageQtyInput?.value || quantityInput?.value || 1);
            doAddToCart(qty);
        });
    }

    /* ── MOBILE CHAT ────────────────────────────────────────── */
    if (mobileChatBtn) {
        mobileChatBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const t = document.getElementById('ai-widget-toggle');
            if (t) t.click();
            else window.open('https://wa.me/6281234567890?text=' + encodeURIComponent('Halo Viviashop, saya ingin bertanya tentang: ' + @json($parentProduct->name) + ' (' + window.location.href + ')'), '_blank');
        });
    }

    /* ── GALLERY THUMB SYNC ─────────────────────────────────── */
    const carEl = document.getElementById('carouselExampleIndicators');
    if (carEl) {
        carEl.addEventListener('slid.bs.carousel', function(e) {
            document.querySelectorAll('.dp-thumb').forEach((t, i) => t.classList.toggle('active', i === e.to));
        });
    }

    /* ── QTY SYNC ───────────────────────────────────────────── */
    const qtyInputs = [quantityInput, mobilePageQtyInput].filter(Boolean);
    qtyInputs.forEach(inp => {
        inp.addEventListener('input', function() {
            const v = this.value;
            console.log('[Cart] Qty input changed to:', v);
            qtyInputs.forEach(o => { if (o !== inp) o.value = v; });
            const itemInCart = cartItems.find(item => {
                const activeVariantId = (productType === 'configurable') ? (selectedVariantId ? selectedVariantId.value : null) : null;
                if (productType === 'configurable') {
                    return item.product_id == parentProductId && item.variant_id == activeVariantId;
                } else {
                    return item.product_id == parentProductId && !item.variant_id;
                }
            });
            if (!itemInCart) {
                updateSubtotals(parseInt(v) || 1);
            }
        });
    });

    /* ── MOBILE STICKY BAR VISIBILITY ──────────────────────── */
    function stickyVis() {
        if (!mobileBar) return;
        if (window.innerWidth <= 767) {
            if (window.scrollY > 140) { mobileBar.classList.add('visible'); document.body.classList.add('dp-mobile-bar-active'); }
            else { mobileBar.classList.remove('visible'); document.body.classList.remove('dp-mobile-bar-active'); }
        } else { mobileBar.classList.remove('visible'); document.body.classList.remove('dp-mobile-bar-active'); }
    }
    window.addEventListener('scroll', stickyVis, { passive: true });
    window.addEventListener('resize', stickyVis, { passive: true });
    stickyVis();

    /* ── DESKTOP STICKY SIDEBAR ─────────────────────────────── */
    function adjustSidebarTop() {
        try {
            const sb = document.querySelector('.dp-sidebar');
            if (!sb || window.innerWidth <= 991) { if (sb) sb.style.top = ''; return; }
            const nav = document.querySelector('[data-site-header]') || document.querySelector('.navbar') || document.querySelector('header');
            let off = 116;
            if (nav) { const r = nav.getBoundingClientRect(); off = Math.max(108, Math.round(r.bottom + 14)); }
            sb.style.top = off + 'px';
        } catch(e) {}
    }
    window.addEventListener('load', adjustSidebarTop);
    window.addEventListener('resize', () => setTimeout(adjustSidebarTop, 100));
    [300, 600, 1000].forEach(t => setTimeout(adjustSidebarTop, t));

    /* ── CUSTOM TABS ─────────────────────────────────────────── */
    document.querySelectorAll('.dp-tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.dp-tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.dp-tab-pane').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            const target = document.getElementById(this.dataset.tab);
            if (target) target.classList.add('active');
        });
    });

    function getCurrentPrice() {
        if (productType === 'configurable') {
            const exact = findExact();
            return exact ? exact.price : null;
        } else {
            return @json($parentProduct->price);
        }
    }

    function updateSubtotals(qty) {
        const price = getCurrentPrice();
        const subtotal = price ? price * qty : 0;
        const formatted = subtotal ? fmtPrice(subtotal) : 'Rp 0';
        
        const subDisplays = document.querySelectorAll('#subtotal-display, .mobile-subtotal-display');
        subDisplays.forEach(el => {
            el.textContent = formatted;
        });

        const mobilePriceEl = document.getElementById('mobile-price-display');
        if (mobilePriceEl) {
            const activeVariantId = (productType === 'configurable') ? (selectedVariantId ? selectedVariantId.value : null) : null;
            const matchingItem = cartItems.find(item => {
                if (productType === 'configurable') {
                    return item.product_id == parentProductId && item.variant_id == activeVariantId;
                } else {
                    return item.product_id == parentProductId && !item.variant_id;
                }
            });
            
            if (matchingItem && subtotal) {
                mobilePriceEl.innerHTML = `<span style="font-size: .62rem; display: block; text-transform: uppercase; color: var(--c-muted); font-weight: 700; letter-spacing: 0.05em; margin-bottom: 2px; line-height: 1;">Subtotal</span>${formatted}`;
            } else {
                if (productType === 'configurable' && activeVariantId) {
                    const exact = findExact();
                    if (exact) mobilePriceEl.textContent = fmtPrice(exact.price);
                } else {
                    mobilePriceEl.textContent = fmtPrice(@json($parentProduct->price));
                }
            }
        }
    }

    function syncCartWidgets() {
        let activeVariantId = null;
        if (productType === 'configurable') {
            activeVariantId = selectedVariantId ? selectedVariantId.value : null;
        }
        console.log('[Cart] syncCartWidgets activeVariantId:', activeVariantId);

        const isConfigurableAndUnselected = (productType === 'configurable' && !activeVariantId);

        if (isConfigurableAndUnselected) {
            document.querySelectorAll('#sidebar-qty-counter-normal, #mobile-page-qty-counter-normal').forEach(el => showWidget(el));
            document.querySelectorAll('.cart-modifier-widget').forEach(w => hideWidget(w));
            document.querySelectorAll('.go-to-cart-btn').forEach(btn => hideWidget(btn));
            
            if (addToCartBtn) { showWidget(addToCartBtn); addToCartBtn.disabled = true; }
            if (mobilePageAddBtn) { showWidget(mobilePageAddBtn); mobilePageAddBtn.disabled = true; }
            if (mobileAddBtn) { showWidget(mobileAddBtn); mobileAddBtn.disabled = true; }
            
            updateSubtotals(0);
            return;
        }

        const matchingItem = cartItems.find(item => {
            if (productType === 'configurable') {
                return item.product_id == parentProductId && item.variant_id == activeVariantId;
            } else {
                return item.product_id == parentProductId && !item.variant_id;
            }
        });
        console.log('[Cart] syncCartWidgets matchingItem:', matchingItem);

        if (matchingItem) {
            document.querySelectorAll('#sidebar-qty-counter-normal, #mobile-page-qty-counter-normal').forEach(el => hideWidget(el));
            document.querySelectorAll('.cart-modifier-widget').forEach(widget => {
                showWidget(widget);
                widget.setAttribute('data-row-id', matchingItem.rowId);
                widget.setAttribute('data-qty', matchingItem.qty);

                const qtyDisplay = widget.querySelector('.cart-qty-display');
                if (qtyDisplay) qtyDisplay.textContent = matchingItem.qty;

                const downBtn = widget.querySelector('.qty-down-btn');
                if (downBtn) {
                    if (matchingItem.qty === 1) {
                        downBtn.innerHTML = '<i class="fa fa-trash"></i>';
                        downBtn.classList.add('btn-danger-custom');
                    } else {
                        downBtn.innerHTML = '<i class="fa fa-minus"></i>';
                        downBtn.classList.remove('btn-danger-custom');
                    }
                }
            });

            if (addToCartBtn) hideWidget(addToCartBtn);
            if (mobilePageAddBtn) hideWidget(mobilePageAddBtn);
            if (mobileAddBtn) hideWidget(mobileAddBtn);
            document.querySelectorAll('.go-to-cart-btn').forEach(btn => showWidget(btn));

            updateSubtotals(matchingItem.qty);
        } else {
            document.querySelectorAll('#sidebar-qty-counter-normal, #mobile-page-qty-counter-normal').forEach(el => showWidget(el));
            document.querySelectorAll('.cart-modifier-widget').forEach(w => hideWidget(w));
            
            if (addToCartBtn) { showWidget(addToCartBtn); addToCartBtn.disabled = false; }
            if (mobilePageAddBtn) { showWidget(mobilePageAddBtn); mobilePageAddBtn.disabled = false; }
            if (mobileAddBtn) { showWidget(mobileAddBtn); mobileAddBtn.disabled = false; }
            document.querySelectorAll('.go-to-cart-btn').forEach(btn => hideWidget(btn));

            const qtyInput = document.getElementById('quantity');
            const normalQty = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
            updateSubtotals(normalQty);
        }
    }

    document.querySelectorAll('.cart-modifier-widget .qty-up-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('[Cart] Qty UP clicked');
            const widget = this.closest('.cart-modifier-widget');
            const rowId = widget.getAttribute('data-row-id');
            const currentQty = parseInt(widget.getAttribute('data-qty')) || 1;
            console.log('[Cart] Qty UP state:', { rowId, currentQty });
            
            let maxStock = 9999;
            if (productType === 'configurable') {
                const exact = findExact();
                if (exact) maxStock = exact.stock;
            } else {
                maxStock = @json($parentProduct->productInventory ? $parentProduct->productInventory->qty : 0);
            }

            const newQty = currentQty + 1;
            if (newQty > maxStock) {
                Swal.fire({
                    title: 'Stok Terbatas',
                    text: `Batas stok tersedia: ${maxStock} unit.`,
                    icon: 'warning',
                    confirmButtonColor: '#0d4f30',
                    showClass: { popup: 'swal-custom-show' },
                    hideClass: { popup: 'swal-custom-hide' }
                });
                return;
            }

            updateCartQuantity(rowId, newQty);
        });
    });

    document.querySelectorAll('.cart-modifier-widget .qty-down-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('[Cart] Qty DOWN clicked');
            const widget = this.closest('.cart-modifier-widget');
            const rowId = widget.getAttribute('data-row-id');
            const currentQty = parseInt(widget.getAttribute('data-qty')) || 1;
            console.log('[Cart] Qty DOWN state:', { rowId, currentQty });

            if (currentQty === 1) {
                Swal.fire({
                    title: 'Hapus Barang?',
                    text: 'Apakah Anda yakin ingin menghapus produk ini dari keranjang belanja?',
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
                        updateCartQuantity(rowId, 0);
                    }
                });
            } else {
                updateCartQuantity(rowId, currentQty - 1);
            }
        });
    });

    function updateCartQuantity(rowId, qty) {
        console.log('[Cart] updateCartQuantity rowId:', rowId, 'new qty:', qty);
        // Optimistic UI updates
        const previousCartItems = JSON.parse(JSON.stringify(cartItems));

        const itemIndex = cartItems.findIndex(item => item.rowId === rowId);
        if (itemIndex > -1) {
            if (qty === 0) {
                cartItems.splice(itemIndex, 1);
            } else {
                cartItems[itemIndex].qty = qty;
            }
        }
        
        // Sync DOM instantly
        syncCartWidgets();

        // Perform AJAX in background
        fetch('/carts/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({
                cart_item_id: rowId,
                quantity: qty,
                _token: '{{ csrf_token() }}'
            })
        })
        .then(r => r.json())
        .then(d => {
            console.log('[Cart] updateCartQuantity response:', d);
            if (d.status === 'success') {
                // Confirm true state from server
                cartItems = d.cart_items || cartItems;
                syncCartWidgets();
                
                // Update badge counts in header
                document.querySelectorAll('.site-cart-badge, .site-mobile-action-badge').forEach(badge => {
                    const prevCount = parseInt(badge.textContent) || 0;
                    const newCount = d.cart_count;
                    badge.textContent = newCount;
                    if (prevCount !== newCount) {
                        badge.classList.add('badge-pop');
                        setTimeout(() => badge.classList.remove('badge-pop'), 400);
                    }
                });
            } else {
                // Revert state
                cartItems = previousCartItems;
                syncCartWidgets();
                Swal.fire({
                    title: 'Gagal',
                    text: d.message || 'Gagal memperbarui kuantitas',
                    icon: 'error',
                    confirmButtonColor: '#0d4f30',
                    showClass: { popup: 'swal-custom-show' },
                    hideClass: { popup: 'swal-custom-hide' }
                });
            }
        })
        .catch(err => {
            console.error('[Cart] updateCartQuantity error:', err);
            // Revert state
            cartItems = previousCartItems;
            syncCartWidgets();
            Swal.fire({
                title: 'Error',
                text: 'Terjadi kesalahan sistem',
                icon: 'error',
                confirmButtonColor: '#0d4f30',
                showClass: { popup: 'swal-custom-show' },
                hideClass: { popup: 'swal-custom-hide' }
            });
        });
    }

    /* ── INIT ────────────────────────────────────────────────── */
    initVariants();
    syncCartWidgets();
});
</script>
@endsection
