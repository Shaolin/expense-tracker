@extends('layouts.app')

@section('content')
<div class="p-6 max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold">Edit Income</h1>

    <form action="{{ route('income.update', $transaction) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="number" step="0.01" name="amount"
               value="{{ $transaction->amount }}"
               class="w-full p-3 border border-gray-300 dark:border-gray-700 
               bg-white dark:bg-gray-800 
               text-gray-900 dark:text-gray-100
               rounded-lg 
               focus:ring-2 focus:ring-green-500 focus:outline-none">

        <select name="category_id"  class="w-full p-3 border border-gray-300 dark:border-gray-700 
        bg-white dark:bg-gray-800 
        text-gray-900 dark:text-gray-100
        rounded-lg 
        focus:ring-2 focus:ring-green-500 focus:outline-none">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <input type="text" name="description"
               value="{{ $transaction->description }}"
               class="w-full p-3 border border-gray-300 dark:border-gray-700 
               bg-white dark:bg-gray-800 
               text-gray-900 dark:text-gray-100
               rounded-lg 
               focus:ring-2 focus:ring-green-500 focus:outline-none">

        <input type="date" name="date"
               value="{{ $transaction->date }}"
               class="w-full p-3 border border-gray-300 dark:border-gray-700 
               bg-white dark:bg-gray-800 
               text-gray-900 dark:text-gray-100
               rounded-lg 
               focus:ring-2 focus:ring-green-500 focus:outline-none">

        <button class="w-full bg-blue-600 text-white py-3 rounded-lg">
            Update Income
        </button>
    </form>

</div>
@endsection