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
        Schema::create('pendaftaran_anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anak')->onDelete('cascade');
            // $table->decimal('jarak_km', 10, 2);
            $table->enum('tipe_layanan', ['one_way', 'two_way']);
            $table->decimal('tarif_bulanan', 10, 2);
            $table->foreignId('tarif_id')->constrained('tarif_jarak')->onDelete('cascade');
            $table->date('periode_mulai');
            $table->date('periode_selesai')->nullable();
            $table->enum('status', ['pending', 'lunas', 'expired'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_anaks');
    }
};
