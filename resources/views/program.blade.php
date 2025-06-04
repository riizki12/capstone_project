@extends('layouts.app')

@section('content')
<section class="py-10 bg-gray-1250">
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-10">
    <h2 class="text-2xl font-bold text-center mb-6 border-b pb-10">Program Unggulan</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">

        <a href="{{ route('program.duafa') }}">
            <img src="{{ asset('img/program/duafa.png') }}" class="h-24 mx-auto" alt="Senyum Duafa">
            <p class="mt-2 font-semibold">Senyum Duafa</p>
        </a>

        <a href="{{ route('program.rumah') }}">
            <img src="{{ asset('img/program/pembangunan.png') }}" class="h-24 mx-auto" alt="Pembangunan Rumah">
            <p class="mt-2 font-semibold">Pembangunan Rumah</p>
        </a>

        <a href="{{ route('program.beasiswa') }}">
            <img src="{{ asset('img/program/sekolah.png') }}" class="h-24 mx-auto" alt="Beasiswa Sekolah">
            <p class="mt-2 font-semibold">Beasiswa Sekolah</p>
        </a>
        </div>
    </div>
</section>
@endsection