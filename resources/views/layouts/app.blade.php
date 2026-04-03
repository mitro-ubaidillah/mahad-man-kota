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
<body class="font-sans antialiased text-gray-900 bg-gray-100">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden bg-gray-100">
            
            <!-- Sidebar Navigation -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col overflow-hidden">
                
                <!-- Top Nav / Header Header -->
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-emerald-600">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        
                        @if (isset($header))
                            <h2 class="ml-4 font-semibold text-xl text-gray-800 leading-tight">
                                {{ $header }}
                            </h2>
                        @endif
                    </div>

                    <div class="flex items-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-gray-700 hover:text-red-500 flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                    <div class="container mx-auto px-6 py-8">
                        {{-- Flash messages as modal pop-up using Alpine (auto-close for success) --}}
                        @if(session('success') || session('error') || session('info'))
                            <div x-data="{ open: true }" x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                <div class="fixed inset-0 bg-black/50" @click="open = false"></div>
                                
                                <div class="bg-white rounded-lg shadow-lg p-6 z-50 max-w-lg w-full mx-4 relative">
                                    <div class="flex flex-col items-center text-center">
                                        @if(session('success'))
                                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                                                <svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            <div class="text-green-800 font-bold text-lg">Berhasil!</div>
                                            <div class="mt-2 text-sm text-gray-600">{{ session('success') }}</div>
                                        @elseif(session('error'))
                                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </div>
                                            <div class="text-red-800 font-bold text-lg">Error!</div>
                                            <div class="mt-2 text-sm text-gray-600">{{ session('error') }}</div>
                                        @else
                                            <div class="text-blue-800 font-bold text-lg">Info</div>
                                            <div class="mt-2 text-sm text-gray-600">{{ session('info') }}</div>
                                        @endif
                                        
                                        <button @click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <script>
                                (function(){
                                    // Auto-close flash messages (success/error/info) after 2s
                                    @if(session('success') || session('error') || session('info'))
                                        setTimeout(function(){
                                            const el = document.querySelector('[x-data]');
                                            if(el) el.__x.$data.open = false;
                                        }, 2000);
                                    @endif
                                })();
                            </script>
                        @endif

                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
