<x-layout headerTitle="Job Detail">
    <x-slot:heading>
        Jobs Detail
    </x-slot:heading>

    <p class="text-3xl">{{ $job->title }}</p>
    <p class="text-2xl">{{ Number::currency($job->salary) }}</p>

</x-layout>
