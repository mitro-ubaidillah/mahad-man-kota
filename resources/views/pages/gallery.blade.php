<x-public-layout title="Galeri - Ma’had Islam Sekolah">
    <section class="page-hero">
        <span>Galeri</span>
        <h1>Visual suasana Ma’had yang lembut dan edukatif</h1>
        <p>Galeri memakai ilustrasi sementara, sehingga tidak bergantung pada foto bangunan asli.</p>
    </section>

    <section class="section">
        <div class="gallery-grid">
            @foreach (['Halaqah pagi', 'Kajian adab', 'Belajar malam', 'Kebersihan lingkungan', 'Olahraga santri', 'Muhadharah', 'Tilawah bersama', 'Pendampingan belajar', 'Suasana asrama'] as $caption)
                <figure>
                    <span></span>
                    <figcaption>{{ $caption }}</figcaption>
                </figure>
            @endforeach
        </div>
    </section>
</x-public-layout>
