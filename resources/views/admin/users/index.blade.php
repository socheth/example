<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('All Users') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('All Users') }}
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
                        @foreach ($users as $user)
                            <li class="flex items-center justify-between mb-2">
                                <a class="text-blue-400 hover:underline"
                                    href="{{ route('admin.users.show', ['user' => $user]) }}">{{ $user->name }}
                                </a>
                                <div class="flex justify-end ms-auto">
                                    <x-admin.button-link
                                        href="{{ route('admin.assign.permissions.edit', ['user' => $user]) }}">Permissions</x-admin.button-link>
                                    <x-admin.button-link
                                        href="{{ route('admin.users.edit', ['user' => $user]) }}">Edit</x-admin.button-link>
                                    <form onsubmit="return confirm('Are you sure?')" method="POST"
                                        action="{{ route('admin.users.destroy', ['user' => $user]) }}">
                                        <x-danger-button>Trash</x-danger-button>
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
