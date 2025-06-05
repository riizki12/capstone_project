@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profil Pengguna</h1>
        <p>Nama: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <!-- Tambahan info profil lainnya -->
    </div>
@endsection