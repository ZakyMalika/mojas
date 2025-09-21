<?php

namespace App\Http\Controllers\DriverArea;

use App\Http\Controllers\Controller;
use App\Models\Log_Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogJadwalController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        $items = Log_Jadwal::with(['jadwal', 'driver'])
            ->where('driver_id', $driver->id)
            ->paginate($perPage)->appends($request->query());

        return view('driver.log_jadwal.index', compact('items'));
    }

    public function create()
    {
        return view('driver.log_jadwal.create');
    }

    public function store(Request $request)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        $data = $request->validate([
            'jadwal_id' => ['required', 'integer', 'exists:jadwal_antar_jemput,id'],
            'status_lama' => ['required', 'in:menunggu,dijemput,diantar,selesai,batal'],
            'status_baru' => ['required', 'in:menunggu,dijemput,diantar,selesai,batal'],
            'keterangan' => ['nullable', 'string'],
        ]);
        $data['driver_id'] = $driver->id;
        $item = Log_Jadwal::create($data);

        return redirect()->route('driver.log-jadwal.show', $item);
    }

    public function show(Log_Jadwal $log_jadwal)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($log_jadwal->driver_id !== $driver->id, 403);
        $log_jadwal->load(['jadwal', 'driver']);

        return view('driver.log_jadwal.show', ['item' => $log_jadwal]);
    }

    public function edit(Log_Jadwal $log_jadwal)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($log_jadwal->driver_id !== $driver->id, 403);
        $log_jadwal->load(['jadwal', 'driver']);

        return view('driver.log_jadwal.edit', ['item' => $log_jadwal]);
    }

    public function update(Request $request, Log_Jadwal $log_jadwal)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($log_jadwal->driver_id !== $driver->id, 403);
        $data = $request->validate([
            'jadwal_id' => ['required', 'integer', 'exists:jadwal_antar_jemput,id'],
            'status_lama' => ['required', 'in:menunggu,dijemput,diantar,selesai,batal'],
            'status_baru' => ['required', 'in:menunggu,dijemput,diantar,selesai,batal'],
            'keterangan' => ['nullable', 'string'],
        ]);
        $data['driver_id'] = $driver->id;
        $log_jadwal->update($data);

        return redirect()->route('driver.log-jadwal.show', $log_jadwal);
    }

    public function destroy(Log_Jadwal $log_jadwal)
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        abort_if($log_jadwal->driver_id !== $driver->id, 403);
        $log_jadwal->delete();

        return redirect()->route('driver.log-jadwal.index');
    }
}
