<x-frontend-layout>
    <x-slot name="headerTitle">
        {{ __('Job Detail') }}
    </x-slot>

    <div class="p-7">

        <div class="overflow-hidden ">
            <div class="p-6 text-gray-90">
                <p class="mb-4 text-3xl text-blue-400">{{ $job->title }}</p>
                <p class="mb-4 text-2xl text-red-400">{{ Number::currency($job->salary) }}</p </div>
                <p class="mb-4">{{ $job->requirements }}</p>
                <p class="mb-4">{{ $job->description }}</p>
                <p class="mb-4">{{ $job->benefits }}</p>
            </div>
        </div>


</x-frontend-layout>
