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
        Schema::create('jadwal_antar_jemput', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anak')->onDelete('cascade');
            $table->foreignId('drivers_id')->constrained('drivers')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_jemput');
            $table->time('jam_antar');
            $table->string('lokasi_jemput')->nullable();
            $table->string('lokasi_antar')->nullable();
            $table->enum('status', ['menunggu', 'dijemput', 'perjalanan', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->timestamp('diambil_pengemudi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_antar_jemputs');
    }
};
