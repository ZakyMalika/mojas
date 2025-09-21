<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            OrangTuaSeeder::class,
            DriverSeeder::class,
            TarifJarakSeeder::class,
            AnakSeeder::class,
            PendaftaranAnakSeeder::class,
            JadwalAntarJemputSeeder::class,
            PembayaranSeeder::class,
            PenghasilanDriverSeeder::class,
            LogJadwalSeeder::class,
        ]);
    }
}
