<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Logo and Favicon Settings') }}
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

                    <form method="POST" action="{{ route('admin.settings.update', 'logo') }}" enctype="multipart/form-data">
                        @csrf
                        
                        @foreach ($settings as $setting)
                            <div class="mb-6">
                                <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">{{ $setting->label }}</label>
                                
                                <div class="mt-1 flex items-center">
                                    @if ($setting->value)
                                        <div class="mr-4">
                                            <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->label }}" class="h-16 w-auto object-contain">
                                        </div>
                                    @endif
                                    
                                    <input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}" 
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                
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
