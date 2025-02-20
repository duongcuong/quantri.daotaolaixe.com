<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExamSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ExamScheduleController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.exam-schedules.index');
    }

    public function create(Request $request)
    {
        return view('backend.exam-schedules.modals.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_start' => 'required|date',
            'date_end' => 'nullable|date',
            'ranks' => 'required|array',
            'exam_field_id' => 'required|exists:exam_fields,id',
            'loai_thi' => 'nullable|array',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        ExamSchedule::create($request->all());

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function edit(ExamSchedule $examSchedule, Request $request)
    {
        return view('backend.exam-schedules.modals.edit', compact('examSchedule'));
    }

    public function update(Request $request, ExamSchedule $examSchedule)
    {
        $validator = Validator::make($request->all(), [
            'date_start' => 'required|date',
            'date_end' => 'nullable|date',
            'ranks' => 'required|array',
            'exam_field_id' => 'required|exists:exam_fields,id',
            'loai_thi' => 'nullable|array',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $examSchedule->update($request->all());

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(ExamSchedule $examSchedule)
    {
        $examSchedule->delete();
        return response()->json(['success' => 'Course deleted successfully.']);
    }

    public function data(Request $request)
    {
        $query = ExamSchedule::with('examField')->orderBy('id', 'desc');

        if ($request->has('payment_date') && $request->payment_date) {
            $monthYear = Carbon::createFromFormat('Y-m', $request->payment_date);
            $query->whereYear('date_start', $monthYear->year)
                  ->whereMonth('date_start', $monthYear->month);
        }

        $examSchedules = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.exam-schedules.partials.data', compact('examSchedules'))->render();
        }

        return view('backend.exam-schedules.index', compact('examSchedules'));
    }
}
