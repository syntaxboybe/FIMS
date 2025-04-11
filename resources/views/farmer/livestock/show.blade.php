<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-2 sm:space-y-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
                {{ $livestock->tag_number }} {{ $livestock->name ? '- ' . $livestock->name : '' }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('farmer.livestock.index') }}" class="bg-gray-500 hover:bg-gray-600 dark:bg-frappe-surface1 dark:hover:bg-frappe-surface2 text-white dark:text-frappe-text font-bold py-2 px-4 rounded text-sm">
                    Back
                </a>
                <a href="{{ route('farmer.livestock.edit', $livestock) }}" class="bg-blue-500 hover:bg-blue-600 dark:bg-frappe-blue dark:hover:bg-frappe-sapphire text-white font-bold py-2 px-4 rounded text-sm">
                    Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Livestock Details -->
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Image Column -->
                        <div class="md:col-span-1">
                            @if ($livestock->image)
                                <img src="{{ asset('storage/' . $livestock->image) }}?v={{ time() }}" alt="{{ $livestock->name }}" class="w-full h-auto rounded-lg shadow-md mb-4">
                            @else
                                <div class="w-full h-48 bg-gray-200 dark:bg-frappe-surface0 rounded-lg flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 dark:text-frappe-overlay0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="bg-gray-50 dark:bg-frappe-surface0 rounded-lg p-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text mb-2">Quick Info</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-frappe-subtext1">Status:</span>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $livestock->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : ($livestock->status === 'sold' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300') }}">
                                            {{ ucfirst($livestock->status) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-frappe-subtext1">Category:</span>
                                        <span class="text-gray-900 dark:text-frappe-text">{{ $livestock->category->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-frappe-subtext1">Gender:</span>
                                        <span class="text-gray-900 dark:text-frappe-text">{{ ucfirst($livestock->gender) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-frappe-subtext1">Farm:</span>
                                        <a href="{{ route('farmer.farms.show', $livestock->farm) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">{{ $livestock->farm->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details Column -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text mb-4">Livestock Details</h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Tag Number</h4>
                                    <p class="text-gray-900 dark:text-frappe-text">{{ $livestock->tag_number }}</p>
                                </div>

                                @if ($livestock->name)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Name</h4>
                                        <p class="text-gray-900 dark:text-frappe-text">{{ $livestock->name }}</p>
                                    </div>
                                @endif

                                @if ($livestock->breed)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Breed</h4>
                                        <p class="text-gray-900 dark:text-frappe-text">{{ $livestock->breed }}</p>
                                    </div>
                                @endif

                                @if ($livestock->color)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Color</h4>
                                        <p class="text-gray-900 dark:text-frappe-text">{{ $livestock->color }}</p>
                                    </div>
                                @endif

                                @if ($livestock->weight)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Weight</h4>
                                        <p class="text-gray-900 dark:text-frappe-text">{{ $livestock->weight }} kg</p>
                                    </div>
                                @endif

                                @if ($livestock->birth_date)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Birth Date</h4>
                                        <p class="text-gray-900 dark:text-frappe-text">{{ $livestock->birth_date->format('M d, Y') }}</p>
                                    </div>
                                @endif

                                @if ($livestock->purchase_date)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Purchase Date</h4>
                                        <p class="text-gray-900 dark:text-frappe-text">{{ $livestock->purchase_date->format('M d, Y') }}</p>
                                    </div>
                                @endif

                                @if ($livestock->purchase_price)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Purchase Price</h4>
                                        <p class="text-gray-900 dark:text-frappe-text">${{ number_format($livestock->purchase_price, 2) }}</p>
                                    </div>
                                @endif

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1">Added On</h4>
                                    <p class="text-gray-900 dark:text-frappe-text">{{ $livestock->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>

                            @if ($livestock->notes)
                                <div class="mb-6">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-frappe-subtext1 mb-1">Notes</h4>
                                    <p class="text-gray-900 dark:text-frappe-text bg-gray-50 dark:bg-frappe-surface0 p-3 rounded">{{ $livestock->notes }}</p>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-2 mt-6">
                                <button type="button" class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-700 active:bg-green-900 dark:active:bg-green-800 focus:outline-none focus:border-green-900 dark:focus:border-green-800 focus:ring ring-green-300 dark:ring-green-700 disabled:opacity-25 transition ease-in-out duration-150"
                                    onclick="confirmAction('Are you sure you want to add a health record for this livestock?', 'Add', 'Cancel', '{{ route('farmer.health-records.create', ['livestock_id' => $livestock->id]) }}', 'GET')">
                                    Add Health Record
                                </button>
                                <button type="button" class="inline-flex items-center px-4 py-2 bg-red-600 dark:bg-frappe-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-frappe-maroon active:bg-red-900 dark:active:bg-frappe-maroon focus:outline-none focus:border-red-900 dark:focus:border-frappe-peach focus:ring ring-red-300 dark:ring-frappe-red/30 disabled:opacity-25 transition ease-in-out duration-150"
                                    onclick="confirmAction('Are you sure you want to delete this livestock? This action cannot be undone.', 'Delete', 'Cancel', '{{ route('farmer.livestock.destroy', $livestock) }}', 'DELETE')">
                                    Delete Livestock
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Health Records Section -->
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text">Health Records</h3>
                        <a href="{{ route('farmer.health-records.create', ['livestock_id' => $livestock->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-700 active:bg-green-900 dark:active:bg-green-800 focus:outline-none focus:border-green-900 dark:focus:border-green-800 focus:ring ring-green-300 dark:ring-green-700 disabled:opacity-25 transition ease-in-out duration-150">
                            Add Health Record
                        </a>
                    </div>

                    @if ($healthRecords->isEmpty())
                        <p class="text-gray-500 dark:text-frappe-subtext0">No health records found for this livestock.</p>
                    @else
                        <div class="overflow-x-auto -mx-4 sm:mx-0">
                            <div class="inline-block min-w-full py-2 align-middle px-4 sm:px-0">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-frappe-surface0">
                                    <thead class="bg-gray-50 dark:bg-frappe-surface0">
                                        <tr>
                                            <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Date</th>
                                            <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Type</th>
                                            <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Description</th>
                                            <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Performed By</th>
                                            <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-frappe-base divide-y divide-gray-200 dark:divide-frappe-surface0">
                                        @foreach ($healthRecords as $record)
                                            <tr>
                                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 dark:text-frappe-text">{{ $record->record_date->format('M d, Y') }}</div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $record->record_type === 'vaccination' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : ($record->record_type === 'treatment' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') }}">
                                                        {{ ucfirst($record->record_type) }}
                                                    </span>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4">
                                                    <div class="text-sm text-gray-900 dark:text-frappe-text">{{ Str::limit($record->description, 30) }}</div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 dark:text-frappe-text">{{ Str::limit($record->performed_by, 15) }}</div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex flex-wrap gap-2">
                                                        <a href="{{ route('farmer.health-records.show', $record) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">View</a>
                                                        <a href="{{ route('farmer.health-records.edit', $record) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                                                        <button type="button" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                                            onclick="confirmAction('Are you sure you want to delete this health record?', 'Delete', 'Cancel', '{{ route('farmer.health-records.destroy', $record) }}', 'DELETE')">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
