<?php

use App\Models\Driver;
use App\Models\School;
use App\Models\RentalService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\RentalServiceController;
use App\Http\Controllers\ParentArea\JadwalController;
use App\Http\Controllers\Admin\AnakController as AdminAnakController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\DriverArea\DashboardController as DriverDashboard;
use App\Http\Controllers\ParentArea\AnakController as ParentAnakController;
use App\Http\Controllers\ParentArea\DashboardController as ParentDashboard;
use App\Http\Controllers\Admin\OrangTuaController as AdminOrangTuaController;
use App\Http\Controllers\Admin\LogJadwalController as AdminLogJadwalController;
// New Controllers
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\TarifJarakController as AdminTarifJarakController;
use App\Http\Controllers\DriverArea\LogJadwalController as DriverLogJadwalController;
use App\Http\Controllers\DriverArea\PenghasilanController as DriverPenghasilanController;
use App\Http\Controllers\Admin\PendaftaranAnakController as AdminPendaftaranAnakController;
use App\Http\Controllers\Admin\JadwalAntarJemputController as AdminJadwalAntarJemputController;
use App\Http\Controllers\Admin\PenghasilanDriverController as AdminPenghasilanDriverController;
use App\Http\Controllers\ParentArea\PendaftaranAnakController as ParentPendaftaranAnakController;
use App\Http\Controllers\DriverArea\JadwalAntarJemputController as DriverJadwalAntarJemputController;

// Halaman utama
Route::get('/', [ReviewController::class, 'home'])->name('home');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/api/reviews', [ReviewController::class, 'getReviews'])->name('api.reviews');
Route::get('/api/reviews/stats', [ReviewController::class, 'getStats'])->name('api.reviews.stats');

// Profile routes (untuk user yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/kegiatan', function () {
    return view('frontend.kegiatan');
});
Route::get('/rental', function () {
    return view('frontend.rental');
});
Route::get('/armada', function () {
    return view('frontend.armada');
});
Route::get('/sekolah', function () {
    return view('frontend.sekolah');
});

Route::get('/admin', [AdminDashboard::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.dashboard');
Route::get('/parent', [ParentDashboard::class, 'index'])->middleware(['auth', 'role:orang_tua'])->name('parent.dashboard');
Route::get('/driver', [DriverDashboard::class, 'index'])->middleware(['auth', 'role:pengemudi'])->name('driver.dashboard');

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
    Route::resource('orang_tua', AdminOrangTuaController::class);
    Route::resource('anak', AdminAnakController::class);
    Route::resource('drivers', AdminDriverController::class);
    Route::resource('tarif-jarak', AdminTarifJarakController::class);
    Route::resource('pendaftaran-anak', AdminPendaftaranAnakController::class);
    Route::resource('pembayaran', AdminPembayaranController::class);
    Route::resource('jadwal', AdminJadwalAntarJemputController::class);
    Route::resource('log-jadwal', AdminLogJadwalController::class);
    Route::resource('penghasilan', AdminPenghasilanDriverController::class);
    Route::resource('users', UserController::class);

    // New Resources for Transportation Management
    Route::resource('schools', SchoolController::class);
    Route::resource('rental-services', RentalServiceController::class);
    Route::resource('bookings', BookingController::class);

    // Pricing Management Routes
    Route::get('pricing/calculator', [PricingController::class, 'calculator'])->name('pricing.calculator');
    Route::post('pricing/quote', [PricingController::class, 'getQuote'])->name('pricing.quote');
    Route::get('pricing/tariffs', [PricingController::class, 'tariffs'])->name('pricing.tariffs');
    Route::get('pricing/tiers', [PricingController::class, 'tiers'])->name('pricing.tiers');
    Route::get('pricing/rules', [PricingController::class, 'rules'])->name('pricing.rules');

    // AJAX routes
    Route::get('penghasilan/jadwal-by-anak/{anak}', [AdminPenghasilanDriverController::class, 'getJadwalByAnak'])->name('penghasilan.getJadwalByAnak');

    // Test route for debugging
    Route::get('test-jadwal/{anak_id}', function ($anak_id) {
        $jadwals = \App\Models\Jadwal_antar_jemput::where('anak_id', $anak_id)
            ->get()
            ->map(function ($jadwal) {
                return [
                    'id' => $jadwal->id,
                    'tanggal' => $jadwal->tanggal,
                    'jam_jemput' => $jadwal->jam_jemput,
                    'status' => $jadwal->status,
                    'anak_id' => $jadwal->anak_id,
                ];
            });

        return response()->json([
            'success' => true,
            'anak_id' => (int) $anak_id,
            'count' => $jadwals->count(),
            'jadwals' => $jadwals,
        ]);
    })->name('test.jadwal');
});

// PARENT (orang tua)
Route::middleware(['auth', 'role:orang_tua'])->prefix('parent')->as('parent.')->group(function () {
    Route::resource('anak', ParentAnakController::class);
    Route::resource('pendaftaran-anak', ParentPendaftaranAnakController::class);
    Route::resource('jadwal', JadwalController::class);
});

// DRIVER (pengemudi)
Route::middleware(['auth', 'role:pengemudi'])->prefix('driver')->as('driver.')->group(function () {
    Route::resource('jadwal', DriverJadwalAntarJemputController::class);
    Route::resource('log-jadwal', DriverLogJadwalController::class);
    Route::resource('penghasilan', DriverPenghasilanController::class);
});

Route::get('/driver-profile', function () {
    return view('frontend.profile',
        ['driver' => Driver::with('user')
            ->latest()->simplePaginate(9)]);
});

Route::get('/rent-services', function () {
    return view('frontend.rent',
        ['rental_services' => RentalService::latest()->simplePaginate(9)]);
});

Route::get('/partners', function () {
    return view('frontend.partners',
        ['partners' => School::latest()->simplePaginate(9)]);
});
