<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman Statis
Route::view('/tentang-kami', 'about')->name('about');
Route::view('/layanan', 'services')->name('services');
Route::view('/kontak', 'contact')->name('contact');
Route::view('/legalitas', 'legalitas')->name('legalitas');
Route::view('/program', 'program')->name('program');
Route::view('/aktivitas', 'aktivitas')->name('aktivitas');

// Program Donasi
Route::view('/program/duafa', 'programs.duafa')->name('program.duafa');
Route::view('/program/rumah', 'programs.rumah')->name('program.rumah');
Route::view('/program/beasiswa', 'programs.beasiswa')->name('program.beasiswa');

// Layanan
Route::view('/layanan/donasi', 'layanans.donasionline')->name('layanans.donasionline');
Route::view('/layanan/bantuan', 'layanans.bantuan')->name('layanans.bantuan');

// Form Donasi
Route::get('/donasi', [DonasiController::class, 'create'])->name('donasi');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
Route::view('/donasikan', 'donasikan')->name('donasikan');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Dashboard Route (User Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Auth Admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/donasi', [DonasiController::class, 'index'])->name('admin.donasi');
    Route::post('/admin/donations/{id}/confirm', [AdminController::class, 'confirmDonation'])->name('admin.donations.confirm');
    Route::get('/admin', [AdminController::class, 'index'])->middleware('checkRole:admin');
});

/*
|--------------------------------------------------------------------------
| Donatur/User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/donations/create', [UserController::class, 'createDonation'])->name('user.donations.create');
    Route::post('/user/donations', [UserController::class, 'storeDonation'])->name('user.donations.store');
});

/*
|--------------------------------------------------------------------------
| Group Role Khusus (Admin dan Superadmin)
|--------------------------------------------------------------------------
*/

Route::middleware(['role:admin', 'role:superadmin'])->group(function () {
    // route khusus admin dan superadmin
});
