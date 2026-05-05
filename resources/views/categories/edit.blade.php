@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto space-y-6">

    <!-- Header -->
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
        Edit Category
    </h1>

    <form action="{{ route('categories.update', $category) }}" method="POST"
          class="space-y-6 p-6 border border-gray-200 dark:border-gray-800 rounded-2xl bg-white dark:bg-gray-900 shadow-sm">

        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Category Name
            </label>

            <input type="text" name="name" value="{{ $category->name }}"
                   class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none"
                   required>
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Description
            </label>

            <input type="text" name="description" value="{{ $category->description }}"
                   class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none">
        </div>

        <!-- Type -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Type
            </label>

            <select name="type"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Expense</option>
                <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Income</option>
            </select>
        </div>

        <!-- Current Month Budget -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Current Month Budget
            </label>

            <input type="text"
                   value="₦{{ number_format($budgetAmount ?? 0, 2) }}"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300"
                   disabled>
        </div>

        <!-- Color -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Color
            </label>

            <select name="color"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                <option value="green" {{ $category->color == 'green' ? 'selected' : '' }}>Green</option>
                <option value="blue" {{ $category->color == 'blue' ? 'selected' : '' }}>Blue</option>
                <option value="yellow" {{ $category->color == 'yellow' ? 'selected' : '' }}>Yellow</option>
                <option value="purple" {{ $category->color == 'purple' ? 'selected' : '' }}>Purple</option>
                <option value="pink" {{ $category->color == 'pink' ? 'selected' : '' }}>Pink</option>
                <option value="cyan" {{ $category->color == 'cyan' ? 'selected' : '' }}>Cyan</option>
            </select>
        </div>

        <!-- Actions -->
        <div class="flex justify-between items-center pt-4">

            <a href="{{ route('categories.index') }}"
               class="text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white">
                ← Back
            </a>

            <button class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg text-white transition">
                Update
            </button>

        </div>

    </form>
</div>
@endsection