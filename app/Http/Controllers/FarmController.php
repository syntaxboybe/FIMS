<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farms = Auth::user()->farms()->latest()->get();
        return view('farmer.farms.index', compact('farms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('farmer.farms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $farm = Auth::user()->farms()->create($validated);

        return redirect()->route('farmer.farms.show', $farm)
            ->with('success', 'Farm created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Farm $farm)
    {
        $this->authorize('view', $farm);

        $livestock = $farm->livestock()->with('category')->latest()->take(5)->get();
        $livestockCount = $farm->livestock()->count();

        return view('farmer.farms.show', compact('farm', 'livestock', 'livestockCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farm $farm)
    {
        $this->authorize('update', $farm);

        return view('farmer.farms.edit', compact('farm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farm $farm)
    {
        $this->authorize('update', $farm);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $farm->update($validated);

        return redirect()->route('farmer.farms.show', $farm)
            ->with('success', 'Farm updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {
        $this->authorize('delete', $farm);

        $farm->delete();

        return redirect()->route('farmer.farms.index')
            ->with('success', 'Farm deleted successfully.');
    }
}
