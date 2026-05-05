@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- ===================== -->
    <!-- Top Summary Cards -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Total Budget -->
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 shadow flex flex-col justify-between">
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Budget</p>

            <h2 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                ₦{{ number_format($totalBudget) }}
            </h2>

            <p class="text-xs text-gray-500 dark:text-gray-400">Monthly allocation</p>
        </div>

        <!-- Total Spent -->
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 shadow flex flex-col justify-between">
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Spent</p>

            <h2 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                ₦{{ number_format($totalSpent) }}
            </h2>

            <p class="text-xs text-gray-500 dark:text-gray-400">
                {{ $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100) : 0 }}% of budget used
            </p>
        </div>

        <!-- Remaining -->
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 shadow flex flex-col justify-between">
            <p class="text-sm text-gray-500 dark:text-gray-400">Remaining</p>

            <h2 class="text-3xl font-bold mt-2 text-green-500">
                ₦{{ number_format($remaining) }}
            </h2>

            <p class="text-xs text-gray-500 dark:text-gray-400">Left to spend</p>
        </div>

    </div>

    <!-- ===================== -->
    <!-- Category Budgets -->
    <!-- ===================== -->
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 shadow">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                    Category Budgets
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Click on a budget amount to edit it
                </p>
            </div>

            <a href="{{ route('budgets.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-sm inline-block">
                Set Budget
            </a>
        </div>

        <div class="space-y-4">

            @foreach($budgets as $budget)
                @php
                    $barColor = 'bg-green-500';

                    if ($budget->percentage >= 80 && $budget->percentage < 100) {
                        $barColor = 'bg-yellow-500';
                    }

                    if ($budget->percentage >= 100) {
                        $barColor = 'bg-red-500';
                    }

                    $dotColor = str_replace('bg', 'bg-opacity-20 bg', $barColor);
                @endphp

                <div class="bg-gray-100 dark:bg-gray-800 rounded-2xl p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <!-- Left -->
                    <div class="flex items-center gap-4 w-full md:w-1/2">

                        <!-- Icon -->
                        <div class="w-10 h-10 rounded-full {{ $dotColor }} flex items-center justify-center">
                            <div class="w-3 h-3 rounded-full {{ $barColor }}"></div>
                        </div>

                        <!-- Category + Progress -->
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-800 dark:text-white">
                                {{ $budget->category->name }}
                            </h3>

                            <div class="flex items-center gap-3 mt-2">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 h-2 rounded-full overflow-hidden">
                                    <div 
                                        class="{{ $barColor }} h-2 rounded-full"
                                        style="width: {{ $budget->percentage }}%">
                                    </div>
                                </div>

                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ round($budget->percentage) }}%
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Right -->
                    <div class="flex items-center justify-between md:justify-end gap-4 w-full md:w-auto text-sm">

                        <!-- Spent -->
                        <div class="text-right">
                            <p class="text-gray-500 dark:text-gray-400">Spent</p>
                            <p class="font-semibold text-gray-900 dark:text-white">
                                ₦{{ number_format($budget->spent) }}
                            </p>
                        </div>

                        <!-- Budget -->
                        <div class="text-right">
                            <p class="text-gray-500 dark:text-gray-400">Budget</p>

                            <a href="{{ route('budgets.edit', $budget->id) }}"
                               class="font-semibold text-gray-900 dark:text-white hover:underline">
                                ₦{{ number_format($budget->amount) }}
                            </a>
                        </div>

                        <!-- Delete -->
                        <div>
                            <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this budget?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-500 hover:text-red-600 text-sm font-medium">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</div>
@endsection