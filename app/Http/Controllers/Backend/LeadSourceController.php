<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LeadSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadSourceController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.lead-sources.index');
    }

    public function create(Request $request)
    {
        return view('backend.lead-sources.modals.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:exam_fields',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        LeadSource::create($request->all());

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function edit(LeadSource $leadSource, Request $request)
    {
        return view('backend.lead-sources.modals.edit', compact('leadSource'));
    }

    public function update(Request $request, LeadSource $leadSource)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:exam_fields,name,' . $leadSource->id,
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $leadSource->update($request->all());

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(LeadSource $leadSources)
    {
        $leadSources->delete();
        return response()->json(['success' => 'Lead Source deleted successfully.']);
    }

    public function data(Request $request)
    {
        $query = LeadSource::orderBy('id', 'desc');

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $leadSources = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.lead-sources.partials.data', compact('leadSources'))->render();
        }

        return view('backend.lead-sources.index', compact('leadSources'));
    }

    public function list(Request $request)
    {
        $query = LeadSource::orderBy('created_at', 'desc'); // Sử dụng phân trang với 10 mục mỗi trang

        if ($request->has('q') && $request->q) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $leadSources = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return response()->json([
                'datas' => $leadSources
            ]);
        }
    }
}
