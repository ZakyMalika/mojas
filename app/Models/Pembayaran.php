<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\PembayaranFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $table = 'pembayaran';

    public function pendaftaran_anak()
    {
        return $this->belongsTo(Pendaftaran_anak::class, 'pendaftaran_anak_id');
    }

    public function orang_tua()
    {
        return $this->belongsTo(Orang_tua::class, 'orang_tua_id');
    }
}
