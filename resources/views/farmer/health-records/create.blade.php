<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Health Record') }}
            </h2>
            <a href="{{ route('farmer.health-records.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Health Records
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('farmer.health-records.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Livestock -->
                        <div class="mb-4">
                            <x-input-label for="livestock_id" :value="__('Livestock')" />
                            <select id="livestock_id" name="livestock_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Livestock</option>
                                @foreach ($livestock as $animal)
                                    <option value="{{ $animal->id }}" {{ (old('livestock_id') == $animal->id || (isset($selectedLivestock) && $selectedLivestock->id == $animal->id)) ? 'selected' : '' }}>
                                        {{ $animal->tag_number }} {{ $animal->name ? '- ' . $animal->name : '' }} ({{ $animal->farm->name }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('livestock_id')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <!-- Record Type -->
                                <div class="mb-4">
                                    <x-input-label for="record_type" :value="__('Record Type')" />
                                    <select id="record_type" name="record_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Type</option>
                                        <option value="vaccination" {{ old('record_type') == 'vaccination' ? 'selected' : '' }}>Vaccination</option>
                                        <option value="treatment" {{ old('record_type') == 'treatment' ? 'selected' : '' }}>Treatment</option>
                                        <option value="examination" {{ old('record_type') == 'examination' ? 'selected' : '' }}>Examination</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('record_type')" class="mt-2" />
                                </div>

                                <!-- Record Date -->
                                <div class="mb-4">
                                    <x-input-label for="record_date" :value="__('Date')" />
                                    <x-text-input id="record_date" class="block mt-1 w-full" type="date" name="record_date" :value="old('record_date', date('Y-m-d'))" required />
                                    <x-input-error :messages="$errors->get('record_date')" class="mt-2" />
                                </div>

                                <!-- Performed By -->
                                <div class="mb-4">
                                    <x-input-label for="performed_by" :value="__('Performed By')" />
                                    <x-text-input id="performed_by" class="block mt-1 w-full" type="text" name="performed_by" :value="old('performed_by')" required />
                                    <x-input-error :messages="$errors->get('performed_by')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <!-- Cost -->
                                <div class="mb-4">
                                    <x-input-label for="cost" :value="__('Cost (Optional)')" />
                                    <x-text-input id="cost" class="block mt-1 w-full" type="number" step="0.01" name="cost" :value="old('cost')" />
                                    <x-input-error :messages="$errors->get('cost')" class="mt-2" />
                                </div>

                                <!-- Next Follow Up -->
                                <div class="mb-4">
                                    <x-input-label for="next_follow_up" :value="__('Next Follow Up (Optional)')" />
                                    <x-text-input id="next_follow_up" class="block mt-1 w-full" type="date" name="next_follow_up" :value="old('next_follow_up')" />
                                    <x-input-error :messages="$errors->get('next_follow_up')" class="mt-2" />
                                </div>

                                <!-- Attachments -->
                                <div class="mb-4">
                                    <x-input-label for="attachments" :value="__('Attachments (Optional)')" />
                                    <input id="attachments" type="file" name="attachments" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                                    <p class="mt-1 text-sm text-gray-500">Upload related documents or images (max 2MB)</p>
                                    <x-input-error :messages="$errors->get('attachments')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Additional Notes (Optional)')" />
                            <textarea id="notes" name="notes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ms-4">
                                {{ __('Add Health Record') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
