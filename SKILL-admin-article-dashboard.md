# SKILL.md — Dashboard Admin Artikel Laravel untuk Website Ma’had

## Tujuan

Skill ini digunakan untuk membuat dashboard admin artikel pada website Ma’had / Asrama Islam Sekolah berbasis Laravel.

Dashboard ini berfungsi untuk mengelola:

- berita Ma’had
- kegiatan santri
- pengumuman ringan
- artikel edukasi
- informasi pendaftaran
- dokumentasi kegiatan

Fokus utama dashboard adalah sederhana, rapi, mudah dipakai admin sekolah, dan mudah dikembangkan.

---

## Konsep Dashboard

Dashboard admin harus terasa:

- bersih
- profesional
- ringan
- Islami
- tidak terlalu ramai
- mudah digunakan oleh admin non-teknis
- konsisten dengan tampilan website utama

Gunakan warna yang sama dengan website utama.

```css
--admin-primary: #14532d;
--admin-primary-soft: #e6f4ea;
--admin-cream: #f8f5ec;
--admin-dark: #102418;
--admin-muted: #6b7280;
--admin-border: #e5e7eb;
--admin-white: #ffffff;
--admin-danger: #b42318;
```

---

## Fitur Utama

Dashboard artikel harus memiliki fitur:

1. Melihat daftar artikel
2. Membuat artikel baru
3. Mengedit artikel
4. Menghapus artikel
5. Melihat detail artikel
6. Upload thumbnail
7. Filter berdasarkan status
8. Search berdasarkan judul/kategori/ringkasan
9. Status artikel:
   - draft
   - published
   - archived
10. Tanggal publikasi artikel
11. Statistik ringkas:
   - total artikel
   - published
   - draft
   - archived

---

## Struktur Database

Buat tabel `articles`.

Kolom yang disarankan:

```txt
id
title
slug
excerpt
content
category
thumbnail
status
published_at
created_at
updated_at
```

### Migration

```php
Schema::create('articles', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->string('slug')->unique();
    $table->string('excerpt')->nullable();
    $table->longText('content');
    $table->string('category')->nullable();
    $table->string('thumbnail')->nullable();

    $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
    $table->timestamp('published_at')->nullable();

    $table->timestamps();

    $table->index(['status', 'published_at']);
});
```

---

## Model Article

Lokasi:

```txt
app/Models/Article.php
```

Isi model:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'thumbnail',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}
```

---

## Struktur Route

Route admin diletakkan di `routes/web.php`.

```php
use App\Http\Controllers\Admin\ArticleController;

Route::prefix('admin')
    ->name('admin.')
    // ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.articles.index');
        })->name('dashboard');

        Route::resource('articles', ArticleController::class);
    });
```

Catatan:

- Jika project sudah memakai login, aktifkan middleware `auth`.
- Jika belum memakai login, middleware bisa dikomentari sementara.
- Route utama dashboard diarahkan ke daftar artikel.

---

## Struktur Folder Blade

Gunakan struktur berikut:

```txt
resources/views/
├── layouts/
│   └── admin.blade.php
└── admin/
    └── articles/
        ├── index.blade.php
        ├── create.blade.php
        ├── edit.blade.php
        ├── show.blade.php
        └── _form.blade.php
