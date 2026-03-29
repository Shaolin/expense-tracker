@extends('layouts.app')

@section('content')
<div class="p-6 max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold">Add Income</h1>

    <form action="{{ route('income.store') }}" method="POST" class="space-y-4">
        @if ($errors->any())
    <div class="bg-red-100 text-red-600 p-3 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        @csrf

        <input type="number" step="0.01" name="amount" placeholder="Amount"
        class="w-full p-3 border border-gray-300 dark:border-gray-700 
        bg-white dark:bg-gray-800 
        text-gray-900 dark:text-gray-100
        rounded-lg 
        focus:ring-2 focus:ring-green-500 focus:outline-none">

        <select name="category_id" class="w-full p-3 border border-gray-300 dark:border-gray-700 
        bg-white dark:bg-gray-800 
        text-gray-900 dark:text-gray-100
        rounded-lg 
        focus:ring-2 focus:ring-green-500 focus:outline-none">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <input type="text" name="description" placeholder="Description"
        class="w-full p-3 border border-gray-300 dark:border-gray-700 
        bg-white dark:bg-gray-800 
        text-gray-900 dark:text-gray-100
        rounded-lg 
        focus:ring-2 focus:ring-green-500 focus:outline-none">

        <input type="date" name="date"
        class="w-full p-3 border border-gray-300 dark:border-gray-700 
        bg-white dark:bg-gray-800 
        text-gray-900 dark:text-gray-100
        rounded-lg 
        focus:ring-2 focus:ring-green-500 focus:outline-none">

        <button type="submit"  class="w-full bg-green-600 text-white py-3 rounded-lg">
            Save Income
        </button>
    </form>

</div>
@endsection