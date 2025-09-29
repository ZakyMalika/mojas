<?php

namespace App\Http\Controllers\DriverArea;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $driver = Auth::user()->driver;
        abort_if(! $driver, 403);
        $jadwalHariIni = $driver->jadwal_antar_jemput()->whereDate('tanggal', today())->get();
        $penghasilanBulanIni = $driver->penghasilan_driver ? $driver->penghasilan_driver->whereMonth('created_at', now()->month)->sum('komisi_pengemudi') : 0;
        return view('driver.driver', compact('jadwalHariIni', 'driver', 'penghasilanBulanIni'));
    }
}
