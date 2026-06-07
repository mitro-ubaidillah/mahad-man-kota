<x-public-layout title="Artikel Edukasi - Ma’had Islam Sekolah">
    <section class="page-hero">
        <span>Artikel</span>
        <h1>Tulisan edukasi untuk orang tua dan santri</h1>
        <p>Berisi artikel pembinaan, adab, pendidikan Islam, dan catatan ringan seputar kehidupan Ma’had.</p>
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
                <strong>Belum ada artikel edukasi.</strong>
                <p>Silakan tambahkan konten dari dashboard Admin Artikel dengan kategori Artikel Edukasi.</p>
            </div>
        @endif
    </section>
</x-public-layout>
