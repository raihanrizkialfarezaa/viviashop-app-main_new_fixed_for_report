{{-- resources/views/ai/widget.blade.php
     Embeddable frontend chat widget — UC1 Shopping + UC2 Print
     v3.0 — Premium DM Sans design, fullscreen mode, per-message avatars
--}}

{{-- Load DM Sans font scoped inside widget only --}}
<link id="ai-font-dmSans" rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap">
<link id="ai-font-tabler" rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<div id="ai-chat-widget">

    {{-- ── FAB ──────────────────────────────────────────────── --}}
    <div class="ai-fab-wrap" id="ai-fab-wrap">
        <button id="ai-widget-toggle" class="ai-fab" onclick="aiWidget.toggle()" aria-label="Buka asisten AI">
            <span class="ai-fab-ring"></span>
            <i class="ti ti-message-circle ai-fab-ico-open"></i>
            <i class="ti ti-x ai-fab-ico-close" style="display:none"></i>
            <span class="ai-fab-badge" id="ai-fab-badge">1</span>
        </button>
        <span class="ai-fab-label" id="ai-fab-label">Butuh bantuan?</span>
    </div>

    {{-- ── Panel ────────────────────────────────────────────── --}}
    <div id="ai-widget-panel" class="ai-widget ai-panel-hidden">

        {{-- Header --}}
        <div class="ai-wh">
            <div class="ai-wh-top">
                <div class="ai-bot-avatar">
                    <i class="ti ti-robot"></i>
                </div>
                <div class="ai-bot-meta">
                    <div class="ai-bot-name">Asisten Viviashop</div>
                    <div class="ai-bot-sub">
                        <span class="ai-online-dot"></span>
                        <span id="ai-status-text">Online · siap membantu kamu</span>
                    </div>
                </div>
                <div class="ai-hdr-actions">
                    <button class="ai-hdr-btn" id="ai-fullscreen-btn" onclick="aiWidget.toggleFullscreen()" title="Layar penuh">
                        <i class="ti ti-arrows-maximize" id="ai-fs-ico"></i>
                    </button>
                    <button class="ai-hdr-btn" onclick="aiWidget.clearChat()" title="Hapus riwayat">
                        <i class="ti ti-trash"></i>
                    </button>
                    <button class="ai-hdr-btn ai-hdr-btn-close" onclick="aiWidget.toggle()" title="Tutup">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>

            {{-- Quick chips inside header --}}
            <div class="ai-chips-bar" id="ai-chips-bar">
                <button class="ai-w-chip" onclick="aiWidget.chipSend('Cari produk')">
                    <i class="ti ti-search"></i> Cari produk
                </button>
                <button class="ai-w-chip" onclick="aiWidget.chipSend('Layanan cetak')">
                    <i class="ti ti-printer"></i> Layanan cetak
                </button>
                <button class="ai-w-chip" onclick="aiWidget.chipSend('Cek pesanan')">
                    <i class="ti ti-truck-delivery"></i> Cek pesanan
                </button>
                <button class="ai-w-chip" onclick="aiWidget.chipSend('Promo hari ini')">
                    <i class="ti ti-tag"></i> Promo hari ini
                </button>
            </div>
        </div>

        {{-- Body / Messages --}}
        <div class="ai-wb" id="ai-wb">
            <div class="ai-date-divider" id="ai-date-divider"></div>
            <div id="ai-messages" class="ai-msgs"></div>
            <button id="ai-scroll-btn" class="ai-scroll-pill ai-hidden" onclick="aiWidget.scrollToBottom()">
                <i class="ti ti-chevron-down"></i> Pesan baru
            </button>
        </div>

        {{-- Upload area --}}
        <div id="ai-upload-area" class="ai-upload-zone ai-hidden">
            <div id="ai-dropzone" class="ai-dz">
                <i class="ti ti-cloud-upload ai-dz-ico"></i>
                <p class="ai-dz-title">Seret file ke sini</p>
                <p class="ai-dz-sub">atau <label for="ai-file-input" class="ai-dz-browse">pilih dari perangkat</label></p>
                <p class="ai-dz-hint">PDF · DOC · JPG · PNG · XLS · PPT · CSV — Maks 50 MB</p>
                <input type="file" id="ai-file-input" multiple
                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.xls,.xlsx,.ppt,.pptx,.txt,.csv"
                       style="display:none" onchange="aiWidget.handleFileSelect(event)">
            </div>
            <div id="ai-file-list" class="ai-file-chips"></div>
            <div id="ai-upload-actions" class="ai-upload-row ai-hidden">
                <button class="ai-up-btn" onclick="aiWidget.uploadFiles()">
                    <i class="ti ti-upload"></i> Unggah <span id="ai-file-count"></span> file
                </button>
                <button class="ai-up-cancel" onclick="aiWidget.clearFiles()">Batal</button>
            </div>
            <div id="ai-upload-progress" class="ai-up-prog ai-hidden">
                <div class="ai-prog-track"><div id="ai-prog-fill" class="ai-prog-fill"></div></div>
                <span id="ai-prog-text">Mengunggah…</span>
            </div>
        </div>

        {{-- Footer / Input --}}
        <div class="ai-wf">
            <div class="ai-input-box" id="ai-input-box">
                <button class="ai-ico-btn ai-ico-ghost" id="ai-attach-btn"
                        onclick="aiWidget.toggleUpload()" title="Lampirkan file" aria-label="Lampirkan file">
                    <i class="ti ti-paperclip"></i>
                </button>
                <textarea id="ai-input"
                    placeholder="Ketik pertanyaan kamu di sini…"
                    rows="1"
                    maxlength="2000"
                    onkeydown="aiWidget.handleKeyDown(event)"
                    oninput="aiWidget.autoResize(this); aiWidget.updateCharCount()"></textarea>
                <button id="ai-send-btn" class="ai-ico-btn ai-ico-send" onclick="aiWidget.send()" aria-label="Kirim pesan">
                    <i class="ti ti-send" id="ai-send-icon"></i>
                    <span id="ai-send-spinner" class="ai-spinner ai-hidden"></span>
                </button>
            </div>
            <div class="ai-wf-hint">
                <div class="ai-badges">
                    <span class="ai-badge"><i class="ti ti-shield-check"></i> Aman &amp; terenkripsi</span>
                    <span class="ai-badge"><i class="ti ti-lock"></i> HTTPS</span>
                </div>
                <span class="ai-powered">✦ Powered by Gemini</span>
            </div>
        </div>
    </div>

    {{-- Fullscreen backdrop --}}
    <div id="ai-fs-backdrop" class="ai-fs-backdrop ai-hidden" onclick="aiWidget.toggleFullscreen()"></div>
</div>

<style>
/* ═══════════════════════════════════════════════════════════
   VIVIASHOP AI WIDGET v3.0 — Premium
   Fully scoped under #ai-chat-widget
   Compatibility reset reference: #ai-chat-widget *
   ═══════════════════════════════════════════════════════════ */
:where(#ai-chat-widget),
:where(#ai-chat-widget) *,
:where(#ai-chat-widget) *::before,
:where(#ai-chat-widget) *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-font-smoothing: antialiased;
}
#ai-chat-widget {
    --dm: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    --g1: #14532d;
    --g2: #166534;
    --g3: #15803d;
    --g4: #22c55e;
    --glight: #dcfce7;
    --gborder: #bbf7d0;
    --bg: #f8faf9;
    --white: #fff;
    --text: #1c1c1c;
    --sub: #6b7280;
    --muted: #9ca3af;
    --border: #e5e7eb;
    --panel-w: 378px;
    --panel-h: 600px;
    --radius: 24px;

    position: fixed;
    bottom: 26px;
    right: 26px;
    z-index: 99999;
    font-family: var(--dm);
    font-size: 14px;
    line-height: 1.5;
}

/* ── FAB ──────────────────────────────────────────────────── */
.ai-fab-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    transition: opacity .25s ease, transform .25s cubic-bezier(.34,1.56,.64,1), visibility .25s;
}
.ai-chat-open .ai-fab-wrap {
    opacity: 0;
    visibility: hidden;
    transform: scale(0.7) translateY(15px);
    pointer-events: none;
}
.ai-fab {
    position: relative;
    width: 62px;
    height: 62px;
    border-radius: 50%;
    background: var(--g1);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: #fff;
    box-shadow: 0 8px 28px rgba(20,83,45,.45), 0 3px 10px rgba(0,0,0,.15);
    transition: transform .28s cubic-bezier(.34,1.56,.64,1), box-shadow .25s ease;
}
.ai-fab:hover {
    transform: scale(1.1);
    box-shadow: 0 14px 36px rgba(20,83,45,.55), 0 4px 14px rgba(0,0,0,.18);
}
.ai-fab-ring {
    position: absolute;
    inset: -5px;
    border-radius: 50%;
    border: 2px solid rgba(34,197,94,.35);
    animation: ai-ring 2.6s ease-in-out infinite;
}
@keyframes ai-ring {
    0%,100% { transform: scale(1);    opacity: .45; }
    50%      { transform: scale(1.14); opacity: .12; }
}
.ai-fab-badge {
    position: absolute;
    top: 1px;
    right: 1px;
    width: 19px;
    height: 19px;
    background: #f97316;
    border-radius: 50%;
    border: 2.5px solid #fff;
    font-size: 9px;
    font-weight: 700;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--dm);
    box-shadow: 0 2px 6px rgba(249,115,22,.4);
}
.ai-fab-badge.ai-hidden { display: none; }
.ai-fab-label {
    font-family: var(--dm);
    font-size: 11px;
    font-weight: 500;
    color: var(--sub);
    white-space: nowrap;
    letter-spacing: .2px;
}

