<x-app-layout>
    <x-slot name="header">
        {{ __('Kirim Pengumuman / Broadcast WA') }}
    </x-slot>

    <div class="max-w-2xl">
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-emerald-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-lg font-semibold text-gray-800 mb-4">Form Broadcast WhatsApp</h2>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('admin.wa-broadcast.send') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Jenis Target</label>
                        <select name="target_type" id="target_type" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" onchange="toggleTargetFields()" required>
                            <option value="all">Seluruh Wali Santri (Semua Kelas)</option>
                            <option value="kelas">Berdasarkan Kelas Tertentu</option>
                            <option value="santri">Pilih Wali Santri / Murid Tertentu</option>
                        </select>
                    </div>

                    <div class="hidden" id="field_kelas">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kelas</label>
                        <select name="target_kelas" id="target_kelas" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->name }}">Kelas {{ $k->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="hidden" id="field_santri">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Santri / Murid</label>
                        <select name="target_santri" id="target_santri" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="">-- Cari Nama Santri --</option>
                            @foreach($santris as $s)
                                <option value="{{ $s->id }}">{{ $s->name }} - {{ $s->phone ?? 'No HP Kosong' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-emerald-600 text-emerald-700 hover:bg-emerald-50 text-sm font-semibold rounded-lg transition" onclick="toggleTemplateBox()">
                            Gunakan Template
                        </button>
                    </div>

                    <div id="template-box" class="hidden p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <label class="block text-xs font-semibold text-gray-700 mb-2">Pilih Template</label>
                        <select id="template-selector" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" onchange="insertTemplate()">
                            <option value="">-- Kosong --</option>
                            @foreach($templates as $tpl)
                                <option value="{{ $tpl->message }}">{{ $tpl->name }} ({{ $tpl->type }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Isi Pesan</label>
                        <textarea id="message-body" name="message" rows="6" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" placeholder="Ketik pengumuman yang akan dikirim.." required></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t border-gray-100">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold rounded-xl transition">
                        Kirim Broadcast
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleTargetFields() {
            var type = document.getElementById('target_type').value;
            var fKelas = document.getElementById('field_kelas');
            var fSantri = document.getElementById('field_santri');
            var sKelas = document.getElementById('target_kelas');
            var sSantri = document.getElementById('target_santri');

            fKelas.classList.add('hidden');
            fSantri.classList.add('hidden');
            sKelas.removeAttribute('required');
            sSantri.removeAttribute('required');

            if (type === 'kelas') {
                fKelas.classList.remove('hidden');
                sKelas.setAttribute('required', 'required');
            } else if (type === 'santri') {
                fSantri.classList.remove('hidden');
                sSantri.setAttribute('required', 'required');
            }
        }

        function toggleTemplateBox() {
            var box = document.getElementById('template-box');
            if (box.classList.contains('hidden')) {
                box.classList.remove('hidden');
            } else {
                box.classList.add('hidden');
            }
        }

        function insertTemplate() {
            var selector = document.getElementById('template-selector');
            var textArea = document.getElementById('message-body');
            
            if(selector.value !== "") {
                textArea.value = selector.value;
            }
        }

        // Initialize display state on load
        document.addEventListener('DOMContentLoaded', function() {
            toggleTargetFields();
        });
    </script>
</x-app-layout>