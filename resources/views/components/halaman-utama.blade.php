<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="foto-kolom">
        <div class="profil-card">
            <img src="{{ asset('img/halaman-utama/utama.png') }}" alt="utama" class="utama">
            <a href="{{route('bersedekah')}}" class="tombol-donasi">Bersedekah</a>
        </div>
    </div>
    <div class="aktivitas-kolom">
        <h2 class="judul-aktivitas">Aktivitas</h2>
        <div class="aktivitas-box">
            <img src="{{ asset('img/aktivitas/aktivitas1.png') }}" alt="aktivitas 1" class="aktivitas">
            <img src="{{ asset('img/aktivitas/aktivitas2.png') }}" alt="aktivitas 2" class="aktivitas">
            <img src="{{ asset('img/aktivitas/aktivitas3.png') }}" alt="aktivitas 3" class="aktivitas">
        </div>
        <a href="{{route('bersedekah')}}" class="donasi-sekarang">Donasi Sekarang</a>
    </div>
</div>
</div>
    {{-- Aktivitas --}}
    <div class="mb-10">
        <h2 class="text-2xl font-bold text-center mb-6">Aktivitas</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <img src="{{ asset('img/aktivitas/aktivitas1.png') }}" alt="Aktivitas 1" class="rounded shadow w-full h-auto">
            <img src="{{ asset('img/aktivitas/aktivitas2.png') }}" alt="Aktivitas 2" class="rounded shadow w-full h-auto">
            <img src="{{ asset('img/aktivitas/aktivitas3.png') }}" alt="Aktivitas 3" class="rounded shadow w-full h-auto">
            <img src="{{ asset('img/aktivitas/aktivitas4.png') }}" alt="Aktivitas 4" class="rounded shadow w-full h-auto">
        </div>
    </div>

    {{-- Tombol Donasi --}}
    <div class="text-center mt-6">
        <a href="{{ route('bersedekah') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded shadow-md transition">
            Donasi Sekarang
        </a>
    </div>
</div>