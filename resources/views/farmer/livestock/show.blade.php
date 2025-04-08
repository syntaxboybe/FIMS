<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $livestock->tag_number }} {{ $livestock->name ? '- ' . $livestock->name : '' }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('farmer.livestock.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Livestock
                </a>
                <a href="{{ route('farmer.livestock.edit', $livestock) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Livestock
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Livestock Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Image Column -->
                        <div class="md:col-span-1">
                            @if ($livestock->image)
                                <img src="{{ asset('storage/' . $livestock->image) }}?v={{ time() }}" alt="{{ $livestock->name }}" class="w-full h-auto rounded-lg shadow-md mb-4">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Quick Info</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Status:</span>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $livestock->status === 'active' ? 'bg-green-100 text-green-800' : ($livestock->status === 'sold' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($livestock->status) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Category:</span>
                                        <span class="text-gray-900">{{ $livestock->category->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Gender:</span>
                                        <span class="text-gray-900">{{ ucfirst($livestock->gender) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Farm:</span>
                                        <a href="{{ route('farmer.farms.show', $livestock->farm) }}" class="text-blue-600 hover:text-blue-900">{{ $livestock->farm->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details Column -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Livestock Details</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Tag Number</h4>
                                    <p class="text-gray-900">{{ $livestock->tag_number }}</p>
                                </div>

                                @if ($livestock->name)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Name</h4>
                                        <p class="text-gray-900">{{ $livestock->name }}</p>
                                    </div>
                                @endif

                                @if ($livestock->breed)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Breed</h4>
                                        <p class="text-gray-900">{{ $livestock->breed }}</p>
                                    </div>
                                @endif

                                @if ($livestock->color)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Color</h4>
                                        <p class="text-gray-900">{{ $livestock->color }}</p>
                                    </div>
                                @endif

                                @if ($livestock->weight)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Weight</h4>
                                        <p class="text-gray-900">{{ $livestock->weight }} kg</p>
                                    </div>
                                @endif

                                @if ($livestock->birth_date)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Birth Date</h4>
                                        <p class="text-gray-900">{{ $livestock->birth_date->format('M d, Y') }}</p>
                                    </div>
                                @endif

                                @if ($livestock->purchase_date)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Purchase Date</h4>
                                        <p class="text-gray-900">{{ $livestock->purchase_date->format('M d, Y') }}</p>
                                    </div>
                                @endif

                                @if ($livestock->purchase_price)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Purchase Price</h4>
                                        <p class="text-gray-900">${{ number_format($livestock->purchase_price, 2) }}</p>
                                    </div>
                                @endif

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Added On</h4>
                                    <p class="text-gray-900">{{ $livestock->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>

                            @if ($livestock->notes)
                                <div class="mb-6">
                                    <h4 class="text-sm font-medium text-gray-500 mb-1">Notes</h4>
                                    <p class="text-gray-900 bg-gray-50 p-3 rounded">{{ $livestock->notes }}</p>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex space-x-2 mt-6">
                                <a href="{{ route('farmer.health-records.create', ['livestock_id' => $livestock->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Add Health Record
                                </a>
                                <form action="{{ route('farmer.livestock.destroy', $livestock) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this livestock? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Delete Livestock
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Health Records Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Health Records</h3>
                        <a href="{{ route('farmer.health-records.create', ['livestock_id' => $livestock->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Add Health Record
                        </a>
                    </div>

                    @if ($healthRecords->isEmpty())
                        <p class="text-gray-500">No health records found for this livestock.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Performed By</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($healthRecords as $record)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $record->record_date->format('M d, Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $record->record_type === 'vaccination' ? 'bg-blue-100 text-blue-800' : ($record->record_type === 'treatment' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                                    {{ ucfirst($record->record_type) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">{{ Str::limit($record->description, 50) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $record->performed_by }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('farmer.health-records.show', $record) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                                <a href="{{ route('farmer.health-records.edit', $record) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                <form action="{{ route('farmer.health-records.destroy', $record) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this health record?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
