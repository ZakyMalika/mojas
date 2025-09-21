<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log_Jadwal;
use Illuminate\Http\Request;

class LogJadwalController extends Controller
{
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $items = Log_Jadwal::with(['jadwal', 'driver'])->paginate($perPage)->appends($request->query());

        return view('admin.log_jadwal.index', compact('items'));
    }

    public function create()
    {
        return view('admin.log_jadwal.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jadwal_id' => ['required', 'integer', 'exists:jadwal_antar_jemput,id'],
            'driver_id' => ['required', 'integer', 'exists:drivers,id'],
            'status_lama' => ['required', 'in:menunggu,dijemput,diantar,selesai,batal'],
            'status_baru' => ['required', 'in:menunggu,dijemput,diantar,selesai,batal'],
            'keterangan' => ['nullable', 'string'],
        ]);
        $item = Log_Jadwal::create($data);

        return redirect()->route('admin.log-jadwal.show', $item);
    }

    public function show(Log_Jadwal $log_jadwal)
    {
        $log_jadwal->load(['jadwal', 'driver']);

        return view('admin.log_jadwal.show', ['item' => $log_jadwal]);
    }

    public function edit(Log_Jadwal $log_jadwal)
    {
        $log_jadwal->load(['jadwal', 'driver']);

        return view('admin.log_jadwal.edit', ['item' => $log_jadwal]);
    }

    public function update(Request $request, Log_Jadwal $log_jadwal)
    {
        $data = $request->validate([
            'jadwal_id' => ['required', 'integer', 'exists:jadwal_antar_jemput,id'],
            'driver_id' => ['required', 'integer', 'exists:drivers,id'],
            'status_lama' => ['required', 'in:menunggu,dijemput,diantar,selesai,batal'],
            'status_baru' => ['required', 'in:menunggu,dijemput,diantar,selesai,batal'],
            'keterangan' => ['nullable', 'string'],
        ]);
        $log_jadwal->update($data);

        return redirect()->route('admin.log-jadwal.show', $log_jadwal);
    }

    public function destroy(Log_Jadwal $log_jadwal)
    {
        $log_jadwal->delete();

        return redirect()->route('admin.log-jadwal.index');
    }
}
