<?php
/**
 * Check which tables exist and create missing ones.
 * Run: php create_missing_tables.php
 */

require __DIR__ . '/vendor/autoload.php';
$app    = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

$tables = [
    'product_variants',
    'variant_attributes',
    'employee_performances',
    'employee_bonuses',
    'print_sessions',
    'print_orders',
    'print_files',
    'stock_movements',
    'paper_types',
    'print_types',
    'brands',
];

echo "=== Table Status ===\n";
foreach ($tables as $t) {
    $exists = Schema::hasTable($t);
    echo ($exists ? '[EXISTS] ' : '[MISSING]') . " {$t}\n";
}

echo "\n=== Creating Missing Tables ===\n";

// product_variants
if (! Schema::hasTable('product_variants')) {
    Schema::create('product_variants', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('product_id');
        $table->string('sku')->unique();
        $table->string('name');
        $table->decimal('price', 15, 2);
        $table->decimal('harga_beli', 15, 2)->nullable();
        $table->integer('stock')->default(0);
        $table->decimal('weight', 10, 2)->nullable();
        $table->string('barcode')->nullable();
        $table->boolean('is_active')->default(true);
        $table->integer('min_stock_threshold')->default(10);
        $table->string('paper_size')->nullable();
        $table->string('print_type')->nullable();
        $table->timestamps();
    });
    echo "[CREATED] product_variants\n";
}

// variant_attributes
if (! Schema::hasTable('variant_attributes')) {
    Schema::create('variant_attributes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('variant_id');
        $table->string('attribute_name');
        $table->string('attribute_value');
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
    echo "[CREATED] variant_attributes\n";
}

// employee_performances
if (! Schema::hasTable('employee_performances')) {
    Schema::create('employee_performances', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id');
        $table->string('employee_name');
        $table->decimal('transaction_value', 15, 2);
        $table->timestamp('completed_at')->nullable();
        $table->timestamps();
    });
    echo "[CREATED] employee_performances\n";
}

// employee_bonuses
if (! Schema::hasTable('employee_bonuses')) {
    Schema::create('employee_bonuses', function (Blueprint $table) {
        $table->id();
        $table->string('employee_name')->nullable();
        $table->decimal('bonus_amount', 15, 2);
        $table->text('description')->nullable();
        $table->date('period_start');
        $table->date('period_end');
        $table->text('notes')->nullable();
        $table->unsignedBigInteger('given_by');
        $table->timestamp('given_at')->useCurrent();
        $table->timestamps();
    });
    echo "[CREATED] employee_bonuses\n";
}

// print_sessions
if (! Schema::hasTable('print_sessions')) {
    Schema::create('print_sessions', function (Blueprint $table) {
        $table->id();
        $table->string('session_token', 32)->unique();
        $table->string('barcode_token', 32)->unique();
        $table->boolean('is_active')->default(true);
        $table->string('current_step')->default('upload');
        $table->timestamp('started_at')->nullable();
        $table->timestamp('expires_at');
        $table->timestamps();
    });
    echo "[CREATED] print_sessions\n";
}

// print_orders
if (! Schema::hasTable('print_orders')) {
    Schema::create('print_orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_code')->unique();
        $table->string('customer_phone', 20);
        $table->string('customer_name');
        $table->json('file_data');
        $table->unsignedBigInteger('paper_product_id')->nullable();
        $table->unsignedBigInteger('paper_variant_id')->nullable();
        $table->string('print_type')->nullable();
        $table->integer('quantity');
        $table->integer('total_pages');
        $table->decimal('unit_price', 10, 2);
        $table->decimal('total_price', 10, 2);
        $table->string('payment_method', 50)->default('toko');
        $table->string('status')->default('payment_pending');
        $table->string('payment_status')->default('unpaid');
        $table->string('payment_proof')->nullable();
        $table->string('payment_token')->nullable();
        $table->string('payment_url')->nullable();
        $table->unsignedBigInteger('session_id')->nullable();
        $table->timestamp('uploaded_at')->nullable();
        $table->timestamp('printed_at')->nullable();
        $table->timestamp('completed_at')->nullable();
        $table->timestamps();
    });
    echo "[CREATED] print_orders\n";
}

// print_files
if (! Schema::hasTable('print_files')) {
    Schema::create('print_files', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('print_order_id')->nullable();
        $table->unsignedBigInteger('print_session_id')->nullable();
        $table->string('file_path');
        $table->string('file_name');
        $table->string('file_type', 10);
        $table->bigInteger('file_size');
        $table->integer('pages_count');
        $table->boolean('is_processed')->default(false);
        $table->timestamps();
    });
    echo "[CREATED] print_files\n";
}

// stock_movements
if (! Schema::hasTable('stock_movements')) {
    Schema::create('stock_movements', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('variant_id');
        $table->string('movement_type'); // 'in' | 'out'
        $table->integer('quantity');
        $table->integer('old_stock');
        $table->integer('new_stock');
        $table->string('reference_type')->nullable();
        $table->unsignedBigInteger('reference_id')->nullable();
        $table->string('reason');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
    echo "[CREATED] stock_movements\n";
}

// paper_types
if (! Schema::hasTable('paper_types')) {
    Schema::create('paper_types', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('display_name');
        $table->text('description')->nullable();
        $table->decimal('price_multiplier', 8, 2)->default(1.00);
        $table->boolean('is_active')->default(true);
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
    echo "[CREATED] paper_types\n";
}

// print_types
if (! Schema::hasTable('print_types')) {
    Schema::create('print_types', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('display_name');
        $table->text('description')->nullable();
        $table->decimal('price_multiplier', 8, 2)->default(1.00);
        $table->boolean('is_active')->default(true);
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
    echo "[CREATED] print_types\n";
}

// brands
if (! Schema::hasTable('brands')) {
    Schema::create('brands', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
    echo "[CREATED] brands\n";
}

echo "\nDone.\n";
