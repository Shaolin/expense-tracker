@extends('layouts.app')

@section('content')
<script src="//unpkg.com/alpinejs" defer></script>
<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                Expenses
            </h1>
            <p class="text-sm text-gray-500">
                Manage and track all your expenses
            </p>
        </div>

    

        <x-button.primary onclick="window.location='{{ route('expenses.create') }}'">
            + Add Expense
        </x-button.primary>
    </div>

    <!-- Filters -->
    <form method="GET" action="{{ route('expenses.index') }}">
        <div class="bg-white dark:bg-gray-900 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">
    
            <!-- Search -->
            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by description or category..."
                class="w-full md:w-1/3 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-green-500 outline-none"
            >
    
            <!-- Filters -->
            <div class="flex gap-3">
    
                <!-- Category -->
                <select name="category_id" 
                    class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
                    bg-white dark:bg-gray-800 
                    text-gray-700 dark:text-gray-200
                    focus:ring-2 focus:ring-green-500 focus:outline-none">
    
                    <option value="">All Categories</option>
    
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
    
                <!-- Date -->
                <input 
                    type="date" 
                    name="date"
                    value="{{ request('date') }}"
                    class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent"
                >
    
                <!-- Submit -->
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg">
                    Filter
                </button>
                <a href="{{ route('expenses.index') }}" 
   class="px-4 py-2 bg-gray-500 text-white rounded-lg">
    Reset
</a>
               <!-- Month Picker -->
               <input 
               type="month" 
               name="month"
               value="{{ request('month', now()->format('Y-m')) }}"
               class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent"
               >
    
            </div>
        </div>
    </form>
    </div>

    <!-- Table -->
    <x-table>
       
        <x-slot name="head">
            <th class="px-6 py-3">Date</th>
            <th class="px-6 py-3">Category</th>
            <th class="px-6 py-3">Description</th>
            <th class="px-6 py-3 text-right">Amount</th>
            <th class="px-6 py-3"></th>
        </x-slot>

        <x-slot name="body">
            @forelse($transactions as $transaction)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    
                    <!-- Date -->
                    <td class="px-6 py-4">
                        {{ $transaction->date->format('M d, Y') }}
                    </td>
        
                    <!-- Category -->
                    {{-- <td class="px-6 py-4">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            {{ $transaction->category->name }}
                        </span>
                    </td> --}}
                    @php
$colors = [
    'green' => '34,197,94',
    'blue' => '59,130,246',
    'yellow' => '234,179,8',
    'purple' => '168,85,247',
    'pink' => '236,72,153',
    'cyan' => '6,182,212',
    'red' => '239,68,68',
];

$rgb = $colors[$transaction->category->color] ?? '34,197,94';
@endphp

<td class="px-6 py-4">
    <span class="flex items-center gap-2">
        <span class="w-2 h-2 rounded-full"
              style="background-color: rgba({{ $rgb }}, 1);">
        </span>

        {{ $transaction->category->name }}
    </span>
</td>
        
                    <!-- Description -->
                    <td class="px-6 py-4">
                        {{ $transaction->description ?? '—' }}
                    </td>
        
                    <!-- Amount -->
                    <td class="px-6 py-4 text-right font-medium">
                      
                        {{-- ₦{{ number_format($transaction->amount, 2) }} --}}
                        {{ money($transaction->amount, 2) }}
                    </td>
        
                    <td class="px-6 py-4 text-right">
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                        
                            <!-- Dropdown -->
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                                        ⋮
                                    </button>
                                </x-slot>
                            
                                <x-slot name="content">
                                    <a href="{{ route('expenses.edit', $transaction) }}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Edit
                                    </a>
                            
                                    <form action="{{ route('expenses.destroy', $transaction) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this expense?')">
                                  @csrf
                                  @method('DELETE')
                              
                                  <button type="submit"
                                      class="block w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">
                                      Delete
                                  </button>
                              </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-500">
                        No expenses found
                    </td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>
    {{-- paginations --}}
    <div>
        {{ $transactions->links() }}
    </div>

    <!-- Empty State -->
    <div class="hidden text-center py-16 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl">
        <p class="text-gray-500 mb-4">No expenses found</p>
        <x-button.primary>
            Add your first expense
        </x-button.primary>
    </div>

</div>
@endsection