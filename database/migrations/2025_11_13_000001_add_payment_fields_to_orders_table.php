<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('total_amount'); // online, cod, wallet, etc.
            $table->string('payment_gateway')->nullable()->after('payment_method'); // razorpay, payu, stripe, etc.
            $table->string('payment_id')->nullable()->after('payment_gateway'); // Gateway payment ID
            $table->string('payment_status')->default('pending')->after('payment_id'); // pending, paid, refunded, failed
            $table->json('payment_details')->nullable()->after('payment_status'); // Store gateway response
            $table->decimal('refund_amount', 10, 2)->nullable()->after('payment_details');
            $table->string('refund_status')->nullable()->after('refund_amount'); // initiated, processing, completed, failed
            $table->string('refund_id')->nullable()->after('refund_status'); // Gateway refund ID
            $table->timestamp('refund_processed_at')->nullable()->after('refund_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_gateway',
                'payment_id',
                'payment_status',
                'payment_details',
                'refund_amount',
                'refund_status',
                'refund_id',
                'refund_processed_at'
            ]);
        });
    }
};