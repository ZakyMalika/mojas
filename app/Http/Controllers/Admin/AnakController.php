<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Orang_tua;
use Illuminate\Http\Request;

class AnakController extends Controller
{
    public function index(Request $request)
    {
        $query = Anak::with(['orangTua', 'jadwal_antar_jemput', 'pendaftaran_anak']);
        
        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('sekolah', 'like', "%{$search}%")
                  ->orWhereHas('orangTua.user', function($subQuery) use ($search) {
                      $subQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $items = $query->latest()->paginate(15)->withQueryString();

        return view('admin.anak.index', compact('items'));
    }

    public function create()
    {
        $orang_tua = Orang_tua::with(['user'])->get();

        return view('admin.anak.create', compact('orang_tua'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'orang_tua_id' => ['required', 'integer', 'exists:orang_tua,id'],
            'nama' => ['required', 'string', 'max:255'],
            'umur' => ['nullable', 'integer', 'min:0'],
            'kelas' => ['nullable', 'string', 'max:255'],
            'sekolah' => ['nullable', 'string', 'max:255'],
            'alamat_penjemputan' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);
        $item = Anak::create($data);

        return redirect()->route('admin.anak.show', $item);
    }

    public function show(Anak $anak)
    {
        $anak->load(['orangTua', 'jadwal_antar_jemput', 'pendaftaran_anak']);

        return view('admin.anak.show', ['item' => $anak]);
    }

    public function edit(Anak $anak)
    {
        $orang_tua = Orang_tua::with(['user'])->get();
        $item = $anak;

        return view('admin.anak.edit', compact('orang_tua', 'item'));
    }

    public function update(Request $request, Anak $anak)
    {
        $data = $request->validate([
            'orang_tua_id' => ['required', 'integer', 'exists:orang_tua,id'],
            'nama' => ['required', 'string', 'max:255'],
            'umur' => ['nullable', 'integer', 'min:0'],
            'kelas' => ['nullable', 'string', 'max:255'],
            'sekolah' => ['nullable', 'string', 'max:255'],
            'alamat_penjemputan' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);
        $anak->update($data);

        return redirect()->route('admin.anak.show', $anak);
    }

    public function destroy(Anak $anak)
    {
        $anak->delete();

        return redirect()->route('admin.anak.index');
    }
}
