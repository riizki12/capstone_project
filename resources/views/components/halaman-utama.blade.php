<div class="container">
    <div class="row">
    <!--foto profil dan tombol donasi-->
    <div class="foto-kolom">
        <div class="profil-card">
            <img src="{{ asset('img/halaman-utama/utama.png') }}" alt="utama" class="utama">
            <a href="{{route('donasi')}}" class="tombol-donasi">Bersedekah</a>
        </div>
    </div>
    <div class="aktivitas-kolom">
        <h2 class="judul-aktivitas">Aktivitas</h2>
        <div class="aktivitas-box">
            <img src="{{ asset('img/aktivitas/aktivitas1.png') }}" alt="aktivitas 1" class="aktivitas">
            <img src="{{ asset('img/aktivitas/aktivitas2.png') }}" alt="aktivitas 2" class="aktivitas">
            <img src="{{ asset('img/aktivitas/aktivitas3.png') }}" alt="aktivitas 3" class="aktivitas">
        </div>
        <a href="{{route('donasi')}}" class="donasi-sekarang">Donasi Sekarang</a>
    </div>
</div>
</div>