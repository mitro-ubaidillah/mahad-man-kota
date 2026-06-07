<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-black uppercase tracking-[0.18em] text-amber-700">Dashboard</p>
            <h2 class="font-black text-xl text-[#102418] leading-tight">
                {{ __('Admin Absensi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                <section class="relative overflow-hidden rounded-[2rem] border border-emerald-900/10 bg-[radial-gradient(circle_at_top_right,rgba(201,162,39,0.24),transparent_22rem),linear-gradient(135deg,#102418,#14532d)] p-6 text-white shadow-[0_24px_70px_rgba(16,36,24,0.16)]">
                    <div class="absolute -right-10 -top-10 h-44 w-44 rounded-full bg-white/10"></div>
                    <div class="absolute bottom-0 right-16 h-28 w-44 rounded-t-full bg-emerald-300/10"></div>
                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <span class="inline-flex rounded-full border border-amber-200/25 bg-amber-100/10 px-3 py-1 text-xs font-black uppercase tracking-[0.18em] text-amber-100">Sistem Absensi</span>
                            <h1 class="mt-4 text-3xl font-black leading-tight md:text-4xl">Selamat datang, {{ auth()->user()->name ?? 'Administrator' }}</h1>
                            <p class="mt-2 max-w-2xl text-sm font-medium text-emerald-50/80">Pantau data santri, kegiatan, dan catatan kehadiran dalam satu panel yang rapi dan ringan.</p>
                        </div>
                        <div class="rounded-3xl border border-white/15 bg-white/10 p-4 text-left shadow-inner backdrop-blur sm:text-right">
                            <div class="text-sm font-bold text-emerald-50/80">{{ \Illuminate\Support\Carbon::now()->translatedFormat('l') }}</div>
                            <div class="mt-1 text-lg font-black text-white">{{ \Illuminate\Support\Carbon::now()->translatedFormat('d F Y') }}</div>
                            <div class="mt-1 text-xs font-semibold text-amber-100">{{ \Illuminate\Support\Carbon::now()->format('H:i') }} WIB</div>
                        </div>
                    </div>
                </section>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <div class="col-span-1 lg:col-span-3 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <x-ui-stat-card label="Total Santri" value="{{ $santriCount ?? 0 }}" accent="emerald">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </x-ui-stat-card>
                            <x-ui-stat-card label="Total Kegiatan" value="{{ $activityCount ?? 0 }}" accent="blue">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"></path></svg>
                            </x-ui-stat-card>
                            <x-ui-stat-card label="Total Admin" value="{{ $adminCount ?? 0 }}" accent="amber">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zM6 15v2a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                            </x-ui-stat-card>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-ui-card class="min-h-[320px]">
                                <x-ui-section-heading badge="7 hari terakhir">Absensi Mingguan</x-ui-section-heading>
                                <canvas id="weeklyChart" class="mt-4"></canvas>
                            </x-ui-card>
                            <x-ui-card class="min-h-[320px]">
                                <x-ui-section-heading badge="Bulan ini">Pertumbuhan Santri</x-ui-section-heading>
                                <canvas id="growthChart" class="mt-4"></canvas>
                            </x-ui-card>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <x-ui-card class="space-y-3">
                            <x-ui-section-heading badge="Shortcut">Aksi Cepat</x-ui-section-heading>
                            <div class="space-y-3">
                                <a href="{{ route('santris.index') }}" class="flex items-center rounded-2xl border border-emerald-900/10 bg-white px-4 py-3 text-sm font-bold text-gray-600 transition hover:-translate-y-0.5 hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800 group">
                                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    Kelola Santri
                                </a>
                                <a href="{{ route('activities.index') }}" class="flex items-center rounded-2xl border border-emerald-900/10 bg-white px-4 py-3 text-sm font-bold text-gray-600 transition hover:-translate-y-0.5 hover:border-amber-200 hover:bg-amber-50 hover:text-amber-800 group">
                                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"></path></svg>
                                    Kelola Kegiatan
                                </a>
                                <a href="{{ route('attendances.index') }}" class="flex items-center rounded-2xl border border-emerald-900/10 bg-white px-4 py-3 text-sm font-bold text-gray-600 transition hover:-translate-y-0.5 hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800 group">
                                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    Kelola Presensi
                                </a>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('users.index') }}" class="flex items-center rounded-2xl border border-emerald-900/10 bg-white px-4 py-3 text-sm font-bold text-gray-600 transition hover:-translate-y-0.5 hover:border-amber-200 hover:bg-amber-50 hover:text-amber-800 group">
                                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zM6 15v2a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                                        Kelola Admin
                                    </a>
                                @endif
                                @superAdmin
                                    <a href="{{ route('mahad-admin.dashboard') }}" class="flex items-center rounded-2xl border border-emerald-900/10 bg-emerald-900 px-4 py-3 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-emerald-950 group">
                                        <svg class="w-5 h-5 mr-3 text-emerald-100" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2zM8 13h8M8 17h6" /></svg>
                                        Admin Artikel
                                    </a>
                                @endsuperAdmin
                            </div>
                        </x-ui-card>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function(){
            const weeklyLabels = @json($weeklyLabels ?? []);
            const weeklyData = @json($weeklyData ?? []);
            const growthLabels = @json($growthLabels ?? []);
            const growthData = @json($growthData ?? []);

            const ctx = document.getElementById('weeklyChart');
            if(ctx){
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: weeklyLabels,
                        datasets: [{
                            label: 'Hadir',
                            data: weeklyData,
                            backgroundColor: 'rgba(16, 185, 129, 0.8)',
                            borderRadius: 6,
                        }]
                    },
                    options: { 
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true, grid: { borderDash: [2, 4], color: '#f3f4f6' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            const gctx = document.getElementById('growthChart');
            if(gctx){
                new Chart(gctx, {
                    type: 'line',
                    data: {
                        labels: growthLabels,
                        datasets: [{
                            label: 'Santri baru',
                            data: growthData,
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            fill: true,
                            tension: 0.4,
                        }]
                    },
                    options: { 
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true, grid: { borderDash: [2, 4], color: '#f3f4f6' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        })();
    </script>
</x-app-layout>
