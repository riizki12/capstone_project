<?php

use Illuminate\Support\Facades\Route;

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