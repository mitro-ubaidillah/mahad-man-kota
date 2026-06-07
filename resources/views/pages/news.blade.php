<x-public-layout title="Berita dan Kegiatan - Ma’had Islam Sekolah">
    <section class="page-hero">
        <span>Berita</span>
        <h1>Kabar kegiatan dan pengumuman Ma’had</h1>
        <p>Berisi kabar resmi Ma’had: berita, kegiatan santri, pengumuman, dan informasi pendaftaran.</p>
    </section>

    <section class="section">
        @if ($articles->count())
            <div class="news-grid">
                @foreach ($articles as $article)
                    <x-public.news-card
                        :date="$article->published_at?->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y')"
                        :title="$article->title"
                        :description="$article->excerpt ?: Str::limit(strip_tags($article->content), 140)"
                        :url="$article->publicUrl()"
                        :thumbnail="$article->thumbnail ? Storage::url($article->thumbnail) : null"
                        :category="$article->category"
                    />
                @endforeach
            </div>

            <div class="public-pagination">
                {{ $articles->links() }}
            </div>
        @else
            <div class="public-empty">
                <strong>Belum ada berita yang dipublikasikan.</strong>
                <p>Silakan tambahkan konten dari dashboard Admin Artikel dengan kategori Berita, Kegiatan, Pengumuman, atau PPDB.</p>
            </div>
        @endif
    </section>
</x-public-layout>
