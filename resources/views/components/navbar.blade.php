<header class="h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-6">

    <!-- Left -->
    

      <div class="flex items-center gap-4 w-full max-w-md">

    <form action="{{ route('expenses.index') }}" method="GET" class="flex items-center gap-4 w-full max-w-md">
    
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

        <!-- Notifications -->
        <button class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
            🔔
        </button>

        <!-- Theme Toggle -->
        <button @click="toggle()" class="text-xl">
            <span x-show="dark">🌙</span>
            <span x-show="!dark">☀️</span>
        </button>
       

        <!-- Profile -->
        <button class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
            👤
        </button>

    </div>

</header>