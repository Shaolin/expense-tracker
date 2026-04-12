@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <!-- HEADER -->
    <header class="w-full px-6 md:px-12 lg:px-20 py-6 flex justify-between items-center">
        <div class="text-xl font-bold">YSawoFlow</div>

        <div class="flex items-center gap-4">
            <a href="{{ route('welcome') }}" class="hover:text-indigo-600 transition">Home</a>

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
                Contact <span class="text-indigo-600">Us</span>
            </h1>

            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                We'd love to hear from you. Reach out through any of the platforms below.
            </p>
        </div>
    </section>

    <!-- CONTACT LINKS -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-4xl mx-auto px-6 md:px-12 lg:px-20">

            <div class="grid md:grid-cols-2 gap-8">

                <!-- EMAIL -->
                <div class="p-6 rounded-2xl shadow hover:shadow-lg transition bg-gray-50 dark:bg-gray-900">
                    <div class="text-3xl mb-4">📧</div>
                    <h3 class="text-xl font-semibold mb-2">Email</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-3">
                        Send us an email anytime.
                    </p>
                    <a href="mailto:your@email.com" class="text-indigo-600 hover:underline">
                        your@email.com
                    </a>
                </div>

                <!-- WHATSAPP -->
                <div class="p-6 rounded-2xl shadow hover:shadow-lg transition bg-gray-50 dark:bg-gray-900">
                    <div class="text-3xl mb-4">💬</div>
                    <h3 class="text-xl font-semibold mb-2">WhatsApp</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-3">
                        Chat with us directly.
                    </p>
                    <a href="https://wa.me/2347030920009" target="_blank" rel="noopener noreferrer"
                       class="text-indigo-600 hover:underline">
                        Message us on WhatsApp
                    </a>
                </div>

                <!-- FACEBOOK -->
                <div class="p-6 rounded-2xl shadow hover:shadow-lg transition bg-gray-50 dark:bg-gray-900">
                    <div class="text-3xl mb-4">📘</div>
                    <h3 class="text-xl font-semibold mb-2">Facebook</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-3">
                        Follow and connect with us.
                    </p>
                    <a href="https://facebook.com/yourpage" target="_blank" rel="noopener noreferrer"
                       class="text-indigo-600 hover:underline">
                        Visit Facebook Page
                    </a>
                </div>

                <!-- INSTAGRAM -->
                <div class="p-6 rounded-2xl shadow hover:shadow-lg transition bg-gray-50 dark:bg-gray-900">
                    <div class="text-3xl mb-4">📸</div>
                    <h3 class="text-xl font-semibold mb-2">Instagram</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-3">
                        See updates and visuals.
                    </p>
                    <a href="https://instagram.com/yourhandle" target="_blank" rel="noopener noreferrer"
                       class="text-indigo-600 hover:underline">
                        Follow us on Instagram
                    </a>
                </div>

                <!-- TWITTER -->
                <div class="p-6 rounded-2xl shadow hover:shadow-lg transition bg-gray-50 dark:bg-gray-900 md:col-span-2">
                    <div class="text-3xl mb-4">🐦</div>
                    <h3 class="text-xl font-semibold mb-2">Twitter (X)</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-3">
                        Stay updated with our latest news.
                    </p>
                    <a href="https://twitter.com/yourhandle" target="_blank" rel="noopener noreferrer"
                       class="text-indigo-600 hover:underline">
                        Follow us on Twitter
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
            </div>

        </div>
    </footer>

</div>
@endsection