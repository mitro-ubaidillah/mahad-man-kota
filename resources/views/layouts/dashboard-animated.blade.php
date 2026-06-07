<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Absensi - Pondok Pesantren')</title>
    <link rel="stylesheet" href="{{ asset('css/animated-background.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-app.css') }}">
    @stack('styles')
</head>
<body>
    {{-- Background Animasi --}}
    @include('components.animated-background')

    {{-- Konten Utama --}}
    <main class="main-content">
        @yield('content')
    </main>

    <script src="{{ asset('js/animated-background.js') }}"></script>
    @stack('scripts')
</body>
</html>
