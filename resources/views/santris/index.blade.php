<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Santri') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php $currentUser = auth()->user(); @endphp
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    @if($currentUser && $currentUser->is_admin)
                        <a href="{{ route('santris.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Tambah Santri</a>

                        <!-- Import button -->
                        <button id="open-import-modal" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded">
                            <!-- simple upload icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 12v9m0-9l3 3m-3-3-3 3M12 3v9" />
                            </svg>
                            Import Data
                        </button>
                    @endif
                </div>

                <div class="flex items-center space-x-4">
                    <form method="GET" action="{{ route('santris.index') }}" id="per-page-form">
                        <label for="per_page" class="text-sm text-gray-600 mr-2">Per page</label>
                        <select name="per_page" id="per_page" class="border rounded px-2 py-1" onchange="document.getElementById('per-page-form').submit()">
                            @foreach([10,20,50,100] as $n)
                                <option value="{{ $n }}" {{ (isset($perPage) && $perPage == $n) ? 'selected' : '' }}>{{ $n }}</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="text-sm text-gray-600">Showing {{ $santris->firstItem() ?? 0 }} to {{ $santris->lastItem() ?? 0 }} of {{ $santris->total() }}</div>
                </div>
            </div>

            @if($currentUser && $currentUser->is_admin)
                <!-- Import Modal -->
                <div id="import-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
                    <div class="bg-white rounded shadow-lg w-full max-w-2xl mx-4">
                        <div class="px-6 py-4 border-b flex items-center justify-between">
                            <h3 class="text-lg font-medium">Import Santri</h3>
                            <button id="close-import-modal" class="text-gray-600 hover:text-gray-800">✕</button>
                        </div>
                        <div class="p-6">
                            <p class="mb-4">You can import santri from a CSV file. Download the template if you need one.</p>

                            <div class="mb-4">
                                <a href="{{ route('santris.import-template') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border rounded">
                                    <!-- download icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l4-4m-4 4-4-4M21 12v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6" />
                                    </svg>
                                    Unduh Template Import (Excel)
                                </a>
                            </div>

                            <form id="import-form" method="POST" action="{{ route('santris.import') }}" enctype="multipart/form-data">
                                @csrf
                                <div id="drop-area" class="border-2 border-dashed border-gray-300 rounded p-6 text-center">
                                    <p id="drop-text" class="text-sm text-gray-600">Drag & drop CSV file here, or <label for="file-input" class="text-blue-600 underline cursor-pointer">browse</label></p>
                                    <input id="file-input" name="file" type="file" accept=".csv,.txt,.xls,.xlsx" class="hidden" />
                                    <p id="file-name" class="mt-3 text-sm text-gray-700"></p>
                                </div>

                                <div class="mt-4 flex justify-end space-x-3">
                                    <button type="button" id="cancel-import" class="px-4 py-2 bg-gray-100 rounded">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Upload & Import</button>
                                </div>
                            </form>
                            <p class="mt-3 text-sm text-gray-500">Notes: first row may be a header. Columns expected: nis,name,email,phone,kelas,birth_date (YYYY-MM-DD).</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($santris as $s)
                        <tr>
                            <td class="px-6 py-4">{{ ($santris->firstItem() ?? 0) + $loop->index }}</td>
                            <td class="px-6 py-4">{{ $s->nis }}</td>
                            <td class="px-6 py-4">{{ $s->name }}</td>
                            <td class="px-6 py-4">{{ $s->email }}</td>
                            <td class="px-6 py-4">{{ optional($s->kelas)->name ?? $s->getAttribute('kelas') ?? '-' }}</td>
                            <td class="px-6 py-4 text-center flex items-center justify-center">
                                @if($currentUser && $currentUser->is_admin)
                                    <a href="{{ route('santris.edit', $s) }}" class="inline-flex items-center px-2 py-1 text-sm text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M11 9h6M11 13h6M5 5h.01M5 9h.01M5 13h.01M5 17h14" />
                                        </svg>
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('santris.destroy', $s) }}" class="inline delete-form">
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

                <div class="p-4">{{ $santris->links() }}</div>
            </div>
        </div>
    </div>
    <script>
        @if($currentUser && $currentUser->is_admin)
            document.querySelectorAll('.delete-form').forEach(function(form){
                form.addEventListener('submit', function(e){
                    if(!confirm('Are you sure you want to delete this santri?')){
                        e.preventDefault();
                    }
                });
            });

            // Import modal behavior and drag/drop
            (function(){
                const openBtn = document.getElementById('open-import-modal');
                const modal = document.getElementById('import-modal');
                const closeBtn = document.getElementById('close-import-modal');
                const cancelBtn = document.getElementById('cancel-import');
                const dropArea = document.getElementById('drop-area');
                const fileInput = document.getElementById('file-input');
                const fileName = document.getElementById('file-name');

                if(openBtn) openBtn.addEventListener('click', function(){ modal.classList.remove('hidden'); modal.classList.add('flex'); });
                if(closeBtn) closeBtn.addEventListener('click', function(){ modal.classList.add('hidden'); modal.classList.remove('flex'); });
                if(cancelBtn) cancelBtn.addEventListener('click', function(){ modal.classList.add('hidden'); modal.classList.remove('flex'); });

                if(dropArea){
                    ['dragenter','dragover'].forEach(evt => dropArea.addEventListener(evt, function(e){ e.preventDefault(); e.stopPropagation(); dropArea.classList.add('bg-gray-50'); }, false));
                    ['dragleave','drop'].forEach(evt => dropArea.addEventListener(evt, function(e){ e.preventDefault(); e.stopPropagation(); dropArea.classList.remove('bg-gray-50'); }, false));

                    dropArea.addEventListener('drop', function(e){
                        const dt = e.dataTransfer;
                        if(!dt || !dt.files || !dt.files.length) return;
                        fileInput.files = dt.files;
                        fileName.textContent = dt.files[0].name;
                    });

                    fileInput.addEventListener('change', function(){
                        if(fileInput.files && fileInput.files.length){
                            fileName.textContent = fileInput.files[0].name;
                        } else {
                            fileName.textContent = '';
                        }
                    });
                }
            })();
        @endif
    </script>
</x-app-layout>
