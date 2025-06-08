<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Coba login menggunakan guard 'web' (default)
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Jika berhasil, arahkan ke halaman utama
            // return redirect()->intended('/'); // Halaman utama aplikasi
            // Atau jika Anda punya rute bernama 'home':
            return redirect()->intended(route('home'));
        }

        // Jika gagal
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Kredensial Anda tidak cocok.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Kembali ke halaman utama
    }
}
