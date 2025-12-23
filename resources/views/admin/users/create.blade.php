<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Tambah User') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
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
                        <input type="checkbox" name="is_admin" class="form-checkbox">
                        <span class="ml-2">Is Admin</span>
                    </label>
                </div>

                <div>
                    <x-primary-button>{{ __('Create') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
