<?php

namespace App\Http\Controllers\ParentArea;

use Illuminate\Http\Request;
use App\Models\Jadwal_antar_jemput;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        $jadwal = Jadwal_antar_jemput::whereHas('anak', function ($query) use ($parent) {
            $query->where('orang_tua_id', $parent->id);
        })->with(['anak', 'driver.user'])->get();
        
        return view('parent.jadwal.index', compact('jadwal'));
    }

    public function show(Jadwal_antar_jemput $jadwal)
    {
        $parent = Auth::user()->orangTua;
        abort_if(! $parent, 403);
        abort_if($jadwal->anak->orang_tua_id !== $parent->id, 403);
        $jadwal->load(['anak', 'driver.user']);
        return view('parent.jadwal.show', compact('jadwal'));
    }

    // public function edit(Jadwal_antar_jemput $jadwal)
    // {
    //     abort_if($jadwal->anak->orang_tua_id !== auth()->user()->id, 403);
    //     $jadwal->load(['anak', 'driver.user']);
    //     return view('parent.jadwal.edit', ['item' => $jadwal]);
    // }

    // public function update(Request $request, Jadwal_antar_jemput $jadwal)
    // {
    //     abort_if($jadwal->anak->orang_tua_id !== auth()->user()->id, 403);
    //     $data = $request->validate([
    //         'tanggal' => ['required', 'date'],
    //         'jam_jemput' => ['required'],
    //         'status' => ['required', 'in:pending,completed,cancelled'],
    //         'catatan' => ['nullable', 'string'],
    //     ]);
    //     $jadwal->update($data);

    //     return redirect()->route('parent.jadwal.show', $jadwal);
    // }

    // public function destroy(Jadwal_antar_jemput $jadwal)
    // {
    //     abort_if($jadwal->anak->orang_tua_id !== auth()->user()->id, 403);
    //     $jadwal->delete();

    //     return redirect()->route('parent.jadwal.index');
    // }
}
