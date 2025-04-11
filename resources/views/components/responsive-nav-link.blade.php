@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 dark:border-frappe-blue text-start text-base font-medium text-indigo-700 dark:text-frappe-blue bg-indigo-50 dark:bg-frappe-surface0 focus:outline-none focus:text-indigo-800 dark:focus:text-frappe-lavender focus:bg-indigo-100 dark:focus:bg-frappe-surface1 focus:border-indigo-700 dark:focus:border-frappe-lavender transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 dark:text-frappe-subtext0 hover:text-gray-800 dark:hover:text-frappe-text hover:bg-gray-50 dark:hover:bg-frappe-surface0 hover:border-gray-300 dark:hover:border-frappe-surface2 focus:outline-none focus:text-gray-800 dark:focus:text-frappe-text focus:bg-gray-50 dark:focus:bg-frappe-surface0 focus:border-gray-300 dark:focus:border-frappe-surface2 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
