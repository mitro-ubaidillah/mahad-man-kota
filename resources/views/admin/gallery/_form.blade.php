@csrf

<div class="mahad-admin-form mahad-admin-form--compact">
    <div class="mahad-admin-field">
        <label for="title">Nama Kegiatan</label>
        <input id="title" name="title" type="text" value="{{ old('title', $galleryItem->title) }}" maxlength="180" required>
        @error('title') <small class="mahad-admin-error">{{ $message }}</small> @enderror
    </div>

    <div class="mahad-admin-field">
        <label for="thumbnail">Gambar</label>
        <input id="thumbnail" name="thumbnail" type="file" accept="image/*" @required(! $galleryItem->exists)>
        <p class="mahad-admin-help">Gunakan gambar JPG, PNG, atau WebP. Maksimal 3MB.</p>
        @error('thumbnail') <small class="mahad-admin-error">{{ $message }}</small> @enderror
        @if ($galleryItem->thumbnail)
            <div class="mahad-admin-current-image">
                <img src="{{ Storage::url($galleryItem->thumbnail) }}" alt="Gambar {{ $galleryItem->title }}">
                <span>Gambar saat ini</span>
            </div>
        @endif
    </div>
</div>

<div class="mahad-admin-form-actions">
    <a href="{{ route('mahad-admin.gallery.index') }}" class="mahad-admin-btn mahad-admin-btn--ghost">Batal</a>
    <button type="submit" class="mahad-admin-btn mahad-admin-btn--primary">{{ $submitLabel }}</button>
</div>
