<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cookie;

uses(RefreshDatabase::class);

it('adds item to cookie cart for guest', function () {
    $product = Product::factory()->create([
        'stock' => 10,
        'price' => 100,
        'sale_price' => null,
        'is_active' => true,
    ]);

    $this->withoutMiddleware();

    $response = $this->post(route('cart.add', $product), [
        'quantity' => 2,
    ]);

    $response->assertRedirect(route('cart.index'));

    // Assert cookie exists and contains product id with quantity
    $cookie = $response->headers->getCookies();
    $cartCookie = collect($cookie)->first(fn($c) => $c->getName() === 'cart');
    expect($cartCookie)->not()->toBeNull();

    $data = json_decode($cartCookie->getValue(), true);
    expect($data[(string)$product->id] ?? $data[$product->id] ?? null)->toBe(2);
});

it('shows cart items for guest from cookie', function () {
    $product = Product::factory()->create([
        'stock' => 5,
        'price' => 50,
        'is_active' => true,
    ]);

    $cart = json_encode([$product->id => 1]);

    $response = $this->withCookie('cart', $cart)
        ->get(route('cart.index'));

    $response->assertOk();
    $response->assertSee($product->name);
});

it('requires auth for payment routes', function () {
    $response = $this->get(route('cart.payment'));
    $response->assertRedirect();
});
