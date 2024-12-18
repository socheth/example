<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Admin Dashboard') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Your role is:') }}
                    <span class="font-bold text-blue-400">{{ auth()->user()->role() }}</span>

                    {{ __('messages.dashboard_message') }}

                    @foreach ($share_categories as $category)
                        {{ $category }}
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
