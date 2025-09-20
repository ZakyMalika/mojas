<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dengan role pengemudi
        $driverUsers = User::where('role', 'pengemudi')->get();

        foreach ($driverUsers as $user) {
            DB::table('drivers')->insert([
                'user_id' => $user->id,
                'nomor_plat' => $this->generateRandomPlate(),
                'jenis_kendaraan' => $this->getRandomVehicleType(),
                'warna_kendaraan' => $this->getRandomColor(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function generateRandomPlate()
    {
        $letters = ['B', 'D', 'F', 'G', 'H']; // Kode wilayah
        $numbers = rand(1000, 9999);
        $suffixLetters = ['AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH'];
        
        $letter = $letters[array_rand($letters)];
        $suffix = $suffixLetters[array_rand($suffixLetters)];
        
        return $letter . ' ' . $numbers . ' ' . $suffix;
    }

    private function getRandomVehicleType()
    {
        $types = [
            'Avanza',
            'Xenia',
            'Innova',
            'Rush',
            'Terios',
            'Ertiga',
            'Mobilio',
            'Brio',
            'Jazz',
            'Calya'
        ];

        return $types[array_rand($types)];
    }

    private function getRandomColor()
    {
        $colors = [
            'Putih',
            'Hitam',
            'Silver',
            'Merah',
            'Biru',
            'Abu-abu',
            'Hijau',
            'Kuning'
        ];

        return $colors[array_rand($colors)];
    }
}
