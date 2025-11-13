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
            $table->decimal('length', 8, 2)->nullable()->after('dimensions')->comment('Product length in cm');
            $table->decimal('width', 8, 2)->nullable()->after('length')->comment('Product width in cm');
            $table->decimal('height', 8, 2)->nullable()->after('width')->comment('Product height in cm');
            $table->string('dimension_unit', 10)->default('cm')->after('height')->comment('Unit for dimensions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['length', 'width', 'height', 'dimension_unit']);
        });
    }
};
