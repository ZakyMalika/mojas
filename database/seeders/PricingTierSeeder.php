<?php

namespace Database\Seeders;

use App\Models\PricingTier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pricingTiers = [
            [
                'name' => 'Single Child',
                'description' => 'Tarif untuk satu anak dengan harga penuh',
                'min_children' => 1,
                'max_children' => 1,
                'multiplier' => 1.00,
                'conditions' => [
                    'type' => 'single',
                    'billing_units' => 1,
                    'discount_percent' => 0
                ],
                'same_location_required' => false,
                'same_time_required' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Sibling Pair (2 Children)',
                'description' => 'Tarif untuk 2 anak dari keluarga yang sama, lokasi dan waktu sama',
                'min_children' => 2,
                'max_children' => 2,
                'multiplier' => 1.00,
                'conditions' => [
                    'type' => 'sibling_pair',
                    'billing_units' => 1,
                    'discount_percent' => 50,
                    'requirements' => ['same_family', 'same_location', 'same_time']
                ],
                'same_location_required' => true,
                'same_time_required' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Sibling Trio (3 Children)',
                'description' => 'Tarif untuk 3 anak dari keluarga yang sama, dikenakan biaya 2 unit',
                'min_children' => 3,
                'max_children' => 3,
                'multiplier' => 2.00,
                'conditions' => [
                    'type' => 'sibling_trio',
                    'billing_units' => 2,
                    'discount_percent' => 33.33,
                    'requirements' => ['same_family', 'same_location', 'same_time']
                ],
                'same_location_required' => true,
                'same_time_required' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Multiple Children (4+)',
                'description' => 'Tarif untuk 4 atau lebih anak dengan formula khusus',
                'min_children' => 4,
                'max_children' => null,
                'multiplier' => 2.50,
                'conditions' => [
                    'type' => 'multiple',
                    'billing_formula' => 'ceil(children_count / 2)',
                    'max_discount_percent' => 50,
                    'requirements' => ['same_location', 'same_time']
                ],
                'same_location_required' => true,
                'same_time_required' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Different Location - 2 Children',
                'description' => 'Tarif untuk 2 anak dengan lokasi berbeda',
                'min_children' => 2,
                'max_children' => 2,
                'multiplier' => 1.80,
                'conditions' => [
                    'type' => 'different_location',
                    'billing_units' => 2,
                    'location_multiplier' => 0.9,
                    'discount_percent' => 10
                ],
                'same_location_required' => false,
                'same_time_required' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Different Time - 2 Children',
                'description' => 'Tarif untuk 2 anak dengan waktu berbeda',
                'min_children' => 2,
                'max_children' => 2,
                'multiplier' => 1.90,
                'conditions' => [
                    'type' => 'different_time',
                    'billing_units' => 2,
                    'time_multiplier' => 0.95,
                    'discount_percent' => 5
                ],
                'same_location_required' => true,
                'same_time_required' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Completely Different (2 Children)',
                'description' => 'Tarif untuk 2 anak dengan lokasi dan waktu berbeda',
                'min_children' => 2,
                'max_children' => 2,
                'multiplier' => 2.00,
                'conditions' => [
                    'type' => 'completely_different',
                    'billing_units' => 2,
                    'discount_percent' => 0,
                    'note' => 'Full price for each child due to different location and time'
                ],
                'same_location_required' => false,
                'same_time_required' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Group Discount (5+ Children)',
                'description' => 'Tarif khusus untuk grup besar dengan diskon volume',
                'min_children' => 5,
                'max_children' => null,
                'multiplier' => 3.00,
                'conditions' => [
                    'type' => 'group_discount',
                    'billing_formula' => 'ceil(children_count * 0.6)',
                    'volume_discount' => 40,
                    'requirements' => ['same_location', 'same_time'],
                    'minimum_commitment' => 'monthly'
                ],
                'same_location_required' => true,
                'same_time_required' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Service',
                'description' => 'Tarif premium untuk layanan eksklusif',
                'min_children' => 1,
                'max_children' => null,
                'multiplier' => 1.50,
                'conditions' => [
                    'type' => 'premium',
                    'billing_units' => 1,
                    'premium_features' => [
                        'luxury_vehicle',
                        'professional_driver',
                        'priority_booking',
                        'flexible_schedule'
                    ],
                    'surcharge_percent' => 50
                ],
                'same_location_required' => false,
                'same_time_required' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Weekend Surcharge',
                'description' => 'Tarif khusus untuk hari weekend dengan tambahan biaya',
                'min_children' => 1,
                'max_children' => null,
                'multiplier' => 1.25,
                'conditions' => [
                    'type' => 'weekend_surcharge',
                    'applicable_days' => ['saturday', 'sunday'],
                    'surcharge_percent' => 25,
                    'applies_to' => 'all_services'
                ],
                'same_location_required' => false,
                'same_time_required' => false,
                'is_active' => true,
            ],
        ];

        foreach ($pricingTiers as $tier) {
            PricingTier::create($tier);
        }
    }
}