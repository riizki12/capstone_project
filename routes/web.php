<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\Auth\VerificationController; // Pastikan controller ini ada dan benar

// --- Rute Publik (Tidak memerlukan autentikasi) ---
// Rute Beranda/Landing Page
Route::get('/', function () {
    return view('home'); // Menggunakan 'index' sesuai diskusi sebelumnya
})->name('home');

// Rute Halaman Statis
Route::view('/tentang-kami', 'about')->name('about');
Route::view('/layanan', 'layanan.index')->name('layanan');
Route::view('/kontak', 'contact')->name('contact');
Route::view('/legalitas', 'legalitas')->name('legalitas');
Route::view('/program', 'program')->name('program');
Route::view('/aktivitas', 'aktivitas')->name('aktivitas');
Route::view('/bersedekah', 'bersedekah')->name('bersedekah');

// Rute Detail Program Donasi
Route::view('/program/duafa', 'programs.duafa')->name('program.duafa');
Route::view('/program/rumah', 'programs.rumah')->name('program.rumah');
Route::view('/program/beasiswa', 'programs.beasiswa')->name('program.beasiswa');

// Rute Detail Layanan
Route::view('/layanan/donasi', 'layanans.donasionline')->name('layanans.donasionline');
Route::view('/layanan/bantuan', 'layanans.bantuan')->name('layanans.bantuan');

// Rute Form Donasi (Frontend User/Public)
Route::get('/donasi/berdonasi', [DonasiController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
Route::get('/donasi/sukses', [DonasiController::class, 'sukses'])->name('donasi.sukses');

// Rute Pilihan Login (User atau Admin)
Route::get('/pilih-login', function () {
    return view('pilih-login');
})->name('pilih.login');


// --- Otentikasi & Dashboard User (Guard: 'web') ---
Route::prefix('user')->name('user.')->group(function () {
    // Rute Login User
    Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserLoginController::class, 'login'])->name('login.submit');

    // Rute Registrasi User
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    // Rute Logout User (memerlukan autentikasi untuk post request)
    Route::post('/logout', [UserLoginController::class, 'logout'])->middleware('auth:web')->name('logout');

    // Rute yang hanya bisa diakses oleh User yang sudah Login
    Route::middleware(['auth:web' /* , 'role:user' */])->group(function () {
        Route::get('/dashboard', [UserLoginController::class, 'dashboard'])->name('dashboard');
        // Contoh rute lain untuk user yang login
        // Route::get('/my-donations', [DonasiController::class, 'userDonationsHistory'])->name('my_donations');
    });
});


// --- Otentikasi & Dashboard Admin (Guard: 'admin') ---
Route::prefix('admin')->name('admin.')->group(function () {
    // Rute Login Admin (tidak menggunakan middleware 'auth.admin' karena ini halaman loginnya)
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');

    // Rute Logout Admin (memerlukan autentikasi untuk post request)
    Route::post('/logout', [AdminLoginController::class, 'logout'])->middleware('auth:admin')->name('logout');

    // Rute yang hanya bisa diakses oleh Admin yang sudah Login
    Route::middleware(['auth.admin' /* , 'role:admin' */])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Donasi untuk Admin (Menggunakan DonasiController)
        // Jika Anda ingin semua CRUD, gunakan Route::resource, tapi dengan pengecualian ini lebih fleksibel
        // Route::resource('donations', DonasiController::class)->except(['create', 'edit', 'store', 'show'])->names('donations');
        // Atau rute satu per satu seperti di bawah ini untuk kontrol penuh:
        Route::get('/donations', [DonasiController::class, 'index'])->name('donations.index');
        Route::get('/donations/{donasi}/edit', [DonasiController::class, 'edit'])->name('donations.edit');
        Route::put('/donations/{donasi}', [DonasiController::class, 'update'])->name('donations.update');
        Route::delete('/donations/{donasi}', [DonasiController::class, 'destroy'])->name('donations.destroy');
        Route::post('/donations/{donasi}/confirm', [DonasiController::class, 'confirm'])->name('donations.confirm');

        // Manajemen Admin (contoh jika ada AdminManagementController)
        // Route::get('/admins', [AdminManagementController::class, 'index'])->name('admins.index');
        // Route::get('/admins/create', [AdminManagementController::class, 'create'])->name('admins.create');
        // Route::post('/admins', [AdminManagementController::class, 'store'])->name('admins.store');
    });
});


// --- Rute Verifikasi Email (Jika Digunakan) ---
// Rute ini biasanya bekerja dengan trait MustVerifyEmail pada model User Anda.
Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth') // Middleware 'auth' default (untuk guard 'web')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed']) // 'signed' memastikan URL tidak dimodifikasi
    ->name('verification.verify');

Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1']) // 'throttle' membatasi pengiriman ulang email
    ->name('verification.resend');