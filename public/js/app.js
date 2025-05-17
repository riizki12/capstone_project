// Form validation
document.addEventListener('DOMContentLoaded', function() {
  const donationForm = document.querySelector('#formulir-donasi form');
  
  if (donationForm) {
    donationForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const name = this.querySelector('input[type="text"]').value;
      const phone = this.querySelector('input[placeholder="No WhatsApp"]').value;
      
      if (!name || !phone) {
        alert('Harap isi nama dan nomor WhatsApp terlebih dahulu');
        return;
      }
      
      alert('Terima kasih atas donasi Anda! Kami akan menghubungi via WhatsApp.');
      this.reset();
    });
  }

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'

      });
    });
  });
});

