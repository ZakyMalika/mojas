<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'address',
        'has_partnership',
        'partnership_rate',
        'one_way_price',
        'two_way_price',
        'general_rate',
        'is_active'
    ];

    protected $casts = [
        'has_partnership' => 'boolean',
        'is_active' => 'boolean',
        'partnership_rate' => 'decimal:2',
        'one_way_price' => 'decimal:2',
        'two_way_price' => 'decimal:2',
        'general_rate' => 'decimal:2'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function children()
    {
        return $this->hasMany(Anak::class);
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
