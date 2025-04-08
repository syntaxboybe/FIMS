<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use App\Models\LivestockCategory;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class LivestockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Livestock::query()
            ->whereHas('farm', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['farm', 'category']);

        // Filter by farm if provided
        if ($request->has('farm_id')) {
            $query->where('farm_id', $request->farm_id);
            $farm = Farm::findOrFail($request->farm_id);
            $this->authorize('view', $farm);
        }

        // Filter by category if provided
        if ($request->has('category_id')) {
            $query->where('livestock_category_id', $request->category_id);
        }

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $livestock = $query->latest()->paginate(10);
        $farms = Auth::user()->farms;
        $categories = LivestockCategory::all();

        return view('farmer.livestock.index', compact('livestock', 'farms', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farms = Auth::user()->farms;
        $categories = LivestockCategory::all();

        if ($farms->isEmpty()) {
            return redirect()->route('farmer.farms.create')
                ->with('error', 'You need to create a farm first before adding livestock.');
        }

        return view('farmer.livestock.create', compact('farms', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $farm = Farm::findOrFail($request->farm_id);
        $this->authorize('update', $farm);

        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'livestock_category_id' => 'required|exists:livestock_categories,id',
            'tag_number' => 'required|string|max:255|unique:livestocks',
            'name' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'breed' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'status' => 'required|string|max:255',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('livestock', $filename, 'public');
            $validated['image'] = $path;
        }

        $livestock = Livestock::create($validated);

        return redirect()->route('farmer.livestock.show', $livestock)
            ->with('success', 'Livestock added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Livestock $livestock)
    {
        $this->authorize('view', $livestock->farm);

        $livestock->load(['farm', 'category']);
        $healthRecords = $livestock->healthRecords()->latest()->get();

        return view('farmer.livestock.show', compact('livestock', 'healthRecords'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livestock $livestock)
    {
        $this->authorize('update', $livestock->farm);

        $farms = Auth::user()->farms;
        $categories = LivestockCategory::all();

        return view('farmer.livestock.edit', compact('livestock', 'farms', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livestock $livestock)
    {
        $this->authorize('update', $livestock->farm);

        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'livestock_category_id' => 'required|exists:livestock_categories,id',
            'tag_number' => 'required|string|max:255|unique:livestocks,tag_number,' . $livestock->id,
            'name' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'breed' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'status' => 'required|string|max:255',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($livestock->image) {
                Storage::disk('public')->delete($livestock->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('livestock', $filename, 'public');
            $validated['image'] = $path;
        }

        $livestock->update($validated);

        return redirect()->route('farmer.livestock.show', $livestock)
            ->with('success', 'Livestock updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livestock $livestock)
    {
        $this->authorize('delete', $livestock->farm);

        // Delete image if exists
        if ($livestock->image) {
            Storage::disk('public')->delete($livestock->image);
        }

        $livestock->delete();

        return redirect()->route('farmer.livestock.index')
            ->with('success', 'Livestock deleted successfully.');
    }
}
