<x-layout headerTitle="Job Detail">
    <x-slot:heading>
        Jobs Detail
    </x-slot:heading>

    <p class="mb-4 text-3xl dark:text-blue-400">{{ $job->title }}</p>
    <p class="text-2xl dark:text-red-400">{{ Number::currency($job->salary) }}</p>

    <div class="flex mt-4">

        <x-button href="{{ route('jobs.index') }}" class="mr-2">Back</x-button>

        <x-button href="{{ route('jobs.edit', ['job' => $job]) }}">Edit Job</x-button>

        <form method="POST" action="{{ route('jobs.destroy', ['job' => $job]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Trash</button>
        </form>
    </div>
</x-layout>
