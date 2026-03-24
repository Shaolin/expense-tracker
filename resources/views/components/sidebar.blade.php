<aside 
    :class="sidebarOpen ? 'w-64' : 'w-20'" 
    class="bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 hidden md:flex flex-col transition-all duration-300"
>

    <!-- Logo -->
    <div class="p-6 text-xl font-bold text-gray-900 dark:text-white flex items-center justify-between">
        {{-- <span x-show="sidebarOpen">ExpenseTracker</span> --}}
        
        <span x-show="sidebarOpen" x-transition>ExpenseTracker</span>
        <span x-show="!sidebarOpen">💰</span>
       
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-2 space-y-2">

        <!-- Item -->
        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white">
            {{-- <span>🏠</span> --}}
            <x-icon name="dashboard" />
            
            <span x-show="sidebarOpen" x-transition>Dashboard</span>
        </a>

        
        <a href="{{ route('expenses.index') }}" 
   class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
     {{-- <span>💸</span> --}}
    <x-icon name="expenses" />
    <span x-show="sidebarOpen" x-transition>Expenses</span>
</a>

        <a href="{{ route('income.index') }}"  class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
            {{-- <span>💰</span> --}}
            <x-icon name="income" />
            <span x-show="sidebarOpen" x-transition>Income</span>
        </a>

        <a href="{{ route('categories.index') }}"  class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
            {{-- <span>📂</span> --}}
            <x-icon name="categories" />
            <span x-show="sidebarOpen" x-transition>Categories</span>
        </a>

        <a href="{{ route('budget.index') }}"  class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
            {{-- <span>📊</span> --}}
            <x-icon name="categories" />
            <span x-show="sidebarOpen" x-transition>Budgets</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
            {{-- <span>⚙️</span> --}}
            <x-icon name="budgets" />
            <span x-show="sidebarOpen" x-transition>Settings</span>
        </a>

    </nav>

    <!-- Collapse Button -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-800">
        <button 
            @click="sidebarOpen = !sidebarOpen"
            class="w-full flex items-center justify-center text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white"
        >
            <span x-show="sidebarOpen">Collapse</span>
            <span x-show="!sidebarOpen">➡️</span>
        </button>
    </div>

</aside>