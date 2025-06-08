<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Donasi Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-blue-600 mb-6">Daftar Donasi</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Donatur</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Telepon</th>
                        <th class="py-2 px-4 border-b">Jumlah</th>
                        <th class="py-2 px-4 border-b">Metode</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Pesan</th>
                        <th class="py-2 px-4 border-b">Tanggal</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($donations as $donation)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $donation->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $donation->nama_donatur ?? ($donation->user->name ?? 'Anonim') }}</td>
                            <td class="py-2 px-4 border-b">{{ $donation->email_donatur ?? ($donation->user->email ?? '-') }}</td>
                            <td class="py-2 px-4 border-b">{{ $donation->nomor_telepon ?? '-' }}</td>
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
                            <td class="py-2 px-4 border-b">{{ $donation->pesan ?? '-' }}</td>
                            <td class="py-2 px-4 border-b">{{ $donation->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-2 px-4 border-b">
                                @if ($donation->status_pembayaran == 'pending')
                                    <form action="{{ route('admin.donations.confirm', $donation) }}" method="POST" onsubmit="return confirm('Konfirmasi donasi ini?');">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-xs py-1 px-2 rounded">Konfirmasi</button>
                                    </form>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="py-4 px-4 text-center text-gray-500">Belum ada donasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.dashboardadmin') }}" class="text-blue-500 hover:underline">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>