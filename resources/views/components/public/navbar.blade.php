@php
    $links = [
        ['label' => 'Beranda', 'route' => 'home'],
        ['label' => 'Profil', 'route' => 'public.profile'],
        ['label' => 'Program', 'route' => 'public.programs'],
        ['label' => 'Kehidupan Ma’had', 'route' => 'public.life'],
        ['label' => 'Berita', 'route' => 'public.news'],
        ['label' => 'Artikel', 'route' => 'public.articles'],
        ['label' => 'Galeri', 'route' => 'public.gallery'],
        ['label' => 'Kontak', 'route' => 'public.contact'],
    ];
@endphp

<header class="public-navbar" x-data="{ open: false }">
    <a href="{{ route('home') }}" class="public-navbar__brand" aria-label="Beranda Ma’had">
        <span class="public-navbar__logo">
            <img src="{{ asset('images/logo_mahad.png') }}" alt="Logo Ma’had">
        </span>
        <span>
            <strong>Ma’had Islam</strong>
            <small>Asrama Sekolah</small>
        </span>
    </a>

    <button class="public-navbar__toggle" type="button" @click="open = ! open" :aria-expanded="open.toString()" aria-label="Buka menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <nav class="public-navbar__links" :class="{ 'is-open': open }">
        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}" class="{{ request()->routeIs($link['route']) || request()->routeIs($link['route'] . '.*') ? 'is-active' : '' }}">
                {{ $link['label'] }}
            </a>
        @endforeach
        @auth
            <a href="{{ auth()->user()->dashboardRoute() }}" class="public-navbar__cta">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="public-navbar__cta">PPDB / Login</a>
        @endauth
    </nav>
</header>
