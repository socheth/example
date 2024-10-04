<x-layout headerTitle="Posts Page">
    <x-slot:heading>
        Posts Page
    </x-slot:heading>

    <ul class="mb-4 leading-8 list-disc list-inside dark:text-white">
        @foreach ($posts as $post)
            <li>
                <a class="text-blue-400 hover:underline" target="_blank"
                    href="{{ route('post', ['id' => $post->id]) }}">{{ $post->title }}
                </a>
            </li>
        @endforeach
    </ul>

    {{ $posts->links() }}
</x-layout>