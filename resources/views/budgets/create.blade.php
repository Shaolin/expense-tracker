@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Set Budget</h1>
        <p class="text-sm text-gray-500">Create a budget for a category</p>
    </div>

    <!-- Card -->
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow p-6">

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-600 p-3 rounded-lg">
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('budgets.store') }}" class="space-y-5">
            @csrf

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Category
                </label>

                <select name="category_id"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-700 dark:text-gray-200"
                    required>
                    
                    <option value="">-- Select Category --</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- Amount -->
            <div>
                {{-- <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Budget Amount (₦)
                </label> --}}
                <label class="block text-sm font-medium text-gray-200 mb-1">
                    Budget Amount ({{ currency_symbol() }})
                </label>

                <input type="number"
                    name="amount"
                    step="0.01"
                    value="{{ old('amount') }}"
                    placeholder="e.g. 50000"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-700 dark:text-gray-200"
                    required>
            </div>

            <!-- Month -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Month
                </label>

                <input type="month"
                    name="month"
                    value="{{ old('month') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-700 dark:text-gray-200"
                    required>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('budgets.index') }}"
                   class="text-gray-500 hover:text-gray-700 text-sm">
                    Cancel
                </a>

                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl shadow">
                    Save Budget
                </button>
            </div>
        </form>

    </div>

</div>
@endsection