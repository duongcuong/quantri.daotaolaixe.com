<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.fees.index');
    }

    public function create(Request $request)
    {
        return view('backend.fees.modals.create');
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
        return view('backend.fees.modals.edit', compact('fee'));
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

        if ($request->has('payment_date') && $request->payment_date) {
            $monthYear = Carbon::createFromFormat('Y-m', $request->payment_date);
            $query->whereYear('payment_date', $monthYear->year)
                  ->whereMonth('payment_date', $monthYear->month);
        }

        if ($request->has('course_user_id') && $request->course_user_id != '') {
            $query->where('course_user_id', $request->course_user_id);
        }

        if ($request->has('student_name') && $request->student_name) {
            $query->whereHas('courseUser.user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student_name . '%');
            });
        }

        $fees = $query->paginate(LIMIT);

        $course_user_id = $request->has('course_user_id') ? $request->has('course_user_id') : '';

        if ($request->ajax()) {
            return view('backend.fees.partials.data', compact('fees', 'course_user_id'))->render();
        }

        return view('backend.fees.index', compact('fees'));
    }
}
