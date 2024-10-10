<x-frontend-layout>
    <x-slot name="headerTitle">
        {{ __('All Jobs') }}
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <ul class="leading-8 list-disc list-inside ">
                @foreach ($jobs as $job)
                    <li><a class="hover:underline"
                            href="{{ route('jobs.slug', ['slug' => $job->slug, 'id' => $job]) }}">{{ $job->title }}
                            <span class="text-sm text-red-600">({{ Number::currency($job->salary) }})</span>
                        </a>
                    </li>
                @endforeach
            </ul>

            {{ $jobs->links() }}

        </div>
    </div>
</x-frontend-layout>
