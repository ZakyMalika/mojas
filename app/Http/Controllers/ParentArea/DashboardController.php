<?php

namespace App\Http\Controllers\ParentArea;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('parent.parent');
    }
}
