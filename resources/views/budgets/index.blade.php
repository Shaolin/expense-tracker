@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6 space-y-6">

    @if(session('success'))
        <div class="p-3 bg-green-800 text-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-white">Budget</h1>
            <p class="text-sm text-gray-400">Manage your spending limits</p>
        </div>

        <a href="{{ route('budgets.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-center w-full sm:w-auto">
            + Set Budget
        </a>
    </div>

    <!-- Month Selector -->
<form method="GET" action="{{ route('budgets.index') }}" 
class="flex flex-col sm:flex-row sm:items-center gap-3">

<label class="text-gray-600 dark:text-gray-400 text-sm">
  Month:
</label>

<input 
  type="month" 
  name="month" 
  value="{{ $selectedMonth ?? now()->format('Y-m') }}"
  class="px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-700 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-indigo-500"
  onchange="this.form.submit()"
>

</form>

    <!-- ===================== -->
    <!-- Summary Cards -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

        <!-- Total Budget -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm">
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Budget</p>
    
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mt-1">
                {{ money($totalBudget, 0) }}
            </h2>
        </div>
    
        <!-- Total Spent -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm">
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Spent</p>
    
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mt-1">
                {{ money($totalSpent, 0) }}
            </h2>
    
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                {{ $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100) : 0 }}% used
            </p>
        </div>
    
        <!-- Remaining -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm">
            <p class="text-sm text-gray-500 dark:text-gray-400">Remaining</p>
    
            <h2 class="text-2xl md:text-3xl font-bold text-green-500 mt-1">
                {{ money($totalBudget - $totalSpent, 0) }}
            </h2>
        </div>
    
    </div>

    <!-- ===================== -->
    <!-- Budgets -->
    <!-- ===================== -->
    @if($budgets->count() > 0)

    <div class="grid gap-4">

        @foreach($budgets as $budget)

        @php
            $remaining = $budget->amount - $budget->spent;
            $color = 'green';
            if ($budget->percentage >= 80 && $budget->percentage < 100) $color = 'yellow';
            if ($budget->percentage >= 100) $color = 'red';

            $dotColor = "bg-$color-500/20";
            $barColor = "bg-$color-500";
        @endphp

       <!-- CARD -->
<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-4 md:p-5 space-y-4">

    <!-- Top Row -->
    <div class="flex items-center justify-between">

        <!-- Category -->
        <div class="flex items-center gap-3">

            <div class="w-9 h-9 rounded-full {{ $dotColor }} flex items-center justify-center">
                <div class="w-3 h-3 rounded-full {{ $barColor }}"></div>
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Category</p>

                <h3 class="text-gray-900 dark:text-white font-semibold">
                    {{ $budget->category->name }}
                </h3>
            </div>

        </div>

        <!-- Percentage -->
        <span class="text-sm text-gray-500 dark:text-gray-400">
            {{ round($budget->percentage) }}%
        </span>

    </div>

    <!-- Progress -->
    <div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 h-2 rounded-full overflow-hidden">
            <div class="{{ $barColor }} h-2"
                 style="width: {{ $budget->percentage }}%"></div>
        </div>
    </div>

    <!-- Bottom Info -->
    <div class="grid grid-cols-2 gap-4 text-sm">

        <div>
            <p class="text-gray-500 dark:text-gray-400">Spent</p>

            <p class="text-gray-900 dark:text-white font-semibold">
                {{ money($budget->spent, 0) }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 dark:text-gray-400">Budget</p>

            <a href="{{ route('budgets.edit', $budget->id) }}"
               class="text-gray-900 dark:text-white font-semibold hover:underline">
                {{ money($budget->amount, 0) }}
            </a>
        </div>

    </div>

    <!-- Actions -->
    <div class="flex justify-end">
        <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST"
              onsubmit="return confirm('Delete this budget?');">
            @csrf
            @method('DELETE')

            <button class="text-red-500 hover:text-red-400 text-sm">
                🗑️ Delete
            </button>
        </form>
    </div>

</div>

        @endforeach

    </div>

    @else

    <!-- Empty -->
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-10 text-center">
        <h3 class="text-lg font-semibold text-white mb-2">No Budgets Yet</h3>
        <p class="text-sm text-gray-400 mb-4">
            Start by setting a budget
        </p>

        <a href="{{ route('budgets.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl">
            Set Your First Budget
        </a>
    </div>

    @endif

</div>
@endsection