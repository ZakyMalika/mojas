<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use Illuminate\Http\Request;

class AnakController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Anak::with(['orangTua', 'jadwal_antar_jemput', 'pendaftaran_anak'])
            ->paginate($perPage)->appends($request->query());

        return view('admin.anak.index', compact('items'));
    }

    public function create()
    {
        return view('admin.anak.create');
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
        $anak->load(['orangTua']);

        return view('admin.anak.edit', ['item' => $anak]);
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
