<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing orders without payment method to use 'cod' (Cash on Delivery)
        DB::table('orders')
            ->whereNull('payment_method')
            ->update([
                'payment_method' => 'cod',
                'payment_status' => 'paid', // COD orders are considered paid on delivery
                'updated_at' => now(),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to null for orders that were updated
        DB::table('orders')
            ->where('payment_method', 'cod')
            ->whereNull('payment_gateway') // Only revert if no gateway is set
            ->update([
                'payment_method' => null,
                'payment_status' => 'pending',
                'updated_at' => now(),
            ]);
    }
};
