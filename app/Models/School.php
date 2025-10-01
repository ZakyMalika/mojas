<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function children()
    {
        return $this->hasMany(Anak::class, 'school_id');
    }

    // Get applicable rate based on school type and partnership
    public function getApplicableRate($tripType = 'one_way')
    {
        if ($this->has_partnership) {
            return $tripType === 'two_way' ? $this->two_way_price : $this->one_way_price;
        }

        return $this->general_rate;
    }
}
