<x-app-layout>
    <x-slot name="header">{{ __('Admin') }}</x-slot>

    @php $currentUser = auth()->user(); @endphp

    <div x-data="{ confirmOpen: false, confirmEmail: '', confirmFormId: null, openConfirm(email, formId){ this.confirmEmail = email; this.confirmFormId = formId; this.confirmOpen = true }, doConfirm(){ if(this.confirmFormId){ document.getElementById(this.confirmFormId).submit(); } this.confirmOpen = false } }">

        <x-ui-card class="space-y-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <x-ui-section-heading description="Kelola akun admin yang dapat mengakses panel ini">Daftar Admin Sistem</x-ui-section-heading>
                @if($currentUser && $currentUser->isSuperAdmin())
                    <a href="{{ route('users.create') }}">
                        <x-primary-button class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Tambah Admin
                        </x-primary-button>
                    </a>
                @endif
            </div>

            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                <form method="GET" action="{{ route('users.index') }}" id="per-page-form" class="flex items-center gap-2">
                    <label for="per_page" class="whitespace-nowrap">Baris per halaman:</label>
                    <select name="per_page" id="per_page" class="border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg text-sm py-1.5 pl-3 pr-8 transition-colors" onchange="document.getElementById('per-page-form').submit()">
                        @foreach([10,20,50,100] as $n)
                            <option value="{{ $n }}" {{ (isset($perPage) && $perPage == $n) ? 'selected' : '' }}>{{ $n }} baris</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <x-ui-table>
                <x-slot name="head">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-emerald-800 uppercase tracking-wider">Aksi</th>
                    </tr>
                </x-slot>

                <x-slot name="body">
                    @forelse($users as $user)
                        <tr class="hover:bg-emerald-50/40 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($user->isSuperAdmin())
                                    <x-badge color="amber" size="sm">{{ $user->roleLabel() }}</x-badge>
                                @elseif($user->canManageAttendance())
                                    <x-badge color="emerald" size="sm">{{ $user->roleLabel() }}</x-badge>
                                @elseif($user->canManageArticles())
                                    <x-badge color="blue" size="sm">{{ $user->roleLabel() }}</x-badge>
                                @else
                                    <x-badge color="gray" size="sm">User Biasa</x-badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                @if($currentUser && $currentUser->isSuperAdmin())
                                    <div class="flex items-center justify-center gap-3">
                                        @if($user->isRoot())
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-400 text-xs font-medium rounded-lg cursor-not-allowed border border-gray-200" title="Root user tidak dapat diedit">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit
                                            </span>
                                        @else
                                            <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center gap-1.5 text-emerald-600 hover:text-emerald-900 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit
                                            </a>
                                        @endif

                                        @if($user->isRoot())
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50/50 text-red-300 text-xs font-medium rounded-lg cursor-not-allowed border border-red-100" title="Tidak dapat dihapus">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </span>
                                        @else
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" @click="openConfirm('{{ $user->email }}', 'delete-form-{{ $user->id }}')" class="inline-flex items-center gap-1.5 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-sm text-gray-500">Belum ada data admin.</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-ui-table>

            <x-ui-pagination :paginator="$users" />
        </x-ui-card>

        <div x-show="confirmOpen" x-cloak style="display:none;" class="fixed inset-0 z-[100] flex items-center justify-center">
            <div class="fixed inset-0 bg-black/50 z-40" @click="confirmOpen = false"></div>
            <div class="bg-white rounded-xl shadow-xl p-6 z-50 relative max-w-md w-full mx-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.293 5.293a1 1 0 011.414 0L21 14.586V19a2 2 0 01-2 2H5a2 2 0 01-2-2v-4.414l9.293-9.293z"/></svg>
                </div>
                <h3 class="text-center text-lg font-semibold text-gray-900">Hapus Admin</h3>
                <p class="mt-2 text-center text-sm text-gray-600">Yakin ingin menghapus user <strong x-text="confirmEmail"></strong>?</p>
                <div class="mt-5 flex justify-center gap-3">
                    <button type="button" @click="confirmOpen = false" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-xl font-semibold text-sm transition-colors">Batal</button>
                    <button type="button" @click.prevent="doConfirm()" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