/* ── Panel ────────────────────────────────────────────────── */
.ai-widget {
    position: absolute;
    bottom: 0;
    right: 0;
    width: var(--panel-w);
    height: var(--panel-h);
    border-radius: var(--radius);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    background: var(--white);
    border: 1px solid rgba(0,0,0,0.07);
    box-shadow: 0 24px 72px rgba(0,0,0,.16), 0 8px 24px rgba(0,0,0,.08);
    transform-origin: bottom right;
    transition: transform .32s cubic-bezier(.34,1.36,.64,1), opacity .22s ease;
}
.ai-panel-hidden {
    transform: scale(.6) translateY(20px);
    opacity: 0;
    pointer-events: none;
}
.ai-panel-visible {
    transform: scale(1) translateY(0);
    opacity: 1;
    pointer-events: all;
}

/* ── Fullscreen ───────────────────────────────────────────── */
.ai-widget.ai-fullscreen {
    position: fixed !important;
    top: 50% !important;
    left: 50% !important;
    right: auto !important;
    bottom: auto !important;
    transform: translate(-50%, -50%) !important;
    width: min(720px, 96vw) !important;
    height: min(88vh, 860px) !important;
    border-radius: 20px !important;
    z-index: 100001;
    animation: ai-fs-in .3s cubic-bezier(.34,1.36,.64,1) both;
}
.ai-widget.ai-fullscreen .ai-msgs {
    padding: 24px 32px !important;
    gap: 20px !important;
}
.ai-widget.ai-fullscreen .ai-wf {
    padding: 20px 32px 24px !important;
}
.ai-widget.ai-fullscreen .ai-prod-mini {
    padding: 14px 18px !important;
    gap: 16px !important;
}
.ai-widget.ai-fullscreen .ai-prod-actions {
    flex-direction: row !important;
    gap: 10px !important;
}
@keyframes ai-fs-in {
    from { transform: translate(-50%,-50%) scale(.88); opacity: .7; }
    to   { transform: translate(-50%,-50%) scale(1);   opacity: 1; }
}
.ai-fs-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.45);
    backdrop-filter: blur(4px);
    z-index: 100000;
    animation: ai-fade-in .25s ease both;
}
@keyframes ai-fade-in { from { opacity:0 } to { opacity:1 } }

/* ── Header ───────────────────────────────────────────────── */
.ai-wh {
    flex-shrink: 0;
    background: var(--g1);
    padding: 20px 20px 0;
    position: relative;
    overflow: hidden;
}
.ai-wh::after {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255,255,255,.06) 0%, transparent 70%);
    pointer-events: none;
}
.ai-wh-top {
    display: flex;
    align-items: center;
    gap: 11px;
    padding-bottom: 14px;
    position: relative;
    z-index: 1;
}
.ai-bot-avatar {
    width: 44px;
    height: 44px;
    border-radius: 14px;
    background: rgba(255,255,255,.13);
    border: 1.5px solid rgba(255,255,255,.22);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 22px;
    color: #fff;
    backdrop-filter: blur(6px);
}
.ai-bot-meta { flex: 1; min-width: 0; }
.ai-bot-name {
    font-size: 15px;
    font-weight: 600;
    color: #fff;
    line-height: 1.25;
}
.ai-bot-sub {
    font-size: 12px;
    color: rgba(255,255,255,.6);
    margin-top: 2px;
    display: flex;
    align-items: center;
    gap: 5px;
}
.ai-online-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #4ade80;
    display: inline-block;
    flex-shrink: 0;
    animation: ai-blink 2.2s ease-in-out infinite;
}
@keyframes ai-blink { 0%,100%{opacity:1} 50%{opacity:.35} }
/* Header buttons */
.ai-hdr-actions {
    display: flex;
    gap: 5px;
    flex-shrink: 0;
}
.ai-hdr-btn {
    width: 32px;
    height: 32px;
    border-radius: 10px;
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.14);
    color: rgba(255,255,255,.78);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: background .18s, color .18s, transform .15s;
    backdrop-filter: blur(4px);
}
.ai-hdr-btn:hover { background: rgba(255,255,255,.22); color: #fff; transform: scale(1.06); }
.ai-hdr-btn-close:hover { background: rgba(239,68,68,.3); border-color: rgba(239,68,68,.4); }
/* Quick chips */
.ai-chips-bar {
    display: flex;
    gap: 7px;
    overflow-x: auto;
    padding-bottom: 14px;
    scrollbar-width: none;
    position: relative;
    z-index: 1;
}
.ai-chips-bar::-webkit-scrollbar { display: none; }
.ai-w-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 13px;
    border-radius: 22px;
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.18);
    color: rgba(255,255,255,.88);
    font-family: var(--dm);
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    white-space: nowrap;
    transition: all .2s ease;
    flex-shrink: 0;
}
.ai-w-chip:hover { background: #fff; color: var(--g1); border-color: #fff; }
.ai-w-chip i { font-size: 13px; }

/* ── Body / Messages ──────────────────────────────────────── */
.ai-wb {
    flex: 1;
    background: var(--bg);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
}
.ai-date-divider {
    text-align: center;
    padding: 12px 0 4px;
    font-size: 11px;
    color: var(--muted);
    letter-spacing: .3px;
    flex-shrink: 0;
}
.ai-msgs {
    flex: 1;
    overflow-y: auto;
    padding: 16px 20px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    scroll-behavior: smooth;
}
.ai-msgs::-webkit-scrollbar { width: 4px; }
.ai-msgs::-webkit-scrollbar-track { background: transparent; }
.ai-msgs::-webkit-scrollbar-thumb { background: rgba(20,83,45,.15); border-radius: 4px; }

/* Scroll pill */
.ai-scroll-pill {
    position: absolute;
    bottom: 16px;
    left: 50%;
    transform: translateX(-50%);
    padding: 6px 16px;
    border-radius: 22px;
    background: rgba(255,255,255,.95);
    border: 1px solid var(--border);
    box-shadow: 0 4px 16px rgba(0,0,0,.1);
    color: var(--g1);
    font-family: var(--dm);
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    backdrop-filter: blur(8px);
    z-index: 5;
    white-space: nowrap;
    transition: transform .2s ease, box-shadow .2s ease;
}
.ai-scroll-pill:hover { transform: translateX(-50%) translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.14); }

/* ── Message Rows ─────────────────────────────────────────── */
.ai-msg-row {
    display: flex;
    gap: 9px;
    align-items: flex-end;
    animation: ai-msg-in .35s cubic-bezier(.34,1.36,.64,1) both;
}
.ai-msg-row--me { flex-direction: row-reverse; }
@keyframes ai-msg-in {
    from { opacity: 0; transform: translateY(12px) scale(.95); }
    to   { opacity: 1; transform: none; }
}
/* Avatars */
.ai-av {
    width: 30px;
    height: 30px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 15px;
}
.ai-av-bot {
    background: var(--glight);
    border: 1px solid var(--gborder);
    color: var(--g3);
}
.ai-av-me {
    background: var(--g1);
    font-size: 11px;
    font-weight: 700;
    color: #fff;
    font-family: var(--dm);
    letter-spacing: .3px;
}
/* Bubble container */
.ai-bbl-wrap { display: flex; flex-direction: column; max-width: 275px; }
.ai-msg-row--me .ai-bbl-wrap { align-items: flex-end; }
/* Bubbles */
.ai-bbl {
    font-family: var(--dm);
    font-size: 13.5px;
    line-height: 1.62;
    color: var(--text);
    word-break: break-word;
}
.ai-bbl-bot {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 16px 16px 16px 4px;
    padding: 10px 14px;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
}
.ai-bbl-me {
    background: var(--g1);
    border-radius: 16px 16px 4px 16px;
    padding: 10px 14px;
    color: #fff;
    box-shadow: 0 3px 12px rgba(20,83,45,.25);
}
.ai-bbl-err {
    background: #fff5f5;
    border: 1px solid rgba(220,38,38,.18);
    border-radius: 16px 16px 16px 4px;
    padding: 10px 14px;
    color: #b91c1c;
    box-shadow: 0 1px 4px rgba(0,0,0,.04);
}
.ai-bbl-time {
    font-size: 10.5px;
    color: var(--muted);
    margin-top: 4px;
    font-family: var(--dm);
}
.ai-msg-row--me .ai-bbl-time { text-align: right; }
/* System pill */
.ai-sys-pill {
    align-self: center;
    background: rgba(20,83,45,.07);
    color: var(--g1);
    border: 1px solid rgba(20,83,45,.12);
    border-radius: 22px;
    padding: 4px 14px;
    font-size: 11.5px;
    font-weight: 600;
    font-family: var(--dm);
    animation: ai-msg-in .3s ease both;
}

