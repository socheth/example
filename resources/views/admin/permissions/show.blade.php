<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Permission Detail') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Permission Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4 text-3xl dark:text-blue-400">{{ $permission->name }}</p>
                    <p class="mb-4 text-gray-400">{{ $permission->description }}</p>

                    <label class="block mb-1 font-bold text-gray-700 dark:text-gray-300">{{ __('Users') }}</label>

                    <ol class="list-decimal list-inside">
                        @foreach ($users as $user)
                            <li>{{ $user->name }} ({{ $user->role() }})</li>
                        @endforeach
                    </ol>

                    <div class="flex mt-4">
                        <x-admin.button-link href="{{ route('admin.permissions.index') }}"
                            class="mr-2">Back</x-admin.button-link>
                        <x-admin.button-link
                            href="{{ route('admin.permissions.edit', ['permission' => $permission]) }}">Edit
                            Permission</x-admin.button-link>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
