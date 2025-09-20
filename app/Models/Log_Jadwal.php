<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_Jadwal extends Model
{
    /** @use HasFactory<\Database\Factories\LogJadwalFactory> */
    use HasFactory;
    protected $guarded = [];
    protected $table = 'log_jadwal';
    public function jadwal(){
        return $this->belongsTo(Jadwal_antar_jemput::class, 'jadwal_id');
    }
    public function driver(){
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
