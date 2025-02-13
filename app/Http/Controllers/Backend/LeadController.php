<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function index()
    {
        return view('backend.leads.index');
    }

    public function create()
    {
        return view('backend.leads.create');
    }

    public function store(Request $request)
    {

        $request->validate( [
            'user_id' => 'nullable|exists:users,id',
            'source' => 'nullable|string|max:255',
            'interest_level' => 'required|in:low,medium,high',
            'status' => 'nullable|string|max:50', // Cập nhật validation cho trường status
            'assigned_to' => 'required|exists:admins,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'dob' => 'nullable|date',
        ]);

        Lead::create($request->all());

        toastr()->success('Thêm thành công');
        return redirect()->route('admins.leads.index')->with('success', 'Lead created successfully.');

        // return response()->json(['success' => 'Thêm thành công.']);
    }

    public function show(Lead $lead)
    {
        return view('backend.leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        return view('backend.leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {

        $request->validate( [
            'user_id' => 'nullable|exists:users,id',
            'source' => 'nullable|string|max:255',
            'interest_level' => 'required|in:low,medium,high',
            'status' => 'nullable|string|max:50',
            'assigned_to' => 'required|exists:admins,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'dob' => 'nullable|date',
        ]);

        $lead->update($request->all());

        toastr()->success('Cập nhật thành công');
        return redirect()->route('admins.leads.index')->with('success', 'Lead updated successfully.');

        // return response()->json(['success' => 'Cập nhật thành công.']);

    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }

    public function list(Request $request)
    {
        $query = Lead::orderBy('id', 'desc');

        if ($request->has('id')) {
            $query->where('id', $request->id);
        }

        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $users = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return response()->json([
                'datas' => $users
            ]);
        }
    }

    public function data(Request $request)
    {
        $query = Lead::with(['user', 'assignedTo', 'leadSource'])->orderBy('id', 'desc');

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('assigned_to') && $request->assigned_to) {
            $query->where('assigned_to', $request->assigned_to);
        }

        $leads = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.leads.partials.data', compact('leads'))->render();
        }

        return view('backend.leads.index', compact('leads'));
    }
}
