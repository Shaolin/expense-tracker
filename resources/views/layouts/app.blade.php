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

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main -->
    <div class="flex-1 flex flex-col">

        <!-- Navbar -->
        <x-navbar />

        <!-- Page Content -->
        <main class="p-6 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</div>

@stack('scripts')

</body>
</html>