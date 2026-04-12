<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * GET /api/categories
     */
    public function index(Request $request)
    {
        $userId = auth()->id();

        $selectedMonth = $request->query('month', now()->format('Y-m'));
        $parsedMonth = Carbon::parse($selectedMonth);

        // Expense Categories
        $expenseCategories = Category::forUser($userId)
            ->where('type', 'expense')
            ->orderBy('name')
            ->get();

        foreach ($expenseCategories as $category) {
            $budget = \App\Models\Budget::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('month', $selectedMonth)
                ->first();

            $budgetAmount = $budget ? $budget->amount : 0;

            $spent = \App\Models\Transaction::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('type', 'expense')
                ->whereMonth('date', $parsedMonth->month)
                ->whereYear('date', $parsedMonth->year)
                ->sum('amount');

            $remaining = $budgetAmount - $spent;
            $percentage = $budgetAmount > 0 ? min(100, ($spent / $budgetAmount) * 100) : 0;

            $numExpenses = \App\Models\Transaction::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('type', 'expense')
                ->whereMonth('date', $parsedMonth->month)
                ->whereYear('date', $parsedMonth->year)
                ->count();

            $category->budget_amount = $budgetAmount;
            $category->spent = $spent;
            $category->remaining = $remaining;
            $category->percentage = $percentage;
            $category->num_expenses = $numExpenses;
        }

        // Income Categories
        $incomeCategories = Category::forUser($userId)
            ->where('type', 'income')
            ->orderBy('name')
            ->get();

        foreach ($incomeCategories as $category) {
            $totalIncome = \App\Models\Transaction::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('type', 'income')
                ->whereMonth('date', $parsedMonth->month)
                ->whereYear('date', $parsedMonth->year)
                ->sum('amount');

            $numTransactions = \App\Models\Transaction::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->where('type', 'income')
                ->whereMonth('date', $parsedMonth->month)
                ->whereYear('date', $parsedMonth->year)
                ->count();

            $category->total_income = $totalIncome;
            $category->num_transactions = $numTransactions;
        }

        return response()->json([
            'status' => 'success',
            'month' => $selectedMonth,
            'data' => [
                'expense_categories' => $expenseCategories,
                'income_categories' => $incomeCategories,
            ]
        ], 200);
    }

    /**
     * POST /api/categories
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $category = Category::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'type' => $validated['type'],
            'description' => $validated['description'] ?? null,
            'color' => $validated['color'] ?? 'green',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    /**
     * GET /api/categories/{category}
     */
    public function show(Category $category)
    {
        $this->authorizeCategory($category);

        return response()->json([
            'status' => 'success',
            'data' => $category
        ], 200);
    }

    /**
     * PUT/PATCH /api/categories/{category}
     */
    public function update(Request $request, Category $category)
    {
        $this->authorizeCategory($category);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);
    }

    /**
     * DELETE /api/categories/{category}
     */
    public function destroy(Category $category)
    {
        $this->authorizeCategory($category);

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully'
        ], 200);
    }

    /**
     * Authorization helper
     */
    private function authorizeCategory(Category $category)
    {
        if ($category->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    }
}