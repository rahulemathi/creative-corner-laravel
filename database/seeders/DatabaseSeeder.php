<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only seed if we're in local/testing environment or if explicitly requested
        if (app()->environment('local', 'testing') || $this->command->confirm('This will seed the database. Are you sure you want to continue?')) {
            
            $this->call([
                AdminUserSeeder::class,
                CategorySeeder::class,
                ProductSeeder::class,
            ]);
            
        } else {
            $this->command->info('Database seeding skipped in production environment.');
        }
    }
}
