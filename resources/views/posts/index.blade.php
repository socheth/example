<x-app-layout headerTitle="Posts Page">
    <x-slot:heading>
        Posts Page
    </x-slot:heading>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
