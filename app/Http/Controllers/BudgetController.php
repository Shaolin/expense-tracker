<?php


namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    

    public function index()
{
    $budgets = \App\Models\Budget::with('category')
        ->where('user_id', auth()->id())
        ->get();

    $totalBudget = $budgets->sum('amount');

    $totalSpent = 0;

    foreach ($budgets as $budget) {
        $spent = \App\Models\Transaction::where('user_id', auth()->id())
            ->where('category_id', $budget->category_id)
            ->where('type', 'expense')
            ->whereMonth('date', \Carbon\Carbon::parse($budget->month)->month)
            ->whereYear('date', \Carbon\Carbon::parse($budget->month)->year)
            ->sum('amount');

        $budget->spent = $spent;
        $budget->percentage = $budget->amount > 0 
            ? min(100, ($spent / $budget->amount) * 100)
            : 0;

        $totalSpent += $spent;
    }

    $remaining = $totalBudget - $totalSpent;

    return view('budgets.index', compact(
        'budgets',
        'totalBudget',
        'totalSpent',
        'remaining'
    ));
}


    /**
     * Show form to create budget
     */
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();

        return view('budgets.create', compact('categories'));
    }
    
    /**
     * Store new budget
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0',
            'month'       => 'required|string',
        ]);

        // Prevent duplicate (user + category + month)
        $existing = Budget::where('user_id', Auth::id())
            ->where('category_id', $request->category_id)
            ->where('month', $request->month)
            ->first();

        if ($existing) {
            return back()->withErrors([
                'category_id' => 'Budget already exists for this category and month.'
            ])->withInput();
        }

        Budget::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'amount'      => $request->amount,
            'month'       => $request->month,
        ]);

        return redirect()->route('budgets.index')
            ->with('success', 'Budget created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Budget $budget)
    {
        $this->authorizeBudget($budget);

        $categories = Category::where('user_id', Auth::id())->get();

        return view('budgets.edit', compact('budget', 'categories'));
    }
 

    /**
     * Update budget
     */
    public function update(Request $request, Budget $budget)
    {
        $this->authorizeBudget($budget);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0',
            'month'       => 'required|string',
        ]);

        // Prevent duplicate except current record
        $existing = Budget::where('user_id', Auth::id())
            ->where('category_id', $request->category_id)
            ->where('month', $request->month)
            ->where('id', '!=', $budget->id)
            ->first();

        if ($existing) {
            return back()->withErrors([
                'category_id' => 'Another budget already exists for this category and month.'
            ])->withInput();
        }

        $budget->update([
            'category_id' => $request->category_id,
            'amount'      => $request->amount,
            'month'       => $request->month,
        ]);

        return redirect()->route('budgets.index')
            ->with('success', 'Budget updated successfully.');
    }

    /**
     * Delete budget
     */
    public function destroy(Budget $budget)
    {
        $this->authorizeBudget($budget);

        $budget->delete();

        return redirect()->route('budgets.index')
            ->with('success', 'Budget deleted successfully.');
    }

    /**
     * Simple authorization (security 🔒)
     */
    private function authorizeBudget(Budget $budget)
    {
        if ($budget->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}