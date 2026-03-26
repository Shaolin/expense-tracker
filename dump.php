@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Categories</h1>
            <p class="text-gray-400">Manage your expense categories and budgets</p>
        </div>

        <a href="{{ route('categories.create') }}"
   class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition inline-block">
    + Add Category
</a>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        <x-category.card 
            name="Food & Dining"
            description="Restaurants, groceries, and food delivery"
            color="green"
            expenses="4"
            amount="$268"
            percent="34"
            budget="$800"
        />
    
        <x-category.card 
            name="Transportation"
            description="Gas, public transit, and rideshare"
            color="blue"
            expenses="3"
            amount="$192"
            percent="48"
            budget="$400"
        />
    
        <x-category.card 
            name="Utilities"
            description="Electricity, water, internet, and phone"
            color="yellow"
            expenses="2"
            amount="$205"
            percent="68"
            budget="$300"
        />
    
        <x-category.card 
            name="Entertainment"
            description="Movies, games, subscriptions, and hobbies"
            color="purple"
            expenses="2"
            amount="$136"
            percent="68"
            budget="$200"
        />
    
        <x-category.card 
            name="Shopping"
            description="Clothing, electronics, and personal items"
            color="pink"
            expenses="2"
            amount="$219"
            percent="44"
            budget="$500"
        />
    
        <x-category.card 
            name="Healthcare"
            description="Medical, dental, and pharmacy expenses"
            color="cyan"
            expenses="2"
            amount="$53"
            percent="21"
            budget="$250"
        />
    
    </div>

    <!-- EMPTY STATE -->
    {{--
    <div class="text-center py-20">
        <p class="text-gray-500">No categories yet</p>
        <button @click="openModal = true"
            class="mt-4 px-4 py-2 bg-green-500 text-white rounded-lg">
            Add Category
        </button>
    </div>
    --}}


   

</div>
@endsection


 <!-- update method in the categorycontroller -->

 public function update(Request $request, Category $category)
    {
        // Prevent editing shared categories (optional but recommended)
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
        ]);

        $category->update($validated);

        return back()->with('success', 'Category updated successfully.');
    }