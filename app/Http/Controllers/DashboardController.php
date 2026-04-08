<?php

namespace App\Http\Controllers;


use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $userId = auth()->id();

    // ✅ Month handling (same as categories)
    $selectedMonth = $request->query('month', now()->format('Y-m'));
    $parsedMonth = \Carbon\Carbon::parse($selectedMonth);
    $lastMonth = $parsedMonth->copy()->subMonth();

    // LAST MONTH DATA
$lastIncome = \App\Models\Transaction::where('user_id', $userId)
->where('type', 'income')
->whereMonth('date', $lastMonth->month)
->whereYear('date', $lastMonth->year)
->sum('amount');

$lastExpenses = \App\Models\Transaction::where('user_id', $userId)
->where('type', 'expense')
->whereMonth('date', $lastMonth->month)
->whereYear('date', $lastMonth->year)
->sum('amount');

$lastBalance = $lastIncome - $lastExpenses;

$lastSavingsRate = $lastIncome > 0 
? ($lastBalance / $lastIncome) * 100 
: 0;

function percentChange($current, $previous) {
    if ($previous == 0) return null;

    return (($current - $previous) / $previous) * 100;
}



    // -------------------------
    // 1. TOTALS (STATS)
    // -------------------------
    $totalIncome = \App\Models\Transaction::where('user_id', $userId)
        ->where('type', 'income')
        ->whereMonth('date', $parsedMonth->month)
        ->whereYear('date', $parsedMonth->year)
        ->sum('amount');

    $totalExpenses = \App\Models\Transaction::where('user_id', $userId)
        ->where('type', 'expense')
        ->whereMonth('date', $parsedMonth->month)
        ->whereYear('date', $parsedMonth->year)
        ->sum('amount');

    $balance = $totalIncome - $totalExpenses;

    $savingsRate = $totalIncome > 0 
        ? ($balance / $totalIncome) * 100 
        : 0;


        $incomeChange = percentChange($totalIncome, $lastIncome);
$expenseChange = percentChange($totalExpenses, $lastExpenses);
$balanceChange = percentChange($balance, $lastBalance);
$savingsChange = percentChange($savingsRate, $lastSavingsRate);

function formatChange($value) {
    if ($value === null) return null;

    $sign = $value >= 0 ? '+' : '';
    return $sign . number_format($value, 1) . '% from last month';
}

    // -------------------------
    // 2. STATS ARRAY
    // -------------------------
    $stats = [
        [
            'title' => 'Total Income',
            'amount' => '₦' . number_format($totalIncome, 2),
            'change' => formatChange($incomeChange),
            'positive' => $incomeChange >= 0,
            'color' => 'green',
            'icon' => 'income',
        ],
        [
            'title' => 'Total Expenses',
            'amount' => '₦' . number_format($totalExpenses, 2),
            'change' => formatChange($expenseChange),
            'positive' => $expenseChange <= 0, // 🔥 LESS expense = GOOD
            'color' => 'red',
            'icon' => 'expenses',
        ],
        [
            'title' => 'Current Balance',
            'amount' => '₦' . number_format($balance, 2),
            'change' => formatChange($balanceChange),
            'positive' => $balanceChange >= 0,
            'color' => 'blue',
            'icon' => 'balance',
        ],
        [
            'title' => 'Savings Rate',
            'amount' => number_format($savingsRate, 1) . '%',
            'change' => formatChange($savingsChange),
            'positive' => $savingsChange >= 0,
            'color' => 'purple',
            'icon' => 'savings',
        ],
    ];

    // -------------------------
    // 3. BUDGET + CHART DATA
    // -------------------------
    $budgetItems = \App\Models\Budget::with('category')
        ->where('user_id', $userId)
        ->where('month', $selectedMonth)
        ->get()
        ->map(function ($budget) use ($userId, $parsedMonth) {

            $spent = \App\Models\Transaction::where('user_id', $userId)
                ->where('category_id', $budget->category_id)
                ->where('type', 'expense')
                ->whereMonth('date', $parsedMonth->month)
                ->whereYear('date', $parsedMonth->year)
                ->sum('amount');

            return [
                'name' => $budget->category->name ?? 'Unknown',
                'spent' => $spent,
                'total' => $budget->amount,
                'color' => $budget->category->color ?? 'blue',
            ];
        });

    $chartData = $budgetItems->filter(fn($i) => $i['spent'] > 0)->values();

    // -------------------------
    // 4. RECENT TRANSACTIONS
    // -------------------------
    $transactions = \App\Models\Transaction::with('category')
        ->where('user_id', $userId)
        ->whereMonth('date', $parsedMonth->month)
        ->whereYear('date', $parsedMonth->year)
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($t) {
            return [
                'title' => $t->title,
                'category' => $t->category->name ?? 'Unknown',
                'description' => $t->description ?? '',
                'date' => $t->date->format('M d'),
                'amount' => $t->amount,
                'type' => $t->type,
            ];
        });

    return view('dashboard', compact(
        'stats',
        'budgetItems',
        'chartData',
        'transactions',
        'selectedMonth' // ✅ IMPORTANT
    ));
}
      
         
    
    
    
}
