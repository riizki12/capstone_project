@extends('layouts.app')

@section('content')
<section class="donation-form-section" id="formulir-donasi">
  <div class="donation-form-container">
    <h2 class="donation-form-title">Formulir Donasi</h2>

    {{-- Tampilkan pesan sukses atau error dari session --}}
    @if(session('success'))
      <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-error bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('error') }}
      </div>
    @endif

    {{-- Tampilkan error validasi dari Laravel secara global (opsional, bisa hanya individual) --}}
    @if ($errors->any())
        <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('donasi.store') }}" method="POST" class="donation-form" id="donationForm">
      @csrf
      <div class="form-column">
        <input type="text" name="nama" placeholder="Nama Lengkap" class="form-input @error('nama') border-red-500 @enderror" value="{{ old('nama', Auth::check() ? Auth::user()->name : '') }}">
        @error('nama')
            <div class="error-message text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror

        <input type="email" name="email" placeholder="Email" class="form-input @error('email') border-red-500 @enderror" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}">
        @error('email')
            <div class="error-message text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror

        <input type="tel" name="nomor_telepon" placeholder="Nomor Telepon/WhatsApp" class="form-input @error('nomor_telepon') border-red-500 @enderror" value="{{ old('nomor_telepon') }}">
        @error('nomor_telepon')
            <div class="error-message text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror

        <h3 class="form-subtitle">Nominal:</h3>
        <div class="amount-options">
          <label class="amount-option">
            <input type="radio" name="nominal_preset" value="30000" class="radio-toggle" {{ old('nominal') == '30000' ? 'checked' : '' }}>
            <span>Rp 30.000</span>
          </label>
          <label class="amount-option">
            <input type="radio" name="nominal_preset" value="50000" class="radio-toggle" {{ old('nominal') == '50000' ? 'checked' : '' }}>
            <span>Rp 50.000</span>
          </label>
          <label class="amount-option">
            <input type="radio" name="nominal_preset" value="100000" class="radio-toggle" {{ old('nominal') == '100000' ? 'checked' : '' }}>
            <span>Rp 100.000</span>
          </label>
          <input type="number" name="nominal_custom_input" placeholder="Nominal lainnya" class="form-input custom-amount mt-2 @error('nominal') border-red-500 @enderror" value="{{ old('nominal') }}">
          @error('nominal')
              <div class="error-message text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-column">
        <h3 class="form-subtitle">Metode Pembayaran:</h3>
        <div class="payment-methods flex gap-4 mb-4">
          <div class="payment-method border-2 border-gray-300 p-2 rounded cursor-pointer" data-method="BCA">
            <img src="/img/formulir/bca.png" alt="BCA" class="h-12 w-auto">
          </div>
          <div class="payment-method border-2 border-gray-300 p-2 rounded cursor-pointer" data-method="DANA">
            <img src="/img/formulir/dana.png" alt="DANA" class="h-12 w-auto">
          </div>
          <div class="payment-method border-2 border-gray-300 p-2 rounded cursor-pointer" data-method="GOPAY">
            <img src="/img/formulir/gopay.png" alt="Gopay" class="h-12 w-auto">
          </div>
        </div>

        <input type="hidden" name="metode_pembayaran" id="payment-method-hidden" value="{{ old('metode_pembayaran') }}">
        @error('metode_pembayaran')
            <div class="error-message text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror

        <textarea name="pesan" placeholder="Tulis Pesan (Opsional)" class="form-textarea mt-4 @error('pesan') border-red-500 @enderror" rows="4">{{ old('pesan') }}</textarea>
        @error('pesan')
            <div class="error-message text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror

        <button type="submit" class="submit-button mt-3">
          <i class="fas fa-hand-holding-heart"></i> Bersedekah Sekarang
        </button>
      </div>
    </form>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const nominalPresetRadios = document.querySelectorAll('input[name="nominal_preset"]');
  const nominalCustomInput = document.querySelector('input[name="nominal_custom_input"]');
  const paymentMethods = document.querySelectorAll('.payment-method');
  const paymentMethodHiddenInput = document.getElementById('payment-method-hidden');
  const donationForm = document.getElementById('donationForm');

  let lastCheckedRadio = null;

  function updateNominalInputName() {
    nominalPresetRadios.forEach(radio => radio.removeAttribute('name'));
    nominalCustomInput.removeAttribute('name');

    const selectedPresetRadio = document.querySelector('input[type="radio"][value]:checked'); // Memilih radio yang checked, regardless of name di awal
    if (selectedPresetRadio) {
      selectedPresetRadio.setAttribute('name', 'nominal');
      nominalCustomInput.value = '';
    } else if (nominalCustomInput.value !== '') {
      nominalCustomInput.setAttribute('name', 'nominal');
    }
  }

  // Initial state based on old()
  updateNominalInputName();
  const initialCheckedRadio = document.querySelector('input[name="nominal_preset"]:checked');
  if (initialCheckedRadio) {
      lastCheckedRadio = initialCheckedRadio;
  }

  nominalPresetRadios.forEach(radio => {
    radio.addEventListener('click', function() {
      if (this === lastCheckedRadio) {
        this.checked = false;
        lastCheckedRadio = null;
      } else {
        lastCheckedRadio = this;
      }
      updateNominalInputName();
    });
  });

  nominalCustomInput.addEventListener('input', function() {
    if (this.value !== '') {
      nominalPresetRadios.forEach(radio => {
        radio.checked = false;
      });
      lastCheckedRadio = null;
    }
    updateNominalInputName();
  });

  paymentMethods.forEach(method => {
    method.addEventListener('click', function() {
      paymentMethods.forEach(m => {
        m.classList.remove('border-green-500', 'ring-2', 'ring-green-400');
        m.classList.add('border-gray-300');
      });

      this.classList.remove('border-gray-300');
      this.classList.add('border-green-500', 'ring-2', 'ring-green-400');

      paymentMethodHiddenInput.value = this.getAttribute('data-method');
      console.log('Metode dipilih:', paymentMethodHiddenInput.value);
    });
  });

  const initialPaymentMethod = paymentMethodHiddenInput.value;
  if (initialPaymentMethod) {
    paymentMethods.forEach(method => {
      if (method.getAttribute('data-method') === initialPaymentMethod) {
        method.classList.remove('border-gray-300');
        method.classList.add('border-green-500', 'ring-2', 'ring-green-400');
      }
    });
  }

  donationForm.addEventListener('submit', function(e) {
    const finalNominalInput = document.querySelector('input[name="nominal"]');
    if (!finalNominalInput || finalNominalInput.value === '' || parseFloat(finalNominalInput.value) < 10000) {
      e.preventDefault();
      alert('Silakan pilih nominal donasi atau masukkan nominal lainnya (minimal Rp 10.000).');
      return;
    }

    if (!paymentMethodHiddenInput.value) {
      e.preventDefault();
      alert('Silakan pilih metode pembayaran.');
      return;
    }
  });
});
</script>
@endsection