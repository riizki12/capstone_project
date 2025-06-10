<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonasiModel; // Pastikan Anda meng-import model DonasiModel

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan statistik donasi
        $totalDonasi = DonasiModel::sum('nominal');
        $jumlahDonasiPending = DonasiModel::where('status_pembayaran', 'pending')->count();
        $jumlahDonasiTerkonfirmasi = DonasiModel::where('status_pembayaran', 'confirmed')->count();
        $donasiTerbaru = DonasiModel::latest()->take(5)->get(); // Ambil 5 donasi terbaru

        return view('admin.dashboardadmin', compact(
            'totalDonasi',
            'jumlahDonasiPending',
            'jumlahDonasiTerkonfirmasi',
            'donasiTerbaru'
        ));
    }
}