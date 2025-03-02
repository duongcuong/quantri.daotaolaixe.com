<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::guard('admin')->id();

        $calendars = Calendar::query();

        if(Auth::guard('admin')->check() && !Auth::guard('admin')->user()->hasRole([ROLE_ADMIN, ROLE_SUPERADMIN])) {

        }

        if (Auth::guard('admin')->check()) {
            if(!Auth::guard('admin')->user()->hasRole([ROLE_ADMIN, ROLE_SUPERADMIN])){
                $calendars = $calendars->where(function ($query) use ($userId) {
                    $query->where('admin_id', $userId)
                        ->orWhere('teacher_id', $userId)
                        ->orWhereHas('lead', function ($query) use ($userId) {
                            $query->where('assigned_to', $userId);
                        });
                });
            }
        } else {
            $calendars = $calendars->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->orWhereHas('courseUser', function ($query) use ($userId) {
                          $query->where('user_id', $userId);
                      });
            });
        }

        $calendars = $calendars->get();

        return view('backend.calendars.index', compact('calendars'));
    }

    public function create(Request $request)
    {
        $course_user_id = $request->has('course_user_id') ? $request->course_user_id : '';
        return view('backend.calendars.modals.create', compact('course_user_id'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'admin_id' => 'nullable|exists:admins,id',
            'user_id' => 'nullable|exists:users,id',
            'course_user_id' => 'nullable|exists:course_users,id',
            'lead_id' => 'nullable|exists:leads,id',
            'so_gio_chay_duoc' => 'nullable|regex:/^\d{2}:\d{2}$/',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (!$request->admin_id && !$request->user_id && !$request->course_user_id && !$request->lead_id && !$request->teacher_id) {
                $validator->errors()->add('admin_id', 'You must select at least one of admin_id, user_id, course_user_id, teacher_id, or lead_id.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $calendar = Calendar::create($request->all());
        $calendar->created_by = Auth::guard('admin')->id();

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function edit(Calendar $calendar, Request $request)
    {
        return view('backend.calendars.modals.edit', compact('calendar'));
    }

    public function update(Request $request, Calendar $calendar)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'admin_id' => 'nullable|exists:admins,id',
            'user_id' => 'nullable|exists:users,id',
            'course_user_id' => 'nullable|exists:course_users,id',
            'lead_id' => 'nullable|exists:leads,id',
            'so_gio_chay_duoc' => 'nullable|regex:/^\d{2}:\d{2}$/',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (!$request->admin_id && !$request->user_id && !$request->course_user_id && !$request->lead_id) {
                $validator->errors()->add('admin_id', 'You must select at least one of admin_id, user_id, course_user_id, or lead_id.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $calendar->update($request->all());

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return response()->json(['success' => 'Course deleted successfully.']);
    }

    public function data(Request $request)
    {
        $query = Calendar::query();

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('priority') && $request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->has('loai_hoc') && $request->loai_hoc) {
            $query->where('loai_hoc', $request->loai_hoc);
        }

        if ($request->has('course_user_id') && $request->course_user_id) {
            $query->where('course_user_id', $request->course_user_id);
        }

        if ($request->has('user_id') && $request->user_id) {
            $query->whereHas('courseUser', function ($q) use ($request) {
                $q->where('user_id', $request->user_id);
            });
        }

        if ($request->has('lead_id') && $request->lead_id) {
            $query->where('lead_id', $request->lead_id);
        }

        if ($request->has('teacher_id') && $request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }

        $calendars = $query->with(['admin', 'user', 'courseUser', 'lead'])->orderBy('id', 'desc')->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.calendars.partials.data', compact('calendars'))->render();
        }

        return view('backend.calendars.index', compact('calendars'));
    }

    public function learning(){
        return view('backend.calendars.learning');
    }
}