```

CSS admin:

```txt
resources/css/admin.css
```

---

## Layout Admin

File:

```txt
resources/views/layouts/admin.blade.php
```

Layout harus memiliki:

- sidebar
- brand admin
- menu artikel
- menu pengumuman
- menu galeri
- link lihat website
- topbar
- area content
- session alert

Contoh struktur:

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Ma’had' }}</title>

    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand">
            <span class="admin-brand__mark">م</span>
            <span>
                <strong>Admin Ma’had</strong>
                <small>Panel Artikel</small>
            </span>
        </a>

        <nav class="admin-menu">
            <a href="{{ route('admin.articles.index') }}"
               class="admin-menu__link {{ request()->routeIs('admin.articles.*') ? 'is-active' : '' }}">
                Artikel
            </a>

            <a href="#" class="admin-menu__link">Pengumuman</a>
            <a href="#" class="admin-menu__link">Galeri</a>
            <a href="{{ route('home') }}" class="admin-menu__link">Lihat Website</a>
        </nav>
    </aside>

    <div class="admin-shell">
        <header class="admin-topbar">
            <div>
                <p class="admin-kicker">Dashboard</p>
                <h1>@yield('page_title', 'Admin')</h1>
            </div>

            <div class="admin-user">
                <span class="admin-user__avatar">A</span>
                <span>Admin</span>
            </div>
        </header>

        <main class="admin-main">
            @if(session('success'))
                <div class="admin-alert admin-alert--success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
```

---

## Controller Artikel

Lokasi:

```txt
app/Http/Controllers/Admin/ArticleController.php
```

Controller harus memiliki method:

```txt
index
create
store
show
edit
update
destroy
```

### Index

Fungsi index harus:

- menampilkan daftar artikel terbaru
- mendukung search
- mendukung filter status
- menampilkan pagination
- menghitung statistik artikel

Query dasar:

```php
$articles = Article::query()
    ->when($search, function ($query) use ($search) {
        $query->where(function ($subQuery) use ($search) {
            $subQuery->where('title', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%");
        });
    })
    ->when($status, function ($query) use ($status) {
        $query->where('status', $status);
    })
    ->latest()
    ->paginate(10)
    ->withQueryString();
```

Statistik:

```php
$stats = [
    'total' => Article::count(),
    'published' => Article::where('status', 'published')->count(),
    'draft' => Article::where('status', 'draft')->count(),
    'archived' => Article::where('status', 'archived')->count(),
];
```

---

## Validasi Artikel

Gunakan validasi berikut saat store dan update:

```php
$request->validate([
    'title' => ['required', 'string', 'max:180'],
    'slug' => ['nullable', 'string', 'max:200'],
    'excerpt' => ['nullable', 'string', 'max:280'],
    'content' => ['required', 'string'],
    'category' => ['nullable', 'string', 'max:80'],
    'thumbnail' => ['nullable', 'image', 'max:2048'],
    'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
    'published_at' => ['nullable', 'date'],
]);
```

Aturan tambahan:

- `slug` harus unique.
- Jika slug kosong, buat otomatis dari title.
- Jika artikel published tetapi `published_at` kosong, isi otomatis dengan `now()`.
- Jika status bukan published, `published_at` boleh dibuat `null`.

---

## Upload Thumbnail

Thumbnail disimpan ke disk public.

```php
if ($request->hasFile('thumbnail')) {
    $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
}
```

Saat update, hapus thumbnail lama jika ada:

```php
if ($article->thumbnail) {
    Storage::disk('public')->delete($article->thumbnail);
}
```

Saat hapus artikel, hapus juga thumbnail:

```php
if ($article->thumbnail) {
    Storage::disk('public')->delete($article->thumbnail);
}
```

Setelah implementasi upload gambar, jalankan:

```bash
php artisan storage:link
```

---

## Halaman Index Artikel

File:

```txt
resources/views/admin/articles/index.blade.php
```

Halaman index harus berisi:

1. Card statistik
2. Header panel
3. Tombol tambah artikel
4. Form search dan filter status
5. Table artikel
6. Pagination

Kolom table:

```txt
Artikel
Kategori
Status
Publikasi
Aksi
```

Aksi:

```txt
Lihat
Edit
Hapus
```

Status badge:

```txt
Published = hijau lembut
Draft = kuning lembut
Archived = abu-abu lembut
```

Jika artikel kosong, tampilkan empty state:

```txt
Belum ada artikel.
Mulai dengan membuat artikel pertama untuk berita atau kegiatan Ma’had.
```

---

## Form Artikel

File partial:

