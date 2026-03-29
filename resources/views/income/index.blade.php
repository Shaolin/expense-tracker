

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

        <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800">
    
            <div class="flex items-center justify-between">
                
                <div>
                    <p class="text-sm text-gray-500">Total Income</p>
                    <h2 class="text-3xl font-bold text-green-500 mt-1">
                        ₦{{ number_format($totalIncome, 2) }}
                    </h2>
                </div>
        
                <!-- Icon (optional) -->
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                    💰
                </div>
        
            </div>
        
        </div>

        
        <x-button.primary 
    onclick="window.location='{{ route('income.create') }}'"
    class="bg-green-600 hover:bg-green-700">
    + Add Income
</x-button.primary>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-900 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

        <!-- Search -->
        <input 
            type="text" 
            placeholder="Search by description or source..."
            class="w-full md:w-1/3 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-green-500 outline-none"
        >

        <!-- Filter -->
        <div class="flex gap-3">
            <select class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
               bg-white dark:bg-gray-800 
               text-gray-700 dark:text-gray-200
               focus:ring-2 focus:ring-green-500 focus:outline-none">
                <option>All Sources</option>
                <option>Salary</option>
                <option>Freelance</option>
                <option>Dividends</option>
                <option>Side Business</option>
                <option>Cashback</option>
            </select>

            <input type="date" class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent">
        </div>
    </div>

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
        
                    <!-- Date -->
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($transaction->date)->format('M d, Y') }}
                    </td>
        
                    <!-- Source (Category) -->
                    <td class="px-6 py-4">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            {{ $transaction->category->name ?? 'N/A' }}
                        </span>
                    </td>
        
                    <!-- Description -->
                    <td class="px-6 py-4">
                        {{ $transaction->description ?? '-' }}
                    </td>
        
                    <!-- Amount -->
                    <td class="px-6 py-4 text-right font-medium text-green-500">
                        +₦{{ number_format($transaction->amount, 2) }}
                    </td>
        
                    <!-- Actions -->
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

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>

    <!-- Empty State -->
    @if($transactions->isEmpty())
    <div class="text-center py-16 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl">
        <p class="text-gray-500 mb-4">No income records found</p>
        <a href="{{ route('income.create') }}">
            <x-button.primary class="bg-green-600 hover:bg-green-700">
                Add your first income
            </x-button.primary>
        </a>
    </div>
@endif

</div>
@endsection