<x-layout headerTitle="Jobs Page">
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    <ul class="leading-8 list-disc list-inside dark:text-white">
        @foreach ($jobs as $job)
            <li><a class="text-blue-400 hover:underline" target="_blank"
                    href="{{ route('job', ['id' => $job->id]) }}">{{ $job->title }}
                    <span class="text-sm text-red-600">({{ Number::currency($job->salary) }})</span>
                </a></li>
        @endforeach
    </ul>

    {{ $jobs->links() }}
</x-layout>
