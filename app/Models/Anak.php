<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    /** @use HasFactory<\Database\Factories\AnakFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $table = 'anak';

    public function orangTua()
    {
        return $this->belongsTo(Orang_tua::class);
    }
    public function jadwal_antar_jemput()
    {
        return $this->hasMany(Jadwal_antar_jemput::class, 'anak_id');
    }
    public function pendaftaran_anak()
    {
        return $this->hasMany(Pendaftaran_anak::class, 'anak_id');
    }
}
