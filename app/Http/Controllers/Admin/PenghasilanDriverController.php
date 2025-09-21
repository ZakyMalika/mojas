<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penghasilan_driver;
use Illuminate\Http\Request;

class PenghasilanDriverController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Penghasilan_driver::with(['driver', 'jadwal'])->paginate($perPage)->appends($request->query());

        return view('admin.penghasilan.index', compact('items'));
    }

    public function create()
    {
        return view('admin.penghasilan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'driver_id' => ['required', 'integer', 'exists:drivers,id'],
            'jadwal_id' => ['required', 'integer', 'exists:jadwal_antar_jemput,id'],
            'tarif_per_trip' => ['required', 'numeric'],
            'komisi_pengemudi' => ['required', 'numeric'],
            'status' => ['required', 'in:pending,dibayar'],
            'tanggal_dibayar' => ['nullable', 'date'],
        ]);
        $item = Penghasilan_driver::create($data);

        return redirect()->route('admin.penghasilan.show', $item);
    }

    public function show(Penghasilan_driver $penghasilan_driver)
    {
        $penghasilan_driver->load(['driver', 'jadwal']);

        return view('admin.penghasilan.show', ['item' => $penghasilan_driver]);
    }

    public function edit(Penghasilan_driver $penghasilan_driver)
    {
        $penghasilan_driver->load(['driver', 'jadwal']);

        return view('admin.penghasilan.edit', ['item' => $penghasilan_driver]);
    }

    public function update(Request $request, Penghasilan_driver $penghasilan_driver)
    {
        $data = $request->validate([
            'driver_id' => ['required', 'integer', 'exists:drivers,id'],
            'jadwal_id' => ['required', 'integer', 'exists:jadwal_antar_jemput,id'],
            'tarif_per_trip' => ['required', 'numeric'],
            'komisi_pengemudi' => ['required', 'numeric'],
            'status' => ['required', 'in:pending,dibayar'],
            'tanggal_dibayar' => ['nullable', 'date'],
        ]);
        $penghasilan_driver->update($data);

        return redirect()->route('admin.penghasilan.show', $penghasilan_driver);
    }

    public function destroy(Penghasilan_driver $penghasilan_driver)
    {
        $penghasilan_driver->delete();

        return redirect()->route('admin.penghasilan.index');
    }
}
