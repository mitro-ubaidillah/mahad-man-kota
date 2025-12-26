<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Users') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center justify-between">
                <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Tambah User</a>

                <div class="flex items-center space-x-4">
                    <div>
                        <form method="GET" action="{{ route('users.index') }}" id="per-page-form">
                            <label for="per_page" class="text-sm text-gray-600 mr-2">Per page</label>
                            <select name="per_page" id="per_page" class="border rounded px-2 py-1" onchange="document.getElementById('per-page-form').submit()">
                                @foreach([10,20,50,100] as $n)
                                    <option value="{{ $n }}" {{ (isset($perPage) && $perPage == $n) ? 'selected' : '' }}>{{ $n }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="text-sm text-gray-600">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('users.edit', $user) }}" class="text-indigo-600">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 ml-4 delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
    <script>
        // confirm delete
        document.querySelectorAll('.delete-form').forEach(function(form){
            form.addEventListener('submit', function(e){
                const email = form.closest('tr').querySelectorAll('td')[2].innerText.trim();
                if(email === 'root@root.com'){
                    alert('Root user cannot be deleted.');
                    e.preventDefault();
                    return;
                }
                if(!confirm('Are you sure you want to delete user ' + email + '?')){
                    e.preventDefault();
                }
            });
        });
    </script>
</x-app-layout>
