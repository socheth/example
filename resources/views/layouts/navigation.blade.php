<nav x-data="{ open: false }" class="sticky top-0 bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('pages.home') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="items-center hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @can('job.viewAny')
                        <x-nav-link :href="route('admin.jobs.index')" :active="request()->routeIs('admin.jobs.index')">
                            {{ __('Jobs') }}
                        </x-nav-link>
                    @endcan
                    @can('post.viewAny')
                        <x-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.index')">
                            {{ __('Posts') }}
                        </x-nav-link>
                    @endcan
                    @can('company.viewAny')
                        <x-nav-link :href="route('admin.companies.index')" :active="request()->routeIs('admin.companies.index')">
                            {{ __('Companies') }}
                        </x-nav-link>
                    @endcan
                    @can('user.viewAny')
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                            {{ __('Users') }}
                        </x-nav-link>
                    @endcan
                    @can('role.viewAny')
                        <x-nav-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">
                            {{ __('Roles') }}
                        </x-nav-link>
                    @endcan
                    @can('permission.viewAny')
                        <x-nav-link :href="route('admin.permissions.index')" :active="request()->routeIs('admin.permissions.index')">
                            {{ __('Permissions') }}
                        </x-nav-link>
                    @endcan

                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                <div>{{ __('Create New') }}</div>

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
                            @can('job.create')
                                <x-dropdown-link :href="route('admin.jobs.create')">
                                    {{ __('New Job ') }}
                                </x-dropdown-link>
                            @endcan
                            @can('post.create')
                                <x-dropdown-link :href="route('admin.posts.create')">
                                    {{ __('New Post') }}
                                </x-dropdown-link>
                            @endcan
                            @can('company.create')
                                <x-dropdown-link :href="route('admin.companies.create')">
                                    {{ __('New Company') }}
                                </x-dropdown-link>
                            @endcan
                            @can('user.create')
                                <x-dropdown-link :href="route('admin.users.create')">
                                    {{ __('New User') }}
                                </x-dropdown-link>
                            @endcan
                            @can('role.create')
                                <x-dropdown-link :href="route('admin.roles.create')">
                                    {{ __('New Role') }}
                                </x-dropdown-link>
                            @endcan
                            @can('permission.create')
                                <x-dropdown-link :href="route('admin.permissions.create')">
                                    {{ __('New Permission') }}
                                </x-dropdown-link>
                            @endcan
                        </x-slot>
                    </x-dropdown>

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
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

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>
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
                        <x-dropdown-link :href="route('admin.profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.jobs.index')" :active="request()->routeIs('admin.jobs.index')">
                {{ __('Jobs') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.index')">
                {{ __('Posts') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.companies.index')" :active="request()->routeIs('admin.companies.index')">
                {{ __('Companies') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.jobs.create')" :active="request()->routeIs('admin.jobs.create')">
                {{ __('Create Job') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.posts.create')" :active="request()->routeIs('admin.posts.create')">
                {{ __('Create Post') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.companies.create')" :active="request()->routeIs('admin.companies.create')">
                {{ __('Create Company') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
