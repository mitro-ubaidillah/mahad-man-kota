# SKILL.md — Website Ma’had / Asrama Islam Sekolah Laravel

## Tujuan Proyek

Buat website profil Ma’had / Asrama Islam Sekolah dengan konsep:

- Islami
- minimalis
- modern
- hangat
- edukatif
- tidak bergantung pada foto bangunan asli
- menggunakan ilustrasi sebagai identitas visual utama
- mudah dikembangkan dengan Laravel

Website ini terinspirasi dari gaya website instansi resmi seperti Kemenag, tetapi dibuat lebih ringan, bersih, unik, dan cocok untuk ma’had/asrama sekolah.

---

## Arah Visual Utama

### Karakter Desain

Website harus terasa:

- tenang
- rapi
- islami
- amanah
- ramah untuk orang tua santri
- menarik untuk calon santri
- profesional untuk sekolah

Hindari desain yang terlalu ramai, terlalu banyak warna, terlalu banyak dekorasi, atau terlalu mirip portal berita pemerintah.

### Warna Utama

Gunakan warna yang lembut dan Islami.

Rekomendasi palet:

```css
--color-primary: #14532d;
--color-primary-soft: #dff3e6;
--color-secondary: #c9a227;
--color-cream: #f8f5ec;
--color-dark: #102418;
--color-muted: #6b7280;
--color-white: #ffffff;
```

Catatan:

- Hijau tua dipakai untuk tombol, heading penting, dan identitas utama.
- Cream dipakai untuk background agar tidak terlalu putih polos.
- Emas hanya sebagai aksen kecil, jangan dominan.
- Abu-abu dipakai untuk teks deskripsi.

### Font

Gunakan font yang bersih dan mudah dibaca.

Rekomendasi:

- Heading: `Playfair Display`, `Merriweather`, atau `Cormorant Garamond`
- Body: `Inter`, `Nunito Sans`, atau `Plus Jakarta Sans`

Jika ingin sangat modern, gunakan:

```css
font-family: 'Plus Jakarta Sans', sans-serif;
```

Untuk heading yang lebih elegan:

```css
font-family: 'Merriweather', serif;
```

---

## Konsep Ilustrasi

Karena ma’had/asrama belum memiliki bangunan sendiri, jangan gunakan foto gedung palsu. Gunakan ilustrasi sebagai identitas utama.

### Gaya Ilustrasi

Ilustrasi harus:

- flat/semi-flat
- lembut
- tidak terlalu kartun anak-anak
- tetap elegan
- bernuansa pesantren/ma’had
- ada elemen alam
- ada nuansa belajar Al-Qur’an
- tidak terlalu ramai

### Elemen Ilustrasi yang Cocok

Gunakan elemen berikut:

- santri sedang halaqah
- guru/ustadz membimbing
- kitab atau mushaf
- gazebo/pendopo sederhana
- taman hijau
- siluet masjid jauh
- ornamen geometri Islam tipis
- cahaya pagi/sore yang lembut
- daun, bunga kecil, jalan setapak

### Elemen yang Harus Dihindari

Hindari:

- gedung sekolah besar yang tidak nyata
- foto orang asli
- ilustrasi terlalu mewah
- masjid terlalu dominan
- detail wajah terlalu realistis
- tulisan di dalam gambar
- tombol di dalam gambar
- navbar di dalam gambar
- card berita di dalam gambar

### Aturan Hero Banner

Hero banner hanya boleh berisi ilustrasi/background.

Jangan masukkan elemen yang bisa dibuat dengan kode, seperti:

- judul
- subtitle
- tombol
- navbar
- logo
- card
- quote box
- slider dots
- icon fitur
- pengumuman
- berita

Komponen tersebut harus dibuat dengan HTML, Blade, dan CSS.

### Spesifikasi Banner

Rekomendasi ukuran:

```txt
1920 x 720 px
```

Atau rasio:

```txt
8:3
```

Format:

```txt
PNG atau WebP
```

Area kiri banner sebaiknya lebih kosong agar bisa dipasang teks dengan CSS.

Area kanan banner boleh berisi ilustrasi utama, misalnya santri sedang halaqah.

---

## Struktur Halaman Website

### Halaman Utama

Urutan section:

1. Navbar
2. Hero Section
3. Fitur Utama Ma’had
4. Tentang Ma’had
5. Program Pembinaan
6. Kehidupan Santri
7. Jadwal Harian
8. Berita / Kegiatan Terbaru
9. Pengumuman
10. Galeri
11. CTA Pendaftaran
12. Footer

---

## Komponen Website

### Navbar

Isi menu:

