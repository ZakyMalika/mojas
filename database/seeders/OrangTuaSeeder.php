<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dengan role orang_tua
        $orangTuaUsers = User::where('role', 'orang_tua')->get();

        foreach ($orangTuaUsers as $user) {
            DB::table('orang_tua')->insert([
                'user_id' => $user->id,
                'alamat' => $this->getRandomAddress(),
                'catatan' => $this->getRandomNote(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
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
            'Jl. Senayan No. 147, Jakarta Pusat',
            'Jl. Kemang No. 258, Jakarta Selatan',
        ];

        return $addresses[array_rand($addresses)];
    }

    private function getRandomNote()
    {
        $notes = [
            'Anak suka bermain sepak bola',
            'Tolong dijemput tepat waktu',
            'Anak ada alergi makanan tertentu',
            'Rumah di gang kecil, perhatikan alamat',
            null, // Beberapa tidak ada catatan
            'Anak pemalu, tolong diperlakukan dengan baik',
            'Ada kucing di rumah, jangan takut',
            null,
        ];

        return $notes[array_rand($notes)];
    }
}
