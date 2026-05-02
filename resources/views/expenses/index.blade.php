@extends('layouts.app')

@section('content')

<div class="p-4 md:p-6 space-y-6">


<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">
            Expenses
        </h1>
        <p class="text-sm text-gray-500">
            Manage and track all your expenses
        </p>
    </div>

    <x-button.primary 
        class="w-full sm:w-auto"
        onclick="window.location='{{ route('expenses.create') }}'">
        + Add Expense
    </x-button.primary>
</div>

<!-- Filters -->
<form method="GET" action="{{ route('expenses.index') }}">
    <div class="bg-white dark:bg-gray-900 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 space-y-4">

        <!-- Search -->
        <input 
            type="text" 
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by description or category..."
            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-green-500 outline-none"
        >

        <!-- Filters -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">

            <select name="category_id" class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            {{-- <input type="date" name="date" value="{{ request('date') }}"
                class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent"> --}}
                <input 
    type="date" 
    name="date" 
    value="{{ request('date') }}"
    class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
           bg-white dark:bg-gray-800 
           text-gray-900 dark:text-white
           [color-scheme:dark]"
>

            <input type="month" name="month"
                value="{{ request('month', now()->format('Y-m')) }}"
                class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent">

            <button class="px-4 py-2 bg-green-600 text-white rounded-lg w-full">
                Filter
            </button>

            <a href="{{ route('expenses.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded-lg text-center w-full">
                Reset
            </a>
        </div>
    </div>
</form>

{{-- ================= MOBILE CARDS ================= --}}
<div class="md:hidden space-y-4">
    @forelse($transactions as $transaction)

        @php
        $colors = [
            'green' => '34,197,94',
            'blue' => '59,130,246',
            'yellow' => '234,179,8',
            'purple' => '168,85,247',
            'pink' => '236,72,153',
            'cyan' => '6,182,212',
            'red' => '239,68,68',
        ];
        $rgb = $colors[$transaction->category->color] ?? '34,197,94';
        @endphp

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4 shadow-sm space-y-3">

            <!-- Date + Amount -->
            <div class="flex justify-between">
                <div>
                    <p class="text-xs text-gray-400">Date</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        {{ $transaction->date->format('M d, Y') }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-xs text-gray-400">Amount</p>
                    <p class="font-semibold text-gray-900 dark:text-white">
                        {{ money($transaction->amount, 2) }}
                    </p>
                </div>
            </div>

            <!-- Category -->
            <div>
                <p class="text-xs text-gray-400 mb-1">Category</p>
                <div class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                    <span class="w-2 h-2 rounded-full"
                          style="background-color: rgba({{ $rgb }}, 1);"></span>
                    {{ $transaction->category->name }}
                </div>
            </div>

            <!-- Description -->
            <div>
                <p class="text-xs text-gray-400 mb-1">Description</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $transaction->description ?? '—' }}
                </p>
            </div>

            <!-- Actions -->
            <div class="flex justify-end">
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                            ⋮
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <a href="{{ route('expenses.edit', $transaction) }}"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Edit
                        </a>

                        <form action="{{ route('expenses.destroy', $transaction) }}" method="POST"
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="block w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">
                                Delete
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>

    @empty
        <div class="text-center py-10 text-gray-500">
            No expenses found
        </div>
    @endforelse
</div>

{{-- ================= DESKTOP TABLE ================= --}}
<div class="hidden md:block overflow-x-auto bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl">

    <table class="min-w-full text-sm">

        <thead class="bg-gray-100 dark:bg-gray-800 text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">
            <tr>
                <th class="px-4 py-3 text-left">Date</th>
                <th class="px-4 py-3 text-left">Category</th>
                <th class="px-4 py-3 text-left">Description</th>
                <th class="px-4 py-3 text-right">Amount</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>

        <tbody>
            @forelse($transactions as $transaction)

                @php
                $rgb = $colors[$transaction->category->color] ?? '34,197,94';
                @endphp

            <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                
                <td class="px-4 py-3">
                    {{ $transaction->date->format('M d, Y') }}
                </td>

                <td class="px-4 py-3">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full"
                              style="background-color: rgba({{ $rgb }}, 1);"></span>
                        {{ $transaction->category->name }}
                    </span>
                </td>

                <td class="px-4 py-3">
                    {{ $transaction->description ?? '—' }}
                </td>

                <td class="px-4 py-3 text-right font-medium">
                    {{ money($transaction->amount, 2) }}
                </td>

                <td class="px-4 py-3 text-right">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                                ⋮
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <a href="{{ route('expenses.edit', $transaction) }}"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Edit
                            </a>

                            <form action="{{ route('expenses.destroy', $transaction) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">
                                    Delete
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-10 text-gray-500">
                    No expenses found
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>
</div>

<!-- Pagination -->
<div>
    {{ $transactions->links() }}
</div>


</div>
@endsection
