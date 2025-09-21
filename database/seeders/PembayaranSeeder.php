<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data pendaftaran anak dan orang tua
        $pendaftaranData = DB::table('pendaftaran_anak')
            ->join('anak', 'pendaftaran_anak.anak_id', '=', 'anak.id')
            ->select('pendaftaran_anak.id as pendaftaran_id', 'pendaftaran_anak.tarif_bulanan', 'anak.orang_tua_id')
            ->get();

        foreach ($pendaftaranData as $data) {
            // Buat beberapa pembayaran untuk setiap pendaftaran
            $jumlahPembayaran = rand(1, 6); // 1-6 bulan pembayaran

            for ($i = 0; $i < $jumlahPembayaran; $i++) {
                $tanggalBayar = Carbon::now()->subMonths($jumlahPembayaran - $i - 1)->addDays(rand(1, 28));

                DB::table('pembayaran')->insert([
                    'pendaftaran_anak_id' => $data->pendaftaran_id,
                    'orang_tua_id' => $data->orang_tua_id,
                    'jumlah_bayar' => $this->getRandomPaymentAmount($data->tarif_bulanan),
                    'metode_pembayaran' => $this->getRandomPaymentMethod(),
                    'tanggal_bayar' => $tanggalBayar,
                    'status' => $this->getRandomPaymentStatus(),
                    'created_at' => $tanggalBayar,
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getRandomPaymentAmount($tarifBulanan)
    {
        // Kebanyakan bayar sesuai tarif, tapi ada yang bayar sebagian atau lebih
        $variations = [
            $tarifBulanan, // Sesuai tarif
            $tarifBulanan, // Sesuai tarif (lebih sering)
            $tarifBulanan, // Sesuai tarif (lebih sering)
            $tarifBulanan * 0.5, // Bayar separuh (DP)
            $tarifBulanan * 2, // Bayar 2 bulan sekaligus
            $tarifBulanan + 25000, // Bayar lebih (termasuk uang bensin, dll)
        ];

        return $variations[array_rand($variations)];
    }

    private function getRandomPaymentMethod()
    {
        $methods = [
            'cash', 'cash', 'cash', // Cash lebih sering
            'transfer', 'transfer',
            'e-wallet',
        ];

        return $methods[array_rand($methods)];
    }

    private function getRandomPaymentStatus()
    {
        $statuses = [
            'sukses', 'sukses', 'sukses', 'sukses', // Sukses lebih sering
            'pending',
            'gagal',
        ];

        return $statuses[array_rand($statuses)];
    }
}
