<x-layout headerTitle="Jobs Page">
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

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
</x-layout>
