@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-frappe-surface1 dark:bg-frappe-mantle dark:text-frappe-text focus:border-indigo-500 dark:focus:border-frappe-lavender focus:ring-indigo-500 dark:focus:ring-frappe-lavender rounded-md shadow-sm']) }}>
