<header class="h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-6">

    <!-- Left: Search -->
    <div class="flex items-center gap-4 w-full max-w-md">

        <form action="{{ route('expenses.index') }}" method="GET" class="flex items-center gap-4 w-full">
        
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

    <!-- Right -->
    <div class="flex items-center gap-4">

        <!-- Workspace -->
        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg text-sm">
            Personal Finance
        </span>
        <button
    @click="toggle()"
    class="px-3 py-1 rounded-lg bg-gray-200 dark:bg-gray-700 text-sm text-gray-800 dark:text-white hover:opacity-80 transition"
>
    <span x-text="dark ? '☀️ Light' : '🌙 Dark'"></span>
</button>

        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">

            @auth
                <!-- Trigger -->
                <button
                    @click="open = !open"
                    class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white flex items-center gap-2"
                >
                    👤
                    <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                </button>

                <!-- Dropdown -->
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden z-50"
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
                   class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    👤 Login
                </a>
            @endguest

        </div>

    </div>

</header>