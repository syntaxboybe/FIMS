<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
                {{ __('Edit Health Record') }}
            </h2>
            <a href="{{ route('farmer.health-records.show', $healthRecord) }}" class="bg-gray-500 hover:bg-gray-600 dark:bg-frappe-surface1 dark:hover:bg-frappe-surface2 text-white dark:text-frappe-text font-bold py-2 px-4 rounded">
                Back to Details
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-frappe-text">
                    <form method="POST" action="{{ route('farmer.health-records.update', $healthRecord) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Livestock -->
                        <div class="mb-4">
                            <x-input-label for="livestock_id" :value="__('Livestock')" />
                            <select id="livestock_id" name="livestock_id" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" required>
                                <option value="">Select Livestock</option>
                                @foreach ($livestock as $animal)
                                    <option value="{{ $animal->id }}" {{ old('livestock_id', $healthRecord->livestock_id) == $animal->id ? 'selected' : '' }}>
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
                                    <select id="record_type" name="record_type" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" required>
                                        <option value="">Select Type</option>
                                        <option value="vaccination" {{ old('record_type', $healthRecord->record_type) == 'vaccination' ? 'selected' : '' }}>Vaccination</option>
                                        <option value="treatment" {{ old('record_type', $healthRecord->record_type) == 'treatment' ? 'selected' : '' }}>Treatment</option>
                                        <option value="examination" {{ old('record_type', $healthRecord->record_type) == 'examination' ? 'selected' : '' }}>Examination</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('record_type')" class="mt-2" />
                                </div>

                                <!-- Record Date -->
                                <div class="mb-4">
                                    <x-input-label for="record_date" :value="__('Date')" />
                                    <x-text-input id="record_date" class="block mt-1 w-full" type="date" name="record_date" :value="old('record_date', $healthRecord->record_date->format('Y-m-d'))" required />
                                    <x-input-error :messages="$errors->get('record_date')" class="mt-2" />
                                </div>

                                <!-- Performed By -->
                                <div class="mb-4">
                                    <x-input-label for="performed_by" :value="__('Performed By')" />
                                    <x-text-input id="performed_by" class="block mt-1 w-full" type="text" name="performed_by" :value="old('performed_by', $healthRecord->performed_by)" required />
                                    <x-input-error :messages="$errors->get('performed_by')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <!-- Cost -->
                                <div class="mb-4">
                                    <x-input-label for="cost" :value="__('Cost (Optional)')" />
                                    <x-text-input id="cost" class="block mt-1 w-full" type="number" step="0.01" name="cost" :value="old('cost', $healthRecord->cost)" />
                                    <x-input-error :messages="$errors->get('cost')" class="mt-2" />
                                </div>

                                <!-- Next Follow Up -->
                                <div class="mb-4">
                                    <x-input-label for="next_follow_up" :value="__('Next Follow Up (Optional)')" />
                                    <x-text-input id="next_follow_up" class="block mt-1 w-full" type="date" name="next_follow_up" :value="old('next_follow_up', $healthRecord->next_follow_up ? $healthRecord->next_follow_up->format('Y-m-d') : '')" />
                                    <x-input-error :messages="$errors->get('next_follow_up')" class="mt-2" />
                                </div>

                                <!-- Current Attachment -->
                                @if ($healthRecord->attachments)
                                    <div class="mb-4">
                                        <p class="text-sm font-medium text-gray-700 dark:text-frappe-subtext0 mb-2">Current Attachment:</p>
                                        <a href="{{ asset('storage/' . $healthRecord->attachments) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">
                                            View Attachment
                                        </a>
                                    </div>
                                @endif

                                <!-- Attachments -->
                                <div class="mb-4">
                                    <x-input-label for="attachments" :value="__('Update Attachments (Optional)')" />
                                    <input id="attachments" type="file" name="attachments" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-frappe-subtext0">Upload new documents or images (max 2MB)</p>
                                    <x-input-error :messages="$errors->get('attachments')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" rows="3" required>{{ old('description', $healthRecord->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Additional Notes (Optional)')" />
                            <textarea id="notes" name="notes" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" rows="3">{{ old('notes', $healthRecord->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ms-4">
                                {{ __('Update Health Record') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
