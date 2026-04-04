<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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




    public function expenses(Request $request)
{
    $userId = auth()->id();

    // 📅 Selected month (default = current)
    $selectedMonth = $request->query('month', now()->format('Y-m'));
    $parsedMonth = \Carbon\Carbon::parse($selectedMonth);

    $query = Transaction::with('category')
        ->forUser($userId)
        ->type('expense')
        ->whereMonth('date', $parsedMonth->month)
        ->whereYear('date', $parsedMonth->year);

    // 🔍 Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('description', 'like', '%' . $request->search . '%')
              ->orWhereHas('category', function ($q2) use ($request) {
                  $q2->where('name', 'like', '%' . $request->search . '%');
              });
        });
    }

    // 📂 Category filter
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    //  REMOVE this (conflicts with month filter)
    // if ($request->date) {
    //     $query->whereDate('date', $request->date);
    // }

    $transactions = $query->latest('date')
        ->paginate(10)
        ->withQueryString();

    $categories = Category::where('type', 'expense')
        ->where('user_id', $userId)
        ->get();

    return view('expenses.index', compact(
        'transactions',
        'categories',
        'selectedMonth'
    ));
}

private function authorizeIncome(Transaction $transaction)
{
    if ($transaction->user_id !== Auth::id() || $transaction->type !== 'income') {
        abort(403);
    }
}



public function indexIncome(Request $request)
{
    $userId = Auth::id();

    // 📅 Selected month (default = current month)
    $selectedMonth = $request->query('month', now()->format('Y-m'));
    $parsedMonth = Carbon::parse($selectedMonth);

    $query = Transaction::with('category')
        ->where('type', 'income')
        ->where('user_id', $userId)
        ->whereMonth('date', $parsedMonth->month)
        ->whereYear('date', $parsedMonth->year);

    // 🔍 Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('description', 'like', '%' . $request->search . '%')
              ->orWhereHas('category', function ($q2) use ($request) {
                  $q2->where('name', 'like', '%' . $request->search . '%');
              });
        });
    }

    // 📂 Category filter
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    //  REMOVE this (conflicts with month filter)
    // if ($request->date) {
    //     $query->whereDate('date', $request->date);
    // }

    $transactions = $query->latest('date')
        ->paginate(10)
        ->withQueryString();

    $categories = Category::where('type', 'income')
        ->where('user_id', $userId)
        ->get();

    // 💰 TOTAL INCOME FOR SELECTED MONTH (NOT CURRENT)
    $totalIncomeThisMonth = Transaction::where('type', 'income')
        ->where('user_id', $userId)
        ->whereMonth('date', $parsedMonth->month)
        ->whereYear('date', $parsedMonth->year)
        ->sum('amount');

    return view('income.index', compact(
        'transactions',
        'categories',
        'totalIncomeThisMonth',
        'selectedMonth'
    ));
}

public function createIncome()
{
    $categories = Category::where('type', 'income')
        ->where('user_id', Auth::id()) // optional (if categories are user-specific)
        ->get();

    return view('income.create', compact('categories'));
}

public function storeIncome(Request $request)
{
    $validated = $request->validate([
        'amount' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'date' => 'required|date',
    ]);

    $validated['type'] = 'income';
    $validated['user_id'] = Auth::id(); 

    Transaction::create($validated);

    return redirect()->route('income.index')->with('success', 'Income added successfully.');
}

public function editIncome(Transaction $transaction)
{
    $this->authorizeIncome($transaction); 

    $categories = Category::where('type', 'income')->get();

    return view('income.edit', compact('transaction', 'categories'));
}

public function updateIncome(Request $request, Transaction $transaction)
{
    $this->authorizeIncome($transaction); 

    $validated = $request->validate([
        'amount' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'date' => 'required|date',
    ]);

    $validated['type'] = 'income';

    $transaction->update($validated);

    return redirect()->route('income.index')->with('success', 'Income updated successfully.');
}

public function destroyIncome(Transaction $transaction)
{
    $this->authorizeIncome($transaction); 

    $transaction->delete();

    return redirect()->route('income.index')->with('success', 'Income deleted successfully.');
}


}