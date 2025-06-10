<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Registrasi Akun</h2>

    {{-- Tampilkan Pesan Sukses --}}
    @if(session('success'))
      <div class="mb-4 p-3 text-green-700 bg-green-100 rounded border border-green-300">
        {{ session('success') }}
      </div>
    @endif

    {{-- Tampilkan Pesan Error Umum --}}
    @if(session('error'))
      <div class="mb-4 p-3 text-red-700 bg-red-100 rounded border border-red-300">
        {{ session('error') }}
      </div>
    @endif

    {{-- Tampilkan Error Validasi (jika ada) --}}
    @if ($errors->any())
      <div class="mb-4 p-3 text-red-700 bg-red-100 rounded border border-red-300">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
    <form method="POST" action="{{ route('user.register') }}" class="space-y-5">
      @csrf

      <div>
        <label class="block mb-1 text-gray-700">Nama Lengkap</label>
        <input type="text" name="name" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-600 focus:outline-none" value="{{ old('name') }}">
        {{-- Tampilkan error spesifik untuk 'name' --}}
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block mb-1 text-gray-700">Email</label>
        <input type="email" name="email" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-600 focus:outline-none" value="{{ old('email') }}">
        {{-- Tampilkan error spesifik untuk 'email' --}}
        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block mb-1 text-gray-700">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-600 focus:outline-none">
        {{-- Tampilkan error spesifik untuk 'password' --}}
        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block mb-1 text-gray-700">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-600 focus:outline-none">
      </div>

      <button type="submit" class="w-full py-2 px-4 bg-green-700 text-white rounded hover:bg-green-800 transition">
        Daftar
      </button>

      <p class="text-sm text-center text-gray-600 mt-4">
        Sudah punya akun?
        <a href="{{ route('user.login') }}" class="text-green-600 hover:underline">Login di sini</a>
      </p>

      <div class="mt-4 text-center">
        <a href="{{ route('home') }}" 
          class="inline-block px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
          ← Kembali ke Halaman Utama
        </a>
      </div>
    </form>
  </div>

</body>
</html>