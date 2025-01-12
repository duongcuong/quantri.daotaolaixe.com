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
        return view('backend.course-user.index', compact( 'users', 'courses'));
    }

    public function create()
    {
        $users = User::all();
        $courses = Course::all();
        return view('backend.course-user.modals.create', compact('users', 'courses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'basic_status' => 'required|integer|in:0,1,2',
            'shape_status' => 'required|integer|in:0,1,2',
            'road_status' => 'required|integer|in:0,1,2',
            'chip_status' => 'required|integer|in:0,1,2',
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

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        CourseUser::create($request->all());

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function show(CourseUser $courseUser)
    {
        $courseUsers = CourseUser::with('user', 'course')->get();
        $admins = Admin::where('status', 1)->get();

        $courseUser->loadSum('fees', 'amount');

        return view('backend.course-user.show', compact('courseUser', 'courseUsers', 'admins'));
    }

    public function edit(CourseUser $courseUser)
    {
        $users = User::all();
        $courses = Course::all();
        return view('backend.course-user.modals.edit', compact('courseUser', 'users', 'courses'));
    }

    public function update(Request $request, CourseUser $courseUser)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'basic_status' => 'required|integer|in:0,1,2',
            'shape_status' => 'required|integer|in:0,1,2',
            'road_status' => 'required|integer|in:0,1,2',
            'chip_status' => 'required|integer|in:0,1,2',
            'status' => 'required|integer|in:0,1',
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

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $courseUser->update($request->all());

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(CourseUser $courseUser)
    {
        $courseUser->delete();
        return response()->json(['success' => 'Xoá thành công.']);
    }

    public function data(Request $request)
    {
        $query = CourseUser::with('user', 'course')->orderBy('id', 'desc');

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
}
