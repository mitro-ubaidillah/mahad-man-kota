<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Tambah Kelas') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:p-6 lg:p-8 bg-white shadow-sm rounded-lg">
            <form method="POST" action="{{ route('kelas.store') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nama Kelas')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="description" :value="__('Deskripsi (opsional)')" />
                    <textarea id="description" name="description" class="block mt-1 w-full border rounded p-2" rows="3">{{ old('description') }}</textarea>
                </div>

                <div>
                    <x-primary-button>{{ __('Create') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
