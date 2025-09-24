<?php

namespace App\Http\Controllers\ParentArea;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran_anak;
use App\Models\Anak; // Penting: Tambahkan ini untuk mengambil data anak
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranAnakController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        $items = Pendaftaran_anak::with(['anak', 'tarif_jarak'])
            ->whereHas('anak', fn ($q) => $q->where('orang_tua_id', $parent->id))
            ->paginate($perPage)->appends($request->query());

        return view('parent.pendaftaran_anak.index', compact('items'));
    }

    /**
     * PERBAIKAN: Method ini sekarang mengambil daftar anak
     * milik orang tua yang BELUM TERDAFTAR di layanan.
     */
    public function create()
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403, 'Profil orang tua tidak ditemukan.');

        // 1. Dapatkan ID anak-anak yang sudah terdaftar di layanan
        $registeredAnakIds = Pendaftaran_anak::pluck('anak_id')->toArray();

        // 2. Ambil semua data anak yang dimiliki oleh orang tua ini DAN belum terdaftar
        $anakList = Anak::where('orang_tua_id', $parent->id)
                         ->whereNotIn('id', $registeredAnakIds)
                         ->get();

        // 3. Kirim daftar anak yang tersedia tersebut ke view
        return view('parent.pendaftaran_anak.create', compact('anakList'));
    }

    public function store(Request $request)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        $data = $request->validate([
            'anak_id' => ['required', 'integer', 'exists:anak,id'],
            'jarak_km' => ['required', 'numeric'],
            'tipe_layanan' => ['required', 'in:one_way,two_way'],
            'tarif_bulanan' => ['required', 'numeric'],
            'tarif_id' => ['required', 'integer', 'exists:tarif_jarak,id'],
            'periode_mulai' => ['required', 'date'],
            'periode_selesai' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,lunas,expired'],
        ]);
        // Pastikan anak milik parent login
        abort_unless(\App\Models\Anak::where('id', $data['anak_id'])->where('orang_tua_id', $parent->id)->exists(), 403);
        $item = Pendaftaran_anak::create($data);

        return redirect()->route('parent.pendaftaran-anak.show', $item);
    }

    public function show(Pendaftaran_anak $pendaftaran_anak)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_unless($pendaftaran_anak->anak && $pendaftaran_anak->anak->orang_tua_id === $parent->id, 403);
        $pendaftaran_anak->load(['anak', 'tarif_jarak']);

        return view('parent.pendaftaran_anak.show', ['item' => $pendaftaran_anak]);
    }

    /**
     * PERBAIKAN: Method ini sekarang mengambil daftar anak yang tersedia
     * (belum terdaftar ATAU anak yang sedang diedit saat ini).
     */
    public function edit(Pendaftaran_anak $pendaftaran_anak)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_unless($pendaftaran_anak->anak && $pendaftaran_anak->anak->orang_tua_id === $parent->id, 403);

        // 1. Dapatkan ID anak-anak lain yang sudah terdaftar
        $registeredAnakIds = Pendaftaran_anak::where('id', '!=', $pendaftaran_anak->id)
                                              ->pluck('anak_id')
                                              ->toArray();

        // 2. Ambil daftar anak yang BISA dipilih di form edit
        $anakList = Anak::where('orang_tua_id', $parent->id)
                         ->where(function ($query) use ($registeredAnakIds, $pendaftaran_anak) {
                             $query->whereNotIn('id', $registeredAnakIds)
                                   ->orWhere('id', $pendaftaran_anak->anak_id);
                         })
                         ->get();

        $pendaftaran_anak->load(['anak', 'tarif_jarak']);

        return view('parent.pendaftaran_anak.edit', [
            'item' => $pendaftaran_anak,
            'anakList' => $anakList
        ]);
    }

    public function update(Request $request, Pendaftaran_anak $pendaftaran_anak)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_unless($pendaftaran_anak->anak && $pendaftaran_anak->anak->orang_tua_id === $parent->id, 403);
        $data = $request->validate([
            'anak_id' => ['required', 'integer', 'exists:anak,id'],
            'jarak_km' => ['required', 'numeric'],
            'tipe_layanan' => ['required', 'in:one_way,two_way'],
            'tarif_bulanan' => ['required', 'numeric'],
            'tarif_id' => ['required', 'integer', 'exists:tarif_jarak,id'],
            'periode_mulai' => ['required', 'date'],
            'periode_selesai' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,lunas,expired'],
        ]);
        // Anak harus tetap milik parent
        abort_unless(\App\Models\Anak::where('id', $data['anak_id'])->where('orang_tua_id', $parent->id)->exists(), 403);
        $pendaftaran_anak->update($data);

        return redirect()->route('parent.pendaftaran-anak.show', $pendaftaran_anak);
    }

    public function destroy(Pendaftaran_anak $pendaftaran_anak)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_unless($pendaftaran_anak->anak && $pendaftaran_anak->anak->orang_tua_id === $parent->id, 403);
        $pendaftaran_anak->delete();

        return redirect()->route('parent.pendaftaran-anak.index');
    }
}

