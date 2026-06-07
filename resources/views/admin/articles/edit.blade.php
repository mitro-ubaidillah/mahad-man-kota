@extends('layouts.admin')

@section('page_title', 'Edit Artikel')

@section('content')
    <section class="mahad-admin-panel">
        <div class="mahad-admin-panel__header">
            <div>
                <h2>Edit Artikel</h2>
                <p>Perbarui isi, status, kategori, atau thumbnail artikel.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('mahad-admin.articles.update', $article) }}" enctype="multipart/form-data">
            @method('PUT')

            @include('admin.articles._form', [
                'article' => $article,
                'submitLabel' => 'Update Artikel'
            ])
        </form>
    </section>
@endsection
