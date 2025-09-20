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
        Schema::create('penghasilan_driver', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
            $table->foreignId('jadwal_id')->constrained('jadwal_antar_jemput')->onDelete('cascade');
            $table->decimal('tarif_per_trip', 10, 2);
            $table->decimal('komisi_pengemudi', 10, 2);
            $table->enum('status', ['pending', 'dibayar'])->default('pending');
            $table->dateTime('tanggal_dibayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghasilan_drivers');
    }
};
