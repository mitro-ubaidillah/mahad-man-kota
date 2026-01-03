<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Edit User') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:p-6 lg:p-8 bg-white shadow-sm rounded-lg">
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $user->name) }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password (leave blank to keep)')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="hidden" name="is_admin" value="0">
                        <input type="checkbox" name="is_admin" value="1" class="form-checkbox" {{ old('is_admin', $user->is_admin ? 1 : 0) == 1 ? 'checked' : '' }}>
                        <span class="ml-2">Is Admin</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-100 rounded">Kembali</a>
                    <x-primary-button id="submit-btn">{{ __('Update') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
