<!-- Navbar -->
<nav class="bg-white shadow-md">
  <div class="container mx-auto px-2 py-3 flex justify-between items-center">
    <h1 class="text-xl font-bold text-green-700"><img src="{{ asset('img/navbar/logo-yasmi.png') }}" alt="logo" class="logo"></h1>
    <div class="ml-auto flex space-x-6 relative">
      <a href="{{route('home')}}" class="text-gray-700 hover:text-green-700">Home</a>
      <a href="{{route('layanan')}}" class="text-gray-700 hover:text-green-700">Layanan</a>
      <a href="{{route('program')}}" class="text-gray-700 hover:text-green-700">Program</a>
      <a href="{{route('aktivitas')}}" class="text-gray-700 hover:text-green-700">Aktivitas</a>
      <a href="{{route('legalitas')}}" class="text-gray-700 hover:text-green-700">Legalitas</a>
    </div>
  </div>
</nav>