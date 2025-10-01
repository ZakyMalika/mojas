<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Driver;
use App\Models\Orang_tua;
use App\Models\Pembayaran;
use App\Models\Pendaftaran_anak;

class DashboardController extends Controller
{
    public function index()
    {
        $totalParents = Orang_tua::count();
        $totalDrivers = Driver::count();
        $totalAnaks = Anak::count();
        $pendaftaranTerbaru = Pendaftaran_anak::with('anak')->latest()->limit(5)->get();
        $pembayaranTerbaru = Pembayaran::with('pendaftaran_anak.anak')->latest()->limit(5)->get();

        return view('admin.admin', compact('totalParents', 'totalDrivers', 'totalAnaks', 'pendaftaranTerbaru', 'pembayaranTerbaru'));
    }
}
