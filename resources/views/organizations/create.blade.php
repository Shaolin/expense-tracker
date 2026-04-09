@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Create New Organization</h1>

    <form action="{{ route('organizations.store') }}" method="POST">
        @csrf
        {{-- <div class="mb-4">
            <label class="block mb-2 font-semibold">Organization Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div> --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Organization Name</label>
            <input 
                type="text" 
                name="name" 
                class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700
                       bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white
                       focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400" 
                required
            >
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Create Organization
        </button>
    </form>
</div>
@endsection