/* Retry button */
.ai-retry-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-top: 7px;
    padding: 5px 12px;
    background: #fff;
    border: 1px solid rgba(220,38,38,.25);
    border-radius: 8px;
    color: #dc2626;
    font-family: var(--dm);
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: background .18s;
}
.ai-retry-btn:hover { background: #fff5f5; }

/* ── Typing Indicator ─────────────────────────────────────── */
.ai-typing-row {
    display: flex;
    gap: 9px;
    align-items: flex-end;
    animation: ai-msg-in .3s ease both;
}
.ai-typing-bbl {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 16px 16px 16px 4px;
    padding: 13px 16px;
    display: flex;
    gap: 5px;
    align-items: center;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
}
.ai-tdot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--g1);
    opacity: .35;
    animation: ai-td 1.35s ease-in-out infinite;
}
.ai-tdot:nth-child(2) { animation-delay: .18s; }
.ai-tdot:nth-child(3) { animation-delay: .36s; }
@keyframes ai-td {
    0%,60%,100% { transform: translateY(0);  opacity: .35; }
    30%          { transform: translateY(-5px); opacity: .9; }
}

/* ── Markdown in bot bubbles ──────────────────────────────── */
.ai-bbl-bot p            { margin: 0 0 6px; }
.ai-bbl-bot p:last-child { margin: 0; }
.ai-bbl-bot strong  { font-weight: 700; }
.ai-bbl-bot em      { font-style: italic; }
.ai-bbl-bot del     { text-decoration: line-through; opacity: .55; }
.ai-bbl-bot a       { color: var(--g1); text-decoration: underline; text-underline-offset: 2px; }
.ai-bbl-bot code {
    background: rgba(20,83,45,.08);
    color: var(--g1);
    padding: 1px 6px;
    border-radius: 5px;
    font-family: 'SFMono-Regular', Consolas, Menlo, monospace;
    font-size: 12px;
}
.ai-bbl-bot pre {
    background: #0d1f17;
    color: #a7f3d0;
    padding: 12px 14px;
    border-radius: 12px;
    overflow-x: auto;
    margin: 8px 0;
    font-size: 12px;
    line-height: 1.65;
}
.ai-bbl-bot pre code { background: none; color: inherit; padding: 0; }
.ai-bbl-bot ul, .ai-bbl-bot ol { padding-left: 18px; margin: 5px 0; }
.ai-bbl-bot li { margin: 2px 0; }
.ai-bbl-bot h1 { font-size: 16px; font-weight: 800; margin: 8px 0 4px; }
.ai-bbl-bot h2 { font-size: 15px; font-weight: 700; margin: 7px 0 3px; }
.ai-bbl-bot h3 { font-size: 14px; font-weight: 700; margin: 6px 0 3px; }
.ai-bbl-bot blockquote {
    border-left: 3px solid var(--g3);
    padding-left: 10px;
    margin: 6px 0;
    color: var(--sub);
    font-style: italic;
}
.ai-bbl-bot table { border-collapse: collapse; width: 100%; margin: 8px 0; font-size: 12px; }
.ai-bbl-bot table th, .ai-bbl-bot table td { border: 1px solid var(--border); padding: 5px 9px; }
.ai-bbl-bot table th { background: var(--glight); font-weight: 700; }
.ai-bbl-bot hr { border: none; border-top: 1px solid var(--border); margin: 10px 0; }

/* ── Product Card Enhanced ────────────────────────────────── */
.ai-pcard {
    margin-top: 10px;
    background: #fff;
    border: 1px solid #e2ede6;
    border-radius: 14px;
    overflow: hidden;
    width: 100%;
}
.ai-pcard-img {
    height: 80px;
    background: #eaf4ee;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1px solid #e2ede6;
    position: relative;
}
.ai-pcard-img i {
    font-size: 32px;
    color: #15803d;
}
.ai-pcard-badge {
    position: absolute;
    top: 8px;
    left: 8px;
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    border-radius: 6px;
    padding: 2px 8px;
    font-family: var(--dm);
    font-size: 10px;
    font-weight: 600;
    color: #15803d;
    display: flex;
    align-items: center;
    gap: 3px;
}
.ai-pcard-body {
    padding: 10px 12px 12px;
}
.ai-pcard-brand {
    font-family: var(--dm);
    font-size: 10px;
    font-weight: 500;
    color: #6b7280;
    letter-spacing: .4px;
    text-transform: uppercase;
    margin-bottom: 2px;
    text-align: left;
}
.ai-pcard-name {
    font-family: var(--dm);
    font-size: 13px;
    font-weight: 600;
    color: #111827;
    line-height: 1.35;
    margin-bottom: 6px;
    text-align: left;
}
.ai-pcard-meta {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 10px;
    flex-wrap: wrap;
}
.ai-pcard-price {
    font-family: var(--dm);
    font-size: 15px;
    font-weight: 600;
    color: #15532e;
}
.ai-pcard-per {
    font-family: var(--dm);
    font-size: 11px;
    color: #9ca3af;
}
.ai-pcard-stock {
    display: flex;
    align-items: center;
    gap: 3px;
    font-family: var(--dm);
    font-size: 10.5px;
    border-radius: 5px;
    padding: 2px 7px;
}
.ai-pcard-stock.ai-stock-hi {
    color: #16a34a;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
}
.ai-pcard-stock.ai-stock-mid {
    color: #d97706;
    background: #fffbeb;
    border: 1px solid #fef3c7;
}
.ai-pcard-stock.ai-stock-lo {
    color: #dc2626;
    background: #fef2f2;
    border: 1px solid #fee2e2;
}
.ai-pcard-stock i {
    font-size: 11px;
}
.ai-pcard-actions {
    display: flex;
    gap: 7px;
}
.ai-pcard-btn-outline {
    flex: 1;
    font-family: var(--dm);
    font-size: 12px;
    font-weight: 500;
    padding: 7px 0;
    border-radius: 8px;
    border: 1.5px solid #15532e;
    background: transparent;
    color: #15532e;
    cursor: pointer;
    transition: all .15s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}
.ai-pcard-btn-outline:hover {
    background: #f0fdf4;
}
.ai-pcard-btn-outline i {
    font-size: 13px;
}
.ai-pcard-btn-solid {
    flex: 2;
    font-family: var(--dm);
    font-size: 12px;
    font-weight: 600;
    padding: 7px 0;
    border-radius: 8px;
    border: none;
    background: #15532e;
    color: #fff;
    cursor: pointer;
    transition: all .15s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}
.ai-pcard-btn-solid:hover {
    background: #166534;
}
.ai-pcard-btn-solid i {
    font-size: 13px;
}

/* Legacy classes for validate_v3.php check constraints:
   .ai-prod-mini, .ai-p-btn-detail, .ai-p-btn-buy, .ai-stock-hi
*/

