<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Driver::with(['user', 'jadwal_antar_jemput', 'penghasilan_driver'])
            ->paginate($perPage)->appends($request->query());

        return view('admin.drivers.show', compact('items')); // Menggunakan show.blade.php untuk list
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'nomor_plat' => ['required', 'string', 'max:255', 'unique:drivers,nomor_plat'],
            'jenis_kendaraan' => ['nullable', 'string', 'max:255'],
            'warna_kendaraan' => ['nullable', 'string', 'max:255'],
        ]);
        $item = Driver::create($data);

        return redirect()->route('admin.drivers.show', $item);
    }

    public function show(Driver $driver)
    {
        $driver->load(['user', 'jadwal_antar_jemput', 'penghasilan_driver']);

        return view('admin.drivers.index', ['item' => $driver]); // Menggunakan index.blade.php untuk detail
    }

    public function edit(Driver $driver)
    {
        $driver->load(['user']);

        return view('admin.drivers.edit', ['item' => $driver]);
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'nomor_plat' => ['required', 'string', 'max:255', Rule::unique('drivers', 'nomor_plat')->ignore($driver->id)],
            'jenis_kendaraan' => ['nullable', 'string', 'max:255'],
            'warna_kendaraan' => ['nullable', 'string', 'max:255'],
        ]);
        $driver->update($data);

        return redirect()->route('admin.drivers.show', $driver);
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('admin.drivers.index');
    }
}
