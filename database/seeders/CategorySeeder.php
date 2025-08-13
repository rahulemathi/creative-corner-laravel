<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Glass Frames & Clocks',
                'slug' => 'glass-frames-clocks',
                'description' => 'Beautiful glass photo frames and elegant wall clocks for your home and office.',
                'image' => null,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Wall Clocks',
                'slug' => 'wall-clocks',
                'description' => 'Stylish and functional wall clocks in various designs and sizes.',
                'image' => null,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Fridge Magnets',
                'slug' => 'fridge-magnets',
                'description' => 'Fun and decorative fridge magnets for your kitchen.',
                'image' => null,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'LED Frames',
                'slug' => 'led-frames',
                'description' => 'Modern LED photo frames with advanced lighting technology.',
                'image' => null,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Photo Albums',
                'slug' => 'photo-albums',
                'description' => 'Traditional and modern photo albums to preserve your memories.',
                'image' => null,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Gift Sets',
                'slug' => 'gift-sets',
                'description' => 'Curated gift sets perfect for special occasions.',
                'image' => null,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 