@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                Income
            </h1>
            <p class="text-sm text-gray-500">
                Manage and track all your income
            </p>
        </div>

        <x-button.primary class="bg-green-600 hover:bg-green-700">
            + Add Income
        </x-button.primary>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-900 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

        <!-- Search -->
        <input 
            type="text" 
            placeholder="Search by description or source..."
            class="w-full md:w-1/3 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-green-500 outline-none"
        >

        <!-- Filter -->
        <div class="flex gap-3">
            <select class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
               bg-white dark:bg-gray-800 
               text-gray-700 dark:text-gray-200
               focus:ring-2 focus:ring-green-500 focus:outline-none">
                <option>All Sources</option>
                <option>Salary</option>
                <option>Freelance</option>
                <option>Dividends</option>
                <option>Side Business</option>
                <option>Cashback</option>
            </select>

            <input type="date" class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent">
        </div>
    </div>

    <!-- Table -->
    <x-table>
        <x-slot name="head">
            <th class="px-6 py-3">Date</th>
            <th class="px-6 py-3">Source</th>
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
                        Salary
                    </span>
                </td>
                <td class="px-6 py-4">Monthly salary payment</td>
                <td class="px-6 py-4 text-right font-medium text-green-500">+$4,500.00</td>
                <td class="px-6 py-4 text-right">
                    <x-dropdown />
                </td>
            </tr>

            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                <td class="px-6 py-4">Mar 11, 2026</td>
                <td class="px-6 py-4">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        Side Business
                    </span>
                </td>
                <td class="px-6 py-4">Etsy sales</td>
                <td class="px-6 py-4 text-right font-medium text-green-500">+$200.00</td>
                <td class="px-6 py-4 text-right">
                    <x-dropdown />
                </td>
            </tr>

        </x-slot>
    </x-table>

    <!-- Empty State -->
    <div class="hidden text-center py-16 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl">
        <p class="text-gray-500 mb-4">No income records found</p>
        <x-button.primary class="bg-green-600 hover:bg-green-700">
            Add your first income
        </x-button.primary>
    </div>

</div>
@endsection