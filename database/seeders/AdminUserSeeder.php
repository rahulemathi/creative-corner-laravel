<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        if (!User::where('email', 'admin@manhitha.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@manhitha.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
            
            $this->command->info('Admin user created: admin@manhitha.com / password');
        } else {
            $this->command->info('Admin user already exists, skipping...');
        }

        // Check if regular user already exists
        if (!User::where('email', 'user@manhitha.com')->exists()) {
            User::create([
                'name' => 'Regular User',
                'email' => 'user@manhitha.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]);
            
            $this->command->info('Regular user created: user@manhitha.com / password');
        } else {
            $this->command->info('Regular user already exists, skipping...');
        }
    }
} 