@extends('layouts.app')
@section('content')
<section class="donation-form-section" id="formulir-donasi">
  <div class="donation-form-container">
    <h2 class="donation-form-title">Formulir Sedekah</h2>
    
    <form class="donation-form">
      <!-- Left Column -->
      <div class="form-column">
        <input type="text" placeholder="Nama" class="form-input" required>
        <input type="tel" placeholder="Nomor WhatsApp" class="form-input" required>
        
        <h3 class="form-subtitle">Nominal:</h3>
        <div class="amount-options">
          <label class="amount-option">
            <input type="radio" name="nominal" value="30000">
            <span>Rp 30.000</span>
          </label>
          <label class="amount-option">
            <input type="radio" name="nominal" value="50000">
            <span>Rp 50.000</span>
          </label>
          <label class="amount-option">
            <input type="radio" name="nominal" value="100000">
            <span>Rp 100.000</span>
          </label>
          <input type="number" placeholder="Nominal lainnya" class="form-input custom-amount">
        </div>
      </div>
      
      <!-- Right Column -->
      <div class="form-column">
        <h3 class="form-subtitle">Metode Pembayaran:</h3>
        <div class="payment-methods">
          <div class="payment-method">
            <img src="/img/formulir/bca.png" alt="BCA">
          </div>
          <div class="payment-method">
            <img src="/img/formulir/dana.png" alt="DANA">
          </div>
          <div class="payment-method">
            <img src="/img/formulir/gopay.png" alt="Gopay">
          </div>
        </div>
        <textarea placeholder="Tulis Pesan" class="form-textarea" rows="4"></textarea>
        <button type="submit" class="submit-button">
          <i class="fas fa-hand-holding-heart"></i> Bersedekah Sekarang
        </button>
      </div>
    </form>
  </div>
</section>
@endsection