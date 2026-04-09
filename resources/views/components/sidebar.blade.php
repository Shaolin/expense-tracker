<aside 
    :class="sidebarOpen ? 'w-64' : 'w-20'" 
    class="bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 hidden md:flex flex-col transition-all duration-300"
>

    <!-- Logo -->
    <div class="p-6 text-xl font-bold text-gray-900 dark:text-white flex items-center justify-between">
        <span x-show="sidebarOpen" x-transition>ExpenseTracker</span>
        <span x-show="!sidebarOpen">💰</span>
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-2 space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg
            {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <x-icon name="dashboard" />
            <span x-show="sidebarOpen" x-transition>Dashboard</span>
        </a>

        <!-- Expenses -->
        <a href="{{ route('expenses.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg
           {{ request()->routeIs('expenses.*') ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <x-icon name="expenses" />
            <span x-show="sidebarOpen" x-transition>Expenses</span>
        </a>

        <!-- Income -->
        <a href="{{ route('income.index') }}"  
           class="flex items-center gap-3 px-3 py-2 rounded-lg
           {{ request()->routeIs('income.*') ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <x-icon name="income" />
            <span x-show="sidebarOpen" x-transition>Income</span>
        </a>

        <!-- Categories -->
        <a href="{{ route('categories.index') }}"  
           class="flex items-center gap-3 px-3 py-2 rounded-lg
           {{ request()->routeIs('categories.*') ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <x-icon name="categories" />
            <span x-show="sidebarOpen" x-transition>Categories</span>
        </a>

        <!-- Budgets -->
        <a href="{{ route('budgets.index') }}"  
           class="flex items-center gap-3 px-3 py-2 rounded-lg
           {{ request()->routeIs('budgets.*') ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <x-icon name="categories" />
            <span x-show="sidebarOpen" x-transition>Budgets</span>
        </a>

        <!-- Settings -->
        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg
            {{ request()->routeIs('settings.*') ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <x-icon name="budgets" />
            <span x-show="sidebarOpen" x-transition>Settings</span>
        </a>
       <!-- Create Organization -->
<a href="{{ route('organizations.create') }}" 
class="flex items-center gap-3 px-3 py-2 rounded-lg
       {{ request()->routeIs('organizations.create') ? 
          'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 
          'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
 <x-icon name="building" /> <!-- Replace with appropriate icon -->
 <span x-show="sidebarOpen" x-transition>Create Organization</span>
</a>

{{-- Personal/Organisation switch --}}

<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg w-full
                   bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white">
        {{ auth()->user()->organizations()
            ->where('organizations.id', session('organization_id', auth()->user()->organizations()->first()->id))
            ->first()->name }}
        <x-icon name="chevron-down" />
    </button>

    <div x-show="open" @click.outside="open = false"
         class="absolute mt-1 w-full bg-white dark:bg-gray-900 rounded-lg shadow-lg z-50">
        @foreach(auth()->user()->organizations as $org)
            <form action="{{ route('organizations.switch') }}" method="POST">
                @csrf
                <input type="hidden" name="organization_id" value="{{ $org->id }}">
                <button type="submit"
                        class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800
                               {{ session('organization_id') == $org->id ? 'font-semibold' : '' }}">
                    {{ $org->name }}
                    @if($org->is_personal) (Personal) @endif
                </button>
            </form>
        @endforeach
    </div>
</div>
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