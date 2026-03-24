@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6 bg-black min-h-screen">

     <!-- Header -->
     <div class="mb-6">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="text-gray-400">Overview of your financial activity this month</p>
    </div>

    <!-- Top Stat Cards -->
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-dashboard.stat-card 
        title="Total Income" 
        amount="$5,725.00" 
        change="+12.5% from last month"
        color="green"
        icon="income"
        />

        <x-dashboard.stat-card 
        title="Total Expenses" 
        amount="$1,073.02" 
        change="-8.2% from last month"
        :positive="false"
        color="red"
        icon="expenses"
        />

        <x-dashboard.stat-card 
        title="Current Balance" 
        amount="$4,651.98"
        color="blue"
        icon="balance"
        />

        <x-dashboard.stat-card 
        title="Savings Rate" 
        amount="81%" 
        change="+5.3% improvement"
        color="purple"
        icon="savings"
        />
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-dashboard.chart-card />

        <x-dashboard.budget-card 
            :items="[
                ['name' => 'Food & Dining', 'spent' => 268, 'total' => 800, 'color' => 'green'],
                ['name' => 'Transportation', 'spent' => 192, 'total' => 400, 'color' => 'blue'],
                ['name' => 'Utilities', 'spent' => 205, 'total' => 300, 'color' => 'yellow'],
                ['name' => 'Entertainment', 'spent' => 136, 'total' => 200, 'color' => 'purple'],
                ['name' => 'Shopping', 'spent' => 219, 'total' => 500, 'color' => 'pink'],
                ['name' => 'Healthcare', 'spent' => 53, 'total' => 250, 'color' => 'cyan'],
            ]"
        />
    </div>

    <!-- Transactions Section -->
<x-dashboard.transactions-card 
:transactions="[
    ['title' => 'Lunch delivery', 'category' => 'Food & Dining', 'date' => 'Mar 14', 'amount' => 24.99, 'type' => 'expense'],
    ['title' => 'Weekly grocery shopping', 'category' => 'Food & Dining', 'date' => 'Mar 13', 'amount' => 156.42, 'type' => 'expense'],
    ['title' => 'Gas station fill-up', 'category' => 'Transportation', 'date' => 'Mar 13', 'amount' => 52.30, 'type' => 'expense'],
    ['title' => 'Credit card rewards', 'category' => 'Cashback', 'date' => 'Mar 13', 'amount' => 50.00, 'type' => 'income'],
    ['title' => 'Electric bill', 'category' => 'Utilities', 'date' => 'Mar 12', 'amount' => 124.89, 'type' => 'expense'],
    ['title' => 'Netflix subscription', 'category' => 'Entertainment', 'date' => 'Mar 11', 'amount' => 15.99, 'type' => 'expense'],
    ['title' => 'Etsy sales', 'category' => 'Side Business', 'date' => 'Mar 11', 'amount' => 200.00, 'type' => 'income'],
    ['title' => 'New running shoes', 'category' => 'Shopping', 'date' => 'Mar 10', 'amount' => 129.00, 'type' => 'expense'],
]"

/>

</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('expenseChart');

if (ctx) {
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'Food & Dining',
                'Transportation',
                'Utilities',
                'Entertainment',
                'Shopping',
                'Healthcare'
            ],
            datasets: [{
                data: [268, 192, 205, 136, 219, 53],
                backgroundColor: [
                    '#22c55e',
                    '#3b82f6',
                    '#f59e0b',
                    '#8b5cf6',
                    '#ec4899',
                    '#06b6d4'
                ],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}
</script>
@endpush

