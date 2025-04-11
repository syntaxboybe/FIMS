<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
                {{ __('Extensions Settings') }}
            </h2>
            <a href="{{ route('admin.settings.index') }}" class="bg-gray-300 dark:bg-frappe-surface1 hover:bg-gray-400 dark:hover:bg-frappe-surface2 text-gray-800 dark:text-frappe-text font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-frappe-base border-b border-gray-200 dark:border-frappe-surface0">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.settings.update', 'extension') }}">
                        @csrf

                        @foreach ($settings as $setting)
                            <div class="mb-6">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" name="{{ $setting->key }}" id="{{ $setting->key }}"
                                            {{ old($setting->key, $setting->value) === 'true' ? 'checked' : '' }}
                                            class="focus:ring-indigo-500 dark:focus:ring-frappe-lavender h-4 w-4 text-indigo-600 dark:text-frappe-lavender border-gray-300 dark:border-frappe-surface1 rounded dark:bg-frappe-mantle">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="{{ $setting->key }}" class="font-medium text-gray-700 dark:text-frappe-subtext1">{{ $setting->label }}</label>
                                        @if ($setting->description)
                                            <p class="text-gray-500 dark:text-frappe-subtext0">{{ $setting->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-frappe-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-frappe-sapphire active:bg-gray-900 dark:active:bg-frappe-lavender focus:outline-none focus:border-gray-900 dark:focus:border-frappe-lavender focus:ring ring-gray-300 dark:ring-frappe-overlay0 disabled:opacity-25 transition ease-in-out duration-150">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
