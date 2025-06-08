<?php

namespace App\Http\Controllers;

use App\Models\DonasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DonasiController extends Controller
{
    public function create()
    {
        return view('donasi.berdonasi');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'nominal' => 'required|numeric|min:10000',
            'metode_pembayaran' => 'required|string|in:BCA,DANA,OVO,GOPAY',
            'pesan' => 'nullable|string|max:500',
        ]);

        try {
            $donasi = DonasiModel::create([
                'user_id' => Auth::id(),
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'nominal' => $validatedData['nominal'],
                'metode_pembayaran' => $validatedData['metode_pembayaran'],
                'status_pembayaran' => 'pending',
                'pesan' => $validatedData['pesan'],
            ]);

            return redirect()->route('donasi.sukses')->with([
                'success' => 'Terima kasih atas donasi Anda! Pembayaran Anda sedang diproses.',
                'nominal' => $donasi->nominal,
                'payment_method' => $donasi->metode_pembayaran,
                'transaction_time' => $donasi->created_at
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan donasi: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses donasi Anda. Silakan coba lagi.')->withInput();
        }
    }

    public function sukses()
    {
        return view('donasi.sukses');
    }

    public function index()
    {
        $donations = DonasiModel::latest()->get();
        return view('admin.donations.index', compact('donations'));
    }

    public function confirm(DonasiModel $donation)
    {
        $donation->update(['status_pembayaran' => 'confirmed']);
        return redirect()->back()->with('success', 'Donasi berhasil dikonfirmasi.');
    }
}