<?php

namespace Database\Seeders;

use App\Models\Anak;
use App\Models\Booking;
use App\Models\Orang_tua;
use App\Models\RentalService;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing data
        $orangTuaIds = Orang_tua::pluck('id')->toArray();
        $schoolIds = School::pluck('id')->toArray();
        $rentalServiceIds = RentalService::pluck('id')->toArray();
        $anakByOrangTua = Anak::with('orangTua')->get()->groupBy('orang_tua_id');

        if (empty($orangTuaIds) || empty($schoolIds) || empty($rentalServiceIds)) {
            $this->command->warn('Skipping BookingSeeder: Required data not found. Please run other seeders first.');

            return;
        }

        $bookings = [];

        // Create sample bookings
        for ($i = 1; $i <= 20; $i++) {
            $orangTuaId = $orangTuaIds[array_rand($orangTuaIds)];
            $schoolId = $schoolIds[array_rand($schoolIds)];
            $rentalServiceId = $rentalServiceIds[array_rand($rentalServiceIds)];

            // Get children for this orang_tua
            $childrenForParent = $anakByOrangTua->get($orangTuaId, collect());
            $childrenIds = $childrenForParent->pluck('id')->toArray();

            // If no children, create a dummy booking with empty children_ids
            if (empty($childrenIds)) {
                $childrenIds = [];
                $childrenCount = 1;
            } else {
                // Randomly select 1-3 children
                $maxChildren = min(3, count($childrenIds));
                $selectedCount = rand(1, $maxChildren);
                $childrenIds = array_slice(array_values($childrenIds), 0, $selectedCount);
                $childrenCount = count($childrenIds);
            }

            $serviceType = $this->getRandomServiceType();
            $tripType = $this->getRandomTripType();
            $distance = round(rand(5, 50) + (rand(0, 99) / 100), 2); // 5.00 - 50.99 km

            $basePrice = $this->calculateBasePrice($distance, $serviceType, $childrenCount);
            $additionalCharges = $this->getRandomAdditionalCharges();
            $totalPrice = $basePrice + $additionalCharges;

            $pickupTime = Carbon::now()->addDays(rand(1, 30))->setTime(rand(6, 8), rand(0, 59));
            $returnTime = $tripType === 'two_way' ?
                $pickupTime->copy()->addHours(rand(8, 12)) : null;

            $bookings[] = [
                'orang_tua_id' => $orangTuaId,
                'school_id' => $schoolId,
                'rental_service_id' => $rentalServiceId,
                'service_type' => $serviceType,
                'trip_type' => $tripType,
                'children_ids' => $childrenIds,
                'distance_km' => $distance,
                'base_price' => $basePrice,
                'additional_charges' => $additionalCharges,
                'total_price' => $totalPrice,
                'currency' => 'IDR',
                'pickup_time' => $pickupTime,
                'return_time' => $returnTime,
                'pickup_address' => $this->getRandomAddress(),
                'destination_address' => $this->getSchoolAddress($schoolId),
                'return_address' => $this->getRandomAddress(),
                'pricing_breakdown' => $this->getPricingBreakdown($basePrice, $additionalCharges, $childrenCount),
                'status' => $this->getRandomStatus(),
                'notes' => $this->getRandomNotes(),
                'created_at' => Carbon::now()->subDays(rand(0, 90)),
                'updated_at' => Carbon::now()->subDays(rand(0, 30)),
            ];
        }

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }

        $this->command->info('Created '.count($bookings).' sample bookings.');
    }

    private function getRandomServiceType()
    {
        $types = ['school_transport', 'rental', 'general'];

        return $types[array_rand($types)];
    }

    private function getRandomTripType()
    {
        $types = ['one_way', 'two_way'];

        return $types[array_rand($types)];
    }

    private function calculateBasePrice($distance, $serviceType, $childrenCount)
    {
        $baseRatePerKm = [
            'school_transport' => 2000,
            'rental' => 3000,
            'general' => 2500,
        ];

        $rate = $baseRatePerKm[$serviceType] ?? 2500;
        $basePrice = $distance * $rate;

        // Apply children multiplier
        if ($childrenCount <= 1) {
            $multiplier = 1.0;
        } elseif ($childrenCount == 2) {
            $multiplier = 1.0; // Same price for 2 children (sibling discount)
        } elseif ($childrenCount == 3) {
            $multiplier = 2.0; // 2 billing units for 3 children
        } else {
            $multiplier = ceil($childrenCount / 2); // Formula for 4+ children
        }

        return round($basePrice * $multiplier, 2);
    }

    private function getRandomAdditionalCharges()
    {
        $charges = [0, 25000, 50000, 75000, 100000];

        return $charges[array_rand($charges)];
    }

    private function getRandomAddress()
    {
        $addresses = [
            'Jl. Merdeka No. 123, Jakarta Pusat',
            'Jl. Sudirman No. 456, Jakarta Selatan',
            'Jl. Gatot Subroto No. 789, Jakarta Selatan',
            'Jl. Thamrin No. 321, Jakarta Pusat',
            'Jl. HR. Rasuna Said No. 654, Jakarta Selatan',
            'Jl. Kuningan No. 987, Jakarta Selatan',
            'Jl. Kemang Raya No. 258, Jakarta Selatan',
            'Jl. Pondok Indah No. 147, Jakarta Selatan',
            'Jl. Senayan No. 369, Jakarta Pusat',
            'Jl. Menteng No. 741, Jakarta Pusat',
        ];

        return $addresses[array_rand($addresses)];
    }

    private function getSchoolAddress($schoolId)
    {
        $school = School::find($schoolId);

        return $school ? $school->address : 'Alamat Sekolah Tidak Ditemukan';
    }

    private function getPricingBreakdown($basePrice, $additionalCharges, $childrenCount)
    {
        return [
            'base_price' => $basePrice,
            'additional_charges' => [
                'weekend_surcharge' => $additionalCharges * 0.3,
                'fuel_surcharge' => $additionalCharges * 0.4,
                'service_fee' => $additionalCharges * 0.3,
            ],
            'children_count' => $childrenCount,
            'billing_units' => $childrenCount <= 2 ? 1 : ceil($childrenCount / 2),
            'discounts_applied' => $childrenCount > 1 ? ['sibling_discount'] : [],
        ];
    }

    private function getRandomStatus()
    {
        $statuses = ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'];
        $weights = [20, 30, 10, 35, 5]; // Percentage weights

        $rand = rand(1, 100);
        $cumulative = 0;

        foreach ($statuses as $index => $status) {
            $cumulative += $weights[$index];
            if ($rand <= $cumulative) {
                return $status;
            }
        }

        return 'pending';
    }

    private function getRandomNotes()
    {
        $notes = [
            'Mohon driver datang 5 menit lebih awal',
            'Anak suka cerita, driver bisa mengobrol',
            'Rumah di gang kecil, perhatikan alamat',
            'Ada parkiran di depan rumah',
            'Jangan lupa bawa air mineral',
            'Anak kadang mabuk perjalanan',
            null, // Some bookings have no notes
            null,
            'Mohon hubungi jika ada keterlambatan',
            'Anak alergi parfum, tolong tidak pakai wewangian berlebihan',
        ];

        return $notes[array_rand($notes)];
    }
}
