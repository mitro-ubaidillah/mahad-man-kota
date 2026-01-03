<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Kegiatan') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php $currentUser = auth()->user(); @endphp
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    @if($currentUser && $currentUser->is_admin)
                        <a href="{{ route('activities.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Buat Kegiatan</a>
                    @endif
                </div>
                <div class="text-sm text-gray-600">Total: {{ $activities->total() }}</div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($activities as $a)
                        <tr>
                            <td class="px-6 py-4">{{ $a->id }}</td>
                            <td class="px-6 py-4">{{ $a->title }}</td>
                            <td class="px-6 py-4">
                                @if($a->recurring_daily)
                                    Harian
                                @else
                                    @if($a->start_date && $a->end_date)
                                        {{ $a->start_date->format('Y-m-d') }} - {{ $a->end_date->format('Y-m-d') }}
                                    @elseif($a->start_date)
                                        {{ $a->start_date->format('Y-m-d') }}
                                    @else
                                        {{ $a->activity_date?->format('Y-m-d') ?? '-' }}
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($a->start_time && $a->end_time)
                                    {{ substr($a->start_time, 0, 5) }} - {{ substr($a->end_time, 0, 5) }}
                                @elseif($a->start_time)
                                    {{ substr($a->start_time, 0, 5) }} - selesai
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($currentUser && $currentUser->is_admin)
                                    <a href="{{ route('activities.edit', $a) }}" class="inline-flex items-center px-2 py-1 text-sm text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M11 9h6M11 13h6M5 5h.01M5 9h.01M5 13h.01M5 17h14" />
                                        </svg>
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('activities.destroy', $a) }}" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-2 py-1 text-sm text-red-600 bg-red-50 hover:bg-red-100 rounded ml-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">{{ $activities->links() }}</div>
            </div>
        </div>
    </div>

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
