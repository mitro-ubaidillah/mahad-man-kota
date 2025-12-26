<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Santri') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center justify-between">
                <a href="{{ route('santris.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Tambah Santri</a>

                <div class="flex items-center space-x-4">
                        <form method="GET" action="{{ route('santris.index') }}" id="per-page-form">
                        <label for="per_page" class="text-sm text-gray-600 mr-2">Per page</label>
                        <select name="per_page" id="per_page" class="border rounded px-2 py-1" onchange="document.getElementById('per-page-form').submit()">
                            @foreach([10,20,50,100] as $n)
                                <option value="{{ $n }}" {{ (isset($perPage) && $perPage == $n) ? 'selected' : '' }}>{{ $n }}</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="text-sm text-gray-600">Showing {{ $santris->firstItem() ?? 0 }} to {{ $santris->lastItem() ?? 0 }} of {{ $santris->total() }}</div>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($santris as $s)
                        <tr>
                            <td class="px-6 py-4">{{ $s->id }}</td>
                            <td class="px-6 py-4">{{ $s->nis }}</td>
                            <td class="px-6 py-4">{{ $s->name }}</td>
                            <td class="px-6 py-4">{{ $s->email }}</td>
                            <td class="px-6 py-4">{{ $s->kelas }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('santris.edit', $s) }}" class="text-indigo-600">Edit</a>
                                <form method="POST" action="{{ route('santris.destroy', $s) }}" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 ml-4">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">{{ $santris->links() }}</div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.delete-form').forEach(function(form){
            form.addEventListener('submit', function(e){
                if(!confirm('Are you sure you want to delete this santri?')){
                    e.preventDefault();
                }
            });
        });
    </script>
</x-app-layout>
