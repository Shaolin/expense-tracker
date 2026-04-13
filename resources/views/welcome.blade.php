@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-[#0b0f1a] text-white">

    <!-- NAVBAR -->
    {{-- <header class="w-full px-6 md:px-12 lg:px-20 py-6 flex justify-between items-center"> --}}
        <header class="fixed top-0 left-0 w-full z-50 px-6 md:px-12 lg:px-20 py-6 flex justify-between items-center bg-[#0b0f1a]/80 backdrop-blur border-b border-white/10">
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
    <section class="text-center px-6 py-20 relative overflow-hidden pt-24">

        <!-- Glow background -->
        <div class="absolute inset-0 flex justify-center items-center">
            <div class="w-[500px] h-[500px] bg-indigo-600 opacity-20 blur-[120px] rounded-full"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto">

            <!-- Badge -->
            <div class="inline-block mb-6 px-4 py-1 text-sm rounded-full bg-white/5 border border-white/10 text-gray-300">
                SawoFlow
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

    <!-- FEATURES -->
    <section id="features" class="px-6 md:px-12 lg:px-20 py-20">
        <div class="max-w-6xl mx-auto text-center">

            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Everything you need to manage money
            </h2>

            <p class="text-gray-400 max-w-2xl mx-auto mb-12">
                Built for individuals and teams — track, analyze, and scale your financial workflow with ease.
            </p>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Feature 1 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 transition hover:border-indigo-500 hover:bg-indigo-500/10">
                    <div class="text-indigo-400 text-2xl mb-4">💰</div>
                    <h3 class="text-xl font-semibold mb-2">Smart Expense Tracking</h3>
                    <p class="text-gray-400 text-sm">
                        Log and categorize expenses in seconds with a clean and intuitive interface.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 transition hover:border-indigo-500 hover:bg-indigo-500/10">
                    <div class="text-indigo-400 text-2xl mb-4">📊</div>
                    <h3 class="text-xl font-semibold mb-2">Powerful Analytics</h3>
                    <p class="text-gray-400 text-sm">
                        Visualize spending patterns and gain insights with detailed reports.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 transition hover:border-indigo-500 hover:bg-indigo-500/10">
                    <div class="text-indigo-400 text-2xl mb-4">🏢</div>
                    <h3 class="text-xl font-semibold mb-2">Multi-Organization</h3>
                    <p class="text-gray-400 text-sm">
                        Manage personal and team finances seamlessly across multiple workspaces.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 transition hover:border-indigo-500 hover:bg-indigo-500/10">
                    <div class="text-indigo-400 text-2xl mb-4">🧾</div>
                    <h3 class="text-xl font-semibold mb-2">Budget Control</h3>
                    <p class="text-gray-400 text-sm">
                        Set limits, track usage, and stay on top of your financial goals.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 transition hover:border-indigo-500 hover:bg-indigo-500/10">
                    <div class="text-indigo-400 text-2xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold mb-2">Fast & Lightweight</h3>
                    <p class="text-gray-400 text-sm">
                        Built for speed so you can focus on decisions, not waiting for pages.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 transition hover:border-indigo-500 hover:bg-indigo-500/10">
                    <div class="text-indigo-400 text-2xl mb-4">🔗</div>
                    <h3 class="text-xl font-semibold mb-2">API Access</h3>
                    <p class="text-gray-400 text-sm">
                        Integrate with other tools and automate workflows with ease.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- DASHBOARD PREVIEW -->
    <section class="px-6 md:px-12 lg:px-20 py-24 relative overflow-hidden">
        <div class="max-w-6xl mx-auto text-center">

            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                See your finances at a glance
            </h2>

            <p class="text-gray-400 max-w-2xl mx-auto mb-12">
                A clean, powerful dashboard that gives you full control over your money.
            </p>

            <!-- Floating Dashboard Mock -->
            <div class="relative flex justify-center">

                <!-- Glow -->
                <div class="absolute w-[600px] h-[600px] bg-indigo-600 opacity-20 blur-[150px] rounded-full"></div>

                <!-- Dashboard Card -->
                <div class="relative w-full max-w-4xl rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur animate-float">

                    <!-- Top Bar -->
                    <div class="flex justify-between items-center mb-6">
                        <div class="text-sm text-gray-400">Dashboard</div>
                        <div class="text-sm text-gray-400">April 2026</div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="p-4 rounded-xl bg-white/5">
                            <p class="text-xs text-gray-400">Balance</p>
                            <h3 class="text-lg font-semibold">₦12,450</h3>
                        </div>
                        <div class="p-4 rounded-xl bg-white/5">
                            <p class="text-xs text-gray-400">Expenses</p>
                            <h3 class="text-lg font-semibold">₦2,340</h3>
                        </div>
                        <div class="p-4 rounded-xl bg-white/5">
                            <p class="text-xs text-gray-400">Budget Left</p>
                            
                            <h3 class="text-lg font-semibold">₦5,110</h3>
                        </div>
                    </div>

                    <!-- Real Chart -->
                    <div class="h-40 rounded-xl bg-white/5 p-4">
                        <canvas id="expenseChart"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('expenseChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [{
                            label: 'Expenses',
                            data: [120, 190, 150, 220, 180, 250],
                            backgroundColor: 'rgba(99, 102, 241, 0.6)',
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#9CA3AF'
                                }
                            },
                            y: {
                                grid: {
                                    color: 'rgba(255,255,255,0.05)'
                                },
                                ticks: {
                                    color: '#9CA3AF'
                                }
                            }
                        }
                    }
                });
            });
        </script>

                </div>
            </div>
        </div>

        <!-- Floating Animation -->
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-8px); }
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
        </style>

    </section>

    <!-- PRICING -->
    <section id="pricing" class="px-6 md:px-12 lg:px-20 py-24">
        <div class="max-w-5xl mx-auto text-center">

            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">
                Simple, transparent pricing
            </h2>

            <p class="text-gray-400 max-w-2xl mx-auto mb-12">
                No hidden fees. No surprises. Everything you need — completely free.
            </p>

            <div class="flex justify-center">

                <!-- Free Plan Card -->
                <div class="w-full max-w-md p-8 rounded-2xl bg-white/5 border border-white/10 transition hover:border-indigo-500 hover:bg-indigo-500/10">

                    <h3 class="text-2xl font-semibold mb-2 text-white">Free Plan</h3>
                    <p class="text-gray-400 mb-6">Perfect for individuals and small teams</p>

                    <div class="text-4xl font-bold mb-6 text-white">
                        ₦0
                        <span class="text-sm text-gray-400">/forever</span>
                    </div>

                    <ul class="text-gray-300 text-sm space-y-3 mb-8">
                        <li>✔ Unlimited expense tracking</li>
                        <li>✔ Budget management</li>
                        <li>✔ Multi-organization support</li>
                        <li>✔ Basic analytics</li>
                        <li>✔ API access</li>
                    </ul>

                    @guest
                        <a href="{{ route('register') }}"
                           class="block w-full text-center bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-3 rounded-lg font-semibold hover:opacity-90">
                            Get Started Free
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}"
                           class="block w-full text-center bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-3 rounded-lg font-semibold hover:opacity-90">
                            Go to Dashboard
                        </a>
                    @endguest

                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-10 border-t border-white/10 bg-[#0b0f1a]">
        <div class="max-w-screen-xl mx-auto px-6 md:px-12 lg:px-20 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} SawoFlow. All rights reserved.
            </div>

            <div class="flex gap-6 text-gray-400 text-sm">
                @guest
                    <a href="{{ route('login') }}" class="hover:text-indigo-400 transition">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-indigo-400 transition">Register</a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-indigo-400 transition">
                            Logout
                        </button>
                    </form>
                @endguest

                <a href="{{ route('about') }}" class="hover:text-indigo-400 transition">About</a>
                <a href="{{ route('contact') }}" class="hover:text-indigo-400 transition">Contact</a>
            </div>
        </div>
    </footer>

</div>
@endsection
