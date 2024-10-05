<x-layout headerTitle="Posts Page">
    <x-slot:heading>
        Posts Page
    </x-slot:heading>

    <ul class="mb-4 leading-8 list-disc list-inside dark:text-white">
        @foreach ($posts as $post)
            <li>
                <a class="text-blue-400 hover:underline"
                    href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}
                </a>
                <x-button href="{{ route('posts.edit', ['post' => $post]) }}">Edit Post</x-button>
            </li>
        @endforeach
    </ul>

    {{ $posts->links() }}
</x-layout>
