<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm(){
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('admin')->attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withInput()->withErrors([
        'email' => 'Kredensial tidak valid untuk akses admin',
    ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}

