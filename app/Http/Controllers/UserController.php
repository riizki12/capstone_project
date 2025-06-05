<?php

namespace App\Http\Controllers;

use App\Models\DonasiModel;
use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Dashboard donatur
     */
    public function dashboard()
    {
        $user = Auth::user();
        $donations = DonasiModel::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', [
            'user' => $user,
            'donations' => $donations
        ]);
    }

    /**
     * Form buat donasi baru
     */
    public function createDonation()
    {
        return view('user.donations.create');
    }

    /**
     * Simpan donasi ke database
     */
    public function storeDonation(Request $request)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric',
            'payment_method' => 'required',
            'message' => 'nullable|string'
        ]);

        DonasiModel::create([
            'user_id' => Auth::id(),
            ...$validated,
            'status' => 'pending'
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Donasi berhasil dikirim!');
    }
}