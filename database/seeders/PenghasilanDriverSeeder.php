<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenghasilanDriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua jadwal yang sudah selesai untuk dihitung penghasilannya
        $jadwalSelesai = DB::table('jadwal_antar_jemput')
            ->where('status', 'selesai')
            ->get();

        foreach ($jadwalSelesai as $jadwal) {
            $tarifPerTrip = $this->calculateTarifPerTrip();
            $komisiDriver = $this->calculateKomisiDriver($tarifPerTrip);

            DB::table('penghasilan_driver')->insert([
                'driver_id' => $jadwal->drivers_id,
                'jadwal_id' => $jadwal->id,
                'tarif_per_trip' => $tarifPerTrip,
                'komisi_pengemudi' => $komisiDriver,
                'status' => $this->getRandomPaymentStatus(),
                'tanggal_dibayar' => $this->getRandomPaymentDate($jadwal->tanggal),
                'created_at' => Carbon::parse($jadwal->tanggal)->addHours(rand(8, 20)),
                'updated_at' => now(),
            ]);
        }
    }

    private function calculateTarifPerTrip()
    {
        // Tarif per trip bervariasi berdasarkan jarak dan kondisi
        $baseTarif = [
            15000, 20000, 25000, 30000, 35000, 40000, 45000, 50000,
        ];

        return $baseTarif[array_rand($baseTarif)];
    }

    private function calculateKomisiDriver($tarifPerTrip)
    {
        // Driver mendapat 60-80% dari tarif per trip
        $persentaseKomisi = rand(60, 80) / 100;

        return round($tarifPerTrip * $persentaseKomisi);
    }

    private function getRandomPaymentStatus()
    {
        // Kebanyakan sudah dibayar untuk jadwal yang sudah selesai
        $statuses = [
            'dibayar', 'dibayar', 'dibayar', 'dibayar', // Lebih sering dibayar
            'pending',
        ];

        return $statuses[array_rand($statuses)];
    }

    private function getRandomPaymentDate($tanggalJadwal)
    {
        // Jika status dibayar, tentukan tanggal pembayaran (biasanya 1-7 hari setelah jadwal)
        if ($this->getRandomPaymentStatus() === 'dibayar') {
            $tanggalBayar = Carbon::parse($tanggalJadwal)->addDays(rand(1, 7));

            // Pastikan tidak melebihi hari ini
            if ($tanggalBayar->isFuture()) {
                return null;
            }

            return $tanggalBayar;
        }

        return null;
    }
}
