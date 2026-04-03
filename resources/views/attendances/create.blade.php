<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Absensi') }}
    </x-slot>

    <div class="max-w-4xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Form Tambah Absensi</h2>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form method="POST" action="{{ route('attendances.store') }}">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="activity_id" class="block text-sm font-medium text-gray-700 mb-1">Kegiatan</label>
                        <select id="activity_id" name="activity_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach($activities as $act)
                                @php
                                    if($act->recurring_daily){
                                        $label = 'Harian';
                                    } elseif($act->start_date && $act->end_date){
                                        $label = $act->start_date->format('Y-m-d').' - '.$act->end_date->format('Y-m-d');
                                    } elseif($act->start_date){
                                        $label = $act->start_date->format('Y-m-d');
                                    } else {
                                        $label = $act->activity_date?->format('Y-m-d') ?? '-';
                                    }
                                @endphp
                                <option value="{{ $act->id }}" {{ old('activity_id') == $act->id ? 'selected' : '' }}>{{ $act->title }} ({{ $label }}{{ $act->time ? ' '.$act->time : '' }}) @if($act->kelas) - {{ $act->kelas->name }} @endif</option>
                            @endforeach
                        </select>
                        <p id="error-activity_id" class="text-sm text-red-600 hidden mt-1"></p>
                        @error('activity_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <select id="kelas_id" name="kelas_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="">-- Pilih Kelas (opsional) --</option>
                            @foreach($kelasList as $k)
                                <option value="{{ $k->id }}">{{ $k->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih kelas untuk memuat daftar santri (ditujukan untuk dataset besar).</p>
                    </div>

                    <div id="santri_area">
                        <div class="flex items-center justify-between mb-2">
                            <div class="text-sm font-medium text-gray-700">Daftar Santri</div>
                            <div class="flex items-center space-x-2">
                                <label for="default_status" class="text-sm">Default status untuk semua:</label>
                                <select id="default_status" class="block border border-gray-300 rounded-lg px-2 py-1 text-sm">
                                    <option value="">(tidak ada)</option>
                                    <option value="present">Hadir</option>
                                    <option value="absent">Tidak Hadir</option>
                                    <option value="sick">Sakit</option>
                                    <option value="izin">Izin</option>
                                </select>
                                <button type="button" id="apply_default" class="inline-flex items-center px-3 py-1.5 bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-medium rounded-md transition">Terapkan</button>
                            </div>
                        </div>

                        <div id="santri_table_container" class="mt-2 border border-gray-200 rounded-lg p-3 bg-gray-50">
                            <div class="text-sm text-gray-500">Pilih kelas untuk memuat daftar santri dan menandai absensi.</div>
                        </div>
                    </div>

                    <!-- Status and note removed from single-attendance form; use kelas-based bulk attendance to set statuses -->

                    <div class="flex justify-end gap-3 pt-5 border-t border-gray-100">
                        <a href="{{ route('attendances.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">Kembali</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        (function(){
            const form = document.querySelector('form[action="{{ route('attendances.store') }}"]');
            if(!form) return;

            function showError(id, msg){
                const el = document.getElementById(id);
                if(!el) return;
                el.textContent = msg;
                el.classList.remove('hidden');
            }
            function clearError(id){
                const el = document.getElementById(id);
                if(!el) return;
                el.textContent = '';
                el.classList.add('hidden');
            }

            form.addEventListener('submit', function(e){
                let valid = true;

                clearError('error-activity_id');
                clearError('error-santri_id');

                const act = document.getElementById('activity_id');
                const kelas = document.getElementById('kelas_id');

                if(!act.value){
                    showError('error-activity_id', 'Silakan pilih kegiatan.');
                    valid = false;
                }
                // If kelas is selected, bulk attendance table handles statuses. Otherwise ensure a santri is selected.
                if(!kelas.value) {
                    const san = document.getElementById('santri_id');
                    if(!san || !san.value){
                        showError('error-santri_id', 'Silakan pilih santri.');
                        valid = false;
                    }
                }

                if(!valid) e.preventDefault();
            });

            // AJAX: load santris for selected kelas (supports large datasets) and render as table
            const kelasSelect = document.getElementById('kelas_id');
            const tableContainer = document.getElementById('santri_table_container');
            const santrisUrlTemplate = "{{ route('kelas.santris', ['kelas' => 'KELAS_ID']) }}";

            function renderSantriTable(data){
                if(!Array.isArray(data) || data.length === 0){
                    tableContainer.innerHTML = '<div class="text-sm text-gray-500">Tidak ada santri di kelas ini.</div>';
                    return;
                }
                let html = '<div class="overflow-x-auto"><table class="min-w-full border">';
                html += '<thead class="bg-gray-50"><tr>'+
                    '<th class="px-3 py-2 border">#</th>'+
                    '<th class="px-3 py-2 border">NIS</th>'+
                    '<th class="px-3 py-2 border">Nama</th>'+
                    '<th class="px-3 py-2 border">Masuk</th>'+
                    '<th class="px-3 py-2 border">Tidak Masuk</th>'+
                    '<th class="px-3 py-2 border">Sakit</th>'+
                    '<th class="px-3 py-2 border">Izin</th>'+
                    '<th class="px-3 py-2 border">Catatan</th>'+
                    '</tr></thead><tbody>';

                data.forEach(function(s, idx){
                    html += '<tr class="border-b">' +
                        '<td class="px-3 py-2 border text-sm">' + (idx+1) + '</td>' +
                        '<td class="px-3 py-2 border text-sm">' + (s.nis ?? '') + '</td>' +
                        '<td class="px-3 py-2 border text-sm">' + (s.name ?? '') + '</td>' +
                        '<td class="px-3 py-2 border text-center"><input type="radio" name="statuses['+s.id+']" value="present" checked></td>' +
                        '<td class="px-3 py-2 border text-center"><input type="radio" name="statuses['+s.id+']" value="absent"></td>' +
                        '<td class="px-3 py-2 border text-center"><input type="radio" name="statuses['+s.id+']" value="sick"></td>' +
                        '<td class="px-3 py-2 border text-center"><input type="radio" name="statuses['+s.id+']" value="izin"></td>' +
                        '<td class="px-3 py-2 border"><input type="text" name="notes['+s.id+']" placeholder="Catatan (opsional)" class="block w-full border rounded px-2 py-1 text-sm" /></td>' +
                        '</tr>';
                });

                html += '</tbody></table></div>';
                tableContainer.innerHTML = html;
            }

            function setLoading(){
                tableContainer.innerHTML = '<div class="text-sm text-gray-500">Memuat santri...</div>';
            }

            if(kelasSelect){
                kelasSelect.addEventListener('change', function(){
                    const kelasId = this.value;
                    if(!kelasId){
                        tableContainer.innerHTML = '<div class="text-sm text-gray-500">Pilih kelas untuk memuat daftar santri dan menandai absensi.</div>';
                        return;
                    }
                    setLoading();
                    const url = santrisUrlTemplate.replace('KELAS_ID', kelasId);
                    fetch(url, { headers: { 'Accept': 'application/json' } })
                        .then(r => { if(!r.ok) throw new Error('Network response was not ok'); return r.json(); })
                        .then(data => {
                            renderSantriTable(data);
                        })
                        .catch(err => {
                            console.error(err);
                            tableContainer.innerHTML = '<div class="text-sm text-red-600">Gagal memuat santri.</div>';
                        });
                });
            }

            // default status apply button: set radio per group
            const applyBtn = document.getElementById('apply_default');
            const defaultSel = document.getElementById('default_status');
            if(applyBtn && defaultSel){
                applyBtn.addEventListener('click', function(){
                    const val = defaultSel.value;
                    if(!val) return;
                    document.querySelectorAll('input[name^="statuses["]')?.forEach(function(inp){
                        if(inp.value === val) inp.checked = true; else inp.checked = false;
                    });
                });
            }
        })();
    </script>
</x-app-layout>
