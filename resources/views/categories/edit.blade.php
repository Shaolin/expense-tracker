@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold text-white">Edit Category</h1>

    <form action="{{ route('categories.update', $category) }}" method="POST"
          class="space-y-6 p-6 border border-gray-700 rounded-2xl">

        @csrf
        @method('PUT')

        <!-- Name -->
        <input type="text" name="name" value="{{ $category->name }}"
            class="w-full p-2 border border-gray-600 rounded-lg bg-gray-800 text-white">

        <!-- Description -->
        <input type="text" name="description" value="{{ $category->description }}"
            class="w-full p-2 border border-gray-600 rounded-lg bg-gray-800 text-white">

        <!-- Type -->
        <select name="type"
            class="w-full p-2 border border-gray-600 rounded-lg bg-gray-800 text-white">
            <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Expense</option>
            <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Income</option>
        </select>

        <!-- Budget -->
        <input type="number" name="budget" value="{{ $category->budget }}"
            class="w-full p-2 border border-gray-600 rounded-lg bg-gray-800 text-white">

        <!-- Color -->
        <select name="color"
            class="w-full p-2 border border-gray-600 rounded-lg bg-gray-800 text-white">
            <option value="green" {{ $category->color == 'green' ? 'selected' : '' }}>Green</option>
            <option value="blue" {{ $category->color == 'blue' ? 'selected' : '' }}>Blue</option>
            <option value="yellow" {{ $category->color == 'yellow' ? 'selected' : '' }}>Yellow</option>
            <option value="purple" {{ $category->color == 'purple' ? 'selected' : '' }}>Purple</option>
            <option value="pink" {{ $category->color == 'pink' ? 'selected' : '' }}>Pink</option>
            <option value="cyan" {{ $category->color == 'cyan' ? 'selected' : '' }}>Cyan</option>
        </select>

        <div class="flex justify-between">
            <a href="{{ route('categories.index') }}" class="text-gray-400">← Back</a>

            <button class="bg-green-500 px-4 py-2 rounded-lg text-white">
                Update
            </button>
        </div>

    </form>
</div>
@endsection