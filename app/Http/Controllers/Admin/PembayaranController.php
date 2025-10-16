<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orang_tua;
use App\Models\Pembayaran;
use App\Models\Pendaftaran_anak;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['pendaftaran_anak', 'orang_tua']);
        
        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('status', 'like', "%{$search}%")
                  ->orWhere('metode_pembayaran', 'like', "%{$search}%")
                  ->orWhereHas('orang_tua.user', function($subQuery) use ($search) {
                      $subQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('pendaftaran_anak.anak', function($subQuery) use ($search) {
                      $subQuery->where('nama', 'like', "%{$search}%");
                  });
            });
        }
        
        $items = $query->latest()->paginate(15)->withQueryString();

        return view('admin.pembayaran.index', compact('items'));
    }

    public function create()
    {
        $pendaftaranList = Pendaftaran_anak::with('anak')->get();
        $orangTuaList = Orang_tua::with('user')->get();

        return view('admin.pembayaran.create', compact('pendaftaranList', 'orangTuaList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pendaftaran_anak_id' => ['required', 'integer', 'exists:pendaftaran_anak,id'],
            'orang_tua_id' => ['required', 'integer', 'exists:orang_tua,id'],
            'jumlah_bayar' => ['required', 'numeric'],
            'metode_pembayaran' => ['required', 'in:cash,transfer,e-wallet'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,sukses,gagal'],
        ]);
        $item = Pembayaran::create($data);

        return redirect()->route('admin.pembayaran.show', $item);
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load(['pendaftaran_anak', 'orang_tua']);

        return view('admin.pembayaran.show', ['item' => $pembayaran]);
    }

    public function edit(Pembayaran $pembayaran)
    {
        $pembayaran->load(['pendaftaran_anak', 'orang_tua']);

        return view('admin.pembayaran.edit', ['item' => $pembayaran]);
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $data = $request->validate([
            'pendaftaran_anak_id' => ['required', 'integer', 'exists:pendaftaran_anak,id'],
            'orang_tua_id' => ['required', 'integer', 'exists:orang_tua,id'],
            'jumlah_bayar' => ['required', 'numeric'],
            'metode_pembayaran' => ['required', 'in:cash,transfer,e-wallet'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,sukses,gagal'],
        ]);
        $pembayaran->update($data);

        return redirect()->route('admin.pembayaran.show', $pembayaran);
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('admin.pembayaran.index');
    }
}
