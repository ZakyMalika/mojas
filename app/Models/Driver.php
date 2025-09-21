<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /** @use HasFactory<\Database\Factories\DriverFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal_antar_jemput()
    {
        return $this->hasMany(Jadwal_antar_jemput::class, 'drivers_id');
    }

    public function penghasilan_driver()
    {
        return $this->hasOne(Penghasilan_driver::class, 'driver_id');
    }
}
