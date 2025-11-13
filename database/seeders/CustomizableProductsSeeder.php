<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class CustomizableProductsSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get or create relevant categories
        $mugCategory = Category::firstOrCreate(['name' => 'Mugs', 'slug' => 'mugs']);
        $tshirtCategory = Category::firstOrCreate(['name' => 'T-Shirts', 'slug' => 't-shirts']);
        $photoFrameCategory = Category::firstOrCreate(['name' => 'Photo Frames', 'slug' => 'photo-frames']);

        // Create customizable products
        $products = [
            [
                'name' => 'Personalized Coffee Mug',
                'slug' => 'personalized-coffee-mug',
                'description' => 'Create your own unique coffee mug with custom images and text. Perfect for gifts or personal use. High-quality ceramic with vibrant printing.',
                'price' => 299.00,
                'sku' => 'MUG-CUSTOM-001',
                'stock' => 50,
                'category_id' => $mugCategory->id,
                'is_customizable' => true,
                'customization_options' => ['image_upload', 'text_input'],
                'customization_price' => 50.00,
                'customization_instructions' => 'Upload high-resolution images (minimum 300 DPI). Text will be printed in black unless specified. Maximum 2 lines of text.',
                'images' => ['products/mugs/custom-mug-1.jpg'],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Custom Photo Mug',
                'slug' => 'custom-photo-mug',
                'description' => 'Transform your favorite memories into a beautiful photo mug. Upload your photo and we\'ll print it with professional quality.',
                'price' => 349.00,
                'sku' => 'MUG-PHOTO-001',
                'stock' => 30,
                'category_id' => $mugCategory->id,
                'is_customizable' => true,
                'customization_options' => ['image_upload', 'text_input'],
                'customization_price' => 75.00,
                'customization_instructions' => 'Photos should be at least 1000x1000 pixels for best quality. Avoid blurry or dark images.',
                'images' => ['products/mugs/photo-mug-1.jpg'],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Personalized T-Shirt',
                'slug' => 'personalized-t-shirt',
                'description' => 'Design your own custom t-shirt with images, text, and choose your preferred size. Made with premium cotton fabric.',
                'price' => 499.00,
                'sku' => 'TSHIRT-CUSTOM-001',
                'stock' => 25,
                'category_id' => $tshirtCategory->id,
                'is_customizable' => true,
                'customization_options' => ['image_upload', 'text_input', 'dimensions'],
                'customization_price' => 100.00,
                'customization_instructions' => 'Specify size (S, M, L, XL, XXL). Design area is 10x12 inches. Use high-contrast images for best results.',
                'images' => ['products/tshirts/custom-tshirt-1.jpg'],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Custom Photo Frame',
                'slug' => 'custom-photo-frame',
                'description' => 'Beautiful wooden photo frame with custom engraving. Perfect for displaying your cherished memories with a personal touch.',
                'price' => 699.00,
                'sku' => 'FRAME-CUSTOM-001',
                'stock' => 20,
                'category_id' => $photoFrameCategory->id,
                'is_customizable' => true,
                'customization_options' => ['text_input', 'dimensions'],
                'customization_price' => 150.00,
                'customization_instructions' => 'Engraving text limited to 50 characters. Standard sizes: 4x6, 5x7, 8x10 inches. Custom sizes available.',
                'images' => ['products/frames/custom-frame-1.jpg'],
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Personalized Water Bottle',
                'slug' => 'personalized-water-bottle',
                'description' => 'Eco-friendly stainless steel water bottle with custom printing. Keep your drinks cold or hot while showcasing your style.',
                'price' => 399.00,
                'sku' => 'BOTTLE-CUSTOM-001',
                'stock' => 40,
                'category_id' => $mugCategory->id,
                'is_customizable' => true,
                'customization_options' => ['image_upload', 'text_input'],
                'customization_price' => 80.00,
                'customization_instructions' => 'Design wraps around the bottle. Avoid thin lines and small text. Minimum text size 12pt.',
                'images' => ['products/bottles/custom-bottle-1.jpg'],
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }

        $this->command->info('Created ' . count($products) . ' customizable products successfully!');
    }
}
