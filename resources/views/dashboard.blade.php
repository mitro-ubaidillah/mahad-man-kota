<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    @if (auth()->check() && auth()->user()->is_admin)
                        <div class="mt-4">
                            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded">Manage Users</a>
                        </div>
                    @endif

                    @if (auth()->check())
                        <div class="mt-4">
                            <a href="{{ route('santris.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Manage Santris</a>
                        </div>
                    @endif
                    
                    <!-- Tailwind test banner -->
                    <div class="mt-8">
                        <div class="p-4 rounded shadow-lg bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
                            <h3 class="text-lg font-semibold">Tailwind test</h3>
                            <p class="text-sm opacity-90">If you see this banner styled with a gradient background and white text, Tailwind CSS is loading correctly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
