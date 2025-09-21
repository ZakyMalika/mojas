<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal_antar_jemput extends Model
{
    /** @use HasFactory<\Database\Factories\JadwalAntarJemputFactory> */
    use HasFactory;

    protected $table = 'jadwal_antar_jemput';

    protected $guarded = [];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'drivers_id');
    }
}
