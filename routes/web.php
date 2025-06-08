<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\Auth\VerificationController; // Untuk verifikasi email
// use App\Http\Controllers\Admin\AdminManagementController; // Gunakan jika Anda buat controller ini

// --- Public Routes (Tidak memerlukan autentikasi) ---
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman Statis
Route::view('/tentang-kami', 'about')->name('about');
Route::view('/layanan', 'layanan.index')->name('layanan');
Route::view('/kontak', 'contact')->name('contact');
Route::view('/legalitas', 'legalitas')->name('legalitas');
Route::view('/program', 'program')->name('program');
Route::view('/aktivitas', 'aktivitas')->name('aktivitas');
Route::view('/bersedekah', 'bersedekah')->name('bersedekah');

// Program Donasi (View Halaman Spesifik)
Route::view('/program/duafa', 'programs.duafa')->name('program.duafa');
Route::view('/program/rumah', 'programs.rumah')->name('program.rumah');
Route::view('/program/beasiswa', 'programs.beasiswa')->name('program.beasiswa');

// Layanan (View Halaman Spesifik)
Route::view('/layanan/donasi', 'layanans.donasionline')->name('layanans.donasionline');
Route::view('/layanan/bantuan', 'layanans.bantuan')->name('layanans.bantuan');

// Form Donasi (Frontend User/Public - bisa diakses tamu dan user terautentikasi)
Route::get('/donasi/berdonasi', [DonasiController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
Route::get('/donasi/sukses', [DonasiController::class, 'sukses'])->name('donasi.sukses');

// Rute untuk admin (dalam grup middleware 'auth' dan 'admin')
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/donasi', [DonasiController::class, 'index'])->name('admin.donasi.index');
    Route::post('/donasi/{donation}/confirm', [DonasiController::class, 'confirm'])->name('admin.donasi.confirm');
});


// Memilih Login User atau Admin
Route::get('/pilih-login', function () {
    return view('pilih-login');
})->name('pilih.login');

// --- User Authentication & Dashboard ---
// Guard: 'web'
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login'])->name('user.login.submit');
Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout'); // User logout

// User Registration
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('user.register.submit');

// Authenticated User Routes (Role: user)
Route::middleware(['auth:web', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserLoginController::class, 'dashboard'])->name('dashboard');
    // Jika ada rute khusus donasi yang hanya bisa diakses oleh user yang login:
    // Route::get('/my-donations', [DonasiController::class, 'userDonationsHistory'])->name('my_donations');
});

// --- Admin Authentication & Dashboard ---
// Guard: 'admin'
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Login (URL: /admin/login)
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login'); // Nama rute 'admin.login'
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit'); // Nama rute 'admin.login.submit'
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout'); // Nama rute 'admin.logout'

    // Authenticated Admin Routes (Role: admin) - Semua rute admin yang memerlukan login ada di sini
    Route::middleware(['auth:admin', 'role:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Donasi untuk Admin (CRUD)
        Route::get('/donations', [DonasiController::class, 'index'])->name('donations.index');
        Route::resource('donations', DonasiController::class)->except(['create', 'edit'])->names('donations');
        Route::post('/donations/{donation}/confirm', [DonasiController::class, 'confirm'])->name('donations.confirm');


        // Manajemen Admin (jika menggunakan AdminManagementController)
        // Route::get('/admins', [AdminManagementController::class, 'index'])->name('admins.index');
        // Route::get('/admins/create', [AdminManagementController::class, 'create'])->name('admins.create');
        // Route::post('/admins', [AdminManagementController::class, 'store'])->name('admins.store');
    });
});

// --- Email Verification Routes (jika digunakan) ---
Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');