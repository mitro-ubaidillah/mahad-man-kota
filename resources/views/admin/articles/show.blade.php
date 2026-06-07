@extends('layouts.admin')

@section('page_title', 'Detail Artikel')

@section('content')
    <article class="mahad-admin-panel">
        <div class="mahad-admin-panel__header">
            <div>
                <h2>{{ $article->title }}</h2>
                <p>{{ $article->excerpt ?: 'Artikel tanpa ringkasan.' }}</p>
            </div>
            <a href="{{ route('mahad-admin.articles.edit', $article) }}" class="mahad-admin-btn mahad-admin-btn--primary">
                Edit Artikel
            </a>
        </div>

        <div class="mahad-admin-detail-meta">
            <span class="mahad-admin-badge mahad-admin-badge--{{ $article->status }}">{{ ucfirst($article->status) }}</span>
            <span>Kategori: {{ $article->category ?: '-' }}</span>
            <span>Publikasi: {{ $article->published_at?->translatedFormat('d F Y H:i') ?? '-' }}</span>
            <span>Slug: {{ $article->slug }}</span>
        </div>

        @if ($article->thumbnail)
            <img src="{{ Storage::url($article->thumbnail) }}" alt="Thumbnail {{ $article->title }}" class="mahad-admin-detail-image">
        @endif

        <div class="mahad-admin-content-preview">
            {!! $article->content !!}
        </div>
    </article>
@endsection
