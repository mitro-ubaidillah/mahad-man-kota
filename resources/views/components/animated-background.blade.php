<div class="scene day" id="animated-bg">
    {{-- LANGIT --}}
    <div class="sky">
        <div class="sun"></div>
        <div class="moon">
            <div class="moon-shape"></div>
        </div>
        <div class="stars-layer">
            @for ($i = 0; $i < 40; $i++)
                <div class="star-dot" style="top: {{ rand(2, 30) }}%; left: {{ rand(0, 100) }}%; animation-delay: {{ $i * 0.15 }}s;"></div>
            @endfor
        </div>
        <div class="cloud cl-1"></div>
        <div class="cloud cl-2"></div>
        <div class="cloud cl-3"></div>
        <div class="cloud cl-4"></div>
    </div>

    {{-- BACKGROUND KOTA (paling belakang) --}}
    <div class="bg-kota">
        <img class="img-day" src="{{ asset('images/morning/background.png') }}" alt="">
        <img class="img-night" src="{{ asset('images/night/background-kota.png') }}" alt="">
    </div>

    {{-- CITY SKYLINE BELAKANG --}}
    <div class="city-back">
        {{-- Skyline kiri --}}
        <!-- <div class="skyline-img sky-left-1"><img class="img-day" src="{{ asset('images/morning/bangunan-1.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-1.png') }}" alt=""></div>
        <div class="skyline-img sky-left-2"><img class="img-day" src="{{ asset('images/morning/bangunan-2.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-2.png') }}" alt=""></div>
        <div class="skyline-img sky-left-3"><img class="img-day" src="{{ asset('images/morning/bangunan-3.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-3.png') }}" alt=""></div>
        <div class="skyline-img sky-left-4"><img class="img-day" src="{{ asset('images/morning/bangunan-8.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-8.png') }}" alt=""></div> -->

        {{-- Skyline kanan --}}
        <!-- <div class="skyline-img sky-right-1"><img class="img-day" src="{{ asset('images/morning/bangunan-4.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-4.png') }}" alt=""></div>
        <div class="skyline-img sky-right-2"><img class="img-day" src="{{ asset('images/morning/bangunan-5.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-5.png') }}" alt=""></div>
        <div class="skyline-img sky-right-3"><img class="img-day" src="{{ asset('images/morning/bangunan-6.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-6.png') }}" alt=""></div>
        <div class="skyline-img sky-right-4"><img class="img-day" src="{{ asset('images/morning/bangunan-7.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-7.png') }}" alt=""></div>
        <div class="skyline-img sky-right-5"><img class="img-day" src="{{ asset('images/morning/bangunan-9.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-9.png') }}" alt=""></div>
        <div class="skyline-img sky-right-6"><img class="img-day" src="{{ asset('images/morning/bangunan-10.png') }}" alt=""><img class="img-night" src="{{ asset('images/night/bangunan-10.png') }}" alt=""></div> -->
    </div>

    {{-- BANGUNAN UTAMA (kiri ke kanan sesuai referensi) --}}
    <div class="buildings-row">
        {{-- Kafe (kiri) --}}
        <div class="bld-img bld-cafe"><img class="img-day" src="{{ asset('images/morning/cafe.png') }}" alt="Kafe"><img class="img-night" src="{{ asset('images/night/cafe.png') }}" alt="Kafe"></div>

        {{-- Masjid (kiri, agak ke belakang) --}}
        <div class="bld-img bld-masjid"><img class="img-day" src="{{ asset('images/morning/masjid.svg') }}" alt="Masjid"><img class="img-night" src="{{ asset('images/night/masjid.png') }}" alt="Masjid"></div>

        {{-- Toko (di antara masjid dan asrama) --}}
        <div class="bld-img bld-toko"><img class="img-day" src="{{ asset('images/morning/toko.png') }}" alt="Toko"><img class="img-night" src="{{ asset('images/night/toko.png') }}" alt="Toko"></div>

        {{-- Asrama / Gedung Utama (tengah, dominan) --}}
        <div class="bld-img bld-asrama"><img class="img-day" src="{{ asset('images/morning/asrama.png') }}" alt="Asrama"><img class="img-night" src="{{ asset('images/night/asrama.png') }}" alt="Asrama"></div>

        {{-- Klinik (di samping asrama) --}}
        <div class="bld-img bld-klinik"><img class="img-day" src="{{ asset('images/morning/klinik.png') }}" alt="Klinik"><img class="img-night" src="{{ asset('images/night/klinik.png') }}" alt="Klinik"></div>

        {{-- Sekolah (agak ke kanan) --}}
        <div class="bld-img bld-sekolah"><img class="img-day" src="{{ asset('images/morning/sekolah-2.png') }}" alt="Sekolah"><img class="img-night" src="{{ asset('images/night/sekolah-3.png') }}" alt="Sekolah"></div>

        {{-- Apotek (kanan) --}}
        <div class="bld-img bld-apotek"><img class="img-day" src="{{ asset('images/morning/apotek.png') }}" alt="Apotek"><img class="img-night" src="{{ asset('images/night/apotek.png') }}" alt="Apotek"></div>
    </div>

    {{-- HALAMAN HIJAU --}}
    <div class="lawn"></div>

    {{-- POHON-POHON di taman --}}
    <div class="trees-row">
        <div class="ftree ft-1"><div class="ft-leaves"></div><div class="ft-trunk"></div></div>
        <div class="ftree ft-2"><div class="ft-leaves"></div><div class="ft-trunk"></div></div>
        <div class="ftree ft-3"><div class="ft-leaves"></div><div class="ft-trunk"></div></div>
        <div class="ftree ft-4"><div class="ft-leaves"></div><div class="ft-trunk"></div></div>
        <div class="ftree ft-5"><div class="ft-leaves"></div><div class="ft-trunk"></div></div>
        <div class="ftree ft-6"><div class="ft-leaves"></div><div class="ft-trunk"></div></div>
    </div>

    {{-- BANGKU --}}
    <div class="bench bench-1"><div class="bn-back"></div><div class="bn-seat"></div><div class="bn-leg bnl-l"></div><div class="bn-leg bnl-r"></div></div>
    <div class="bench bench-2"><div class="bn-back"></div><div class="bn-seat"></div><div class="bn-leg bnl-l"></div><div class="bn-leg bnl-r"></div></div>
    <div class="bench bench-3"><div class="bn-back"></div><div class="bn-seat"></div><div class="bn-leg bnl-l"></div><div class="bn-leg bnl-r"></div></div>

    {{-- LAMPU JALAN --}}
    <div class="lamp lamp-1"><div class="lamp-light"></div><div class="lamp-arm"></div><div class="lamp-pole"></div></div>
    <div class="lamp lamp-2"><div class="lamp-light"></div><div class="lamp-arm"></div><div class="lamp-pole"></div></div>
    <div class="lamp lamp-3"><div class="lamp-light"></div><div class="lamp-arm"></div><div class="lamp-pole"></div></div>
    <div class="lamp lamp-4"><div class="lamp-light"></div><div class="lamp-arm"></div><div class="lamp-pole"></div></div>

    {{-- RAMBU --}}
    <div class="signpost"><div class="sign sign-1"></div><div class="sign sign-2"></div><div class="sign-pole"></div></div>

    {{-- TROTOAR --}}
    <div class="sidewalk"></div>

    {{-- JALAN RAYA --}}
    <div class="road">
        <div class="road-line rl-1"></div>
        <div class="road-line rl-2"></div>
        <div class="road-line rl-3"></div>
        <div class="road-line rl-4"></div>
        <div class="road-line rl-5"></div>
        <div class="road-line rl-6"></div>
        <div class="zebra">
            <div class="zb"></div>
            <div class="zb"></div>
            <div class="zb"></div>
            <div class="zb"></div>
            <div class="zb"></div>
            <div class="zb"></div>
            <div class="zb"></div>
        </div>
    </div>

    {{-- BUS KUNING --}}
    <div class="bus">
        <div class="bus-body"></div>
        <div class="bus-windows"></div>
        <div class="bus-door"></div>
        <div class="bus-wheel bw-f"></div>
        <div class="bus-wheel bw-b"></div>
        <div class="bus-headlight"></div>
    </div>

    {{-- KENDARAAN --}}
    <div class="vehicle car-1">
        <div class="car-body"></div>
        <div class="car-top"></div>
        <div class="car-window car-window-l"></div>
        <div class="car-window car-window-r"></div>
        <div class="car-wheel cw-f"></div>
        <div class="car-wheel cw-b"></div>
        <div class="car-headlight"></div>
    </div>
    <div class="vehicle car-2">
        <div class="car-body"></div>
        <div class="car-top"></div>
        <div class="car-window car-window-l"></div>
        <div class="car-window car-window-r"></div>
        <div class="car-wheel cw-f"></div>
        <div class="car-wheel cw-b"></div>
        <div class="car-headlight"></div>
    </div>
    <div class="vehicle car-3">
        <div class="car-body"></div>
        <div class="car-top"></div>
        <div class="car-window car-window-l"></div>
        <div class="car-window car-window-r"></div>
        <div class="car-wheel cw-f"></div>
        <div class="car-wheel cw-b"></div>
        <div class="car-headlight"></div>
    </div>
</div>
