<x-app-layout>
    <x-slot name="header">{{ __('Edit Admin') }}</x-slot>

    <x-ui-card class="max-w-2xl space-y-6">
        <x-ui-section-heading description="Perbarui profil, password, dan akses panel admin">Edit Admin</x-ui-section-heading>

        <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-5">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="p-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500" required>
            </div>

            <div>
                <label for="admin_role" class="block text-sm font-semibold text-gray-700 mb-1">Jenis Akses</label>
                <select id="admin_role" name="admin_role" class="w-full border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500" @disabled($user->isRoot()) required>
                    @php $selectedRole = old('admin_role', $user->admin_role ?: ($user->is_admin ? \App\Models\User::ROLE_ATTENDANCE_ADMIN : 'user')); @endphp
                    <option value="{{ \App\Models\User::ROLE_ATTENDANCE_ADMIN }}" @selected($selectedRole === \App\Models\User::ROLE_ATTENDANCE_ADMIN)>Admin Absensi</option>
                    <option value="{{ \App\Models\User::ROLE_ARTICLE_ADMIN }}" @selected($selectedRole === \App\Models\User::ROLE_ARTICLE_ADMIN)>Admin Artikel</option>
                    <option value="{{ \App\Models\User::ROLE_SUPER_ADMIN }}" @selected($selectedRole === \App\Models\User::ROLE_SUPER_ADMIN)>Super Admin</option>
                    <option value="user" @selected($selectedRole === 'user')>User Biasa</option>
                </select>
                @if($user->isRoot())
                    <input type="hidden" name="admin_role" value="{{ \App\Models\User::ROLE_SUPER_ADMIN }}">
                    <p class="mt-1 text-xs text-gray-500">Root user selalu menjadi Super Admin.</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
                    <input id="password" name="password" type="password" class="w-full border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="w-full border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-100">
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-xl font-semibold text-sm transition-colors">Kembali</a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold rounded-xl transition">Simpan Perubahan</button>
            </div>
        </form>
    </x-ui-card>
</x-app-layout>
