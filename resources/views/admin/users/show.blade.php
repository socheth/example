<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Show User') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Show User') }}
        </h2>
        <x-admin.button-link
            href="{{ route('admin.assign.permissions.edit', ['user' => $user]) }}">Permissions</x-admin.button-link>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4 text-3xl dark:text-blue-400">{{ $user->name }}</p>
                    <p class="mb-4 text-gray-400">{{ $user->gender }}. Role is:
                        {{ $user->role() }}</p>
                    <p class="mb-4 text-gray-400">{{ $user->email }} | {{ $user->phone }}</p>
                    <p class="mb-4 text-gray-400">{{ $user->address }}</p>

                    <div class="mt-4 xl:columns-6 lg:columns-5 md:columns-4">
                        @foreach ($user->permissions as $permission)
                            <div class="inline-block mb-4 mr-4 text-gray-400">✅ {{ $permission->description }}</div>
                        @endforeach
                    </div>

                    <div class="flex mt-4">
                        <x-admin.button-link href="{{ route('admin.users.index') }}"
                            class="mr-2">Back</x-admin.button-link>
                        <x-admin.button-link href="{{ route('admin.users.edit', ['user' => $user]) }}">Edit
                            User</x-admin.button-link>
                        <form method="POST" onsubmit="return confirm('Are you sure?')"
                            action="{{ route('admin.users.destroy', ['user' => $user]) }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>Trash</x-danger-button>
                        </form>
                    </div>
                    <img class="block w-32 max-w-lg mt-5" src="{{ $user->photo }}" alt="User Avatar">

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
