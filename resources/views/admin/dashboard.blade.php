<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-frappe-text leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-6 sm:mb-8">
                <!-- Total Users -->
                <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-blue-100 dark:bg-frappe-surface0 mb-2 sm:mb-0 mx-auto sm:mx-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 dark:text-frappe-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="text-center sm:text-left sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-frappe-subtext0">Total Users</p>
                                <p class="text-base sm:text-lg font-semibold text-gray-900 dark:text-frappe-text">{{ $stats['total_users'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Farmers -->
                <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-green-100 dark:bg-frappe-surface0 mb-2 sm:mb-0 mx-auto sm:mx-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600 dark:text-frappe-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="text-center sm:text-left sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-frappe-subtext0">Total Farmers</p>
                                <p class="text-base sm:text-lg font-semibold text-gray-900 dark:text-frappe-text">{{ $stats['total_farmers'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Farms -->
                <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-yellow-100 dark:bg-frappe-surface0 mb-2 sm:mb-0 mx-auto sm:mx-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600 dark:text-frappe-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <div class="text-center sm:text-left sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-frappe-subtext0">Total Farms</p>
                                <p class="text-base sm:text-lg font-semibold text-gray-900 dark:text-frappe-text">{{ $stats['total_farms'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Livestock -->
                <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-red-100 dark:bg-frappe-surface0 mb-2 sm:mb-0 mx-auto sm:mx-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600 dark:text-frappe-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </div>
                            <div class="text-center sm:text-left sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-frappe-subtext0">Total Livestock</p>
                                <p class="text-base sm:text-lg font-semibold text-gray-900 dark:text-frappe-text">{{ $stats['total_livestock'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Users -->
                <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text mb-4">Recent Users</h3>
                        <div class="space-y-4">
                            @foreach($stats['recent_users'] as $user)
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-frappe-surface1 flex items-center justify-center">
                                                <span class="text-gray-500 dark:text-frappe-text">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-frappe-text">{{ $user->name }}</div>
                                            <div class="text-xs sm:text-sm text-gray-500 dark:text-frappe-subtext0 truncate max-w-[200px] sm:max-w-none">
                                                <span class="font-medium">{{ $user->username }}</span> | {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs sm:text-sm text-gray-500 dark:text-frappe-subtext1 pl-14 sm:pl-0">
                                        {{ $user->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Farms -->
                <div class="bg-white dark:bg-frappe-base overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-frappe-text mb-4">Recent Farms</h3>
                        <div class="space-y-4">
                            @foreach($stats['recent_farms'] as $farm)
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-frappe-surface1 flex items-center justify-center">
                                                <span class="text-gray-500 dark:text-frappe-text">{{ substr($farm->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-frappe-text">{{ $farm->name }}</div>
                                            <div class="text-xs sm:text-sm text-gray-500 dark:text-frappe-subtext0">{{ $farm->user->name }}</div>
                                        </div>
                                    </div>
                                    <div class="text-xs sm:text-sm text-gray-500 dark:text-frappe-subtext1 pl-14 sm:pl-0">
                                        {{ $farm->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
