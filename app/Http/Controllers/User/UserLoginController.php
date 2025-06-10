<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada jika Anda menggunakan Auth Facade

class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        // Mengembalikan tampilan login untuk pengguna biasa (donatur)
        return view('user.login'); // Sesuaikan path view Anda jika berbeda
    }

    public function login(Request $request)
    {
        // Existing login logic from your screenshot (Screenshot 120.png)
        // Pastikan Anda memvalidasi input sebelum mencoba login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Guard untuk pengguna biasa (donatur)
        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // Sesuaikan ini dengan dashboard pengguna
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Logout guard 'web' (untuk pengguna biasa)
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect ke halaman utama atau halaman login
    }
}