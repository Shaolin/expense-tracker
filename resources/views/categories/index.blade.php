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