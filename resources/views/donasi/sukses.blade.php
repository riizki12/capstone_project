@extends('layouts.app')
@section('content')
<section class="py-12 px-4 text-center">
  <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
    <div class="text-green-500 text-6xl mb-4">
      <i class="fas fa-check-circle"></i>
    </div>
    <h2 class="text-3xl font-bold mb-4">Pembayaran Berhasil!</h2>
    <p class="text-lg mb-6">Terima kasih atas donasi Anda. Donasi Anda akan membantu banyak orang yang membutuhkan.</p>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 text-left">
      <p class="font-bold">Detail Transaksi:</p>
      <p>Nominal: Rp {{ number_format(session('nominal'), 0, ',', '.') }}</p>
      <p>Metode Pembayaran: {{ ucfirst(session('payment_method')) }}</p>
      <p>Waktu: {{ now()->format('d M Y H:i') }}</p>
    </div>
    <a href="/" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg inline-block">
      Kembali ke Beranda
    </a>
  </div>
</section>
@endsection