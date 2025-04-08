<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Health Records') }}
            </h2>
            <a href="{{ route('farmer.health-records.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add New Health Record
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Health Records</h3>
                    <form action="{{ route('farmer.health-records.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="livestock_id" class="block text-sm font-medium text-gray-700 mb-1">Livestock</label>
                            <select id="livestock_id" name="livestock_id" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">All Livestock</option>
                                @foreach ($livestock as $animal)
                                    <option value="{{ $animal->id }}" {{ request('livestock_id') == $animal->id ? 'selected' : '' }}>{{ $animal->tag_number }} {{ $animal->name ? '- ' . $animal->name : '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="record_type" class="block text-sm font-medium text-gray-700 mb-1">Record Type</label>
                            <select id="record_type" name="record_type" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">All Types</option>
                                <option value="vaccination" {{ request('record_type') == 'vaccination' ? 'selected' : '' }}>Vaccination</option>
                                <option value="treatment" {{ request('record_type') == 'treatment' ? 'selected' : '' }}>Treatment</option>
                                <option value="examination" {{ request('record_type') == 'examination' ? 'selected' : '' }}>Examination</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Health Records List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($healthRecords->isEmpty())
                        <p class="text-center text-gray-500">No health records found. <a href="{{ route('farmer.health-records.create') }}" class="text-blue-500 hover:text-blue-700">Add your first health record</a>.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Livestock</th>
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
                                                <div class="text-sm text-gray-900">
                                                    <a href="{{ route('farmer.livestock.show', $record->livestock) }}" class="text-blue-600 hover:text-blue-900">
                                                        {{ $record->livestock->tag_number }}
                                                    </a>
                                                </div>
                                                @if ($record->livestock->name)
                                                    <div class="text-sm text-gray-500">{{ $record->livestock->name }}</div>
                                                @endif
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
                        
                        <div class="mt-4">
                            {{ $healthRecords->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
