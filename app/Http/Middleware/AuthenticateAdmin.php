<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- TAMBAHKAN BARIS INI

class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna terautentikasi menggunakan guard 'admin'
        if (!Auth::guard('admin')->check()) { // <--- UBAH DI SINI
            // Jika tidak terautentikasi sebagai admin, redirect ke halaman login admin
            return redirect()->route('admin.login');
        }

        // Jika terautentikasi, lanjutkan request
        return $next($request);
    }
}