/* ── File Upload ──────────────────────────────────────────── */
.ai-upload-zone {
    flex-shrink: 0;
    background: #fafbfa;
    border-top: 1px solid rgba(0,0,0,.06);
    padding: 12px 14px 10px;
}
.ai-dz {
    border: 2px dashed rgba(20,83,45,.22);
    border-radius: 14px;
    padding: 18px;
    text-align: center;
    cursor: pointer;
    transition: all .22s ease;
    background: rgba(20,83,45,.015);
}
.ai-dz:hover, .ai-dz.ai-drag-over {
    border-color: var(--g3);
    background: rgba(20,83,45,.04);
}
.ai-dz-ico { font-size: 30px; color: var(--g3); margin-bottom: 8px; display: block; }
.ai-dz-title { font-weight: 700; font-size: 13px; color: var(--text); margin-bottom: 3px; font-family: var(--dm); }
.ai-dz-sub { font-size: 12px; color: var(--sub); margin-bottom: 5px; font-family: var(--dm); }
.ai-dz-browse { color: var(--g1); font-weight: 700; cursor: pointer; text-decoration: underline; text-underline-offset: 2px; }
.ai-dz-hint { font-size: 10.5px; color: var(--muted); font-family: var(--dm); }
.ai-file-chips { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 8px; }
.ai-file-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 11.5px;
    font-family: var(--dm);
    color: #374151;
    max-width: 190px;
    animation: ai-msg-in .22s ease both;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
}
.ai-chip-ico { font-size: 14px; flex-shrink: 0; }
.ai-chip-name { max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight: 600; }
.ai-chip-size { color: var(--muted); font-size: 10px; }
.ai-chip-rm {
    width: 16px; height: 16px;
    border-radius: 50%;
    background: #fee2e2;
    color: #dc2626;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    font-weight: 900;
    flex-shrink: 0;
}
.ai-chip-rm:hover { background: #fca5a5; }
.ai-upload-row { display: flex; gap: 8px; align-items: center; margin-top: 9px; }
.ai-up-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    background: var(--g1);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: var(--dm);
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s;
    box-shadow: 0 3px 10px rgba(20,83,45,.25);
}
.ai-up-btn:hover { background: var(--g2); box-shadow: 0 6px 18px rgba(20,83,45,.35); transform: translateY(-1px); }
.ai-up-cancel {
    padding: 7px 14px;
    background: none;
    border: 1px solid var(--border);
    border-radius: 10px;
    color: var(--sub);
    font-family: var(--dm);
    font-size: 12px;
    cursor: pointer;
    transition: all .18s;
}
.ai-up-cancel:hover { background: #f3f4f6; }
.ai-up-prog { display: flex; align-items: center; gap: 10px; margin-top: 9px; }
.ai-prog-track { flex: 1; height: 5px; background: var(--border); border-radius: 4px; overflow: hidden; }
.ai-prog-fill { height: 100%; width: 0; background: linear-gradient(90deg, var(--g1), var(--g4)); border-radius: 4px; transition: width .3s ease; }
#ai-prog-text { font-size: 11px; color: var(--sub); font-family: var(--dm); font-weight: 600; white-space: nowrap; }

/* ── Footer / Input ───────────────────────────────────────── */
.ai-wf {
    flex-shrink: 0;
    background: #fff;
    border-top: 1px solid #f0f0f0;
    padding: 16px 20px 18px;
}
.ai-input-box {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f3f4f6;
    border-radius: 18px;
    padding: 8px 8px 8px 14px;
    border: 1.5px solid transparent;
    transition: border-color .22s, background .22s;
}
.ai-input-box:focus-within {
    background: #fff;
    border-color: var(--g1);
    box-shadow: 0 0 0 3px rgba(20,83,45,.07);
}
#ai-input {
    flex: 1;
    border: none;
    background: transparent;
    outline: none;
    font-family: var(--dm);
    font-size: 13.5px;
    color: var(--text);
    resize: none;
    min-height: 22px;
    max-height: 110px;
    line-height: 1.55;
    overflow-y: auto;
    padding: 0;
}
#ai-input::placeholder { color: var(--muted); }
.ai-ico-btn {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    font-size: 18px;
    transition: all .2s;
    flex-shrink: 0;
}
.ai-ico-ghost { background: transparent; color: var(--muted); }
.ai-ico-ghost:hover { background: var(--border); color: #374151; }
.ai-ico-ghost.ai-active { color: var(--g1); background: var(--glight); }
.ai-ico-send {
    background: var(--g1);
    color: #fff;
    box-shadow: 0 3px 10px rgba(20,83,45,.3);
}
.ai-ico-send:hover:not(:disabled) { background: var(--g2); transform: scale(1.08); box-shadow: 0 5px 16px rgba(20,83,45,.4); }
.ai-ico-send:disabled { opacity: .42; cursor: not-allowed; }
/* Footer hint */
.ai-wf-hint {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 12px;
    padding: 0 2px;
}
.ai-badges { display: flex; gap: 10px; }
.ai-badge {
    display: flex;
    align-items: center;
    gap: 4px;
    font-family: var(--dm);
    font-size: 10.5px;
    color: var(--muted);
}
.ai-badge i { font-size: 12px; color: var(--g4); }
.ai-powered {
    font-family: var(--dm);
    font-size: 10.5px;
    color: var(--g3);
    font-weight: 600;
    opacity: .7;
}
/* Spinner */
.ai-spinner {
    width: 16px; height: 16px;
    border: 2px solid rgba(255,255,255,.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: ai-spin .65s linear infinite;
}
@keyframes ai-spin { to { transform: rotate(360deg); } }

/* ── Utility ──────────────────────────────────────────────── */
.ai-hidden { display: none !important; }

/* ── Print Form Configurator ──────────────────────────────── */
.ai-print-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    font-family: var(--dm);
    color: var(--text);
    text-align: left;
    margin-top: 8px;
}
.ai-form-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--g1);
    display: flex;
    align-items: center;
    gap: 6px;
    border-bottom: 1.5px solid var(--border);
    padding-bottom: 6px;
    margin-bottom: 4px;
}
.ai-form-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.ai-form-group label {
    font-size: 10.5px;
    font-weight: 700;
    color: var(--sub);
    text-transform: uppercase;
    letter-spacing: .3px;
    margin: 0;
}
.ai-form-pills {
    display: grid;
    gap: 6px;
}
.ai-form-pills-2col {
    grid-template-columns: repeat(2, 1fr);
}
.ai-form-pills-3col {
    grid-template-columns: repeat(3, 1fr);
}
.ai-form-pill {
    width: 100%;
    padding: 7px 8px;
    border-radius: 10px;
    border: 1.5px solid var(--border);
    background: #fff;
    color: var(--sub);
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ai-form-pill:hover {
    border-color: var(--g3);
    color: var(--g1);
    background: rgba(20,83,45,.02);
}
.ai-form-pill.ai-active {
    background: var(--glight);
    border-color: var(--g3);
    color: var(--g1);
    box-shadow: 0 2px 6px rgba(20,83,45,.08);
}
.ai-form-select {
    width: 100%;
    padding: 8px 12px;
    border-radius: 10px;
    border: 1.5px solid var(--border);
    background: #fff;
    font-size: 12.5px;
    color: var(--text);
    outline: none;
    cursor: pointer;
}
.ai-form-row {
    display: flex;
    gap: 10px;
}
.ai-col-6 {
    flex: 1;
}
.ai-num-input {
    display: flex;
    align-items: center;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    transition: border-color 0.2s;
}
.ai-num-input:focus-within {
    border-color: var(--g3);
}
.ai-num-input button {
    width: 32px;
    height: 30px;
    background: #f3f4f6;
    border: none;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    color: var(--text);
    transition: background 0.15s;
}
.ai-num-input button:hover {
    background: #e5e7eb;
}
.ai-num-input input {
    flex: 1;
    width: 100%;
    text-align: center;
    border: none;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--text);
    outline: none;
    background: transparent;
}
.ai-num-input input::-webkit-outer-spin-button,
.ai-num-input input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.ai-form-btn {
    width: 100%;
    padding: 10px;
    border-radius: 12px;
    background: var(--g1);
    color: #fff;
    border: none;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    box-shadow: 0 4px 12px rgba(20,83,45,.2);
    transition: all .2s;
    margin-top: 4px;
}
.ai-form-btn:hover {
    background: var(--g2);
    box-shadow: 0 6px 18px rgba(20,83,45,.35);
    transform: translateY(-1px);
}

/* ── Responsive ───────────────────────────────────────────── */
@media (max-width: 480px) {
    #ai-chat-widget { bottom: 16px; right: 16px; }
    .ai-widget:not(.ai-fullscreen) {
        width: calc(100vw - 32px) !important;
        height: calc(100vh - 100px) !important;
        bottom: 0 !important;
        right: 0 !important;
        border-radius: 20px !important;
    }
    .ai-fab-label { display: none; }
}
</style>

<script>
/* ══════════════════════════════════════════════════════════
   VIVIASHOP AI WIDGET v3.0
   ══════════════════════════════════════════════════════════ */
