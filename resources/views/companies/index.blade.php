<x-frontend-layout>
    <x-slot name="headerTitle">
        {{ __('All Companies') }}
    </x-slot>

    <div class="py-12">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <ul class="leading-8 list-disc list-inside ">
                @foreach ($companies as $company)
                    <li>
                        <a class="hover:underline"
                            href="{{ route('companies.slug', ['slug' => $company->slug, 'id' => $company->id]) }}">{{ $company->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{ $companies->links() }}

        </div>
    </div>
</x-frontend-layout>
