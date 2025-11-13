<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CustomizationService
{
    private const SESSION_KEY = 'cart_customizations';

    /**
     * Store customization data for a product
     */
    public function storeCustomization(int $productId, array $customizationData): void
    {
        $customizations = Session::get(self::SESSION_KEY, []);
        $customizations[$productId] = $customizationData;
        Session::put(self::SESSION_KEY, $customizations);
    }

    /**
     * Get customization data for a product
     */
    public function getCustomization(int $productId): ?array
    {
        $customizations = Session::get(self::SESSION_KEY, []);
        return $customizations[$productId] ?? null;
    }

    /**
     * Remove customization data for a product
     */
    public function removeCustomization(int $productId): void
    {
        $customizations = Session::get(self::SESSION_KEY, []);
        unset($customizations[$productId]);
        Session::put(self::SESSION_KEY, $customizations);
    }

    /**
     * Clear all customizations
     */
    public function clearCustomizations(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Get all customizations
     */
    public function getAllCustomizations(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    /**
     * Check if a product has customizations
     */
    public function hasCustomization(int $productId): bool
    {
        $customizations = Session::get(self::SESSION_KEY, []);
        return isset($customizations[$productId]) && !empty($customizations[$productId]);
    }
}