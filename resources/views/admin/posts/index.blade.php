<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('All Posts') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('All Posts') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('message'))
                <div class="p-4 text-green-500">
                    {{ session('message') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="leading-8 list-disc list-inside dark:text-white">
                        @foreach ($posts as $post)
                            <li class="flex items-center justify-between mb-2">
                                <a class="text-blue-400 hover:underline"
                                    href="{{ route('admin.posts.show', ['post' => $post]) }}">{{ $post->title }}
                                </a>
                                <div class="flex justify-end ms-auto">
                                    <x-admin.button-link
                                        href="{{ route('admin.posts.edit', ['post' => $post]) }}">Edit</x-admin.button-link>
                                    <form onsubmit="return confirm('Are you sure?')" method="POST"
                                        action="{{ route('admin.posts.destroy', ['post' => $post]) }}">
                                        <x-danger-button>Trash</x-danger-button>
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    {{ $posts->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
