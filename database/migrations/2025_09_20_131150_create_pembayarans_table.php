<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_anak_id')->constrained('pendaftaran_anak')->onDelete('cascade');
            $table->foreignId('orang_tua_id')->constrained('orang_tua')->onDelete('cascade');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'e-wallet'])->default('cash');
            $table->dateTime('tanggal_bayar')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('status', ['pending', 'sukses', 'gagal'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
