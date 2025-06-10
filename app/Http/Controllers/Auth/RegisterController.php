<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Import model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use Illuminate\Support\Facades\Auth; // Untuk login otomatis setelah registrasi
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('user.auth.register'); // Pastikan 'auth.register' sesuai dengan lokasi file blade Anda
    }

    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' akan mencocokkan dengan password_confirmation
        ]);

        // 2. Buat Pengguna Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password di-hash sebelum disimpan
        ]);

        // 3. Login Pengguna Secara Otomatis (Opsional)
        Auth::login($user);

        // 4. Redirect Setelah Registrasi Berhasil
        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang.');
        // Ganti 'dashboard' dengan nama rute halaman yang ingin dituju setelah registrasi
    }
}