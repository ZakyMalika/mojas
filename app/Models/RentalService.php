<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guest_type',
        'currency',
        'price_per_12_hours',
        'includes_driver',
        'max_hours',
        'overtime_rate_per_hour',
        'description',
        'included_services',
        'is_active'
    ];

    protected $casts = [
        'includes_driver' => 'boolean',
        'is_active' => 'boolean',
        'price_per_12_hours' => 'decimal:2',
        'overtime_rate_per_hour' => 'decimal:2',
        'included_services' => 'array'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Calculate total price including overtime
    public function calculatePrice($hours)
    {
        $basePrice = $this->price_per_12_hours;
        
        if ($hours <= $this->max_hours) {
            return $basePrice;
        }

        $overtimeHours = $hours - $this->max_hours;
        $overtimePrice = $overtimeHours * ($this->overtime_rate_per_hour ?? 0);
        
        return $basePrice + $overtimePrice;
    }

    // Get services for specific guest type
    public static function forGuestType($guestType)
    {
        return self::where('guest_type', $guestType)
                   ->where('is_active', true)
                   ->get();
    }
}
