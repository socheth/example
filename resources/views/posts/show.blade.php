<x-layout headerTitle="Post Detail">
    <x-slot:heading>
        Post Detail
    </x-slot:heading>

    <p class="mb-4 text-3xl dark:text-blue-400">{{ $post->title }}</p>
    <p class="text-gray-400">{{ $post->body }}</p>

</x-layout>
