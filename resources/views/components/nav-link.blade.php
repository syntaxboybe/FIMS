@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-frappe-blue text-sm font-medium leading-5 text-gray-900 dark:text-frappe-text focus:outline-none focus:border-indigo-700 dark:focus:border-frappe-lavender transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-frappe-subtext0 hover:text-gray-700 dark:hover:text-frappe-text hover:border-gray-300 dark:hover:border-frappe-surface2 focus:outline-none focus:text-gray-700 dark:focus:text-frappe-text focus:border-gray-300 dark:focus:border-frappe-surface2 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
