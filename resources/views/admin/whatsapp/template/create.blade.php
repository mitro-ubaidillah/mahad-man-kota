<x-app-layout>
    <x-slot name="header">{{ __('Tambah Template WA') }}</x-slot>

    <div class="max-w-2xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tambah Template WA</h2>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-300 text-red-700 rounded-lg text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.wa-template.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Template</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" placeholder="Misal: Pemberitahuan Hadir">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe (Trigger)</label>
                    <input type="text" name="type" value="{{ old('type') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" placeholder="Misal: attendance_present">
                    <p class="text-xs text-gray-500 mt-1">Harus unik. Gunakan kode seperti: attendance_present, attendance_absent, attendance_late</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Isi Pesan</label>
                    <textarea name="message" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" placeholder="Gunakan variabel: {nama_santri}, {kelas}, {waktu}">{{ old('message') }}</textarea>
                    <p class="text-xs text-blue-600 mt-1">Variabel tersedia: <b>{nama_santri}, {nis}, {kelas}, {status}, {waktu}, {note}</b></p>
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="w-4 h-4 accent-green-600" {{ old('is_active', true) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700">Aktifkan Template</span>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t border-gray-100">
                    <a href="{{ route('admin.wa-template.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold rounded-xl transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
