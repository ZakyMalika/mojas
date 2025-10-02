<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil
     */
    public function edit()
    {
        $user = Auth::user();
        
        // Load relasi berdasarkan role
        if ($user->role === 'pengemudi' && $user->driver) {
            $user->load('driver');
        } elseif ($user->role === 'orang_tua' && $user->orangTua) {
            $user->load('orangTua');
        }

        return view('profile.edit', compact('user'));
    }

    /**
     * Update profil user
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi data dasar
        $rules = [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'no_telp' => ['required', 'string', 'max:15', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // Tambahkan validasi berdasarkan role
        if ($user->role === 'pengemudi') {
            $rules['nomor_plat'] = 'nullable|string|max:20';
        } elseif ($user->role === 'orang_tua') {
            $rules['alamat'] = 'required|string|max:500';
            $rules['catatan'] = 'nullable|string|max:1000';
        }

        $validated = $request->validate($rules, [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'no_telp.required' => 'Nomor telepon harus diisi',
            'no_telp.unique' => 'Nomor telepon sudah digunakan',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'alamat.required' => 'Alamat harus diisi',
        ]);

        try {
            // Update data user
            $userData = [
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'no_telp' => $validated['no_telp'],
            ];

            // Update password jika diisi
            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $user->update($userData);

            // Update data spesifik berdasarkan role
            if ($user->role === 'pengemudi' && $user->driver) {
                $user->driver->update([
                    'nomor_plat' => $validated['nomor_plat'] ?? $user->driver->nomor_plat,
                ]);
            } elseif ($user->role === 'orang_tua' && $user->orangTua) {
                $user->orangTua->update([
                    'alamat' => $validated['alamat'],
                    'catatan' => $validated['catatan'] ?? $user->orangTua->catatan,
                ]);
            }

            return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman profil (read-only)
     */
    public function show()
    {
        $user = Auth::user();
        
        // Load relasi berdasarkan role
        if ($user->role === 'pengemudi' && $user->driver) {
            $user->load('driver');
        } elseif ($user->role === 'orang_tua' && $user->orangTua) {
            $user->load('orangTua', 'orangTua.anak');
        }

        return view('profile.show', compact('user'));
    }
}
