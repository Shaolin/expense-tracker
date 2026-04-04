@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white">Add Category</h1>
        <p class="text-gray-400">Create a new category</p>
    </div>

    <!-- Form -->
    @if ($errors->any())
    <div class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded-lg">
        <ul class="text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
    <form action="{{ route('categories.store') }}" method="POST" 
          class="space-y-6 p-6 border border-gray-700 rounded-2xl">

        @csrf

        <!-- Category Name -->
        <div>
            <label class="text-sm text-gray-400">Category Name</label>
            <input 
                type="text" 
                name="name"
                value="{{ old('name') }}"
                class="w-full mt-1 p-2 border border-gray-600 rounded-lg bg-transparent text-white focus:ring-2 focus:ring-green-500"
                placeholder="e.g. Food & Dining"
                required
            >
            @error('name')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="text-sm text-gray-400">Description</label>
            <input 
                type="text" 
                name="description"
                value="{{ old('description') }}"
                class="w-full mt-1 p-2 border border-gray-600 rounded-lg bg-transparent text-white focus:ring-2 focus:ring-green-500"
                placeholder="Short description (optional)"
            >
        </div>

        <!-- Type -->
        <div>
            <label class="text-sm text-gray-400">Type</label>
          
            <select 
            name="type"
            class="w-full mt-1 p-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring-2 focus:ring-green-500"
        >
            <option value="" class="bg-gray-800 text-white">Select type</option>
            <option value="expense" class="bg-gray-800 text-white">Expense</option>
            <option value="income" class="bg-gray-800 text-white">Income</option>
        </select>

            @error('type')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Budget -->
        {{-- <div>
            <label class="text-sm text-gray-400">Monthly Budget</label>
            <input 
                type="number" 
                step="0.01"
                name="budget"
                value="{{ old('budget') }}"
                class="w-full mt-1 p-2 border border-gray-600 rounded-lg bg-transparent text-white focus:ring-2 focus:ring-green-500"
                placeholder="e.g. 500"
            >
        </div> --}}

        <!-- Color (for your cards) -->
        <div>
            <label class="text-sm text-gray-400">Color</label>
            <select 
    name="color"
    class="w-full mt-1 p-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring-2 focus:ring-green-500"
>
    <option value="" class="bg-gray-800 text-white">Select color</option>
    <option value="green" class="bg-gray-800 text-white">Green</option>
    <option value="blue" class="bg-gray-800 text-white">Blue</option>
    <option value="yellow" class="bg-gray-800 text-white">Yellow</option>
    <option value="purple" class="bg-gray-800 text-white">Purple</option>
    <option value="pink" class="bg-gray-800 text-white">Pink</option>
    <option value="cyan" class="bg-gray-800 text-white">Cyan</option>
</select>
        </div>

        <!-- Actions -->
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('categories.index') }}" class="text-gray-400 text-sm">
                ← Back
            </a>

            <button 
                type="submit"
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition"
            >
                Save Category
            </button>
        </div>
    </form>
</div>
@endsection