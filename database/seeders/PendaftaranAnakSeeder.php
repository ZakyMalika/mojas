<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendaftaranAnakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua anak dan tarif yang tersedia
        $anakIds = DB::table('anak')->pluck('id')->toArray();
        $tarifIds = DB::table('tarif_jarak')->pluck('id')->toArray();

        if (empty($anakIds) || empty($tarifIds)) {
            return; // Skip jika tidak ada data
        }

        foreach ($anakIds as $anakId) {
            // Setiap anak memiliki pendaftaran (beberapa mungkin lebih dari 1)
            $jumlahPendaftaran = rand(1, 2);

            for ($i = 0; $i < $jumlahPendaftaran; $i++) {
                $tarifId = $tarifIds[array_rand($tarifIds)];
                $tipeLayanan = $this->getRandomServiceType();
                $jarak = $this->getRandomDistance();
                $tarif = $this->calculateTarif($tarifId, $tipeLayanan);
                
                // Periode pendaftaran
                $periodeStart = Carbon::now()->subMonths(rand(0, 6));
                $periodeEnd = $i == 0 ? null : $periodeStart->copy()->addMonths(rand(1, 12)); // Pendaftaran pertama masih aktif

                DB::table('pendaftaran_anak')->insert([
                    'anak_id' => $anakId,
                    'jarak_km' => $jarak,
                    'tipe_layanan' => $tipeLayanan,
                    'tarif_bulanan' => $tarif,
                    'tarif_id' => $tarifId,
                    'periode_mulai' => $periodeStart->format('Y-m-d'),
                    'periode_selesai' => $periodeEnd ? $periodeEnd->format('Y-m-d') : null,
                    'status' => $this->getRandomStatus($periodeEnd),
                    'created_at' => $periodeStart,
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getRandomServiceType()
    {
        return ['one_way', 'two_way'][array_rand(['one_way', 'two_way'])];
    }

    private function getRandomDistance()
    {
        return round(rand(10, 500) / 10, 1); // Jarak 1.0 - 50.0 km
    }

    private function calculateTarif($tarifId, $tipeLayanan)
    {
        // Ambil tarif berdasarkan ID
        $tarif = DB::table('tarif_jarak')->where('id', $tarifId)->first();
        
        if (!$tarif) {
            return 150000; // Default tarif
        }

        $baseTarif = $tipeLayanan === 'one_way' ? $tarif->tarif_one_way : $tarif->tarif_two_way;
        
        // Tarif bulanan = tarif harian x 22 hari kerja (dengan sedikit diskon)
        return round($baseTarif * 22 * 0.9); // 10% diskon untuk bulanan
    }

    private function getRandomStatus($periodeEnd)
    {
        if ($periodeEnd && Carbon::parse($periodeEnd)->isPast()) {
            return ['expired', 'lunas'][array_rand(['expired', 'lunas'])];
        }

        return ['pending', 'lunas'][array_rand(['pending', 'lunas'])];
    }
}
