@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-md'
            : 'px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white rounded-md';
@endphp

<a {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</a>
