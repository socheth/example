<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Request Timeout') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Request Timeout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="font-extrabold text-red-600 text-9xl">419</h1>
                <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Request Timeout') }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
