<!-- Sidebar Backdrop (for mobile) -->
<div x-show="sidebarOpen" class="fixed inset-0 z-20 bg-black/50 transition-opacity lg:hidden" @click="sidebarOpen = false"></div>

<!-- Sidebar -->
<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-72 transition duration-300 transform bg-white/90 backdrop-blur-xl overflow-y-auto lg:translate-x-0 lg:static lg:inset-auto border-r border-emerald-900/10 shadow-[0_18px_45px_rgba(16,36,24,0.07)] flex flex-col">
    <!-- Logo -->
    <div class="p-5 border-b border-emerald-900/10">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-3xl bg-emerald-50 p-3">
            <span class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-900 text-xl font-black text-white">م</span>
            <span>
                <strong class="block text-base font-black text-emerald-900">Admin Ma’had</strong>
                <small class="block text-xs font-semibold text-gray-500">Panel Absensi</small>
            </span>
        </a>
    </div>

    <!-- Nav Links -->
    <nav class="flex-1 px-5 py-5 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-800 shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-800' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        @superAdmin
            <a href="{{ route('mahad-admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-bold text-gray-700 rounded-2xl transition hover:bg-emerald-50 hover:text-emerald-800">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 4v6h6M8 13h8M8 17h6" />
                </svg>
                Admin Artikel
            </a>
        @endsuperAdmin

        @auth
            @admin
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-black text-amber-700 uppercase tracking-wider">Master Data</p>
            </div>
            
            <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition {{ request()->routeIs('users.*') ? 'bg-emerald-50 text-emerald-800 shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-800' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Admin & User
            </a>

            <a href="{{ route('kelas.index') }}" class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition {{ request()->routeIs('kelas.*') ? 'bg-emerald-50 text-emerald-800 shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-800' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Data Kelas
            </a>
            @endadmin

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-black text-amber-700 uppercase tracking-wider">Aktivitas</p>
            </div>

            <a href="{{ route('santris.index') }}" class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition {{ request()->routeIs('santris.*') ? 'bg-emerald-50 text-emerald-800 shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-800' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
                Santri / Murid
            </a>

            <a href="{{ route('activities.index') }}" class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition {{ request()->routeIs('activities.*') ? 'bg-emerald-50 text-emerald-800 shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-800' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Kegiatan
            </a>

            <a href="{{ route('attendances.index') }}" class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition {{ request()->routeIs('attendances.*') ? 'bg-emerald-50 text-emerald-800 shadow-sm' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-800' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                Catatan Absensi
            </a>

            @admin
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-black text-amber-700 uppercase tracking-wider">Lainnya</p>
            </div>

            <!-- Area Settings terpadu -->
            <div x-data="{ isSettingOpen: {{ request()->routeIs('admin.wa-*') || request()->routeIs('profile.edit') ? 'true' : 'false' }} }">
                <button @click="isSettingOpen = !isSettingOpen" class="w-full flex items-center justify-between px-4 py-3 text-sm font-bold text-gray-700 rounded-2xl transition hover:bg-emerald-50 hover:text-emerald-800 focus:outline-none focus:bg-emerald-50">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings
                    </div>
                    <svg :class="{'rotate-180': isSettingOpen}" class="h-4 w-4 transform transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div x-show="isSettingOpen" class="mt-2 space-y-1 px-4 ml-4 border-l-2 border-emerald-100">
                    <a href="{{ route('admin.wa-device.index') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 rounded-xl {{ request()->routeIs('admin.wa-device.*') ? 'text-emerald-800 bg-emerald-50' : 'hover:text-emerald-800 hover:bg-emerald-50' }}">
                        Koneksi WA Gateway
                    </a>
                    <a href="{{ route('admin.wa-template.index') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 rounded-xl {{ request()->routeIs('admin.wa-template.*') ? 'text-emerald-800 bg-emerald-50' : 'hover:text-emerald-800 hover:bg-emerald-50' }}">
                        Setting Template WA
                    </a>
                    <a href="{{ route('admin.wa-broadcast.index') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 rounded-xl {{ request()->routeIs('admin.wa-broadcast.*') ? 'text-emerald-800 bg-emerald-50' : 'hover:text-emerald-800 hover:bg-emerald-50' }}">
                        Broadcast WA
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 rounded-xl {{ request()->routeIs('profile.edit') ? 'text-emerald-800 bg-emerald-50' : 'hover:text-emerald-800 hover:bg-emerald-50' }}">
                        Update Password & Profil
                    </a>
                </div>
            </div>
            @endadmin
        @endauth
    </nav>
</div>
