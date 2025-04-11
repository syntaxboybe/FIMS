<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'FIMS') }} - Farm Information Management System</title>

        <!-- Favicon -->
        @php
            $faviconUrl = \App\Helpers\SettingsHelper::getFavicon();
        @endphp
        @if ($faviconUrl)
            <link rel="icon" href="{{ $faviconUrl }}" type="image/x-icon">
            <link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/x-icon">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- CSS & JS -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        @endif

        <style>
            .hero-pattern {
                background-color: #f8fafc;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 80 80' width='80' height='80'%3E%3Cpath fill='%239CB675' fill-opacity='0.08' d='M14 16H9v-2h5V9.87a4 4 0 1 1 2 0V14h5v2h-5v15.95A10 10 0 0 0 23.66 27l-3.46-2 8.2-2.2-2.9 5a12 12 0 0 1-21 0l-2.89-5 8.2 2.2-3.47 2A10 10 0 0 0 14 31.95V16zm40 40h-5v-2h5v-4.13a4 4 0 1 1 2 0V54h5v2h-5v15.95A10 10 0 0 0 63.66 67l-3.47-2 8.2-2.2-2.88 5a12 12 0 0 1-21.02 0l-2.88-5 8.2 2.2-3.47 2A10 10 0 0 0 54 71.95V56zm-39 6a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm40-40a2 2 0 1 1 0-4 2 2 0 0 1 0 4zM15 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm40 40a2 2 0 1 0 0-4 2 2 0 0 0 0 4z'%3E%3C/path%3E%3C/svg%3E");
            }

            .stats-card {
                transition: all 0.3s ease;
            }

            .stats-card:hover {
                transform: translateY(-5px);
            }

            @media (max-width: 640px) {
                .feature-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
        <!-- Header/Nav -->
        <header class="bg-white dark:bg-gray-800 shadow-sm fixed top-0 w-full z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <span class="text-2xl font-bold text-green-600 dark:text-green-500">FIMS</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-500">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-500 px-4 py-2">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 text-sm bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors duration-300">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero-pattern pt-24 pb-16 sm:pt-32 sm:pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                    <div class="mb-10 lg:mb-0">
                        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white leading-tight mb-4">
                            Farm Information <span class="text-green-600 dark:text-green-500">Management System</span>
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                            Streamline your farming operations with our comprehensive farm management system. Track livestock, manage crops, monitor finances, and make data-driven decisions.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('login') }}" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                Get Started
                            </a>
                            <a href="#features" class="px-6 py-3 bg-white dark:bg-gray-800 text-green-600 dark:text-green-500 font-medium rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg border border-green-600 dark:border-green-500">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="relative lg:mt-0 flex justify-center">
                        <img src="https://images.unsplash.com/photo-1623868225729-a97d26e8bebe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                             alt="Farm Management"
                             class="rounded-lg shadow-xl max-w-full h-auto lg:max-w-md xl:max-w-lg">
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="bg-white dark:bg-gray-800 py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="stats-card bg-green-50 dark:bg-gray-700 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-3xl font-bold text-green-600 dark:text-green-500">100%</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Data Accuracy</p>
                    </div>
                    <div class="stats-card bg-green-50 dark:bg-gray-700 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-3xl font-bold text-green-600 dark:text-green-500">30%</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Time Saved</p>
                    </div>
                    <div class="stats-card bg-green-50 dark:bg-gray-700 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-3xl font-bold text-green-600 dark:text-green-500">24/7</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Data Access</p>
                    </div>
                    <div class="stats-card bg-green-50 dark:bg-gray-700 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-3xl font-bold text-green-600 dark:text-green-500">500+</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Farmers Using FIMS</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-16 bg-gray-50 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Powerful Features</h2>
                    <p class="max-w-2xl mx-auto text-lg text-gray-600 dark:text-gray-400">
                        Everything you need to manage your farm efficiently in one platform
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 feature-grid">
                    <!-- Feature 1 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Livestock Management</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Track all your animals with detailed records of health, breeding, productivity, and lineage information.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Crop Planning</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Plan planting schedules, track growth stages, and manage harvests across all your fields and crops.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Financial Tracking</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Monitor income, expenses, and profitability with detailed financial reports and forecasting tools.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Task Management</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Organize and assign farm tasks, set priorities, and track completion of daily activities.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Data Analytics</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Make informed decisions with powerful analytics, trends, and performance insights.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Mobile Access</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Access your farm data anytime, anywhere on any device with our responsive mobile-friendly design.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="bg-white dark:bg-gray-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">What Farmers Say</h2>
                    <p class="max-w-2xl mx-auto text-lg text-gray-600 dark:text-gray-400">
                        Hear from farmers who have transformed their operations with our system
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="h-12 w-12 rounded-full bg-green-200 flex items-center justify-center text-green-700 font-bold text-xl">
                                JS
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">John Smith</h4>
                                <p class="text-gray-600 dark:text-gray-400">Dairy Farmer</p>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">
                            "FIMS has completely transformed how I manage my dairy farm. The livestock tracking alone has saved me countless hours and improved my herd's health significantly."
                        </p>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="h-12 w-12 rounded-full bg-green-200 flex items-center justify-center text-green-700 font-bold text-xl">
                                MJ
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Maria Johnson</h4>
                                <p class="text-gray-600 dark:text-gray-400">Crop Farmer</p>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">
                            "The crop planning tools have helped me maximize my yields and reduce waste. I can now make data-driven decisions about what to plant and when."
                        </p>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="h-12 w-12 rounded-full bg-green-200 flex items-center justify-center text-green-700 font-bold text-xl">
                                RD
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Robert Davis</h4>
                                <p class="text-gray-600 dark:text-gray-400">Mixed Farmer</p>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">
                            "Having all my farm data in one place has streamlined my operations. The financial tracking has been particularly valuable for securing loans and planning expansions."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-green-600 dark:bg-green-700 py-16">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Ready to transform your farm management?</h2>
                <p class="text-green-100 text-lg mb-8 max-w-3xl mx-auto">
                    Join hundreds of farmers who are already using our system to optimize their operations and increase profitability.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-green-600 font-medium rounded-lg transition-colors duration-300 shadow-md hover:bg-gray-100">
                        Get Started Today
                    </a>
                    <a href="#" class="px-8 py-4 bg-transparent border border-white text-white font-medium rounded-lg transition-colors duration-300 hover:bg-white hover:bg-opacity-10">
                        Contact Us
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 dark:bg-gray-900 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <h3 class="text-2xl font-bold text-white mb-4">FIMS</h3>
                        <p class="text-gray-400 mb-4 max-w-md">
                            A comprehensive farm information management system designed to help farmers optimize operations, track resources, and make informed decisions.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-white mb-4">Quick Links</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Home</a></li>
                            <li><a href="#features" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Features</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-green-500 transition-colors duration-300">About Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-white mb-4">Contact</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                info@fims.com
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                +1 (123) 456-7890
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} Farm Information Management System. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
