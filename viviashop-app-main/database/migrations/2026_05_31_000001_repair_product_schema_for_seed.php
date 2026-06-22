<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->repairProductsTable();
        $this->repairProductVariantsTable();
        $this->repairAttributeVariants();
        $this->repairAttributeOptions();
        $this->repairProductAttributeValues();
    }

    public function down(): void
    {
        // Intentionally left empty to avoid destructive rollback on existing data.
    }

    private function repairProductsTable(): void
    {
        if (!Schema::hasColumn('products', 'brand_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('brand_id')->nullable()->after('user_id');
            });
        }

        if (!Schema::hasColumn('products', 'base_price')) {
            Schema::table('products', function (Blueprint $table) {
                $table->decimal('base_price', 15, 2)->nullable()->after('price');
            });
        }

        if (!Schema::hasColumn('products', 'total_stock')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('total_stock')->default(0)->after('base_price');
            });
        }

        if (!Schema::hasColumn('products', 'sold_count')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('sold_count')->default(0)->after('total_stock');
            });
        }

        if (!Schema::hasColumn('products', 'rating')) {
            Schema::table('products', function (Blueprint $table) {
                $table->decimal('rating', 3, 2)->default(0)->after('sold_count');
            });
        }

        if (!Schema::hasColumn('products', 'is_featured')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_featured')->default(false)->after('rating');
            });
        }

        if (!Schema::hasColumn('products', 'is_print_service')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_print_service')->default(false)->after('status');
            });
        }

        if (!Schema::hasColumn('products', 'is_smart_print_enabled')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_smart_print_enabled')->default(false)->after('status');
            });
        }

        if (!Schema::hasColumn('products', 'barcode')) {
            Schema::table('products', function (Blueprint $table) {
                $table->bigInteger('barcode')->nullable()->after('height');
            });
        }
    }

    private function repairProductVariantsTable(): void
    {
        if (!Schema::hasColumn('product_variants', 'length')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->decimal('length', 10, 2)->nullable()->after('weight');
            });
        }

        if (!Schema::hasColumn('product_variants', 'width')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->decimal('width', 10, 2)->nullable()->after('length');
            });
        }

        if (!Schema::hasColumn('product_variants', 'height')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->decimal('height', 10, 2)->nullable()->after('width');
            });
        }
    }

    private function repairAttributeVariants(): void
    {
        if (!Schema::hasTable('attribute_variants')) {
            Schema::create('attribute_variants', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedBigInteger('attribute_id');
                $table->timestamps();
            });
        }

        if (Schema::hasTable('attributes') && Schema::hasTable('attribute_variants')) {
            $attributes = DB::table('attributes')->select('id', 'name')->get();
            foreach ($attributes as $attribute) {
                DB::table('attribute_variants')->updateOrInsert(
                    ['attribute_id' => $attribute->id, 'name' => $attribute->name . ' Variant'],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }

    private function repairAttributeOptions(): void
    {
        if (!Schema::hasTable('attribute_options')) {
            return;
        }

        if (!Schema::hasColumn('attribute_options', 'attribute_variant_id')) {
            Schema::table('attribute_options', function (Blueprint $table) {
                $table->unsignedBigInteger('attribute_variant_id')->nullable()->after('attribute_id');
            });
        }

        if (Schema::hasColumn('attribute_options', 'attribute_id') && Schema::hasTable('attribute_variants')) {
            $variants = DB::table('attribute_variants')->select('id', 'attribute_id')->get();
            foreach ($variants as $variant) {
                DB::table('attribute_options')
                    ->where('attribute_id', $variant->attribute_id)
                    ->whereNull('attribute_variant_id')
                    ->update(['attribute_variant_id' => $variant->id]);
            }
        }
    }

    private function repairProductAttributeValues(): void
    {
        if (!Schema::hasColumn('product_attribute_values', 'attribute_variant_id')) {
            Schema::table('product_attribute_values', function (Blueprint $table) {
                $table->unsignedBigInteger('attribute_variant_id')->nullable()->after('attribute_id');
            });
        }

        if (!Schema::hasColumn('product_attribute_values', 'attribute_option_id')) {
            Schema::table('product_attribute_values', function (Blueprint $table) {
                $table->unsignedBigInteger('attribute_option_id')->nullable()->after('attribute_variant_id');
            });
        }
    }
};
