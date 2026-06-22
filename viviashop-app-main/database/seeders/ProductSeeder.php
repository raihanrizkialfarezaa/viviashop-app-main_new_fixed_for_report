<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\AttributeVariant;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductInventory;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\VariantAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    private int $userId;

    private array $brands = [];

    private array $categories = [];

    private array $attributes = [];

    private array $tableColumns = [];

    public function run(): void
    {
        DB::transaction(function () {
            $this->userId = $this->resolveUserId();

            $this->seedBrands();
            $this->seedCategories();
            $this->seedLegacyAttributes();

            $this->seedSimpleProduct();
            $this->seedConfigurableProduct();
            $this->seedSimpleSmartPrintProduct();
            $this->seedLegacyConfigurableProduct();
        });

        $this->command?->info('Seed produk ATK dummy selesai.');
    }

    private function resolveUserId(): int
    {
        $userId = User::query()->value('id');

        if ($userId) {
            return (int) $userId;
        }

        return (int) User::firstOrCreate(
            ['email' => 'seed-admin@viviashop.local'],
            [
                'name' => 'Seeder Admin',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        )->id;
    }

    private function columns(string $table): array
    {
        if (!isset($this->tableColumns[$table])) {
            $this->tableColumns[$table] = Schema::hasTable($table)
                ? Schema::getColumnListing($table)
                : [];
        }

        return $this->tableColumns[$table];
    }

    private function filterTableData(string $table, array $data): array
    {
        $columns = $this->columns($table);
        $filtered = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $columns, true)) {
                $filtered[$key] = $value;
            }
        }

        return $filtered;
    }

    private function createProduct(array $data): Product
    {
        if (!isset($data['slug']) && isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return Product::create($this->filterTableData('products', $data));
    }

    private function createVariant(array $data): ProductVariant
    {
        return ProductVariant::create($this->filterTableData('product_variants', $data));
    }

    private function createVariantAttribute(ProductVariant $variant, string $name, string $value, int $sortOrder): void
    {
        VariantAttribute::create([
            'variant_id' => $variant->id,
            'attribute_name' => $name,
            'attribute_value' => $value,
            'sort_order' => $sortOrder,
        ]);
    }

    private function createProductAttributeValue(array $data): void
    {
        ProductAttributeValue::create($this->filterTableData('product_attribute_values', $data));
    }

    private function createInventory(int $productId, int $qty): void
    {
        ProductInventory::create([
            'product_id' => $productId,
            'qty' => $qty,
        ]);
    }

    private function syncCategories(Product $product, array $categoryKeys): void
    {
        $categoryIds = array_map(
            fn (string $key) => $this->categories[$key]->id,
            $categoryKeys
        );

        $product->categories()->sync($categoryIds);
    }

    private function supportsAttributeVariants(): bool
    {
        return Schema::hasTable('attribute_variants')
            && in_array('attribute_variant_id', $this->columns('attribute_options'), true);
    }

    private function supportsAttributeHierarchyColumns(): bool
    {
        return in_array('attribute_variant_id', $this->columns('product_attribute_values'), true)
            && in_array('attribute_option_id', $this->columns('product_attribute_values'), true);
    }

    private function attributeOptionKey(int $attributeId, ?int $attributeVariantId, string $name, bool $useVariants): array
    {
        $key = ['name' => $name];
        $optionColumns = $this->columns('attribute_options');

        if ($useVariants && $attributeVariantId && in_array('attribute_variant_id', $optionColumns, true)) {
            $key['attribute_variant_id'] = $attributeVariantId;
        }

        if (in_array('attribute_id', $optionColumns, true)) {
            $key['attribute_id'] = $attributeId;
        }

        return $key;
    }

    private function seedBrands(): void
    {
        $definitions = [
            [
                'name' => 'Joyko',
                'slug' => 'joyko',
                'description' => 'Joyko - alat tulis kantor terpercaya',
            ],
            [
                'name' => 'Faber Castell',
                'slug' => 'faber-castell',
                'description' => 'Faber Castell - alat tulis berkualitas',
            ],
            [
                'name' => 'Bantex',
                'slug' => 'bantex',
                'description' => 'Bantex - solusi arsip dan organizer',
            ],
            [
                'name' => 'APP',
                'slug' => 'app',
                'description' => 'Asia Pulp & Paper - merek kertas terkemuka',
            ],
            [
                'name' => 'Sinar Dunia',
                'slug' => 'sinar-dunia',
                'description' => 'Sinar Dunia - kertas kantor',
            ],
            [
                'name' => 'PaperOne',
                'slug' => 'paperone',
                'description' => 'PaperOne - office paper premium',
            ],
        ];

        foreach ($definitions as $definition) {
            $this->brands[$definition['slug']] = Brand::updateOrCreate(
                ['slug' => $definition['slug']],
                [
                    'name' => $definition['name'],
                    'description' => $definition['description'],
                    'image' => null,
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedCategories(): void
    {
        $atk = Category::updateOrCreate(
            ['slug' => 'atk'],
            [
                'name' => 'ATK',
                'parent_id' => null,
            ]
        );

        $this->categories = [
            'atk' => $atk,
            'alat_tulis' => Category::updateOrCreate(
                ['slug' => 'atk-alat-tulis'],
                [
                    'name' => 'Alat Tulis',
                    'parent_id' => $atk->id,
                ]
            ),
            'kertas' => Category::updateOrCreate(
                ['slug' => 'atk-kertas'],
                [
                    'name' => 'Kertas',
                    'parent_id' => $atk->id,
                ]
            ),
            'arsip' => Category::updateOrCreate(
                ['slug' => 'atk-arsip'],
                [
                    'name' => 'Arsip & Organizer',
                    'parent_id' => $atk->id,
                ]
            ),
            'print' => Category::updateOrCreate(
                ['slug' => 'atk-print-fotokopi'],
                [
                    'name' => 'Print & Fotokopi',
                    'parent_id' => $atk->id,
                ]
            ),
        ];
    }

    private function seedLegacyAttributes(): void
    {
        $warna = Attribute::updateOrCreate(
            ['code' => 'warna'],
            [
                'name' => 'Warna',
                'type' => 'select',
                'validation' => null,
                'is_required' => true,
                'is_unique' => false,
                'is_filterable' => true,
                'is_configurable' => true,
            ]
        );

        $ukuran = Attribute::updateOrCreate(
            ['code' => 'ukuran'],
            [
                'name' => 'Ukuran',
                'type' => 'select',
                'validation' => null,
                'is_required' => true,
                'is_unique' => false,
                'is_filterable' => true,
                'is_configurable' => true,
            ]
        );

        $useVariants = $this->supportsAttributeVariants();

        $warnaVariant = null;
        $ukuranVariant = null;

        if ($useVariants) {
            $warnaVariant = AttributeVariant::updateOrCreate(
                ['attribute_id' => $warna->id, 'name' => 'Warna Produk'],
                []
            );
            $ukuranVariant = AttributeVariant::updateOrCreate(
                ['attribute_id' => $ukuran->id, 'name' => 'Ukuran Produk'],
                []
            );
        }

        $this->attributes = [
            'warna' => [
                'attribute' => $warna,
                'variant' => $warnaVariant,
                'options' => [
                    'merah' => AttributeOption::updateOrCreate(
                        $this->attributeOptionKey($warna->id, $warnaVariant?->id, 'Merah', $useVariants),
                        []
                    ),
                    'biru' => AttributeOption::updateOrCreate(
                        $this->attributeOptionKey($warna->id, $warnaVariant?->id, 'Biru', $useVariants),
                        []
                    ),
                ],
            ],
            'ukuran' => [
                'attribute' => $ukuran,
                'variant' => $ukuranVariant,
                'options' => [
                    'a4' => AttributeOption::updateOrCreate(
                        $this->attributeOptionKey($ukuran->id, $ukuranVariant?->id, 'A4', $useVariants),
                        []
                    ),
                    'f4' => AttributeOption::updateOrCreate(
                        $this->attributeOptionKey($ukuran->id, $ukuranVariant?->id, 'F4', $useVariants),
                        []
                    ),
                ],
            ],
        ];
    }

    private function seedSimpleProduct(): Product
    {
        $sku = 'ATK-PULPEN-GEL-JOYKO-001';

        Product::where('sku', $sku)->delete();

        $product = $this->createProduct([
            'sku' => $sku,
            'type' => 'simple',
            'name' => 'Pulpen Gel Joyko 0.5mm',
            'slug' => Str::slug('Pulpen Gel Joyko 0.5mm'),
            'brand_id' => $this->brands['joyko']->id,
            'price' => 7500,
            'base_price' => 7500,
            'harga_beli' => 4800,
            'total_stock' => 84,
            'sold_count' => 17,
            'rating' => 4.60,
            'weight' => 0.01,
            'length' => 14.50,
            'width' => 1.20,
            'height' => 1.20,
            'short_description' => 'Pulpen gel Joyko untuk kebutuhan tulis harian.',
            'description' => 'Dummy product ATK untuk stress test fitur pencarian, stok, kategori, dan brand.',
            'status' => Product::ACTIVE,
            'user_id' => $this->userId,
            'link1' => 'https://example.test/atk/pulpen-gel-joyko',
            'link2' => 'https://example.test/atk/pulpen-gel-joyko/spesifikasi',
            'link3' => null,
            'is_featured' => true,
            'is_print_service' => false,
            'is_smart_print_enabled' => false,
            'barcode' => 810000001,
        ]);

        $this->syncCategories($product, ['atk', 'alat_tulis']);
        $this->createInventory($product->id, 84);

        $product->update($this->filterTableData('products', [
            'price' => 7500,
            'base_price' => 7500,
            'harga_beli' => 4800,
            'total_stock' => 84,
            'sold_count' => 17,
            'rating' => 4.60,
        ]));

        return $product;
    }

    private function seedConfigurableProduct(): Product
    {
        $sku = 'ATK-KERTAS-HVS-MULTI-001';
        $this->deleteProductBySku($sku);
        $this->deleteVariantsBySkuPrefix('ATK-KERTAS-HVS-MULTI-');

        $variantData = [
            [
                'price' => 42000,
                'harga_beli' => 32000,
                'stock' => 120,
                'attributes' => [
                    'brand' => 'APP',
                    'paper_size' => 'A4',
                    'print_type' => 'BW',
                ],
                'min_stock_threshold' => 15,
            ],
            [
                'price' => 46000,
                'harga_beli' => 35000,
                'stock' => 75,
                'attributes' => [
                    'brand' => 'APP',
                    'paper_size' => 'A4',
                    'print_type' => 'Color',
                ],
                'min_stock_threshold' => 12,
            ],
            [
                'price' => 39000,
                'harga_beli' => 30000,
                'stock' => 45,
                'attributes' => [
                    'brand' => 'Sinar Dunia',
                    'paper_size' => 'F4',
                    'print_type' => 'BW',
                ],
                'min_stock_threshold' => 10,
            ],
            [
                'price' => 68000,
                'harga_beli' => 52000,
                'stock' => 8,
                'attributes' => [
                    'brand' => 'PaperOne',
                    'paper_size' => 'A3',
                    'print_type' => 'Color',
                ],
                'min_stock_threshold' => 10,
            ],
        ];

        $product = $this->createProduct([
            'sku' => $sku,
            'type' => 'configurable',
            'name' => 'Kertas HVS Multi Variasi',
            'slug' => Str::slug('Kertas HVS Multi Variasi'),
            'brand_id' => $this->brands['app']->id,
            'price' => 39000,
            'base_price' => 39000,
            'harga_beli' => 30000,
            'total_stock' => array_sum(array_column($variantData, 'stock')),
            'sold_count' => 42,
            'rating' => 4.85,
            'weight' => 0.50,
            'length' => 29.70,
            'width' => 21.00,
            'height' => 4.50,
            'short_description' => 'Kertas HVS dummy untuk stress test variant stock dan filter produk.',
            'description' => 'Produk dummy ATK untuk menguji product_variants, variant_attributes, dan stok tanpa gambar.',
            'status' => Product::ACTIVE,
            'user_id' => $this->userId,
            'link1' => 'https://example.test/atk/kertas-hvs-multi-variasi',
            'link2' => 'https://example.test/atk/kertas-hvs-multi-variasi/varian',
            'link3' => null,
            'is_featured' => true,
            'is_print_service' => true,
            'is_smart_print_enabled' => true,
            'barcode' => 810000002,
        ]);

        $this->syncCategories($product, ['atk', 'kertas', 'print']);

        foreach ($variantData as $index => $variantRow) {
            $variant = $this->createVariant([
                'product_id' => $product->id,
                'sku' => sprintf('ATK-KERTAS-HVS-MULTI-%02d', $index + 1),
                'name' => 'Kertas HVS Multi Variasi - ' . $variantRow['attributes']['brand'] . ' ' . $variantRow['attributes']['paper_size'] . ' ' . $variantRow['attributes']['print_type'],
                'price' => $variantRow['price'],
                'harga_beli' => $variantRow['harga_beli'],
                'stock' => $variantRow['stock'],
                'weight' => 0.50,
                'barcode' => '8100002' . str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT),
                'is_active' => true,
                'min_stock_threshold' => $variantRow['min_stock_threshold'],
                'paper_size' => $variantRow['attributes']['paper_size'],
                'print_type' => strtolower($variantRow['attributes']['print_type']) === 'bw' ? 'bw' : 'color',
            ]);

            $this->createVariantAttribute($variant, 'brand', $variantRow['attributes']['brand'], 0);
            $this->createVariantAttribute($variant, 'paper_size', $variantRow['attributes']['paper_size'], 1);
            $this->createVariantAttribute($variant, 'print_type', $variantRow['attributes']['print_type'], 2);
        }

        $product->update($this->filterTableData('products', [
            'price' => 39000,
            'base_price' => 39000,
            'harga_beli' => 30000,
            'total_stock' => array_sum(array_column($variantData, 'stock')),
            'sold_count' => 42,
            'rating' => 4.85,
        ]));

        return $product;
    }

    private function seedLegacyConfigurableProduct(): Product
    {
        $parentSku = 'ATK-MAP-PLASTIK-BANTEX-001';
        $childSkus = [
            'ATK-MAP-PLASTIK-BANTEX-MERAH-A4',
            'ATK-MAP-PLASTIK-BANTEX-MERAH-F4',
            'ATK-MAP-PLASTIK-BANTEX-BIRU-A4',
            'ATK-MAP-PLASTIK-BANTEX-BIRU-F4',
        ];

        foreach ($childSkus as $childSku) {
            $this->deleteProductBySku($childSku);
        }

        $this->deleteProductBySku($parentSku);

        $parent = $this->createProduct([
            'sku' => $parentSku,
            'type' => 'configurable',
            'name' => 'Map Plastik Bantex Kombinasi',
            'slug' => Str::slug('Map Plastik Bantex Kombinasi'),
            'brand_id' => $this->brands['bantex']->id,
            'price' => 22000,
            'base_price' => 22000,
            'harga_beli' => 15000,
            'total_stock' => 0,
            'sold_count' => 9,
            'rating' => 4.30,
            'weight' => 0.12,
            'length' => 32.00,
            'width' => 24.00,
            'height' => 2.00,
            'short_description' => 'Map plastik Bantex untuk arsip dokumen ATK.',
            'description' => 'Dummy product legacy configurable untuk menguji relasi parent_id, product_attribute_values, dan filter atribut lama.',
            'status' => Product::ACTIVE,
            'user_id' => $this->userId,
            'link1' => 'https://example.test/atk/map-plastik-bantex',
            'link2' => 'https://example.test/atk/map-plastik-bantex/varian',
            'link3' => null,
            'is_featured' => false,
            'is_print_service' => false,
            'is_smart_print_enabled' => false,
            'barcode' => 810000003,
        ]);

        $this->syncCategories($parent, ['atk', 'arsip']);

        $variants = [
            [
                'sku' => 'ATK-MAP-PLASTIK-BANTEX-MERAH-A4',
                'name' => 'Map Plastik Bantex - Merah A4',
                'price' => 22000,
                'harga_beli' => 15000,
                'stock' => 24,
                'barcode' => '810000101',
                'attributes' => [
                    ['attribute_key' => 'warna', 'option_key' => 'merah'],
                    ['attribute_key' => 'ukuran', 'option_key' => 'a4'],
                ],
            ],
            [
                'sku' => 'ATK-MAP-PLASTIK-BANTEX-MERAH-F4',
                'name' => 'Map Plastik Bantex - Merah F4',
                'price' => 23000,
                'harga_beli' => 15500,
                'stock' => 18,
                'barcode' => '810000102',
                'attributes' => [
                    ['attribute_key' => 'warna', 'option_key' => 'merah'],
                    ['attribute_key' => 'ukuran', 'option_key' => 'f4'],
                ],
            ],
            [
                'sku' => 'ATK-MAP-PLASTIK-BANTEX-BIRU-A4',
                'name' => 'Map Plastik Bantex - Biru A4',
                'price' => 22500,
                'harga_beli' => 15200,
                'stock' => 30,
                'barcode' => '810000103',
                'attributes' => [
                    ['attribute_key' => 'warna', 'option_key' => 'biru'],
                    ['attribute_key' => 'ukuran', 'option_key' => 'a4'],
                ],
            ],
            [
                'sku' => 'ATK-MAP-PLASTIK-BANTEX-BIRU-F4',
                'name' => 'Map Plastik Bantex - Biru F4',
                'price' => 23500,
                'harga_beli' => 15800,
                'stock' => 12,
                'barcode' => '810000104',
                'attributes' => [
                    ['attribute_key' => 'warna', 'option_key' => 'biru'],
                    ['attribute_key' => 'ukuran', 'option_key' => 'f4'],
                ],
            ],
        ];

        foreach ($variants as $variant) {
            $child = $this->createProduct([
                'sku' => $variant['sku'],
                'type' => 'simple',
                'name' => $variant['name'],
                'slug' => Str::slug($variant['name']),
                'brand_id' => $this->brands['bantex']->id,
                'price' => $variant['price'],
                'base_price' => $variant['price'],
                'harga_beli' => $variant['harga_beli'],
                'total_stock' => $variant['stock'],
                'sold_count' => 0,
                'rating' => 0,
                'weight' => 0.12,
                'length' => 32.00,
                'width' => 24.00,
                'height' => 2.00,
                'short_description' => 'Varian legacy untuk stress test atribut lama.',
                'description' => 'Child product legacy untuk menguji kombinasi atribut warna dan ukuran.',
                'status' => Product::ACTIVE,
                'user_id' => $this->userId,
                'link1' => 'https://example.test/atk/map-plastik-bantex',
                'link2' => null,
                'link3' => null,
                'parent_id' => $parent->id,
                'is_featured' => false,
                'is_print_service' => false,
                'is_smart_print_enabled' => false,
                'barcode' => $variant['barcode'],
            ]);

            $this->syncCategories($child, ['atk', 'arsip']);
            $this->createInventory($child->id, $variant['stock']);

            foreach ($variant['attributes'] as $attributeInfo) {
                $attributeKey = $attributeInfo['attribute_key'];
                $optionKey = $attributeInfo['option_key'];
                $attribute = $this->attributes[$attributeKey]['attribute'];
                $variantRef = $this->attributes[$attributeKey]['variant'] ?? null;
                $option = $this->attributes[$attributeKey]['options'][$optionKey];

                $attributeValue = [
                    'parent_product_id' => $parent->id,
                    'product_id' => $child->id,
                    'attribute_id' => $attribute->id,
                    'text_value' => $option->name,
                ];

                if ($this->supportsAttributeHierarchyColumns()) {
                    $attributeValue['attribute_variant_id'] = $variantRef?->id;
                    $attributeValue['attribute_option_id'] = $option->id;
                }

                $this->createProductAttributeValue($attributeValue);
            }
        }

        $parent->update($this->filterTableData('products', [
            'price' => 22000,
            'base_price' => 22000,
            'harga_beli' => 15000,
            'total_stock' => array_sum(array_column($variants, 'stock')),
            'sold_count' => 9,
            'rating' => 4.30,
        ]));

        return $parent;
    }

    private function seedSimpleSmartPrintProduct(): Product
    {
        $sku = 'ATK-PRINT-SMART-A4-001';

        $this->deleteProductBySku($sku);
        $this->deleteVariantsBySkuPrefix('ATK-PRINT-SMART-A4-');

        $product = $this->createProduct([
            'sku' => $sku,
            'type' => 'simple',
            'name' => 'Layanan Print Smart A4',
            'slug' => Str::slug('Layanan Print Smart A4'),
            'brand_id' => $this->brands['app']->id,
            'price' => 2000,
            'base_price' => 2000,
            'harga_beli' => 1200,
            'total_stock' => 200,
            'sold_count' => 0,
            'rating' => 0,
            'weight' => 0.10,
            'length' => 29.70,
            'width' => 21.00,
            'height' => 0.05,
            'short_description' => 'Produk smart print untuk test alur print service.',
            'description' => 'Dummy smart print service untuk menguji varian default (BW dan Color) tanpa gambar.',
            'status' => Product::ACTIVE,
            'user_id' => $this->userId,
            'link1' => 'https://example.test/atk/layanan-print-smart-a4',
            'link2' => null,
            'link3' => null,
            'is_featured' => false,
            'is_print_service' => true,
            'is_smart_print_enabled' => true,
            'barcode' => 810000004,
        ]);

        $this->syncCategories($product, ['atk', 'print']);
        $this->createInventory($product->id, 200);

        $variants = [
            [
                'sku' => 'ATK-PRINT-SMART-A4-BW',
                'name' => 'Layanan Print Smart A4 - Black & White',
                'price' => 2000,
                'harga_beli' => 1200,
                'stock' => 200,
                'print_type' => 'bw',
                'paper_size' => 'A4',
                'attributes' => [
                    'print_type' => 'Black & White',
                    'paper_size' => 'A4',
                ],
                'min_stock_threshold' => 20,
            ],
            [
                'sku' => 'ATK-PRINT-SMART-A4-COLOR',
                'name' => 'Layanan Print Smart A4 - Color',
                'price' => 3500,
                'harga_beli' => 2200,
                'stock' => 120,
                'print_type' => 'color',
                'paper_size' => 'A4',
                'attributes' => [
                    'print_type' => 'Color',
                    'paper_size' => 'A4',
                ],
                'min_stock_threshold' => 12,
            ],
        ];

        foreach ($variants as $variantRow) {
            $variant = $this->createVariant([
                'product_id' => $product->id,
                'sku' => $variantRow['sku'],
                'name' => $variantRow['name'],
                'price' => $variantRow['price'],
                'harga_beli' => $variantRow['harga_beli'],
                'stock' => $variantRow['stock'],
                'weight' => 0.10,
                'barcode' => $variantRow['print_type'] === 'bw' ? '810000401' : '810000402',
                'is_active' => true,
                'min_stock_threshold' => $variantRow['min_stock_threshold'],
                'paper_size' => $variantRow['paper_size'],
                'print_type' => $variantRow['print_type'],
            ]);

            $sortOrder = 0;
            foreach ($variantRow['attributes'] as $attrName => $attrValue) {
                $this->createVariantAttribute($variant, $attrName, $attrValue, $sortOrder++);
            }
        }

        $product->update($this->filterTableData('products', [
            'price' => 2000,
            'base_price' => 2000,
            'harga_beli' => 1200,
            'total_stock' => 200,
        ]));

        return $product;
    }

    private function deleteProductBySku(string $sku): void
    {
        $product = Product::where('sku', $sku)->first();

        if (! $product) {
            return;
        }

        $variantIds = ProductVariant::where('product_id', $product->id)->pluck('id');
        if ($variantIds->isNotEmpty()) {
            VariantAttribute::whereIn('variant_id', $variantIds)->delete();
            ProductVariant::whereIn('id', $variantIds)->delete();
        }

        ProductInventory::where('product_id', $product->id)->delete();
        ProductAttributeValue::where('parent_product_id', $product->id)
            ->orWhere('product_id', $product->id)
            ->delete();
        $product->categories()->detach();
        $product->delete();
    }

    private function deleteVariantsBySkuPrefix(string $prefix): void
    {
        $variantIds = ProductVariant::where('sku', 'like', $prefix . '%')->pluck('id');
        if ($variantIds->isEmpty()) {
            return;
        }

        VariantAttribute::whereIn('variant_id', $variantIds)->delete();
        ProductVariant::whereIn('id', $variantIds)->delete();
    }
}
