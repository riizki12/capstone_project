<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login DonasiKu</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Login Akun</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
      @csrf

      <div>
        <label class="block mb-1 text-gray-700">Email</label>
        <input type="email" name="email" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-600 focus:outline-none">
      </div>

      <div>
        <label class="block mb-1 text-gray-700">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-600 focus:outline-none">
      </div>

      <button type="submit" class="w-full py-2 px-4 bg-green-700 text-white rounded hover:bg-green-800 transition">
        Masuk
      </button>

      <p class="text-sm text-center text-gray-600 mt-4">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-green-600 hover:underline">Daftar di sini</a>
      </p>
    </form>
  </div>

</body>
</html>