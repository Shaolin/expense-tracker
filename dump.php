@props([
    'category',
    'type' => 'expense',
    'numTransactions' => 0,
    'totalAmount' => 0,
    'percent' => 0,
    'budget' => 0,
])

@php
$colors = [
    'green' => ['border' => 'border-green-500', 'rgb' => '34,197,94'],
    'blue' => ['border' => 'border-blue-500', 'rgb' => '59,130,246'],
    'yellow' => ['border' => 'border-yellow-500', 'rgb' => '234,179,8'],
    'purple' => ['border' => 'border-purple-500', 'rgb' => '168,85,247'],
    'pink' => ['border' => 'border-pink-500', 'rgb' => '236,72,153'],
    'cyan' => ['border' => 'border-cyan-500', 'rgb' => '6,182,212'],
    'red' => ['border' => 'border-red-500', 'rgb' => '239,68,68'],
];

$borderColor = $colors[$category->color]['border'] ?? 'border-green-500';
$rgb = $colors[$category->color]['rgb'] ?? '34,197,94';
@endphp

<div class="bg-gray-900 rounded-2xl shadow p-4 flex flex-col justify-between hover:scale-[1.02] transition-all duration-300 relative"
     style="border-left-width: 4px; border-left-color: {{ $rgb }}; aspect-[4/3]">

    <!-- Type Label -->
    <span class="absolute top-2 left-2 text-xs font-semibold px-2 py-1 rounded-full
        {{ $type === 'expense' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
        {{ ucfirst($type) }}
    </span>

    <!-- Header -->
    <div class="flex justify-between items-start mt-5">
        <div>
            <h3 class="text-white font-semibold text-sm">{{ $category->name }}</h3>
            <p class="text-gray-400 text-xs mt-1">{{ $category->description }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('categories.edit', $category) }}" class="text-gray-400 hover:text-white text-sm">✏️</a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-400 hover:text-red-600 text-sm">🗑️</button>
            </form>
        </div>
    </div>

    <!-- Stats -->
    <div class="mt-4 text-sm">
        <div class="flex justify-between items-center">
            <span class="text-gray-400">{{ $numTransactions }} {{ Str::plural($type, $numTransactions) }}</span>
            <span class="text-white font-semibold">₦{{ number_format($totalAmount, 2) }}</span>
        </div>

        <!-- Budget Bar for Expenses -->
        @if($type === 'expense')
            <div class="mt-2">
                <div class="w-full bg-gray-800 h-2 rounded-full">
                    <div class="{{ $borderColor }} h-2 rounded-full" style="width: {{ $percent }}%"></div>
                </div>
            </div>
        @endif
    </div>

</div>

@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Categories</h1>
            <p class="text-gray-400">Manage your expense and income categories</p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition inline-block">
            + Add Category
        </a>
    </div>

    <!-- Expenses Section -->
    <h2 class="text-xl font-semibold text-white mt-6">Expenses</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($expenseCategories as $category)
            <x-category.card 
                :category="$category"
                type="expense"
                :num-transactions="$category->num_expenses ?? 0"
                :total-amount="$category->spent ?? 0"
                :percent="$category->percentage ?? 0"
                :budget="$category->budget_amount ?? 0"
            />
        @empty
            <div class="col-span-full text-center py-10 text-gray-500">
                No expense categories yet.
            </div>
        @endforelse
    </div>

    <!-- Income Section -->
    <h2 class="text-xl font-semibold text-white mt-10">Income</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($incomeCategories as $category)
            <x-category.card 
                :category="$category"
                type="income"
                :num-transactions="$category->numTransactions ?? 0"
                :total-amount="$category->totalIncome ?? 0"
                :percent="0"
                :budget="0"
            />
        @empty
            <div class="col-span-full text-center py-10 text-gray-500">
                No income categories yet.
            </div>
        @endforelse
    </div>

</div>
@endsection