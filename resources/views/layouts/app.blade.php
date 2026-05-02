<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SawoFlow | An Expense Tracker</title>

    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs"></script>

    <!-- Apply dark mode BEFORE page renders -->
    <script>
        (function () {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>

<body


    x-data="{
        dark: localStorage.getItem('theme') === 'dark',
        sidebarOpen: true,

        init() {
            if (this.dark) {
                document.documentElement.classList.add('dark');
            }
        },

        toggle() {
            this.dark = !this.dark;

            if (this.dark) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        }
    }"
    x-init="init()"
    :class="{ 'dark': dark }"
    class="bg-white text-gray-900 dark:bg-gray-950 dark:text-gray-200">

    <div class="h-screen flex" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">

        <!-- Desktop Sidebar -->
        <div class="hidden md:flex">
            <x-sidebar />
        </div>
    
        <!-- Mobile Sidebar -->
        <div
            x-show="sidebarOpen"
            class="md:hidden fixed inset-0 z-50"
        >
            <div @click="sidebarOpen = false" class="absolute inset-0 bg-black/50"></div>
    
            <div class="absolute left-0 top-0 h-full w-64 bg-white dark:bg-gray-900">
                <x-sidebar-mobile />
            </div>
        </div>
    
        <!-- Main -->
        <div class="flex-1 flex flex-col w-full">
    
            <!-- Navbar -->
            <x-navbar />
    
            <!-- Content -->
            <main class="p-6 overflow-y-auto">
                @yield('content')
            </main>
    
        </div>
    
    </div>
    
    {{-- </div> --}}

@stack('scripts')

</body>
</html>
