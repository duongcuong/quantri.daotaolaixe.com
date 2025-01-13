<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Fee;
use App\Models\CourseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $course_user_id = $request->has('course_user_id') ? $request->course_user_id : '';
        return view('backend.fees.index', compact( 'course_user_id'));
    }

    public function create(Request $request)
    {
        $course_user_id = $request->has('course_user_id') ? $request->course_user_id : '';
        return view('backend.fees.modals.create', compact( 'course_user_id'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_user_id' => 'required|exists:course_users,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'note' => 'nullable|string',
            'admin_id' => 'required|exists:admins,id',
            'is_received' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Fee::create($request->all());

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function edit(Fee $fee, Request $request)
    {
        $course_user_id = $request->has('course_user_id') ? $request->course_user_id : '';
        return view('backend.fees.modals.edit', compact('fee', 'course_user_id'));
    }

    public function update(Request $request, Fee $fee)
    {
        $validator = Validator::make($request->all(), [
            'course_user_id' => 'required|exists:course_users,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'note' => 'nullable|string',
            'admin_id' => 'required|exists:admins,id',
            'is_received' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fee->update($request->all());

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();
        return response()->json(['success' => 'Course deleted successfully.']);
    }

    public function data(Request $request)
    {
        $query = Fee::with('courseUser.user', 'courseUser.course')->orderBy('id', 'desc');

        if ($request->has('course_user_id') && $request->course_user_id != '') {
            $query->where('course_user_id', $request->course_user_id);
        }

        $fees = $query->paginate(LIMIT);

        $course_user_id = $request->has('course_user_id') ? $request->has('course_user_id') : '';

        if ($request->ajax()) {
            return view('backend.fees.partials.data', compact('fees', 'course_user_id'))->render();
        }

        return view('backend.fees.index', compact('fees'));
    }
}
