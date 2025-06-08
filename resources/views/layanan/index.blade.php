@extends('layouts.app')

@section('content')
<section class="py-10 bg-gray-1250">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6 text-center">Layanan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
            <!-- Donasi Online -->
            <a href="{{ route('layanans.donasionline') }}" class="block bg-blue-100 hover:bg-blue-200 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-green-800">Donasi Online</h3>
            </a>

            <!-- Bantuan Kesehatan -->
            <a href="{{ route('layanans.bantuan') }}" class="block bg-blue-100 hover:bg-blue-200 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-blue-800">Bantuan Kesehatan</h3>
            </a>
        </div>
    </div>
</section>
@endsection