@extends('layouts.admin')

@section('page_title', 'Edit Galeri')

@section('content')
    <section class="mahad-admin-panel">
        <div class="mahad-admin-panel__header">
            <div>
                <h2>Edit Galeri</h2>
                <p>Perbarui nama kegiatan atau ganti gambar galeri.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('mahad-admin.gallery.update', $galleryItem) }}" enctype="multipart/form-data">
            @method('PUT')

            @include('admin.gallery._form', [
                'galleryItem' => $galleryItem,
                'submitLabel' => 'Update Galeri'
            ])
        </form>
    </section>
@endsection
