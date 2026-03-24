<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs"></script>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body 

x-data="{ dark: true, sidebarOpen: true }" 
x-init="
  const saved = localStorage.getItem('theme');
  dark = saved !== 'light';
"
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

<script>
function themeStore() {
    return {
        dark: true,

        init() {
            const saved = localStorage.getItem('theme')
            this.dark = saved !== 'light'
        },

        toggle() {
            this.dark = !this.dark
            localStorage.setItem('theme', this.dark ? 'dark' : 'light')
        }
    }
}

</script>
@stack('scripts')

</body>
</html>