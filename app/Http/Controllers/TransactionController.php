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
    public function createExpense()
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

        if ($validated['type'] === 'expense') {
            return redirect()
                ->route('expenses.index')
                ->with('success', 'Expense added successfully.');
        }
        return redirect()
        ->route('income.index')
        ->with('success', 'Income added successfully.');
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
    public function editExpense(Transaction $transaction)
    {
       
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();

        return view('expenses.edit', compact('transaction', 'categories'));
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
        ->route('expenses.index')
        ->with('success', 'Expense updated successfully.');
    }

    /**
     * Delete transaction
     */
    public function destroyExpense(Transaction $transaction)
{
    //  Ensure user owns it
    if ($transaction->user_id !== auth()->id()) {
        abort(403);
    }

    $transaction->delete();

    return redirect()
        ->route('expenses.index')
        ->with('success', 'Expense deleted successfully.');
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