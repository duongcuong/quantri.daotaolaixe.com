<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lead;
use App\Models\User;
use App\Models\Admin;
use App\Models\CourseUser;
use App\Models\LeadSource;
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
        $leadSources = LeadSource::all();
        return view('backend.leads.create', compact('leadSources'));
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
        $leadSources = LeadSource::all();
        return view('backend.leads.edit', compact('lead', 'leadSources'));
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

    public function convert_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'select_lead_user_type' => 'required|in:1,2',
            'select_lead_course_type' => 'required|in:1,2',
            'users.user_id' => 'required_if:select_lead_user_type,1|exists:users,id',
            'courses.course_id' => 'required_if:select_lead_course_type,1|exists:courses,id',
        ]);

        // Kiểm tra xem lead_id đã có course_user_id chưa
        $lead_id = $request->input('lead_id');
        $lead = Lead::find($lead_id);
        if ($lead && $lead->course_user_id) {
            $validator->errors()->add('lead_id', 'Lead này đã có khóa học và không được thêm nữa.');
        }
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Thêm các quy tắc xác thực có điều kiện
        $validator->sometimes('users.name', 'required|string|max:255', function ($input) {
            return $input->select_lead_user_type == 2;
        });

        $validator->sometimes('users.email', 'required|email|max:255|unique:users,email', function ($input) {
            return $input->select_lead_user_type == 2;
        });

        $validator->sometimes('users.phone', 'required|string|max:20', function ($input) {
            return $input->select_lead_user_type == 2;
        });

        $validator->sometimes('courses.code', 'required|string|max:255|unique:courses,code', function ($input) {
            return $input->select_lead_course_type == 2;
        });

        $validator->sometimes('courses.rank', 'required|string|max:255', function ($input) {
            return $input->select_lead_course_type == 2;
        });

        // Kiểm tra cặp user_id và course_id đã tồn tại trong hệ thống chưa
        $validator->after(function ($validator) use ($request) {
            if ($request->select_lead_user_type == 1 && $request->select_lead_course_type == 1) {
                $user_id = $request->input('users.user_id');
                $course_id = $request->input('courses.course_id');
                $exists = CourseUser::where('user_id', $user_id)
                    ->where('course_id', $course_id)
                    ->exists();
                if ($exists) {
                    $validator->errors()->add('users.user_id', 'Cặp học viên và khóa học đã tồn tại trong hệ thống.');
                }
            }
        });

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
                $userData['password'] = bcrypt('123456');
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
            $courseUser = CourseUser::create([
                'user_id' => $user_id,
                'course_id' => $course_id,
                'sale_id' => $lead->assigned_to,
            ]);

            // Cập nhật course_user_id cho lead
            $lead->course_user_id = $courseUser->id;
            $lead->save();

            DB::commit();

            return response()->json(['success' => 'Chuyển đổi thành công.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }
}
