<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;

class CookieCart
{
    protected string $cookieName = 'cart';
    protected int $minutes;

    public function __construct(?int $minutes = null)
    {
        // Default: 30 days
        $this->minutes = $minutes ?? (60 * 24 * 30);
    }

    /**
     * Return cart as [product_id => quantity]
     */
    public function all(): array
    {
        $raw = Cookie::get($this->cookieName);
        if (!$raw) {
            return [];
        }
        $data = json_decode($raw, true);
        if (!is_array($data)) {
            return [];
        }
        // normalize to int quantities
        $normalized = [];
        foreach ($data as $productId => $qty) {
            $pid = (int) $productId;
            $q = max(0, (int) $qty);
            if ($pid > 0 && $q > 0) {
                $normalized[$pid] = $q;
            }
        }
        return $normalized;
    }

    public function put(array $items): void
    {
        // Ensure compact JSON to save cookie size
        $payload = json_encode($items, JSON_UNESCAPED_UNICODE);
        Cookie::queue(cookie(
            $this->cookieName,
            $payload,
            $this->minutes,
            path: '/',
            domain: config('session.domain'),
            secure: config('session.secure'),
            httpOnly: true,
            raw: false,
            sameSite: config('session.same_site') ?? 'lax',
        ));
    }

    public function add(int $productId, int $quantity = 1): array
    {
        $cart = $this->all();
        $productId = (int) $productId;
        $quantity = max(1, (int) $quantity);
        $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
        $this->put($cart);
        return $cart;
    }

    public function update(int $productId, int $quantity): array
    {
        $cart = $this->all();
        $productId = (int) $productId;
        $quantity = max(0, (int) $quantity);
        if ($quantity === 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }
        $this->put($cart);
        return $cart;
    }

    public function remove(int $productId): array
    {
        $cart = $this->all();
        unset($cart[(int) $productId]);
        $this->put($cart);
        return $cart;
    }

    public function clear(): void
    {
        Cookie::queue(Cookie::forget($this->cookieName));
    }
}
