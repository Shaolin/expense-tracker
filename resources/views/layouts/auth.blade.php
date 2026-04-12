<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Expense Tracker') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50 dark:bg-gray-900">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        {{-- <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div> --}}
        {{-- <div class="flex items-center">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold tracking-tight">
                <span class="text-indigo-600">Sawo</span><span class="text-gray-900 dark:text-white">Flow</span>
            </a>
        </div> --}}
        <div class="flex items-center">
            <a href="{{ route('welcome') }}" class="text-2xl font-extrabold tracking-tight flex items-center gap-1">
                <span class="text-indigo-600">Sawo</span>
                <span class="text-gray-900 dark:text-white">Flow</span>
                <span class="w-2 h-2 bg-indigo-600 rounded-full ml-1"></span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @yield('content')
        </div>
    </div>

</body>
</html>