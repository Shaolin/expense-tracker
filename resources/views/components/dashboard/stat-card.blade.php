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
    'green' => ['bg' => 'bg-green-500', 'rgb' => '34,197,94'],
    'red' => ['bg' => 'bg-red-500', 'rgb' => '239,68,68'],
    'blue' => ['bg' => 'bg-blue-500', 'rgb' => '59,130,246'],
    'purple' => ['bg' => 'bg-purple-500', 'rgb' => '168,85,247'],
];

$iconBgMap = [
    'green' => 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-400',
    'red' => 'bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-400',
    'blue' => 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-400',
    'purple' => 'bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-400',
];

$accentColor = $colorMap[$color]['bg'] ?? 'bg-blue-500';
$accentRGB = $colorMap[$color]['rgb'] ?? '59,130,246';
// $iconBgColor = $iconBgMap[$color] ?? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-400';
@endphp

<div 
    class="flex bg-white dark:bg-gray-900 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800 shadow-md transition-all duration-300 hover:scale-[1.02] cursor-pointer"
    style="transition: box-shadow 0.3s ease;"
    onmouseover="this.style.boxShadow='0 0 25px rgba({{ $accentRGB }},0.45)'"
    onmouseout="this.style.boxShadow=''"
>
    <!-- Left accent bar (thicker) -->
    <div class="{{ $accentColor }} w-1 h-full"></div>

    <!-- Content -->
    <div class="flex-1 ml-4 py-3">
        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $title }}</p>
        <h2 class="text-2xl font-bold mt-1 text-gray-900 dark:text-white">{{ $amount }}</h2>
        @if($change)
            <p class="text-sm mt-1 {{ $positive ? 'text-green-500' : 'text-red-500' }}">
                {{ $change }}
            </p>
        @endif
    </div>

    <!-- Icon -->
    <div class="p-8 rounded-lg">
        <x-icon :name="$icon" />
    </div>
</div>

