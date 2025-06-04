@extends('layouts.app')
@section('content')
<section class="donation-form-section" id="formulir-donasi">
  <div class="donation-form-container">
    <h2 class="donation-form-title">Formulir Sedekah</h2>
    
    <form action="{{ route('donasi.store') }}" method="POST" class="donation-form">
@csrf
      <!-- Left Column -->
      <div class="form-column">
        <input type="text" name="Nama" placeholder="Nama" class="form-input" required>
        <input type="tel" name="Nomor WhatsApp" placeholder="Nomor WhatsApp" class="form-input" required>
        
        <h3 class="form-subtitle">Nominal:</h3>
        <div class="amount-options">
          <label class="amount-option">
            <input type="radio" name="nominal" value="30000" class="radio-toggle">
            <span>Rp 30.000</span>
          </label>
          <label class="amount-option">
            <input type="radio" name="nominal" value="50000" class="radio-toggle">
            <span>Rp 50.000</span>
          </label>
          <label class="amount-option">
            <input type="radio" name="nominal" value="100000" class="radio-toggle">
            <span>Rp 100.000</span>
          </label>
          <input type="number" name="custom_nominal" placeholder="Nominal lainnya" class="form-input custom-amount">
        </div>
      </div>
      
      <!-- Right Column -->
      <div class="form-column">
        <h3 class="form-subtitle">Metode Pembayaran:</h3>
        <div class="payment-methods flex gap-4">
          <div class="payment-method border-2 border-gray-300 p-2 rounded cursor-pointer" data-method="bca">
            <img src="/img/formulir/bca.png" alt="BCA" class="h-12 w-auto">
          </div>
          <div class="payment-method border-2 border-gray-300 p-2 rounded cursor-pointer" data-method="dana">
            <img src="/img/formulir/dana.png" alt="DANA" class="h-12 w-auto">
          </div>
          <div class="payment-method border-2 border-gray-300 p-2 rounded cursor-pointer" data-method="gopay">
            <img src="/img/formulir/gopay.png" alt="Gopay" class="h-12 w-auto">
          </div>
        </div>

  <!-- input tersembunyi untuk mengirim pilihan ke backend -->
        <input type="hidden" name="payment_method" id="payment-method">

        <textarea name="message" placeholder="Tulis Pesan" class="form-textarea mt-4" rows="4"></textarea>
        <button type="submit" class="submit-button mt-3">
          <i class="fas fa-hand-holding-heart"></i> Bersedekah Sekarang
        </button>
      </div>
    </form>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('.radio-toggle');
        let lastChecked = null;

        radios.forEach(radio => {
          radio.addEventListener('click', function () {
            if (this === lastChecked) {
              this.checked = false;
              lastChecked = null;
            } else {
              lastChecked = this;
            }
          });
        });
      });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const methods = document.querySelectorAll('.payment-method');

        methods.forEach(method => {
          method.addEventListener('click', function () {
        // Hapus highlight dari semua metode
            methods.forEach(m => m.classList.remove('border-green-500', 'ring-2', 'ring-green-400'));

        // Tambahkan highlight ke metode terpilih
            this.classList.add('border-green-500', 'ring-2', 'ring-green-400');

        // Simpan nilai metode ke input hidden
            const selected = this.getAttribute('data-method');
            document.getElementById('payment-method').value = selected;
          });
        });
      });
    </script>
  </div>
</section>
@endsection