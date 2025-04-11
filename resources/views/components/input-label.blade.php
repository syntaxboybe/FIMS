@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-frappe-text']) }}>
    {{ $value ?? $slot }}
</label>
