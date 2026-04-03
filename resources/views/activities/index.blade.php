<x-app-layout>
    <x-slot name="header">{{ __('Kegiatan') }}</x-slot>

    @php $currentUser = auth()->user(); @endphp

    <x-card>
        <x-slot name="header">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h2 class="text-lg font-bold text-gray-800">Daftar Kegiatan</h2>
                @if($currentUser && $currentUser->is_admin)
                <div class="flex items-center gap-2">
                    <a href="{{ route('activities.create') }}">
                        <x-primary-button class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Buat Kegiatan
                        </x-primary-button>
                    </a>
                </div>
                @endif
            </div>
        </x-slot>

        {{-- Table --}}
        <div class="overflow-x-auto -mx-6 -my-5">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-emerald-800 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($activities as $a)
                    <tr class="hover:bg-emerald-50/50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $a->title }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $a->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            @if($a->recurring_daily)
                                <x-badge color="blue" size="sm">Harian</x-badge>
                            @else
                                @if($a->start_date && $a->end_date)
                                    {{ $a->start_date->format('Y-m-d') }} &ndash; {{ $a->end_date->format('Y-m-d') }}
                                @elseif($a->start_date)
                                    {{ $a->start_date->format('Y-m-d') }}
                                @else
                                    {{ $a->activity_date?->format('Y-m-d') ?? '-' }}
                                @endif
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            @if($a->start_time && $a->end_time)
                                {{ substr($a->start_time, 0, 5) }} &ndash; {{ substr($a->end_time, 0, 5) }}
                            @elseif($a->start_time)
                                {{ substr($a->start_time, 0, 5) }} - selesai
                            @else
                                <span class="text-gray-400 italic">Tidak ditentukan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            @if($currentUser && $currentUser->is_admin)
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('activities.edit', $a) }}" class="inline-flex items-center gap-1.5 text-emerald-600 hover:text-emerald-900 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('activities.destroy', $a) }}" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-4 text-sm text-gray-500 font-medium">Belum ada data kegiatan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <x-slot name="footer">
            <div class="w-full flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <span class="text-sm text-gray-500">Menampilkan {{ $activities->firstItem() ?? 0 }} - {{ $activities->lastItem() ?? 0 }} dari {{ $activities->total() }} kegiatan</span>
                <div>{{ $activities->links() }}</div>
            </div>
        </x-slot>
    </x-card>

    <script>
        @if($currentUser && $currentUser->is_admin)
            document.querySelectorAll('.delete-form').forEach(function(form){
                form.addEventListener('submit', function(e){
                    if(!confirm('Yakin ingin menghapus kegiatan ini?')){
                        e.preventDefault();
                    }
                });
            });
        @endif
    </script>
</x-app-layout>
