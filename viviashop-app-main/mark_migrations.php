<?php
/**
 * Mark all pending migrations as run without executing them.
 * Use when the DB was imported from a dump that already has the schema.
 * Run: php mark_migrations.php
 */

require __DIR__ . '/vendor/autoload.php';
$app    = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$pending = [
    '2025_03_10_075247_add_notes_field_to_orders_table',
    '2025_04_13_054734_create_instagram_basic_profile_table',
    '2025_04_13_054734_create_instagram_feed_token_table',
    '2025_04_13_054734_create_shoppingcart_table',
    '2025_04_18_192428_add_instagram_access_token_field_to_users_table',
    '2025_06_27_131821_add_barcode_field_to_products_table',
    '2025_08_06_133833_create_attribute_variants_table',
    '2025_08_06_133859_modify_attribute_options_table',
    '2025_08_06_134346_migrate_existing_attribute_options_to_variants',
    '2025_08_12_000001_add_attribute_hierarchy_to_product_attribute_values',
    '2025_08_12_000002_make_attributes_nullable',
    '2025_08_13_000316_add_district_id_to_users_table',
    '2025_09_06_104150_create_brands_table',
    '2025_09_06_104212_create_product_variants_table',
    '2025_09_06_104229_create_variant_attributes_table',
    '2025_09_06_104310_add_brand_and_base_price_to_products_table',
    '2025_09_06_104728_add_variant_id_to_order_items_table',
    '2025_09_09_093753_add_employee_tracking_to_orders_table',
    '2025_09_09_093814_create_employee_performances_table',
    '2025_09_09_093845_create_employee_bonuses_table',
    '2025_09_09_103257_add_description_to_employee_bonuses_table',
    '2025_09_09_103514_update_employee_bonuses_table_nullable_employee_name',
    '2025_09_11_100000_add_print_service_to_products_table',
    '2025_09_11_101000_add_print_fields_to_product_variants_table',
    '2025_09_11_102000_add_order_type_to_orders_table',
    '2025_09_11_110000_create_print_sessions_table',
    '2025_09_11_114442_add_session_id_to_print_files_table',
    '2025_09_11_114923_fix_print_sessions_started_at_field',
    '2025_09_11_115011_fix_print_orders_payment_method_enum',
    '2025_09_11_120000_create_print_orders_table',
    '2025_09_11_130000_create_print_files_table',
    '2025_09_11_171837_create_stock_movements_table',
    '2025_09_11_180716_add_is_print_service_to_products_table',
    '2025_09_13_120424_add_shipping_adjustment_fields_to_orders_table',
    '2025_09_14_093507_add_variant_support_to_pembelian_details_table',
    '2025_09_14_093536_add_status_and_payment_method_to_pembelians_table',
    '2025_09_16_004813_add_smart_print_to_products_table',
    '2025_09_21_160130_expand_paper_size_enum_values',
    '2025_09_21_161120_convert_enum_to_string_for_dynamic_paper_types',
    '2025_09_21_161303_create_paper_types_table',
    '2025_09_21_161321_create_print_types_table',
    '2025_09_21_162056_update_print_orders_enum_to_string',
    '2025_10_08_083852_add_additional_field_to_settings_table',
];

$batch    = DB::table('migrations')->max('batch') + 1;
$inserted = 0;

foreach ($pending as $migration) {
    $exists = DB::table('migrations')->where('migration', $migration)->exists();
    if (! $exists) {
        DB::table('migrations')->insert(['migration' => $migration, 'batch' => $batch]);
        $inserted++;
        echo "  Marked: {$migration}\n";
    } else {
        echo "  Skip (already exists): {$migration}\n";
    }
}

echo "\nDone. Marked {$inserted} migrations as run (batch {$batch}).\n";
