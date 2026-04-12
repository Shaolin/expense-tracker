@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-[#0b0f1a] text-white">

    <!-- NAVBAR -->
    <header class="w-full px-6 md:px-12 lg:px-20 py-6 flex justify-between items-center">
        <div class="text-xl font-bold text-indigo-400">SawoFlow</div>

        <div class="flex items-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Login</a>
                <a href="{{ route('register') }}"
                   class="bg-gradient-to-r from-indigo-500 to-purple-500 px-5 py-2 rounded-lg font-medium hover:opacity-90">
                    Get Started
                </a>
            @endauth
        </div>
    </header>

    <!-- HERO -->
    <section class="text-center px-6 py-20 relative overflow-hidden">

        <!-- Glow background -->
        <div class="absolute inset-0 flex justify-center items-center">
            <div class="w-[500px] h-[500px] bg-indigo-600 opacity-20 blur-[120px] rounded-full"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto">

            <!-- Badge -->
            <div class="inline-block mb-6 px-4 py-1 text-sm rounded-full bg-white/5 border border-white/10 text-gray-300">
                SAWOFLOW
            </div>

            <!-- Heading -->
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                Expense tracking
                <span class="bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">
                    that just works
                </span>
            </h1>

            <!-- Subtext -->
            <p class="mt-6 text-gray-400 text-lg max-w-2xl mx-auto">
                Track expenses, manage budgets, and gain powerful insights into your financial life — effortlessly.
            </p>

            <!-- CTA Buttons -->
            <div class="mt-10 flex flex-col md:flex-row items-center justify-center gap-4">
                @guest
                    <a href="{{ route('register') }}"
                       class="bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-3 rounded-lg font-semibold hover:opacity-90">
                        Start for Free →
                    </a>

                    <a href="{{ route('login') }}"
                       class="bg-white/5 border border-white/10 px-6 py-3 rounded-lg text-gray-300 hover:bg-white/10">
                        Login
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}"
                       class="bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-3 rounded-lg font-semibold hover:opacity-90">
                        Go to Dashboard
                    </a>
                @endguest
            </div>

        </div>
    </section>

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
                &copy; {{ date('Y') }} SawoFlow. All rights reserved.
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
            
                {{-- <a href="about.blade" class="hover:text-indigo-600 transition">About</a> --}}
                <a href="{{ route('about') }}" class="hover:text-indigo-600 transition">About</a>
                <a href="{{ route('contact') }}" class="hover:text-indigo-600 transition">Contact</a>
            </div>
           
        </div>
    </footer>

</div>
@endsection