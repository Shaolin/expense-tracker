@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <!-- HEADER -->
    <header class="w-full px-6 md:px-12 lg:px-20 py-6 flex justify-between items-center">
        <div class="text-xl font-bold">ExpenseTracker</div>

        <div class="flex items-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-indigo-600">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Register</a>
            @endauth
        </div>
    </header>

    <!-- HERO -->
    <section class="w-full bg-gradient-to-br from-white to-gray-100 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-screen-xl mx-auto px-6 md:px-12 lg:px-20 py-24 grid md:grid-cols-2 gap-12 items-center">

            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
                 x-transition.opacity.duration.700ms x-show="show">

                <h1 class="text-5xl font-bold leading-tight mb-6">
                    Smarter Way to
                    <span class="text-indigo-600">Manage Money</span>
                </h1>

                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                    Track expenses, manage budgets, and gain powerful insights into your financial life — effortlessly.
                </p>

                <div class="flex gap-4">
                    @guest
                        <a href="{{ route('register') }}"
                           class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-medium shadow hover:bg-indigo-700 transition">
                            Get Started Free
                        </a>
                        <a href="{{ route('login') }}"
                           class="px-6 py-3 rounded-xl border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            Login
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}"
                           class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-medium shadow hover:bg-indigo-700 transition">
                            Go to Dashboard
                        </a>
                    @endguest
                </div>

                <!-- STATS -->
                <div class="mt-10 grid grid-cols-3 gap-6 text-center">
                    <div>
                        <div class="text-2xl font-bold">10K+</div>
                        <div class="text-sm text-gray-500">Users</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold">₦50M+</div>
                        <div class="text-sm text-gray-500">Tracked</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold">99.9%</div>
                        <div class="text-sm text-gray-500">Uptime</div>
                    </div>
                </div>
            </div>

            <!-- MOCK DASHBOARD -->
            <div class="relative">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition duration-300">

                    <div class="flex justify-between mb-4">
                        <div class="text-sm text-gray-500">Balance</div>
                        <div class="text-green-500 font-semibold">+12.5%</div>
                    </div>

                    <div class="text-2xl font-bold mb-6">₦245,000</div>

                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span>Food</span>
                            <span>₦45,000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Transport</span>
                            <span>₦20,000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Shopping</span>
                            <span>₦30,000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-screen-xl mx-auto px-6 md:px-12 lg:px-20 text-center">
            <h2 class="text-3xl font-bold mb-12">Everything You Need</h2>

            <div class="grid md:grid-cols-3 gap-10">
                <div class="p-8 rounded-2xl shadow hover:shadow-xl transition bg-gray-50 dark:bg-gray-900">
                    <div class="text-3xl mb-4">💰</div>
                    <h3 class="font-semibold text-xl mb-2">Track Everything</h3>
                    <p class="text-gray-600 dark:text-gray-400">All your income and expenses in one place.</p>
                </div>

                <div class="p-8 rounded-2xl shadow hover:shadow-xl transition bg-gray-50 dark:bg-gray-900">
                    <div class="text-3xl mb-4">📊</div>
                    <h3 class="font-semibold text-xl mb-2">Smart Budgets</h3>
                    <p class="text-gray-600 dark:text-gray-400">Control spending with real-time tracking.</p>
                </div>

                <div class="p-8 rounded-2xl shadow hover:shadow-xl transition bg-gray-50 dark:bg-gray-900">
                    <div class="text-3xl mb-4">📈</div>
                    <h3 class="font-semibold text-xl mb-2">Deep Insights</h3>
                    <p class="text-gray-600 dark:text-gray-400">Understand your money like never before.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 bg-indigo-600 text-white text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="text-4xl font-bold mb-4">Ready to take control?</h2>
            <p class="mb-8 text-indigo-100">Join thousands managing their finances smarter.</p>

            @guest
                <a href="{{ route('register') }}"
                   class="px-8 py-4 bg-white text-indigo-600 font-semibold rounded-xl shadow hover:bg-gray-100 transition">
                    Get Started Free
                </a>
            @else
                <a href="{{ url('/dashboard') }}"
                   class="px-8 py-4 bg-white text-indigo-600 font-semibold rounded-xl shadow hover:bg-gray-100 transition">
                    Go to Dashboard
                </a>
            @endguest
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-10 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-screen-xl mx-auto px-6 md:px-12 lg:px-20 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-gray-600 dark:text-gray-400">
                &copy; {{ date('Y') }} Expense Tracker. All rights reserved.
            </div>

            <div class="flex gap-6 text-gray-600 dark:text-gray-400">
                @guest
                    <a href="{{ route('login') }}" class="hover:text-indigo-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-indigo-600 transition">Register</a>
                @else
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-indigo-600 transition">
                            Logout
                        </button>
                    </form>
                @endguest
            
                <a href="#" class="hover:text-indigo-600 transition">About</a>
            </div>
           
        </div>
    </footer>

</div>
@endsection