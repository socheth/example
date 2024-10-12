<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Post Detail') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Post Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4 text-3xl dark:text-blue-400">{{ $post->title }}</p>
                    <p class="mb-4 text-gray-400">{{ $post->body }}</p>
                    <div class="flex mt-4">
                        <x-admin.button-link href="{{ route('admin.posts.index') }}"
                            class="mr-2">Back</x-admin.button-link>
                        <x-admin.button-link href="{{ route('admin.posts.edit', ['post' => $post]) }}">Edit
                            Post</x-admin.button-link>
                        <form method="POST" onsubmit="return confirm('Are you sure?')"
                            action="{{ route('admin.posts.destroy', ['post' => $post]) }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>Trash</x-danger-button>
                        </form>
                    </div>
                    <img class="block w-full max-w-lg mt-5" src="{{ $post->image }}" alt="Post Image">

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
