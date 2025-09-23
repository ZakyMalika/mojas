<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orang_tua extends Model
{
    /** @use HasFactory<\Database\Factories\OrangTuaFactory> */
    use HasFactory;

    protected $table = 'orang_tua';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anak()
    {
        return $this->hasMany(Anak::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'orang_tua_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'orang_tua_id');
    }
}
