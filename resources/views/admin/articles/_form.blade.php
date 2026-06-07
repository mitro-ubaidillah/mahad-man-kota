@csrf

<div class="mahad-admin-form">
    <div class="mahad-admin-field">
        <label for="title">Judul Artikel</label>
        <input id="title" name="title" type="text" value="{{ old('title', $article->title) }}" maxlength="180" required>
        @error('title') <small class="mahad-admin-error">{{ $message }}</small> @enderror
    </div>

    <div class="mahad-admin-field">
        <label for="slug">Slug</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $article->slug) }}" maxlength="200" placeholder="Kosongkan untuk dibuat otomatis">
        @error('slug') <small class="mahad-admin-error">{{ $message }}</small> @enderror
    </div>

    <div class="mahad-admin-field mahad-admin-field--full">
        <label for="excerpt">Ringkasan</label>
        <textarea id="excerpt" name="excerpt" rows="3" maxlength="280" placeholder="Ringkasan singkat artikel">{{ old('excerpt', $article->excerpt) }}</textarea>
        @error('excerpt') <small class="mahad-admin-error">{{ $message }}</small> @enderror
    </div>

    <div class="mahad-admin-field mahad-admin-field--full">
        <label for="content">Isi Artikel</label>
        <textarea id="content" name="content" class="mahad-rich-editor" rows="16" required>{{ old('content', $article->content) }}</textarea>
        <p class="mahad-admin-help">Editor memakai TinyMCE. Klik gambar lalu tarik sudutnya untuk mengubah ukuran, atau klik kanan/toolbar gambar untuk opsi lanjutan.</p>
        @error('content') <small class="mahad-admin-error">{{ $message }}</small> @enderror
    </div>

    <div class="mahad-admin-field">
        <label for="category">Kategori</label>
        <select id="category" name="category">
            <option value="">Pilih kategori</option>
            @foreach ([
                \App\Models\Article::CATEGORY_NEWS => 'Berita — tampil di halaman Berita',
                \App\Models\Article::CATEGORY_ACTIVITY => 'Kegiatan — tampil di halaman Berita',
                \App\Models\Article::CATEGORY_ANNOUNCEMENT => 'Pengumuman — tampil di halaman Berita',
                \App\Models\Article::CATEGORY_PPDB => 'PPDB — tampil di halaman Berita',
                \App\Models\Article::CATEGORY_EDUCATION => 'Artikel Edukasi — tampil di halaman Artikel',
            ] as $value => $label)
                <option value="{{ $value }}" @selected(old('category', $article->category) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('category') <small class="mahad-admin-error">{{ $message }}</small> @enderror
    </div>

    <div class="mahad-admin-field">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            @foreach (['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $article->status ?: 'draft') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <small class="mahad-admin-error">{{ $message }}</small> @enderror
    </div>

    <div class="mahad-admin-field">
        <label for="published_at">Tanggal Publikasi</label>
        <input id="published_at" type="datetime-local" value="{{ old('published_at', $article->published_at?->format('Y-m-d\\TH:i')) }}" disabled>
        <p class="mahad-admin-help">Otomatis diisi saat artikel disimpan dengan status Published.</p>
        @error('published_at') <small class="mahad-admin-error">{{ $message }}</small> @enderror
    </div>

    <div class="mahad-admin-field">
        <label for="thumbnail">Thumbnail</label>
        <input id="thumbnail" name="thumbnail" type="file" accept="image/*">
        @error('thumbnail') <small class="mahad-admin-error">{{ $message }}</small> @enderror
        @if ($article->thumbnail)
            <div class="mahad-admin-current-image">
                <img src="{{ Storage::url($article->thumbnail) }}" alt="Thumbnail saat ini">
                <span>Thumbnail saat ini</span>
            </div>
        @endif
    </div>
</div>

<div class="mahad-admin-form-actions">
    <a href="{{ route('mahad-admin.articles.index') }}" class="mahad-admin-btn mahad-admin-btn--ghost">Batal</a>
    <button type="submit" class="mahad-admin-btn mahad-admin-btn--primary">{{ $submitLabel }}</button>
</div>
