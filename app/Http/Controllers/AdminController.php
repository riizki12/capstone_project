<?php

namespace App\Http\Controllers;
     

use App\Models\DonasiModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard admin - melihat semua donasi
     */
    public function dashboard()
    {
        $donations = DonasiModel::with('user')
            ->latest()
            ->paginate(10);

        $totalDonations = DonasiModel::sum('nominal');

        return view('admin.dashboard', [
            'donations' => $donations,
            'totalDonations' => $totalDonations
        ]);
    }

    /**
     * Konfirmasi donasi
     */
    public function confirmDonation($id)
    {
        DonasiModel::where('id', $id)->update([
            'status' => 'confirmed',
            'confirmed_by' => Auth::id()
        ]);

        return back()->with('success', 'Donasi berhasil dikonfirmasi');
    }
}