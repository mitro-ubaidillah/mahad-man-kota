<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Edit Kelas') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:p-6 lg:p-8 bg-white shadow-sm rounded-lg">
            <form method="POST" action="{{ route('kelas.update', $kelas) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nama Kelas')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $kelas->name) }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="description" :value="__('Deskripsi (opsional)')" />
                    <textarea id="description" name="description" class="block mt-1 w-full border rounded p-2" rows="3">{{ old('description', $kelas->description) }}</textarea>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('kelas.index') }}" class="px-4 py-2 bg-gray-100 rounded">Kembali</a>
                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
