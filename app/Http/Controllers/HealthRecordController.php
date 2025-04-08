<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Models\Livestock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class HealthRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = HealthRecord::query()
            ->whereHas('livestock.farm', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['livestock']);

        // Filter by livestock if provided
        if ($request->has('livestock_id')) {
            $query->where('livestock_id', $request->livestock_id);
            $livestock = Livestock::findOrFail($request->livestock_id);
            $this->authorize('view', $livestock->farm);
        }

        // Filter by record type if provided
        if ($request->has('record_type')) {
            $query->where('record_type', $request->record_type);
        }

        $healthRecords = $query->latest()->paginate(10);
        $livestock = Livestock::whereHas('farm', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('farmer.health-records.index', compact('healthRecords', 'livestock'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $livestock = Livestock::whereHas('farm', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        $selectedLivestock = null;
        if ($request->has('livestock_id')) {
            $selectedLivestock = Livestock::findOrFail($request->livestock_id);
            $this->authorize('view', $selectedLivestock->farm);
        }

        return view('farmer.health-records.create', compact('livestock', 'selectedLivestock'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $livestock = Livestock::findOrFail($request->livestock_id);
        $this->authorize('update', $livestock->farm);

        $validated = $request->validate([
            'livestock_id' => 'required|exists:livestocks,id',
            'record_type' => 'required|string|in:vaccination,treatment,examination',
            'record_date' => 'required|date',
            'description' => 'required|string',
            'performed_by' => 'required|string|max:255',
            'cost' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'next_follow_up' => 'nullable|date',
            'attachments' => 'nullable|file|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('attachments')) {
            $path = $request->file('attachments')->store('health-records', 'public');
            $validated['attachments'] = $path;
        }

        $healthRecord = HealthRecord::create($validated);

        return redirect()->route('farmer.health-records.show', $healthRecord)
            ->with('success', 'Health record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HealthRecord $healthRecord)
    {
        $this->authorize('view', $healthRecord->livestock->farm);

        $healthRecord->load('livestock');

        return view('farmer.health-records.show', compact('healthRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HealthRecord $healthRecord)
    {
        $this->authorize('update', $healthRecord->livestock->farm);

        $livestock = Livestock::whereHas('farm', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('farmer.health-records.edit', compact('healthRecord', 'livestock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HealthRecord $healthRecord)
    {
        $this->authorize('update', $healthRecord->livestock->farm);

        $validated = $request->validate([
            'livestock_id' => 'required|exists:livestocks,id',
            'record_type' => 'required|string|in:vaccination,treatment,examination',
            'record_date' => 'required|date',
            'description' => 'required|string',
            'performed_by' => 'required|string|max:255',
            'cost' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'next_follow_up' => 'nullable|date',
            'attachments' => 'nullable|file|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('attachments')) {
            // Delete old file if exists
            if ($healthRecord->attachments) {
                Storage::disk('public')->delete($healthRecord->attachments);
            }

            $path = $request->file('attachments')->store('health-records', 'public');
            $validated['attachments'] = $path;
        }

        $healthRecord->update($validated);

        return redirect()->route('farmer.health-records.show', $healthRecord)
            ->with('success', 'Health record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HealthRecord $healthRecord)
    {
        $this->authorize('delete', $healthRecord->livestock->farm);

        // Delete file if exists
        if ($healthRecord->attachments) {
            Storage::disk('public')->delete($healthRecord->attachments);
        }

        $healthRecord->delete();

        return redirect()->route('farmer.health-records.index')
            ->with('success', 'Health record deleted successfully.');
    }
}
