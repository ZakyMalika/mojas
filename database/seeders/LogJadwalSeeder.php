<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogJadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua jadwal yang bukan status 'menunggu'
        $jadwalWithChanges = DB::table('jadwal_antar_jemput')
            ->where('status', '!=', 'menunggu')
            ->get();

        foreach ($jadwalWithChanges as $jadwal) {
            // Simulasikan perubahan status dari menunggu ke status akhir
            $statusProgression = $this->getStatusProgression($jadwal->status);

            $previousStatus = 'menunggu';
            $logTime = Carbon::parse($jadwal->tanggal.' '.$jadwal->jam_jemput)->subMinutes(30);

            foreach ($statusProgression as $newStatus) {
                DB::table('log_jadwal')->insert([
                    'jadwal_id' => $jadwal->id,
                    'driver_id' => $jadwal->drivers_id,
                    'status_lama' => $previousStatus,
                    'status_baru' => $newStatus,
                    'keterangan' => $this->getStatusChangeNote($previousStatus, $newStatus),
                    'created_at' => $logTime,
                    'updated_at' => $logTime,
                ]);

                $previousStatus = $newStatus;
                $logTime = $logTime->addMinutes(rand(10, 60)); // Interval antar perubahan status
            }
        }
    }

    private function getStatusProgression($finalStatus)
    {
        // Mapping progression status berdasarkan status akhir
        // Sesuaikan dengan enum di log_jadwal: ['menunggu', 'dijemput', 'diantar', 'selesai', 'batal']
        switch ($finalStatus) {
            case 'dijemput':
                return ['dijemput'];
            case 'perjalanan':
                return ['dijemput', 'diantar'];
            case 'selesai':
                return ['dijemput', 'diantar', 'selesai'];
            case 'dibatalkan':
                return ['batal'];
            default:
                return [];
        }
    }

    private function getStatusChangeNote($statusLama, $statusBaru)
    {
        $notes = [
            'menunggu->dijemput' => [
                'Driver telah tiba di lokasi penjemputan',
                'Anak sudah dijemput sesuai jadwal',
                'Proses penjemputan berjalan lancar',
            ],
            'dijemput->diantar' => [
                'Perjalanan menuju sekolah dimulai',
                'Dalam perjalanan ke tujuan',
                'Sedang dalam perjalanan, estimasi tiba 15 menit',
            ],
            'diantar->selesai' => [
                'Anak telah tiba di sekolah dengan selamat',
                'Proses antar jemput selesai',
                'Anak sudah diantar ke sekolah tepat waktu',
            ],
            'menunggu->batal' => [
                'Jadwal dibatalkan oleh orang tua',
                'Anak sakit, tidak bisa sekolah',
                'Cuaca buruk, jadwal dibatalkan',
                'Sekolah libur mendadak',
            ],
        ];

        $key = $statusLama.'->'.$statusBaru;

        if (isset($notes[$key])) {
            return $notes[$key][array_rand($notes[$key])];
        }

        return 'Perubahan status dari '.$statusLama.' ke '.$statusBaru;
    }
}
