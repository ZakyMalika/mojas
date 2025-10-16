<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarif_jarak;
use Illuminate\Http\Request;

class TarifJarakController extends Controller
{
    public function index(Request $request)
    {
        $query = Tarif_jarak::with(['pendaftaran_anak']);
        
        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('rounding_rule', 'like', "%{$search}%")
                  ->orWhere('min_distance_km', 'like', "%{$search}%")
                  ->orWhere('max_distance_km', 'like', "%{$search}%");
            });
        }
        
        $items = $query->latest()->paginate(15)->withQueryString();

        return view('admin.tarif_jarak.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tarif_jarak.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'min_distance_km' => ['required', 'numeric'],
            'max_distance_km' => ['required', 'numeric'],
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
            'min_distance_km' => ['required', 'numeric', 'min:0'],
            'max_distance_km' => ['required', 'numeric', 'min:0', 'gt:min_distance_km'],
            'tarif_one_way' => ['required', 'numeric', 'min:0'],
            'tarif_two_way' => ['required', 'numeric', 'min:0', 'gt:tarif_one_way'],
            'tarif_per_km' => ['required', 'numeric', 'min:0'],
        ], [
            'max_distance_km.gt' => 'Jarak maksimal harus lebih besar dari jarak minimal',
            'tarif_two_way.gt' => 'Tarif two way harus lebih besar dari tarif one way'
        ]);

        try {
            $tarif_jarak->update($data);
            return redirect()
                ->route('admin.tarif-jarak.index')
                ->with('success', 'Tarif jarak berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui tarif jarak: ' . $e->getMessage());
        }
    }    public function destroy(Tarif_jarak $tarif_jarak)
    {
        $tarif_jarak->delete();

        return redirect()->route('admin.tarif-jarak.index');
    }
}
