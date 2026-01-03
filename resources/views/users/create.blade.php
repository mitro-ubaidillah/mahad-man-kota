<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Tambah User') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:p-6 lg:p-8 bg-white shadow-sm rounded-lg">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autocomplete="off" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="hidden" name="is_admin" value="0">
                        <input type="checkbox" name="is_admin" value="1" class="form-checkbox" {{ old('is_admin', 0) == 1 ? 'checked' : '' }}>
                        <span class="ml-2">Is Admin</span>
                    </label>
                </div>

                <div>
                    <x-primary-button id="submit-btn">{{ __('Create') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
