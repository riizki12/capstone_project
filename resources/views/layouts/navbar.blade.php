<nav class="bg-white shadow-md">
  <div class="container mx-auto px-2 py-3 flex justify-between items-center">

    <h1 class="text-xl font-bold text-green-700">
      <img src="{{ asset('img/navbar/logo-yasmi.png') }}" alt="logo" class="logo">
    </h1>

    <div class="flex space-x-6">
      <a href="{{route('home')}}" class="text-gray-700 hover:text-green-700">Home</a>
      <a href="{{route('layanan')}}" class="text-gray-700 hover:text-green-700">Layanan</a>
      <a href="{{route('program')}}" class="text-gray-700 hover:text-green-700">Program</a>
      <a href="{{route('aktivitas')}}" class="text-gray-700 hover:text-green-700">Aktivitas</a>
      <a href="{{route('legalitas')}}" class="text-gray-700 hover:text-green-700">Legalitas</a>
    </div>

    <div class="flex space-x-3 ml-6 items-center"> {{-- Tambahkan items-center di sini --}}

      {{-- Logika Autentikasi untuk Admin, User, dan Tamu --}}
      @auth('admin') {{-- Jika admin login --}}
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm text-green-700 rounded-lg hover:bg-green-800 transition">Dashboard Admin</a>
        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
          @csrf
          <button type="submit" class="px-4 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600 transition">Logout Admin</button>
        </form>
      @elseauth('web') {{-- Jika user biasa (donatur) login --}}
        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm text-green-700 rounded-lg hover:bg-green-800 transition">Dashboard Saya</a> {{-- Ganti dengan rute dashboard user biasa --}}
        <form action="{{ route('logout') }}" method="POST" class="inline">
          @csrf
          <button type="submit" class="px-4 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600 transition">Logout</button>
        </form>
      @else {{-- Jika tidak ada yang login (tamu) --}}
        <div class="relative"> {{-- Wrapper untuk dropdown --}}
          <button id="dropdownLoginButton" class="px-4 py-2 text-sm text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white transition focus:outline-none">
            Login
          </button>

          {{-- Dropdown Menu --}}
          <div id="dropdownLoginMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
            <a href="{{ route('admin.login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login Admin</a>
            <a href="{{ route('user.login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login Donatur</a> {{-- Pastikan rute 'user.login' sudah ada --}}
          </div>
        </div>

        <a href="{{ route('user.register') }}" class="px-4 py-2 text-sm text-white bg-green-700 rounded-lg hover:bg-green-800 transition">Registrasi</a>
      @endauth
    </div>

  </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dropdownButton = document.getElementById('dropdownLoginButton');
    const dropdownMenu = document.getElementById('dropdownLoginMenu');

    if (dropdownButton && dropdownMenu) {
      dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
      });

      // Tutup dropdown jika klik di luar area dropdown
      document.addEventListener('click', function (event) {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
          dropdownMenu.classList.add('hidden');
        }
      });
    }
  });
</script>