<x-app-layout headerTitle="Jobs Page">
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="mb-4 leading-8 list-disc list-inside dark:text-white">
                        @foreach ($jobs as $job)
                            <li><a class="text-blue-400 hover:underline"
                                    href="{{ route('jobs.show', ['job' => $job]) }}">{{ $job->title }}
                                    <span class="text-sm text-red-600">({{ Number::currency($job->salary) }})</span>
                                </a>
                                <x-button href="{{ route('jobs.edit', ['job' => $job]) }}">Edit Job</x-button>
                            </li>
                        @endforeach
                    </ul>

                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
