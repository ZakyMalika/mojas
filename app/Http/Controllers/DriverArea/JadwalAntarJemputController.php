<?php

namespace App\Http\Controllers\DriverArea;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_antar_jemput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalAntarJemputController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        $items = Jadwal_antar_jemput::with(['anak', 'driver'])
            ->where('drivers_id', $driver->id)
            ->paginate($perPage)->appends($request->query());

        return view('driver.jadwal.index', compact('items'));
    }

    public function create()
    {
        return view('driver.jadwal.create');
    }

    public function store(Request $request)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        $data = $request->validate([
            'anak_id' => ['required', 'integer', 'exists:anak,id'],
            'tanggal' => ['required', 'date'],
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'jam_jemput' => ['required', 'date_format:H:i:s'],
            'jam_antar' => ['required', 'date_format:H:i:s'],
            'lokasi_jemput' => ['nullable', 'string'],
            'lokasi_antar' => ['nullable', 'string'],
            'status' => ['required', 'in:menunggu,dijemput,perjalanan,selesai,dibatalkan'],
            'catatan' => ['nullable', 'string'],
            'diambil_pengemudi' => ['nullable', 'date'],
        ]);
        $data['drivers_id'] = $driver->id;
        $item = Jadwal_antar_jemput::create($data);

        return redirect()->route('driver.jadwal.show', $item);
    }

    public function show(Jadwal_antar_jemput $jadwal)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($jadwal->drivers_id !== $driver->id, 403);
        $jadwal->load(['anak', 'driver']);

        return view('driver.jadwal.show', ['item' => $jadwal]);
    }

    public function edit(Jadwal_antar_jemput $jadwal)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($jadwal->drivers_id !== $driver->id, 403);
        $jadwal->load(['anak', 'driver']);

        return view('driver.jadwal.edit', ['item' => $jadwal]);
    }

    public function update(Request $request, Jadwal_antar_jemput $jadwal)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($jadwal->drivers_id !== $driver->id, 403);
        $data = $request->validate([
            // 'anak_id' => ['required', 'integer', 'exists:anak,id'],
            // 'tanggal' => ['required', 'date'],
            // 'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            // 'jam_jemput' => ['required', 'date_format:H:i:s'],
            // 'jam_antar' => ['required', 'date_format:H:i:s'],
            // 'lokasi_jemput' => ['nullable', 'string'],
            // 'lokasi_antar' => ['nullable', 'string'],
            'status' => ['required', 'in:menunggu,dijemput,perjalanan,selesai,dibatalkan'],
            'catatan' => ['nullable', 'string'],
            'diambil_pengemudi' => ['nullable', 'date'],
        ]);
        // drivers_id tetap milik driver login
        $data['drivers_id'] = $driver->id;
        $jadwal->update($data);

        return redirect()->route('driver.jadwal.show', $jadwal);
    }

    public function destroy(Jadwal_antar_jemput $jadwal)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($jadwal->drivers_id !== $driver->id, 403);
        $jadwal->delete();

        return redirect()->route('driver.jadwal.index');
    }
}
