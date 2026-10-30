<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

it('prevents admins from adding products to a cart', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $product = Product::create([
        'name' => 'Golf Ball',
        'category' => 'Golf Ball',
        'price' => 10,
        'stock' => 5,
        'is_active' => true,
    ]);

    $this->actingAs($admin)
        ->post(route('cart.add', $product), ['quantity' => 1])
        ->assertForbidden();

    $this->assertDatabaseCount('carts', 0);
});

it('prevents admins from accessing cart and checkout pages', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('cart.index'))
        ->assertForbidden();

    $this->get(route('checkout'))
        ->assertForbidden();
});

it('stores custom design image URLs returned by Cloudinary', function () {
    config([
        'services.cloudinary.cloud_name' => 'test-cloud',
        'services.cloudinary.upload_preset' => 'unsigned-preset',
    ]);

    Http::preventStrayRequests();
    Http::fake([
        'api.cloudinary.com/*' => Http::response([
            'secure_url' => 'https://res.cloudinary.com/test-cloud/image/upload/design.png',
        ]),
    ]);

    $user = User::factory()->create(['role' => 'customer']);
    $product = Product::create([
        'name' => 'Golf Ball',
        'category' => 'Golf Ball',
        'price' => 10,
        'stock' => 5,
        'is_active' => true,
    ]);

    $this->actingAs($user)
        ->post(route('cart.add', $product), [
            'quantity' => 1,
            'print_custom' => true,
            'design_image' => UploadedFile::fake()->image('design.png'),
        ])
        ->assertRedirect(route('catalog.show', $product));

    $this->assertDatabaseHas('carts', [
        'user_id' => $user->id,
        'product_id' => $product->id,
        'design_image' => 'https://res.cloudinary.com/test-cloud/image/upload/design.png',
        'print_custom' => true,
    ]);
});
