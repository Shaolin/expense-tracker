@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Categories</h1>
            <p class="text-gray-400">Manage your expense categories and budgets</p>
        </div>

        <button @click="openModal = true"
            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
            + Add Category
        </button>
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


    <!-- MODAL -->
    <div x-data="{ openModal: false, openEditModal: false }">
        <div x-show="openModal || openEditModal"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">

            <div class="bg-gray-900 rounded-xl w-full max-w-md p-6 space-y-4">

                <h2 class="text-white text-lg font-semibold"
                    x-text="openModal ? 'Add Category' : 'Edit Category'"></h2>

                <form class="space-y-4">

                    <div>
                        <label class="text-sm text-gray-400">Name</label>
                        <input type="text"
                            class="w-full mt-1 bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                    </div>

                    <div>
                        <label class="text-sm text-gray-400">Description</label>
                        <input type="text"
                            class="w-full mt-1 bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                    </div>

                    <div>
                        <label class="text-sm text-gray-400">Budget</label>
                        <input type="number"
                            class="w-full mt-1 bg-gray-800 border border-gray-700 rounded-lg p-2 text-white">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button"
                            @click="openModal = false; openEditModal = false"
                            class="px-4 py-2 bg-gray-700 text-white rounded-lg">
                            Cancel
                        </button>

                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg">
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>
@endsection