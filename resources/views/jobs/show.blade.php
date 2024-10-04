<x-layout headerTitle="Job Detail">
    <x-slot:heading>
        Jobs Detail
    </x-slot:heading>

    <p class="mb-4 text-3xl dark:text-blue-400">{{ $job->title }}</p>
    <p class="text-2xl dark:text-red-400">{{ Number::currency($job->salary) }}</p>

</x-layout>
