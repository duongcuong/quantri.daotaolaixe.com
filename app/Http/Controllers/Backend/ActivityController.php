<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('backend.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('backend.activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'related_type' => 'required|in:lead,opportunity',
            'related_id' => 'required|integer',
            'type' => 'required|in:email,call,meeting,task',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'duration' => 'required|integer',
            'assigned_to' => 'required|integer|exists:admins,id',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        Activity::create($request->all());

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    public function show(Activity $activity)
    {
        return view('backend.activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('backend.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'related_type' => 'required|in:lead,opportunity',
            'related_id' => 'required|integer',
            'type' => 'required|in:email,call,meeting,task',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'duration' => 'required|integer',
            'assigned_to' => 'required|integer|exists:admins,id',
            'status' => 'required|in:pending,in_progress,completed,cancelled', // Thêm validation cho status
        ]);

        $activity->update($request->all());

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }
}
