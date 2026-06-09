@php
    $features = [
        ['title' => 'Tahfidz Al-Qur’an', 'description' => 'Pendampingan hafalan dan murajaah yang bertahap, ramah, dan terukur.', 'icon' => '☘'],
        ['title' => 'Pembinaan Akhlak', 'description' => 'Pembiasaan adab harian agar santri tumbuh santun, disiplin, dan amanah.', 'icon' => '◌'],
        ['title' => 'Kegiatan Santri', 'description' => 'Ritme harian yang seimbang antara ibadah, belajar, olahraga, dan istirahat.', 'icon' => '✺'],
        ['title' => 'Lingkungan Islami', 'description' => 'Suasana asrama yang hangat untuk membentuk kemandirian dan ukhuwah.', 'icon' => '⌁'],
    ];

    $programs = [
        ['title' => 'Tahfidz dan Tahsin', 'description' => 'Membaca, memperbaiki bacaan, dan menghafal Al-Qur’an dengan target realistis.'],
        ['title' => 'Kajian Adab dan Akhlak', 'description' => 'Penguatan karakter melalui kisah, nasihat, dan praktik adab sehari-hari.'],
        ['title' => 'Pembiasaan Ibadah', 'description' => 'Shalat berjamaah, dzikir, doa harian, dan ibadah sunnah secara bertahap.'],
        ['title' => 'Bahasa Arab Dasar', 'description' => 'Pengenalan mufradat dan ungkapan sederhana untuk mendukung pembelajaran diniyah.'],
        ['title' => 'Kemandirian Santri', 'description' => 'Melatih tanggung jawab pribadi, kebersihan, kerapian, dan manajemen waktu.'],
        ['title' => 'Mentoring Akademik', 'description' => 'Pendampingan belajar malam agar kegiatan sekolah tetap terarah.'],
    ];

    $schedules = [
        '04.00' => 'Bangun dan persiapan shalat',
        '04.30' => 'Shalat Subuh berjamaah',
        '05.00' => 'Halaqah Al-Qur’an',
        '06.00' => 'Persiapan sekolah',
        '07.00' => 'Kegiatan belajar sekolah',
        '16.00' => 'Kegiatan sore dan kebersihan',
        '18.00' => 'Maghrib dan kajian',
        '20.00' => 'Belajar malam',
        '22.00' => 'Istirahat',
    ];

    $fallbackNews = [
        ['date' => '12 Rajab 1447 H', 'title' => 'Halaqah Pekanan Santri', 'description' => 'Santri mengikuti halaqah tematik tentang adab menuntut ilmu dan menjaga waktu.'],
        ['date' => '18 Rajab 1447 H', 'title' => 'Kegiatan Kebersihan Asrama', 'description' => 'Pembiasaan kebersihan lingkungan dilakukan bersama untuk menumbuhkan tanggung jawab.'],
        ['date' => '25 Rajab 1447 H', 'title' => 'Muhadharah Malam Jumat', 'description' => 'Latihan keberanian berbicara dan menyampaikan nasihat di hadapan teman sebaya.'],
    ];

    $fallbackAnnouncements = [
        ['title' => 'Pendaftaran Santri Baru', 'description' => 'Informasi jadwal dan alur pendaftaran akan diumumkan melalui halaman ini.'],
        ['title' => 'Jadwal Tes Seleksi', 'description' => 'Calon santri akan mengikuti tes dasar membaca Al-Qur’an dan wawancara ringan.'],
        ['title' => 'Perlengkapan Santri', 'description' => 'Daftar perlengkapan akan diberikan setelah calon santri dinyatakan diterima.'],
    ];
@endphp

