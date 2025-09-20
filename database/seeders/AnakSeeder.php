<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua orang_tua
        $orangTuaIds = DB::table('orang_tua')->pluck('id')->toArray();

        foreach ($orangTuaIds as $orangTuaId) {
            // Setiap orang tua punya 1-3 anak
            $jumlahAnak = rand(1, 3);
            
            for ($i = 0; $i < $jumlahAnak; $i++) {
                DB::table('anak')->insert([
                    'orang_tua_id' => $orangTuaId,
                    'nama' => $this->getRandomChildName(),
                    'umur' => rand(5, 17),
                    'kelas' => $this->getRandomClass(),
                    'sekolah' => $this->getRandomSchool(),
                    'alamat_penjemputan' => $this->getRandomPickupAddress(),
                    'catatan' => $this->getRandomChildNote(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getRandomChildName()
    {
        $names = [
            'Ahmad Fariz',
            'Siti Aisyah',
            'Budi Santoso Jr',
            'Dewi Sartika',
            'Rizki Pratama',
            'Indah Permata',
            'Dimas Anggoro',
            'Putri Maharani',
            'Arief Rachman',
            'Maya Sari',
            'Fahmi Abdullah',
            'Nurul Hidayah',
            'Raihan Maulana',
            'Zahra Aulia',
            'Kevin Handoko'
        ];

        return $names[array_rand($names)];
    }

    private function getRandomClass()
    {
        $classes = [
            '1 SD', '2 SD', '3 SD', '4 SD', '5 SD', '6 SD',
            '7 SMP', '8 SMP', '9 SMP',
            '10 SMA', '11 SMA', '12 SMA'
        ];

        return $classes[array_rand($classes)];
    }

    private function getRandomSchool()
    {
        $schools = [
            'SD Negeri 01 Jakarta',
            'SD Negeri 05 Jakarta',
            'SMP Negeri 12 Jakarta',
            'SMP Negeri 15 Jakarta',
            'SMA Negeri 8 Jakarta',
            'SMA Negeri 21 Jakarta',
            'SD Swasta Bina Bangsa',
            'SMP Swasta Al-Azhar',
            'SMA Swasta Kanisius',
            'SD Islam Terpadu'
        ];

        return $schools[array_rand($schools)];
    }

    private function getRandomPickupAddress()
    {
        $addresses = [
            'Jl. Pendidikan No. 123',
            'Jl. Sekolah Raya No. 456',
            'Komplek Perumahan Indah Blok A12',
            'Jl. Kemerdekaan No. 789',
            'Gang Mawar No. 21',
            'Jl. Diponegoro No. 333',
            'Perumahan Griya Asri No. 88',
            'Jl. Sudirman Gang 5 No. 12'
        ];

        return $addresses[array_rand($addresses)];
    }

    private function getRandomChildNote()
    {
        $notes = [
            'Anak aktif, suka bermain',
            'Pemalu, butuh pendekatan khusus',
            'Alergi seafood',
            'Mudah masuk angin',
            null,
            'Suka membaca buku',
            'Hobi menggambar',
            null,
            'Anak yang mandiri',
            'Perlu diingatkan tentang PR'
        ];

        return $notes[array_rand($notes)];
    }
}
