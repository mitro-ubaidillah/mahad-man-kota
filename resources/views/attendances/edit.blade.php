<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Edit Absensi') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('attendances.update', $attendance) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="activity_id" class="block text-sm font-medium text-gray-700">Kegiatan</label>
                        <select id="activity_id" name="activity_id" class="mt-1 block w-full border rounded px-3 py-2">
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
                        <p id="error-activity_id" class="text-sm text-red-600 hidden"></p>
                        @error('activity_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="santri_id" class="block text-sm font-medium text-gray-700">Santri</label>
                        <select id="santri_id" name="santri_id" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santris as $s)
                                <option value="{{ $s->id }}" {{ old('santri_id', $attendance->santri_id) == $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ $s->nis }})</option>
                            @endforeach
                        </select>
                        <p id="error-santri_id" class="text-sm text-red-600 hidden"></p>
                        @error('santri_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full border rounded px-3 py-2">
                            @foreach(['present' => 'Hadir', 'absent' => 'Tidak Hadir', 'late' => 'Terlambat'] as $k=>$v)
                                <option value="{{ $k }}" {{ old('status', $attendance->status) == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                        <p id="error-status" class="text-sm text-red-600 hidden"></p>
                        @error('status') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="note" class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
                        <input id="note" type="text" name="note" value="{{ old('note', $attendance->note) }}" class="mt-1 block w-full border rounded px-3 py-2" />
                        <p id="error-note" class="text-sm text-red-600 hidden"></p>
                        @error('note') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-between items-center space-x-3">
                        <a href="{{ route('attendances.index') }}" class="px-4 py-2 bg-gray-100 rounded">Kembali</a>
                        <div class="flex space-x-3">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
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