- Beranda
- Profil
- Program
- Kehidupan Ma’had
- Berita
- Galeri
- Kontak
- PPDB

Style:

- background putih/transparan
- sticky di atas
- shadow tipis saat scroll
- tombol PPDB warna hijau tua
- logo sederhana
- mobile menu hamburger

### Hero Section

Hero terdiri dari:

- background ilustrasi
- overlay gradient lembut dari kiri ke kanan
- judul besar
- deskripsi pendek
- tombol utama
- tombol sekunder

Contoh copywriting:

```txt
Membentuk Generasi Berilmu dan Berakhlak
```

Deskripsi:

```txt
Lingkungan pembinaan Islam yang hangat, terarah, dan mendukung tumbuhnya karakter santri.
```

Tombol:

```txt
Tentang Ma’had
Lihat Program
```

### Fitur Utama

Gunakan 4 card:

1. Tahfidz Al-Qur’an
2. Pembinaan Akhlak
3. Kegiatan Santri
4. Lingkungan Islami

Style:

- card putih
- border tipis
- icon line hijau
- hover naik sedikit
- radius 20px

### Tentang Ma’had

Isi:

- deskripsi singkat
- visi
- misi
- nilai utama

Nilai utama:

- Ikhlas
- Disiplin
- Mandiri
- Beradab
- Bermanfaat

### Program Pembinaan

Contoh program:

- Tahfidz dan Tahsin
- Kajian Adab dan Akhlak
- Pembiasaan Ibadah
- Bahasa Arab Dasar
- Kemandirian Santri
- Mentoring Akademik

Tiap program dibuat sebagai card sederhana.

### Kehidupan Santri

Section ini menjelaskan suasana harian santri.

Bisa berisi:

- Shalat berjamaah
- Halaqah Al-Qur’an
- Belajar malam
- Kegiatan kebersihan
- Olahraga
- Muhadharah
- Kajian rutin

Gunakan ilustrasi kecil atau foto kegiatan asli jika nanti sudah tersedia.

### Jadwal Harian

Tampilkan sebagai timeline vertikal.

Contoh:

```txt
04.00 — Bangun dan persiapan shalat
04.30 — Shalat Subuh berjamaah
05.00 — Halaqah Al-Qur’an
06.00 — Persiapan sekolah
07.00 — Kegiatan belajar sekolah
16.00 — Kegiatan sore
18.00 — Maghrib dan kajian
20.00 — Belajar malam
22.00 — Istirahat
```

### Berita / Kegiatan

Card berita berisi:

- gambar
- tanggal
- judul
- ringkasan
- tombol baca

Untuk awal proyek, gunakan data dummy dari controller atau array config.

### Pengumuman

Card pengumuman harus lebih sederhana dari berita.

Contoh:

- Pendaftaran Santri Baru
- Jadwal Tes Seleksi
- Daftar Perlengkapan Santri
- Informasi Pembayaran

### Galeri

Gunakan grid 3 kolom di desktop, 2 kolom di tablet, 1 kolom di mobile.

Jika belum ada foto asli, gunakan ilustrasi sementara.

### CTA Pendaftaran

Section ajakan:

```txt
Siap Menjadi Bagian dari Ma’had Kami?
```

Tombol:

```txt
Daftar Sekarang
Hubungi Admin
```

### Footer

Isi footer:

- nama ma’had
- alamat sekolah
- kontak
- sosial media
- link cepat
- copyright

---

## Struktur Laravel yang Disarankan

Gunakan Blade component agar rapi.

```txt
resources/views/
├── layouts/
│   └── app.blade.php
├── pages/
│   ├── home.blade.php
│   ├── profile.blade.php
│   ├── programs.blade.php
│   ├── news.blade.php
│   ├── gallery.blade.php
│   └── contact.blade.php
├── components/
│   ├── navbar.blade.php
│   ├── footer.blade.php
│   ├── hero.blade.php
│   ├── section-title.blade.php
│   ├── feature-card.blade.php
│   ├── program-card.blade.php
│   ├── news-card.blade.php
│   └── announcement-card.blade.php
```

Asset frontend:

```txt
resources/
├── css/
│   └── app.css
├── js/
│   └── app.js
└── images/
    ├── hero/
    ├── illustrations/
    ├── icons/
    └── gallery/
```

Public assets jika ingin langsung dipanggil dengan `asset()`:

```txt
public/
└── assets/
    ├── images/
    ├── icons/
    └── logo/
```

---

## Routing Laravel

Gunakan route sederhana terlebih dahulu.

