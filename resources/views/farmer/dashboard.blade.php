<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
            {{ __('Farmer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($farms->isEmpty())
                <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-frappe-text">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text">Welcome to your Dashboard!</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-frappe-subtext0">Get started by creating your first farm.</p>
                            </div>
                            <a href="{{ route('farmer.farms.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-700 active:bg-green-900 dark:active:bg-green-800 focus:outline-none focus:border-green-900 dark:focus:border-green-800 focus:ring ring-green-300 dark:ring-green-700 disabled:opacity-25 transition ease-in-out duration-150">
                                Create Farm
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Quick Actions -->
                <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('farmer.farms.index') }}" class="bg-blue-50 dark:bg-frappe-surface0 hover:bg-blue-100 dark:hover:bg-frappe-surface1 p-4 rounded-lg flex items-center transition-colors duration-200">
                                <div class="p-3 rounded-full bg-blue-100 dark:bg-frappe-blue/20 mr-4">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-frappe-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-frappe-text">Manage Farms</h4>
                                    <p class="text-sm text-gray-500 dark:text-frappe-subtext0">View and manage your farms</p>
                                </div>
                            </a>
                            <a href="{{ route('farmer.livestock.index') }}" class="bg-green-50 dark:bg-frappe-surface0 hover:bg-green-100 dark:hover:bg-frappe-surface1 p-4 rounded-lg flex items-center transition-colors duration-200">
                                <div class="p-3 rounded-full bg-green-100 dark:bg-green-700/20 mr-4">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-frappe-text">Manage Livestock</h4>
                                    <p class="text-sm text-gray-500 dark:text-frappe-subtext0">Track and manage your animals</p>
                                </div>
                            </a>
                            <a href="{{ route('farmer.health-records.index') }}" class="bg-yellow-50 dark:bg-frappe-surface0 hover:bg-yellow-100 dark:hover:bg-frappe-surface1 p-4 rounded-lg flex items-center transition-colors duration-200">
                                <div class="p-3 rounded-full bg-yellow-100 dark:bg-frappe-yellow/20 mr-4">
                                    <svg class="w-6 h-6 text-yellow-600 dark:text-frappe-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-frappe-text">Health Records</h4>
                                    <p class="text-sm text-gray-500 dark:text-frappe-subtext0">Manage health and treatments</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Total Farms -->
                    <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 dark:bg-frappe-blue/20">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-frappe-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-frappe-subtext0">Total Farms</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-frappe-text">{{ $farms->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Livestock -->
                    <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 dark:bg-green-700/20">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-frappe-subtext0">Total Livestock</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-frappe-text">{{ $total_livestock }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Health Records -->
                    <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 dark:bg-frappe-yellow/20">
                                    <svg class="w-6 h-6 text-yellow-600 dark:text-frappe-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-frappe-subtext0">Total Health Records</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-frappe-text">{{ $total_health_records }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- First Column (wider) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Farms List with Summary -->
                        <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text">Your Farms</h3>
                                    <a href="{{ route('farmer.farms.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-700 active:bg-green-900 dark:active:bg-green-800 focus:outline-none focus:border-green-900 dark:focus:border-green-800 focus:ring ring-green-300 dark:ring-green-700 disabled:opacity-25 transition ease-in-out duration-150">
                                        Add New Farm
                                    </a>
                                </div>
                                <div class="space-y-6">
                                    @foreach($farms as $farm)
                                        <div class="border-b border-gray-200 dark:border-frappe-surface0 pb-6 last:border-0 last:pb-0">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h4 class="text-lg font-medium text-gray-900 dark:text-frappe-text">{{ $farm->name }}</h4>
                                                    <p class="mt-1 text-sm text-gray-500 dark:text-frappe-subtext0">{{ $farm->location ?? 'No location specified' }}</p>
                                                </div>
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('farmer.farms.show', $farm) }}" class="inline-flex items-center px-3 py-1 border border-gray-300 dark:border-frappe-surface1 rounded-md text-sm font-medium text-gray-700 dark:text-frappe-subtext1 bg-white dark:bg-frappe-surface0 hover:bg-gray-50 dark:hover:bg-frappe-surface1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-frappe-green">
                                                        View
                                                    </a>
                                                    <a href="{{ route('farmer.farms.edit', $farm) }}" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 dark:bg-frappe-blue hover:bg-blue-700 dark:hover:bg-frappe-sapphire focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-frappe-lavender">
                                                        Edit
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div class="bg-gray-50 dark:bg-frappe-surface0 p-4 rounded-lg">
                                                    <p class="text-sm font-medium text-gray-500 dark:text-frappe-subtext0">Livestock</p>
                                                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-frappe-text">{{ $farm->livestock->count() }}</p>
                                                </div>
                                                <div class="bg-gray-50 dark:bg-frappe-surface0 p-4 rounded-lg">
                                                    <p class="text-sm font-medium text-gray-500 dark:text-frappe-subtext0">Health Records</p>
                                                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-frappe-text">{{ $farm->health_records_count }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
