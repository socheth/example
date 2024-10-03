<x-layout headerTitle="Home Page">
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    <ol class="list-decimal list-inside">
        @foreach ($users as $user)
            <li>
                {{ $user->name }}
            </li>
        @endforeach
    </ol>

</x-layout>
