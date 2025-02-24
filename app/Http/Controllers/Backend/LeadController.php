<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lead;
use App\Models\User;
use App\Models\Admin;
use App\Models\CourseUser;
use Illuminate\Support\Facades\DB;
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

    function convert_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'select_lead_user_type' => 'required|in:1,2',
            'select_lead_course_type' => 'required|in:1,2',
            'users.user_id' => 'required_if:select_lead_user_type,1|exists:users,id',
            'users.name' => 'required_if:select_lead_user_type,2|string|max:255',
            'users.email' => 'required_if:select_lead_user_type,2|email|max:255|unique:users,email',
            'users.phone' => 'required_if:select_lead_user_type,2|string|max:20',
            'courses.course_id' => 'required_if:select_lead_course_type,1|exists:courses,id',
            'courses.code' => 'required_if:select_lead_course_type,2|string|max:255|unique:courses,code',
            'courses.rank' => 'required_if:select_lead_course_type,2|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            // Xử lý user
            if ($request->select_lead_user_type == 1) {
                $user_id = $request->input('users.user_id');
            } else {
                $userData = $request->input('users');
                $user = User::create($userData);
                $user_id = $user->id;
            }

            // Xử lý course
            if ($request->select_lead_course_type == 1) {
                $course_id = $request->input('courses.course_id');
            } else {
                $courseData = $request->input('courses');
                $course = Course::create($courseData);
                $course_id = $course->id;
            }

            // Tạo bản ghi trong bảng course_users
            CourseUser::create([
                'user_id' => $user_id,
                'course_id' => $course_id,
            ]);

            DB::commit();

            return response()->json(['success' => 'Chuyển đổi thành công.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Đã xảy ra lỗi trong quá trình chuyển đổi.'], 500);
        }
    }
}
