<x-public-layout title="Kehidupan Ma’had - Ma’had Islam Sekolah">
    <section class="page-hero">
        <span>Kehidupan Ma’had</span>
        <h1>Suasana harian yang tertib, ramah, dan mendidik</h1>
        <p>Dari bangun pagi hingga istirahat malam, santri belajar mengelola waktu, menjaga adab, dan hidup bersama.</p>
    </section>

    <section class="section section--split">
        <div class="life-tags life-tags--large">
            @foreach (['Shalat berjamaah', 'Halaqah Al-Qur’an', 'Belajar malam', 'Kegiatan kebersihan', 'Olahraga', 'Muhadharah', 'Kajian rutin', 'Istirahat teratur'] as $life)
                <span>{{ $life }}</span>
            @endforeach
        </div>
        <div class="timeline-card">
            <h3>Ritme Harian</h3>
            @foreach (['04.00 Bangun pagi', '05.00 Halaqah', '07.00 Sekolah', '16.00 Kegiatan sore', '20.00 Belajar malam', '22.00 Istirahat'] as $item)
                <div class="timeline-item">
                    <time>{{ \Illuminate\Support\Str::before($item, ' ') }}</time>
                    <p>{{ \Illuminate\Support\Str::after($item, ' ') }}</p>
                </div>
            @endforeach
        </div>
    </section>
</x-public-layout>
