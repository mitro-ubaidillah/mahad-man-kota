@extends('layouts.admin')

@section('page_title', 'Tambah Galeri')

@section('content')
    <section class="mahad-admin-panel">
        <div class="mahad-admin-panel__header">
            <div>
                <h2>Tambah Galeri</h2>
                <p>Upload gambar kegiatan dan beri nama kegiatan yang akan tampil di halaman Galeri.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('mahad-admin.gallery.store') }}" enctype="multipart/form-data">
            @include('admin.gallery._form', [
                'galleryItem' => $galleryItem,
                'submitLabel' => 'Simpan Galeri'
            ])
        </form>
    </section>
@endsection
