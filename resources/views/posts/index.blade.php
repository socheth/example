<x-frontend-layout>
    <x-slot name="headerTitle">
        {{ __('All Posts') }}
    </x-slot>

    <div class="py-12">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <ul class="leading-8 list-disc list-inside ">
                @foreach ($posts as $post)
                    <li>
                        <a class="hover:underline"
                            href="{{ route('posts.slug', ['slug' => $post->slug, 'id' => $post->id]) }}">{{ $post->title }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{ $posts->links() }}

        </div>
    </div>
</x-frontend-layout>
