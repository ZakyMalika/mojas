<?php

namespace Database\Seeders;

use App\Models\RentalService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rentalServices = [
            [
                'name' => 'Paket Wisata Keluarga',
                'guest_type' => 'individual',
                'currency' => 'IDR',
                'price_per_12_hours' => 800000.00,
                'includes_driver' => true,
                'max_hours' => 12,
                'overtime_rate_per_hour' => 75000.00,
                'description' => 'Paket rental mobil 12 jam untuk wisata keluarga dengan driver berpengalaman',
                'included_services' => [
                    'Driver berpengalaman',
                    'BBM dalam kota',
                    'Parkir dan tol',
                    'Air mineral untuk penumpang'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Paket Bisnis Executive',
                'guest_type' => 'corporate',
                'currency' => 'IDR',
                'price_per_12_hours' => 1200000.00,
                'includes_driver' => true,
                'max_hours' => 10,
                'overtime_rate_per_hour' => 120000.00,
                'description' => 'Paket rental untuk kebutuhan bisnis dan corporate dengan mobil executive',
                'included_services' => [
                    'Driver profesional berbahasa Inggris',
                    'Mobil executive (Camry/Accord)',
                    'BBM dalam kota',
                    'Parkir dan tol',
                    'WiFi portable',
                    'Tissue dan hand sanitizer'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Paket Antar Jemput Sekolah Harian',
                'guest_type' => 'individual',
                'currency' => 'IDR',
                'price_per_12_hours' => 500000.00,
                'includes_driver' => true,
                'max_hours' => 8,
                'overtime_rate_per_hour' => 60000.00,
                'description' => 'Paket khusus untuk antar jemput sekolah dengan jadwal tetap harian',
                'included_services' => [
                    'Driver tetap berpengalaman dengan anak',
                    'Rute optimized untuk sekolah',
                    'BBM sesuai rute',
                    'Parkir sekolah',
                    'Asuransi penumpang'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Paket Airport Transfer Premium',
                'guest_type' => 'individual',
                'currency' => 'IDR',
                'price_per_12_hours' => 600000.00,
                'includes_driver' => true,
                'max_hours' => 6,
                'overtime_rate_per_hour' => 90000.00,
                'description' => 'Layanan antar jemput bandara dengan service premium',
                'included_services' => [
                    'Driver profesional',
                    'Meet & greet service',
                    'BBM ke/dari bandara',
                    'Parkir bandara',
                    'Bantuan bagasi',
                    'Flight monitoring'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Paket Wedding & Event',
                'guest_type' => 'individual',
                'currency' => 'IDR',
                'price_per_12_hours' => 1500000.00,
                'includes_driver' => true,
                'max_hours' => 15,
                'overtime_rate_per_hour' => 100000.00,
                'description' => 'Paket special untuk acara pernikahan dan event khusus',
                'included_services' => [
                    'Driver formal berseragam',
                    'Mobil mewah (BMW/Mercedes)',
                    'Dekorasi mobil basic',
                    'BBM untuk event',
                    'Parkir dan tol',
                    'Standby selama event'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Paket Corporate Monthly',
                'guest_type' => 'corporate',
                'currency' => 'IDR',
                'price_per_12_hours' => 15000000.00,
                'includes_driver' => true,
                'max_hours' => 240, // 30 hari x 8 jam
                'overtime_rate_per_hour' => 80000.00,
                'description' => 'Paket bulanan untuk kebutuhan corporate dengan dedicated car',
                'included_services' => [
                    'Dedicated driver dan mobil',
                    'Maintenance mobil',
                    'BBM unlimited dalam kota',
                    'Parkir dan tol',
                    'Car wash mingguan',
                    '24/7 customer support'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Paket City Tour',
                'guest_type' => 'tourist',
                'currency' => 'IDR',
                'price_per_12_hours' => 700000.00,
                'includes_driver' => true,
                'max_hours' => 10,
                'overtime_rate_per_hour' => 70000.00,
                'description' => 'Paket wisata keliling kota dengan guide driver',
                'included_services' => [
                    'Driver sekaligus tour guide',
                    'Rekomendasi tempat wisata',
                    'BBM dalam kota',
                    'Parkir tempat wisata',
                    'Air mineral dan snack',
                    'Dokumentasi foto'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Paket Medical Support',
                'guest_type' => 'individual',
                'currency' => 'IDR',
                'price_per_12_hours' => 900000.00,
                'includes_driver' => true,
                'max_hours' => 8,
                'overtime_rate_per_hour' => 110000.00,
                'description' => 'Paket khusus untuk keperluan medis dan rumah sakit',
                'included_services' => [
                    'Driver terlatih first aid',
                    'Mobil dengan fasilitas medis basic',
                    'Prioritas route ke RS',
                    'BBM dan parkir RS',
                    'Standby waiting',
                    'Emergency contact 24/7'
                ],
                'is_active' => true,
            ],
        ];

        foreach ($rentalServices as $service) {
            RentalService::create($service);
        }
    }
}