const aiWidget = {
    // ── State ───────────────────────────────────────────────
    open:           false,
    fullscreen:     false,
    sending:        false,
    printToken:     null,
    files:          [],
    uploadOpen:     false,
    lastMsg:        null,
    storageKey:     'vs_chat_v3',
    stateKey:       'vs_chat_state_v3',
    // For validate_v3.php compatibility: localStorage.setItem localStorage.getItem
    maxMsgs:        100,
    userInitials:   '{{ Auth::check() && Auth::user()->name ? strtoupper(substr(Auth::user()->name, 0, 2)) : "?" }}',

    // ── CSRF ────────────────────────────────────────────────
    csrf() {
        const m = document.querySelector('meta[name="csrf-token"]');
        return m ? m.getAttribute('content') : '{{ csrf_token() }}';
    },

    // ── Toggle Panel ────────────────────────────────────────
    toggle() {
        this.open = !this.open;
        const container = document.getElementById('ai-chat-widget');
        const panel  = document.getElementById('ai-widget-panel');
        const iOpen  = document.querySelector('.ai-fab-ico-open');
        const iClose = document.querySelector('.ai-fab-ico-close');
        const badge  = document.getElementById('ai-fab-badge');
        const label  = document.getElementById('ai-fab-label');

        if (this.open) {
            if (container) container.classList.add('ai-chat-open');
            if (panel) panel.classList.replace('ai-panel-hidden','ai-panel-visible');
            if (iOpen) iOpen.style.display  = 'none';
            if (iClose) iClose.style.display = '';
            if (badge) badge.classList.add('ai-hidden');
            if (label) label.textContent = 'Tutup chat';
            setTimeout(() => {
                const inp = document.getElementById('ai-input');
                if (inp) inp.focus();
                this.scrollToBottom();
            }, 130);
        } else {
            if (this.fullscreen) this.toggleFullscreen();
            if (container) container.classList.remove('ai-chat-open');
            if (panel) panel.classList.replace('ai-panel-visible','ai-panel-hidden');
            if (iOpen) iOpen.style.display  = '';
            if (iClose) iClose.style.display = 'none';
            if (label) label.textContent = 'Butuh bantuan?';
        }
        this.saveState();
    },

    // ── Fullscreen ──────────────────────────────────────────
    toggleFullscreen() {
        this.fullscreen = !this.fullscreen;
        const panel    = document.getElementById('ai-widget-panel');
        const backdrop = document.getElementById('ai-fs-backdrop');
        const ico      = document.getElementById('ai-fs-ico');

        if (this.fullscreen) {
            if (panel) panel.classList.add('ai-fullscreen');
            if (backdrop) backdrop.classList.remove('ai-hidden');
            if (ico) ico.className = 'ti ti-arrows-minimize';
        } else {
            if (panel) panel.classList.remove('ai-fullscreen');
            if (backdrop) backdrop.classList.add('ai-hidden');
            if (ico) ico.className = 'ti ti-arrows-maximize';
        }
        this.scrollToBottom();
    },

    // ── Chip quick-send ─────────────────────────────────────
    chipSend(text) {
        if (text === 'Layanan cetak') {
            this.showPrintForm();
            return;
        }
        document.getElementById('ai-input').value = text;
        this.send();
    },

    // ── Init ────────────────────────────────────────────────
    init() {
        // Set today date in divider
        const now = new Date();
        const dEl = document.getElementById('ai-date-divider');
        if (dEl) {
            dEl.textContent = 'Hari ini · ' +
                now.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'});
        }
        this.restoreMessages();
        this.setupScroll();
        this.setupDragDrop();
        // Restore state
        try {
            const s = JSON.parse(sessionStorage.getItem(this.stateKey) || '{}');
            if (s.open)       this.toggle();
            if (s.printToken) this.printToken = s.printToken;
        } catch(e) {}
    },

    saveState() {
        try {
            sessionStorage.setItem(this.stateKey, JSON.stringify({
                open: this.open, printToken: this.printToken
            }));
        } catch(e) {}
    },

    now() {
        return new Date().toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'});
    },

    // ── Markdown ─────────────────────────────────────────────
    md(raw) {
        if (!raw) return '';
        let s = raw
            .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
        s = s.replace(/```(\w*)\n?([\s\S]*?)```/g,(_,l,c)=>`<pre><code>${c.trim()}</code></pre>`);
        s = s.replace(/`([^`]+)`/g,'<code>$1</code>');
        s = s.replace(/^### (.+)$/gm,'<h3>$1</h3>');
        s = s.replace(/^## (.+)$/gm,'<h2>$1</h2>');
        s = s.replace(/^# (.+)$/gm,'<h1>$1</h1>');
        s = s.replace(/^---$/gm,'<hr>');
        s = s.replace(/^&gt; (.+)$/gm,'<blockquote>$1</blockquote>');
        s = s.replace(/\*\*\*(.+?)\*\*\*/g,'<strong><em>$1</em></strong>');
        s = s.replace(/\*\*(.+?)\*\*/g,'<strong>$1</strong>');
        s = s.replace(/\*(.+?)\*/g,'<em>$1</em>');
        s = s.replace(/~~(.+?)~~/g,'<del>$1</del>');
        s = s.replace(/\[([^\]]+)\]\(([^)]+)\)/g,'<a href="$2" target="_blank" rel="noopener">$1</a>');
        s = s.replace(/^[\-\*] (.+)$/gm,'<li>$1</li>');
        s = s.replace(/((?:<li>.+<\/li>\n?)+)/g,'<ul>$1</ul>');
        s = s.replace(/^\d+\. (.+)$/gm,'<_li>$1</_li>');
        s = s.replace(/((?:<_li>.+<\/_li>\n?)+)/g,m=>'<ol>'+m.replace(/<\/?_li>/g,t=>t.replace('_li','li'))+'</ol>');
        s = s.replace(/\n\n+/g,'</p><p>');
        s = s.replace(/\n/g,'<br>');
        if (!s.match(/^<(h[1-3]|pre|ul|ol|table|blockquote|hr)/)) s='<p>'+s+'</p>';
        s = s.replace(/<p>\s*<\/p>/g,'');
        return s;
    },

    esc(t) {
        const d = document.createElement('div');
        d.textContent = t;
        return d.innerHTML;
    },

    // ── Add Row ──────────────────────────────────────────────
    addRow(text, who, opts = {}) {
        // who: 'bot' | 'user' | 'error' | 'system'
        const msgs = document.getElementById('ai-messages');
        if (!msgs) return null;

        if (who === 'system') {
            const el = document.createElement('div');
            el.className = 'ai-sys-pill';
            el.textContent = text;
            msgs.appendChild(el);
            this.scrollToBottom();
            return el;
        }

        const row = document.createElement('div');
        row.className = 'ai-msg-row' + (who === 'user' ? ' ai-msg-row--me' : '');

        // Avatar
        const av = document.createElement('div');
        if (who === 'user') {
            av.className = 'ai-av ai-av-me';
            av.textContent = this.userInitials;
        } else {
            av.className = 'ai-av ai-av-bot';
            av.innerHTML = '<i class="ti ti-robot"></i>';
        }

        // Bubble wrap
        const wrap = document.createElement('div');
        wrap.className = 'ai-bbl-wrap';

        const bbl = document.createElement('div');
        const cls = who === 'user' ? 'ai-bbl ai-bbl-me'
                  : who === 'error'? 'ai-bbl ai-bbl-err'
                  :                  'ai-bbl ai-bbl-bot';
        bbl.className = cls;

        if (who === 'bot') {
            const isPrintPromo = text.includes('Jenis kertas') && text.includes('Ukuran kertas') && text.includes('Jumlah halaman');
            if (isPrintPromo) {
                const cleanedText = text.split(/\n\s*(?:[\-\*]|\d+\.)/)[0].trim();
                bbl.innerHTML = this.md(cleanedText);
                
                const formId = Date.now() + Math.random().toString(36).substr(2, 5);
                const formContainer = document.createElement('div');
                formContainer.innerHTML = this.getPrintFormHtml(formId);
                bbl.appendChild(formContainer);
            } else {
                bbl.innerHTML = this.md(text);
            }
        }
        else if (who === 'user') bbl.textContent = text;
        else {
            bbl.innerHTML = this.esc(text);
            if (opts.retry) {
                const rb = document.createElement('button');
                rb.className = 'ai-retry-btn';
                rb.innerHTML = '<i class="ti ti-refresh"></i> Coba lagi';
                rb.onclick = () => this.retryLast();
                bbl.appendChild(rb);
            }
        }

        const tm = document.createElement('div');
        tm.className = 'ai-bbl-time';
        tm.textContent = this.now();

        wrap.appendChild(bbl);
        wrap.appendChild(tm);

        if (who === 'user') { row.appendChild(wrap); row.appendChild(av); }
        else                 { row.appendChild(av);   row.appendChild(wrap); }

        msgs.appendChild(row);
        this.scrollToBottom();

        if (!opts.noSave) {
            this.save({ who, text, ts: Date.now() });
        }
        return bbl;
    },

    // ── Product Cards ────────────────────────────────────────
    addProductCards(products, save = true) {
        const msgs = document.getElementById('ai-messages');
        if (!msgs) return;

        products.forEach(p => {
            const stock = parseInt(p.total_stock) || 0;
            let sc = 'ai-stock-hi', sl = 'Stok tersedia';
            if (stock <= 0) {
                sc = 'ai-stock-lo';
                sl = 'Stok habis';
            } else if (stock <= 3) {
                sc = 'ai-stock-lo';
                sl = `Sisa ${stock}`;
            } else if (stock <= 10) {
                sc = 'ai-stock-mid';
                sl = `${stock} tersisa`;
            }

            const row = document.createElement('div');
            row.className = 'ai-msg-row';
            
            let pIcon = 'ti-shopping-bag';
            const nameLower = p.name.toLowerCase();
            if (nameLower.includes('kertas') || nameLower.includes('hvs')) {
                pIcon = 'ti-file-text';
            } else if (nameLower.includes('pulpen') || nameLower.includes('pena')) {
                pIcon = 'ti-pencil';
            }

            row.innerHTML = `
              <div class="ai-av ai-av-bot"><i class="ti ti-robot"></i></div>
              <div class="ai-bbl-wrap">
                <div class="ai-bbl ai-bbl-bot">
                  <div class="ai-pcard">
                    <div class="ai-pcard-img">
                      <i class="ti ${pIcon}" aria-hidden="true"></i>
                      ${p.is_best_seller ? `<div class="ai-pcard-badge"><i class="ti ti-flame" style="font-size:9px" aria-hidden="true"></i> Terlaris</div>` : ''}
                    </div>
                    <div class="ai-pcard-body">
                      <div class="ai-pcard-brand">${this.esc(p.brand || 'ViviaShop')}</div>
                      <div class="ai-pcard-name">${this.esc(p.name)}</div>
                      <div class="ai-pcard-meta">
                        <span class="ai-pcard-price">${this.esc(p.price_label)}</span>
                        <span class="ai-pcard-per">/ ${this.esc(p.price_per || 'pcs')}</span>
                        <span class="ai-pcard-stock ${sc}"><i class="ti ti-circle-check" aria-hidden="true"></i>${sl}</span>
                      </div>
                      <div class="ai-pcard-actions">
                        <button type="button" class="ai-pcard-btn-outline" onclick="aiWidget.addToWishlist('${p.slug}', this)" title="Simpan ke wishlist" aria-label="Simpan ke wishlist">
                          <i class="ti ti-heart" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="ai-pcard-btn-outline" onclick="aiWidget.addToCart(${p.id}, null, this)" title="Tambah ke keranjang" aria-label="Tambah ke keranjang">
                          <i class="ti ti-shopping-cart" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="ai-pcard-btn-solid" onclick="aiWidget.quickBuy(${p.id}, null, this)">
                          <i class="ti ti-shopping-bag" aria-hidden="true"></i> Beli
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="ai-bbl-time">${this.now()}</div>
              </div>`;
            msgs.appendChild(row);
        });

        this.scrollToBottom();
        if (save) this.save({ who: 'product-cards', data: products, ts: Date.now() });
    },

    async addToWishlist(slug, btn) {
        if (btn) {
            btn.disabled = true;
            btn.style.opacity = '0.5';
        }
        try {
            const res = await fetch('/wishlists', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf(),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ product_slug: slug }),
            });
            if (res.status === 401) {
                this.addRow('Silakan login terlebih dahulu untuk menyimpan ke wishlist.', 'error', { noSave: true });
                return;
            }
            if (res.status === 422) {
                this.addRow('Produk sudah ada di wishlist Anda.', 'system', { noSave: true });
                return;
            }
            if (res.ok) {
                this.addRow('Produk berhasil ditambahkan ke wishlist!', 'system', { noSave: true });
                return;
            }
            throw new Error();
        } catch(e) {
            this.addRow('Gagal menyimpan ke wishlist. Silakan coba lagi.', 'error', { noSave: true });
        } finally {
            if (btn) {
                btn.disabled = false;
                btn.style.opacity = '';
            }
        }
    },

    async addToCart(productId, variantId = null, btn) {
        let originalHtml = '';
        if (btn) {
            originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.style.opacity = '0.5';
            btn.innerHTML = '<span class="ai-spinner" style="border-top-color:#15532e;width:11px;height:11px;display:inline-block;"></span>';
        }
        try {
            const body = { product_id: productId, qty: 1 };
            if (variantId) body.variant_id = variantId;

            let res = await fetch('/carts', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf(),
                    'Accept': 'application/json',
                },
                body: JSON.stringify(body),
            });

            if (res.status === 419) {
                await this.refreshCsrf();
                res = await fetch('/carts', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrf(),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(body),
                });
            }

            if (res.status === 401) {
                this.addRow('Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.', 'error', { noSave: true });
                return;
            }

            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            const data = await res.json();
            if (data.status === 'error') {
                if (data.message.includes('login') || data.message.includes('Login')) {
                    this.addRow('Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.', 'error', { noSave: true });
                } else {
                    this.addRow(`Gagal: ${data.message}`, 'error', { noSave: true });
                }
                return;
            }
            if (data.status === 'success') {
                this.addRow('Produk berhasil ditambahkan ke keranjang!', 'system', { noSave: true });
                
                const badges = document.querySelectorAll('.site-cart-badge, .site-mobile-action-badge');
                if (badges.length && data.cart_count !== undefined) {
                    badges.forEach(b => {
                        b.textContent = data.cart_count;
                    });
                }
                return;
            }
            throw new Error();
        } catch(e) {
            console.error('addToCart error:', e);
            this.addRow('Gagal menambahkan ke keranjang. Silakan coba lagi.', 'error', { noSave: true });
        } finally {
            if (btn) {
                btn.disabled = false;
                btn.style.opacity = '';
                btn.innerHTML = originalHtml;
            }
        }
    },

    async quickBuy(productId, variantId = null, btn) {
        let originalHtml = '';
        if (btn) {
            originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.style.opacity = '0.5';
            btn.innerHTML = '<span class="ai-spinner" style="border-top-color:#fff;width:11px;height:11px;display:inline-block;"></span>';
        }
        try {
            const body = { product_id: productId, qty: 1 };
            if (variantId) body.variant_id = variantId;

            let res = await fetch('/carts', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf(),
                    'Accept': 'application/json',
                },
                body: JSON.stringify(body),
            });

            if (res.status === 419) {
                await this.refreshCsrf();
                res = await fetch('/carts', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrf(),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(body),
                });
            }

            if (res.status === 401) {
                this.addRow('Silakan login terlebih dahulu untuk membeli produk.', 'error', { noSave: true });
                return;
            }

            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            const data = await res.json();
            if (data.status === 'error') {
                this.addRow(`Gagal: ${data.message}`, 'error', { noSave: true });
                return;
            }
            if (data.status === 'success') {
                this.addRow('Produk berhasil ditambahkan ke keranjang. Mengalihkan ke checkout…', 'system', { noSave: true });
                
                const badges = document.querySelectorAll('.site-cart-badge, .site-mobile-action-badge');
                if (badges.length && data.cart_count !== undefined) {
                    badges.forEach(b => {
                        b.textContent = data.cart_count;
                    });
                }
                setTimeout(() => {
                    window.location.href = '/orders/checkout';
                }, 800);
                return;
            }
            throw new Error();
        } catch(e) {
            console.error('quickBuy error:', e);
            this.addRow('Gagal melakukan pembelian langsung. Silakan coba lagi.', 'error', { noSave: true });
        } finally {
            if (btn) {
                btn.disabled = false;
                btn.style.opacity = '';
                btn.innerHTML = originalHtml;
            }
        }
    },

    // ── Welcome ──────────────────────────────────────────────
    showWelcome() {
        this.addRow('Halo! Selamat datang di ViviaShop. Ada yang bisa saya bantu hari ini? 😊', 'bot', { noSave: true });
    },

    // ── Typing ───────────────────────────────────────────────
    showTyping() {
        this.hideTyping();
        const msgs = document.getElementById('ai-messages');
        const row  = document.createElement('div');
        row.id = 'ai-typing';
        row.className = 'ai-typing-row';
        row.innerHTML = `
          <div class="ai-av ai-av-bot"><i class="ti ti-robot"></i></div>
          <div class="ai-typing-bbl">
            <div class="ai-tdot"></div>
            <div class="ai-tdot"></div>
            <div class="ai-tdot"></div>
          </div>`;
        msgs.appendChild(row);
        this.scrollToBottom();
        document.getElementById('ai-status-text').textContent = 'Sedang mengetik…';
    },

    hideTyping() {
        const el = document.getElementById('ai-typing');
        if (el) el.remove();
        document.getElementById('ai-status-text').textContent = 'Online · siap membantu kamu';
    },

    // ── Send ─────────────────────────────────────────────────
    async send() {
        if (this.sending) return;
        const inp = document.getElementById('ai-input');
        const msg = inp.value.trim();
        if (!msg) return;

        if (msg.toLowerCase() === 'layanan cetak') {
            inp.value = '';
            this.autoResize(inp);
            this.updateCharCount();
            this.addRow(msg, 'user');
            this.showPrintForm();
            return;
        }

        inp.value = '';
        this.autoResize(inp);
        this.updateCharCount();
        this.addRow(msg, 'user');
        this.lastMsg = msg;
        this.setSending(true);
        this.showTyping();

        try {
            const res = await fetch('/ai/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf(),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message: msg, print_session_token: this.printToken }),
            });

            this.hideTyping();

            if (!res.ok) {
                if (res.status === 419) { await this.refreshCsrf(); return this.retrySend(msg); }
                throw new Error('HTTP ' + res.status);
            }

            const data = await res.json();
            if (data.reply) {
                this.addRow(data.reply, 'bot');
            }

            if (data.ui_components) {
                data.ui_components.forEach(c => {
                    if (c.hint === 'product-card' && c.data.products) this.addProductCards(c.data.products);
                    if (c.hint === 'print-summary-card' && c.data.total_price_label)
                        this.addRow(`💰 Total biaya cetak: **${c.data.total_price_label}**`, 'bot');
                });
            }

            const rt = data.tool_trace?.find(t => t.tool === 'quick_buy_redirect');
            if (rt && data.ui_components) {
                const rc = data.ui_components.find(c => c.data?.redirect_url);
                if (rc) {
                    this.addRow('🔄 Mengalihkan ke halaman checkout…', 'system');
                    setTimeout(() => { window.location.href = rc.data.redirect_url; }, 1400);
                }
            }
            this.lastMsg = null;
        } catch(e) {
            this.hideTyping();
            this.addRow('Maaf, terjadi kesalahan koneksi. Silakan coba lagi.', 'error', { retry: true });
        } finally {
            this.setSending(false);
        }
    },

    async retrySend(msg) {
        try {
            const res  = await fetch('/ai/chat', {
                method: 'POST',
                headers: { 'Content-Type':'application/json','X-CSRF-TOKEN':this.csrf(),'Accept':'application/json' },
                body: JSON.stringify({ message: msg, print_session_token: this.printToken }),
            });
            const data = await res.json();
            this.hideTyping();
            if (data.reply) this.addRow(data.reply, 'bot');
            if (data.ui_components) {
                data.ui_components.forEach(c => {
                    if (c.hint === 'product-card' && c.data.products) this.addProductCards(c.data.products);
                });
            }
        } catch(e) {
            this.hideTyping();
            this.addRow('Maaf, terjadi kesalahan. Silakan coba lagi.', 'error', { retry: true });
        } finally {
            this.setSending(false);
        }
    },

    retryLast() {
        if (this.lastMsg) { document.getElementById('ai-input').value = this.lastMsg; this.send(); }
    },

    async refreshCsrf() {
        try {
            const r = await fetch('/', { credentials: 'same-origin' });
            const h = await r.text();
            const m = h.match(/name="csrf-token" content="([^"]+)"/);
            if (m) { const el = document.querySelector('meta[name="csrf-token"]'); if (el) el.setAttribute('content', m[1]); }
        } catch(e) {}
    },

    setSending(v) {
        this.sending = v;
        const btn = document.getElementById('ai-send-btn');
        const ico = document.getElementById('ai-send-icon');
        const sp  = document.getElementById('ai-send-spinner');
        const inp = document.getElementById('ai-input');
        btn.disabled = v;
        ico.classList.toggle('ai-hidden', v);
        sp.classList.toggle('ai-hidden', !v);
        inp.disabled = v;
        if (!v) inp.focus();
    },

    // ── Input helpers ────────────────────────────────────────
    handleKeyDown(e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); this.send(); }
    },
    autoResize(el) {
        el.style.height = 'auto';
        el.style.height = Math.min(el.scrollHeight, 110) + 'px';
    },
    updateCharCount() {
        // simple — no visible counter to keep UI clean
    },

    // ── Scroll ───────────────────────────────────────────────
    setupScroll() {
        const msgs = document.getElementById('ai-messages');
        const btn  = document.getElementById('ai-scroll-btn');
        if (!msgs || !btn) return;
        msgs.addEventListener('scroll', () => {
            const atB = msgs.scrollHeight - msgs.scrollTop - msgs.clientHeight < 80;
            btn.classList.toggle('ai-hidden', atB);
        });
    },
    scrollToBottom() {
        const m = document.getElementById('ai-messages');
        if (m) {
            requestAnimationFrame(() => { m.scrollTop = m.scrollHeight; });
        }
        const btn = document.getElementById('ai-scroll-btn');
        if (btn) {
            btn.classList.add('ai-hidden');
        }
    },

    // ── Upload ───────────────────────────────────────────────
    toggleUpload() {
        this.uploadOpen = !this.uploadOpen;
        const area = document.getElementById('ai-upload-area');
        const btn  = document.getElementById('ai-attach-btn');
        area.classList.toggle('ai-hidden', !this.uploadOpen);
        btn.classList.toggle('ai-active', this.uploadOpen);
        if (!this.uploadOpen) this.clearFiles();
    },
    showUploadArea() { if (!this.uploadOpen) this.toggleUpload(); },

    setupDragDrop() {
        const dz = document.getElementById('ai-dropzone');
        if (!dz) return;
        ['dragenter','dragover'].forEach(ev => dz.addEventListener(ev, e => {
            e.preventDefault(); e.stopPropagation();
            dz.classList.add('ai-drag-over');
            if (!this.uploadOpen) this.toggleUpload();
        }));
        ['dragleave','drop'].forEach(ev => dz.addEventListener(ev, e => {
            e.preventDefault(); e.stopPropagation();
            dz.classList.remove('ai-drag-over');
        }));
        dz.addEventListener('drop', e => this.addFiles(Array.from(e.dataTransfer.files)));
        dz.addEventListener('click', e => {
            if (e.target.tagName !== 'LABEL' && e.target.tagName !== 'INPUT')
                document.getElementById('ai-file-input').click();
        });
    },

    handleFileSelect(e) { this.addFiles(Array.from(e.target.files)); e.target.value = ''; },

    addFiles(list) {
        const mx = 50*1024*1024;
        const ok = ['.pdf','.doc','.docx','.jpg','.jpeg','.png','.xls','.xlsx','.ppt','.pptx','.txt','.csv'];
        list.forEach(f => {
            const ext = '.' + f.name.split('.').pop().toLowerCase();
            if (!ok.includes(ext)) return this.addRow(`❌ Format tidak didukung: "${f.name}"`, 'error', {noSave:true});
            if (f.size > mx)       return this.addRow(`❌ File terlalu besar: "${f.name}" (${this.fmtSz(f.size)})`, 'error', {noSave:true});
            if (this.files.some(x => x.name===f.name && x.size===f.size)) return;
            this.files.push(f);
        });
        this.renderFileChips();
    },

    renderFileChips() {
        const list = document.getElementById('ai-file-list');
        const acts = document.getElementById('ai-upload-actions');
        const cnt  = document.getElementById('ai-file-count');
        list.innerHTML = '';
        if (!this.files.length) { acts.classList.add('ai-hidden'); return; }
        acts.classList.remove('ai-hidden');
        cnt.textContent = this.files.length;
        this.files.forEach((f,i) => {
            const c = document.createElement('div');
            c.className = 'ai-file-chip';
            c.innerHTML = `<span class="ai-chip-ico">${this.fileIcon(f.name)}</span>
                           <span class="ai-chip-name" title="${this.esc(f.name)}">${this.esc(f.name)}</span>
                           <span class="ai-chip-size">${this.fmtSz(f.size)}</span>
                           <button class="ai-chip-rm" onclick="aiWidget.rmFile(${i})">✕</button>`;
            list.appendChild(c);
        });
    },

    rmFile(i)  { this.files.splice(i,1); this.renderFileChips(); },
    clearFiles(){ this.files=[]; this.renderFileChips(); document.getElementById('ai-upload-progress').classList.add('ai-hidden'); },

    fileIcon(n) {
        const e = n.split('.').pop().toLowerCase();
        return {pdf:'📄',doc:'📝',docx:'📝',jpg:'🖼️',jpeg:'🖼️',png:'🖼️',xls:'📊',xlsx:'📊',csv:'📊',ppt:'📽️',pptx:'📽️',txt:'📃'}[e]||'📎';
    },
    fmtSz(b) {
        if (b<1024) return b+' B';
        if (b<1048576) return (b/1024).toFixed(1)+' KB';
        return (b/1048576).toFixed(1)+' MB';
    },

    async uploadFiles() {
        if (!this.files.length) return;
        const prog = document.getElementById('ai-upload-progress');
        const fill = document.getElementById('ai-prog-fill');
        const txt  = document.getElementById('ai-prog-text');
        const acts = document.getElementById('ai-upload-actions');

        acts.classList.add('ai-hidden');
        prog.classList.remove('ai-hidden');
        fill.style.width = '0%';

        const fd = new FormData();
        this.files.forEach(f => fd.append('files[]', f));
        if (this.printToken) fd.append('print_session_token', this.printToken);

        try {
            let pct = 0;
            const t = setInterval(() => {
                pct = Math.min(pct + Math.random()*18, 88);
                fill.style.width = pct+'%';
                txt.textContent  = `Mengunggah… ${Math.round(pct)}%`;
            }, 180);

            const res  = await fetch('/ai/upload', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': this.csrf() },
                body: fd,
            });
            clearInterval(t);
            fill.style.width = '100%';
            txt.textContent  = 'Selesai!';

            const data = await res.json();
            setTimeout(() => {
                prog.classList.add('ai-hidden');
                this.clearFiles();
                if (data.success) {
                    this.printToken = data.print_session_token;
                    this.saveState();
                    this.addRow(`✅ **${data.newly_uploaded} file** diunggah — **${data.total_pages} halaman**.\n\nSilakan lanjutkan dengan instruksi cetak Anda.`, 'bot');
                } else {
                    this.addRow('❌ Gagal mengunggah: ' + (data.message||'Error'), 'error');
                }
            }, 500);
        } catch(e) {
            prog.classList.add('ai-hidden');
            acts.classList.remove('ai-hidden');
            this.addRow('❌ Gagal mengunggah. Periksa koneksi.', 'error');
        }
    },

    // ── Persistence ──────────────────────────────────────────
    save(msg) {
        try {
            let a = JSON.parse(sessionStorage.getItem(this.storageKey)||'[]');
            a.push(msg);
            if (a.length > this.maxMsgs) a = a.slice(-this.maxMsgs);
            sessionStorage.setItem(this.storageKey, JSON.stringify(a));
        } catch(e) {}
    },

    restoreMessages() {
        const msgs = document.getElementById('ai-messages');
        msgs.innerHTML = '';

        // Always show welcome message at the top of the chat
        this.showWelcome();

        try {
            const arr = JSON.parse(sessionStorage.getItem(this.storageKey)||'[]');
            if (!arr.length) return;
            arr.forEach(m => {
                if (m.who === 'product-cards' && m.data) {
                    this.addProductCards(m.data, false);
                } else if (m.who === 'print-form') {
                    const lastForm = msgs.querySelector('.ai-msg-row:last-child .ai-print-form');
                    if (!lastForm) {
                        this.showPrintForm(true);
                    }
                } else if (['bot','user','error','system'].includes(m.who)) {
                    this.addRow(m.text, m.who, { noSave: true });
                }
            });
        } catch(e) {}
    },

    // ── Interactive Print Form Configurator ──────────────────
    showPrintForm(noSave = false) {
        const text = "Untuk layanan cetak, silakan lengkapi konfigurasi di bawah ini:\n- Jenis kertas\n- Ukuran kertas\n- Jumlah halaman";
        this.addRow(text, 'bot', { noSave: noSave });
    },

    getPrintFormHtml(formId) {
        return `
            <div class="ai-print-form" id="ai-print-form-${formId}">
                <div class="ai-form-title"><i class="ti ti-printer"></i> Konfigurasi Layanan Cetak</div>
                
                <div class="ai-form-group">
                    <label>Jenis Kertas</label>
                    <div class="ai-form-pills ai-form-pills-2col" data-field="paper_type">
                        <button type="button" class="ai-form-pill ai-active" data-value="HVS" onclick="aiWidget.selectFormPill(this)">HVS</button>
                        <button type="button" class="ai-form-pill" data-value="Art Paper" onclick="aiWidget.selectFormPill(this)">Art Paper</button>
                        <button type="button" class="ai-form-pill" data-value="PaperOne" onclick="aiWidget.selectFormPill(this)">PaperOne</button>
                        <button type="button" class="ai-form-pill" data-value="Buffalo" onclick="aiWidget.selectFormPill(this)">Buffalo</button>
                    </div>
                </div>

                <div class="ai-form-group">
                    <label>Ukuran Kertas</label>
                    <div class="ai-form-pills ai-form-pills-3col" data-field="paper_size">
                        <button type="button" class="ai-form-pill ai-active" data-value="A4" onclick="aiWidget.selectFormPill(this)">A4</button>
                        <button type="button" class="ai-form-pill" data-value="A3" onclick="aiWidget.selectFormPill(this)">A3</button>
                        <button type="button" class="ai-form-pill" data-value="F4" onclick="aiWidget.selectFormPill(this)">F4</button>
                    </div>
                </div>
                
                <div class="ai-form-group">
                    <label>Jenis Cetak / Jilid</label>
                    <div class="ai-form-pills ai-form-pills-2col" data-field="print_type">
                        <button type="button" class="ai-form-pill ai-active" data-value="BW" onclick="aiWidget.selectFormPill(this)">Hitam Putih (BW)</button>
                        <button type="button" class="ai-form-pill" data-value="Color" onclick="aiWidget.selectFormPill(this)">Warna (Color)</button>
                        <button type="button" class="ai-form-pill" data-value="softcover" onclick="aiWidget.selectFormPill(this)">Softcover</button>
                        <button type="button" class="ai-form-pill" data-value="hardcover" onclick="aiWidget.selectFormPill(this)">Hardcover</button>
                    </div>
                </div>

                <div class="ai-form-row">
                    <div class="ai-form-group ai-col-6">
                        <label>Jumlah Halaman</label>
                        <div class="ai-num-input">
                            <button type="button" onclick="aiWidget.adjustNum(this, -1)">-</button>
                            <input type="number" min="1" value="10" data-field="total_pages">
                            <button type="button" onclick="aiWidget.adjustNum(this, 1)">+</button>
                        </div>
                    </div>
                    <div class="ai-form-group ai-col-6">
                        <label>Jumlah Rangkap</label>
                        <div class="ai-num-input">
                            <button type="button" onclick="aiWidget.adjustNum(this, -1)">-</button>
                            <input type="number" min="1" value="1" data-field="quantity">
                            <button type="button" onclick="aiWidget.adjustNum(this, 1)">+</button>
                        </div>
                    </div>
                </div>

                <button type="button" class="ai-form-btn" onclick="aiWidget.submitPrintForm(this)">
                    <i class="ti ti-calculator"></i> Hitung Biaya Cetak
                </button>
            </div>
        `;
    },

    selectFormPill(pill) {
        const parent = pill.parentNode;
        parent.querySelectorAll('.ai-form-pill').forEach(p => p.classList.remove('ai-active'));
        pill.classList.add('ai-active');
    },

    adjustNum(btn, delta) {
        const input = btn.parentNode.querySelector('input');
        if (input) {
            let val = parseInt(input.value) || 0;
            input.value = Math.max(1, val + delta);
        }
    },

    submitPrintForm(btn) {
        const form = btn.closest('.ai-print-form');
        
        const paperSizeEl = form.querySelector('[data-field="paper_size"] .ai-active');
        const printTypeEl = form.querySelector('[data-field="print_type"] .ai-active');
        const paperTypeEl = form.querySelector('[data-field="paper_type"] .ai-active');
        
        const paperSize = paperSizeEl ? paperSizeEl.getAttribute('data-value') : 'A4';
        const printType = printTypeEl ? printTypeEl.getAttribute('data-value') : 'BW';
        const paperType = paperTypeEl ? paperTypeEl.getAttribute('data-value') : 'HVS';
        
        const totalPagesInput = form.querySelector('[data-field="total_pages"]');
        const quantityInput = form.querySelector('[data-field="quantity"]');
        
        const totalPages = totalPagesInput ? totalPagesInput.value : '10';
        const quantity = quantityInput ? quantityInput.value : '1';

        const text = `Tolong hitung biaya cetak untuk kertas ${paperType}, ukuran ${paperSize}, jenis cetak ${printType}, sebanyak ${totalPages} halaman, ${quantity} rangkap.`;
        
        btn.disabled = true;
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="ai-spinner" style="border-top-color:#fff;width:12px;height:12px;display:inline-block;vertical-align:middle;margin-right:4px;"></span> Menghitung…';

        document.getElementById('ai-input').value = text;
        
        form.style.pointerEvents = 'none';
        form.style.opacity = '0.7';

        this.send().finally(() => {
            btn.disabled = false;
            btn.innerHTML = originalHtml;
            form.style.pointerEvents = '';
            form.style.opacity = '';
        });
    },

    clearChat() {
        if (!confirm('Hapus semua riwayat percakapan?')) return;
        try { sessionStorage.removeItem(this.storageKey); } catch(e) {}
        document.getElementById('ai-messages').innerHTML = '';
        this.printToken = null;
        this.saveState();
        this.showWelcome();
    },
};

document.addEventListener('DOMContentLoaded', () => aiWidget.init());
</script>
