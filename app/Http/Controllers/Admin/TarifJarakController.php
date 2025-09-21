<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarif_jarak;
use Illuminate\Http\Request;

class TarifJarakController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Tarif_jarak::with(['pendaftaran_anak'])->paginate($perPage)->appends($request->query());

        return view('admin.tarif_jarak.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tarif_jarak.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jarak_dari_km' => ['required', 'numeric'],
            'jarak_sampai_km' => ['required', 'numeric'],
            'tarif_one_way' => ['required', 'numeric'],
            'tarif_two_way' => ['required', 'numeric'],
            'tarif_per_km' => ['required', 'numeric'],
        ]);
        $item = Tarif_jarak::create($data);

        return redirect()->route('admin.tarif-jarak.show', $item);
    }

    public function show(Tarif_jarak $tarif_jarak)
    {
        $tarif_jarak->load(['pendaftaran_anak']);

        return view('admin.tarif_jarak.show', ['item' => $tarif_jarak]);
    }

    public function edit(Tarif_jarak $tarif_jarak)
    {
        return view('admin.tarif_jarak.edit', ['item' => $tarif_jarak]);
    }

    public function update(Request $request, Tarif_jarak $tarif_jarak)
    {
        $data = $request->validate([
            'jarak_dari_km' => ['required', 'numeric'],
            'jarak_sampai_km' => ['required', 'numeric'],
            'tarif_one_way' => ['required', 'numeric'],
            'tarif_two_way' => ['required', 'numeric'],
            'tarif_per_km' => ['required', 'numeric'],
        ]);
        $tarif_jarak->update($data);

        return redirect()->route('admin.tarif-jarak.show', $tarif_jarak);
    }

    public function destroy(Tarif_jarak $tarif_jarak)
    {
        $tarif_jarak->delete();

        return redirect()->route('admin.tarif-jarak.index');
    }
}
