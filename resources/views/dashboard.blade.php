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
                <div class="bg-white shadow sm:rounded-lg p-6 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold">Selamat datang,</h1>
                        <div class="text-lg font-semibold">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div class="text-sm text-gray-500">Dashboard Sistem Absensi Pesantren</div>
                    </div>
                    <div class="text-right space-y-2">
                        <div class="text-sm text-gray-500">Minggu</div>
                        <div class="bg-gray-50 px-4 py-2 rounded shadow-sm text-sm">{{ \Illuminate\Support\Carbon::now()->translatedFormat('d F Y') }}<div class="text-xs text-gray-400">{{ \Illuminate\Support\Carbon::now()->format('H:i') }} WIB</div></div>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-3 space-y-4">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-white shadow sm:rounded-lg p-6 flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">Total Santri</div>
                                    <div class="text-2xl font-bold">{{ $santriCount ?? 0 }}</div>
                                    <div class="text-xs text-green-500">+0 bulan ini</div>
                                </div>
                                <div class="text-indigo-500">
                                    <!-- icon placeholder -->
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14v7"></path></svg>
                                </div>
                            </div>
        
                            <div class="bg-white shadow sm:rounded-lg p-6 flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">Total Kegiatan</div>
                                    <div class="text-2xl font-bold">{{ $activityCount ?? 0 }}</div>
                                    <div class="text-xs text-gray-500">{{ $activityCount }} kegiatan aktif</div>
                                </div>
                                <div class="text-green-500">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
        
                            <div class="bg-white shadow sm:rounded-lg p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm text-gray-500">Total Admin</div>
                                        <div class="text-2xl font-bold">{{ $adminCount ?? 0 }}</div>
                                        <div class="text-xs text-gray-500">{{ $adminCount }} root, admin</div>
                                    </div>
                                    <div class="text-purple-500">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zM6 15v2a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white shadow sm:rounded-lg p-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-medium">Absensi Mingguan</div>
                                    <div class="text-xs text-gray-400">7 hari terakhir</div>
                                </div>
                                <canvas id="weeklyChart" class="mt-4"></canvas>
                            </div>
        
                            <div class="bg-white shadow sm:rounded-lg p-6">
                                <div class="text-sm font-medium">Pertumbuhan Santri</div>
                                <canvas id="growthChart" class="mt-4"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow sm:rounded-lg p-4">
                        <div class="text-lg font-semibold text-gray-600 mb-4">Aksi Cepat</div>
                        <div class="mt-2 grid grid-cols-1 gap-2">
                            <a href="{{ route('santris.index') }}" class="block px-3 py-2 bg-gray-50 rounded">Kelola Santri</a>
                            <a href="{{ route('activities.index') }}" class="block px-3 py-2 bg-gray-50 rounded">Kelola Kegiatan</a>
                            <a href="{{ route('attendances.index') }}" class="block px-3 py-2 bg-gray-50 rounded">Kelola Absensi</a>
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('users.index') }}" class="block px-3 py-2 bg-gray-50 rounded">Kelola Admin</a>
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
                            backgroundColor: 'rgba(59, 130, 246, 0.6)'
                        }]
                    },
                    options: { responsive: true }
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
                            borderColor: 'rgba(16, 185, 129, 1)',
                            backgroundColor: 'rgba(16, 185, 129, 0.2)',
                            fill: true,
                        }]
                    },
                    options: { responsive: true }
                });
            }
        })();
    </script>
</x-app-layout>
