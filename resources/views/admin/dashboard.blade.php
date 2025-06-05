<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col items-center justify-center min-h-screen">

    <div class="w-full max-w-4xl p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Dashboard Donatur</h2>

        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Nama Donatur</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Jumlah Donasi</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal Donasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donations as $donation)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $donation->donor_name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $donation->donor_email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $donation->amount }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $donation->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>

</body>
</html>