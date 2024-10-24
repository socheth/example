<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Job Detail') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Job Detail') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4 text-3xl dark:text-blue-400">{{ $job->title }}</p>
                    <p class="text-2xl dark:text-red-400">
                        {{ is_numeric($job->salary) ? Number::currency($job->salary) : $job->salary }}</p>

                    <article class="my-6">{{ $job->requirements }}</article>
                    <article class="my-6">{{ $job->description }}</article>
                    <article class="my-6">{{ $job->benefits }}</article>

                    <div class="flex mt-4">
                        <x-admin.button-link href="{{ route('admin.jobs.index') }}"
                            class="mr-2">Back</x-admin.button-link>
                        <x-admin.button-link href="{{ route('admin.jobs.edit', ['job' => $job]) }}">Edit
                            Job</x-admin.button-link>
                        <form method="POST" onsubmit="return confirm('Are you sure?')"
                            action="{{ route('admin.jobs.destroy', ['job' => $job]) }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>Trash</x-danger-button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
