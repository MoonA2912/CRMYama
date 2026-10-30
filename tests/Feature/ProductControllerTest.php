<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

it('stores a product image URL returned by Cloudinary', function () {
    config([
        'services.cloudinary.cloud_name' => 'test-cloud',
        'services.cloudinary.upload_preset' => 'unsigned-preset',
    ]);

    Http::preventStrayRequests();
    Http::fake([
        'api.cloudinary.com/*' => Http::response([
            'secure_url' => 'https://res.cloudinary.com/test-cloud/image/upload/product.png',
        ]),
    ]);

    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->post(route('products.store'), [
            'name' => 'Driver',
            'category' => 'Golf Club',
            'price' => 100,
            'stock' => 3,
            'description' => 'Test product',
            'is_active' => true,
            'image' => UploadedFile::fake()->image('product.png'),
        ])
        ->assertRedirect(route('products.index'));

    $this->assertDatabaseHas('products', [
        'name' => 'Driver',
        'image' => 'https://res.cloudinary.com/test-cloud/image/upload/product.png',
    ]);
});

it('keeps the existing product when Cloudinary rejects an upload', function () {
    config([
        'services.cloudinary.cloud_name' => 'test-cloud',
        'services.cloudinary.upload_preset' => 'unsigned-preset',
    ]);

    Http::preventStrayRequests();
    Http::fake([
        'api.cloudinary.com/*' => Http::response([
            'error' => ['message' => 'Upload preset is invalid.'],
        ], 400),
    ]);

    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->from(route('products.create'))
        ->post(route('products.store'), [
            'name' => 'Driver',
            'category' => 'Golf Club',
            'price' => 100,
            'stock' => 3,
            'description' => 'Test product',
            'is_active' => true,
            'image' => UploadedFile::fake()->image('product.png'),
        ])
        ->assertRedirect(route('products.create'))
        ->assertSessionHasErrors('image');

    $this->assertDatabaseCount('products', 0);
});

it('updates a product image URL returned by Cloudinary', function () {
    config([
        'services.cloudinary.cloud_name' => 'test-cloud',
        'services.cloudinary.upload_preset' => 'unsigned-preset',
    ]);

    Http::preventStrayRequests();
    Http::fake([
        'api.cloudinary.com/*' => Http::response([
            'secure_url' => 'https://res.cloudinary.com/test-cloud/image/upload/updated.png',
        ]),
    ]);

    $admin = User::factory()->create(['role' => 'admin']);
    $product = Product::create([
        'name' => 'Driver',
        'category' => 'Golf Club',
        'price' => 100,
        'stock' => 3,
        'description' => 'Test product',
        'is_active' => true,
        'image' => 'products/old.png',
    ]);

    $this->actingAs($admin)
        ->put(route('products.update', $product), [
            'name' => 'Driver',
            'category' => 'Golf Club',
            'price' => 100,
            'stock' => 3,
            'description' => 'Test product',
            'is_active' => true,
            'image' => UploadedFile::fake()->image('updated.png'),
        ])
        ->assertRedirect(route('products.index'));

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'image' => 'https://res.cloudinary.com/test-cloud/image/upload/updated.png',
    ]);
});
