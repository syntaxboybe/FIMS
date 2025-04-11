<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
                {{ $farm->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('farmer.farms.index') }}" class="bg-gray-500 hover:bg-gray-600 dark:bg-frappe-surface1 dark:hover:bg-frappe-surface2 text-white dark:text-frappe-text font-bold py-2 px-4 rounded">
                    Back to Farms
                </a>
                <a href="{{ route('farmer.farms.edit', $farm) }}" class="bg-blue-500 hover:bg-blue-600 dark:bg-frappe-blue dark:hover:bg-frappe-sapphire text-white font-bold py-2 px-4 rounded">
                    Edit Farm
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text mb-4">Farm Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @if ($farm->location)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Location</h4>
                                    <p class="text-gray-900 dark:text-frappe-text">{{ $farm->location }}</p>
                                </div>
                            @endif

                            @if ($farm->size)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Size</h4>
                                    <p class="text-gray-900 dark:text-frappe-text">{{ $farm->size }}</p>
                                </div>
                            @endif

                            @if ($farm->address)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Address</h4>
                                    <p class="text-gray-900 dark:text-frappe-text">{{ $farm->address }}</p>
                                </div>
                            @endif
                        </div>

                        <div>
                            @if ($farm->phone)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Phone</h4>
                                    <p class="text-gray-900 dark:text-frappe-text">{{ $farm->phone }}</p>
                                </div>
                            @endif

                            @if ($farm->email)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Email</h4>
                                    <p class="text-gray-900 dark:text-frappe-text">{{ $farm->email }}</p>
                                </div>
                            @endif

                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Created</h4>
                                <p class="text-gray-900 dark:text-frappe-text">{{ $farm->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    @if ($farm->description)
                        <div class="mt-2">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Description</h4>
                            <p class="text-gray-900 dark:text-frappe-text">{{ $farm->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Livestock Section -->
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text">Livestock ({{ $livestockCount }})</h3>
                        <a href="{{ route('farmer.livestock.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-700 active:bg-green-900 dark:active:bg-green-800 focus:outline-none focus:border-green-900 dark:focus:border-green-800 focus:ring ring-green-300 dark:ring-green-700 disabled:opacity-25 transition ease-in-out duration-150">
                            Add Livestock
                        </a>
                    </div>

                    @if ($livestock->isEmpty())
                        <p class="text-gray-500 dark:text-frappe-subtext0">No livestock added yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-frappe-surface0">
                                <thead class="bg-gray-50 dark:bg-frappe-surface0">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Tag/Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Category</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Gender</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-frappe-base divide-y divide-gray-200 dark:divide-frappe-surface0">
                                    @foreach ($livestock as $animal)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-frappe-text">{{ $animal->tag_number }}</div>
                                                <div class="text-sm text-gray-500 dark:text-frappe-subtext0">{{ $animal->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-frappe-text">{{ $animal->category->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-frappe-text">{{ ucfirst($animal->gender) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $animal->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-frappe-surface0 dark:text-frappe-subtext0' }}">
                                                    {{ ucfirst($animal->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('farmer.livestock.show', $animal) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 mr-3">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($livestockCount > 5)
                            <div class="mt-4 text-right">
                                <a href="{{ route('farmer.livestock.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">View All Livestock</a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
