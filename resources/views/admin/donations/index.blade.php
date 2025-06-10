<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Donasi - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen">
        <aside class="bg-gray-800 text-gray-100 w-64 p-4 space-y-4">
            <div class="text-xl font-bold text-center">Admin Panel</div>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.donations.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 bg-gray-700">
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
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Donasi</h1>
            </header>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Donasi</h2>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Sukses!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($donations->isEmpty())
                    <p class="text-gray-500 text-center">Belum ada donasi.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">ID</th>
                                    <th class="py-2 px-4 border-b text-left">Donatur</th>
                                    <th class="py-2 px-4 border-b text-left">Email</th>
                                    <th class="py-2 px-4 border-b text-left">Jumlah</th>
                                    <th class="py-2 px-4 border-b text-left">Metode</th>
                                    <th class="py-2 px-4 border-b text-left">Status</th>
                                    <th class="py-2 px-4 border-b text-left">Tanggal</th>
                                    <th class="py-2 px-4 border-b text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donations as $donation)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $donation->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $donation->nama_donatur ?? ($donation->user->name ?? 'Anonim') }}</td>
                                        <td class="py-2 px-4 border-b">{{ $donation->email }}</td>
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
                                        <td class="py-2 px-4 border-b">{{ $donation->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                        <td class="py-2 px-4 border-b">
                                            @if ($donation->status_pembayaran == 'pending')
                                                <form action="{{ route('admin.donations.confirm', $donation) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                            @endif
                                            {{-- Tambahkan tombol edit atau delete jika diperlukan --}}
                                            {{-- <a href="{{ route('admin.donations.edit', $donation) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">Edit</a> --}}
                                            {{-- <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus donasi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">Hapus</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $donations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>