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

        @forelse($categories as $category)
            
            <x-category.card 
    :category="$category"
    :name="$category->name"
    :description="$category->description"
    :color="$category->color"
    :expenses="0"
    :amount="'₦0'"
    :percent="0"
    :budget="'₦' . number_format($category->budget ?? 0, 2)"
/>
        @empty
            <div class="col-span-full text-center py-10 text-gray-500">
                No categories yet.
            </div>
        @endforelse
    
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


   
    @if(session('success'))
    <div class="text-green-400 text-sm">
        {{ session('success') }}
    </div>
@endif
</div>
@endsection