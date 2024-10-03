<x-layout headerTitle="Post Detail">
    <x-slot:heading>
        Post Detail
    </x-slot:heading>

    <p class="text-3xl">{{ $post->title }}</p>
    <p class="text-gray-400 ">{{ $post->body }}</p>

</x-layout>
