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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_customizable')->default(false)->after('is_active');
            $table->json('customization_options')->nullable()->after('is_customizable');
            $table->decimal('customization_price', 10, 2)->default(0)->after('customization_options');
            $table->text('customization_instructions')->nullable()->after('customization_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'is_customizable',
                'customization_options',
                'customization_price',
                'customization_instructions'
            ]);
        });
    }
};
