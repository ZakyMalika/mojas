<?php

use App\Http\Controllers\Admin\AnakController as AdminAnakController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\Admin\JadwalAntarJemputController as AdminJadwalAntarJemputController;
use App\Http\Controllers\Admin\LogJadwalController as AdminLogJadwalController;
use App\Http\Controllers\Admin\OrangTuaController as AdminOrangTuaController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\PendaftaranAnakController as AdminPendaftaranAnakController;
use App\Http\Controllers\Admin\PenghasilanDriverController as AdminPenghasilanDriverController;
use App\Http\Controllers\Admin\TarifJarakController as AdminTarifJarakController;
use App\Http\Controllers\DriverArea\DashboardController as DriverDashboard;
use App\Http\Controllers\DriverArea\JadwalAntarJemputController as DriverJadwalAntarJemputController;
use App\Http\Controllers\DriverArea\LogJadwalController as DriverLogJadwalController;
use App\Http\Controllers\DriverArea\PenghasilanController as DriverPenghasilanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParentArea\AnakController as ParentAnakController;
use App\Http\Controllers\ParentArea\DashboardController as ParentDashboard;
use App\Http\Controllers\ParentArea\PembayaranController as ParentPembayaranController;
use App\Http\Controllers\ParentArea\PendaftaranAnakController as ParentPendaftaranAnakController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/admin', [AdminDashboard::class, 'index'])->middleware(['auth', 'role:admin']);
Route::get('/parent', [ParentDashboard::class, 'index'])->middleware(['auth', 'role:orang_tua']);
Route::get('/driver', [DriverDashboard::class, 'index'])->middleware(['auth', 'role:pengemudi']);

// Routes untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    // AJAX validation routes
    Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('check.username');
    Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');
    Route::post('/check-phone', [RegisterController::class, 'checkPhone'])->name('check.phone');
});

// Route untuk logout (perlu login)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::resource('orang-tua', AdminOrangTuaController::class);
    Route::resource('anak', AdminAnakController::class);
    Route::resource('drivers', AdminDriverController::class);
    Route::resource('tarif-jarak', AdminTarifJarakController::class);
    Route::resource('pendaftaran-anak', AdminPendaftaranAnakController::class);
    Route::resource('pembayaran', AdminPembayaranController::class);
    Route::resource('jadwal', AdminJadwalAntarJemputController::class);
    Route::resource('log-jadwal', AdminLogJadwalController::class);
    Route::resource('penghasilan', AdminPenghasilanDriverController::class);
});

// PARENT (orang tua)
Route::middleware(['auth', 'role:orang_tua'])->prefix('parent')->as('parent.')->group(function () {
    Route::resource('anak', ParentAnakController::class);
    Route::resource('pendaftaran-anak', ParentPendaftaranAnakController::class);
    Route::resource('pembayaran', ParentPembayaranController::class);
});

// DRIVER (pengemudi)
Route::middleware(['auth', 'role:pengemudi'])->prefix('driver')->as('driver.')->group(function () {
    Route::resource('jadwal', DriverJadwalAntarJemputController::class);
    Route::resource('log-jadwal', DriverLogJadwalController::class);
    Route::resource('penghasilan', DriverPenghasilanController::class);
});
