<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;

Route::get('/donasi', [DonasiController::class, 'create']);
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
Route::get('/admin/donasi', [DonasiController::class, 'index'])->name('admin.donasi');
Route::get('/admin/donasi', [DonasiController::class, 'index'])->name('admin.donasi');



// Halaman Utama
Route::get('/', function () {
    return view('home');
});

Route::get('donasi', function(){
    return view('donasi');
})->name('donasi');

Route::get('donasikan', function(){
    return view('donasikan');
})->name('donasikan');

// Halaman Tentang Kami
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

// Halaman Layanan
Route::get('/layanan', function () {
    return view('services');
})->name('services');

// Halaman Kontak
Route::get('/kontak', function () {
    return view('contact');
})->name('contact');

//Navbar interaktif
Route::get('/legalitas', function () {
    return view('legalitas');
})->name('legalitas');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/program', function () {
    return view('program');
})->name('program');

Route::get('/aktivitas', function () {
    return view('aktivitas');
})->name('aktivitas');

Route::get('/program/duafa', function () {
    return view('programs.duafa');
})->name('program.duafa');

Route::get('/program/rumah', function () {
    return view('programs.rumah');
})->name('program.rumah');

Route::get('/program/beasiswa', function () {
    return view('programs.beasiswa');
})->name('program.beasiswa');

Route::get('/layanan/donasi', function () {
    return view('layanans.donasionline');
})->name('layanans.donasionline');

Route::get('/layanan/bantuan', function () {
    return view('layanans.bantuan');
})->name('layanans.bantuan');

