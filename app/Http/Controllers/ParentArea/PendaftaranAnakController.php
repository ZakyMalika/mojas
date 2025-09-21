<?php

namespace App\Http\Controllers\ParentArea;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran_anak;
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

    public function create()
    {
        return view('parent.pendaftaran_anak.create');
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

    public function edit(Pendaftaran_anak $pendaftaran_anak)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_unless($pendaftaran_anak->anak && $pendaftaran_anak->anak->orang_tua_id === $parent->id, 403);
        $pendaftaran_anak->load(['anak', 'tarif_jarak']);

        return view('parent.pendaftaran_anak.edit', ['item' => $pendaftaran_anak]);
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
