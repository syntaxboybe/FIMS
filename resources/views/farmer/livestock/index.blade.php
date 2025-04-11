<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
                {{ __('Livestock Management') }}
            </h2>
            <a href="{{ route('farmer.livestock.create') }}" class="bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                Add New Livestock
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mobile Filters Button -->
            <div class="block sm:hidden mb-4">
                <button onclick="toggleFilters()" class="w-full bg-white dark:bg-frappe-base text-gray-700 dark:text-frappe-text font-semibold py-2 px-4 border border-gray-300 dark:border-frappe-surface1 rounded shadow-sm flex justify-between items-center">
                    <span>Show Filters</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 sm:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text">Filter Livestock</h3>
                        <button type="button" class="sm:hidden text-blue-500 dark:text-frappe-blue" onclick="toggleFilters()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <form id="filter-form" action="{{ route('farmer.livestock.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:block md:hidden">
                        <div class="space-y-4">
                            <div>
                                <label for="farm_id" class="block text-sm font-medium text-gray-700 dark:text-frappe-subtext1 mb-1">Farm</label>
                                <select id="farm_id" name="farm_id" class="w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm">
                                    <option value="">All Farms</option>
                                    @foreach ($farms as $farm)
                                        <option value="{{ $farm->id }}" {{ request('farm_id') == $farm->id ? 'selected' : '' }}>{{ $farm->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-frappe-subtext1 mb-1">Category</label>
                                <select id="category_id" name="category_id" class="w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-frappe-subtext1 mb-1">Status</label>
                                <select id="status" name="status" class="w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm">
                                    <option value="">All Statuses</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                    <option value="deceased" {{ request('status') == 'deceased' ? 'selected' : '' }}>Deceased</option>
                                </select>
                            </div>
                            <div class="pt-2">
                                <button type="submit" class="w-full bg-blue-500 dark:bg-frappe-blue hover:bg-blue-700 dark:hover:bg-frappe-sapphire text-white font-bold py-2 px-4 rounded">
                                    Apply Filters
                                </button>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('farmer.livestock.index') }}" method="GET" class="hidden sm:grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="farm_id_desktop" class="block text-sm font-medium text-gray-700 dark:text-frappe-subtext1 mb-1">Farm</label>
                            <select id="farm_id_desktop" name="farm_id" class="w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm">
                                <option value="">All Farms</option>
                                @foreach ($farms as $farm)
                                    <option value="{{ $farm->id }}" {{ request('farm_id') == $farm->id ? 'selected' : '' }}>{{ $farm->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="category_id_desktop" class="block text-sm font-medium text-gray-700 dark:text-frappe-subtext1 mb-1">Category</label>
                            <select id="category_id_desktop" name="category_id" class="w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status_desktop" class="block text-sm font-medium text-gray-700 dark:text-frappe-subtext1 mb-1">Status</label>
                            <select id="status_desktop" name="status" class="w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm">
                                <option value="">All Statuses</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                <option value="deceased" {{ request('status') == 'deceased' ? 'selected' : '' }}>Deceased</option>
                            </select>
                        </div>
                        <div class="md:col-span-3 flex justify-end">
                            <button type="submit" class="bg-blue-500 dark:bg-frappe-blue hover:bg-blue-700 dark:hover:bg-frappe-sapphire text-white font-bold py-2 px-4 rounded">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Livestock List -->
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    @if ($livestock->isEmpty())
                        <p class="text-center text-gray-500 dark:text-frappe-subtext0">No livestock found. <a href="{{ route('farmer.livestock.create') }}" class="text-blue-500 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">Add your first livestock</a>.</p>
                    @else
                        <!-- Mobile Card View (visible on small screens) -->
                        <div class="block sm:hidden">
                            <div class="space-y-4">
                                @foreach ($livestock as $animal)
                                    <div class="bg-white dark:bg-frappe-base border dark:border-frappe-surface0 rounded-lg shadow-sm overflow-hidden">
                                        <div class="flex items-center p-4">
                                            @if ($animal->image)
                                                <div class="flex-shrink-0 h-12 w-12 mr-3">
                                                    <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $animal->image) }}?v={{ time() }}" alt="{{ $animal->name }}">
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text">{{ $animal->tag_number }}</h3>
                                                @if ($animal->name)
                                                    <p class="text-sm text-gray-500 dark:text-frappe-subtext0">{{ $animal->name }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="border-t dark:border-frappe-surface0 px-4 py-3 bg-gray-50 dark:bg-frappe-surface0">
                                            <div class="grid grid-cols-2 gap-2 text-sm">
                                                <div>
                                                    <span class="text-gray-500 dark:text-frappe-subtext1">Farm:</span>
                                                    <span class="font-medium text-gray-900 dark:text-frappe-text">{{ $animal->farm->name }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-500 dark:text-frappe-subtext1">Category:</span>
                                                    <span class="font-medium text-gray-900 dark:text-frappe-text">{{ $animal->category->name }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-500 dark:text-frappe-subtext1">Gender:</span>
                                                    <span class="font-medium text-gray-900 dark:text-frappe-text">{{ ucfirst($animal->gender) }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-500 dark:text-frappe-subtext1">Status:</span>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $animal->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : ($animal->status === 'sold' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300') }}">
                                                        {{ ucfirst($animal->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-t dark:border-frappe-surface0 px-4 py-3 flex gap-3">
                                            <a href="{{ route('farmer.livestock.show', $animal) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">View</a>
                                            <a href="{{ route('farmer.livestock.edit', $animal) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                                            <button type="button" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                                onclick="confirmAction('Are you sure you want to delete this livestock?', 'Delete', 'Cancel', '{{ route('farmer.livestock.destroy', $animal) }}', 'DELETE')">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Desktop Table View (visible on medium screens and up) -->
                        <div class="hidden sm:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-frappe-surface0">
                                <thead class="bg-gray-50 dark:bg-frappe-surface0">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Tag/Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Farm</th>
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
                                                <div class="flex items-center">
                                                    @if ($animal->image)
                                                        <div class="flex-shrink-0 h-10 w-10 mr-3">
                                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $animal->image) }}?v={{ time() }}" alt="{{ $animal->name }}">
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900 dark:text-frappe-text">{{ $animal->tag_number }}</div>
                                                        <div class="text-sm text-gray-500 dark:text-frappe-subtext0">{{ $animal->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-frappe-text">{{ $animal->farm->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-frappe-text">{{ $animal->category->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-frappe-text">{{ ucfirst($animal->gender) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $animal->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : ($animal->status === 'sold' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300') }}">
                                                    {{ ucfirst($animal->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-3">
                                                    <a href="{{ route('farmer.livestock.show', $animal) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">View</a>
                                                    <a href="{{ route('farmer.livestock.edit', $animal) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                                                    <button type="button" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                                        onclick="confirmAction('Are you sure you want to delete this livestock?', 'Delete', 'Cancel', '{{ route('farmer.livestock.destroy', $animal) }}', 'DELETE')">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $livestock->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleFilters() {
            const filterForm = document.getElementById('filter-form');
            filterForm.classList.toggle('hidden');
        }
    </script>
    @endpush
</x-app-layout>
