<?php

namespace App\Http\Controllers\ParentArea;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        $items = Pembayaran::with(['pendaftaran_anak', 'orang_tua'])
            ->where('orang_tua_id', $parent->id)
            ->paginate($perPage)->appends($request->query());

        return view('parent.pembayaran.index', compact('items'));
    }

    public function create()
    {
        return view('parent.pembayaran.create');
    }

    public function store(Request $request)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        $data = $request->validate([
            'pendaftaran_anak_id' => ['required', 'integer', 'exists:pendaftaran_anak,id'],
            'jumlah_bayar' => ['required', 'numeric'],
            'metode_pembayaran' => ['required', 'in:cash,transfer,e-wallet'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,sukses,gagal'],
        ]);
        // Pastikan pendaftaran milik parent (via anak)
        abort_unless(\App\Models\Pendaftaran_anak::where('id', $data['pendaftaran_anak_id'])
            ->whereHas('anak', fn ($q) => $q->where('orang_tua_id', $parent->id))->exists(), 403);
        $data['orang_tua_id'] = $parent->id;
        $item = Pembayaran::create($data);

        return redirect()->route('parent.pembayaran.show', $item);
    }

    public function show(Pembayaran $pembayaran)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_if($pembayaran->orang_tua_id !== $parent->id, 403);
        $pembayaran->load(['pendaftaran_anak', 'orang_tua']);

        return view('parent.pembayaran.show', ['item' => $pembayaran]);
    }

    public function edit(Pembayaran $pembayaran)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_if($pembayaran->orang_tua_id !== $parent->id, 403);
        $pembayaran->load(['pendaftaran_anak', 'orang_tua']);

        return view('parent.pembayaran.edit', ['item' => $pembayaran]);
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_if($pembayaran->orang_tua_id !== $parent->id, 403);
        $data = $request->validate([
            'pendaftaran_anak_id' => ['required', 'integer', 'exists:pendaftaran_anak,id'],
            'jumlah_bayar' => ['required', 'numeric'],
            'metode_pembayaran' => ['required', 'in:cash,transfer,e-wallet'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,sukses,gagal'],
        ]);
        // Pastikan pendaftaran milik parent
        abort_unless(\App\Models\Pendaftaran_anak::where('id', $data['pendaftaran_anak_id'])
            ->whereHas('anak', fn ($q) => $q->where('orang_tua_id', $parent->id))->exists(), 403);
        $pembayaran->update($data);

        return redirect()->route('parent.pembayaran.show', $pembayaran);
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_if($pembayaran->orang_tua_id !== $parent->id, 403);
        $pembayaran->delete();

        return redirect()->route('parent.pembayaran.index');
    }
}
