<x-frontend-layout>
    <x-slot name="headerTitle">
        {{ __('Post Detail') }}
    </x-slot>


    <div class="p-7">

        <div class="overflow-hidden sm:rounded-lg">
            <div class="p-6 ">
                <p class="mb-4 text-3xl dark:text-blue-400">{{ $post->title }}</p>
                <p class="mb-4 ">{{ $post->body }}</p>

                <img class="block w-full max-w-lg mt-5" src="{{ $post->image }}" alt="Post Image">

            </div>

        </div>

    </div>
</x-frontend-layout>
