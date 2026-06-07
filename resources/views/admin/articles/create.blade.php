@extends('layouts.admin')

@section('page_title', 'Tambah Artikel')

@section('content')
    <section class="mahad-admin-panel">
        <div class="mahad-admin-panel__header">
            <div>
                <h2>Tambah Artikel Baru</h2>
                <p>Buat artikel berita, kegiatan, atau informasi untuk halaman website.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('mahad-admin.articles.store') }}" enctype="multipart/form-data">
            @include('admin.articles._form', [
                'article' => $article,
                'submitLabel' => 'Simpan Artikel'
            ])
        </form>
    </section>
@endsection
