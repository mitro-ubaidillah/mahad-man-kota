@php
    $programs = [
        'Tahfidz dan Tahsin',
        'Kajian Adab dan Akhlak',
        'Pembiasaan Ibadah',
        'Bahasa Arab Dasar',
        'Kemandirian Santri',
        'Mentoring Akademik',
    ];
@endphp

<x-public-layout title="Program Pembinaan - Ma’had Islam Sekolah">
    <section class="page-hero">
        <span>Program</span>
        <h1>Program pembinaan yang dekat dengan rutinitas santri</h1>
        <p>Program dibuat sederhana dan bisa dikembangkan menjadi data dinamis ketika kebutuhan lembaga sudah siap.</p>
    </section>

    <section class="section">
        <div class="program-grid">
            @foreach ($programs as $program)
                <x-public.program-card :title="$program" description="Deskripsi program dapat disesuaikan dengan kurikulum dan target pembinaan resmi Ma’had." />
            @endforeach
        </div>
    </section>
</x-public-layout>
