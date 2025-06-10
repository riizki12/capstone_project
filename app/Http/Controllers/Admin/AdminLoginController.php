<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // PASTIKAN BARIS INI ADA!
use Illuminate\Support\Facades\Session; // Tambahkan ini jika Anda menggunakan Session facade secara eksplisit

class AdminLoginController extends Controller
{
    // Constructor (opsional, jika Anda ingin menerapkan middleware di sini)
    public function __construct()
    {
        // Middleware 'guest:admin' akan memastikan hanya tamu (belum login) yang bisa mengakses
        // metode showLoginForm dan login. Jika sudah login, mereka akan diarahkan ke dashboard.
        $this->middleware('guest:admin')->except('logout');
    }
    
    public function showLoginForm()
    {
        // Mengembalikan tampilan untuk formulir login admin.
        // Pastikan path view ini benar. Contoh: resources/views/admin/auth/login.blade.php
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input yang masuk dari formulir login
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6' // Aturan minimal password, sesuaikan jika perlu
        ]);

        // 2. Coba untuk mengautentikasi user sebagai admin
        // Auth::guard('admin')->attempt() akan mencoba login user
        // berdasarkan kredensial (email, password) dan guard 'admin'.
        // $request->remember akan mengingat user (opsional).
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // 3. Jika autentikasi berhasil
            // redirect()->intended() akan mengarahkan user ke URL yang ingin mereka akses sebelumnya,
            // atau ke URL default jika tidak ada (dalam kasus ini, route('admin.dashboard')).
            return redirect()->intended(route('admin.dashboard'));
        }

        // 4. Jika autentikasi gagal
        // redirect()->back() mengarahkan kembali ke halaman sebelumnya (form login).
        // ->withInput() akan mengisi kembali form dengan input lama (kecuali password).
        // ->withErrors() akan menambahkan pesan error ke sesi yang bisa ditampilkan di view.
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Kredensial tidak cocok.']);
    }

    public function logout(Request $request)
    {
        // Melakukan logout untuk guard 'admin'
        Auth::guard('admin')->logout();

        // Mengosongkan (invalidate) sesi saat ini.
        // Ini akan menghapus semua data sesi user dan mengamankan sesi.
        $request->session()->invalidate();

        // Meregenerasi token CSRF untuk sesi baru.
        // Ini penting untuk keamanan dan mencegah serangan CSRF.
        $request->session()->regenerateToken();

        // Mengarahkan user ke halaman login admin setelah logout.
        // Anda bisa mengubahnya ke halaman utama ('/') jika itu yang diinginkan.
        return redirect()->route('home'); // Mengarahkan ke halaman home
    }

    // Metode dashboard (jika ada dan Anda ingin menampilkannya)
    // public function dashboard()
    // {
    //     return view('admin.dashboard'); // Sesuaikan dengan path view dashboard admin Anda
    // }
}
