<?php

namespace App\Http\Controllers\DriverArea;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('driver.driver');
    }
}
