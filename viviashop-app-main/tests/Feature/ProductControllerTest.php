<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $admin;
    protected $guest;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create admin user
        $this->admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'is_admin' => 1,
        ]);

        // Create regular user (guest)
        $this->guest = User::factory()->create([
            'name' => 'Guest User',
            'email' => 'guest@test.com',
            'is_admin' => 0,
        ]);
    }

    /** @test */
    public function admin_can_view_products_list()
    {
        // Create some test products
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        
        Product::factory()->count(3)->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.products.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.index');
        $response->assertViewHas('products');
    }

    /** @test */
    public function guest_cannot_access_products_admin_panel()
    {
        $response = $this->actingAs($this->guest)
            ->get(route('admin.products.index'));

        $response->assertStatus(403);
    }

    /** @test */
    public function unauthenticated_user_redirected_to_login()
    {
        $response = $this->get(route('admin.products.index'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function admin_can_view_create_product_form()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.products.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.create');
    }

    /** @test */
    public function admin_can_create_product()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $productData = [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'This is a test product',
            'price' => 50000,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'weight' => 500,
            'stock' => 10,
            'sku' => 'TEST-SKU-001',
            'type' => 'simple',
            'status' => 1,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.products.store'), $productData);

        $response->assertRedirect();
        
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'sku' => 'TEST-SKU-001',
        ]);
    }

    /** @test */
    public function product_creation_requires_name()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $productData = [
            'slug' => 'test-product',
            'description' => 'Test description',
            'price' => 50000,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.products.store'), $productData);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function product_creation_requires_valid_price()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $productData = [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Test description',
            'price' => -100, // Invalid: negative price
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.products.store'), $productData);

        $response->assertSessionHasErrors('price');
    }

    /** @test */
    public function admin_can_view_product_details()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.products.show', $product->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.show');
        $response->assertViewHas('product');
    }

    /** @test */
    public function admin_can_view_edit_product_form()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.products.edit', $product->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.edit');
        $response->assertViewHas('product');
    }

    /** @test */
    public function admin_can_update_product()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'name' => 'Original Name',
        ]);

        $updateData = [
            'name' => 'Updated Product Name',
            'slug' => $product->slug,
            'description' => 'Updated description',
            'price' => 75000,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'weight' => 600,
            'stock' => 20,
            'sku' => $product->sku,
            'type' => 'simple',
            'status' => 1,
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.products.update', $product->id), $updateData);

        $response->assertRedirect();

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'price' => 75000,
        ]);
    }

    /** @test */
    public function admin_can_delete_product()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.products.destroy', $product->id));

        $response->assertRedirect();

        $this->assertSoftDeleted('products', [
            'id' => $product->id,
        ]);
    }

    /** @test */
    public function guest_cannot_create_product()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $productData = [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Test description',
            'price' => 50000,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ];

        $response = $this->actingAs($this->guest)
            ->post(route('admin.products.store'), $productData);

        $response->assertStatus(403);
    }

    /** @test */
    public function guest_cannot_update_product()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $updateData = [
            'name' => 'Updated Name',
        ];

        $response = $this->actingAs($this->guest)
            ->put(route('admin.products.update', $product->id), $updateData);

        $response->assertStatus(403);
    }

    /** @test */
    public function guest_cannot_delete_product()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $response = $this->actingAs($this->guest)
            ->delete(route('admin.products.destroy', $product->id));

        $response->assertStatus(403);
    }
}
