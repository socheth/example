<x-frontend-layout headerTitle="Home Page">

    @auth
        <a href="{{ route('admin.index') }}">Dashboard</a>
        <img src="{{ Vite::asset('resources/images/1.webp') }}" alt="User Image" class="w-24 h-24">
    @endauth

    @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endguest

</x-frontend-layout>
