<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalAntarJemputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua anak dan driver
        $anakIds = DB::table('anak')->pluck('id')->toArray();
        $driverIds = DB::table('drivers')->pluck('id')->toArray();

        if (empty($anakIds) || empty($driverIds)) {
            return; // Skip jika tidak ada data anak atau driver
        }

        // Buat jadwal untuk 2 minggu ke depan
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addWeeks(2);

        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            // Skip weekend (optional, tergantung kebutuhan)
            if ($currentDate->isWeekend()) {
                $currentDate->addDay();

                continue;
            }

            // Buat beberapa jadwal per hari
            $jadwalPerHari = rand(2, 5);

            for ($i = 0; $i < $jadwalPerHari; $i++) {
                $anakId = $anakIds[array_rand($anakIds)];
                $driverId = $driverIds[array_rand($driverIds)];

                DB::table('jadwal_antar_jemput')->insert([
                    'anak_id' => $anakId,
                    'drivers_id' => $driverId,
                    'tanggal' => $currentDate->format('Y-m-d'),
                    'hari' => $this->getHariIndonesia($currentDate->dayName),
                    'jam_jemput' => $this->getRandomPickupTime(),
                    'jam_antar' => $this->getRandomDeliveryTime(),
                    'lokasi_jemput' => $this->getRandomLocation(),
                    'lokasi_antar' => $this->getRandomSchoolLocation(),
                    'status' => $this->getRandomStatus($currentDate),
                    'catatan' => $this->getRandomNote(),
                    'diambil_pengemudi' => $this->getRandomDriverTakeTime($currentDate),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $currentDate->addDay();
        }
    }

    private function getHariIndonesia($dayName)
    {
        $mapping = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];

        return $mapping[$dayName];
    }

    private function getRandomPickupTime()
    {
        $times = [
            '06:00:00', '06:15:00', '06:30:00', '06:45:00',
            '07:00:00', '07:15:00', '07:30:00',
        ];

        return $times[array_rand($times)];
    }

    private function getRandomDeliveryTime()
    {
        $times = [
            '13:00:00', '13:15:00', '13:30:00',
            '14:00:00', '14:15:00', '14:30:00',
            '15:00:00', '15:15:00', '15:30:00',
        ];

        return $times[array_rand($times)];
    }

    private function getRandomLocation()
    {
        $locations = [
            'Jl. Merdeka No. 123',
            'Jl. Sudirman No. 456',
            'Komplek Griya Asri',
            'Jl. Kemang Raya No. 789',
            'Perumahan Indah Permai',
            'Jl. Thamrin No. 321',
            'Gang Mawar No. 88',
        ];

        return $locations[array_rand($locations)];
    }

    private function getRandomSchoolLocation()
    {
        $schools = [
            'SD Negeri 01 Jakarta',
            'SMP Negeri 12 Jakarta',
            'SMA Negeri 8 Jakarta',
            'SD Swasta Bina Bangsa',
            'SMP Al-Azhar Jakarta',
            'SMA Kanisius Jakarta',
        ];

        return $schools[array_rand($schools)];
    }

    private function getRandomStatus($date)
    {
        // Untuk tanggal yang sudah lewat, status lebih bervariasi
        if ($date->isPast()) {
            $statuses = ['selesai', 'selesai', 'selesai', 'dibatalkan'];
        } else {
            // Untuk tanggal yang akan datang
            $statuses = ['menunggu', 'menunggu', 'dijemput', 'perjalanan'];
        }

        return $statuses[array_rand($statuses)];
    }

    private function getRandomNote()
    {
        $notes = [
            'Anak sudah siap di depan rumah',
            'Tolong hubungi sebelum tiba',
            'Jalur macet, mungkin terlambat',
            null,
            'Anak membawa tas olahraga',
            'Ada PR yang tertinggal',
            null,
            'Cuaca hujan, bawa payung',
        ];

        return $notes[array_rand($notes)];
    }

    private function getRandomDriverTakeTime($date)
    {
        // Hanya untuk jadwal yang statusnya bukan 'menunggu'
        if ($date->isPast() && rand(0, 1)) {
            return $date->setTime(rand(6, 8), rand(0, 59), rand(0, 59));
        }

        return null;
    }
}
