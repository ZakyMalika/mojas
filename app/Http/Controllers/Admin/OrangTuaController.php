<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orang_tua;
use App\Models\User;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function index(Request $request)
    {
        $query = Orang_tua::with(['user', 'anak', 'pembayaran']);
        
        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_telp', 'like', "%{$search}%");
            })->orWhere('alamat', 'like', "%{$search}%");
        }

        $perPage = 15; // Konsisten menggunakan 15 item per halaman
        $items = $query->latest()
                      ->paginate($perPage)
                      ->withQueryString(); // Mempertahankan parameter URL saat paginasi

        return view('admin.orang_tua.index', compact('items'));
    }

    public function create()
    {
        $users = User::where('role', 'orang_tua')->get();
        return view('admin.orang_tua.create',compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'alamat' => ['required', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);
        $item = Orang_tua::create($data);

        return redirect()->route('admin.orang_tua.show', $item);
    }

    public function show(Orang_tua $orang_tua)
    {
        $orang_tua->load(['user', 'anak', 'pembayaran']);

        return view('admin.orang_tua.show', ['item' => $orang_tua]);
    }

    public function edit(Orang_tua $orang_tua)
    {
        $orang_tua->load(['user']);

        return view('admin.orang_tua.edit', ['item' => $orang_tua]);
    }

    public function update(Request $request, Orang_tua $orang_tua)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'alamat' => ['required', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);
        $orang_tua->update($data);

        return redirect()->route('admin.orang_tua.show', $orang_tua);
    }

    public function destroy(Orang_tua $orang_tua)
    {
        // Cek apakah ada data terkait yang mencegah penghapusan
        $relatedData = [];
        
        // Cek bookings
        $bookingsCount = $orang_tua->bookings()->count();
        if ($bookingsCount > 0) {
            $relatedData[] = "$bookingsCount booking(s)";
        }
        
        // Cek anak
        $anakCount = $orang_tua->anak()->count();
        if ($anakCount > 0) {
            $relatedData[] = "$anakCount anak";
        }
        
        // Cek pembayaran
        $pembayaranCount = $orang_tua->pembayaran()->count();
        if ($pembayaranCount > 0) {
            $relatedData[] = "$pembayaranCount pembayaran";
        }
        
        // Jika ada data terkait, tidak bisa dihapus
        if (!empty($relatedData)) {
            return redirect()->route('admin.orang_tua.index')
                ->with('error', 'Tidak dapat menghapus orang tua ini karena masih terkait dengan: ' . implode(', ', $relatedData) . '. Hapus data terkait terlebih dahulu.');
        }
        
        try {
            $orang_tua->delete();
            return redirect()->route('admin.orang_tua.index')
                ->with('success', 'Data orang tua berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.orang_tua.index')
                ->with('error', 'Gagal menghapus data orang tua. Error: ' . $e->getMessage());
        }
    }
}
