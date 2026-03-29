<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions (Dashboard-ready)
     */
    public function index(Request $request)
    {
        $userId = auth()->id();

        // Optional filters
        $type = $request->type; // income | expense
        $start = $request->start_date;
        $end = $request->end_date;

        $transactions = Transaction::with('category')
            ->forUser($userId)
            ->when($type, fn ($q) => $q->type($type))
            ->when($start && $end, fn ($q) => $q->betweenDates($start, $end))
            ->latest('date')
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show form to create a transaction
     */
    public function create()
    {
        $categories = Category::all();

        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a new transaction
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $validated['user_id'] = auth()->id();

        Transaction::create($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction added successfully.');
    }

    /**
     * Show a single transaction (optional)
     */
    public function show(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);

        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show form to edit transaction
     */
    public function edit(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);

        $categories = Category::all();

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update transaction
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $transaction->update($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    /**
     * Delete transaction
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);

        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }

    /**
     *  Ensure user owns the transaction
     */
    private function authorizeTransaction(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }
    }




public function expenses()
{
    $transactions = Transaction::with('category')
        ->forUser(auth()->id())
        ->type('expense')
        ->latest('date')
        ->paginate(10);

    $categories = Category::all();

    return view('expenses.index', compact('transactions', 'categories'));
}

public function income()
{
    $transactions = Transaction::with('category')
        ->forUser(auth()->id())
        ->type('income')
        ->latest('date')
        ->paginate(10);

    return view('income.index', compact('transactions'));
}

}

@extends('layouts.app')

@section('content')
<script src="//unpkg.com/alpinejs" defer></script>
<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                Expenses
            </h1>
            <p class="text-sm text-gray-500">
                Manage and track all your expenses
            </p>
        </div>

    

        <x-button.primary onclick="window.location='{{ route('expenses.create') }}'">
            + Add Expense
        </x-button.primary>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-900 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

        <!-- Search -->
        <input 
            type="text" 
            placeholder="Search by description or category..."
            class="w-full md:w-1/3 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-green-500 outline-none"
        >

        <!-- Filter -->
        <div class="flex gap-3">
           
            <select name="category_id" 
    class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
    bg-white dark:bg-gray-800 
    text-gray-700 dark:text-gray-200
    focus:ring-2 focus:ring-green-500 focus:outline-none">

    <option value="">All Categories</option>

    @foreach($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->name }}
        </option>
    @endforeach
</select>

            <input type="date" class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent">
        </div>
    </div>

    <!-- Table -->
    <x-table>
       
        <x-slot name="head">
            <th class="px-6 py-3">Date</th>
            <th class="px-6 py-3">Category</th>
            <th class="px-6 py-3">Description</th>
            <th class="px-6 py-3 text-right">Amount</th>
            <th class="px-6 py-3"></th>
        </x-slot>

        <x-slot name="body">
            @forelse($transactions as $transaction)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    
                    <!-- Date -->
                    <td class="px-6 py-4">
                        {{ $transaction->date->format('M d, Y') }}
                    </td>
        
                    <!-- Category -->
                    <td class="px-6 py-4">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            {{ $transaction->category->name }}
                        </span>
                    </td>
        
                    <!-- Description -->
                    <td class="px-6 py-4">
                        {{ $transaction->description ?? '—' }}
                    </td>
        
                    <!-- Amount -->
                    <td class="px-6 py-4 text-right font-medium">
                        ₦{{ number_format($transaction->amount, 2) }}
                    </td>
        
                    <td class="px-6 py-4 text-right">
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                            
                            <!-- Trigger -->
                            <button @click="open = !open"
                                class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                                ⋮
                            </button>
                    
                            <!-- Dropdown -->
                            <div x-show="open" 
                                 @click.outside="open = false"
                                 x-transition
                                 class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50">
                    
                                <a href="{{ route('expenses.edit', $transaction) }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit
                                </a>
                    
                                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">
                                        Delete
                                    </button>
                                </form>
                    
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-500">
                        No expenses found
                    </td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>
    {{-- paginations --}}
    <div>
        {{ $transactions->links() }}
    </div>

    <!-- Empty State -->
    <div class="hidden text-center py-16 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl">
        <p class="text-gray-500 mb-4">No expenses found</p>
        <x-button.primary>
            Add your first expense
        </x-button.primary>
    </div>

</div>
@endsection