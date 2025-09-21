<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Pembayaran::with(['pendaftaran_anak', 'orang_tua'])->paginate($perPage)->appends($request->query());

        return view('admin.pembayaran.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pembayaran.create');
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
