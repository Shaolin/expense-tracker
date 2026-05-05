@props(['data' => []])


    {{-- <div class="bg-gray-900 rounded-2xl p-6 shadow-lg text-white"> --}}
    <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white rounded-2xl p-6 shadow-lg text-white">
    <h3 class="text-lg font-semibold mb-4">Expenses by Category</h3>

    <div class="flex flex-col lg:flex-row items-center justify-center gap-6">
        
            
             
                <!-- Chart (centered properly) -->
                <div class="flex justify-center w-full lg:w-auto">
                    <div class="w-72 h-72">
                        <canvas id="expenseChart"></canvas>
                    </div>
                </div>

       
        <div class="space-y-2 text-sm">
            @foreach($data as $item)
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-{{ $item['color'] }}-500 rounded-full"></span>
                    {{ $item['name'] }}
                </div>
            @endforeach
        </div>
    </div>
</div>



@props(['items' => []])

<div class="bg-gray-900 rounded-2xl p-6 shadow-lg text-white">
    <h3 class="text-lg font-semibold mb-4">Budget Status</h3>

    <div class="space-y-4">
        @foreach($items as $item)
        @php
            $spent = (float) $item['spent'];
            $total = (float) $item['total'];
            $hasBudget = $total > 0;
            $percentage = $hasBudget ? min(($spent/$total)*100,100) : 0;
            $overBudget = $hasBudget && $spent > $total;
        @endphp

        <div>
            <div class="flex justify-between text-sm mb-1">
                <span class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-{{ $item['color'] }}-500"></span>
                    {{ $item['name'] }}
                </span>
                <span class="text-gray-400">
                    {{-- ₦{{ number_format($spent, 2) }} --}}
                    {{ money($spent, 2) }}
                    @if($hasBudget)
                        {{-- / ₦{{ number_format($total, 2) }} --}}
                      /  {{ money($total, 2) }}
                    @else
                        <span class="text-yellow-400 text-xs">(No budget set)</span>
                    @endif
                </span>
            </div>

            @if($hasBudget)
            <div class="w-full bg-gray-700 h-2 rounded-full">
                <div class="h-2 rounded-full 
                    {{ $overBudget ? 'bg-red-500' : 'bg-' . $item['color'] . '-500' }}"
                    style="width: {{ $percentage }}%">
                </div>
            </div>
            {{-- <p class="text-xs mt-1 {{ $overBudget ? 'text-red-400' : 'text-gray-400' }}">
                {{ $overBudget 
                    ? 'Over budget by ₦' . number_format($spent - $total, 2)
                    : '₦' . number_format($total - $spent, 2) . ' remaining'
                }}
            </p> --}}
            <p class="text-xs mt-1 {{ $overBudget ? 'text-red-400' : 'text-gray-400' }}">
                @if ($overBudget)
                    Over budget by {{ money($spent - $total, 2) }}
                @else
                    {{ money($total - $spent, 2) }} remaining
                @endif
            </p>
            @endif
        </div>
        @endforeach
    </div>
</div>

<div class="flex flex-wrap items-center gap-3">
    <a href="{{ route('income.index', array_merge(request()->except('page'), ['month' => $prevMonth])) }}"
       class="px-3 py-1 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-white rounded-lg">
        ←
    </a>

    <span class="text-sm md:text-base text-gray-800 dark:text-gray-200 font-semibold">
        {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}
    </span>

    <a href="{{ route('income.index', array_merge(request()->except('page'), ['month' => $nextMonth])) }}"
       class="px-3 py-1 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-white rounded-lg">
        →
    </a>
</div>


<!-- dashboard -->

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

//  Pass currency symbol from Laravel
const currencySymbol = "{{ currency_symbol() }}";

//  Ensure numbers are treated as numbers
const totalSpent = chartData.reduce((sum, item) => sum + Number(item.spent), 0);

const ctx = document.getElementById('expenseChart');

if (ctx) {

    //  Center text plugin (fixed)
    const centerTextPlugin = {
        id: 'centerText',
        beforeDraw(chart) {
            const { width, height, ctx } = chart;

            ctx.save();

            const fontSize = (height / 140).toFixed(2);
            ctx.textBaseline = 'middle';
            ctx.textAlign = 'center';

            //  Dynamic currency
            const text = currencySymbol + totalSpent.toLocaleString();
            const subText = 'Total Spent';

            // Main text
            ctx.font = `${fontSize}em sans-serif`;
            ctx.fillStyle = '#ffffff';
            ctx.fillText(text, width / 2, height / 2 - 10);

            // Sub text
            ctx.font = `${fontSize * 0.6}em sans-serif`;
            ctx.fillStyle = '#9ca3af';
            ctx.fillText(subText, width / 2, height / 2 + 15);

            ctx.restore();
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
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { display: false }
            }
        },
        plugins: [centerTextPlugin]
    });
}
</script>
@endpush