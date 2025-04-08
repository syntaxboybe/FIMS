<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('General Settings') }}
            </h2>
            <a href="{{ route('admin.settings.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.settings.update', 'general') }}">
                        @csrf
                        
                        @foreach ($settings as $setting)
                            <div class="mb-6">
                                <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">{{ $setting->label }}</label>
                                
                                @if ($setting->type === 'text' || $setting->type === 'email')
                                    <input type="{{ $setting->type }}" name="{{ $setting->key }}" id="{{ $setting->key }}" 
                                        value="{{ old($setting->key, $setting->value) }}" 
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @elseif ($setting->type === 'textarea')
                                    <textarea name="{{ $setting->key }}" id="{{ $setting->key }}" rows="3" 
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old($setting->key, $setting->value) }}</textarea>
                                @elseif ($setting->type === 'select')
                                    <select name="{{ $setting->key }}" id="{{ $setting->key }}" 
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach (json_decode($setting->options, true) as $optionValue => $optionLabel)
                                            <option value="{{ $optionValue }}" {{ old($setting->key, $setting->value) == $optionValue ? 'selected' : '' }}>
                                                {{ $optionLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                @elseif ($setting->type === 'boolean')
                                    <div class="mt-1">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="{{ $setting->key }}" 
                                                {{ old($setting->key, $setting->value) === 'true' ? 'checked' : '' }}
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Enabled') }}</span>
                                        </label>
                                    </div>
                                @endif
                                
                                @if ($setting->description)
                                    <p class="mt-1 text-sm text-gray-500">{{ $setting->description }}</p>
                                @endif
                            </div>
                        @endforeach
                        
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
