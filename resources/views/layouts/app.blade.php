<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yasmi - Donasi Online</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" >
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/formulir-donasi.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/formulir-donasi.css')}}">
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
  @include('layouts.header')
  @include('layouts.navbar')

  <div class="min-h-screen flex flex-col">
    <main class="flex-grow">
      @yield('content')
    </main>

    @include('layouts.footer')
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>