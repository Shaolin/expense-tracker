@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Add Expense
        </h1>
        <p class="text-sm text-gray-500">
            Record a new expense transaction
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">

        <form action="{{ route('transactions.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Category -->
            <div>
                <label class="block text-sm mb-1 text-gray-600 dark:text-gray-300">
                    Category
                </label>
                <select name="category_id" required
                    
                    class="w-full mt-1 p-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring-2 focus:ring-green-500">
                    
                    <option value="">Select Category</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amount -->
            <div>
                <label class="block text-sm mb-1 text-gray-600 dark:text-gray-300">
                    Amount (₦)
                </label>
                <input type="number" name="amount" step="0.01" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-green-500 outline-none"
                    placeholder="0.00">

                @error('amount')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date -->
            <div>
                <label class="block text-sm mb-1 text-gray-600 dark:text-gray-300">
                    Date
                </label>
                <input type="date" name="date" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent">

                @error('date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm mb-1 text-gray-600 dark:text-gray-300">
                    Description (optional)
                </label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-green-500 outline-none"
                    placeholder="e.g. Grocery shopping"></textarea>
            </div>

            <!-- Hidden Type -->
            <input type="hidden" name="type" value="expense">

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('expenses.index') }}"
                   class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 text-sm">
                    Cancel
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">
                    Save Expense
                </button>
            </div>

        </form>
    </div>

</div>
@endsection