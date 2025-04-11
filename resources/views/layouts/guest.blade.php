<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="color-scheme" content="light dark">
        <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
        <meta name="theme-color" content="#303446" media="(prefers-color-scheme: dark)">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Dark mode init script (placed in head to avoid FOUC) -->
        <script>
            // Detect if running in mobile browser or inspect mode emulation
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
                            (window.innerWidth <= 768) ||
                            window.matchMedia('(max-width: 767px)').matches;

            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                document.querySelector('meta[name="theme-color"][media="(prefers-color-scheme: dark)"]').setAttribute('content', '#303446');
            } else {
                document.documentElement.classList.remove('dark');
                document.querySelector('meta[name="theme-color"][media="(prefers-color-scheme: light)"]').setAttribute('content', '#ffffff');
            }

            // Add special mobile class if needed
            if (isMobile) {
                document.documentElement.classList.add('is-mobile-view');
            }
        </script>
    </head>
    <body class="font-sans text-gray-900 dark:text-frappe-text antialiased h-full dark-mode-transition">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-frappe-mantle">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500 dark:text-frappe-text" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-frappe-base shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
