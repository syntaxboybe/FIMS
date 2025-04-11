<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Details') }}: {{ $user->name }}
            </h2>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">User Information</h3>
                        <div class="mt-4 space-y-4">
                            <div>
                                <span class="text-gray-500">Name:</span>
                                <span class="ml-2 text-gray-900">{{ $user->name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Username:</span>
                                <span class="ml-2 text-gray-900">{{ $user->username }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Email:</span>
                                <span class="ml-2 text-gray-900">{{ $user->email }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Roles:</span>
                                <span class="ml-2">
                                    @foreach ($user->roles as $role)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $role->name === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-500">Status:</span>
                                <span class="ml-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-500">Created:</span>
                                <span class="ml-2 text-gray-900">{{ $user->created_at->format('M d, Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Last Updated:</span>
                                <span class="ml-2 text-gray-900">{{ $user->updated_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit User
                        </a>
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            onclick="confirmAction('Are you sure you want to delete this user?', 'Delete', 'Cancel', '{{ route('admin.users.destroy', $user) }}', 'DELETE')">
                            Delete User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
