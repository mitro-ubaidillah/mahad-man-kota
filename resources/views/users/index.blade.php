<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Admin') }}</h2>
    </x-slot>

    <div class="py-6" x-data="{ confirmOpen: false, confirmEmail: '', confirmFormId: null, openConfirm(email, formId){ this.confirmEmail = email; this.confirmFormId = formId; this.confirmOpen = true }, doConfirm(){ if(this.confirmFormId){ document.getElementById(this.confirmFormId).submit(); } this.confirmOpen = false } }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php $currentUser = auth()->user(); @endphp
            <div class="mb-4 flex items-center justify-between">
                @if($currentUser && $currentUser->is_admin)
                    <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Tambah Admin</a>
                @else
                    <div></div>
                @endif

                <div class="flex items-center space-x-4">
                    <form method="GET" action="{{ route('users.index') }}" id="per-page-form">
                        <label for="per_page" class="text-sm text-gray-600 mr-2">Per page</label>
                        <select name="per_page" id="per_page" class="border rounded px-2 py-1" onchange="document.getElementById('per-page-form').submit()">
                            @foreach([10,20,50,100] as $n)
                                <option value="{{ $n }}" {{ (isset($perPage) && $perPage == $n) ? 'selected' : '' }}>{{ $n }}</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="text-sm text-gray-600">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4">{{ $users->firstItem() ? $users->firstItem() + $loop->index : $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 text-center flex items-center justify-center">
                                @if($currentUser && $currentUser->is_admin)
                                    @if($user->email === 'root@root.com')
                                        <span class="inline-flex items-center px-2 py-1 text-sm text-gray-400 bg-gray-100 rounded cursor-not-allowed opacity-50" aria-disabled="true" title="Root user cannot be edited">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M11 9h6M11 13h6M5 5h.01M5 9h.01M5 13h.01M5 17h14" />
                                            </svg>
                                            Edit
                                        </span>
                                    @else
                                        <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-2 py-1 text-sm text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M11 9h6M11 13h6M5 5h.01M5 9h.01M5 13h.01M5 17h14" />
                                            </svg>
                                            Edit
                                        </a>
                                    @endif

                                    @if($user->email === 'root@root.com' || ($currentUser && ! $currentUser->is_root && $user->is_admin))
                                        <span class="inline-flex items-center px-2 py-1 text-sm text-red-400 bg-red-50 rounded ml-2 cursor-not-allowed opacity-50" aria-disabled="true" title="Admin users cannot be deleted oleh non-root">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                            </svg>
                                            Delete
                                        </span>
                                    @else
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" @click="openConfirm('{{ $user->email }}', 'delete-form-{{ $user->id }}')" class="inline-flex items-center px-2 py-1 text-sm text-red-600 bg-red-50 hover:bg-red-100 rounded ml-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">{{ $users->links() }}</div>
            </div>
        
            {{-- Confirmation modal (Alpine) --}}
            <div x-show="confirmOpen" x-cloak x-bind:style="confirmOpen ? 'display: flex;' : 'display: none;'" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center">
                <div class="fixed inset-0 bg-black/50 z-40" @click="confirmOpen = false"></div>
                <div class="bg-white rounded-lg shadow-lg p-6 z-50 relative max-w-md w-full mx-4">
                    <h3 class="text-lg font-semibold">Confirm delete</h3>
                    <p class="mt-2 text-sm text-gray-600">Are you sure you want to delete user <strong x-text="confirmEmail"></strong>?</p>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" @click="confirmOpen = false" class="px-4 py-2 bg-gray-100 rounded">Cancel</button>
                        <button type="button" @click.prevent="doConfirm()" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
