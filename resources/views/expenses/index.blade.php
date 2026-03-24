@extends('layouts.app')

@section('content')
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

        <x-button.primary>
            + Add Expense
        </x-button.primary>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-900 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

        <!-- Search -->
        <input 
            type="text" 
            placeholder="Search by description or category..."
            class="w-full md:w-1/3 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-green-500 outline-none"
        >

        <!-- Filter -->
        <div class="flex gap-3">
            <select class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
               bg-white dark:bg-gray-800 
               text-gray-700 dark:text-gray-200
               focus:ring-2 focus:ring-green-500 focus:outline-none">
                <option>All Categories</option>
                <option>Food</option>
                <option>Transport</option>
                <option>Utilities</option>
            </select>

            <input type="date" class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent">
        </div>
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
            <!-- Example Row -->
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                <td class="px-6 py-4">Mar 13, 2026</td>
                <td class="px-6 py-4">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        Food & Dining
                    </span>
                </td>
                <td class="px-6 py-4">Weekly grocery shopping</td>
                <td class="px-6 py-4 text-right font-medium">$156.42</td>
                <td class="px-6 py-4 text-right">
                    <x-dropdown />
                </td>
            </tr>
        
            <tr>
                <td class="px-6 py-4">Mar 12, 2026</td>
                <td class="px-6 py-4">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                        Utilities
                    </span>
                </td>
                <td class="px-6 py-4">Electric bill</td>
                <td class="px-6 py-4 text-right font-medium">$124.89</td>
                <td class="px-6 py-4 text-right">
                    <x-dropdown />
                </td>
            </tr>
        </x-slot>
    </x-table>

    <!-- Empty State -->
    <div class="hidden text-center py-16 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl">
        <p class="text-gray-500 mb-4">No expenses found</p>
        <x-button.primary>
            Add your first expense
        </x-button.primary>
    </div>

</div>
@endsection