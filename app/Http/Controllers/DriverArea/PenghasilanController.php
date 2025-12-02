<?php

namespace App\Http\Controllers\DriverArea;

use App\Http\Controllers\Controller;
use App\Models\Penghasilan_driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghasilanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        $items = Penghasilan_driver::with(['driver', 'jadwal'])
            ->where('driver_id', $driver->id)
            ->paginate($perPage)->appends($request->query());

        return view('driver.penghasilan.index', compact('items'));
    }

    public function create()
    {
        return view('driver.penghasilan.create');
    }

    public function store(Request $request)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        $data = $request->validate([
            'jadwal_id' => ['required', 'integer', 'exists:jadwal_antar_jemput,id'],
            'tarif_per_trip' => ['required', 'numeric'],
            'komisi_pengemudi' => ['nullable', 'numeric'],
            'gross_amount' => ['nullable', 'numeric'],
            'deduction_percentage' => ['nullable', 'numeric', 'in:0,5,10'],
            'status' => ['required', 'in:pending,dibayar'],
            'tanggal_dibayar' => ['nullable', 'date'],
        ]);
        $data['driver_id'] = $driver->id;

        if (isset($data['gross_amount'])) {
            $gross = (float) $data['gross_amount'];
            $deduction = isset($data['deduction_percentage']) ? (float) $data['deduction_percentage'] : 0;
            $net = $gross - ($gross * ($deduction / 100));
            $data['komisi_pengemudi'] = round($net, 2);
        }

        if (! isset($data['komisi_pengemudi'])) {
            $data['komisi_pengemudi'] = 0;
        }

        // Remove transient fields that are not stored in the table
        unset($data['gross_amount'], $data['deduction_percentage']);

        $item = Penghasilan_driver::create($data);

        return redirect()->route('driver.penghasilan.show', $item);
    }

    public function show(Penghasilan_driver $penghasilan)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($penghasilan->driver_id !== $driver->id, 403);
        $penghasilan->load(['driver', 'jadwal']);

        return view('driver.penghasilan.show', ['item' => $penghasilan]);
    }

    public function edit(Penghasilan_driver $penghasilan)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($penghasilan->driver_id !== $driver->id, 403);
        $penghasilan->load(['driver', 'jadwal']);

        return view('driver.penghasilan.edit', ['item' => $penghasilan]);
    }

    public function update(Request $request, Penghasilan_driver $penghasilan)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($penghasilan->driver_id !== $driver->id, 403);
        $data = $request->validate([
            'jadwal_id' => ['required', 'integer', 'exists:jadwal_antar_jemput,id'],
            'tarif_per_trip' => ['required', 'numeric'],
            'komisi_pengemudi' => ['nullable', 'numeric'],
            'gross_amount' => ['nullable', 'numeric'],
            'deduction_percentage' => ['nullable', 'numeric', 'in:0,5,10'],
            'status' => ['required', 'in:pending,dibayar'],
            'tanggal_dibayar' => ['nullable', 'date'],
        ]);
        $data['driver_id'] = $driver->id;

        if (isset($data['gross_amount'])) {
            $gross = (float) $data['gross_amount'];
            $deduction = isset($data['deduction_percentage']) ? (float) $data['deduction_percentage'] : 0;
            $net = $gross - ($gross * ($deduction / 100));
            $data['komisi_pengemudi'] = round($net, 2);
        }

        if (! isset($data['komisi_pengemudi'])) {
            $data['komisi_pengemudi'] = $penghasilan->komisi_pengemudi ?? 0;
        }

        // Remove transient fields before update
        unset($data['gross_amount'], $data['deduction_percentage']);

        $penghasilan->update($data);

        return redirect()->route('driver.penghasilan.show', $penghasilan);
    }

    public function destroy(Penghasilan_driver $penghasilan)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($penghasilan->driver_id !== $driver->id, 403);
        $penghasilan->delete();

        return redirect()->route('driver.penghasilan.index');
    }
}
