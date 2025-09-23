<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif_jarak extends Model
{
    /** @use HasFactory<\Database\Factories\TarifJarakFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $table = 'tarif_jarak';

    protected $casts = [
        'min_distance_km' => 'decimal:2',
        'max_distance_km' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function pendaftaran_anak()
    {
        return $this->hasMany(Pendaftaran_anak::class, 'tarif_id');
    }

    // Find applicable tariff for a given distance
    public static function findForDistance($distanceKm)
    {
        // Round up the distance according to the rule: 5.49 -> 5km, 5.51 -> 6km
        $roundedDistance = ceil($distanceKm);
        
        return self::where('is_active', true)
                   ->where('min_distance_km', '<=', $roundedDistance)
                   ->where('max_distance_km', '>=', $roundedDistance)
                   ->first();
    }

    // Calculate the effective distance for pricing (with rounding rules)
    public static function calculateEffectiveDistance($actualDistance)
    {
        // Rule: 5.49m -> 5km tariff, 5.51m -> 6km tariff
        // This means distances are rounded up to nearest km
        return ceil($actualDistance);
    }

    // Get all active tariffs ordered by distance
    public static function getActiveTariffs()
    {
        return self::where('is_active', true)
                   ->orderBy('min_distance_km')
                   ->get();
    }
}
