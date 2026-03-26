<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index()
    {
        $categories = Category::forUser(auth()->id())
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }
      /**
     *  Create category
     */
    public function create()
{
    return view('categories.create');
}

/**
     *  edit category
     */
public function edit(Category $category)
{
    // Prevent editing shared categories
    if ($category->user_id !== auth()->id()) {
        abort(403);
    }

    return view('categories.edit', compact('category'));
}

    /**
     * Store a newly created category
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|in:income,expense',
        'description' => 'nullable|string',
        'budget' => 'nullable|numeric',
        'color' => 'nullable|string',
    ]);

    Category::create([
        'user_id' => auth()->id(),
        'name' => $validated['name'],
        'type' => $validated['type'],
        'description' => $validated['description'] ?? null,
        'budget' => $validated['budget'] ?? null,
        'color' => $validated['color'] ?? 'green',
    ]);

    return redirect()->route('categories.index')
        ->with('success', 'Category created successfully.');
}

    /**
     * Update the specified category
     */
    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'color' => 'nullable|string',
        ]);
    
        $category->update($validated);
    
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category
     */
    public function destroy(Category $category)
    {
        // Prevent deleting shared categories
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        $category->delete();

      

        return redirect()->route('categories.index')
        ->with('success', 'Category deleted successfully.');
        
    }
}

