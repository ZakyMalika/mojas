<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['driver', 'orangTua'])->paginate(15);
        return view('admin.users.index', compact('users')); 
    }
    public function show(User $user)
    {
        $user->load(['driver', 'orangTua']);
        return view('admin.users.show', compact('user'));
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'no_telp' => ['required', 'string', 'max:15', 'unique:users,no_telp'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,pengemudi,orang_tua'],
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        // Jika role adalah pengemudi atau orang_tua, buat entri terkait
        if ($user->role == 'pengemudi') {
            $user->driver()->create([
                'nomor_plat' => 'Belum Diisi',
            ]);
        } elseif ($user->role == 'orang_tua') {
            $user->orangTua()->create([
                'alamat' => 'Mohon lengkapi alamat Anda',
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat!');
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'no_telp' => ['required', 'string', 'max:15', 'unique:users,no_telp,' . $user->id],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'in:admin,pengemudi,orang_tua'],
        ]);
        
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        
        $oldRole = $user->role;
        $user->update($data);
        
        // Jika role berubah, buat entri terkait jika diperlukan
        if ($oldRole !== $data['role']) {
            if ($data['role'] == 'pengemudi' && !$user->driver) {
                $user->driver()->create([
                    'nomor_plat' => 'Belum Diisi',
                ]);
            } elseif ($data['role'] == 'orang_tua' && !$user->orangTua) {
                $user->orangTua()->create([
                    'alamat' => 'Mohon lengkapi alamat Anda',
                ]);
            }
        }
        
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate!');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}
