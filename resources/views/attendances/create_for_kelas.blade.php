<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Absensi per Kelas') }} - {{ $kelas->name }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('attendances.storeForKelas', $kelas->id) }}">
                    @csrf

                    <div class="mb-4">
                        <label for="activity_id" class="block text-sm font-medium text-gray-700">Pilih Kegiatan (opsional)</label>
                        <select id="activity_id" name="activity_id" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="">-- Buat kegiatan baru --</option>
                            @foreach($activities as $a)
                                <option value="{{ $a->id }}">{{ $a->title }} ({{ $a->displaySchedule() }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="activity_title" class="block text-sm font-medium text-gray-700">Judul Kegiatan (jika membuat baru)</label>
                        <input id="activity_title" name="activity_title" class="mt-1 block w-full border rounded px-3 py-2" />
                    </div>

                    <div class="mb-4">
                        <label for="activity_date" class="block text-sm font-medium text-gray-700">Tanggal Kegiatan (opsional)</label>
                        <input id="activity_date" name="activity_date" type="date" class="mt-1 block w-full border rounded px-3 py-2" />
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="text-sm font-medium text-gray-700">Daftar Santri</div>
                            <div class="flex items-center space-x-2">
                                <label class="text-sm">Default status untuk semua:</label>
                                <select id="default_status" class="block border rounded px-2 py-1 text-sm">
                                    <option value="">(tidak ada)</option>
                                    <option value="present">Hadir</option>
                                    <option value="absent">Tidak Hadir</option>
                                    <option value="sick">Sakit</option>
                                    <option value="izin">Izin</option>
                                </select>
                                <button type="button" id="apply_default" class="px-2 py-1 bg-gray-100 rounded text-sm">Terapkan</button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full border">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-2 border">#</th>
                                        <th class="px-3 py-2 border">NIS</th>
                                        <th class="px-3 py-2 border">Nama</th>
                                        <th class="px-3 py-2 border">Masuk</th>
                                        <th class="px-3 py-2 border">Tidak Masuk</th>
                                        <th class="px-3 py-2 border">Sakit</th>
                                        <th class="px-3 py-2 border">Izin</th>
                                        <th class="px-3 py-2 border">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($santris as $s)
                                        <tr class="border-b">
                                            <td class="px-3 py-2 border text-sm">{{ $loop->iteration }}</td>
                                            <td class="px-3 py-2 border text-sm">{{ $s->nis }}</td>
                                            <td class="px-3 py-2 border text-sm">{{ $s->name }}</td>
                                            <td class="px-3 py-2 border text-center"><input type="radio" name="statuses[{{ $s->id }}]" value="present" checked></td>
                                            <td class="px-3 py-2 border text-center"><input type="radio" name="statuses[{{ $s->id }}]" value="absent"></td>
                                            <td class="px-3 py-2 border text-center"><input type="radio" name="statuses[{{ $s->id }}]" value="sick"></td>
                                            <td class="px-3 py-2 border text-center"><input type="radio" name="statuses[{{ $s->id }}]" value="izin"></td>
                                            <td class="px-3 py-2 border"><input type="text" name="notes[{{ $s->id }}]" placeholder="Catatan (opsional)" class="block w-full border rounded px-2 py-1 text-sm" /></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('attendances.index') }}" class="px-4 py-2 bg-gray-100 rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan Absensi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
