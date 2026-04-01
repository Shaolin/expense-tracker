@props([
    'category',
    'type' => 'expense',           // 'expense' or 'income'
    'numTransactions' => 0,        // number of transactions
    'totalAmount' => 0,            // total spent or total income
    'percent' => 0,                // budget percentage (only for expense)
    'budget' => 0,                  // budget amount (only for expense)
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

<div class="bg-gray-900 rounded-2xl shadow p-4 flex flex-col justify-between hover:scale-[1.02] transition-all duration-300 relative"
     style="border-left: 4px solid rgba({{ $rgb }}, 1); aspect-[4/3]">

    <!-- Type Label -->
    <span class="absolute top-2 left-2 text-xs font-semibold px-2 py-1 rounded-full
        {{ $type === 'expense' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
        {{ ucfirst($type) }}
    </span>

    <!-- Category Header -->
    <div class="mt-6 flex justify-between items-start">
        <h2 class="text-white font-semibold text-lg">{{ $category->name }}</h2>
        <div class="flex gap-2">
            <a href="{{ route('categories.edit', $category) }}">✏️</a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-400 hover:text-red-600">🗑️</button>
            </form>
        </div>
    </div>

    <!-- Description -->
    <p class="text-gray-400 text-sm mt-1">{{ $category->description }}</p>

    <!-- Stats -->
    <div class="flex justify-between items-center mt-4 text-sm">
        <span class="text-gray-400">
            {{ $numTransactions }} {{ Str::plural($type, $numTransactions) }}
        </span>
        <span class="text-white font-semibold">₦{{ number_format($totalAmount, 2) }}</span>
    </div>

    <!-- Budget (only for expenses) -->
    @if($type === 'expense')
        <div class="mt-3">
            <div class="flex justify-between text-xs text-gray-400 mb-1">
                <span>Budget</span>
                <span>{{ round($percent) }}% of ₦{{ number_format($budget, 2) }}</span>
            </div>

            <div class="w-full bg-gray-800 rounded-full h-2">
                <div class="h-2 rounded-full" style="width: {{ $percent }}%; background-color: rgba({{ $rgb }}, 1)"></div>
            </div>
        </div>
    @endif
</div>