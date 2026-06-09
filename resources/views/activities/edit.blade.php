<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Kegiatan') }}
    </x-slot>

    <div class="max-w-3xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Form Edit Kegiatan</h2>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form method="POST" action="{{ route('activities.update', $activity) }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input id="title" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" placeholder="Masukkan judul" type="text" name="title" value="{{ old('title', $activity->title) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" />
                        <p id="error-title" class="text-sm text-red-600 hidden mt-1"></p>
                        @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="description" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" placeholder="Masukkan deskripsi (opsional)" name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">{{ old('description', $activity->description) }}</textarea>
                        <p id="error-description" class="text-sm text-red-600 hidden mt-1"></p>
                        @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipe Penjadwalan</label>
                        <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <label class="inline-flex items-center"><input type="radio" name="recurrence_type" value="single" class="h-4 w-4 text-emerald-600" {{ old('recurrence_type', $activity->recurrence_type ?? 'single') == 'single' ? 'checked' : '' }} /><span class="ms-2">Tanggal mulai saja</span></label>
                            <label class="inline-flex items-center"><input type="radio" name="recurrence_type" value="range" class="h-4 w-4 text-emerald-600" {{ old('recurrence_type', $activity->recurrence_type) == 'range' ? 'checked' : '' }} /><span class="ms-2">Rentang tanggal</span></label>
                            <label class="inline-flex items-center"><input type="radio" name="recurrence_type" value="daily" class="h-4 w-4 text-emerald-600" {{ old('recurrence_type', $activity->recurrence_type) == 'daily' ? 'checked' : '' }} /><span class="ms-2">Setiap hari</span></label>
                            <label class="inline-flex items-center"><input type="radio" name="recurrence_type" value="weekdays" class="h-4 w-4 text-emerald-600" {{ old('recurrence_type', $activity->recurrence_type) == 'weekdays' ? 'checked' : '' }} /><span class="ms-2">Pilih hari tertentu</span></label>
                        </div>
                    </div>

                    <div id="weekdays-box" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih hari</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2 text-sm">
                            @foreach(['Mon'=>'Sen','Tue'=>'Sel','Wed'=>'Rab','Thu'=>'Kam','Fri'=>'Jum','Sat'=>'Sab','Sun'=>'Min'] as $key=>$label)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="weekdays[]" value="{{ $key }}" class="h-4 w-4 text-emerald-600" {{ (is_array(old('weekdays')) && in_array($key, old('weekdays'))) || (empty(old()) && is_array($activity->weekdays) && in_array($key, $activity->weekdays)) ? 'checked' : '' }} />
                                    <span class="ms-2">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div id="schedule-preview-box" class="bg-green-50 border border-green-100 rounded-lg px-3 py-2">
                        <div class="text-xs font-medium text-emerald-700">Preview Jadwal</div>
                        <div id="schedule-preview" class="mt-1 text-sm text-green-800">-</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div id="start-box">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                            <input id="start_date" type="date" name="start_date" value="{{ old('start_date', $activity->start_date?->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" />
                            <p id="error-start_date" class="text-sm text-red-600 hidden mt-1"></p>
                            @error('start_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div id="end-box">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai (opsional)</label>
                            <input id="end_date" type="date" name="end_date" value="{{ old('end_date', $activity->end_date?->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" />
                            <p id="error-end_date" class="text-sm text-red-600 hidden mt-1"></p>
                            @error('end_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div id="time-start-box">
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                            <input id="start_time" type="time" name="start_time" value="{{ old('start_time', $activity->start_time) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" />
                            <p id="error-start_time" class="text-sm text-red-600 hidden mt-1"></p>
                            @error('start_time') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div id="time-end-box">
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai (opsional)</label>
                            <input id="end_time" type="time" name="end_time" value="{{ old('end_time', $activity->end_time) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" />
                            <p id="error-end_time" class="text-sm text-red-600 hidden mt-1"></p>
                            @error('end_time') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6 pt-5 border-t border-gray-100">
                    <a href="{{ route('activities.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">Kembali</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold rounded-xl transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        (function(){
            const form = document.querySelector('form[action="{{ route('activities.update', $activity) }}"]');
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

            // handle UI toggles based on recurrence_type selection
            function updateRecurrenceUI(){
                const type = document.querySelector('input[name="recurrence_type"]:checked')?.value || 'single';
                const startBox = document.getElementById('start-box');
                const endBox = document.getElementById('end-box');
                const weekdaysBox = document.getElementById('weekdays-box');

                if(type === 'daily'){
                    startBox.style.display = 'none';
                    endBox.style.display = 'none';
                    weekdaysBox.classList.add('hidden');
                } else if(type === 'single'){
                    startBox.style.display = 'block';
                    endBox.style.display = 'none';
                    weekdaysBox.classList.add('hidden');
                } else if(type === 'range'){
                    startBox.style.display = 'block';
                    endBox.style.display = 'block';
                    weekdaysBox.classList.add('hidden');
                } else if(type === 'weekdays'){
                    startBox.style.display = 'none';
                    endBox.style.display = 'none';
                    weekdaysBox.classList.remove('hidden');
                }
            }

            document.querySelectorAll('input[name="recurrence_type"]').forEach(function(r){ r.addEventListener('change', function(){ updateRecurrenceUI(); updateSchedulePreview(); }); });
            updateRecurrenceUI();
            updateSchedulePreview();
            document.getElementById('start_time')?.addEventListener('input', updateSchedulePreview);
            document.getElementById('end_time')?.addEventListener('input', updateSchedulePreview);
            document.getElementById('start_date')?.addEventListener('change', updateSchedulePreview);
            document.getElementById('end_date')?.addEventListener('change', updateSchedulePreview);
            document.querySelectorAll('input[name="weekdays[]"]').forEach(cb=>cb.addEventListener('change', updateSchedulePreview));

            function updateSchedulePreview(){
                const preview = document.getElementById('schedule-preview');
                if(!preview) return;
                const rtype = document.querySelector('input[name="recurrence_type"]:checked')?.value || 'single';
                const sd = document.getElementById('start_date')?.value;
                const ed = document.getElementById('end_date')?.value;
                const st = document.getElementById('start_time')?.value;
                const et = document.getElementById('end_time')?.value;

                let text = '';
                if(rtype === 'daily'){
                    text = 'Harian';
                } else if(rtype === 'weekdays'){
                    const days = Array.from(document.querySelectorAll('input[name="weekdays[]"]:checked')).map(cb=>cb.value);
                    text = days.length ? days.join(',') : 'Pilih hari';
                } else if(rtype === 'range'){
                    text = sd ? sd : '-';
                    if(ed) text += ' - ' + ed;
                } else { // single
                    text = sd ? sd : '-';
                }

                if(st && et){
                    text += ' (' + st + ' - ' + et + ')';
                } else if(st){
                    text += ' (' + st + ' - selesai)';
                }

                preview.textContent = text;
            }

            form.addEventListener('submit', function(e){
                let valid = true;
                const title = document.getElementById('title');
                const startDate = document.getElementById('start_date');
                const endDate = document.getElementById('end_date');

                clearError('error-title');
                clearError('error-start_date');
                clearError('error-end_date');

                if(!title.value.trim()){
                    showError('error-title', 'Judul wajib diisi.');
                    valid = false;
                } else if(title.value.length > 255){
                    showError('error-title', 'Judul maksimal 255 karakter.');
                    valid = false;
                }

                const rtypeNow = document.querySelector('input[name="recurrence_type"]:checked')?.value || 'single';
                if(rtypeNow === 'single' || rtypeNow === 'range'){
                    if(!startDate.value){
                        showError('error-start_date', 'Tanggal mulai wajib diisi.');
                        valid = false;
                    }
                }
                if(rtypeNow === 'range'){
                    if(!endDate.value){
                        showError('error-end_date', 'Tanggal selesai wajib diisi untuk rentang.');
                        valid = false;
                    } else {
                        const sd = new Date(startDate.value);
                        const ed = new Date(endDate.value);
                        if(ed < sd){
                            showError('error-end_date', 'Tanggal selesai tidak boleh sebelum tanggal mulai.');
                            valid = false;
                        }
                    }
                }

                const rtype = document.querySelector('input[name="recurrence_type"]:checked')?.value || 'single';
                if(rtype === 'weekdays'){
                    const checked = Array.from(document.querySelectorAll('input[name="weekdays[]"]')).some(cb=>cb.checked);
                    if(!checked){
                        showError('error-start_date', 'Pilih minimal satu hari untuk pengulangan.');
                        valid = false;
                    }
                }

                if(!valid) e.preventDefault();
            });
        })();
    </script>
</x-app-layout>
