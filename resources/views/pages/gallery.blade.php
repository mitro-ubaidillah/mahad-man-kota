<x-public-layout title="Galeri - Ma’had Islam Sekolah">
    <section class="page-hero">
        <span>Galeri</span>
        <h1>Visual suasana Ma’had yang lembut dan edukatif</h1>
        <p>Kumpulan dokumentasi kegiatan dan suasana pembinaan santri di lingkungan Ma’had.</p>
    </section>

    <section class="section">
        @if ($galleryItems->count())
            <div class="gallery-grid">
                @foreach ($galleryItems as $galleryItem)
                    <figure>
                        @if ($galleryItem->thumbnail)
                            <img src="{{ Storage::url($galleryItem->thumbnail) }}" alt="Galeri {{ $galleryItem->title }}">
                        @else
                            <span></span>
                        @endif
                        <figcaption>{{ $galleryItem->title }}</figcaption>
                    </figure>
                @endforeach
            </div>

            <div class="public-pagination">
                {{ $galleryItems->links() }}
            </div>
        @else
            <div class="public-empty">
                <strong>Belum ada galeri yang dipublikasikan.</strong>
                <p>Silakan tambahkan gambar dan nama kegiatan dari dashboard Admin Artikel.</p>
            </div>
        @endif
    </section>
</x-public-layout>