```php
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/profil', 'pages.profile')->name('profile');
Route::view('/program', 'pages.programs')->name('programs');
Route::view('/berita', 'pages.news')->name('news');
Route::view('/galeri', 'pages.gallery')->name('gallery');
Route::view('/kontak', 'pages.contact')->name('contact');
```

Jika nanti sudah memakai database, pindahkan logic ke controller.

---

## Layout Blade Dasar

`resources/views/layouts/app.blade.php`

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Ma’had Islam Sekolah' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar />

    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <x-footer />
</body>
</html>
```

---

## Contoh Hero Blade

`resources/views/components/hero.blade.php`

```blade
<section class="hero">
    <div class="hero__overlay"></div>

    <div class="hero__content">
        <span class="hero__label">Asrama Islam Sekolah</span>

        <h1>Membentuk Generasi Berilmu dan Berakhlak</h1>

        <p>
            Lingkungan pembinaan Islam yang hangat, terarah,
            dan mendukung tumbuhnya karakter santri.
        </p>

        <div class="hero__actions">
            <a href="{{ route('profile') }}" class="btn btn-primary">Tentang Ma’had</a>
            <a href="{{ route('programs') }}" class="btn btn-outline">Lihat Program</a>
        </div>
    </div>
</section>
```

---

## CSS Hero

```css
.hero {
    position: relative;
    min-height: 620px;
    border-radius: 32px;
    overflow: hidden;
    background-image: url('/assets/images/hero/hero-mahad.png');
    background-size: cover;
    background-position: center right;
    margin: 24px auto;
    max-width: 1440px;
}

.hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(248, 245, 236, 0.96) 0%,
        rgba(248, 245, 236, 0.78) 35%,
        rgba(248, 245, 236, 0.25) 65%,
        rgba(248, 245, 236, 0.05) 100%
    );
}

.hero__content {
    position: relative;
    z-index: 2;
    max-width: 620px;
    padding: 96px 72px;
}

.hero__label {
    display: inline-block;
    margin-bottom: 20px;
    color: var(--color-primary);
    font-weight: 600;
}

.hero h1 {
    font-family: 'Merriweather', serif;
    font-size: clamp(2.5rem, 5vw, 5rem);
    line-height: 1.1;
    color: var(--color-primary);
    margin-bottom: 24px;
}

.hero p {
    font-size: 1.125rem;
    line-height: 1.8;
    color: var(--color-muted);
    margin-bottom: 32px;
}

.hero__actions {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}
```

---

## Button CSS

```css
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 48px;
    padding: 0 24px;
    border-radius: 999px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.25s ease;
}

.btn-primary {
    background: var(--color-primary);
    color: var(--color-white);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 16px 32px rgba(20, 83, 45, 0.18);
}

.btn-outline {
    border: 1px solid var(--color-primary);
    color: var(--color-primary);
    background: rgba(255, 255, 255, 0.6);
}

