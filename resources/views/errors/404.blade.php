<x-guest-layout>
    <x-slot name="headerTitle">404 - Page Not Found</x-slot>
    <div class="max-w-[50rem] flex flex-col mx-auto size-full">

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content">
            <div class="px-4 py-10 text-center sm:px-6 lg:px-8">
                <h1 class="block font-bold text-gray-800 text-7xl sm:text-9xl dark:text-white">404</h1>
                <p class="mt-3 text-gray-600 dark:text-neutral-400">Oops, something went wrong.</p>
                <p class="text-gray-600 dark:text-neutral-400">Sorry, we couldn't find your page.</p>
                <div class="flex flex-col items-center justify-center gap-2 mt-5 sm:flex-row sm:gap-3">
                    <a class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg sm:w-auto gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                        href="{{ route('home') }}">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                        Back to home
                    </a>
                </div>
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->

        <!-- ========== FOOTER ========== -->
        <footer class="py-5 mt-auto text-center">
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-sm text-gray-500 dark:text-neutral-500">© All Rights Reserved. 2022.</p>
            </div>
        </footer>
        <!-- ========== END FOOTER ========== -->
    </div>
</x-guest-layout>
