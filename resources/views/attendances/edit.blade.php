<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Absensi') }}
    </x-slot>

    <div class="max-w-3xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Form Edit Absensi</h2>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form method="POST" action="{{ route('attendances.update', $attendance) }}">
                @csrf
                @method('PUT')

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
                                <option value="{{ $act->id }}" {{ old('activity_id', $attendance->activity_id) == $act->id ? 'selected' : '' }}>{{ $act->title }} ({{ $label }}{{ $act->time ? ' '.$act->time : '' }})</option>
                            @endforeach
                        </select>
                        <p id="error-activity_id" class="text-sm text-red-600 hidden mt-1"></p>
                        @error('activity_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="santri_id" class="block text-sm font-medium text-gray-700 mb-1">Santri</label>
                        <select id="santri_id" name="santri_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santris as $s)
                                <option value="{{ $s->id }}" {{ old('santri_id', $attendance->santri_id) == $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ $s->nis }})</option>
                            @endforeach
                        </select>
                        <p id="error-santri_id" class="text-sm text-red-600 hidden mt-1"></p>
                        @error('santri_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            @foreach(['present' => 'Hadir', 'absent' => 'Tidak Hadir', 'late' => 'Terlambat'] as $k=>$v)
                                <option value="{{ $k }}" {{ old('status', $attendance->status) == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                        <p id="error-status" class="text-sm text-red-600 hidden mt-1"></p>
                        @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="note" class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                        <input id="note" type="text" name="note" value="{{ old('note', $attendance->note) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" />
                        <p id="error-note" class="text-sm text-red-600 hidden mt-1"></p>
                        @error('note') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-5 border-t border-gray-100">
                        <a href="{{ route('attendances.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">Kembali</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold rounded-xl transition">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        (function(){
            const form = document.querySelector('form[action="{{ route('attendances.update', $attendance) }}"]');
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
                clearError('error-status');
                clearError('error-note');

                const act = document.getElementById('activity_id');
                const san = document.getElementById('santri_id');
                const status = document.getElementById('status');
                const note = document.getElementById('note');

                if(!act.value){
                    showError('error-activity_id', 'Silakan pilih kegiatan.');
                    valid = false;
                }
                if(!san.value){
                    showError('error-santri_id', 'Silakan pilih santri.');
                    valid = false;
                }
                if(!status.value){
                    showError('error-status', 'Silakan pilih status.');
                    valid = false;
                }
                if(note.value && note.value.length > 255){
                    showError('error-note', 'Catatan maksimal 255 karakter.');
                    valid = false;
                }

                if(!valid) e.preventDefault();
            });
        })();
    </script>
</x-app-layout>
