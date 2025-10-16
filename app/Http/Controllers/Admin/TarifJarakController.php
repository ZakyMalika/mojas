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
            'min_distance_km' => ['numeric'],
            'max_distance_km' => ['numeric'],
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
