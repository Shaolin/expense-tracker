@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-800 text-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Budget</h1>
            <p class="text-sm text-gray-500">Manage your spending limits by category</p>
        </div>

        <a href="{{ route('budgets.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl shadow inline-block">
            + Set Budget
        </a>
    </div>

    <!-- Month Selector -->
<form method="GET" action="{{ route('budgets.index') }}" class="mb-6 flex items-center gap-4">
    <label for="month" class="text-gray-400">Select Month:</label>
    <input 
        type="month" 
        id="month" 
        name="month" 
        value="{{ $selectedMonth ?? now()->format('Y-m') }}"
        class="px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-700"
        onchange="this.form.submit()"
    >
</form>

    <!-- ===================== -->
    <!-- Top Summary Cards -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

        <!-- Total Budget -->
        <div class="bg-gray-900 text-white rounded-2xl p-6 shadow flex flex-col justify-between">
            <p class="text-sm text-gray-400">Total Budget</p>
            {{-- <h2 class="text-3xl font-bold mt-2">₦{{ number_format($totalBudget) }}</h2> --}}
            <h2 class="text-3xl font-bold mt-2">{{ money($totalBudget, 0) }}</h2>
            <p class="text-xs text-gray-500">Monthly allocation</p>
        </div>

        <!-- Total Spent -->
        <div class="bg-gray-900 text-white rounded-2xl p-6 shadow flex flex-col justify-between">
            <p class="text-sm text-gray-400">Total Spent</p>
            {{-- <h2 class="text-3xl font-bold mt-2">₦{{ number_format($totalSpent) }}</h2> --}}
            <h2 class="text-3xl font-bold mt-2">{{ money($totalSpent, 0) }}</h2>
            <p class="text-xs text-gray-500">
                {{ $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100) : 0 }}% of budget used
            </p>
        </div>

        <!-- Remaining -->
        <div class="bg-gray-900 text-white rounded-2xl p-6 shadow flex flex-col justify-between">
            <p class="text-sm text-gray-400">Remaining</p>
            <h2 class="text-3xl font-bold mt-2 text-green-500">
                {{-- ₦{{ number_format($totalBudget - $totalSpent) }} --}}
                {{ money($totalBudget - $totalSpent, 0) }}
               
            </h2>
            <p class="text-xs text-gray-500">Left to spend</p>
        </div>

    </div>

    <!-- ===================== -->
    <!-- Category Budgets -->
    <!-- ===================== -->
    @if($budgets->count() > 0)
        <div class="space-y-4 mt-6">

            @foreach($budgets as $budget)
                @php
                    $remaining = $budget->amount - $budget->spent;
                    $color = 'green';
                    if ($budget->percentage >= 80 && $budget->percentage < 100) $color = 'yellow';
                    if ($budget->percentage >= 100) $color = 'red';

                    $dotColor = str_replace('bg', 'bg-opacity-20 bg', "bg-$color-500");
                    $barColor = "bg-$color-500";
                @endphp

                <div class="bg-gray-800 rounded-2xl p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4 text-white">

                    <!-- Left: Icon + Category + Progress -->
                    <div class="flex items-center gap-4 w-full md:w-1/2">
                        <div class="w-10 h-10 rounded-full {{ $dotColor }} flex items-center justify-center">
                            <div class="w-3 h-3 rounded-full {{ $barColor }}"></div>
                        </div>

                        <div class="flex-1">
                            <h3 class="font-medium">{{ $budget->category->name }}</h3>

                            <div class="flex items-center gap-3 mt-2">
                                <div class="w-full bg-gray-700 h-2 rounded-full overflow-hidden">
                                    <div class="{{ $barColor }} h-2 rounded-full" style="width: {{ $budget->percentage }}%"></div>
                                </div>
                                <span class="text-sm text-gray-400">{{ round($budget->percentage) }}%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Spent, Budget, Actions -->
                    <div class="flex items-center justify-between md:justify-end gap-4 w-full md:w-auto text-sm">

                        <!-- Spent -->
                        <div class="text-right">
                            <p class="text-gray-400">Spent</p>
                            {{-- <p class="font-semibold">₦{{ number_format($budget->spent) }}</p> --}}
                            <p class="font-semibold">{{ money($budget->spent, 0) }}</p>
                        </div>

                        <!-- Budget (Edit link) -->
                        <div class="text-right">
                            <p class="text-gray-400">Budget</p>
                            <a href="{{ route('budgets.edit', $budget->id) }}" class="font-semibold hover:underline">
                                {{-- ₦{{ number_format($budget->amount) }} --}}
                                {{ money($budget->amount, 0) }}
                            </a>
                        </div>

                        <!-- Delete Button -->
                        <div>
                            <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this budget?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>
    @else
        <!-- Empty State -->
        <div class="rounded-2xl shadow p-10 text-center mt-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">No Budgets Yet</h3>
            <p class="text-sm text-gray-500 mb-4">Start by setting a budget for your categories</p>

            <a href="{{ route('budgets.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl">
                Set Your First Budget
            </a>
        </div>
    @endif

</div>
@endsection