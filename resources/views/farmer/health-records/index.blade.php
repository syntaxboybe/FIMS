<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
                {{ __('Health Records') }}
            </h2>
            <a href="{{ route('farmer.health-records.create') }}" class="bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add New Health Record
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text mb-4">Filter Health Records</h3>
                    <form action="{{ route('farmer.health-records.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="livestock_id" class="block text-sm font-medium text-gray-700 dark:text-frappe-subtext0 mb-1">Livestock</label>
                            <select id="livestock_id" name="livestock_id" class="w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm">
                                <option value="">All Livestock</option>
                                @foreach ($livestock as $animal)
                                    <option value="{{ $animal->id }}" {{ request('livestock_id') == $animal->id ? 'selected' : '' }}>{{ $animal->tag_number }} {{ $animal->name ? '- ' . $animal->name : '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="record_type" class="block text-sm font-medium text-gray-700 dark:text-frappe-subtext0 mb-1">Record Type</label>
                            <select id="record_type" name="record_type" class="w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm">
                                <option value="">All Types</option>
                                <option value="vaccination" {{ request('record_type') == 'vaccination' ? 'selected' : '' }}>Vaccination</option>
                                <option value="treatment" {{ request('record_type') == 'treatment' ? 'selected' : '' }}>Treatment</option>
                                <option value="examination" {{ request('record_type') == 'examination' ? 'selected' : '' }}>Examination</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 dark:bg-frappe-blue dark:hover:bg-frappe-sapphire text-white font-bold py-2 px-4 rounded">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Health Records List -->
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($healthRecords->isEmpty())
                        <p class="text-center text-gray-500 dark:text-frappe-subtext0">No health records found. <a href="{{ route('farmer.health-records.create') }}" class="text-blue-500 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">Add your first health record</a>.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-frappe-surface0">
                                <thead class="bg-gray-50 dark:bg-frappe-surface0">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Livestock</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Description</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Performed By</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-frappe-subtext1 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-frappe-base divide-y divide-gray-200 dark:divide-frappe-surface0">
                                    @foreach ($healthRecords as $record)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-frappe-text">{{ $record->record_date->format('M d, Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-frappe-text">
                                                    <a href="{{ route('farmer.livestock.show', $record->livestock) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">
                                                        {{ $record->livestock->tag_number }}
                                                    </a>
                                                </div>
                                                @if ($record->livestock->name)
                                                    <div class="text-sm text-gray-500 dark:text-frappe-subtext0">{{ $record->livestock->name }}</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $record->record_type === 'vaccination' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : ($record->record_type === 'treatment' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') }}">
                                                    {{ ucfirst($record->record_type) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 dark:text-frappe-text">{{ Str::limit($record->description, 50) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-frappe-text">{{ $record->performed_by }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('farmer.health-records.show', $record) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 mr-3">View</a>
                                                <a href="{{ route('farmer.health-records.edit', $record) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 mr-3">Edit</a>
                                                <button type="button" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                                    onclick="confirmAction('Are you sure you want to delete this health record?', 'Delete', 'Cancel', '{{ route('farmer.health-records.destroy', $record) }}', 'DELETE')">
                                                    Delete
                                                </button>
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
