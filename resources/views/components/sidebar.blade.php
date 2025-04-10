@props(['isOpen' => false])

<!-- Sidebar container -->
<div x-data="{ open: $persist({{ $isOpen ? 'true' : 'false' }}).using(sessionStorage).as('sidebar_open') }"
     class="h-full min-h-screen flex flex-col bg-white border-r border-gray-200 shadow-lg transition-all duration-300 z-20"
     :class="{'w-64': open, 'w-20': !open}">

    <!-- Logo and toggle button -->
    <div class="p-4 flex items-center justify-between border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <!-- Logo always visible -->
            <div class="shrink-0 flex items-center">
                <x-application-logo class="block h-10 w-auto fill-current text-blue-600 transition-transform duration-300 hover:scale-110" />
            </div>

            <!-- App name only visible when expanded -->
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-x-2"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 class="ml-3 text-xl font-bold text-gray-800">FIMS</div>
        </a>

        <!-- Toggle button -->
        <button @click="open = !open" class="p-2 rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200">
            <svg x-show="open" class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
            <svg x-show="!open" class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <!-- Navigation links -->
    <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        <nav class="mt-5 px-3 space-y-1.5">
            <!-- Dashboard Link (for all users) -->
            <a href="{{ route('dashboard') }}"
               class="group flex items-center py-2.5 px-3 rounded-lg transition-all duration-200
                      {{ request()->routeIs('dashboard')
                        ? 'bg-blue-50 text-blue-700 shadow-sm'
                        : 'text-gray-700 hover:bg-gray-100' }}">
                <div class="{{ request()->routeIs('dashboard') ? 'bg-blue-200' : 'bg-gray-200 group-hover:bg-gray-300' }}
                           p-2 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-500 group-hover:text-gray-600' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <span x-show="open"
                      x-transition:enter="transition ease-out duration-300"
                      x-transition:enter-start="opacity-0"
                      x-transition:enter-end="opacity-100"
                      class="ml-3 font-medium">Dashboard</span>

                <!-- Tooltip for collapsed state -->
                <div x-show="!open" class="absolute left-20 rounded-md px-2 py-1 ml-6 bg-gray-800 text-white text-sm invisible opacity-0 -translate-x-3 group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                    Dashboard
                </div>
            </a>

            <!-- Admin Links -->
            @if (Auth::user()->hasRole('admin'))
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="pt-4 pb-2">
                    <p class="px-3 text-xs font-bold text-blue-500 uppercase tracking-wider">Admin</p>
                </div>

                <!-- Manage Users -->
                <a href="{{ route('admin.users.index') }}"
                   class="group flex items-center py-2.5 px-3 rounded-lg transition-all duration-200
                          {{ request()->routeIs('admin.users.*')
                            ? 'bg-blue-50 text-blue-700 shadow-sm'
                            : 'text-gray-700 hover:bg-gray-100' }}">
                    <div class="{{ request()->routeIs('admin.users.*') ? 'bg-blue-200' : 'bg-gray-200 group-hover:bg-gray-300' }}
                               p-2 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-blue-600' : 'text-gray-500 group-hover:text-gray-600' }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <span x-show="open"
                          x-transition:enter="transition ease-out duration-300"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          class="ml-3 font-medium">Manage Users</span>

                    <!-- Tooltip for collapsed state -->
                    <div x-show="!open" class="absolute left-20 rounded-md px-2 py-1 ml-6 bg-gray-800 text-white text-sm invisible opacity-0 -translate-x-3 group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                        Manage Users
                    </div>
                </a>

                <!-- System Settings -->
                <a href="{{ route('admin.settings.index') }}"
                   class="group flex items-center py-2.5 px-3 rounded-lg transition-all duration-200
                          {{ request()->routeIs('admin.settings.*')
                            ? 'bg-blue-50 text-blue-700 shadow-sm'
                            : 'text-gray-700 hover:bg-gray-100' }}">
                    <div class="{{ request()->routeIs('admin.settings.*') ? 'bg-blue-200' : 'bg-gray-200 group-hover:bg-gray-300' }}
                               p-2 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.settings.*') ? 'text-blue-600' : 'text-gray-500 group-hover:text-gray-600' }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span x-show="open"
                          x-transition:enter="transition ease-out duration-300"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          class="ml-3 font-medium">System Settings</span>

                    <!-- Tooltip for collapsed state -->
                    <div x-show="!open" class="absolute left-20 rounded-md px-2 py-1 ml-6 bg-gray-800 text-white text-sm invisible opacity-0 -translate-x-3 group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                        System Settings
                    </div>
                </a>
            @endif

            <!-- Farmer Links -->
            @if (Auth::user()->hasRole('farmer'))
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="pt-4 pb-2">
                    <p class="px-3 text-xs font-bold text-green-500 uppercase tracking-wider">Farming</p>
                </div>

                <!-- Farms -->
                <a href="{{ route('farmer.farms.index') }}"
                   class="group flex items-center py-2.5 px-3 rounded-lg transition-all duration-200
                          {{ request()->routeIs('farmer.farms.*')
                            ? 'bg-green-50 text-green-700 shadow-sm'
                            : 'text-gray-700 hover:bg-gray-100' }}">
                    <div class="{{ request()->routeIs('farmer.farms.*') ? 'bg-green-200' : 'bg-gray-200 group-hover:bg-gray-300' }}
                               p-2 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5 {{ request()->routeIs('farmer.farms.*') ? 'text-green-600' : 'text-gray-500 group-hover:text-gray-600' }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span x-show="open"
                          x-transition:enter="transition ease-out duration-300"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          class="ml-3 font-medium">Farms</span>

                    <!-- Tooltip for collapsed state -->
                    <div x-show="!open" class="absolute left-20 rounded-md px-2 py-1 ml-6 bg-gray-800 text-white text-sm invisible opacity-0 -translate-x-3 group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                        Farms
                    </div>
                </a>

                <!-- Livestock -->
                <a href="{{ route('farmer.livestock.index') }}"
                   class="group flex items-center py-2.5 px-3 rounded-lg transition-all duration-200
                          {{ request()->routeIs('farmer.livestock.*')
                            ? 'bg-green-50 text-green-700 shadow-sm'
                            : 'text-gray-700 hover:bg-gray-100' }}">
                    <div class="{{ request()->routeIs('farmer.livestock.*') ? 'bg-green-200' : 'bg-gray-200 group-hover:bg-gray-300' }}
                               p-2 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5 {{ request()->routeIs('farmer.livestock.*') ? 'text-green-600' : 'text-gray-500 group-hover:text-gray-600' }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                        </svg>
                    </div>
                    <span x-show="open"
                          x-transition:enter="transition ease-out duration-300"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          class="ml-3 font-medium">Livestock</span>

                    <!-- Tooltip for collapsed state -->
                    <div x-show="!open" class="absolute left-20 rounded-md px-2 py-1 ml-6 bg-gray-800 text-white text-sm invisible opacity-0 -translate-x-3 group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                        Livestock
                    </div>
                </a>

                <!-- Health Records -->
                <a href="{{ route('farmer.health-records.index') }}"
                   class="group flex items-center py-2.5 px-3 rounded-lg transition-all duration-200
                          {{ request()->routeIs('farmer.health-records.*')
                            ? 'bg-green-50 text-green-700 shadow-sm'
                            : 'text-gray-700 hover:bg-gray-100' }}">
                    <div class="{{ request()->routeIs('farmer.health-records.*') ? 'bg-green-200' : 'bg-gray-200 group-hover:bg-gray-300' }}
                               p-2 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5 {{ request()->routeIs('farmer.health-records.*') ? 'text-green-600' : 'text-gray-500 group-hover:text-gray-600' }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span x-show="open"
                          x-transition:enter="transition ease-out duration-300"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          class="ml-3 font-medium">Health Records</span>

                    <!-- Tooltip for collapsed state -->
                    <div x-show="!open" class="absolute left-20 rounded-md px-2 py-1 ml-6 bg-gray-800 text-white text-sm invisible opacity-0 -translate-x-3 group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                        Health Records
                    </div>
                </a>
            @endif
        </nav>
    </div>

    <!-- User Profile Section -->
    <div class="border-t border-gray-200 p-4 bg-gradient-to-r from-gray-50 to-white">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold shadow-sm ring-2 ring-blue-200">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="ml-3">
                <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                <div class="flex mt-2 space-x-3">
                    <a href="{{ route('profile.edit') }}" class="text-xs px-2 py-1 bg-gray-100 rounded-md text-gray-600 hover:bg-gray-200 hover:text-gray-800 transition-colors duration-200">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs px-2 py-1 bg-red-50 rounded-md text-red-600 hover:bg-red-100 hover:text-red-700 transition-colors duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tooltip for collapsed state -->
            <div x-show="!open" class="absolute left-20 bottom-12 rounded-md px-3 py-2 ml-6 bg-gray-800 text-white text-sm invisible opacity-0 -translate-x-3 group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                <p class="font-medium">{{ Auth::user()->name }}</p>
                <div class="flex mt-2 space-x-2">
                    <a href="{{ route('profile.edit') }}" class="text-xs px-2 py-1 bg-gray-700 rounded-md text-gray-200 hover:bg-gray-600">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs px-2 py-1 bg-red-700 rounded-md text-gray-200 hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
