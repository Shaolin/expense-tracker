@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Edit Expense
        </h1>
        <p class="text-sm text-gray-500">
            Update your expense details
        </p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">

        <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Category -->
            <div>
                <label class="block text-sm mb-1 text-gray-600 dark:text-gray-300">Category</label>

                <select name="category_id" required
                class="w-full px-4 py-2 rounded-lg 
                border border-gray-300 dark:border-gray-700 
                bg-white dark:bg-gray-800 
                text-gray-900 dark:text-gray-100
                focus:ring-2 focus:ring-green-500 focus:outline-none">

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Amount -->
            <div>
                <label class="block text-sm mb-1 text-gray-600 dark:text-gray-300">Amount (₦)</label>

                <input type="number" name="amount" step="0.01"
                value="{{ $transaction->amount }}"
                class="w-full px-4 py-2 rounded-lg 
                border border-gray-300 dark:border-gray-700 
                bg-white dark:bg-gray-800 
                text-gray-900 dark:text-gray-100
                focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <!-- Date -->
            <div>
                <label class="block text-sm mb-1 text-gray-600 dark:text-gray-300">Date</label>

                <input type="date" name="date"
                    value="{{ $transaction->date->format('Y-m-d') }}"
                    class="w-full px-4 py-2 rounded-lg 
                    border border-gray-300 dark:border-gray-700 
                    bg-white dark:bg-gray-800 
                    text-gray-900 dark:text-gray-100
                    focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm mb-1 text-gray-600 dark:text-gray-300">
                    Description
                </label>

                <textarea name="description" rows="3"
                class="w-full px-4 py-2 rounded-lg 
                border border-gray-300 dark:border-gray-700 
                bg-white dark:bg-gray-800 
                text-gray-900 dark:text-gray-100
                focus:ring-2 focus:ring-green-500 focus:outline-none">{{ $transaction->description }}</textarea>
            </div>

            <!-- Hidden type -->
            <input type="hidden" name="type" value="expense">

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('expenses.index') }}"
                   class="px-4 py-2 border rounded-lg text-sm">
                    Cancel
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm">
                    Update Expense
                </button>
            </div>

        </form>
    </div>

</div>

 

@if(session('success'))
<div class="text-green-400 text-sm">
    {{ session('success') }}
</div>
@endif
</div>
@endsection