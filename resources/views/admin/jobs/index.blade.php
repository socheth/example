<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('All Jobs') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('All Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('message'))
                <div class="p-4 text-green-500">
                    {{ session('message') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="leading-8 list-disc list-inside dark:text-white">
                        @foreach ($jobs as $job)
                            <li class="flex items-center justify-between mb-2">
                                <a class="text-blue-400 hover:underline"
                                    href="{{ route('admin.jobs.show', ['job' => $job]) }}">{{ $job->title }}
                                    <span class="text-sm text-red-600">({{ Number::currency($job->salary) }})</span>
                                </a>
                                <x-button href="{{ route('admin.jobs.edit', ['job' => $job]) }}">Edit</x-button>
                            </li>
                        @endforeach
                    </ul>

                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
