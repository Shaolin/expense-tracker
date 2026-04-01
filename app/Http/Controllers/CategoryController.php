<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index()
    {
        $userId = auth()->id();
        $currentMonth = now()->format('Y-m');
    
        // -------------------------
        // 1. Fetch Expense Categories
        // -------------------------
        $expenseCategories = Category::forUser($userId)
            ->where('type', 'expense')
            ->orderBy('name')
            ->get();
    
        foreach ($expenseCategories as $category) {
            // Fetch budget for this category (current month)
            $budget = \App\Models\Budget::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('month', $currentMonth)
                ->first();
    
            $budgetAmount = $budget ? $budget->amount : 0;
    
            // Calculate spent for this category
            $spent = \App\Models\Transaction::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('type', 'expense')
                ->whereMonth('date', \Carbon\Carbon::parse($currentMonth)->month)
                ->whereYear('date', \Carbon\Carbon::parse($currentMonth)->year)
                ->sum('amount');
    
            $remaining = $budgetAmount - $spent;
            $percentage = $budgetAmount > 0 ? min(100, ($spent / $budgetAmount) * 100) : 0;
    
            // Count number of expense transactions
            $numExpenses = \App\Models\Transaction::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('type', 'expense')
                ->whereMonth('date', \Carbon\Carbon::parse($currentMonth)->month)
                ->whereYear('date', \Carbon\Carbon::parse($currentMonth)->year)
                ->count();
    
            // Attach computed values
            $category->budget_amount = $budgetAmount;
            $category->spent = $spent;
            $category->remaining = $remaining;
            $category->percentage = $percentage;
            $category->num_expenses = $numExpenses;
        }
    
        // -------------------------
        // 2. Fetch Income Categories
        // -------------------------
        $incomeCategories = Category::forUser($userId)
            ->where('type', 'income')
            ->orderBy('name')
            ->get();
    
        foreach ($incomeCategories as $category) {
            $totalIncome = \App\Models\Transaction::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('type', 'income')
                ->sum('amount');
    
            $numTransactions = \App\Models\Transaction::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('type', 'income')
                ->count();
    
            // Attach computed values
            $category->totalIncome = $totalIncome;
            $category->numTransactions = $numTransactions;
        }
    
        // -------------------------
        // 3. Return view with separate collections
        // -------------------------
        return view('categories.index', compact('expenseCategories', 'incomeCategories'));
    }     /**
     *  Create category
     */
    public function create()
{
    return view('categories.create');
}

/**
     *  edit category
     */
public function edit(Category $category)
{
    // Prevent editing shared categories
    if ($category->user_id !== auth()->id()) {
        abort(403);
    }

    return view('categories.edit', compact('category'));
}

    /**
     * Store a newly created category
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|in:income,expense',
        'description' => 'nullable|string',
        'budget' => 'nullable|numeric',
        'color' => 'nullable|string',
    ]);

    Category::create([
        'user_id' => auth()->id(),
        'name' => $validated['name'],
        'type' => $validated['type'],
        'description' => $validated['description'] ?? null,
        'budget' => $validated['budget'] ?? null,
        'color' => $validated['color'] ?? 'green',
    ]);

    return redirect()->route('categories.index')
        ->with('success', 'Category created successfully.');
}

    /**
     * Update the specified category
     */
    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'color' => 'nullable|string',
        ]);
    
        $category->update($validated);
    
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category
     */
    public function destroy(Category $category)
    {
        // Prevent deleting shared categories
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        $category->delete();

      

        return redirect()->route('categories.index')
        ->with('success', 'Category deleted successfully.');
        
    }
}

