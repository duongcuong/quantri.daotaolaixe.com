<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExamField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ExamFieldController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.exam-fields.index');
    }

    public function create(Request $request)
    {
        return view('backend.exam-fields.modals.create');
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

        ExamField::create($request->all());

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function edit(ExamField $examField, Request $request)
    {
        return view('backend.exam-fields.modals.edit', compact('examField'));
    }

    public function update(Request $request, ExamField $examField)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:exam_fields,name,' . $examField->id,
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $examField->update($request->all());

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(ExamField $examField)
    {
        $examField->delete();
        return response()->json(['success' => 'Course deleted successfully.']);
    }

    public function data(Request $request)
    {
        $query = ExamField::orderBy('id', 'desc');

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $examFields = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.exam-fields.partials.data', compact('examFields'))->render();
        }

        return view('backend.exam-fields.index', compact('examFields'));
    }

    public function list(Request $request)
    {
        $query = ExamField::orderBy('created_at', 'desc'); // Sử dụng phân trang với 10 mục mỗi trang

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $examFields = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return response()->json([
                'datas' => $examFields
            ]);
        }
    }
}
