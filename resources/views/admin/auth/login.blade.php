<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-green-600 mb-6">Login Admin</h1>

        {{-- Notif error login --}}
        @if(session('error'))
            <div class="mb-4 text-red-600 font-medium text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-green-600 text-white rounded hover:bg-green-700 transition">
                Login
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="text-green-600 hover:underline">← Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>
