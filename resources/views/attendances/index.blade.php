<x-app-layout>
    <x-slot name="header">Daftar Presensi</x-slot>

    <x-ui-card class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <x-ui-section-heading description="Catatan presensi harian dan tombol aksi cepat">Catatan Kehadiran Santri</x-ui-section-heading>
            <div class="flex items-center justify-end gap-2">
                <x-secondary-button id="open-export-modal" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l4-4m-4 4-4-4M21 12v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6"/></svg>
                    Rekap Excel
                </x-secondary-button>
                <a href="{{ route('attendances.create') }}">
                    <x-primary-button class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Isi Presensi
                    </x-primary-button>
                </a>
            </div>
        </div>

        <x-ui-table>
            <x-slot name="head">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Santri</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Kegiatan</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-emerald-800 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-emerald-800 uppercase tracking-wider">Aksi</th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($attendances as $at)
                    <tr class="hover:bg-emerald-50/50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $at->santri->name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $at->santri->kelas->name ?? 'Tanpa Kelas' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $at->activity->title ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @php
                                $statusColors = [
                                    'present' => 'emerald',
                                    'absent' => 'red',
                                    'late' => 'yellow',
                                    'sick' => 'yellow',
                                    'izin' => 'blue',
                                ];
                                $color = $statusColors[$at->status] ?? 'gray';
                                $statusLabel = [
                                    'present' => 'Hadir',
                                    'absent' => 'Alpa',
                                    'late' => 'Terlambat',
                                    'sick' => 'Sakit',
                                    'izin' => 'Izin',
                                ][$at->status] ?? ucfirst($at->status);
                            @endphp
                            <x-badge :color="$color" size="sm">{{ $statusLabel }}</x-badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('attendances.edit', $at) }}" class="inline-flex items-center gap-1.5 text-emerald-600 hover:text-emerald-900 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('attendances.destroy', $at) }}" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1.5 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <p class="mt-4 text-sm text-gray-500 font-medium">Belum ada catatan presensi hari ini.</p>
                            <p class="text-xs text-gray-400 mt-1">Silakan klik tombol &quot;Isi Presensi&quot; untuk menambahkan data baru.</p>
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-ui-table>

        <x-ui-pagination :paginator="$attendances" />
    </x-ui-card>

    <div id="export-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">Rekap & Export Absensi</h3>
                <button id="close-export-modal" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <form method="GET" action="{{ route('attendances.export') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="modal_start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" id="modal_start_date" name="start_date" value="{{ request('start_date') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                    </div>
                    <div>
                        <label for="modal_end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                        <input type="date" id="modal_end_date" name="end_date" value="{{ request('end_date') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="modal_kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas (opsional)</label>
                        <select id="modal_kelas_id" name="kelas_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <option value="">Semua Kelas</option>
                            @foreach($kelasList as $k)
                                <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2 flex justify-end gap-3 mt-2 pt-3 border-t border-gray-100">
                        <button type="button" id="cancel-export" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition">Batal</button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l4-4m-4 4-4-4M21 12v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6"/></svg>
                            Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-form').forEach(function(form){
            form.addEventListener('submit', function(e){
                if(!confirm('Yakin ingin menghapus data absensi ini?')){
                    e.preventDefault();
                }
            });
        });

        (function(){
            const openBtn = document.getElementById('open-export-modal');
            const modal = document.getElementById('export-modal');
            const closeBtn = document.getElementById('close-export-modal');
            const cancelBtn = document.getElementById('cancel-export');

            function closeModal(){ if(!modal) return; modal.classList.add('hidden'); modal.classList.remove('flex'); }

            if(openBtn && modal){ openBtn.addEventListener('click', function(){ modal.classList.remove('hidden'); modal.classList.add('flex'); }); }
            if(closeBtn){ closeBtn.addEventListener('click', closeModal); }
            if(cancelBtn){ cancelBtn.addEventListener('click', closeModal); }
            if(modal){ modal.addEventListener('click', function(e){ if(e.target === modal){ closeModal(); } }); }
        })();
    </script>
</x-app-layout>
