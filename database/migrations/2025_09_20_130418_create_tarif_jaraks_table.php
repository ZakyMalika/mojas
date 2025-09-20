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
        Schema::create('tarif_jarak', function (Blueprint $table) {
            $table->id();
            $table->decimal('jarak_dari_km', 10, 2);
            $table->decimal('jarak_sampai_km', 10, 2);
            $table->decimal('tarif_one_way', 10, 2);
            $table->decimal('tarif_two_way', 10, 2);
            $table->decimal('tarif_per_km', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_jaraks');
    }
};
