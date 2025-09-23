<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            [
                'name' => 'SD Negeri 1 Jakarta',
                'type' => 'SD',
                'address' => 'Jl. Merdeka No. 15, Jakarta Pusat, DKI Jakarta',
                'has_partnership' => true,
                'partnership_rate' => 0.85,
                'one_way_price' => 25000.00,
                'two_way_price' => 45000.00,
                'general_rate' => 30000.00,
                'is_active' => true,
            ],
            [
                'name' => 'SMP Negeri 5 Jakarta',
                'type' => 'SMP',
                'address' => 'Jl. Sudirman No. 28, Jakarta Selatan, DKI Jakarta',
                'has_partnership' => true,
                'partnership_rate' => 0.80,
                'one_way_price' => 30000.00,
                'two_way_price' => 55000.00,
                'general_rate' => 35000.00,
                'is_active' => true,
            ],
            [
                'name' => 'SMA Negeri 3 Jakarta',
                'type' => 'SMA',
                'address' => 'Jl. Gatot Subroto No. 42, Jakarta Selatan, DKI Jakarta',
                'has_partnership' => false,
                'partnership_rate' => null,
                'one_way_price' => null,
                'two_way_price' => null,
                'general_rate' => 40000.00,
                'is_active' => true,
            ],
            [
                'name' => 'TK Melati Indah',
                'type' => 'TK',
                'address' => 'Jl. Melati No. 12, Jakarta Timur, DKI Jakarta',
                'has_partnership' => true,
                'partnership_rate' => 0.90,
                'one_way_price' => 20000.00,
                'two_way_price' => 35000.00,
                'general_rate' => 25000.00,
                'is_active' => true,
            ],
            [
                'name' => 'SD Islam Al-Azhar',
                'type' => 'SD',
                'address' => 'Jl. Sisingamangaraja No. 2, Jakarta Selatan, DKI Jakarta',
                'has_partnership' => true,
                'partnership_rate' => 0.75,
                'one_way_price' => 35000.00,
                'two_way_price' => 65000.00,
                'general_rate' => 45000.00,
                'is_active' => true,
            ],
            [
                'name' => 'SMP Labschool Jakarta',
                'type' => 'SMP',
                'address' => 'Jl. Pemuda Raya No. 18, Jakarta Timur, DKI Jakarta',
                'has_partnership' => false,
                'partnership_rate' => null,
                'one_way_price' => null,
                'two_way_price' => null,
                'general_rate' => 50000.00,
                'is_active' => true,
            ],
            [
                'name' => 'SMA Santa Ursula',
                'type' => 'SMA',
                'address' => 'Jl. Pos No. 2, Jakarta Pusat, DKI Jakarta',
                'has_partnership' => true,
                'partnership_rate' => 0.70,
                'one_way_price' => 40000.00,
                'two_way_price' => 75000.00,
                'general_rate' => 55000.00,
                'is_active' => true,
            ],
            [
                'name' => 'TK Kasih Bunda',
                'type' => 'TK',
                'address' => 'Jl. Kemang Raya No. 45, Jakarta Selatan, DKI Jakarta',
                'has_partnership' => false,
                'partnership_rate' => null,
                'one_way_price' => null,
                'two_way_price' => null,
                'general_rate' => 30000.00,
                'is_active' => true,
            ],
            [
                'name' => 'SD Katolik Santo Yusup',
                'type' => 'SD',
                'address' => 'Jl. Veteran No. 21, Jakarta Pusat, DKI Jakarta',
                'has_partnership' => true,
                'partnership_rate' => 0.80,
                'one_way_price' => 28000.00,
                'two_way_price' => 50000.00,
                'general_rate' => 35000.00,
                'is_active' => true,
            ],
            [
                'name' => 'SMP Bina Nusantara',
                'type' => 'SMP',
                'address' => 'Jl. K.H. Syahdan No. 9, Jakarta Barat, DKI Jakarta',
                'has_partnership' => false,
                'partnership_rate' => null,
                'one_way_price' => null,
                'two_way_price' => null,
                'general_rate' => 60000.00,
                'is_active' => true,
            ],
        ];

        foreach ($schools as $school) {
            School::create($school);
        }
    }
}