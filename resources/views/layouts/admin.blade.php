<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Ma’had' }}</title>

    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
</head>
<body class="mahad-admin-body">
    <aside class="mahad-admin-sidebar">
        <a href="{{ route('mahad-admin.dashboard') }}" class="mahad-admin-brand">
            <span class="mahad-admin-brand__mark">م</span>
            <span>
                <strong>Admin Ma’had</strong>
                <small>Panel Artikel</small>
            </span>
        </a>

        <nav class="mahad-admin-menu">
            <a href="{{ route('mahad-admin.articles.index') }}" class="mahad-admin-menu__link {{ request()->routeIs('mahad-admin.articles.*') ? 'is-active' : '' }}">
                Artikel
            </a>
            <a href="{{ route('mahad-admin.articles.index', ['status' => 'published']) }}" class="mahad-admin-menu__link">
                Pengumuman
            </a>
            <a href="{{ route('mahad-admin.gallery.index') }}" class="mahad-admin-menu__link {{ request()->routeIs('mahad-admin.gallery.*') ? 'is-active' : '' }}">
                Galeri
            </a>
            <a href="{{ route('home') }}" class="mahad-admin-menu__link">
                Lihat Website
            </a>
            @superAdmin
                <a href="{{ route('dashboard') }}" class="mahad-admin-menu__link">
                    Admin Absensi
                </a>
            @endsuperAdmin
        </nav>
    </aside>

    <div class="mahad-admin-shell">
        <header class="mahad-admin-topbar">
            <div>
                <p class="mahad-admin-kicker">Dashboard</p>
                <h1>@yield('page_title', 'Admin')</h1>
            </div>

            <div class="mahad-admin-user">
                <span class="mahad-admin-user__avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                <span>{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
        </header>

        <main class="mahad-admin-main">
            @if(session('success'))
                <div class="mahad-admin-alert mahad-admin-alert--success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mahad-admin-alert mahad-admin-alert--danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.tinymce) {
                return;
            }

            tinymce.init({
                selector: 'textarea.mahad-rich-editor',
                height: 520,
                menubar: 'file edit view insert format tools table help',
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
                toolbar: 'undo redo | blocks | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | removeformat code fullscreen',
                branding: false,
                promotion: false,
                object_resizing: true,
                image_advtab: true,
                image_caption: true,
                image_dimensions: true,
                automatic_uploads: true,
                images_upload_url: '{{ route('mahad-admin.articles.trix-attachments.store') }}',
                images_upload_credentials: true,
                convert_urls: false,
                relative_urls: false,
                remove_script_host: false,
                content_style: 'body{font-family:Plus Jakarta Sans,Arial,sans-serif;font-size:16px;line-height:1.8;color:#253b2d} img{max-width:100%;height:auto;border-radius:16px} blockquote{border-left:4px solid #c9a227;background:#fff7d6;border-radius:12px;margin:1rem 0;padding:.8rem 1rem} h1,h2,h3{color:#14532d;line-height:1.35}',
                images_upload_handler: function (blobInfo) {
                    return new Promise(function (resolve, reject) {
                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());

                        fetch('{{ route('mahad-admin.articles.trix-attachments.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            body: formData,
                        })
                            .then(function (response) {
                                if (!response.ok) {
                                    throw new Error('Upload gagal.');
                                }

                                return response.json();
                            })
                            .then(function (data) {
                                resolve(data.location || data.url);
                            })
                            .catch(function () {
                                reject('Gambar gagal diupload. Pastikan ukuran maksimal 3MB.');
                            });
                    });
                },
            });
        });
    </script>
</body>
</html>
