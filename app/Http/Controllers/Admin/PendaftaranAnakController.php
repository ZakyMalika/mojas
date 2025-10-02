<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Pendaftaran_anak;
use App\Models\School;
use App\Models\Tarif_jarak;
use Illuminate\Http\Request;

class PendaftaranAnakController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Pendaftaran_anak::with(['anak', 'tarif_jarak', 'school'])->paginate($perPage)->appends($request->query());

        return view('admin.pendaftaran_anak.index', compact('items'));
    }

    public function create()
    {
        $anaksList = Anak::all();
        $tarifs = Tarif_jarak::all();
        $schools = School::where('has_partnership', true)->where('is_active', true)->get();

        return view('admin.pendaftaran_anak.create', compact('anaksList', 'tarifs', 'schools'));
    }

    public function store(Request $request)
    {
        // Base validation rules
        $rules = [
            'anak_id' => ['required', 'integer', 'exists:anak,id'],
            'school_id' => ['nullable', 'integer', 'exists:schools,id'],
            'tipe_layanan' => ['required', 'in:one_way,two_way'],
            'tarif_bulanan' => ['required', 'numeric'],
            'periode_mulai' => ['required', 'date'],
            'periode_selesai' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,lunas,expired'],
        ];
        
        // If no school partnership, require jarak_km and tarif_id
        if (!$request->school_id) {
            $rules['jarak_km'] = ['required', 'numeric'];
            $rules['tarif_id'] = ['required', 'integer', 'exists:tarif_jarak,id'];
        } else {
            $rules['jarak_km'] = ['nullable', 'numeric'];
            $rules['tarif_id'] = ['nullable', 'integer', 'exists:tarif_jarak,id'];
        }
        
        $data = $request->validate($rules);
        
        // If school partnership is selected, set jarak_km and tarif_id to null
        if ($data['school_id']) {
            $data['jarak_km'] = null;
            $data['tarif_id'] = null;
        }
        
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
        $pendaftaran_anak->load(['anak', 'tarif_jarak', 'school']);
        $schools = School::where('has_partnership', true)->where('is_active', true)->get();

        return view('admin.pendaftaran_anak.edit', [
            'item' => $pendaftaran_anak,
            'schools' => $schools
        ]);
    }

    public function update(Request $request, Pendaftaran_anak $pendaftaran_anak)
    {
        // Base validation rules
        $rules = [
            'anak_id' => ['required', 'integer', 'exists:anak,id'],
            'school_id' => ['nullable', 'integer', 'exists:schools,id'],
            'tipe_layanan' => ['required', 'in:one_way,two_way'],
            'tarif_bulanan' => ['required', 'numeric'],
            'periode_mulai' => ['required', 'date'],
            'periode_selesai' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,lunas,expired'],
        ];
        
        // If no school partnership, require jarak_km and tarif_id
        if (!$request->school_id) {
            $rules['jarak_km'] = ['required', 'numeric'];
            $rules['tarif_id'] = ['required', 'integer', 'exists:tarif_jarak,id'];
        } else {
            $rules['jarak_km'] = ['nullable', 'numeric'];
            $rules['tarif_id'] = ['nullable', 'integer', 'exists:tarif_jarak,id'];
        }
        
        $data = $request->validate($rules);
        
        // If school partnership is selected, set jarak_km and tarif_id to null
        if ($data['school_id']) {
            $data['jarak_km'] = null;
            $data['tarif_id'] = null;
        }
        
        $pendaftaran_anak->update($data);

        return redirect()->route('admin.pendaftaran-anak.show', $pendaftaran_anak);
    }

    public function destroy(Pendaftaran_anak $pendaftaran_anak)
    {
        $pendaftaran_anak->delete();

        return redirect()->route('admin.pendaftaran-anak.index');
    }
}