.btn-outline:hover {
    background: var(--color-primary);
    color: var(--color-white);
}
```

---

## Responsive Rules

### Desktop

- max width content: 1200–1440px
- hero tinggi 560–680px
- card 3–4 kolom

### Tablet

- navbar disederhanakan
- hero content max 70%
- card 2 kolom

### Mobile

- hero jangan terlalu tinggi
- teks di atas gambar tetap jelas
- navbar jadi hamburger
- semua card jadi 1 kolom
- padding section lebih kecil

Contoh CSS mobile:

```css
@media (max-width: 768px) {
    .hero {
        min-height: 560px;
        border-radius: 24px;
        background-position: center right;
    }

    .hero__overlay {
        background: linear-gradient(
            180deg,
            rgba(248, 245, 236, 0.98) 0%,
            rgba(248, 245, 236, 0.82) 48%,
            rgba(248, 245, 236, 0.25) 100%
        );
    }

    .hero__content {
        padding: 48px 28px;
    }
}
```

---

## Konten Awal Website

### Nama Sementara

Gunakan nama placeholder:

```txt
Ma’had Al-Ikhlas
```

Nama bisa diganti kapan saja.

### Tagline

Pilihan tagline:

```txt
Membentuk Generasi Berilmu dan Berakhlak
```

Alternatif:

```txt
Tumbuh dalam Ilmu, Adab, dan Ketaatan
```

```txt
Lingkungan Islami untuk Membina Generasi Qur’ani
```

### Deskripsi Singkat

```txt
Ma’had kami hadir sebagai lingkungan pembinaan Islam yang membantu santri tumbuh dalam ilmu, adab, ibadah, dan kemandirian.
```

---

## Aturan Copywriting

Gunakan bahasa yang:

- formal tapi hangat
- mudah dipahami orang tua
- tidak terlalu promosi berlebihan
- tidak terlalu kaku seperti dokumen pemerintah
- mengedepankan pembinaan, adab, ilmu, dan lingkungan Islami

Hindari kalimat seperti:

```txt
Kami adalah lembaga terbaik dan nomor satu.
```

Gunakan kalimat seperti:

```txt
Kami berikhtiar menghadirkan lingkungan pembinaan yang terarah, nyaman, dan bernilai Islami.
```

---

## SEO Dasar

Gunakan title dan meta description yang jelas.

Contoh:

```html
<title>Ma’had Al-Ikhlas - Asrama Islam Sekolah</title>
<meta name="description" content="Website resmi Ma’had Al-Ikhlas, asrama Islam sekolah dengan pembinaan Al-Qur’an, adab, ibadah, dan kemandirian santri.">
```

Gunakan heading berurutan:

```txt
H1: hanya satu di hero
H2: judul section
H3: judul card
```

---

## Data Dummy Awal

Sebelum memakai database, data boleh disimpan dalam array di controller atau langsung di Blade.

Contoh data fitur:

```php
$features = [
    [
        'title' => 'Tahfidz Al-Qur’an',
        'description' => 'Menghafal dan memahami Al-Qur’an dengan bimbingan yang terarah.',
        'icon' => 'book-open',
    ],
    [
        'title' => 'Pembinaan Akhlak',
        'description' => 'Membentuk karakter mulia berdasarkan Al-Qur’an dan Sunnah.',
        'icon' => 'users',
    ],
    [
        'title' => 'Kegiatan Santri',
        'description' => 'Aktivitas bermanfaat untuk mengembangkan potensi diri.',
        'icon' => 'sparkles',
    ],
    [
        'title' => 'Lingkungan Islami',
        'description' => 'Suasana asrama yang nyaman, bersih, dan mendukung ibadah.',
        'icon' => 'leaf',
    ],
];
```

---

## Tahapan Pengerjaan

### Tahap 1 — Static Landing Page

Target:

- navbar
- hero
- fitur
- tentang singkat
- program
- berita dummy
- footer

Belum perlu database.

### Tahap 2 — Multi Page

Tambahkan halaman:

- profil
- program
- berita
- galeri
- kontak

### Tahap 3 — Admin Panel

Tambahkan fitur:

- login admin
- CRUD berita
- CRUD pengumuman
- CRUD galeri
- CRUD program
- upload gambar

### Tahap 4 — PPDB

Tambahkan:

- form pendaftaran
- upload dokumen
- status pendaftaran
- notifikasi email/WhatsApp jika diperlukan

---

## Prinsip Kode

Ikuti prinsip berikut:

- komponen kecil dan reusable
- jangan ulangi HTML yang sama berkali-kali
- gunakan Blade component
- nama class CSS konsisten
- jangan terlalu banyak library
- prioritaskan performa
- semua gambar harus dioptimasi
- semua halaman harus mobile friendly

---

## Checklist Sebelum Selesai

Pastikan:

- hero banner tidak berisi teks
- teks hero dibuat dari kode
- tombol dibuat dari kode
- navbar dibuat dari kode
- semua section responsive
- warna konsisten
- font konsisten
- gambar tidak pecah
- loading cepat
- konten mudah diganti
- tidak ada teks dummy yang tertinggal
- website terlihat Islami tapi tetap modern

---

## Prompt Gambar Lanjutan

Gunakan prompt ini jika ingin membuat asset ilustrasi tambahan:

```txt
Buat ilustrasi website minimalis untuk Ma’had / Asrama Islam Sekolah. Gaya semi-flat, lembut, modern, Islami, warna hijau tua, cream, dan aksen emas tipis. Tampilkan suasana santri sedang belajar Al-Qur’an bersama ustadz di area taman atau pendopo sederhana. Jangan masukkan teks, tombol, logo, navbar, card, atau elemen UI. Area kiri harus lebih kosong untuk tempat teks HTML. Rasio wide hero banner 1920x720.
```

Prompt untuk section program:

```txt
Buat ilustrasi kecil semi-flat minimalis tentang kegiatan santri Ma’had: tahfidz, halaqah, shalat berjamaah, dan belajar malam. Nuansa Islami modern, warna lembut hijau dan cream. Tanpa teks dan tanpa UI.
```

---

## Catatan Penting

Website ini harus terasa seperti tempat pembinaan yang hidup, bukan sekadar halaman profil resmi.

Kunci visualnya adalah:

```txt
ilustrasi + ruang kosong + warna lembut + komponen rapi + copywriting hangat
```
