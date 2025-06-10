<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // PASTIKAN BARIS INI ADA!

class UserLoginController extends Controller
{
    // ... (metode showLoginForm, login, dashboard lainnya)

    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Pastikan guard 'web' untuk user biasa

        $request->session()->invalidate(); // Menghapus semua data sesi
        $request->session()->regenerateToken(); // Meregenerasi token CSRF

        return redirect('/'); // Redirect ke halaman beranda setelah logout
    }
}