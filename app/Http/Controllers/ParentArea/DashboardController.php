<?php

namespace App\Http\Controllers\ParentArea;

use App\Models\Anak;
use App\Http\Controllers\Controller;
use App\Models\Pendaftaran_anak;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $parent = Auth::user()->orangTua;
        $anakCount = Anak::with('orangTua')->where('orang_tua_id', $parent->id)->count();
        $pendaftaranAktifCount = Pendaftaran_anak::whereHas('anak', function ($query) use ($parent) {
            $query->where('orang_tua_id', $parent->id);
        })->count();
        return view('parent.parent', compact('anakCount', 'pendaftaranAktifCount'));
    }
}
