@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
                {{ __('Manage Users') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="bg-blue-500 hover:bg-blue-700 dark:bg-frappe-blue dark:hover:bg-frappe-sapphire text-white font-bold py-2 px-4 rounded text-sm">
                Create Farmer Account
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 dark:bg-frappe-surface0 border border-green-400 dark:border-frappe-green text-green-700 dark:text-frappe-green px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900 dark:text-frappe-text">
                    <!-- Mobile list view (visible on small screens) -->
                    <div class="block sm:hidden">
                        <div class="space-y-4">
                            @foreach ($users as $user)
                                <div class="bg-white dark:bg-frappe-surface0 border dark:border-frappe-surface1 rounded-lg shadow-sm p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="flex items-center">
                                                @if ($user->profile_image)
                                                    <div class="h-10 w-10 rounded-full overflow-hidden bg-gray-200 dark:bg-frappe-surface1 mr-3">
                                                        <img src="{{ Storage::url($user->profile_image) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                                    </div>
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-frappe-blue flex items-center justify-center text-white mr-3">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <h3 class="font-medium text-gray-900 dark:text-frappe-text">{{ $user->name }}</h3>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-frappe-subtext0 ml-12">@{{ $user->username }}</p>
                                            <p class="text-sm text-gray-500 dark:text-frappe-subtext0 ml-12">{{ $user->email }}</p>
                                            <div class="mt-2 space-y-1">
                                                <div class="flex items-center text-sm">
                                                    <span class="text-gray-500 dark:text-frappe-subtext1 mr-2">Role:</span>
                                                    <div>
                                                        @foreach ($user->roles as $role)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $role->name === 'admin' ? 'bg-red-100 text-red-800 dark:bg-frappe-surface1 dark:text-frappe-red' : 'bg-green-100 text-green-800 dark:bg-frappe-surface1 dark:text-frappe-green' }}">
                                                                {{ ucfirst($role->name) }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="flex items-center text-sm">
                                                    <span class="text-gray-500 dark:text-frappe-subtext1 mr-2">Status:</span>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-frappe-surface1 dark:text-frappe-green' : 'bg-red-100 text-red-800 dark:bg-frappe-surface1 dark:text-frappe-red' }}">
                                                        {{ ucfirst($user->status) }}
                                                    </span>
                                                </div>
                                                <div class="flex items-center text-sm">
                                                    <span class="text-gray-500 dark:text-frappe-subtext1 mr-2">Created:</span>
                                                    <span class="dark:text-frappe-subtext0">{{ $user->created_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 flex gap-3 border-t dark:border-frappe-surface1 pt-3">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-frappe-blue dark:hover:text-frappe-lavender">Edit</a>
                                        <button type="button" class="text-red-600 hover:text-red-900 dark:text-frappe-red dark:hover:text-frappe-maroon"
                                            onclick="confirmAction('Are you sure you want to delete this user?', 'Delete', 'Cancel', '{{ route('admin.users.destroy', $user) }}', 'DELETE')">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>

                    <!-- Desktop table view (visible on medium screens and up) -->
                    <div class="hidden sm:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-frappe-surface1">
                            <thead class="bg-gray-50 dark:bg-frappe-surface0">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext0 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext0 uppercase tracking-wider">Username</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext0 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext0 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext0 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext0 uppercase tracking-wider">Created At</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext0 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-frappe-base divide-y divide-gray-200 dark:divide-frappe-surface1">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if ($user->profile_image)
                                                    <div class="h-10 w-10 rounded-full overflow-hidden bg-gray-200 dark:bg-frappe-surface1 mr-3">
                                                        <img src="{{ Storage::url($user->profile_image) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                                    </div>
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-frappe-blue flex items-center justify-center text-white mr-3">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <span class="text-sm font-medium text-gray-900 dark:text-frappe-text">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-frappe-subtext0">{{ $user->username }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-frappe-subtext0">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-frappe-subtext0">
                                                @foreach ($user->roles as $role)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $role->name === 'admin' ? 'bg-red-100 text-red-800 dark:bg-frappe-surface1 dark:text-frappe-red' : 'bg-green-100 text-green-800 dark:bg-frappe-surface1 dark:text-frappe-green' }}">
                                                        {{ ucfirst($role->name) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-frappe-subtext0">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-frappe-surface1 dark:text-frappe-green' : 'bg-red-100 text-red-800 dark:bg-frappe-surface1 dark:text-frappe-red' }}">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-frappe-subtext0">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-frappe-blue dark:hover:text-frappe-lavender mr-3">Edit</a>

                                            <button type="button" class="text-red-600 hover:text-red-900 dark:text-frappe-red dark:hover:text-frappe-maroon"
                                                onclick="confirmAction('Are you sure you want to delete this user?', 'Delete', 'Cancel', '{{ route('admin.users.destroy', $user) }}', 'DELETE')">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
