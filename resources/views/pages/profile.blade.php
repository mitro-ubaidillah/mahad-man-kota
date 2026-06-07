<x-public-layout title="Profil Ma’had - Ma’had Islam Sekolah">
    <section class="page-hero">
        <span>Profil</span>
        <h1>Ma’had yang hangat untuk pembinaan ilmu dan adab</h1>
        <p>Halaman ini merangkum arah pembinaan, nilai utama, dan suasana yang ingin dibangun dalam kehidupan santri.</p>
    </section>

    <section class="section section--split">
        <div>
            <x-public.section-heading
                align="left"
                eyebrow="Tentang Kami"
                title="Ruang tumbuh yang tertib, sederhana, dan penuh perhatian"
                description="Ma’had mendampingi santri melalui kebiasaan harian yang baik: shalat berjamaah, tilawah, belajar, menjaga kebersihan, dan hidup bersama dengan adab."
            />
            <p class="body-copy">Konsep pembinaan dibuat ringan untuk dikembangkan bersama sekolah. Konten ini masih dapat disesuaikan dengan nama resmi ma’had, struktur pengasuh, alamat, dan kebijakan lembaga.</p>
        </div>
        <div class="about-preview__card">
            <strong>Visi</strong>
            <p>Membentuk santri yang berilmu, berakhlak, mandiri, dan memberi manfaat.</p>
            <strong>Misi</strong>
            <p>Menguatkan Al-Qur’an, adab, ibadah, kedisiplinan, dan budaya belajar melalui pendampingan yang konsisten.</p>
        </div>
    </section>

    <section class="section section--cream">
        <x-public.section-heading eyebrow="Nilai Utama" title="Nilai yang ditanamkan dalam keseharian" />
        <div class="feature-grid">
            @foreach (['Ikhlas', 'Disiplin', 'Mandiri', 'Beradab'] as $value)
                <x-public.feature-card :title="$value" description="Dibiasakan melalui aktivitas harian, nasihat pengasuh, dan teladan lingkungan." />
            @endforeach
        </div>
    </section>
</x-public-layout>