```txt
resources/views/admin/articles/_form.blade.php
```

Form dipakai ulang oleh create dan edit.

Field form:

```txt
title
slug
excerpt
content
category
status
published_at
thumbnail
```

Form harus memiliki:

```blade
@csrf
```

Pada halaman edit:

```blade
@method('PUT')
```

Form harus memakai:

```blade
enctype="multipart/form-data"
```

untuk mendukung upload thumbnail.

---

## Halaman Create

File:

```txt
resources/views/admin/articles/create.blade.php
```

Isi:

```blade
@extends('layouts.admin')

@section('page_title', 'Tambah Artikel')

@section('content')
<section class="admin-panel">
    <div class="admin-panel__header">
        <div>
            <h2>Tambah Artikel Baru</h2>
            <p>Buat artikel berita, kegiatan, atau informasi untuk halaman website.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
        @include('admin.articles._form', [
            'article' => $article,
            'submitLabel' => 'Simpan Artikel'
        ])
    </form>
</section>
@endsection
```

---

## Halaman Edit

File:

```txt
resources/views/admin/articles/edit.blade.php
```

Isi:

```blade
@extends('layouts.admin')

@section('page_title', 'Edit Artikel')

@section('content')
<section class="admin-panel">
    <div class="admin-panel__header">
        <div>
            <h2>Edit Artikel</h2>
            <p>Perbarui isi, status, kategori, atau thumbnail artikel.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data">
        @method('PUT')

        @include('admin.articles._form', [
            'article' => $article,
            'submitLabel' => 'Update Artikel'
        ])
    </form>
</section>
@endsection
```

---

## Halaman Detail

File:

```txt
resources/views/admin/articles/show.blade.php
```

Halaman detail harus menampilkan:

- judul
- ringkasan
- thumbnail
- status
- kategori
- tanggal publikasi
- isi artikel
- tombol edit

Untuk isi artikel sederhana:

```blade
{!! nl2br(e($article->content)) !!}
```

Catatan:

- Cara ini aman karena teks tetap di-escape.
- Jika nanti memakai editor HTML seperti Trix/TinyMCE, sanitasi konten harus diperhatikan.

---

## CSS Admin

File:

```txt
resources/css/admin.css
```

Desain CSS harus mencakup:

- sidebar fixed di desktop
- layout responsive
- card statistik
- panel putih
- table artikel
- form input
- button
- badge status
- alert
- empty state
- preview thumbnail

Class utama:

```txt
admin-body
admin-sidebar
admin-brand
admin-menu
admin-shell
admin-topbar
admin-main
admin-panel
admin-stats
admin-stat-card
admin-filter
admin-table
article-cell
status-badge
admin-form-grid
admin-form-main
admin-form-side
admin-field
admin-btn
```

---

## Contoh CSS Minimal

```css
.admin-body {
    margin: 0;
    min-height: 100vh;
    background: var(--admin-cream);
    color: var(--admin-dark);
    font-family: "Plus Jakarta Sans", Inter, system-ui, sans-serif;
}

.admin-sidebar {
    position: fixed;
    inset: 24px auto 24px 24px;
    width: 260px;
    padding: 22px;
    background: var(--admin-white);
    border-radius: 28px;
    box-shadow: 0 20px 60px rgba(16, 36, 24, 0.08);
}

.admin-shell {
    margin-left: 308px;
    padding: 24px 28px 48px;
}

.admin-panel {
    background: var(--admin-white);
    border-radius: 28px;
    padding: 24px;
    box-shadow: 0 20px 60px rgba(16, 36, 24, 0.06);
}

.admin-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 44px;
    padding: 0 18px;
    border-radius: 999px;
    border: 0;
    cursor: pointer;
    font-weight: 800;
    text-decoration: none;
}

.admin-btn--primary {
    background: var(--admin-primary);
    color: var(--admin-white);
}
```

Responsive:

