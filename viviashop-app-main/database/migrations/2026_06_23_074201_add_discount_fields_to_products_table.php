<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Add discount-related fields to products table
     * to allow products to have promotional pricing.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('discount_price', 15, 2)->nullable()->after('price');
            $table->integer('discount_percent')->default(0)->after('discount_price');
            $table->timestamp('discount_starts_at')->nullable()->after('discount_percent');
            $table->timestamp('discount_ends_at')->nullable()->after('discount_starts_at');
            
            // Add indexes for better query performance
            $table->index(['discount_price', 'discount_starts_at', 'discount_ends_at'], 'idx_product_discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_product_discount');
            $table->dropColumn(['discount_price', 'discount_percent', 'discount_starts_at', 'discount_ends_at']);
        });
    }
};
