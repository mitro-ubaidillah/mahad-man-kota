<x-app-layout>
    <x-slot name="header">{{ __('Kelas') }}</x-slot>

    @php $currentUser = auth()->user(); @endphp

    {{-- Import Modal --}}
    @if($currentUser && $currentUser->is_admin)
    <div id="import-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gray-50/80 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-base font-semibold text-gray-900">Import Kelas</h3>
                <button id="close-import-modal" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <p class="mb-4 text-sm text-gray-600">Import kelas dari file CSV/Excel. Unduh template jika diperlukan.</p>
                <div class="mb-4">
                    <a href="{{ route('kelas.import-template') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l4-4m-4 4-4-4M21 12v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6" /></svg>
                        Unduh Template (Excel)
                    </a>
                </div>
                <form id="import-form" method="POST" action="{{ route('kelas.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="drop-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <p id="drop-text" class="text-sm text-gray-600">Drag & drop file di sini, atau <label for="file-input" class="text-emerald-600 underline cursor-pointer font-medium">pilih file</label></p>
                        <input id="file-input" name="file" type="file" accept=".csv,.txt,.xls,.xlsx" class="hidden" />
                        <p id="file-name" class="mt-3 text-sm text-emerald-700 font-medium"></p>
                    </div>
                    <div class="mt-4 flex justify-end gap-3 pt-3 border-t border-gray-100">
                        <button type="button" id="cancel-import" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition">Batal</button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition">Upload & Import</button>
                    </div>
                </form>
                <p class="mt-3 text-xs text-gray-500 leading-relaxed">
                    <strong>Penting:</strong> Pastikan urutan dan nama kolom pada baris pertama sesuai dengan draf template.<br>
                    (Nama Kelas, Deskripsi).
                </p>
            </div>
        </div>
    </div>
    @endif

    <x-ui-card class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <x-ui-section-heading description="Pusat data kelas dengan import cepat">Daftar Semua Kelas</x-ui-section-heading>
            @if($currentUser && $currentUser->is_admin)
                <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                    <x-secondary-button id="open-import-modal" class="flex items-center gap-2 flex-1 sm:flex-none justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Import Kelas
                    </x-secondary-button>
                    <a href="{{ route('kelas.create') }}" class="flex-1 sm:flex-none">
                        <x-primary-button class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Tambah Kelas
                        </x-primary-button>
                    </a>
                </div>
            @endif
        </div>

        <x-ui-table>
            <x-slot name="head">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Nama Kelas</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-emerald-800 uppercase tracking-wider">Aksi</th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($kelas as $k)
                    <tr class="hover:bg-emerald-50/40 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $k->name }}</div>
                            <div class="text-xs text-gray-500">{{ $k->santris_count ?? 0 }} Santri</div>
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-600">{{ $k->description ?: '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            @if($currentUser && $currentUser->is_admin)
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('kelas.edit', $k) }}" class="inline-flex items-center gap-1.5 text-emerald-600 hover:text-emerald-900 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit
                                    </a>
                                    <form class="inline" method="POST" action="{{ route('kelas.destroy', $k) }}" onsubmit="return confirm('Hapus kelas {{ $k->name }}?');">
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
                        <td colspan="3" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <p class="mt-4 text-sm text-gray-500 font-medium">Belum ada data kelas.</p>
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-ui-table>

        <x-ui-pagination :paginator="$kelas" />
    </x-ui-card>

    @if($currentUser && $currentUser->is_admin)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openBtn = document.getElementById('open-import-modal');
            const modal = document.getElementById('import-modal');
            const closeBtn = document.getElementById('close-import-modal');
            const cancelBtn = document.getElementById('cancel-import');
            const dropArea = document.getElementById('drop-area');
            const fileInput = document.getElementById('file-input');
            const fileNameDisplay = document.getElementById('file-name');
            const dropText = document.getElementById('drop-text');

            if (openBtn && modal) {
                openBtn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });

                const closeModal = () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    fileInput.value = '';
                    fileNameDisplay.textContent = '';
                    dropText.style.display = 'block';
                    dropArea.classList.remove('bg-emerald-50', 'border-emerald-400');
                };

                closeBtn.addEventListener('click', closeModal);
                cancelBtn.addEventListener('click', closeModal);
                modal.addEventListener('click', closeModal);
            }

            if (dropArea && fileInput) {
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropArea.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults (e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    dropArea.addEventListener(eventName, highlight, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    dropArea.addEventListener(eventName, unhighlight, false);
                });

                function highlight(e) {
                    dropArea.classList.add('bg-emerald-50', 'border-emerald-400');
                }

                function unhighlight(e) {
                    dropArea.classList.remove('bg-emerald-50', 'border-emerald-400');
                }

                dropArea.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    let dt = e.dataTransfer;
                    let files = dt.files;
                    if (files.length) {
                        fileInput.files = files;
                        updateFileName();
                    }
                }

                fileInput.addEventListener('change', updateFileName);

                function updateFileName() {
                    if (fileInput.files.length > 0) {
                        fileNameDisplay.textContent = 'File terpilih: ' + fileInput.files[0].name;
                        dropText.style.display = 'none';
                        dropArea.classList.add('bg-emerald-50', 'border-emerald-400');
                    } else {
                        fileNameDisplay.textContent = '';
                        dropText.style.display = 'block';
                        dropArea.classList.remove('bg-emerald-50', 'border-emerald-400');
                    }
                }
            }
        });
    </script>
    @endif
</x-app-layout>