```css
@media (max-width: 1024px) {
    .admin-sidebar {
        position: static;
        width: auto;
        margin: 16px;
    }

    .admin-shell {
        margin-left: 0;
        padding: 0 16px 36px;
    }

    .admin-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .admin-form-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 720px) {
    .admin-panel__header,
    .admin-topbar {
        align-items: stretch;
        flex-direction: column;
    }

    .admin-stats,
    .admin-filter {
        grid-template-columns: 1fr;
    }
}
```

---

## UX Dashboard

Dashboard harus mudah dipakai admin sekolah.

Prinsip UX:

- tombol utama selalu jelas
- jangan terlalu banyak menu
- form tidak terlalu panjang secara visual
- field penting diletakkan di kiri
- status, kategori, tanggal, dan thumbnail diletakkan di kanan
- table harus bisa scroll horizontal di layar kecil
- tombol hapus harus memakai konfirmasi
- setelah berhasil simpan/update/hapus, tampilkan alert sukses

Contoh konfirmasi hapus:

```blade
onsubmit="return confirm('Hapus artikel ini?')"
```

---

## Integrasi Artikel ke Website Publik

Untuk menampilkan artikel published di homepage:

```php
$latestArticles = Article::published()
    ->latest('published_at')
    ->take(3)
    ->get();
```

Untuk halaman daftar berita publik:

```php
$articles = Article::published()
    ->latest('published_at')
    ->paginate(9);
```

Untuk detail artikel publik, gunakan slug:

```php
Route::get('/berita/{article:slug}', [PublicArticleController::class, 'show'])
    ->name('articles.show');
```

---

## Tahapan Implementasi

### Tahap 1 — CRUD Dasar

Target:

- migration
- model
- route resource
- controller
- views CRUD
- upload thumbnail
- dashboard index

### Tahap 2 — Auth Admin

Tambahkan:

- Laravel Breeze atau starter kit auth lain
- middleware auth untuk route admin
- role sederhana jika dibutuhkan

### Tahap 3 — Public Article Page

Tambahkan:

- halaman berita
- halaman detail berita
- artikel terbaru di homepage
- artikel terkait

### Tahap 4 — Editor Konten

Tambahkan editor:

- Trix
- TinyMCE
- CKEditor
- TipTap

Pastikan konten HTML disanitasi jika editor mengizinkan HTML.

### Tahap 5 — SEO

Tambahkan:

- meta title
- meta description
- slug rapi
- gambar thumbnail optimized
- Open Graph image jika diperlukan

---

## Perintah Artisan yang Sering Dipakai

Membuat model, migration, controller:

```bash
php artisan make:model Article -m
php artisan make:controller Admin/ArticleController --resource
```

Menjalankan migration:

```bash
php artisan migrate
```

Membuat storage link:

```bash
php artisan storage:link
```

Menjalankan server lokal:

```bash
php artisan serve
```

Menjalankan Vite:

```bash
npm run dev
```

---

## Checklist Selesai

Pastikan:

- route `/admin/articles` bisa dibuka
- artikel bisa dibuat
- artikel bisa diedit
- artikel bisa dihapus
- thumbnail bisa diupload
- thumbnail tampil di table
- status artikel berfungsi
- artikel published memiliki tanggal publikasi
- search berfungsi
- filter status berfungsi
- pagination tampil
- tampilan responsive
- CSS admin tidak merusak CSS website publik
- route admin sudah dilindungi auth jika website sudah live

---

## Catatan Gaya untuk Website Ma’had

Admin dashboard tidak perlu terlalu dekoratif.

Yang penting:

```txt
cepat dipakai + mudah dibaca + aman + rapi + konsisten
```

Gunakan nuansa Islami hanya sebagai aksen:

- warna hijau
- cream lembut
- icon sederhana
- radius besar
- shadow halus

Jangan gunakan terlalu banyak ornamen di dashboard admin.
Ornamen lebih cocok untuk website publik, bukan halaman admin.
