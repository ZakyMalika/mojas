<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;

// Halaman utama
Route::get('/', function () {
    return view('frontend.home');
});

// Routes untuk role-specific pages (perlu login dan role sesuai)
Route::get('/admin', function () {
    return view('admin.admin');
})->middleware(['auth', 'role:admin']);

Route::get('/parent', function () {
    return view('parent.parent');
})->middleware(['auth', 'role:orang_tua']);

Route::get('/driver', function () {
    return view('driver.driver');
})->middleware(['auth', 'role:pengemudi']);

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