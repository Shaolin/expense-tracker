<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function create()
    {
        return view('organizations.create'); // Blade form
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:organizations,name',
        ]);

        $org = Organization::create([
            'name' => $request->name,
            'is_personal' => false,
        ]);

        // Attach user as admin
        Auth::user()->organizations()->attach($org->id, [
            'role' => 'admin'
        ]);

        // Optionally set as current org in session
        session(['organization_id' => $org->id]);

        return redirect()->route('dashboard')
                         ->with('success', 'Organization created successfully!');
    }
    public function switch(Request $request)
{
    $request->validate([
        'organization_id' => 'required|exists:organizations,id',
    ]);

    $user = $request->user();

    // Ensure user belongs to the selected org
    
    if (!$user->organizations()->where('organizations.id', $request->organization_id)->exists()) {
        abort(403, 'You do not belong to this organization.');
    }

    // Set selected org in session
    session(['organization_id' => $request->organization_id]);

    return redirect()->back()->with('success', 'Switched workspace successfully!');
}
}