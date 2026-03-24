@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- ===================== -->
    <!-- Top Summary Cards -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Total Budget -->
        <div class="bg-gray-900 text-white rounded-2xl p-6 shadow flex flex-col justify-between">
            <p class="text-sm text-gray-400">Total Budget</p>
            <h2 class="text-3xl font-bold mt-2">$2,450</h2>
            <p class="text-xs text-gray-500">Monthly allocation</p>
        </div>

        <!-- Total Spent -->
        <div class="bg-gray-900 text-white rounded-2xl p-6 shadow flex flex-col justify-between">
            <p class="text-sm text-gray-400">Total Spent</p>
            <h2 class="text-3xl font-bold mt-2">$1,073</h2>
            <p class="text-xs text-gray-500">44% of budget used</p>
        </div>

        <!-- Remaining -->
        <div class="bg-gray-900 text-white rounded-2xl p-6 shadow flex flex-col justify-between">
            <p class="text-sm text-gray-400">Remaining</p>
            <h2 class="text-3xl font-bold mt-2 text-green-500">$1,377</h2>
            <p class="text-xs text-gray-500">Left to spend</p>
        </div>

    </div>

    <!-- ===================== -->
    <!-- Category Budgets -->
    <!-- ===================== -->
    <div class="bg-gray-900 rounded-2xl p-6 shadow text-white">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-semibold">Category Budgets</h2>
                <p class="text-sm text-gray-400">Click on a budget amount to edit it</p>
            </div>

            <button 
                @click="openModal = true"
                class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-xl text-sm">
                Set Budget
            </button>
        </div>

        @php
            $budgets = [
                ['name' => 'Food & Dining', 'spent' => 268, 'budget' => 800, 'color' => 'green'],
                ['name' => 'Transportation', 'spent' => 192, 'budget' => 400, 'color' => 'blue'],
                ['name' => 'Utilities', 'spent' => 205, 'budget' => 300, 'color' => 'yellow'],
                ['name' => 'Entertainment', 'spent' => 136, 'budget' => 200, 'color' => 'purple'],
            ];
        @endphp

        <div class="space-y-4">

            @foreach($budgets as $item)
                @php
                    $percentage = min(100, ($item['spent'] / $item['budget']) * 100);

                    $barColor = match($item['color']) {
                        'green' => 'bg-green-500',
                        'blue' => 'bg-blue-500',
                        'yellow' => 'bg-yellow-500',
                        'purple' => 'bg-purple-500',
                        default => 'bg-gray-500'
                    };

                    $dotColor = str_replace('bg', 'bg-opacity-20 bg', $barColor);
                @endphp

                <div class="bg-gray-800 rounded-2xl p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <!-- Left -->
                    <div class="flex items-center gap-4 w-full md:w-1/2">

                        <!-- Icon Circle -->
                        <div class="w-10 h-10 rounded-full {{ $dotColor }} flex items-center justify-center">
                            <div class="w-3 h-3 rounded-full {{ $barColor }}"></div>
                        </div>

                        <!-- Category + Progress -->
                        <div class="flex-1">
                            <h3 class="font-medium">{{ $item['name'] }}</h3>

                            <div class="flex items-center gap-3 mt-2">
                                <div class="w-full bg-gray-700 h-2 rounded-full overflow-hidden">
                                    <div 
                                        class="{{ $barColor }} h-2 rounded-full"
                                        style="width: {{ $percentage }}%">
                                    </div>
                                </div>

                                <span class="text-sm text-gray-400">
                                    {{ round($percentage) }}%
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Right -->
                    <div class="flex items-center justify-between md:justify-end gap-10 w-full md:w-auto text-sm">

                        <div class="text-right">
                            <p class="text-gray-400">Spent</p>
                            <p class="font-semibold">${{ number_format($item['spent']) }}</p>
                        </div>

                        <div class="text-right">
                            <p class="text-gray-400">Budget</p>
                            <p class="font-semibold cursor-pointer hover:underline">
                                ${{ number_format($item['budget']) }}
                            </p>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

    <!-- ===================== -->
    <!-- Empty State -->
    <!-- ===================== -->
    {{-- 
    Uncomment when no data

    <div class="bg-gray-900 rounded-2xl p-10 text-center text-white">
        <h3 class="text-lg font-semibold mb-2">No Budgets Yet</h3>
        <p class="text-sm text-gray-400 mb-4">Start tracking your spending by setting a budget</p>

        <button class="bg-indigo-600 px-4 py-2 rounded-xl">
            Set Budget
        </button>
    </div>
    --}}

</div>
@endsection