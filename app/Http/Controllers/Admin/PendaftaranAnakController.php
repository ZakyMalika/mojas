<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Pendaftaran_anak;
use App\Models\Tarif_jarak;
use Illuminate\Http\Request;

class PendaftaranAnakController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Pendaftaran_anak::with(['anak', 'tarif_jarak'])->paginate($perPage)->appends($request->query());

        return view('admin.pendaftaran_anak.index', compact('items'));
    }

    public function create()
    {
        $anaksList = Anak::all();
        $tarifs = Tarif_jarak::all();

        return view('admin.pendaftaran_anak.create', compact('anaksList', 'tarifs'));
    }

    public function store(Request $request)
    {
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
        $item = Pendaftaran_anak::create($data);

        return redirect()->route('admin.pendaftaran-anak.show', $item);
    }

    public function show(Pendaftaran_anak $pendaftaran_anak)
    {
        $pendaftaran_anak->load(['anak', 'tarif_jarak']);

        return view('admin.pendaftaran_anak.show', ['item' => $pendaftaran_anak]);
    }

    public function edit(Pendaftaran_anak $pendaftaran_anak)
    {
        $pendaftaran_anak->load(['anak', 'tarif_jarak']);

        return view('admin.pendaftaran_anak.edit', ['item' => $pendaftaran_anak]);
    }

    public function update(Request $request, Pendaftaran_anak $pendaftaran_anak)
    {
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
        $pendaftaran_anak->update($data);

        return redirect()->route('admin.pendaftaran-anak.show', $pendaftaran_anak);
    }

    public function destroy(Pendaftaran_anak $pendaftaran_anak)
    {
        $pendaftaran_anak->delete();

        return redirect()->route('admin.pendaftaran-anak.index');
    }
}
