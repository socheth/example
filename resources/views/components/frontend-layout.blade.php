@props(['headerTitle' => 'Laravel 11 example'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Laravel 11 example">
    <title>{{ $headerTitle }}</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="bg-gray-800">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button"
                        class="relative inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>

                        <svg class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <svg class="hidden w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center justify-center flex-1 sm:items-stretch sm:justify-start">
                    <div class="flex items-center flex-shrink-0">
                        <a href="{{ route('pages.home') }}">
                            <x-application-logo class="block w-auto text-white fill-current h-9 dark:text-gray-200" />
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <x-frontend-nav-link :href="route('pages.home')" :active="request()->routeIs('pages.home')">Home</x-frontend-nav-link>
                            <x-frontend-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.index')">Jobs</x-frontend-nav-link>
                            <x-frontend-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">Posts</x-frontend-nav-link>
                            <x-frontend-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.index')">Companies</x-frontend-nav-link>
                        </div>
                    </div>
                </div>


                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                @php($languages = ['en' => 'English', 'ch' => 'Chinese', 'sp' => 'Spanish', 'kh' => 'Khmer'])
                                <div>{{ $languages[Session::get('locale', 'en')] }}</div>

                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('change.lang', ['lang' => 'en'])">
                                English
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('change.lang', ['lang' => 'ch'])">
                                Chinese
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('change.lang', ['lang' => 'sp'])">
                                Spanish
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('change.lang', ['lang' => 'kh'])">
                                Khmer
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button type="button"
                                    class="relative p-1 text-gray-400 bg-gray-800 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">View notifications</span>
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.profile.edit')">All Notifications</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>

                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">

                                    <button type="button"
                                        class="relative flex text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">Open user menu</span>
                                        <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->photo }}"
                                            alt="{{ auth()->user()->name }}">
                                    </button>

                                </x-slot>

                                <x-slot name="content">

                                    <x-dropdown-link :href="route('admin.dashboard')">Dashboard</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.profile.edit')">Your Profile</x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">Sign
                                            out</x-dropdown-link>
                                    </form>

                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endauth
                </div>

                @guest
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Register</a>
                @endguest
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ url('/') }}"
                    class="block px-3 py-2 text-base font-medium text-white bg-gray-900 rounded-md"
                    aria-current="page">Home</a>
                <a href="{{ route('jobs.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Jobs</a>
                <a href="{{ route('posts.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Posts</a>
                <a href="{{ route('pages.about') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">About
                    Us</a>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    @stack('scripts')
</body>

</html>
