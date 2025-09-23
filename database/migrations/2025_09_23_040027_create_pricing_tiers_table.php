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
        Schema::create('pricing_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "2 anak 1 pembayaran", "3 anak 2 pembayaran"
            $table->text('description')->nullable();
            $table->integer('min_children')->default(1);
            $table->integer('max_children')->nullable();
            $table->decimal('multiplier', 8, 2)->default(1.00); // pricing multiplier
            $table->json('conditions')->nullable(); // JSON to store complex conditions
            $table->boolean('same_location_required')->default(true);
            $table->boolean('same_time_required')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_tiers');
    }
};
