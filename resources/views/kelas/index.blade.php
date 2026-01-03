<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Kelas') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @php $currentUser = auth()->user(); @endphp
            <div class="mb-4">
                @if($currentUser && $currentUser->is_admin)
                    <a href="{{ route('kelas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Tambah Kelas</a>
                @endif
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Daftar Kelas</h3>
                </div>
                <div class="border-t border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($kelas as $k)
                            <tr>
                                <td class="px-6 py-4">{{ $k->name }}</td>
                                <td class="px-6 py-4">{{ $k->description }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($currentUser && $currentUser->is_admin)
                                        <a href="{{ route('kelas.edit', $k) }}" class="inline-flex items-center px-2 py-1 text-sm text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M11 9h6M11 13h6M5 5h.01M5 9h.01M5 13h.01M5 17h14" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form class="inline" method="POST" action="{{ route('kelas.destroy', $k) }}" onsubmit="return confirm('Delete this kelas?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2 py-1 text-sm text-red-600 bg-red-50 hover:bg-red-100 rounded ml-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">{{ $kelas->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
