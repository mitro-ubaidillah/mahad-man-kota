<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Santri') }}
    </x-slot>

    <div class="max-w-4xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Form Edit Santri</h2>

        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('santris.update', $santri) }}">
                @method('PUT')

                @include('santris._form', [
                    'santri' => $santri,
                    'kelasList' => $kelasList,
                    'submitLabel' => 'Simpan Perubahan',
                ])
            </form>
        </div>
    </div>
</x-app-layout>
