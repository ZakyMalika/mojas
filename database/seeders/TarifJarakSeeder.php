<?php

namespace Database\Seeders;

use App\Models\Tarif_jarak;
use Illuminate\Database\Seeder;

class TarifJarakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tarifData = [
            [
                'min_distance_km' => 0.0,
                'max_distance_km' => 5.0,
                'tarif_one_way' => 25000.00,
                'tarif_two_way' => 45000.00,
                'tarif_per_km' => 5000.00,
                'is_active' => true,
            ],
            [
                'min_distance_km' => 5.01,
                'max_distance_km' => 10.0,
                'tarif_one_way' => 35000.00,
                'tarif_two_way' => 65000.00,
                'tarif_per_km' => 6000.00,
                'is_active' => true,
            ],
            [
                'min_distance_km' => 10.01,
                'max_distance_km' => 15.0,
                'tarif_one_way' => 50000.00,
                'tarif_two_way' => 90000.00,
                'tarif_per_km' => 7000.00,
                'is_active' => true,
            ],
            [
                'min_distance_km' => 15.01,
                'max_distance_km' => 20.0,
                'tarif_one_way' => 65000.00,
                'tarif_two_way' => 120000.00,
                'tarif_per_km' => 8000.00,
                'is_active' => true,
            ],
            [
                'min_distance_km' => 20.01,
                'max_distance_km' => 30.0,
                'tarif_one_way' => 85000.00,
                'tarif_two_way' => 160000.00,
                'tarif_per_km' => 9000.00,
                'is_active' => true,
            ],
            [
                'min_distance_km' => 30.01,
                'max_distance_km' => 50.0,
                'tarif_one_way' => 120000.00,
                'tarif_two_way' => 220000.00,
                'tarif_per_km' => 10000.00,
                'is_active' => true,
            ],
            [
                'min_distance_km' => 50.01,
                'max_distance_km' => 999.0, // Untuk jarak lebih dari 50km
                'tarif_one_way' => 150000.00,
                'tarif_two_way' => 280000.00,
                'tarif_per_km' => 12000.00,
                'is_active' => true,
            ],
        ];

        foreach ($tarifData as $tarif) {
            Tarif_jarak::create($tarif);
        }
    }
}
