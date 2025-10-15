<?php

namespace App\Http\Controllers\ParentArea;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnakController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        $items = Anak::with(['orangTua', 'jadwal_antar_jemput', 'pendaftaran_anak'])
            ->where('orang_tua_id', $parent->id)
            ->paginate($perPage)->appends($request->query());

        return view('parent.anak.index', compact('items'));
    }

    public function create()
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        $items = Anak::with(['orangTua', 'jadwal_antar_jemput', 'pendaftaran_anak'])
            ->where('orang_tua_id', $parent->id)
            ->get();
        return view('parent.anak.create', compact('items'));
    }

    public function store(Request $request)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'umur' => ['nullable', 'integer', 'min:0'],
            'kelas' => ['nullable', 'string', 'max:255'],
            'sekolah' => ['nullable', 'string', 'max:255'],
            'alamat_penjemputan' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);
        $data['orang_tua_id'] = $parent->id;
        $item = Anak::create($data);

        return redirect()->route('parent.anak.show', $item);
    }

    public function show(Anak $anak)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_if($anak->orang_tua_id !== $parent->id, 403);
        $anak->load(['orangTua', 'jadwal_antar_jemput', 'pendaftaran_anak']);

        return view('parent.anak.show', ['item' => $anak]);
    }

    public function edit(Anak $anak)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_if($anak->orang_tua_id !== $parent->id, 403);
        $anak->load(['orangTua']);

        return view('parent.anak.edit', ['item' => $anak]);
    }

    public function update(Request $request, Anak $anak)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_if($anak->orang_tua_id !== $parent->id, 403);
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'umur' => ['nullable', 'integer', 'min:0'],
            'kelas' => ['nullable', 'string', 'max:255'],
            'sekolah' => ['nullable', 'string', 'max:255'],
            'alamat_penjemputan' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);
        $anak->update($data);

        return redirect()->route('parent.anak.show', $anak);
    }

    public function destroy(Anak $anak)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_if($anak->orang_tua_id !== $parent->id, 403);
        $anak->delete();

        return redirect()->route('parent.anak.index');
    }
}
