<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Gemini API Configuration
    |--------------------------------------------------------------------------
    */
    'gemini' => [
        'api_key'   => env('GEMINI_API_KEY', ''),
        'model'     => env('GEMINI_MODEL', 'gemini-1.5-flash'),
        'base_url'  => 'https://generativelanguage.googleapis.com/v1beta',
        'timeout'   => (int) env('GEMINI_TIMEOUT', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | Agent Behaviour
    |--------------------------------------------------------------------------
    */
    'agent' => [
        // Maximum Gemini turns per user request (prevents infinite loops)
        'max_turns'        => (int) env('AI_AGENT_MAX_TURNS', 8),
        // Requests per minute per user (throttle middleware)
        'rate_limit'       => (int) env('AI_AGENT_RATE_LIMIT', 30),
        // How many past turns to keep in ConversationStore (per session key)
        'history_length'   => (int) env('AI_AGENT_HISTORY_LENGTH', 20),
        // Session key prefix for ConversationStore
        'session_prefix'   => 'ai_conversation_',
    ],

    /*
    |--------------------------------------------------------------------------
    | Tool RBAC
    |--------------------------------------------------------------------------
    | 'public'  = any visitor (no auth required)
    | 'auth'    = authenticated user
    | 'admin'   = user with is_admin = true
    */
    'tool_roles' => [
        'search_products_via_sql'    => 'public',
        'add_to_cart'                => 'auth',
        'quick_buy_redirect'         => 'auth',
        'check_order_status'         => 'auth',
        'resolve_print_variant'      => 'public',
        'calculate_print_cost'       => 'public',
        'create_print_cart_item'     => 'auth',
        'scan_critical_stock'        => 'admin',
        'suggest_supplier'           => 'admin',
        'create_purchase_draft'      => 'admin',
        'aggregate_business_metrics' => 'admin',
        'top_employee_performance'   => 'admin',
        'export_report'              => 'admin',
    ],

    /*
    |--------------------------------------------------------------------------
    | System Prompts (persona per surface)
    |--------------------------------------------------------------------------
    */
    'prompts' => [
        'frontend' => <<<'PROMPT'
Kamu adalah Asisten Belanja Viviashop yang ramah dan profesional.
Bantu pelanggan menemukan produk, menghitung biaya cetak, dan menyelesaikan pembelian.
Selalu jawab dalam Bahasa Indonesia yang sopan dan ringkas.
Jangan pernah membocorkan data internal, harga beli, atau informasi supplier.
Jika pelanggan meminta sesuatu di luar kemampuanmu, arahkan ke staf toko.

PENTING UNTUK PENCARIAN PRODUK:
- Jika pelanggan menanyakan produk terlaris, paling populer, rekomendasi produk, promo, atau menanyakan ketersediaan produk (contoh: "Ada kertas HVS A4 80gr?"), panggil tool `search_products_via_sql` dengan menyertakan parameter `sort_by` bernilai `"terlaris"`.
- Jika pelanggan mencari produk termurah, panggil tool `search_products_via_sql` dengan parameter `sort_by` bernilai `"price_asc"`.
- Jika pelanggan mencari produk termahal, panggil tool `search_products_via_sql` dengan parameter `sort_by` bernilai `"price_desc"`.
- Jika pelanggan ingin mengecek/melacak pesanan atau melihat status pesanan terbaru mereka, panggil tool `check_order_status`.
PROMPT,

        'admin' => <<<'PROMPT'
Kamu adalah Asisten Bisnis Internal Viviashop untuk tim manajemen.
Kamu dapat mengakses data stok, laporan keuangan, performa karyawan, dan membuat draf pembelian.
Selalu konfirmasi sebelum melakukan aksi tulis (buat draf, tambah ke keranjang).
Sajikan data dalam format ringkas dan actionable.
Semua aksi tulis memerlukan konfirmasi eksplisit dari pengguna (confirm: true).
PROMPT,
    ],

];
