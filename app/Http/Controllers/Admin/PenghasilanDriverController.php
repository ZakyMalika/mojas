<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Driver;
use App\Models\Jadwal_antar_jemput;
use App\Models\Penghasilan_driver;
use App\Exports\PenghasilanDriverExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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
        
        // Tentukan jumlah item per halaman
        $perPage = $request->get('per_page', 15);
        if ($perPage == 'all') {
            $items = $query->latest()->get();
        } else {
            $items = $query->latest()->paginate((int)$perPage)->withQueryString();
        }

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
            // komisi_pengemudi may be computed from gross_amount + deduction
            'komisi_pengemudi' => ['nullable', 'numeric'],
            'gross_amount' => ['nullable', 'numeric'],
            'deduction_percentage' => ['nullable', 'numeric', 'in:0,5,10'],
            'status' => ['required', 'in:pending,dibayar'],
            'tanggal_dibayar' => ['nullable', 'date'],
        ]);

        // Jika gross_amount diberikan, hitung komisi_pengemudi berdasarkan potongan
        if (isset($data['gross_amount'])) {
            $gross = (float) $data['gross_amount'];
            $deduction = isset($data['deduction_percentage']) ? (float) $data['deduction_percentage'] : 0;
            $net = $gross - ($gross * ($deduction / 100));
            $data['komisi_pengemudi'] = round($net, 2);
        }

        // Pastikan komisi_pengemudi ada (fallback)
        if (! isset($data['komisi_pengemudi'])) {
            $data['komisi_pengemudi'] = 0;
        }

        // Remove transient fields that are not columns in the table
        unset($data['gross_amount'], $data['deduction_percentage']);

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
            'komisi_pengemudi' => ['nullable', 'numeric'],
            'gross_amount' => ['nullable', 'numeric'],
            'deduction_percentage' => ['nullable', 'numeric', 'in:0,5,10'],
            'status' => ['required', 'in:pending,dibayar'],
            'tanggal_dibayar' => ['nullable', 'date'],
        ]);

        if (isset($data['gross_amount'])) {
            $gross = (float) $data['gross_amount'];
            $deduction = isset($data['deduction_percentage']) ? (float) $data['deduction_percentage'] : 0;
            $net = $gross - ($gross * ($deduction / 100));
            $data['komisi_pengemudi'] = round($net, 2);
        }

        if (! isset($data['komisi_pengemudi'])) {
            $data['komisi_pengemudi'] = $penghasilan_driver->komisi_pengemudi ?? 0;
        }

        // Remove transient fields before update
        unset($data['gross_amount'], $data['deduction_percentage']);

        $penghasilan_driver->update($data);

        return redirect()->route('admin.penghasilan.show', $penghasilan_driver);
    }

    public function destroy($id)
    {
        $penghasilan_driver = Penghasilan_driver::findOrFail($id);
        $penghasilan_driver->delete();

        return redirect()->route('admin.penghasilan.index');
    }

    public function exportExcel(Request $request)
    {
        $search = $request->get('search');
        $timestamp = now()->format('d-m-Y_H-i-s');
        return Excel::download(new PenghasilanDriverExport($search), "penghasilan_$timestamp.xlsx");
    }

    public function exportPdfAll(Request $request)
    {
        $query = Penghasilan_driver::with(['driver.user', 'jadwal.anak']);
        
        if ($request->has('search') && !empty($request->search)) {
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

        $allItems = $query->latest()->get();
        
        $timestamp = now()->format('d-m-Y_H-i-s');
        $totalCount = $allItems->count();
        
        $pdf = Pdf::loadView('admin.penghasilan.export-pdf', [
            'items' => $allItems,
            'isAllData' => true,
            'totalCount' => $totalCount
        ]);
        
        return $pdf->download("Penghasilan_Lengkap_$timestamp.pdf");
    }

    public function exportPdfCurrent(Request $request)
    {
        $query = Penghasilan_driver::with(['driver.user', 'jadwal.anak']);
        
        if ($request->has('search') && !empty($request->search)) {
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

        $perPage = $request->get('per_page', 15);
        
        if ($perPage == 'all') {
            $items = $query->latest()->get();
            $timestamp = now()->format('d-m-Y_H-i-s');
            
            $pdf = Pdf::loadView('admin.penghasilan.export-pdf', [
                'items' => $items,
                'isAllData' => true,
                'totalCount' => count($items)
            ]);
            
            return $pdf->download("Penghasilan_Semua_$timestamp.pdf");
        } else {
            $perPage = (int)$perPage;
            $currentPage = $request->get('page', 1);
            $items = $query->latest()->paginate($perPage, ['*'], 'page', $currentPage);
            
            $timestamp = now()->format('d-m-Y_H-i-s');
            
            $pdf = Pdf::loadView('admin.penghasilan.export-pdf', [
                'items' => $items,
                'isAllData' => false,
                'isCurrentPage' => true
            ]);
            
            return $pdf->download("Penghasilan_Halaman_$timestamp.pdf");
        }
    }
}
