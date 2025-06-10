<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom styles if needed */
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen">
        <aside class="bg-gray-800 text-gray-100 w-64 p-4 space-y-4">
            <div class="text-xl font-bold text-center">Admin Panel</div>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 active:bg-gray-700 {{ Request::routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.donations.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 {{ Request::routeIs('admin.donations.index') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-hand-holding-heart mr-2"></i> Donasi
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2.5 px-4 rounded transition duration-200 hover:bg-red-700 bg-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </nav>
        </aside>

        <div class="flex-1 overflow-y-auto p-6">
            <header class="flex justify-between items-center pb-4 border-b border-gray-200 mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
                <div>
                    <span class="text-gray-600">Selamat datang, Admin!</span>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500">Total Donasi</div>
                        <div class="text-2xl font-bold text-blue-600">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</div>
                    </div>
                    <i class="fas fa-money-bill-wave text-4xl text-blue-400"></i>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500">Donasi Pending</div>
                        <div class="text-2xl font-bold text-yellow-600">{{ $jumlahDonasiPending }}</div>
                    </div>
                    <i class="fas fa-clock text-4xl text-yellow-400"></i>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500">Donasi Terkonfirmasi</div>
                        <div class="text-2xl font-bold text-green-600">{{ $jumlahDonasiTerkonfirmasi }}</div>
                    </div>
                    <i class="fas fa-check-circle text-4xl text-green-400"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Donasi Terbaru</h2>
                @if ($donasiTerbaru->isEmpty())
                    <p class="text-gray-500 text-center">Belum ada donasi terbaru.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">ID</th>
                                    <th class="py-2 px-4 border-b text-left">Donatur</th>
                                    <th class="py-2 px-4 border-b text-left">Jumlah</th>
                                    <th class="py-2 px-4 border-b text-left">Metode</th>
                                    <th class="py-2 px-4 border-b text-left">Status</th>
                                    <th class="py-2 px-4 border-b text-left">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donasiTerbaru as $donation)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $donation->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $donation->nama_donatur ?? ($donation->user->name ?? 'Anonim') }}</td>
                                        <td class="py-2 px-4 border-b">Rp {{ number_format($donation->jumlah, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4 border-b">{{ $donation->metode_pembayaran }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($donation->status_pembayaran == 'confirmed') bg-green-100 text-green-800
                                                @elseif($donation->status_pembayaran == 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($donation->status_pembayaran) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b">{{ $donation->created_at?->format('d/m/Y H:i') ?? '-' }}</td> {{-- PERBAIKAN DI SINI --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right mt-4">
                        <a href="{{ route('admin.donations.index') }}" class="text-blue-600 hover:underline">Lihat Semua Donasi <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>