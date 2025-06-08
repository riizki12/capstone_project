@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">Dashboard User</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Card Info User -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Profil Saya</h3>
            <p class="mt-2">{{ $user->name }}</p>
            <p>{{ $user->email }}</p>
        </div>

        <!-- Card Donasi -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Donasi</h3>
            <p class="mt-2">Total: {{ $data['total_donations'] }}x</p>
            <p>Terakhir: {{ $data['last_donation'] }}</p>
        </div>

        <!-- Card Program -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Program Aktif</h3>
            <ul class="mt-2 list-disc pl-5">
                @foreach($data['active_programs'] as $program)
                    <li>{{ $program }}</li>
                @endforeach
            </ul>
        </div>
        {{-- Tips 5: Validasi untuk user baru --}}
@if($data['total_donations'] > 0)
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-semibold text-lg">Donasi Terakhir</h3>
        <p class="mt-2">{{ $data['last_donation'] }}</p>
    </div>
@else
    <div class="bg-blue-50 p-4 rounded-lg">
        <p>Anda belum melakukan donasi. <a href="{{ route('user.donations.create') }}" class="text-blue-600">Donasi sekarang!</a></p>
    </div>
@endif

{{-- Tips 6: Gunakan null coalescing di view --}}
<p>Total Program: {{ $data['active_programs_count'] ?? 0 }}</p>
    </div>
</div>
@endsection