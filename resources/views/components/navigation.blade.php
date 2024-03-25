<nav class="fixed top-0 flex-no-wrap w-full z-10 bg-gray-200 shadow shadow-gray-300 w-100 px-8 md:px-auto">
    <div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
        <!-- Logo -->
        <div class="text-indigo-500 md:order-1">
            <!-- Heroicon - Chip Outline -->
            <a href="#hero"> <img width="150px" src="/storage/images/logo.svg" alt="logo" id="logo"></a>
        </div>
        <div class="text-gray-500 order-3 w-full md:w-auto md:order-2">
            <ul class="flex font-semibold justify-between">
                <!-- Active Link = text-indigo-500
                Inactive Link = hover:text-indigo-500 -->
                <li class="md:px-4 md:py-2 hover:text-indigo-400"><a href="#how">How it works</a></li>
                <li class="md:px-4 md:py-2 hover:text-indigo-400"><a href="#">About</a></li>
                <li class="md:px-4 md:py-2 hover:text-indigo-400"><a href="#price">Price</a></li>
                <li class="md:px-4 md:py-2 hover:text-indigo-400"><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="order-2 md:order-3">
            @if (Route::has('login'))
                <div class="sm:top-0 sm:right-0 p-5 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                           class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>
