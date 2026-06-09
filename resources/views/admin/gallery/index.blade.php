@extends('layouts.admin')

@section('page_title', 'Galeri')

@section('content')
    <section class="mahad-admin-panel">
        <div class="mahad-admin-panel__header">
            <div>
                <h2>Update Galeri</h2>
                <p>Kelola gambar dan nama kegiatan yang tampil di halaman Galeri website.</p>
            </div>
            <a href="{{ route('mahad-admin.gallery.create') }}" class="mahad-admin-btn mahad-admin-btn--primary">
                Tambah Galeri
            </a>
        </div>

        @if ($galleryItems->count())
            <div class="mahad-admin-gallery-grid">
                @foreach ($galleryItems as $galleryItem)
                    <article class="mahad-admin-gallery-card">
                        @if ($galleryItem->thumbnail)
                            <img src="{{ Storage::url($galleryItem->thumbnail) }}" alt="Gambar {{ $galleryItem->title }}">
                        @else
                            <span></span>
                        @endif
                        <div>
                            <strong>{{ $galleryItem->title }}</strong>
                            <small>{{ $galleryItem->published_at?->translatedFormat('d F Y H:i') ?? '-' }}</small>
                        </div>
                        <div class="mahad-admin-actions">
                            <a href="{{ route('mahad-admin.gallery.edit', $galleryItem) }}">Edit</a>
                            <form method="POST" action="{{ route('mahad-admin.gallery.destroy', $galleryItem) }}" onsubmit="return confirm('Hapus galeri {{ $galleryItem->title }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mahad-admin-pagination">
                {{ $galleryItems->links() }}
            </div>
        @else
            <div class="mahad-admin-empty">
                <strong>Belum ada galeri.</strong>
                <p>Tambah gambar kegiatan pertama untuk ditampilkan di halaman Galeri.</p>
            </div>
        @endif
    </section>
@endsection
