<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-frappe-surface1 border border-gray-300 dark:border-frappe-surface2 rounded-md font-semibold text-xs text-gray-700 dark:text-frappe-text uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-frappe-surface2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-frappe-lavender focus:ring-offset-2 dark:focus:ring-offset-frappe-base disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
