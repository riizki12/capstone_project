@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    
    <div class="bg-white p-6 rounded shadow">
        <p>Selamat datang, <strong>{{ $user->name }}</strong>!</p>
        <p class="mt-2">Email: {{ $user->email }}</p>
        
    <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Logout
        </button>
    </form>
    </div>
</div>
@endsection