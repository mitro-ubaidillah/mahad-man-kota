<footer class="public-footer">
    <div class="public-footer__grid">
        <div>
            <a href="{{ route('home') }}" class="public-footer__brand">
                <img src="{{ asset('images/logo_mahad.png') }}" alt="Logo Ma’had">
                <span>Ma’had Islam Sekolah</span>
            </a>
            <p>Lingkungan pembinaan Islam yang hangat, tertib, dan mendampingi tumbuhnya adab serta kemandirian santri.</p>
        </div>

        <div>
            <h3>Link Cepat</h3>
            <a href="{{ route('public.profile') }}">Profil Ma’had</a>
            <a href="{{ route('public.programs') }}">Program Pembinaan</a>
            <a href="{{ route('public.news') }}">Berita Kegiatan</a>
            <a href="{{ route('public.contact') }}">Kontak</a>
        </div>

        <div>
            <h3>Kontak</h3>
            <p>Alamat sekolah dan ma’had dapat disesuaikan.</p>
            <p>WhatsApp: 08xx-xxxx-xxxx</p>
            <p>Email: info@mahad-sekolah.sch.id</p>
        </div>
    </div>

    <div class="public-footer__bottom">
        <span>© {{ date('Y') }} Ma’had Islam Sekolah.</span>
        <span>Dibangun dengan Laravel.</span>
    </div>
</footer>
