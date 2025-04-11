<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 dark:bg-frappe-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 dark:hover:bg-frappe-maroon active:bg-red-700 dark:active:bg-frappe-peach focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-frappe-peach focus:ring-offset-2 dark:focus:ring-offset-frappe-base transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
