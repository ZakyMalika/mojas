<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\RentalService;
use App\Models\School;
use App\Models\Tarif_jarak;

class PricingService
{
    /**
     * Calculate price for school transport service
     */
    public function calculateSchoolTransportPrice($schoolId, $distanceKm, $childrenIds, $tripType = 'one_way', $pickupTime = null, $returnTime = null)
    {
        $school = School::find($schoolId);
        if (! $school) {
            throw new \Exception('School not found');
        }

        $childrenCount = count($childrenIds);
        $effectiveDistance = Tarif_jarak::calculateEffectiveDistance($distanceKm);
        $baseTariff = Tarif_jarak::findForDistance($effectiveDistance);

        if (! $baseTariff) {
            throw new \Exception('No tariff found for distance: '.$effectiveDistance.'km');
        }

        // Get school rate
        $schoolRate = $school->getApplicableRate($tripType);

        // Calculate billing units based on children count and conditions
        $billingUnits = $this->calculateBillingUnits($childrenCount, $pickupTime, $returnTime, $tripType);

        // Base calculation
        $basePrice = $schoolRate * $billingUnits;

        // Additional charges for different return times in two-way trips
        $additionalCharges = 0;
        if ($tripType === 'two_way' && $this->hasDifferentReturnTimes($childrenIds, $returnTime)) {
            $additionalCharges = $schoolRate; // Add one more unit for different return time
        }

        $totalPrice = $basePrice + $additionalCharges;

        $breakdown = [
            'school_rate' => $schoolRate,
            'effective_distance_km' => $effectiveDistance,
            'children_count' => $childrenCount,
            'billing_units' => $billingUnits,
            'base_price' => $basePrice,
            'additional_charges' => $additionalCharges,
            'total_price' => $totalPrice,
            'pricing_rules_applied' => $this->getPricingRulesApplied($childrenCount, $tripType, $pickupTime, $returnTime),
        ];

        return [
            'total_price' => $totalPrice,
            'base_price' => $basePrice,
            'additional_charges' => $additionalCharges,
            'currency' => 'IDR',
            'breakdown' => $breakdown,
        ];
    }

    /**
     * Calculate price for rental service
     */
    public function calculateRentalPrice($rentalServiceId, $hours)
    {
        $rentalService = RentalService::find($rentalServiceId);
        if (! $rentalService) {
            throw new \Exception('Rental service not found');
        }

        $totalPrice = $rentalService->calculatePrice($hours);

        $breakdown = [
            'base_price_12_hours' => $rentalService->price_per_12_hours,
            'requested_hours' => $hours,
            'overtime_hours' => max(0, $hours - $rentalService->max_hours),
            'overtime_rate' => $rentalService->overtime_rate_per_hour ?? 0,
            'total_price' => $totalPrice,
        ];

        return [
            'total_price' => $totalPrice,
            'currency' => $rentalService->currency,
            'breakdown' => $breakdown,
        ];
    }

    /**
     * Calculate general transport pricing (non-school)
     */
    public function calculateGeneralPrice($distanceKm, $childrenIds, $tripType = 'one_way', $pickupTime = null, $returnTime = null)
    {
        $childrenCount = count($childrenIds);
        $effectiveDistance = Tarif_jarak::calculateEffectiveDistance($distanceKm);
        $baseTariff = Tarif_jarak::findForDistance($effectiveDistance);

        if (! $baseTariff) {
            throw new \Exception('No tariff found for distance: '.$effectiveDistance.'km');
        }

        $generalRate = 7000; // Default general rate from requirements

        // Calculate billing units
        $billingUnits = $this->calculateBillingUnits($childrenCount, $pickupTime, $returnTime, $tripType);

        $basePrice = $generalRate * $billingUnits;

        // Additional charges for different return times in two-way trips
        $additionalCharges = 0;
        if ($tripType === 'two_way' && $this->hasDifferentReturnTimes($childrenIds, $returnTime)) {
            $additionalCharges = $generalRate;
        }

        $totalPrice = $basePrice + $additionalCharges;

        $breakdown = [
            'general_rate' => $generalRate,
            'effective_distance_km' => $effectiveDistance,
            'children_count' => $childrenCount,
            'billing_units' => $billingUnits,
            'base_price' => $basePrice,
            'additional_charges' => $additionalCharges,
            'total_price' => $totalPrice,
        ];

        return [
            'total_price' => $totalPrice,
            'base_price' => $basePrice,
            'additional_charges' => $additionalCharges,
            'currency' => 'IDR',
            'breakdown' => $breakdown,
        ];
    }

    /**
     * Calculate billing units based on pricing rules
     * Rules from requirements:
     * - 2 anak = 1 pembayaran (same location & time)
     * - 3 anak = 2 pembayaran (same location & time)
     * - Different locations or times = separate billing
     */
    private function calculateBillingUnits($childrenCount, $pickupTime, $returnTime, $tripType)
    {
        if ($childrenCount <= 1) {
            return 1;
        }

        // For same location and time (simplified logic)
        if ($childrenCount == 2) {
            return 1; // 2 children = 1 billing unit
        } elseif ($childrenCount == 3) {
            return 2; // 3 children = 2 billing units
        } else {
            // For more children, use the pattern: ceil(children / 2)
            return ceil($childrenCount / 2);
        }
    }

    /**
     * Check if there are different return times (simplified)
     */
    private function hasDifferentReturnTimes($childrenIds, $returnTime)
    {
        // This is a simplified implementation
        // In real scenario, you'd check if children have different return schedules
        return false;
    }

    /**
     * Get description of pricing rules applied
     */
    private function getPricingRulesApplied($childrenCount, $tripType, $pickupTime, $returnTime)
    {
        $rules = [];

        if ($childrenCount == 2) {
            $rules[] = '2 anak dihitung 1 pembayaran (lokasi dan waktu sama)';
        } elseif ($childrenCount == 3) {
            $rules[] = '3 anak dihitung 2 pembayaran (lokasi dan waktu sama)';
        }

        if ($tripType === 'two_way') {
            $rules[] = 'Two-way trip pricing applied';
            if ($this->hasDifferentReturnTimes([], $returnTime)) {
                $rules[] = 'Additional charge for different return time';
            }
        }

        return $rules;
    }

    /**
     * Get price quote without creating booking
     */
    public function getQuote($serviceType, $params)
    {
        switch ($serviceType) {
            case 'school_transport':
                return $this->calculateSchoolTransportPrice(
                    $params['school_id'],
                    $params['distance_km'],
                    $params['children_ids'],
                    $params['trip_type'] ?? 'one_way',
                    $params['pickup_time'] ?? null,
                    $params['return_time'] ?? null
                );

            case 'rental':
                return $this->calculateRentalPrice(
                    $params['rental_service_id'],
                    $params['hours']
                );

            case 'general':
                return $this->calculateGeneralPrice(
                    $params['distance_km'],
                    $params['children_ids'],
                    $params['trip_type'] ?? 'one_way',
                    $params['pickup_time'] ?? null,
                    $params['return_time'] ?? null
                );

            default:
                throw new \Exception('Invalid service type');
        }
    }
}
