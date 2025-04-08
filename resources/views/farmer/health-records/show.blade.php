<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Health Record Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('farmer.health-records.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Health Records
                </a>
                <a href="{{ route('farmer.health-records.edit', $healthRecord) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Record
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Record Type and Date -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Record Information</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-gray-500">Type:</span>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $healthRecord->record_type === 'vaccination' ? 'bg-blue-100 text-blue-800' : ($healthRecord->record_type === 'treatment' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                            {{ ucfirst($healthRecord->record_type) }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Date:</span>
                                        <span class="text-gray-900">{{ $healthRecord->record_date->format('M d, Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Performed By:</span>
                                        <span class="text-gray-900">{{ $healthRecord->performed_by }}</span>
                                    </div>
                                    @if ($healthRecord->cost)
                                        <div>
                                            <span class="text-gray-500">Cost:</span>
                                            <span class="text-gray-900">${{ number_format($healthRecord->cost, 2) }}</span>
                                        </div>
                                    @endif
                                    @if ($healthRecord->next_follow_up)
                                        <div>
                                            <span class="text-gray-500">Next Follow Up:</span>
                                            <span class="text-gray-900">{{ $healthRecord->next_follow_up->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Livestock Information</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-gray-500">Tag Number:</span>
                                        <a href="{{ route('farmer.livestock.show', $healthRecord->livestock) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $healthRecord->livestock->tag_number }}
                                        </a>
                                    </div>
                                    @if ($healthRecord->livestock->name)
                                        <div>
                                            <span class="text-gray-500">Name:</span>
                                            <span class="text-gray-900">{{ $healthRecord->livestock->name }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="text-gray-500">Category:</span>
                                        <span class="text-gray-900">{{ $healthRecord->livestock->category->name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Farm:</span>
                                        <a href="{{ route('farmer.farms.show', $healthRecord->livestock->farm) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $healthRecord->livestock->farm->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description and Notes -->
                        <div class="md:col-span-2">
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-900">{{ $healthRecord->description }}</p>
                                </div>
                            </div>

                            @if ($healthRecord->notes)
                                <div class="mb-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Additional Notes</h3>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-900">{{ $healthRecord->notes }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($healthRecord->attachments)
                                <div class="mb-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Attachments</h3>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <a href="{{ asset('storage/' . $healthRecord->attachments) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            View Attachment
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="flex space-x-2 mt-6">
                                <a href="{{ route('farmer.health-records.edit', $healthRecord) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Edit Record
                                </a>
                                <form action="{{ route('farmer.health-records.destroy', $healthRecord) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this health record? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Delete Record
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
