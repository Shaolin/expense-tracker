<div class="overflow-x-auto bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm">
    <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
        
        <!-- Head -->
        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-800 text-gray-500">
            {{ $head }}
        </thead>

        <!-- Body -->
        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
            {{ $body }}
        </tbody>

    </table>
</div>

<div class="flex items-center justify-between mt-6">

    <!-- Info -->
    <p class="text-sm text-gray-500">
        Showing 1 to 10 of 50 results
    </p>

    <!-- Pagination -->
    <div class="flex items-center gap-1">

        <!-- Previous -->
        <button class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
            Prev
        </button>

        <!-- Page Numbers -->
        <button class="px-3 py-1.5 text-sm rounded-lg bg-green-600 text-white">
            1
        </button>

        <button class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
            2
        </button>

        <button class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
            3
        </button>

        <!-- Next -->
        <button class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
            Next
        </button>

    </div>
</div>