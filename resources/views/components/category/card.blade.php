@props([
    'category',
    'type' => 'expense',           // 'expense' or 'income'
    'numTransactions' => 0,        // number of transactions
    'totalAmount' => 0,            // total spent or total income
    'percent' => 0,                // budget percentage (only for expense)
    'budget' => 0,                 // budget amount (only for expense)
])

@php
$colors = [
    'green' => ['rgb' => '34,197,94'],
    'blue' => ['rgb' => '59,130,246'],
    'yellow' => ['rgb' => '234,179,8'],
    'purple' => ['rgb' => '168,85,247'],
    'pink' => ['rgb' => '236,72,153'],
    'cyan' => ['rgb' => '6,182,212'],
    'red' => ['rgb' => '239,68,68'],
];

$rgb = $colors[$category->color]['rgb'] ?? '34,197,94';
@endphp

<div 
    class="bg-white dark:bg-gray-900 rounded-2xl shadow-md border border-gray-100 dark:border-gray-800 p-4 flex flex-col justify-between hover:scale-[1.02] transition-all duration-300 relative cursor-pointer"
    style="border-left: 4px solid rgba({{ $rgb }}, 1); aspect-[4/3]; transition: box-shadow 0.3s ease, transform 0.3s ease;"
    onmouseover="this.style.boxShadow='0 10px 25px -5px rgba({{ $rgb }}, 0.3)'"
    onmouseout="this.style.boxShadow=''"
>

    <!-- Type Label -->
    <span class="absolute top-2 left-2 text-[10px] uppercase tracking-wider font-bold px-2 py-0.5 rounded-full
        {{ $type === 'expense' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
        {{ $type }}
    </span>

    <!-- Category Header -->
    <div class="mt-6 flex justify-between items-start">
        <div class="flex items-center gap-2">
            <span 
                class="w-2.5 h-2.5 rounded-full"
                style="background-color: rgba({{ $rgb }}, 1);">
            </span>
        
            <h2 class="text-gray-900 dark:text-white font-semibold text-lg">
                {{ $category->name }}
            </h2>
        </div>
        <div class="flex gap-2 opacity-70 hover:opacity-100 transition-opacity">
            <a href="{{ route('categories.edit', $category) }}" class="text-sm">✏️</a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-400 hover:text-red-600 text-sm">🗑️</button>
            </form>
        </div>
    </div>

    <!-- Description -->
    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1 line-clamp-2">
        {{ $category->description }}
    </p>

    <!-- Stats -->
    <div class="flex justify-between items-center mt-4 text-sm">
        <span class="text-gray-500 dark:text-gray-400">
            {{ $numTransactions }} {{ Str::plural($type, $numTransactions) }}
        </span>
        <span class="text-gray-900 dark:text-white font-bold text-base">
            {{ money($totalAmount, 2) }}
        </span>
    </div>

    <!-- Budget (only for expenses) -->
    @if($type === 'expense')
        <div class="mt-3">
            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-500 mb-1">
                <span>Budget</span>
                <span>{{ round($percent) }}% of {{ money($budget, 2) }}</span>
            </div>

            <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-1.5">
                <div class="h-1.5 rounded-full transition-all duration-500" 
                     style="width: {{ min($percent, 100) }}%; background-color: rgba({{ $rgb }}, 1)">
                </div>
            </div>
        </div>
    @endif
</div>