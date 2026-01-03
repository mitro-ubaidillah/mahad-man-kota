<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Absensi') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('attendances.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Tambah Absensi</a>
                </div>
                <div class="flex items-center space-x-3">
                    <button id="open-export-modal" type="button" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded text-sm">
                        Rekap / Export Excel
                    </button>
                    <div class="text-sm text-gray-600">Total: {{ $attendances->total() }}</div>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Santri</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($attendances as $at)
                        <tr>
                            <td class="px-6 py-4">{{ $at->id }}</td>
                            <td class="px-6 py-4">{{ $at->activity->title ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $at->santri->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ ucfirst($at->status) }}</td>
                            <td class="px-6 py-4 text-center flex items-center justify-center">
                                <a href="{{ route('attendances.edit', $at) }}" class="inline-flex items-center px-2 py-1 text-sm text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M11 9h6M11 13h6M5 5h.01M5 9h.01M5 13h.01M5 17h14" />
                                    </svg>
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('attendances.destroy', $at) }}" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2 py-1 text-sm text-red-600 bg-red-50 hover:bg-red-100 rounded ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">{{ $attendances->links() }}</div>
            </div>
        </div>
    </div>

            <!-- Export Modal -->
            <div id="export-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
                <div class="bg-white rounded shadow-lg w-full max-w-xl mx-4">
                    <div class="px-6 py-4 border-b flex items-center justify-between">
                        <h3 class="text-lg font-medium">Rekap & Export Absensi</h3>
                        <button id="close-export-modal" class="text-gray-600 hover:text-gray-800">✕</button>
                    </div>
                    <div class="p-6">
                        <form method="GET" action="{{ route('attendances.export') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="modal_start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                <input type="date" id="modal_start_date" name="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label for="modal_end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                <input type="date" id="modal_end_date" name="end_date" value="{{ request('end_date') }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm" required>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="modal_kelas_id" class="block text-sm font-medium text-gray-700">Kelas (opsional)</label>
                                <select id="modal_kelas_id" name="kelas_id" class="mt-1 block w-full border rounded px-3 py-2 text-sm">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelasList as $k)
                                        <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="sm:col-span-2 flex justify-end space-x-2 mt-2">
                                <button type="button" id="cancel-export" class="px-4 py-2 bg-gray-100 rounded text-sm">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded text-sm">Export Excel</button>
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

            function closeModal(){
                if(!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            if(openBtn && modal){
                openBtn.addEventListener('click', function(){
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            }
            if(closeBtn){
                closeBtn.addEventListener('click', closeModal);
            }
            if(cancelBtn){
                cancelBtn.addEventListener('click', closeModal);
            }

            // close when clicking outside modal content (on backdrop)
            if(modal){
                modal.addEventListener('click', function(e){
                    if(e.target === modal){
                        closeModal();
                    }
                });
            }
        })();
    </script>
</x-app-layout>
