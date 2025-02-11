<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.calendars.index');
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
            'duration' => 'required|integer',
            'admin_id' => 'nullable|exists:admins,id',
            'user_id' => 'nullable|exists:users,id',
            'course_user_id' => 'nullable|exists:course_users,id',
            'lead_id' => 'nullable|exists:leads,id',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (!$request->admin_id && !$request->user_id && !$request->course_user_id && !$request->lead_id) {
                $validator->errors()->add('admin_id', 'You must select at least one of admin_id, user_id, course_user_id, or lead_id.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Calendar::create($request->all());

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
            'duration' => 'required|integer',
            'admin_id' => 'nullable|exists:admins,id',
            'user_id' => 'nullable|exists:users,id',
            'course_user_id' => 'nullable|exists:course_users,id',
            'lead_id' => 'nullable|exists:leads,id',
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

        if ($request->has('course_user_id') && $request->course_user_id) {
            $query->where('course_user_id', $request->course_user_id);
        }

        $calendars = $query->with(['admin', 'user', 'courseUser', 'lead'])->orderBy('id', 'desc')->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.calendars.partials.data', compact('calendars'))->render();
        }

        return view('backend.calendars.index', compact('calendars'));
    }
}
