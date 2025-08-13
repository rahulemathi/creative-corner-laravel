<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        $products = [
            [
                'category_id' => $categories->where('slug', 'glass-frames-clocks')->first()->id,
                'name' => 'Premium Acrylic Photo Frame',
                'slug' => 'premium-acrylic-photo-frame',
                'description' => 'High-quality acrylic photo frame perfect for displaying your cherished memories. Features a modern design with clean lines.',
                'price' => 1299.00,
                'sale_price' => 999.00,
                'sku' => 'GF001',
                'stock' => 25,
                'dimensions' => '18cm X 20cm X 4cm',
                'weight' => '500g',
                'material' => 'Acrylic',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $categories->where('slug', 'glass-frames-clocks')->first()->id,
                'name' => 'Vintage Wooden Clock Frame',
                'slug' => 'vintage-wooden-clock-frame',
                'description' => 'Elegant vintage-style wooden frame with integrated clock mechanism. Perfect for both decoration and functionality.',
                'price' => 2499.00,
                'sale_price' => null,
                'sku' => 'GF002',
                'stock' => 15,
                'dimensions' => '25cm X 25cm X 6cm',
                'weight' => '800g',
                'material' => 'Wood & Glass',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $categories->where('slug', 'wall-clocks')->first()->id,
                'name' => 'Modern LED Wall Clock',
                'slug' => 'modern-led-wall-clock',
                'description' => 'Contemporary LED wall clock with sleek design and easy-to-read display. Perfect for modern homes.',
                'price' => 1899.00,
                'sale_price' => 1499.00,
                'sku' => 'WC001',
                'stock' => 30,
                'dimensions' => '30cm diameter',
                'weight' => '600g',
                'material' => 'Plastic & LED',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $categories->where('slug', 'fridge-magnets')->first()->id,
                'name' => 'Custom Photo Fridge Magnets',
                'slug' => 'custom-photo-fridge-magnets',
                'description' => 'Personalized fridge magnets with your photos. Set of 6 magnets with strong magnetic backing.',
                'price' => 599.00,
                'sale_price' => 449.00,
                'sku' => 'FM001',
                'stock' => 50,
                'dimensions' => '5cm X 5cm each',
                'weight' => '200g',
                'material' => 'Magnetic & Plastic',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $categories->where('slug', 'led-frames')->first()->id,
                'name' => 'Smart LED Digital Frame',
                'slug' => 'smart-led-digital-frame',
                'description' => 'Advanced LED digital frame with WiFi connectivity, multiple display modes, and high-resolution screen.',
                'price' => 4999.00,
                'sale_price' => 3999.00,
                'sku' => 'LF001',
                'stock' => 10,
                'dimensions' => '20cm X 15cm X 2cm',
                'weight' => '400g',
                'material' => 'Aluminum & LED',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $categories->where('slug', 'photo-albums')->first()->id,
                'name' => 'Leather Bound Photo Album',
                'slug' => 'leather-bound-photo-album',
                'description' => 'Premium leather-bound photo album with acid-free pages. Holds up to 200 photos with elegant design.',
                'price' => 899.00,
                'sale_price' => null,
                'sku' => 'PA001',
                'stock' => 20,
                'dimensions' => '25cm X 20cm X 3cm',
                'weight' => '700g',
                'material' => 'Genuine Leather',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $categories->where('slug', 'gift-sets')->first()->id,
                'name' => 'Anniversary Gift Bundle',
                'slug' => 'anniversary-gift-bundle',
                'description' => 'Complete anniversary gift set including photo frame, clock, and decorative items. Perfect for celebrating special moments.',
                'price' => 2999.00,
                'sale_price' => 2499.00,
                'sku' => 'GS001',
                'stock' => 12,
                'dimensions' => '30cm X 25cm X 8cm',
                'weight' => '1.2kg',
                'material' => 'Mixed Materials',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 