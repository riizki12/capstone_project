<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Donatur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-green-600 mb-6">Login Donatur</h1>

        {{-- Tampilkan Pesan Error --}}
        @if(session('error'))
            <div class="mb-4 p-3 text-red-700 bg-red-100 rounded border border-red-300">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="mb-4 p-3 text-red-700 bg-red-100 rounded border border-red-300">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('user.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block mb-2 text-gray-700">Email</label>
                <input type="email" id="email" name="email" required 
                        class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-2 text-gray-700">Password</label>
                <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-green-600 text-white rounded hover:bg-green-700 transition">
                Login
            </button>
        </form>

        {{-- Tautan Registrasi --}}
        <div class="mt-4 text-center">
            <p class="text-gray-600 text-sm">
                Belum punya akun? 
                <a href="{{ route('user.register') }}" class="text-green-600 hover:underline font-semibold">
                    Registrasi
                </a>
            </p>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" 
               class="inline-block px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                ← Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</body>
</html>