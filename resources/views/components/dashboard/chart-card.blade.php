@props(['data' => []])

@php
$colorMap = [
    'green' => 'bg-green-500',
    'red' => 'bg-red-500',
    'blue' => 'bg-blue-500',
    'yellow' => 'bg-yellow-500',
    'purple' => 'bg-purple-500',
];
@endphp

<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-2xl p-6 shadow-md transition-all duration-300">
    
    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
        Expenses by Category
    </h3>

    <div class="flex flex-col lg:flex-row items-center justify-center gap-6">
        
        <!-- Chart -->
        <div class="flex justify-center w-full lg:w-auto">
            <div class="w-72 h-72">
                <canvas id="expenseChart"></canvas>
            </div>
        </div>

        <!-- Legend -->
        <div class="space-y-3 text-sm">
            @foreach($data as $item)
                @php
                    $colorClass = $colorMap[$item['color']] ?? 'bg-blue-500';
                @endphp

                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 {{ $colorClass }} rounded-full"></span>
                    
                    <span class="text-gray-700 dark:text-gray-300">
                        {{ $item['name'] }}
                    </span>
                </div>
            @endforeach
        </div>

    </div>
</div>