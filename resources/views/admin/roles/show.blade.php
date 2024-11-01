<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Role Detail') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Role Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4 text-3xl dark:text-blue-400">Role: <span class="font-bold text-gray-100">
                            {{ $role->name }}</span></p>
                    <p class="mb-4 text-gray-400">Level: <span class="font-bold text-green-400"> {{ $role->level }}
                        </span></p>
                    <x-input-label :value="__('Permissions')" />

                    <div class="mt-4 xl:columns-6 lg:columns-5 md:columns-4">
                        @foreach ($permissions as $permission)
                            @if ($role->permissions->pluck('id')->contains($permission->id))
                                <div class="mb-4 mr-4 font-bold">✅ {{ $permission->description }}</div>
                            @else
                                <div class="mb-4 mr-4 font-bold">❌ {{ $permission->description }}</div>
                            @endif
                        @endforeach
                    </div>

                    <hr class="my-4">

                    <label class="block mb-1 font-bold text-gray-700 dark:text-gray-300">{{ __('Users') }}</label>
                    <ol class="list-decimal list-inside">
                        @foreach ($users as $user)
                            <li>{{ $user->name }} ({{ $user->role() }})</li>
                        @endforeach
                    </ol>

                    <div class="flex mt-4">
                        <x-admin.button-link href="{{ route('admin.roles.index') }}"
                            class="mr-2">Back</x-admin.button-link>
                        <x-admin.button-link href="{{ route('admin.roles.edit', ['role' => $role]) }}">Edit
                            Role</x-admin.button-link>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
