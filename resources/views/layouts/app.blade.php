<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{-- Flash messages as modal pop-up using Alpine (auto-close for success) --}}
                @if(session('success') || session('error') || session('info'))
                    <div x-data="{ open: true }" x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                        <div class="fixed inset-0 bg-black/50" @click="open = false"></div>

                        <div class="bg-white rounded-lg shadow-lg p-6 z-50 max-w-lg w-full mx-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    @if(session('success'))
                                        <div class="text-green-800 font-semibold">Sukses</div>
                                        <div class="mt-1 text-sm text-green-700">{{ session('success') }}</div>
                                    @elseif(session('error'))
                                        <div class="text-red-800 font-semibold">Error</div>
                                        <div class="mt-1 text-sm text-red-700">{{ session('error') }}</div>
                                    @else
                                        <div class="text-blue-800 font-semibold">Info</div>
                                        <div class="mt-1 text-sm text-blue-700">{{ session('info') }}</div>
                                    @endif
                                </div>
                                <div class="ms-4">
                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        (function(){
                            // Auto-close flash messages (success/error/info) after 1.5s
                            @if(session('success') || session('error') || session('info'))
                                setTimeout(function(){
                                    const el = document.querySelector('[x-data]');
                                    if(el) el.__x.$data.open = false;
                                }, 1500);
                            @endif
                        })();
                    </script>
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
