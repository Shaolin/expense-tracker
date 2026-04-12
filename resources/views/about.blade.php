@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <!-- HEADER -->
    <header class="w-full px-6 md:px-12 lg:px-20 py-6 flex justify-between items-center">
        <div class="text-xl font-bold">SawoFlow</div>

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
        <div class="max-w-screen-xl mx-auto px-6 md:px-12 lg:px-20 py-20 text-center">

            <h1 class="text-5xl font-bold mb-6">
                About <span class="text-indigo-600">SawoFlow</span>
            </h1>

            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                SawoFlow is an innovation of <span class="font-semibold text-gray-900 dark:text-white">Sawo System Software</span>,
                built to help individuals and businesses take full control of their finances with ease and clarity.
            </p>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-4xl mx-auto px-6 md:px-12 lg:px-20 text-center">

            <p class="text-gray-600 dark:text-gray-300 mb-6 text-lg">
                Managing money shouldn’t be complicated. Expense Tracker is designed to simplify the way you track your income,
                monitor expenses, and understand your financial habits — all in one place.
            </p>

            <p class="text-gray-600 dark:text-gray-300 mb-6 text-lg">
                Whether you're managing personal finances or running a business, the platform provides you with the tools
                you need to stay organized, make better decisions, and gain meaningful insights into your spending.
            </p>

            <p class="text-gray-600 dark:text-gray-300 text-lg">
                With support for multiple currencies and a clean, user-friendly interface, Expense Tracker adapts to your needs
                no matter where you are.
            </p>

        </div>
    </section>

    <!-- OTHER APPS -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-screen-xl mx-auto px-6 md:px-12 lg:px-20 text-center">

            <h2 class="text-3xl font-bold mb-6">Other Applications by Sawo System Software</h2>

            <p class="text-gray-600 dark:text-gray-400 mb-12">
                Beyond Expense Tracker, we are building a growing ecosystem of tools designed to solve real-world problems.
            </p>

            <div class="grid md:grid-cols-2 gap-10">

                <!-- School App -->
                <div class="p-8 rounded-2xl shadow hover:shadow-xl transition bg-white dark:bg-gray-800">
                    <div class="text-3xl mb-4">🏫</div>
                    <h3 class="font-semibold text-xl mb-2">School Management System</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        A complete solution for managing student records, results, and school operations.
                    </p>
                    <a href="https://edusmart.com.ng/" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="text-indigo-600 hover:underline">
                     Visit App →
                 </a>
                      
                </div>

                <!-- Law Firm CRM -->
                <div class="p-8 rounded-2xl shadow hover:shadow-xl transition bg-white dark:bg-gray-800">
                    <div class="text-3xl mb-4">⚖️</div>
                    <h3 class="font-semibold text-xl mb-2">Law Firm CRM</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        A professional system for managing legal cases, clients, and workflows.
                    </p>
                    <a href="https://lawofficepro.com.ng/" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="text-indigo-600 hover:underline">
                     Visit App →
                 </a>
                        
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-10 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-screen-xl mx-auto px-6 md:px-12 lg:px-20 flex flex-col md:flex-row justify-between items-center gap-4">

            <div class="text-gray-600 dark:text-gray-400">
                &copy; {{ date('Y') }} SawoFlow. All rights reserved.
            </div>

            <div class="flex gap-6 text-gray-600 dark:text-gray-400">

                <a href="{{ route('welcome') }}" class="hover:text-indigo-600 transition">Home</a>
                <a href="{{ route('about') }}" class="hover:text-indigo-600 transition">About</a>
                <a href="{{ route('contact') }}" class="hover:text-indigo-600 transition">Contact</a>
                @guest
                    <a href="{{ route('login') }}" class="hover:text-indigo-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-indigo-600 transition">Register</a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-indigo-600 transition">
                            Logout
                        </button>
                    </form>
                @endguest

               
            </div>

        </div>
    </footer>

</div>
@endsection