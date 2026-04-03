<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                <!-- Header card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Selamat datang,</h1>
                        <div class="text-lg font-semibold text-emerald-600">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div class="text-sm text-gray-500 mt-1">Dashboard Sistem Absensi Pesantren</div>
                    </div>
                    <div class="text-left sm:text-right space-y-2">
                        <div class="text-sm font-medium text-gray-500">{{ \Illuminate\Support\Carbon::now()->translatedFormat('l') }}</div>
                        <div class="bg-emerald-50/50 border border-emerald-100 px-4 py-2 rounded-lg shadow-sm text-sm font-semibold text-emerald-800">
                            {{ \Illuminate\Support\Carbon::now()->translatedFormat('d F Y') }}
                            <div class="text-xs text-emerald-600 font-normal mt-0.5">{{ \Illuminate\Support\Carbon::now()->format('H:i') }} WIB</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <div class="col-span-1 lg:col-span-3 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
                                <div>
                                    <div class="text-sm font-medium text-gray-500 mb-1">Total Santri</div>
                                    <div class="text-3xl font-bold text-gray-800">{{ $santriCount ?? 0 }}</div>
                                </div>
                                <div class="text-emerald-500 bg-emerald-50 p-3 rounded-xl">
                                    <!-- icon placeholder -->
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                            </div>
        
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
                                <div>
                                    <div class="text-sm font-medium text-gray-500 mb-1">Total Kegiatan</div>
                                    <div class="text-3xl font-bold text-gray-800">{{ $activityCount ?? 0 }}</div>
                                </div>
                                <div class="text-blue-500 bg-blue-50 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
        
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
                                <div>
                                    <div class="text-sm font-medium text-gray-500 mb-1">Total Admin</div>
                                    <div class="text-3xl font-bold text-gray-800">{{ $adminCount ?? 0 }}</div>
                                </div>
                                <div class="text-amber-500 bg-amber-50 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zM6 15v2a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-base font-bold text-gray-800">Absensi Mingguan</div>
                                    <x-badge color="emerald" size="sm">7 hari terakhir</x-badge>
                                </div>
                                <canvas id="weeklyChart" class="mt-2"></canvas>
                            </div>
        
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-base font-bold text-gray-800">Pertumbuhan Santri</div>
                                    <x-badge color="blue" size="sm">Bulan ini</x-badge>
                                </div>
                                <canvas id="growthChart" class="mt-2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-fit">
                        <div class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Aksi Cepat</div>
                        <div class="space-y-3">
                            <a href="{{ route('santris.index') }}" class="flex items-center p-3 rounded-lg border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50 text-gray-600 hover:text-emerald-700 transition-colors group">
                                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                Kelola Santri
                            </a>
                            <a href="{{ route('activities.index') }}" class="flex items-center p-3 rounded-lg border border-gray-100 hover:border-blue-200 hover:bg-blue-50 text-gray-600 hover:text-blue-700 transition-colors group">
                                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"></path></svg>
                                Kelola Kegiatan
                            </a>
                            <a href="{{ route('attendances.index') }}" class="flex items-center p-3 rounded-lg border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50 text-gray-600 hover:text-emerald-700 transition-colors group">
                                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Kelola Presensi
                            </a>
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-lg border border-gray-100 hover:border-amber-200 hover:bg-amber-50 text-gray-600 hover:text-amber-700 transition-colors group">
                                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zM6 15v2a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                                    Kelola Admin
                                </a>
                            @endif
                        </div>
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
