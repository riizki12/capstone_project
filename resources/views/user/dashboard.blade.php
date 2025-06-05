@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard User</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Card Info User -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg">Profil Saya</h3>
            <p class="mt-2">{{ $user->name }}</p>
            <p>{{ $user->email }}</p>
            <a href="{{ route('user.profile') }}" class="text-blue-600 mt-2 inline-block">Edit Profil</a>
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
    </div>
</div>
@endsection