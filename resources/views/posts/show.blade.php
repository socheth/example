<x-layout headerTitle="Post Detail">
    <x-slot:heading>
        Post Detail
    </x-slot:heading>

    <p class="mb-4 text-3xl dark:text-blue-400">{{ $post->title }}</p>
    <p class="mb-4 text-gray-400">{{ $post->body }}</p>
    <div class="flex mt-4">
        <x-button href="{{ route('posts.index') }}" class="mr-2">Back</x-button>
        <x-button href="{{ route('posts.edit', ['post' => $post]) }}">Edit Post</x-button>
        <form method="POST" onsubmit="return confirm('Are you sure?')"
            action="{{ route('posts.destroy', ['post' => $post]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded-md btn btn-danger">Trash</button>
        </form>
    </div>
    <img class="block w-full max-w-lg mt-5" src="{{ $post->image }}" alt="Post Image">

</x-layout>
