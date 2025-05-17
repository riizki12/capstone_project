@extends('layouts.app') <!-- Extend layout utama (app.blade.php) -->

@section('title', 'Lokasi Kami - Yasmi')

@section('content')
  <!-- Slide Google Maps -->
  <div class="bg-white py-12 px-6">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-2xl font-bold text-center mb-8">Lokasi Kami</h2>
      <div class="h-96 bg-gray-200 rounded-lg overflow-hidden">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.954911466112!2d106.7982143147692!3d-6.540966595270963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzInMjcuNSJTIDEwNsKwNDcnNTkuNiJF!5e0!3m2!1sen!2sid!4v1621234567890!5m2!1sen!2sid" 
          width="100%" 
          height="100%" 
          style="border:0;" 
          allowfullscreen 
          loading="lazy"
        ></iframe>
      </div>
    </div>
  </div>
@endsection