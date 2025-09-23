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
        Schema::create('rental_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guest_type'); // 'singapore', 'malaysia', 'local'
            $table->string('currency', 3)->default('IDR'); // 'SGD', 'MYR', 'IDR'
            $table->decimal('price_per_12_hours', 12, 2); // 70 SGD for Singapore guests
            $table->boolean('includes_driver')->default(true);
            $table->integer('max_hours')->default(12);
            $table->decimal('overtime_rate_per_hour', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->json('included_services')->nullable(); // what's included
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_services');
    }
};
