<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Santri') }}
    </x-slot>

    <div class="max-w-4xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Form Tambah Santri</h2>

        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('santris.store') }}">
                @include('santris._form', [
                    'santri' => new \App\Models\Santri(),
                    'kelasList' => $kelasList,
                    'submitLabel' => 'Simpan Santri',
                ])
            </form>
        </div>
    </div>
</x-app-layout>
