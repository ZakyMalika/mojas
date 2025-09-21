<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifJarakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tarifData = [
            [
                'jarak_dari_km' => 0.0,
                'jarak_sampai_km' => 5.0,
                'tarif_one_way' => 25000.00,
                'tarif_two_way' => 45000.00,
                'tarif_per_km' => 5000.00,
            ],
            [
                'jarak_dari_km' => 5.1,
                'jarak_sampai_km' => 10.0,
                'tarif_one_way' => 35000.00,
                'tarif_two_way' => 65000.00,
                'tarif_per_km' => 6000.00,
            ],
            [
                'jarak_dari_km' => 10.1,
                'jarak_sampai_km' => 15.0,
                'tarif_one_way' => 50000.00,
                'tarif_two_way' => 90000.00,
                'tarif_per_km' => 7000.00,
            ],
            [
                'jarak_dari_km' => 15.1,
                'jarak_sampai_km' => 20.0,
                'tarif_one_way' => 65000.00,
                'tarif_two_way' => 120000.00,
                'tarif_per_km' => 8000.00,
            ],
            [
                'jarak_dari_km' => 20.1,
                'jarak_sampai_km' => 30.0,
                'tarif_one_way' => 85000.00,
                'tarif_two_way' => 160000.00,
                'tarif_per_km' => 9000.00,
            ],
            [
                'jarak_dari_km' => 30.1,
                'jarak_sampai_km' => 50.0,
                'tarif_one_way' => 120000.00,
                'tarif_two_way' => 220000.00,
                'tarif_per_km' => 10000.00,
            ],
            [
                'jarak_dari_km' => 50.1,
                'jarak_sampai_km' => 999.0, // Untuk jarak lebih dari 50km
                'tarif_one_way' => 150000.00,
                'tarif_two_way' => 280000.00,
                'tarif_per_km' => 12000.00,
            ],
        ];

        foreach ($tarifData as $tarif) {
            DB::table('tarif_jarak')->insert([
                'jarak_dari_km' => $tarif['jarak_dari_km'],
                'jarak_sampai_km' => $tarif['jarak_sampai_km'],
                'tarif_one_way' => $tarif['tarif_one_way'],
                'tarif_two_way' => $tarif['tarif_two_way'],
                'tarif_per_km' => $tarif['tarif_per_km'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
