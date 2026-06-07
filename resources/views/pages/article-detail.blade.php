<x-public-layout title="{{ $article->title }} - Ma’had Islam Sekolah">
    <article class="article-detail">
        <a href="{{ $backRoute }}" class="article-detail__back">{{ $backLabel }}</a>
        <span>{{ $article->category ?: 'Konten Ma’had' }}</span>
        <h1>{{ $article->title }}</h1>
        <p>{{ $article->excerpt }}</p>

        <div class="article-detail__meta">
            <time>{{ $article->published_at?->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y') }}</time>
            <span>Ma’had Islam Sekolah</span>
        </div>

        @if ($article->thumbnail)
            <img src="{{ Storage::url($article->thumbnail) }}" alt="Thumbnail {{ $article->title }}" class="article-detail__image">
        @endif

        <div class="article-detail__content">
            {!! $article->content !!}
        </div>
    </article>
</x-public-layout>
