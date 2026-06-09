<x-app-layout>
    <x-slot name="header">
        {{ __('Santri') }}
    </x-slot>

    @php $currentUser = auth()->user(); @endphp

    {{-- Import Modal --}}
    @if($currentUser && $currentUser->is_admin)
    <div id="import-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl mx-4">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">Import Santri</h3>
                <button id="close-import-modal" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <p class="mb-4 text-sm text-gray-600">Import santri dari file CSV/Excel. Unduh template jika diperlukan.</p>
                <div class="mb-4">
                    <a href="{{ route('santris.import-template') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l4-4m-4 4-4-4M21 12v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6" /></svg>
                        Unduh Template (Excel)
                    </a>
                </div>
                <form id="import-form" method="POST" action="{{ route('santris.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="drop-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <p id="drop-text" class="text-sm text-gray-600">Drag & drop file di sini, atau <label for="file-input" class="text-emerald-600 underline cursor-pointer font-medium">pilih file</label></p>
                        <input id="file-input" name="file" type="file" accept=".csv,.txt,.xls,.xlsx" class="hidden" />
                        <p id="file-name" class="mt-3 text-sm text-emerald-700 font-medium"></p>
                    </div>
                    <div class="mt-4 flex justify-end gap-3 pt-3 border-t border-gray-100">
                        <button type="button" id="cancel-import" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">Batal</button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold rounded-xl transition">Upload & Import</button>
                    </div>
                </form>
                <p class="mt-3 text-xs text-gray-500 leading-relaxed">
                    <strong>Penting:</strong> Pastikan urutan dan nama kolom pada baris pertama sesuai dengan draf template.<br>
                    (NIS, Nama Lengkap, Email, Nomor HP, Nama Kelas, Tanggal Lahir).
                </p>
            </div>
        </div>
    </div>
    @endif

    <x-ui-card class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <x-ui-section-heading description="Kelola data santri dengan filter kelas dan aksi cepat">Santri</x-ui-section-heading>
            @if($currentUser && $currentUser->is_admin)
                <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                    <x-secondary-button id="open-import-modal" class="flex items-center gap-2 flex-1 sm:flex-none justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 12v9m0-9l3 3m-3-3-3 3M12 3v9" /></svg>
                        Import Santri
                    </x-secondary-button>
                    <a href="{{ route('santris.create') }}" class="flex-1 sm:flex-none">
                        <x-primary-button class="flex items-center gap-2 w-full justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Tambah Santri
                        </x-primary-button>
                    </a>
                </div>
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <form method="GET" action="{{ route('santris.index') }}" id="filter-form" class="flex items-center gap-3 flex-wrap">
                <div>
                    <label for="kelas_id" class="text-sm font-medium text-gray-700 whitespace-nowrap">Filter Kelas:</label>
                    <select name="kelas_id" id="kelas_id" class="border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg text-sm pl-3 pr-8 py-1.5 transition-colors" onchange="document.getElementById('filter-form').submit()">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}" {{ isset($selectedKelasId) && (string)$selectedKelasId === (string)$k->id ? 'selected' : '' }}>{{ $k->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <form method="GET" action="{{ route('santris.index') }}" id="per-page-form" class="flex items-center gap-2">
                <input type="hidden" name="kelas_id" value="{{ $selectedKelasId ?? '' }}">
                <label for="per_page" class="whitespace-nowrap text-sm font-medium text-gray-700">Baris per halaman:</label>
                <select name="per_page" id="per_page" class="border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg text-sm py-1.5 pl-3 pr-8 transition-colors" onchange="document.getElementById('per-page-form').submit()">
                    @foreach([10,20,50,100] as $n)
                        <option value="{{ $n }}" {{ (isset($perPage) && $perPage == $n) ? 'selected' : '' }}>{{ $n }} baris</option>
                    @endforeach
                </select>
            </form>
        </div>

        <x-ui-table>
            <x-slot name="head">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Santri</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Kontak</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Wali Murid</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Kelas</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-emerald-800 uppercase tracking-wider">Aksi</th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($santris as $s)
                    <tr class="hover:bg-emerald-50/40 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ($santris->firstItem() ?? 0) + $loop->index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="text-sm font-medium text-gray-900">{{ $s->name ?: 'Draft santri' }}</div>
                                @if(($s->status ?? 'active') === 'draft')
                                    <span class="rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-700">Draft</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500">NIS: {{ $s->nis }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $s->email ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $s->phone ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $s->guardian_name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $s->guardian_phone ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            @if(optional($s->kelas)->name)
                                <x-badge color="emerald" size="sm">{{ $s->kelas->name }}</x-badge>
                            @else
                                <span class="text-gray-400 italic">Tanpa Kelas</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            @if($currentUser && $currentUser->is_admin)
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('santris.edit', $s) }}" class="inline-flex items-center gap-1.5 text-emerald-600 hover:text-emerald-900 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('santris.destroy', $s) }}" class="inline delete-form">
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
                        <td colspan="6" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <p class="mt-4 text-sm text-gray-500 font-medium">Belum ada data santri.</p>
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-ui-table>

        <x-ui-pagination :paginator="$santris" />
    </x-ui-card>
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
