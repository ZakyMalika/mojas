<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'orang_tua_id',
        'school_id',
        'rental_service_id',
        'service_type',
        'trip_type',
        'children_ids',
        'distance_km',
        'base_price',
        'additional_charges',
        'total_price',
        'currency',
        'pickup_time',
        'return_time',
        'pickup_address',
        'destination_address',
        'return_address',
        'pricing_breakdown',
        'status',
        'notes',
    ];

    protected $casts = [
        'children_ids' => 'array',
        'pricing_breakdown' => 'array',
        'pickup_time' => 'datetime',
        'return_time' => 'datetime',
        'distance_km' => 'decimal:2',
        'base_price' => 'decimal:2',
        'additional_charges' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_code)) {
                $booking->booking_code = 'BK-'.strtoupper(Str::random(8));
            }
        });
    }

    public function orangTua()
    {
        return $this->belongsTo(Orang_tua::class, 'orang_tua_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function rentalService()
    {
        return $this->belongsTo(RentalService::class);
    }

    public function children()
    {
        if (empty($this->children_ids)) {
            return collect();
        }

        return Anak::whereIn('id', $this->children_ids)->get();
    }

    public function schedules()
    {
        return $this->hasMany(Jadwal_antar_jemput::class, 'booking_id');
    }

    // Get children count
    public function getChildrenCountAttribute()
    {
        return is_array($this->children_ids) ? count($this->children_ids) : 0;
    }

    // Check if booking has same location for all children
    public function hasSameLocation()
    {
        // This would need to be implemented based on children addresses
        return true; // Placeholder
    }

    // Check if booking has same time for all children
    public function hasSameTime()
    {
        // This would be based on pickup times being the same
        return $this->trip_type === 'one_way' || $this->return_time !== null;
    }
}
