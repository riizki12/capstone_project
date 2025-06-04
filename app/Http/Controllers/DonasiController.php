<?php

namespace App\Http\Controllers;

use App\Models\DonasiModel;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'whatsapp' => 'required|string|max:20',
            'nominal' => 'required_without:custom_amount|numeric',
            'payment_method' => 'required|in:BCA,Dana,Gopay',
            'message' => 'nullable|string'
        ]);

        // Gunakan custom amount jika diisi
        $amount = $request->filled('custom_amount') 
                 ? $request->custom_amount 
                 : $request->amount;

        DonasiModel::create([
            'name' => $validated['name'],
            'whatsapp' => $validated['whatsapp'],
            'nominal' => $amount,
            'payment_method' => $validated['payment_method'],
            'message' => $validated['message']
        ]);

        return redirect()->back()->with('success', 'Donasi berhasil dikirim!');
    }

    public function success()
    {
        return view('donations.success');
    }

    public function index()
    {
    $donations = DonasiModel::all();
    return view('admin.donasi', compact('donations'));
    }

    
}