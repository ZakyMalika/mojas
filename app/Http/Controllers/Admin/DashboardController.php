<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Driver;
use App\Models\Orang_tua;
use App\Models\Pembayaran;
use App\Models\Pendaftaran_anak;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userRoleData = Auth::user()->role;
        $totalParents = Orang_tua::count();
        $totalDrivers = Driver::count();
        $totalAnaks = Anak::count();
        $pendaftaran7Hari = Pendaftaran_anak::where('created_at', '>=', now()->subDays(7))->count();
        $pendaftaranTerbaru = Pendaftaran_anak::with('anak')->latest()->limit(5)->get();
        $pembayaranTerbaru = Pembayaran::with('pendaftaran_anak.anak')->latest()->limit(5)->get();

        return view('admin.admin', compact('totalParents', 'totalDrivers', 'totalAnaks', 'pendaftaran7Hari', 'pendaftaranTerbaru', 'pembayaranTerbaru', 'userRoleData'));
    }
}
