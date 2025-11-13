<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;

class TestDimensions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:dimensions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test product dimensions functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing product dimensions functionality...');

        // Find or create a category
        $category = Category::first();
        if (!$category) {
            $category = Category::create([
                'name' => 'Test Category', 
                'slug' => 'test-category', 
                'is_active' => true
            ]);
        }

        // Test 1: Product with admin-defined dimensions (not customizable)
        $fixedProduct = new Product([
            'category_id' => $category->id,
            'name' => 'Fixed Size Mug',
            'slug' => 'fixed-size-mug',
            'description' => 'A mug with fixed admin-defined dimensions',
            'price' => 12.99,
            'stock' => 50,
            'is_active' => true,
            'is_customizable' => false,
            'length' => 10.5,
            'width' => 8.0,
            'height' => 9.5,
            'dimension_unit' => 'cm'
        ]);

        $this->info('=== Test 1: Fixed Size Product ===');
        $this->line("Product: " . $fixedProduct->name);
        $this->line("Dimensions: " . $fixedProduct->formatted_dimensions);
        $this->line("Has fixed dimensions: " . ($fixedProduct->hasFixedDimensions() ? 'Yes' : 'No'));
        $this->line("Supports dimension customization: " . ($fixedProduct->supportsDimensionCustomization() ? 'Yes' : 'No'));

        // Test 2: Product with customizable dimensions  
        $customProduct = new Product([
            'category_id' => $category->id,
            'name' => 'Custom Size Mug',
            'slug' => 'custom-size-mug', 
            'description' => 'A mug with customizable dimensions',
            'price' => 15.99,
            'stock' => 25,
            'is_active' => true,
            'is_customizable' => true,
            'customization_options' => ['dimensions'],
            'customization_price' => 3.00,
            'dimension_unit' => 'cm'
        ]);

        $this->info('=== Test 2: Customizable Size Product ===');
        $this->line("Product: " . $customProduct->name);
        $this->line("Has fixed dimensions: " . ($customProduct->hasFixedDimensions() ? 'Yes' : 'No'));
        $this->line("Supports dimension customization: " . ($customProduct->supportsDimensionCustomization() ? 'Yes' : 'No'));
        $this->line("Customization price: $" . $customProduct->customization_price);

        $this->info('Testing complete!');
        return 0;
    }
}
