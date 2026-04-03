<x-app-layout>
    <x-slot name="header">
        {{ __('Absensi per Kelas') }} - {{ $kelas->name }}
    </x-slot>

    <div class="max-w-6xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Form Absensi Kelas {{ $kelas->name }}</h2>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form method="POST" action="{{ route('attendances.storeForKelas', $kelas->id) }}">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="activity_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kegiatan (opsional)</label>
                        <select id="activity_id" name="activity_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="">-- Buat kegiatan baru --</option>
                            @foreach($activities as $a)
                                <option value="{{ $a->id }}">{{ $a->title }} ({{ $a->displaySchedule() }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="activity_title" class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan (jika membuat baru)</label>
                        <input id="activity_title" name="activity_title" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label for="activity_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kegiatan (opsional)</label>
                        <input id="activity_date" name="activity_date" type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div class="text-sm font-medium text-gray-700">Daftar Santri</div>
                            <div class="flex items-center space-x-2">
                                <label class="text-sm">Default status untuk semua:</label>
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

                        <div class="overflow-x-auto border border-gray-200 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-3 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Masuk</th>
                                        <th class="px-3 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tidak Masuk</th>
                                        <th class="px-3 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Sakit</th>
                                        <th class="px-3 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Izin</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($santris as $s)
                                        <tr>
                                            <td class="px-3 py-2 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-600">{{ $s->nis }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-900 font-medium">{{ $s->name }}</td>
                                            <td class="px-3 py-2 text-center"><input type="radio" name="statuses[{{ $s->id }}]" value="present" checked></td>
                                            <td class="px-3 py-2 text-center"><input type="radio" name="statuses[{{ $s->id }}]" value="absent"></td>
                                            <td class="px-3 py-2 text-center"><input type="radio" name="statuses[{{ $s->id }}]" value="sick"></td>
                                            <td class="px-3 py-2 text-center"><input type="radio" name="statuses[{{ $s->id }}]" value="izin"></td>
                                            <td class="px-3 py-2"><input type="text" name="notes[{{ $s->id }}]" placeholder="Catatan (opsional)" class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm" /></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-5 border-t border-gray-100">
                        <a href="{{ route('attendances.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">Kembali</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition">Simpan Absensi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function(){
            const applyBtn = document.getElementById('apply_default');
            const defaultSel = document.getElementById('default_status');
            if(!applyBtn || !defaultSel) return;

            applyBtn.addEventListener('click', function(){
                const val = defaultSel.value;
                if(!val) return;
                document.querySelectorAll('input[name^="statuses["]')?.forEach(function(inp){
                    if(inp.value === val) inp.checked = true; else inp.checked = false;
                });
            });
        })();
    </script>
</x-app-layout>
