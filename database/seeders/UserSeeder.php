<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@mojas.com',
            'no_telp' => '081234567890',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // User Orang Tua
        User::create([
            'name' => 'Budi Santoso',
            'username' => 'budi_parent',
            'email' => 'budi@gmail.com',
            'no_telp' => '081234567891',
            'password' => Hash::make('password123'),
            'role' => 'orang_tua',
            'email_verified_at' => now(),
        ]);

        // User Pengemudi
        User::create([
            'name' => 'Ahmad Driver',
            'username' => 'ahmad_driver',
            'email' => 'ahmad@gmail.com',
            'no_telp' => '081234567892',
            'password' => Hash::make('password123'),
            'role' => 'pengemudi',
            'email_verified_at' => now(),
        ]);

        // User Orang Tua Tambahan
        User::create([
            'name' => 'Siti Nurhaliza',
            'username' => 'siti_parent',
            'email' => 'siti@gmail.com',
            'no_telp' => '081234567893',
            'password' => Hash::make('password123'),
            'role' => 'orang_tua',
            'email_verified_at' => now(),
        ]);

        // User Pengemudi Tambahan
        User::create([
            'name' => 'Joko Suprapto',
            'username' => 'joko_driver',
            'email' => 'joko@gmail.com',
            'no_telp' => '081234567894',
            'password' => Hash::make('password123'),
            'role' => 'pengemudi',
            'email_verified_at' => now(),
        ]);
    }
}
