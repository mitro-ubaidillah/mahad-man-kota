<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $description ?? 'Website profil Ma’had / Asrama Islam Sekolah yang hangat, edukatif, dan Islami.' }}">

    <title>{{ $title ?? 'Ma’had Islam Sekolah' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|merriweather:400,700&display=swap" rel="stylesheet">

    @vite(['resources/css/public.css', 'resources/js/app.js'])
</head>
<body class="public-site">
    <x-public.navbar />

    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <x-public.footer />
</body>
</html>
