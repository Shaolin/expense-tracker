@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6" x-data="{ openModal: false }">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Budget</h1>
            <p class="text-sm text-gray-500">Manage your spending limits by category</p>
        </div>

        <button 
            @click="openModal = true"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl shadow">
            + Set Budget
        </button>
    </div>

    <!-- ===================== -->
    <!-- Budget List -->
    <!-- ===================== -->

    @php
        // Dummy data (UI only)
        $budgets = [
            [
                'category' => 'Food & Dining',
                'budget' => 50000,
                'spent' => 35000,
            ],
            [
                'category' => 'Transportation',
                'budget' => 30000,
                'spent' => 28000,
            ],
            [
                'category' => 'Shopping',
                'budget' => 20000,
                'spent' => 25000,
            ],
        ];
    @endphp

    @if(count($budgets) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($budgets as $item)
                @php
                    $remaining = $item['budget'] - $item['spent'];
                    $percentage = min(100, ($item['spent'] / $item['budget']) * 100);

                    $color = 'green';
                    if ($percentage >= 80 && $percentage < 100) $color = 'yellow';
                    if ($percentage >= 100) $color = 'red';
                @endphp

                <x-budget.card 
                    :category="$item['category']"
                    :budget="$item['budget']"
                    :spent="$item['spent']"
                    :remaining="$remaining"
                    :percentage="$percentage"
                    :color="$color"
                />
            @endforeach

        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow p-10 text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">No Budgets Yet</h3>
            <p class="text-sm text-gray-500 mb-4">Start by setting a budget for your categories</p>

            <button 
                @click="openModal = true"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl">
                Set Your First Budget
            </button>
        </div>
    @endif

    <!-- ===================== -->
    <!-- Modal -->
    <!-- ===================== -->

    <x-budget.modal />

</div>
@endsection