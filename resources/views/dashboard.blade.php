@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6 bg-black min-h-screen">

    <!-- Header -->
    {{-- <div class="mb-6">
        <h1 class="text-3xl font-bold text-white">Dashboard</h1>
        <p class="text-gray-400">Overview of your financial activity this month</p>
    </div> --}}

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <!-- Title -->
        <div>
            <h1 class="text-3xl font-bold text-white">Dashboard</h1>
            <p class="text-gray-400">Overview of your financial activity</p>
        </div>
    
        <!-- Month Selector -->
        <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-4">
            <label class="text-gray-400 text-sm">Month:</label>
    
            <input 
                type="month" 
                name="month" 
                value="{{ $selectedMonth ?? now()->format('Y-m') }}"
                class="px-3 py-2 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                onchange="this.form.submit()"
            >
        </form>
    
    </div>

    <!-- Top Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($stats as $stat)
            <x-dashboard.stat-card 
                :title="$stat['title']"
                :amount="$stat['amount']"
                :change="$stat['change']"
                :positive="$stat['positive']"
                :color="$stat['color']"
                :icon="$stat['icon']"
            />
        @endforeach
    </div>

    <!-- Charts + Budget -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- <x-dashboard.chart-card :chartData="$chartData" /> --}}
        <x-dashboard.chart-card :data="$chartData" />
       

        <x-dashboard.budget-card :items="$budgetItems" />

    </div>

    <!-- Transactions -->
    <x-dashboard.transactions-card :transactions="$transactions" />

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const chartData = @json($chartData);

// ✅ Ensure numbers are treated as numbers
const totalSpent = chartData.reduce((sum, item) => sum + Number(item.spent), 0);

const ctx = document.getElementById('expenseChart');

if (ctx) {

    // ✅ Center text plugin (fixed)
    const centerTextPlugin = {
        id: 'centerText',
        beforeDraw(chart) {
            const { width, height, ctx } = chart;

            ctx.save(); // ✅ always save first

            const fontSize = (height / 140).toFixed(2);
            ctx.textBaseline = 'middle';
            ctx.textAlign = 'center';

            const text = '₦' + totalSpent.toLocaleString();
            const subText = 'Total Spent';

            // Main text
            ctx.font = `${fontSize}em sans-serif`;
            ctx.fillStyle = '#ffffff';
            ctx.fillText(text, width / 2, height / 2 - 10);

            // Sub text
            ctx.font = `${fontSize * 0.6}em sans-serif`;
            ctx.fillStyle = '#9ca3af';
            ctx.fillText(subText, width / 2, height / 2 + 15);

            ctx.restore(); // ✅ restore after drawing
        }
    };

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartData.map(i => i.name),
            datasets: [{
                data: chartData.map(i => Number(i.spent)),
                backgroundColor: chartData.map(i => {
                    switch(i.color){
                        case 'green': return '#22c55e';
                        case 'red': return '#ef4444';
                        case 'blue': return '#3b82f6';
                        case 'purple': return '#8b5cf6';
                        case 'pink': return '#ec4899';
                        case 'cyan': return '#06b6d4';
                        case 'yellow': return '#f59e0b';
                        default: return '#3b82f6';
                    }
                }),
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,              // ✅ important
            maintainAspectRatio: false,    // ✅ important
            cutout: '75%',                 // nicer look
            plugins: {
                legend: { display: false }
            }
        },
        plugins: [centerTextPlugin] // 🔥 THIS WAS MISSING
    });
}
</script>
@endpush