@extends('layouts.admin')

@section('page_title', 'Artikel Ma’had')

@section('content')
    <section class="mahad-admin-stats">
        <article>
            <span>Total Artikel</span>
            <strong>{{ $stats['total'] }}</strong>
        </article>
        <article>
            <span>Published</span>
            <strong>{{ $stats['published'] }}</strong>
        </article>
        <article>
            <span>Draft</span>
            <strong>{{ $stats['draft'] }}</strong>
        </article>
        <article>
            <span>Archived</span>
            <strong>{{ $stats['archived'] }}</strong>
        </article>
    </section>

    <section class="mahad-admin-panel">
        <div class="mahad-admin-panel__header">
            <div>
                <h2>Daftar Artikel</h2>
                <p>Kelola berita, kegiatan, pengumuman, dan informasi pendaftaran Ma’had.</p>
            </div>
            <a href="{{ route('mahad-admin.articles.create') }}" class="mahad-admin-btn mahad-admin-btn--primary">
                Tambah Artikel
            </a>
        </div>

        <form method="GET" action="{{ route('mahad-admin.articles.index') }}" class="mahad-admin-filter">
            <input type="search" name="search" value="{{ $search }}" placeholder="Cari judul, kategori, atau ringkasan">
            <select name="status">
                <option value="">Semua status</option>
                @foreach (['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'] as $value => $label)
                    <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="mahad-admin-btn mahad-admin-btn--secondary">Filter</button>
            @if ($search || $status)
                <a href="{{ route('mahad-admin.articles.index') }}" class="mahad-admin-btn mahad-admin-btn--ghost">Reset</a>
            @endif
        </form>

        <div class="mahad-admin-table-wrap">
            <table class="mahad-admin-table">
                <thead>
                    <tr>
                        <th>Artikel</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Publikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr>
                            <td>
                                <div class="mahad-admin-article-cell">
                                    @if ($article->thumbnail)
                                        <img src="{{ Storage::url($article->thumbnail) }}" alt="Thumbnail {{ $article->title }}">
                                    @else
                                        <span></span>
                                    @endif
                                    <div>
                                        <strong>{{ $article->title }}</strong>
                                        <small>{{ $article->excerpt ?: 'Tanpa ringkasan.' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $article->category ?: '-' }}</td>
                            <td>
                                <span class="mahad-admin-badge mahad-admin-badge--{{ $article->status }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td>{{ $article->published_at?->translatedFormat('d F Y H:i') ?? '-' }}</td>
                            <td>
                                <div class="mahad-admin-actions">
                                    <a href="{{ route('mahad-admin.articles.show', $article) }}">Lihat</a>
                                    <a href="{{ route('mahad-admin.articles.edit', $article) }}">Edit</a>
                                    <form method="POST" action="{{ route('mahad-admin.articles.destroy', $article) }}" onsubmit="return confirm('Hapus artikel {{ $article->title }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="mahad-admin-empty">
                                    <strong>Belum ada artikel.</strong>
                                    <p>Mulai dengan membuat artikel pertama untuk berita atau kegiatan Ma’had.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mahad-admin-pagination">
            {{ $articles->links() }}
        </div>
    </section>
@endsection
