<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghasilan_driver extends Model
{
    /** @use HasFactory<\Database\Factories\PenghasilanDriverFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $table = 'penghasilan_driver';

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal_antar_jemput::class, 'jadwal_id');
    }
}
