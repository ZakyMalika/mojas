<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_antar_jemput;
use Illuminate\Http\Request;

class JadwalAntarJemputController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Jadwal_antar_jemput::with(['anak', 'driver'])->paginate($perPage)->appends($request->query());

        return view('admin.jadwal.index', compact('items'));
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anak_id' => ['required', 'integer', 'exists:anak,id'],
            'drivers_id' => ['required', 'integer', 'exists:drivers,id'],
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
        $item = Jadwal_antar_jemput::create($data);

        return redirect()->route('admin.jadwal.show', $item);
    }

    public function show(Jadwal_antar_jemput $jadwal)
    {
        $jadwal->load(['anak', 'driver']);

        return view('admin.jadwal.show', ['item' => $jadwal]);
    }

    public function edit(Jadwal_antar_jemput $jadwal)
    {
        $jadwal->load(['anak', 'driver']);

        return view('admin.jadwal.edit', ['item' => $jadwal]);
    }

    public function update(Request $request, Jadwal_antar_jemput $jadwal)
    {
        $data = $request->validate([
            'anak_id' => ['required', 'integer', 'exists:anak,id'],
            'drivers_id' => ['required', 'integer', 'exists:drivers,id'],
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
        $jadwal->update($data);

        return redirect()->route('admin.jadwal.show', $jadwal);
    }

    public function destroy(Jadwal_antar_jemput $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index');
    }
}
