<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Tampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi user baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'no_telp' => ['required', 'string', 'max:15', 'unique:users,no_telp'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,orang_tua,pengemudi'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Auto login setelah registrasi
        Auth::login($user);

        // Redirect berdasarkan role user
        switch ($user->role) {
            case 'admin':
                return redirect('/admin')->with('success', 'Registrasi berhasil! Selamat datang Admin.');
            case 'pengemudi':
                return redirect('/driver')->with('success', 'Registrasi berhasil! Selamat datang Pengemudi.');
            case 'orang_tua':
                return redirect('/parent')->with('success', 'Registrasi berhasil! Selamat datang Orang Tua.');
            default:
                return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang.');
        }
    }

    /**
     * Validasi username secara real-time (AJAX).
     */
    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Username sudah digunakan' : 'Username tersedia'
        ]);
    }

    /**
     * Validasi email secara real-time (AJAX).
     */
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = User::where('email', $email)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email sudah digunakan' : 'Email tersedia'
        ]);
    }

    /**
     * Validasi nomor telepon secara real-time (AJAX).
     */
    public function checkPhone(Request $request)
    {
        $no_telp = $request->input('no_telp');
        $exists = User::where('no_telp', $no_telp)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Nomor telepon sudah digunakan' : 'Nomor telepon tersedia'
        ]);
    }
}
