<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Driver;
use App\Models\Jadwal_antar_jemput;
use App\Models\Penghasilan_driver;
use Illuminate\Http\Request;

class PenghasilanDriverController extends Controller
{
    public function index(Request $request)
    {
        $query = Penghasilan_driver::with(['driver', 'jadwal']);
        
        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('status', 'like', "%{$search}%")
                  ->orWhereHas('driver.user', function($subQuery) use ($search) {
                      $subQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('jadwal.anak', function($subQuery) use ($search) {
                      $subQuery->where('nama', 'like', "%{$search}%");
                  });
            });
        }
        
        $items = $query->latest()->paginate(15)->withQueryString();

        return view('admin.penghasilan.index', compact('items'));
    }

    public function create()
    {
        $drivers = Driver::with('user')->get();
        $anaks = Anak::all();

        return view('admin.penghasilan.create', compact('drivers', 'anaks'));
    }

    /**
     * Get jadwal by anak (AJAX)
     */
    public function getJadwalByAnak(Anak $anak)
    {

        $jadwals = Jadwal_antar_jemput::where('anak_id', $anak->id)
            ->with(['anak', 'driver.user'])
            ->get()
            ->map(function ($jadwal) {
                return [
                    'id' => $jadwal->id,
                    'tanggal' => $jadwal->tanggal,
                    'jam_jemput' => $jadwal->jam_jemput,
                    'status' => $jadwal->status,
                    'anak_nama' => $jadwal->anak->nama ?? 'Unknown',
                ];
            });

        return response()->json([
            'success' => true,
            'jadwals' => $jadwals,
            'count' => $jadwals->count(),
        ]);
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

    public function show($id)
    {
        $penghasilan_driver = Penghasilan_driver::with(['driver.user', 'jadwal.anak'])->findOrFail($id);

        $editUrl = url('admin/penghasilan/'.$penghasilan_driver->id.'/edit');

        return view('admin.penghasilan.show', [
            'item' => $penghasilan_driver,
            'editUrl' => $editUrl,
        ]);
    }

    public function edit($id)
    {
        $penghasilan_driver = Penghasilan_driver::with(['driver.user', 'jadwal.anak'])->findOrFail($id);

        return view('admin.penghasilan.edit', ['item' => $penghasilan_driver]);
    }

    public function update(Request $request, $id)
    {
        $penghasilan_driver = Penghasilan_driver::findOrFail($id);

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

    public function destroy($id)
    {
        $penghasilan_driver = Penghasilan_driver::findOrFail($id);
        $penghasilan_driver->delete();

        return redirect()->route('admin.penghasilan.index');
    }
}
