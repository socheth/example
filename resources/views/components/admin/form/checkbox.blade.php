@props(['disabled' => false, 'label' => '', 'checked' => false])

<label for="{{ $attributes->get('id') }}" class="inline-flex items-center">
    <input type="checkbox" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800',
    ]) !!} {{ $checked ? 'checked' : '' }}>
    <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ $label }}</span>
</label>
