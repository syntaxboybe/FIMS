<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-frappe-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-frappe-sapphire focus:bg-gray-700 dark:focus:bg-frappe-sapphire active:bg-gray-900 dark:active:bg-frappe-mauve focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-frappe-lavender focus:ring-offset-2 dark:focus:ring-offset-frappe-base transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
