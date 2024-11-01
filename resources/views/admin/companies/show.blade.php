<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Company Detail') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Company Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4 text-3xl dark:text-blue-400">{{ $company->name }}</p>
                    <p class="mb-4 text-gray-400">{{ $company->description }}</p>
                    <div class="flex mt-4">
                        <x-admin.button-link href="{{ route('admin.companies.index') }}"
                            class="mr-2">Back</x-admin.button-link>
                        <x-admin.button-link href="{{ route('admin.companies.edit', ['company' => $company]) }}">Edit
                            Company</x-admin.button-link>
                        <form method="POST" onsubmit="return confirm('Are you sure?')"
                            action="{{ route('admin.companies.destroy', ['company' => $company]) }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>Trash</x-danger-button>
                        </form>
                    </div>
                    <img class="block w-full max-w-lg mt-5" src="{{ $company->logo }}" alt="Company Logo">

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
