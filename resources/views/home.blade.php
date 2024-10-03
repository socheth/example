<x-layout headerTitle="Home Page">
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    <ol class="leading-8 list-decimal list-inside dark:text-white">
        @foreach ($users as $user)
            <li>
                <span class="text-yellow-400">{{ $user->name }}</span>
            </li>
        @endforeach
    </ol>

</x-layout>
