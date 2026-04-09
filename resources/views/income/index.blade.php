@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                Income
            </h1>
            
            <p class="text-sm text-gray-500">
                Manage and track all your income
            </p>
        </div>

        <x-button.primary 
            onclick="window.location='{{ route('income.create') }}'"
            class="bg-green-600 hover:bg-green-700">
            + Add Income
        </x-button.primary>
    </div>
{{-- month picker --}}
    @php
$selectedMonth = request('month', now()->format('Y-m'));
$prevMonth = \Carbon\Carbon::parse($selectedMonth)->subMonth()->format('Y-m');
$nextMonth = \Carbon\Carbon::parse($selectedMonth)->addMonth()->format('Y-m');
@endphp

<div class="flex items-center gap-3 mb-4">
    <a href="{{ route('income.index', array_merge(request()->except('page'), ['month' => $prevMonth])) }}"
       class="px-3 py-1 bg-gray-700 text-white rounded-lg">
        ←
    </a>

    <span class="text-white font-semibold">
        {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}
    </span>

    <a href="{{ route('income.index', array_merge(request()->except('page'), ['month' => $nextMonth])) }}"
       class="px-3 py-1 bg-gray-700 text-white rounded-lg">
        →
    </a>
</div>

   <!-- Stats Card with Side Accent -->
<div class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 relative overflow-hidden">
    
    <!-- Left Accent Bar -->
    <div class="absolute left-0 top-0 h-full w-1.5 bg-green-500 rounded-l-2xl"></div>

    <div class="flex items-center gap-4 pl-2">
        <!-- Icon -->
        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
            📈
        </div>

        <!-- Text -->
        <div>
            {{-- <p class="text-sm text-gray-500">
                Total Income This Month
            </p> --}}
            <p class="text-sm text-gray-500">
                Total Income ({{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }})
            </p>
            <h2 class="text-3xl font-bold text-white-500 mt-1">
                {{-- ₦{{ number_format($totalIncomeThisMonth, 2) }} --}}
                {{ money($totalIncomeThisMonth, 2) }}
            </h2>
        </div>
    </div>
</div>
    <!-- Filters -->
    <form method="GET" action="{{ route('income.index') }}">
        <div class="bg-white dark:bg-gray-900 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

            <!-- Search -->
            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by description or source..."
                class="w-full md:w-1/3 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-green-500 outline-none"
            >

            <!-- Filters -->
            <div class="flex flex-wrap gap-3">

                <!-- Source -->
                <select name="category_id"
                    class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
                    bg-white dark:bg-gray-800 
                    text-gray-700 dark:text-gray-200
                    focus:ring-2 focus:ring-green-500 focus:outline-none">

                    <option value="">All Sources</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Date -->
                <input 
                    type="date" 
                    name="date"
                    value="{{ request('date') }}"
                    class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent"
                >

                <!-- Buttons -->
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg">
                    Filter
                </button>

                <a href="{{ route('income.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                    Reset
                </a>

                <input 
    type="month" 
    name="month"
    value="{{ request('month', now()->format('Y-m')) }}"
    class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent"
>
 

            </div>
        </div>
    </form>

    <!-- Table -->
    <x-table>
        <x-slot name="head">
            <th class="px-6 py-3">Date</th>
            <th class="px-6 py-3">Source</th>
            <th class="px-6 py-3">Description</th>
            <th class="px-6 py-3 text-right">Amount</th>
            <th class="px-6 py-3"></th>
        </x-slot>

        <x-slot name="body">
            @forelse($transactions as $transaction)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
        
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($transaction->date)->format('M d, Y') }}
                    </td>
        
                    <td class="px-6 py-4">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            {{ $transaction->category->name ?? 'N/A' }}
                        </span>
                    </td>
        
                    <td class="px-6 py-4">
                        {{ $transaction->description ?? '-' }}
                    </td>
        
                    <td class="px-6 py-4 text-right font-medium text-green-500">
                    
                        {{-- +₦{{ number_format($transaction->amount, 2) }} --}}
                        {{ money($transaction->amount, 2) }}
                    </td>
        
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-3">
        
                            <a href="{{ route('income.edit', $transaction) }}"
                               class="text-blue-500 hover:underline">
                                Edit
                            </a>
        
                            <form action="{{ route('income.destroy', $transaction) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this income?')">
                                @csrf
                                @method('DELETE')
        
                                <button class="text-red-500 hover:underline">
                                    Delete
                                </button>
                            </form>
        
                        </div>
                    </td>
        
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                        No income records found.
                    </td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $transactions->links() }}
    </div>

</div>
@endsection