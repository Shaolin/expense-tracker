<header class="h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-4 md:px-6">

    <!-- LEFT -->
    <div class="flex items-center gap-3 w-full">

        <!-- Mobile Hamburger -->
        <button @click="sidebarOpen = true" class="md:hidden text-2xl">
            ☰
        </button>

        <!-- Desktop Search -->
        <div class="hidden md:block w-full max-w-md">
            <form action="{{ route('expenses.index') }}" method="GET" class="flex items-center gap-2 w-full">
                
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search expenses..."
                    class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg outline-none placeholder-gray-500 dark:placeholder-gray-400"
                >

                <button type="submit" class="text-gray-500">
                    🔍
                </button>

            </form>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-3 md:gap-4">

        <!-- Workspace (desktop only) -->
        <span class="hidden md:inline px-3 py-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg text-sm">
            Personal Finance
        </span>

        <!-- Dark Mode -->
        <button
            @click="toggle()"
            class="px-2 md:px-3 py-1 rounded-lg bg-gray-200 dark:bg-gray-700 text-sm text-gray-800 dark:text-white"
        >
            <span x-text="dark ? '☀️' : '🌙'"></span>
        </button>

        <!-- Profile -->
        <div class="relative" x-data="{ open: false }">

            @auth
                <button
                    @click="open = !open"
                    class="text-gray-600 dark:text-gray-300 flex items-center gap-2"
                >
                    👤
                    <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                </button>

                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-44 bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden z-50"
                >
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                   class="text-gray-600 dark:text-gray-300">
                    👤
                </a>
            @endguest

        </div>

    </div>

</header>