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

$accentColor = $colorMap[$color]['bg'] ?? 'bg-blue-500';
$accentRGB = $colorMap[$color]['rgb'] ?? '59,130,246';
@endphp

<div 
    class="flex bg-white dark:bg-gray-900 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800 shadow-md transition-all duration-300 hover:scale-[1.02] cursor-pointer min-h-[150px]"
    style="transition: box-shadow 0.3s ease;"
    onmouseover="this.style.boxShadow='0 0 25px rgba({{ $accentRGB }},0.45)'"
    onmouseout="this.style.boxShadow=''"
    @php

>
    <!-- Accent bar -->
    <div class="{{ $accentColor }} w-1"></div>

    <!-- Content -->
    <div class="flex-1 px-5 py-6 flex flex-col justify-between">
        <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">
                {{ $title }}
            </p>

            <h2 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                {{ $amount }}
            </h2>
        </div>

        @if($change)
            <p class="text-sm mt-4 {{ $positive ? 'text-green-500' : 'text-red-500' }}">
                {{ $change }}
            </p>
        @endif
    </div>

    <!-- Icon -->
    <div class="p-6 flex items-start">
        <x-icon :name="$icon" />
    </div>
    
</div>