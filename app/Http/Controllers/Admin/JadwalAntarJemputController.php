<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_antar_jemput;
use Illuminate\Http\Request;

class JadwalAntarJemputController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal_antar_jemput::with(['anak', 'driver']);
        
        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('hari', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('lokasi_jemput', 'like', "%{$search}%")
                  ->orWhere('lokasi_antar', 'like', "%{$search}%")
                  ->orWhereHas('anak', function($subQuery) use ($search) {
                      $subQuery->where('nama', 'like', "%{$search}%");
                  })
                  ->orWhereHas('driver.user', function($subQuery) use ($search) {
                      $subQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $items = $query->latest()->paginate(15)->withQueryString();

        return view('admin.jadwal.index', compact('items'));
    }

    public function create()
    {
        $anakList = \App\Models\Anak::all();
        $driverList = \App\Models\Driver::with('user')->get();
        $jadwals = Jadwal_antar_jemput::with(['anak', 'driver'])->get();

        return view('admin.jadwal.create', ['items' => $jadwals, 'anakList' => $anakList, 'driverList' => $driverList]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anak_id' => ['required', 'integer', 'exists:anak,id'],
            'drivers_id' => ['required', 'integer', 'exists:drivers,id'],
            'tanggal' => ['required', 'date'],
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'jam_jemput' => ['required', 'date_format:H:i'],
            'jam_antar' => ['required', 'date_format:H:i'],
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
        $drivers = \App\Models\Driver::with('user')->get();

        return view('admin.jadwal.edit', ['item' => $jadwal, 'drivers' => $drivers]);
    }

    public function update(Request $request, Jadwal_antar_jemput $jadwal)
    {
        $data = $request->validate([
            'anak_id' => ['required', 'integer', 'exists:anak,id'],
            'drivers_id' => ['required', 'integer', 'exists:drivers,id'],
            'tanggal' => ['required', 'date'],
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'jam_jemput' => ['required', 'date_format:H:i'],
            'jam_antar' => ['required', 'date_format:H:i'],
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
