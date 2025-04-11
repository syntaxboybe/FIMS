<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
                {{ __('Add New Livestock') }}
            </h2>
            <a href="{{ route('farmer.livestock.index') }}" class="bg-gray-500 hover:bg-gray-600 dark:bg-frappe-surface1 dark:hover:bg-frappe-surface2 text-white dark:text-frappe-text font-bold py-2 px-4 rounded">
                Back to Livestock
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-frappe-text">
                    <form method="POST" action="{{ route('farmer.livestock.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <!-- Farm -->
                                <div class="mb-4">
                                    <x-input-label for="farm_id" :value="__('Farm')" />
                                    <select id="farm_id" name="farm_id" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" required>
                                        <option value="">Select Farm</option>
                                        @foreach ($farms as $farm)
                                            <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>{{ $farm->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('farm_id')" class="mt-2" />
                                </div>

                                <!-- Category -->
                                <div class="mb-4">
                                    <x-input-label for="livestock_category_id" :value="__('Category')" />
                                    <select id="livestock_category_id" name="livestock_category_id" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('livestock_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }} ({{ $category->species }})</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('livestock_category_id')" class="mt-2" />
                                </div>

                                <!-- Tag Number -->
                                <div class="mb-4">
                                    <x-input-label for="tag_number" :value="__('Tag Number')" />
                                    <x-text-input id="tag_number" class="block mt-1 w-full" type="text" name="tag_number" :value="old('tag_number')" required />
                                    <x-input-error :messages="$errors->get('tag_number')" class="mt-2" />
                                </div>

                                <!-- Name -->
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Name (Optional)')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Gender -->
                                <div class="mb-4">
                                    <x-input-label for="gender" :value="__('Gender')" />
                                    <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" required>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                        <option value="deceased" {{ old('status') == 'deceased' ? 'selected' : '' }}>Deceased</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <!-- Birth Date -->
                                <div class="mb-4">
                                    <x-input-label for="birth_date" :value="__('Birth Date')" />
                                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" />
                                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                                </div>

                                <!-- Breed -->
                                <div class="mb-4">
                                    <x-input-label for="breed" :value="__('Breed')" />
                                    <x-text-input id="breed" class="block mt-1 w-full" type="text" name="breed" :value="old('breed')" />
                                    <x-input-error :messages="$errors->get('breed')" class="mt-2" />
                                </div>

                                <!-- Color -->
                                <div class="mb-4">
                                    <x-input-label for="color" :value="__('Color')" />
                                    <x-text-input id="color" class="block mt-1 w-full" type="text" name="color" :value="old('color')" />
                                    <x-input-error :messages="$errors->get('color')" class="mt-2" />
                                </div>

                                <!-- Weight -->
                                <div class="mb-4">
                                    <x-input-label for="weight" :value="__('Weight (kg)')" />
                                    <x-text-input id="weight" class="block mt-1 w-full" type="number" step="0.01" name="weight" :value="old('weight')" />
                                    <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                                </div>

                                <!-- Purchase Date -->
                                <div class="mb-4">
                                    <x-input-label for="purchase_date" :value="__('Purchase Date')" />
                                    <x-text-input id="purchase_date" class="block mt-1 w-full" type="date" name="purchase_date" :value="old('purchase_date')" />
                                    <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
                                </div>

                                <!-- Purchase Price -->
                                <div class="mb-4">
                                    <x-input-label for="purchase_price" :value="__('Purchase Price')" />
                                    <x-text-input id="purchase_price" class="block mt-1 w-full" type="number" step="0.01" name="purchase_price" :value="old('purchase_price')" />
                                    <x-input-error :messages="$errors->get('purchase_price')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Notes')" />
                            <textarea id="notes" name="notes" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" rows="3">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <input id="image" type="file" name="image" class="block mt-1 w-full border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-surface0 dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm" accept="image/*" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-frappe-subtext0">Upload an image of the livestock (optional)</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ms-4">
                                {{ __('Add Livestock') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
