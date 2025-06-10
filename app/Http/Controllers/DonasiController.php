<?php

namespace App\Http\Controllers;

use App\Models\DonasiModel; // Import model DonasiModel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   // Untuk mendapatkan user_id jika user login
use Illuminate\Support\Facades\Log;   // Untuk logging error
use Illuminate\Validation\ValidationException; // Untuk menangani error validasi secara spesifik

class DonasiController extends Controller
{

    public function create()
    {
        return view('donasi.berdonasi');
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk dari formulir
        $validatedData = $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'nominal' => 'required|numeric|min:10000', // Nama input di form
            'metode_pembayaran' => 'required|string|in:BCA,DANA,OVO,GOPAY',
            'pesan' => 'nullable|string|max:500',
        ]);

        try {
            // Membuat record donasi baru di database
            $donasi = DonasiModel::create([
                'user_id' => Auth::id(), // Akan NULL jika user tidak login (donasi anonim)
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'nominal' => $validatedData['nominal'], // <-- MAPPING: 'nominal' dari form ke kolom DB 'jumlah'
                'metode_pembayaran' => $validatedData['metode_pembayaran'],
                'status_pembayaran' => 'pending', // Status awal donasi
                'pesan' => $validatedData['pesan'],
            ]);

            // Redirect ke halaman sukses dengan data sesi flash
            return redirect()->route('donasi.sukses')->with([
                'success' => 'Terima kasih atas donasi Anda! Pembayaran Anda sedang diproses.',
                'nominal' => $donasi->jumlah, // Mengirim 'jumlah' yang tersimpan ke halaman sukses
                'payment_method' => $donasi->metode_pembayaran,
                'transaction_time' => $donasi->created_at // Mengirim waktu transaksi
            ]);

        } catch (ValidationException $e) {
            // Jika ada error validasi, redirect kembali dengan error dan input lama
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Jika terjadi kesalahan lain (misal: masalah database), log error
            Log::error('Gagal menyimpan donasi: ' . $e->getMessage(), ['exception' => $e, 'request_data' => $request->all()]);

            // Redirect kembali dengan pesan error umum dan input lama
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses donasi Anda. Silakan coba lagi.')->withInput();
        }
    }

    public function sukses()
    {
        return view('donasi.sukses');
    }

    public function index()
    {
        // Mengambil semua donasi, diurutkan dari yang terbaru, dengan paginasi
        $donations = DonasiModel::orderBy('created_at', 'desc')->paginate(10); // Menampilkan 10 donasi per halaman

        return view('admin.donations.index', compact('donations'));
    }

    public function confirm(DonasiModel $donation)
    {
        try {
            $donation->update(['status_pembayaran' => 'confirmed']);
            return redirect()->back()->with('success', 'Donasi berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            Log::error('Gagal mengkonfirmasi donasi ID: ' . $donation->id . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi donasi. Silakan coba lagi.');
        }
    }

    public function edit(DonasiModel $donasi)
    {
        return view('admin.donations.edit', compact('donasi'));
    }

    public function update(Request $request, DonasiModel $donasi)
    {
        $validatedData = $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'jumlah' => 'required|numeric|min:10000', // Nama kolom di DB
            'metode_pembayaran' => 'required|string|in:BCA,DANA,OVO,GOPAY',
            'status_pembayaran' => 'required|string|in:pending,confirmed,cancelled', // Admin bisa mengubah status
            'pesan' => 'nullable|string|max:500',
        ]);

        try {
            $donasi->update($validatedData); // Langsung update dengan data tervalidasi
            return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui donasi ID: ' . $donasi->id . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui donasi. Silakan coba lagi.');
        }
    }

    public function destroy(DonasiModel $donasi)
    {
        try {
            $donasi->delete();
            return redirect()->back()->with('success', 'Donasi berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus donasi ID: ' . $donasi->id . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus donasi. Silakan coba lagi.');
        }
    }
}