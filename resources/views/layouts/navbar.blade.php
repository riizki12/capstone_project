<nav class="bg-white shadow-md">
  <div class="container mx-auto px-2 py-3 flex justify-between items-center">
    
    <!-- Logo -->
    <h1 class="text-xl font-bold text-green-700">
      <img src="{{ asset('img/navbar/logo-yasmi.png') }}" alt="logo" class="logo">
    </h1>
    
    <!-- Menu Navigasi -->
    <div class="flex space-x-6">
      <a href="{{route('home')}}" class="text-gray-700 hover:text-green-700">Home</a>
      <a href="{{route('services')}}" class="text-gray-700 hover:text-green-700">Layanan</a>
      <a href="{{route('program')}}" class="text-gray-700 hover:text-green-700">Program</a>
      <a href="{{route('aktivitas')}}" class="text-gray-700 hover:text-green-700">Aktivitas</a>
      <a href="{{route('legalitas')}}" class="text-gray-700 hover:text-green-700">Legalitas</a>
    </div>

    <!-- Tombol Login & Registrasi -->
    <div class="flex space-x-3 ml-6">
      @guest
        <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white transition">Login</a>
        <a href="{{ route('register') }}" class="px-4 py-2 text-sm text-white bg-green-700 rounded-lg hover:bg-green-800 transition">Registrasi</a>
      @else
        <a href="{{ url('/home') }}" class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition">Dashboard</a>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="px-4 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600 transition">Logout</button>
        </form>
      @endguest
    </div>

  </div>
</nav>
