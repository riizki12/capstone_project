/*document.addEventListener('DOMContentLoaded', function() {
  const nominalPresetRadios = document.querySelectorAll('input[name="nominal_preset"]');
  const nominalCustomInput = document.querySelector('input[name="nominal_custom_input"]');
  const paymentMethods = document.querySelectorAll('.payment-method');
  const paymentMethodHiddenInput = document.getElementById('payment-method-hidden'); // Gunakan ID ini
  const donationForm = document.getElementById('donationForm');

  // --- Nominal Selection Logic ---

  // Variabel untuk menyimpan radio yang terakhir terpilih
  let lastCheckedRadio = null;

  // Fungsi untuk mengeset/menghapus atribut 'name' dari input nominal
  function updateNominalInputName() {
    nominalPresetRadios.forEach(radio => radio.removeAttribute('name'));
    nominalCustomInput.removeAttribute('name');

    const selectedPresetRadio = document.querySelector('input[name="nominal_preset"]:checked');
    if (selectedPresetRadio) {
      selectedPresetRadio.setAttribute('name', 'nominal');
      nominalCustomInput.value = ''; // Kosongkan input custom jika radio dipilih
    } else if (nominalCustomInput.value !== '') {
      nominalCustomInput.setAttribute('name', 'nominal');
    }
  }

  // Panggil saat DOMContentLoaded untuk mengeset state awal berdasarkan old()
  updateNominalInputName();
  // Inisialisasi lastCheckedRadio berdasarkan old() saat DOMContentLoaded
  const initialCheckedRadio = document.querySelector('input[name="nominal_preset"]:checked');
  if (initialCheckedRadio) {
      lastCheckedRadio = initialCheckedRadio;
  }

  // Event listener untuk radio preset (dengan fungsionalitas toggle)
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

  // Event listener untuk input custom nominal
  nominalCustomInput.addEventListener('input', function() {
    if (this.value !== '') {
      nominalPresetRadios.forEach(radio => {
        radio.checked = false;
      });
      lastCheckedRadio = null;
      this.setAttribute('name', 'nominal');
    } else {
      this.removeAttribute('name');
    }
    updateNominalInputName();
  });


  // --- Payment Method Selection Logic ---
  paymentMethods.forEach(method => {
    method.addEventListener('click', function() {
      // Hapus highlight dari semua metode
      paymentMethods.forEach(m => {
        m.classList.remove('border-green-500', 'ring-2', 'ring-green-400');
        m.classList.add('border-gray-300');
      });

      // Tambahkan highlight ke metode terpilih
      this.classList.remove('border-gray-300');
      this.classList.add('border-green-500', 'ring-2', 'ring-green-400');

      // Simpan nilai metode ke input hidden
      paymentMethodHiddenInput.value = this.getAttribute('data-method'); // Menggunakan paymentMethodHiddenInput
      console.log('Metode dipilih:', paymentMethodHiddenInput.value);
    });
  });

  // --- Set initial selected payment method based on old() ---
  const initialPaymentMethod = paymentMethodHiddenInput.value;
  if (initialPaymentMethod) {
    paymentMethods.forEach(method => {
      if (method.getAttribute('data-method') === initialPaymentMethod) {
        method.classList.remove('border-gray-300');
        method.classList.add('border-green-500', 'ring-2', 'ring-green-400');
      }
    });
  }


  // --- Form Submission Logic (Tambahan untuk Validasi JS Front-End) ---
  // Ini penting agar tombol bisa diklik dan validasi front-end berjalan
  donationForm.addEventListener('submit', function(e) {
    const finalNominalInput = document.querySelector('input[name="nominal"]');
    if (!finalNominalInput || finalNominalInput.value === '' || parseFloat(finalNominalInput.value) < 10000) {
      e.preventDefault(); // Mencegah submit jika validasi gagal
      alert('Silakan pilih nominal donasi atau masukkan nominal lainnya (minimal Rp 10.000).');
      return;
    }

    if (!paymentMethodHiddenInput.value) {
      e.preventDefault(); // Mencegah submit jika validasi gagal
      alert('Silakan pilih metode pembayaran.');
      return;
    }
    // Jika semua validasi front-end lolos, form akan disubmit secara normal
  });
});*/