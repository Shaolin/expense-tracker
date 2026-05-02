@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white">
                Income
            </h1>
            <p class="text-sm text-gray-500">
                Manage and track all your income
            </p>
        </div>

        <x-button.primary 
            onclick="window.location='{{ route('income.create') }}'"
            class="bg-green-600 hover:bg-green-700 w-full sm:w-auto">
            + Add Income
        </x-button.primary>
    </div>

    {{-- Month Picker --}}
    @php
    $selectedMonth = request('month', now()->format('Y-m'));
    $prevMonth = \Carbon\Carbon::parse($selectedMonth)->subMonth()->format('Y-m');
    $nextMonth = \Carbon\Carbon::parse($selectedMonth)->addMonth()->format('Y-m');
    @endphp

    <div class="flex flex-wrap items-center gap-3">
        <a href="{{ route('income.index', array_merge(request()->except('page'), ['month' => $prevMonth])) }}"
           class="px-3 py-1 bg-gray-700 text-white rounded-lg">
            ←
        </a>

        <span class="text-sm md:text-base text-white font-semibold">
            {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}
        </span>

        <a href="{{ route('income.index', array_merge(request()->except('page'), ['month' => $nextMonth])) }}"
           class="px-3 py-1 bg-gray-700 text-white rounded-lg">
            →
        </a>
    </div>

    <!-- Stats Card (DARK preserved) -->
    <div class="bg-gray-900 border border-gray-800 p-4 md:p-6 rounded-2xl relative overflow-hidden">
        <div class="absolute left-0 top-0 h-full w-1.5 bg-green-500"></div>

        <div class="flex items-center gap-4 pl-2">
            <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-green-900">
                📈
            </div>

            <div>
                <p class="text-sm text-gray-400">
                    Total Income ({{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }})
                </p>
                <h2 class="text-xl md:text-3xl font-bold text-white mt-1">
                    {{ money($totalIncomeThisMonth, 2) }}
                </h2>
            </div>
        </div>
    </div>

    <!-- Filters (DARK preserved) -->
    <form method="GET" action="{{ route('income.index') }}">
        <div class="bg-gray-900 border border-gray-800 p-4 rounded-xl space-y-4">

            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Search..."
                class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-white focus:ring-2 focus:ring-green-500 outline-none"
            >

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">

                <select name="category_id"
                    class="px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 text-white">
                    <option value="">All Sources</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <input type="date" name="date"
                    value="{{ request('date') }}"
                    class="px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 text-white">

                <input type="month" name="month"
                    value="{{ request('month', now()->format('Y-m')) }}"
                    class="px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 text-white">

                <button class="px-4 py-2 bg-green-600 text-white rounded-lg w-full">
                    Filter
                </button>

                <a href="{{ route('income.index') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg text-center w-full">
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
        $categoryColor = $transaction->category->color ?? 'green';
        $rgb = $colors[$categoryColor] ?? '34,197,94';
        @endphp

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-4 space-y-3">

            <!-- Date + Amount -->
            <div class="flex justify-between">
                <div>
                    <p class="text-xs text-gray-400">Date</p>
                    <p class="text-sm text-white">
                        {{ \Carbon\Carbon::parse($transaction->date)->format('M d, Y') }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-xs text-gray-400">Amount</p>
                    <p class="text-green-400 font-semibold">
                        {{ money($transaction->amount, 2) }}
                    </p>
                </div>
            </div>

            <!-- Source -->
            <div>
                <p class="text-xs text-gray-400">Source</p>
                <div class="flex items-center gap-2 text-sm text-white">
                    <span class="w-2 h-2 rounded-full"
                          style="background-color: rgba({{ $rgb }}, 1);"></span>
                    {{ $transaction->category->name ?? 'N/A' }}
                </div>
            </div>

            <!-- Description -->
            <div>
                <p class="text-xs text-gray-400">Description</p>
                <p class="text-sm text-gray-300">
                    {{ $transaction->description ?? '-' }}
                </p>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-4 text-sm">
                <a href="{{ route('income.edit', $transaction) }}"
                   class="text-blue-400">Edit</a>

                <form action="{{ route('income.destroy', $transaction) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this income?')">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-400">Delete</button>
                </form>
            </div>

        </div>

        @empty
        <div class="text-center py-10 text-gray-500">
            No income records found.
        </div>
        @endforelse
    </div>

    {{-- ================= DESKTOP TABLE ================= --}}
    <div class="hidden md:block overflow-x-auto bg-gray-900 border border-gray-800 rounded-xl">
        <x-table>
            <x-slot name="head">
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Source</th>
                <th class="px-4 py-3">Description</th>
                <th class="px-4 py-3 text-right">Amount</th>
                <th class="px-4 py-3"></th>
            </x-slot>

            <x-slot name="body">
                @foreach($transactions as $transaction)
                <tr class="hover:bg-gray-800">

                    <td class="px-4 py-3">
                        {{ \Carbon\Carbon::parse($transaction->date)->format('M d, Y') }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $transaction->category->name ?? 'N/A' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $transaction->description ?? '-' }}
                    </td>

                    <td class="px-4 py-3 text-right text-green-400">
                        {{ money($transaction->amount, 2) }}
                    </td>

                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('income.edit', $transaction) }}" class="text-blue-400">Edit</a>
                    </td>

                </tr>
                @endforeach
            </x-slot>
        </x-table>
    </div>

    <!-- Pagination -->
    <div>
        {{ $transactions->links() }}
    </div>

</div>
@endsection