<x-public-layout title="Ma’had Islam Sekolah - Membentuk Generasi Berilmu dan Berakhlak">
    <section class="hero-section">
        <img src="{{ asset('images/banner.png') }}" alt="Ilustrasi suasana Ma'had" class="hero-section__image" />
        <div class="hero-section__overlay"></div>
        <div class="hero-section__inner">
            <div class="hero-section__content">
                <span class="hero-section__label">
                    <span class="hero-section__label-icon"></span>
                    Asrama Islam Sekolah
                </span>
                <h1 class="hero-section__title">Membentuk Generasi Berilmu dan Berakhlak</h1>
                <p>Ma’had kami menghadirkan lingkungan pembinaan yang islami, hangat, dan bertumbuh untuk para santri.</p>
                <div class="hero-section__actions">
                    <a href="{{ route('public.profile') }}" class="btn-primary">Tentang Ma’had <span aria-hidden="true">-></span></a>
                    <a href="{{ route('public.programs') }}" class="btn-outline">Lihat Program <span aria-hidden="true">-></span></a>
                </div>
            </div>
            <div class="hero-section__summary">
                <div class="hero-section__quote-mark" aria-hidden="true">“</div>
                <p>"Sebaik-baik kalian adalah yang belajar Al-Qur’an dan mengajarkannya." <strong>(HR. Bukhari)</strong></p>
                <div class="hero-section__summary-divider"></div>
                <div class="hero-section__focus">
                    <span aria-hidden="true">⌁</span>
                    <p>Fokus pada pembinaan ilmu, akhlak, dan kemandirian <strong>setiap hari.</strong></p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <x-public.section-heading
            eyebrow="Fitur Utama"
            title="Pembinaan yang lembut, terarah, dan dekat dengan keseharian santri"
            description="Setiap program dirancang agar santri tidak hanya belajar, tetapi juga tumbuh dalam adab dan kemandirian."
        />
        <div class="feature-grid">
            @foreach ($features as $feature)
                <x-public.feature-card :title="$feature['title']" :description="$feature['description']">
                    <x-slot:icon>{{ $feature['icon'] }}</x-slot:icon>
                </x-public.feature-card>
            @endforeach
        </div>
    </section>

    <section class="section section--cream about-preview">
        <div class="about-preview__text">
            <x-public.section-heading
                align="left"
                eyebrow="Tentang Ma’had"
                title="Tempat bertumbuh dengan ilmu, ibadah, dan suasana kekeluargaan"
                description="Ma’had hadir sebagai ruang pembinaan yang membantu santri membangun kebiasaan baik melalui jadwal harian yang tertib dan pendampingan yang dekat."
            />
            <div class="value-list">
                @foreach (['Ikhlas', 'Disiplin', 'Mandiri', 'Beradab', 'Bermanfaat'] as $value)
                    <span>{{ $value }}</span>
                @endforeach
            </div>
            <a href="{{ route('public.profile') }}" class="text-link">Pelajari profil Ma’had</a>
        </div>
        <div class="about-preview__card">
            <strong>Visi</strong>
            <p>Menjadi lingkungan pembinaan Islam yang menumbuhkan generasi berilmu, berakhlak, dan siap memberi manfaat.</p>
            <strong>Misi</strong>
            <p>Mendampingi santri melalui pembiasaan ibadah, halaqah Al-Qur’an, adab harian, dan budaya belajar yang sehat.</p>
        </div>
    </section>

    <section class="section">
        <x-public.section-heading
            eyebrow="Program Pembinaan"
            title="Program sederhana yang menyentuh rutinitas santri"
            description="Konten awal ini bisa diganti menjadi program resmi sekolah saat data final sudah tersedia."
        />
        <div class="program-grid">
            @foreach ($programs as $program)
                <x-public.program-card :title="$program['title']" :description="$program['description']" />
            @endforeach
        </div>
    </section>

    <section class="section section--split">
        <div>
            <x-public.section-heading
                align="left"
                eyebrow="Kehidupan Santri"
                title="Hari-hari yang dibangun dari kebiasaan kecil"
                description="Santri dibiasakan mengikuti ritme harian yang menenangkan: ibadah, belajar, halaqah, kebersihan, olahraga, dan waktu istirahat yang cukup."
            />
            <div class="life-tags">
                @foreach (['Shalat berjamaah', 'Halaqah Al-Qur’an', 'Belajar malam', 'Kebersihan', 'Olahraga', 'Muhadharah', 'Kajian rutin'] as $life)
                    <span>{{ $life }}</span>
                @endforeach
            </div>
        </div>

        <div class="timeline-card">
            <h3>Jadwal Harian</h3>
            @foreach ($schedules as $time => $activity)
                <div class="timeline-item">
                    <time>{{ $time }}</time>
                    <p>{{ $activity }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section section--cream">
        <x-public.section-heading
            eyebrow="Berita dan Pengumuman"
            title="Kabar terbaru dari lingkungan Ma’had"
            description="Informasi terbaru seputar kegiatan, kabar resmi, dan pengumuman penting Ma’had."
        />
        <div class="news-grid">
            @forelse ($latestNews as $article)
                <x-public.news-card
                    :date="$article->published_at?->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y')"
                    :title="$article->title"
                    :description="$article->excerpt ?: Str::limit(strip_tags($article->content), 140)"
                    :url="$article->publicUrl()"
                    :thumbnail="$article->thumbnail ? Storage::url($article->thumbnail) : null"
                    :category="$article->category"
                />
            @empty
                @foreach ($fallbackNews as $item)
                    <x-public.news-card :date="$item['date']" :title="$item['title']" :description="$item['description']" />
                @endforeach
            @endforelse
        </div>

        <div class="announcement-grid">
            @forelse ($latestAnnouncements as $announcement)
                <x-public.announcement-card
                    :title="$announcement->title"
                    :description="$announcement->excerpt ?: Str::limit(strip_tags($announcement->content), 140)"
                />
            @empty
                @foreach ($fallbackAnnouncements as $announcement)
                    <x-public.announcement-card :title="$announcement['title']" :description="$announcement['description']" />
                @endforeach
            @endforelse
        </div>
    </section>

    <section class="section gallery-preview">
        <x-public.section-heading
            eyebrow="Galeri"
            title="Ilustrasi suasana Ma’had"
            description="Cuplikan kegiatan dan suasana pembinaan yang diambil dari galeri Ma’had."
        />
        <div class="gallery-grid">
            @forelse ($galleryItems as $galleryItem)
                <figure>
                    @if ($galleryItem->thumbnail)
                        <img src="{{ Storage::url($galleryItem->thumbnail) }}" alt="Galeri {{ $galleryItem->title }}">
                    @else
                        <span></span>
                    @endif
                    <figcaption>{{ $galleryItem->title }}</figcaption>
                </figure>
            @empty
                @foreach (['Halaqah pagi', 'Kajian adab', 'Belajar malam', 'Kegiatan kebersihan', 'Olahraga santri', 'Muhadharah'] as $caption)
                    <figure>
                        <span></span>
                        <figcaption>{{ $caption }}</figcaption>
                    </figure>
                @endforeach
            @endforelse
        </div>
    </section>

    <section class="cta-section">
        <span>PPDB Ma’had</span>
        <h2>Siap menjadi bagian dari Ma’had kami?</h2>
        <p>Hubungi admin untuk informasi pendaftaran, kunjungan, dan konsultasi kebutuhan santri.</p>
        <div>
            <a href="{{ route('public.contact') }}" class="btn-primary">Hubungi Admin</a>
            <a href="{{ route('login') }}" class="btn-outline btn-outline--light">Masuk Admin</a>
        </div>
    </section>
</x-public-layout>
