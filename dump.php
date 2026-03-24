@props([
    'name' => 'Category',
    'description' => '',
    'color' => 'green',
    'expenses' => 0,
    'amount' => '$0',
    'percent' => 0,
    'budget' => '$0'
])

@php
    $colors = [
        'green' => 'bg-green-500',
        'blue' => 'bg-blue-500',
        'yellow' => 'bg-yellow-500',
        'purple' => 'bg-purple-500',
        'pink' => 'bg-pink-500',
        'cyan' => 'bg-cyan-500',
        'red' => 'bg-red-500'
    ];

    $colorClass = $colors[$color] ?? 'bg-green-500';
@endphp



    <!-- Accent -->
    <div class="flex bg-gray-900 rounded-2xl overflow-hidden border border-gray-800 shadow">

        <!-- Colored Left Side -->
        <div class="w-2 {{ $colorClass }}"></div>
    
        <!-- Card Content -->
        <div class="flex-1 p-5">
    
            <!-- Header -->
            <div class="flex justify-between items-start">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full {{ $colorClass }}"></span>
                    <h2 class="text-white font-semibold">{{ $name }}</h2>
                </div>
    
                <div class="flex gap-2">
                    <button class="text-gray-400 hover:text-white">✏️</button>
                    <button class="text-red-500 hover:text-red-600">🗑️</button>
                </div>
            </div>
    
            <!-- Description -->
            <p class="text-gray-400 text-sm mt-2">
                {{ $description }}
            </p>
    
            <!-- Stats -->
            <div class="flex justify-between items-center mt-4 text-sm">
                <span class="text-gray-400">{{ $expenses }} expenses</span>
                <span class="text-white font-semibold">{{ $amount }}</span>
            </div>
    
            <!-- Budget -->
            <div class="mt-3">
                <div class="flex justify-between text-xs text-gray-400 mb-1">
                    <span>Budget</span>
                    <span>{{ $percent }}% of {{ $budget }}</span>
                </div>
    
                <div class="w-full bg-gray-800 rounded-full h-2">
                    <div class="{{ $colorClass }} h-2 rounded-full" style="width: {{ $percent }}%"></div>
                </div>
            </div>
    
        </div>
    </div>

   

<!-- dashboard card -->

@props([
    'title', 
    'amount', 
    'change' => null, 
    'positive' => true,
    'color' => 'blue',
    'icon'
])

@php
$colorMap = [
    'green' => 'bg-green-500',
    'red' => 'bg-red-500',
    'blue' => 'bg-blue-500',
    'purple' => 'bg-purple-500',
];
$iconBgMap = [
    'green' => 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-400',
    'red' => 'bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-400',
    'blue' => 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-400',
    'purple' => 'bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-400',
];
$accentColor = $colorMap[$color] ?? 'bg-blue-500';
$iconBgColor = $iconBgMap[$color] ?? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-400';
@endphp

<div class="bg-white dark:bg-gray-900 p-5 rounded-xl border border-gray-200 dark:border-gray-800 flex justify-between items-center shadow-md hover:shadow-lg transition">

    <!-- Left accent bar -->
    <div class="{{ $accentColor }} w-1 h-full rounded-l-xl"></div>

    <!-- Text content -->
    <div class="flex-1 ml-4">
        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $title }}</p>
        <h2 class="text-2xl font-bold mt-1 text-gray-900 dark:text-white">{{ $amount }}</h2>
        @if($change)
            <p class="text-sm mt-1 {{ $positive ? 'text-green-500' : 'text-red-500' }}">
                {{ $change }}
            </p>
        @endif
    </div>

    <!-- Icon -->
    <div class="p-3 rounded-lg {{ $iconBgColor }}">
        <x-icon :name="$icon" />
    </div>

</div>

