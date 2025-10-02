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
        
        // Ambil penghasilan bulan ini untuk driver yang sedang login
        $penghasilanBulanIni = $driver->penghasilan_driver()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('komisi_pengemudi');

        return view('driver.driver', compact('jadwalHariIni', 'driver', 'penghasilanBulanIni'));
    }
}
