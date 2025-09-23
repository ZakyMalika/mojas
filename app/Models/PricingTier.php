<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'min_children',
        'max_children',
        'multiplier',
        'conditions',
        'same_location_required',
        'same_time_required',
        'is_active'
    ];

    protected $casts = [
        'conditions' => 'array',
        'same_location_required' => 'boolean',
        'same_time_required' => 'boolean',
        'is_active' => 'boolean',
        'multiplier' => 'decimal:2'
    ];

    // Check if this pricing tier applies to a given number of children and conditions
    public function appliesTo($childrenCount, $sameLocation = true, $sameTime = true)
    {
        if (!$this->is_active) {
            return false;
        }

        if ($childrenCount < $this->min_children) {
            return false;
        }

        if ($this->max_children && $childrenCount > $this->max_children) {
            return false;
        }

        if ($this->same_location_required && !$sameLocation) {
            return false;
        }

        if ($this->same_time_required && !$sameTime) {
            return false;
        }

        return true;
    }

    // Calculate how many billing units this represents
    public function calculateBillingUnits($childrenCount)
    {
        // Default logic: 2 children = 1 billing unit, 3 children = 2 billing units
        if ($childrenCount <= 1) {
            return 1;
        } elseif ($childrenCount == 2) {
            return 1;
        } elseif ($childrenCount == 3) {
            return 2;
        } else {
            // For more than 3, calculate based on the pattern
            return ceil($childrenCount / 2);
        }
    }
}
