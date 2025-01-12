<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        // $courses = Course::paginate(LIMIT);
        return view('backend.courses.index');
    }

    public function create()
    {
        return view('backend.courses.modals.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:courses',
            'name' => 'required|string|max:255|unique:courses',
            'rank' => 'required|string|max:255',
            'rank_gp' => 'required|string|max:255',
            'number_bc' => 'required|string|max:255',
            'date_bci' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'number_students' => 'nullable|integer',
            'decision_kg' => 'nullable|string|max:255',
            'duration' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Course::create($request->all());

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function show(Course $course)
    {
        return view('backend.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('backend.courses.modals.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:courses,code,' . $course->id,
            'name' => 'required|string|max:255|unique:courses,name,' . $course->id,
            'rank' => 'required|string|max:255',
            'rank_gp' => 'required|string|max:255',
            'number_bc' => 'required|string|max:255',
            'date_bci' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'number_students' => 'nullable|integer',
            'decision_kg' => 'nullable|string|max:255',
            'duration' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course->update($request->all());

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['success' => 'Course deleted successfully.']);
    }

    public function data(Request $request)
    {
        $courses = Course::orderBy('id', 'desc')->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.courses.partials.data', compact('courses'))->render();
        }

        return view('backend.courses.index', compact('courses'));
    }
}
