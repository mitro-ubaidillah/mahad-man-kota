@csrf

@php
    $fieldClass = 'w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent';
    $hasGuardianError = collect(['guardian_name', 'guardian_relation', 'guardian_phone', 'guardian_address'])
        ->contains(fn ($field) => $errors->has($field));
@endphp

<div class="space-y-6" data-santri-wizard data-initial-step="{{ $hasGuardianError ? 2 : 1 }}">
    <div class="grid grid-cols-2 gap-2 rounded-2xl bg-emerald-50 p-1 text-sm font-semibold text-emerald-900">
        <button type="button" data-step-button="1" class="rounded-xl px-3 py-2 transition">1. Data Santri</button>
        <button type="button" data-step-button="2" class="rounded-xl px-3 py-2 transition">2. Data Wali Murid</button>
    </div>

    <div data-step-panel="1" class="space-y-4">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                <input id="nis" name="nis" type="text" value="{{ old('nis', $santri->nis) }}" class="{{ $fieldClass }}" placeholder="Masukkan NIS santri">
                @error('nis')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Santri</label>
                <input id="name" name="name" type="text" value="{{ old('name', $santri->name) }}" class="{{ $fieldClass }}" placeholder="Masukkan nama lengkap">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $santri->email) }}" class="{{ $fieldClass }}" placeholder="Masukkan alamat email">
                @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP Santri</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $santri->phone) }}" class="{{ $fieldClass }}" placeholder="Masukkan nomor HP aktif">
                @error('phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select id="kelas_id" name="kelas_id" class="{{ $fieldClass }}">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelasList as $k)
                        <option value="{{ $k->id }}" @selected(old('kelas_id', $santri->kelas_id) == $k->id)>{{ $k->name }}</option>
                    @endforeach
                </select>
                @error('kelas_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="kelas_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kelas Baru</label>
                <input id="kelas_name" name="kelas_name" type="text" value="{{ old('kelas_name', optional($santri->kelas)->name ?? $santri->getAttribute('kelas')) }}" class="{{ $fieldClass }}" placeholder="Isi jika kelas belum ada">
                @error('kelas_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', $santri->birth_date?->format('Y-m-d')) }}" class="{{ $fieldClass }}">
                @error('birth_date')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="previous_school" class="block text-sm font-medium text-gray-700 mb-1">Asal Sekolah</label>
                <input id="previous_school" name="previous_school" type="text" value="{{ old('previous_school', $santri->previous_school) }}" class="{{ $fieldClass }}" placeholder="Masukkan asal sekolah santri">
                @error('previous_school')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Santri</label>
                <textarea id="address" name="address" rows="4" class="{{ $fieldClass }}" placeholder="Masukkan alamat tempat tinggal santri">{{ old('address', $santri->address) }}</textarea>
                @error('address')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
            <button type="submit" name="form_action" value="draft" class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                Simpan Draft
            </button>
            <button type="button" data-next-step class="inline-flex items-center justify-center rounded-xl bg-emerald-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-800">
                Lanjut Data Wali
            </button>
        </div>
    </div>

    <div data-step-panel="2" class="space-y-4">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label for="guardian_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Wali Murid</label>
                <input id="guardian_name" name="guardian_name" type="text" value="{{ old('guardian_name', $santri->guardian_name) }}" class="{{ $fieldClass }}" placeholder="Masukkan nama wali">
                @error('guardian_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="guardian_relation" class="block text-sm font-medium text-gray-700 mb-1">Hubungan</label>
                <input id="guardian_relation" name="guardian_relation" type="text" value="{{ old('guardian_relation', $santri->guardian_relation) }}" class="{{ $fieldClass }}" placeholder="Ayah, Ibu, atau Wali">
                @error('guardian_relation')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="guardian_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP Wali</label>
                <input id="guardian_phone" name="guardian_phone" type="text" value="{{ old('guardian_phone', $santri->guardian_phone) }}" class="{{ $fieldClass }}" placeholder="Masukkan nomor HP wali">
                @error('guardian_phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2">
                <label for="guardian_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Wali</label>
                <textarea id="guardian_address" name="guardian_address" rows="4" class="{{ $fieldClass }}" placeholder="Masukkan alamat wali murid">{{ old('guardian_address', $santri->guardian_address) }}</textarea>
                @error('guardian_address')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-col gap-3 sm:flex-row">
                <button type="button" data-prev-step class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Kembali
                </button>
                <button type="submit" name="form_action" value="draft" class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Simpan Draft
                </button>
            </div>

            <button type="submit" name="form_action" value="submit" class="inline-flex items-center justify-center rounded-xl bg-emerald-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-800">
                {{ $submitLabel }}
            </button>
        </div>
    </div>
</div>

<script>
    (function () {
        const wizard = document.querySelector('[data-santri-wizard]');
        if (!wizard) return;

        const buttons = wizard.querySelectorAll('[data-step-button]');
        const panels = wizard.querySelectorAll('[data-step-panel]');

        function showStep(step) {
            buttons.forEach(function (button) {
                const isActive = button.dataset.stepButton === String(step);
                button.classList.toggle('bg-white', isActive);
                button.classList.toggle('shadow-sm', isActive);
                button.classList.toggle('text-emerald-950', isActive);
                button.classList.toggle('text-emerald-700', !isActive);
            });

            panels.forEach(function (panel) {
                panel.classList.toggle('hidden', panel.dataset.stepPanel !== String(step));
            });
        }

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                showStep(button.dataset.stepButton);
            });
        });

        wizard.querySelectorAll('[data-next-step]').forEach(function (button) {
            button.addEventListener('click', function () {
                showStep(2);
            });
        });

        wizard.querySelectorAll('[data-prev-step]').forEach(function (button) {
            button.addEventListener('click', function () {
                showStep(1);
            });
        });

        showStep(wizard.dataset.initialStep || 1);
    })();
</script>
