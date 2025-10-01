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
            // Core user and role data
            UserSeeder::class,
            OrangTuaSeeder::class,
            DriverSeeder::class,

            // New tables for enhanced features
            SchoolSeeder::class,
            RentalServiceSeeder::class,
            PricingTierSeeder::class,

            // Original system data
            TarifJarakSeeder::class,
            AnakSeeder::class,
            PendaftaranAnakSeeder::class,
            JadwalAntarJemputSeeder::class,
            PembayaranSeeder::class,
            PenghasilanDriverSeeder::class,
            LogJadwalSeeder::class,

            // New booking system (depends on all above)
            BookingSeeder::class,
        ]);
    }
}
