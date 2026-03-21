@props(['title', 'amount', 'change', 'positive' => true])

<div class="bg-white dark:bg-gray-900 p-5 rounded-xl border border-gray-200 dark:border-gray-800">
    
    <!-- Title -->
    <p class="text-gray-500 dark:text-gray-400 text-sm">
        {{ $title }}
    </p>

    <!-- Amount -->
    <h2 class="text-2xl font-bold mt-2 text-gray-900 dark:text-white">
        {{ $amount }}
    </h2>

    <!-- Change -->
    <p class="text-sm mt-1 {{ $positive ? 'text-green-500' : 'text-red-500' }}">
        {{ $change }}
    </p>

</div>