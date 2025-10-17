<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('label', 50)->nullable();
            $table->string('line1');
            $table->string('line2')->nullable();
            $table->string('city');
            $table->string('state', 100)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->string('country', 100)->default('India');
            $table->string('phone', 20)->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['user_id', 'is_default']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
