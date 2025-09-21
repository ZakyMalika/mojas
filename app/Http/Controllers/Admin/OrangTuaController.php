<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orang_tua;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Orang_tua::with(['user', 'anak', 'pembayaran'])->paginate($perPage)->appends($request->query());

        return view('admin.orang_tua.index', compact('items'));
    }

    public function create()
    {
        return view('admin.orang_tua.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'alamat' => ['required', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);
        $item = Orang_tua::create($data);

        return redirect()->route('admin.orang-tua.show', $item);
    }

    public function show(Orang_tua $orang_tua)
    {
        $orang_tua->load(['user', 'anak', 'pembayaran']);

        return view('admin.orang_tua.show', ['item' => $orang_tua]);
    }

    public function edit(Orang_tua $orang_tua)
    {
        $orang_tua->load(['user']);

        return view('admin.orang_tua.edit', ['item' => $orang_tua]);
    }

    public function update(Request $request, Orang_tua $orang_tua)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'alamat' => ['required', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);
        $orang_tua->update($data);

        return redirect()->route('admin.orang-tua.show', $orang_tua);
    }

    public function destroy(Orang_tua $orang_tua)
    {
        $orang_tua->delete();

        return redirect()->route('admin.orang-tua.index');
    }
}
