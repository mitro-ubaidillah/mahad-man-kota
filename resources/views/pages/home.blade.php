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

    $news = [
        ['date' => '12 Rajab 1447 H', 'title' => 'Halaqah Pekanan Santri', 'description' => 'Santri mengikuti halaqah tematik tentang adab menuntut ilmu dan menjaga waktu.'],
        ['date' => '18 Rajab 1447 H', 'title' => 'Kegiatan Kebersihan Asrama', 'description' => 'Pembiasaan kebersihan lingkungan dilakukan bersama untuk menumbuhkan tanggung jawab.'],
        ['date' => '25 Rajab 1447 H', 'title' => 'Muhadharah Malam Jumat', 'description' => 'Latihan keberanian berbicara dan menyampaikan nasihat di hadapan teman sebaya.'],
    ];
@endphp

<x-public-layout title="Ma’had Islam Sekolah - Membentuk Generasi Berilmu dan Berakhlak">
    <section class="hero-section">
        <div class="hero-section__content">
            <span class="hero-section__label">Asrama Islam Sekolah</span>
            <h1>Membentuk Generasi Berilmu dan Berakhlak</h1>
            <p>Lingkungan pembinaan Islam yang hangat, terarah, dan mendukung tumbuhnya karakter santri.</p>
            <div class="hero-section__actions">
                <a href="{{ route('public.profile') }}" class="btn-primary">Tentang Ma’had</a>
                <a href="{{ route('public.programs') }}" class="btn-outline">Lihat Program</a>
            </div>
        </div>

        <div class="hero-section__visual" aria-hidden="true">
            <div class="hero-illustration">
                <div class="hero-illustration__sun"></div>
                <div class="hero-illustration__mosque"></div>
                <div class="hero-illustration__tree hero-illustration__tree--left"></div>
                <div class="hero-illustration__tree hero-illustration__tree--right"></div>
                <div class="hero-illustration__gazebo">
                    <span></span>
                </div>
                <div class="hero-illustration__halaqah">
                    <i></i><i></i><i></i><i></i><i></i>
                </div>
                <div class="hero-illustration__path"></div>
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
            description="Untuk tahap awal, konten dibuat statis agar mudah disesuaikan sebelum memakai database."
        />
        <div class="news-grid">
            @foreach ($news as $item)
                <x-public.news-card :date="$item['date']" :title="$item['title']" :description="$item['description']" />
            @endforeach
        </div>
        <div class="announcement-grid">
            <x-public.announcement-card title="Pendaftaran Santri Baru" description="Informasi jadwal dan alur pendaftaran akan diumumkan melalui halaman ini." />
            <x-public.announcement-card title="Jadwal Tes Seleksi" description="Calon santri akan mengikuti tes dasar membaca Al-Qur’an dan wawancara ringan." />
            <x-public.announcement-card title="Perlengkapan Santri" description="Daftar perlengkapan akan diberikan setelah calon santri dinyatakan diterima." />
        </div>
    </section>

    <section class="section gallery-preview">
        <x-public.section-heading
            eyebrow="Galeri"
            title="Ilustrasi suasana Ma’had"
            description="Sementara belum memakai foto asli, galeri dibuat dengan visual lembut dan aman digunakan."
        />
        <div class="gallery-grid">
            @foreach (['Halaqah pagi', 'Kajian adab', 'Belajar malam', 'Kegiatan kebersihan', 'Olahraga santri', 'Muhadharah'] as $caption)
                <figure>
                    <span></span>
                    <figcaption>{{ $caption }}</figcaption>
                </figure>
            @endforeach
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
