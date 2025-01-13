<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CourseUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $courses = Course::all();
        return view('backend.course-user.index', compact('users', 'courses'));
    }

    public function create()
    {
        return view('backend.course-user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'contract_date' => 'nullable|date',
            'theory_exam' => 'nullable|boolean',
            'practice_exam' => 'nullable|boolean',
            'graduation_exam' => 'nullable|boolean',
            'graduation_date' => 'nullable|date',
            'teacher_id' => 'nullable|exists:admins,id',
            'practice_field' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'health_check_date' => 'nullable|date',
            'sale_id' => 'nullable|exists:admins,id',
            'exam_date' => 'nullable|date',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('course_users')->where(function ($query) use ($request) {
                    return $query->where('course_id', $request->course_id);
                }),
            ],
        ], [
            'user_id.unique' => 'The selected user is already enrolled in this course.',
        ]);

        CourseUser::create($request->all());

        toastr()->success('Thêm thành công');
        return redirect()->route('admins.course-user.index')->with('success', 'Course User created successfully.');

        // return response()->json(['success' => 'Thêm thành công.']);
    }

    public function show(CourseUser $courseUser)
    {
        $courseUsers = CourseUser::with('user', 'course', 'teacher', 'sale')->get();
        $admins = Admin::where('status', 1)->get();

        $courseUser->loadSum('fees', 'amount');

        return view('backend.course-user.show', compact('courseUser', 'courseUsers', 'admins'));
    }

    public function edit(CourseUser $courseUser)
    {
        return view('backend.course-user.edit', compact('courseUser'));
    }

    public function update(Request $request, CourseUser $courseUser)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'contract_date' => 'nullable|date',
            'theory_exam' => 'nullable|boolean',
            'practice_exam' => 'nullable|boolean',
            'graduation_exam' => 'nullable|boolean',
            'graduation_date' => 'nullable|date',
            'teacher_id' => 'nullable|exists:admins,id',
            'practice_field' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'health_check_date' => 'nullable|date',
            'sale_id' => 'nullable|exists:admins,id',
            'exam_date' => 'nullable|date',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('course_users')->where(function ($query) use ($request, $courseUser) {
                    return $query->where('course_id', $request->course_id)
                        ->where('id', '!=', $courseUser->id);
                }),
            ],
        ], [
            'user_id.unique' => 'The selected user is already enrolled in this course.',
        ]);

        $courseUser->update($request->all());

        toastr()->success('Cập nhật thành công');
        return redirect()->route('admins.course-user.index')->with('success', 'Course User updated successfully.');

        // return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(CourseUser $courseUser)
    {
        $courseUser->delete();
        return response()->json(['success' => 'Xoá thành công.']);
    }

    public function data(Request $request)
    {
        $query = CourseUser::with('user', 'course', 'teacher', 'sale')->orderBy('id', 'desc');

        if ($request->has('course_id') && $request->course_id != '') {
            $query->where('course_id', $request->course_id);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search_text') && $request->search_text != '') {
            $searchText = $request->search_text;
            $query->where(function ($q) use ($searchText) {
                $q->whereHas('user', function ($q) use ($searchText) {
                    $q->where('name', 'like', "%{$searchText}%")
                        ->orWhere('identity_card', 'like', "%{$searchText}%");
                })->orWhereHas('course', function ($q) use ($searchText) {
                    $q->where('code', 'like', "%{$searchText}%");
                });
            });
        }

        if ($request->has('card_name') && $request->card_name != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('card_name', 'like', "%{$request->card_name}%");
            });
        }

        $courseUsers = $query->withSum('fees', 'amount');

        $courseUsers = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.course-user.partials.data', compact('courseUsers'))->render();
        }

        return view('backend.course-user.index', compact('courseUsers'));
    }

    public function list(Request $request)
    {
        $query = CourseUser::with('user', 'course')->orderBy('id', 'desc');

        if ($request->has('id')) {
            $query->where('id', $request->id);
        }

        if ($request->has('q')) {
            $searchText = $request->q;
            $query->where(function ($q) use ($searchText) {
                $q->whereHas('course', function ($q) use ($searchText) {
                    $q->where('name', 'like', '%' . $searchText . '%');
                })->orWhereHas('user', function ($q) use ($searchText) {
                    $q->where('name', 'like', '%' . $searchText . '%');
                });
            });
        }

        $courseUsers = $query->paginate(LIMIT);

        // Thêm thuộc tính name vào từng item của $courseUsers
        foreach ($courseUsers as $courseUser) {
            $courseUser->name = $courseUser->user->name . ' - ' . $courseUser->course->name;
        }

        if ($request->ajax()) {
            return response()->json([
                'datas' => $courseUsers
            ]);
        }
    }
}
