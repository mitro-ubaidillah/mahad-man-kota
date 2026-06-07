<x-app-layout>
    <x-slot name="header">{{ __('Template WhatsApp') }}</x-slot>

    <x-ui-card class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <x-ui-section-heading description="Katalog template pesan otomatis untuk pengingat dan notifikasi">Template WhatsApp</x-ui-section-heading>
            <a href="{{ route('admin.wa-template.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tambah Template
            </a>
        </div>

        <x-ui-table>
            <x-slot name="head">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Template</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe / Trigger</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Isi Pesan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($templates as $tpl)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 text-sm text-gray-900 font-medium whitespace-nowrap">{{ $tpl->name }}</td>
                        <td class="px-6 py-3 text-sm whitespace-nowrap"><code class="bg-gray-100 text-gray-700 px-1.5 py-0.5 rounded text-xs">{{ $tpl->type }}</code></td>
                        <td class="px-6 py-3 text-sm text-gray-500 max-w-xs">
                            <div class="truncate">{{ $tpl->message }}</div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            @if($tpl->is_active)
                                <span class="px-2 py-0.5 bg-green-100 text-emerald-700 text-xs font-medium rounded-full">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 bg-red-100 text-red-600 text-xs font-medium rounded-full">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.wa-template.edit', $tpl->id) }}" class="inline-flex items-center px-3 py-1.5 border border-emerald-600 text-emerald-700 hover:bg-emerald-50 text-xs font-medium rounded-md transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.wa-template.destroy', $tpl->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus template ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-sm text-gray-400">Belum ada template.</td></tr>
                @endforelse
            </x-slot>
        </x-ui-table>

        @if($templates instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <x-ui-pagination :paginator="$templates" />
        @endif
    </x-ui-card>
</x-app-layout>
