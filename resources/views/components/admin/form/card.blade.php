<section {!! $attributes->merge([
    'class' => 'flex flex-col p-8 gap-4 bg-white rounded-lg dark:bg-gray-800 shadow-card',
]) !!}>
    {{ $slot }}
</section>
