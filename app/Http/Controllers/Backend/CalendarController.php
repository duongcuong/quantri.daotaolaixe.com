<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\CourseUser;
use App\Models\ExamField;
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

        if (Auth::guard('admin')->check() && !Auth::guard('admin')->user()->hasRole([ROLE_ADMIN, ROLE_SUPERADMIN])) {
        }

        if (Auth::guard('admin')->check()) {
            if (!Auth::guard('admin')->user()->hasRole([ROLE_ADMIN, ROLE_SUPERADMIN])) {
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
        $examFields = ExamField::all();
        $course_user_id = $request->has('course_user_id') ? $request->course_user_id : '';
        return view('backend.calendars.create', compact('course_user_id', 'examFields'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'date|after_or_equal:date_start',
            'admin_id' => 'nullable|exists:admins,id',
            'user_id' => 'nullable|exists:users,id',
            'course_user_id' => 'nullable|array',
            'course_user_id.*' => 'exists:course_users,id',
            'lead_id' => 'nullable|exists:leads,id',
            'so_gio_chay_duoc' => 'nullable|regex:/^\d{2}:\d{2}$/',
            'is_tudong' => 'nullable|boolean',
            'is_bandem' => 'nullable|boolean',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'pickup_registered' => 'nullable|boolean',
            'exam_attempts' => 'nullable|integer|min:1',
        ]);

        $validator->after(function ($validator) use ($request) {
            // Kiểm tra nếu course_user_id và exam_attempts đã tồn tại
            if ($request->course_user_id && $request->exam_attempts) {
                $exists = Calendar::where('course_user_id', $request->course_user_id)
                    ->where('exam_attempts', $request->exam_attempts)
                    ->where('type', $request->type)
                    ->exists();

                if ($exists) {
                    $validator->errors()->add('exam_attempts', 'Lần thi này đã tồn tại cho học viên khóa học này.');
                }
            }

            if (!$request->admin_id && !$request->user_id && !$request->course_user_id && !$request->lead_id && !$request->teacher_id) {
                $validator->errors()->add('admin_id', 'You must select at least one of admin_id, user_id, course_user_id, teacher_id, or lead_id.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['is_tudong'] = $request->has('is_tudong') ? true : false;
        $data['is_bandem'] = $request->has('is_bandem') ? true : false;
        $data['pickup_registered'] = $request->has('pickup_registered') ? true : false;
        $data['approval'] = $request->has('approval') ? true : false;

        if (!$request->has('date_end')) {
            $data['date_end'] = Carbon::parse($request->date_start)->addHours(4);
        }

        // Nếu course_user_id có giá trị, lưu từng bản ghi riêng
        if ($request->has('course_user_id') && is_array($request->course_user_id)) {
            foreach ($request->course_user_id as $courseUserId) {
                Calendar::create(array_merge($data, [
                    'course_user_id' => $courseUserId,
                    'created_by' => Auth::guard('admin')->id(),
                ]));
            }
        } else {
            // Nếu không có course_user_id, lưu một bản ghi duy nhất
            Calendar::create(array_merge($data, [
                'created_by' => Auth::guard('admin')->id(),
            ]));
        }

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function edit(Calendar $calendar, Request $request)
    {
        $examFields = ExamField::all();
        return view('backend.calendars.edit', compact('calendar', 'examFields'));
    }

    public function update(Request $request, Calendar $calendar)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'date|after_or_equal:date_start',
            'admin_id' => 'nullable|exists:admins,id',
            'user_id' => 'nullable|exists:users,id',
            'course_user_id' => 'nullable|exists:course_users,id',
            'lead_id' => 'nullable|exists:leads,id',
            'so_gio_chay_duoc' => 'nullable|regex:/^\d{2}:\d{2}$/',
            'is_tudong' => 'nullable|boolean',
            'is_bandem' => 'nullable|boolean',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'pickup_registered' => 'nullable|boolean',
            'exam_attempts' => 'nullable|integer|min:1',
        ]);

        $validator->after(function ($validator) use ($request, $calendar) {
            // Kiểm tra nếu course_user_id và exam_attempts đã tồn tại (ngoại trừ bản ghi hiện tại)
            if ($request->course_user_id && $request->exam_attempts) {
                $exists = Calendar::where('course_user_id', $request->course_user_id)
                    ->where('exam_attempts', $request->exam_attempts)
                    ->where('type', $request->type)
                    ->where('id', '!=', $calendar->id) // Loại trừ bản ghi hiện tại
                    ->exists();

                if ($exists) {
                    $validator->errors()->add('exam_attempts', 'Lần thi này đã tồn tại cho học viên trong khóa học.');
                }
            }

            if (!$request->admin_id && !$request->user_id && !$request->course_user_id && !$request->lead_id) {
                $validator->errors()->add('admin_id', 'You must select at least one of admin_id, user_id, course_user_id, or lead_id.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['is_tudong'] = $request->has('is_tudong') ? true : false;
        $data['is_bandem'] = $request->has('is_bandem') ? true : false;
        $data['pickup_registered'] = $request->has('pickup_registered') ? true : false;
        $data['approval'] = $request->has('approval') ? true : false;

        if (!$request->has('date_end')) {
            $data['date_end'] = Carbon::parse($request->date_start)->addHours(4);
        }

        $calendar->update($data);

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return response()->json(['success' => 'Course deleted successfully.']);
    }

    public function data(Request $request)
    {
        // Lưu các giá trị bộ lọc vào session
        $filters = $request->all();
        session(['calendar_filters' => $filters]);

        $query = Calendar::orderBy('date_start', 'DESC');

        if ($request->has('type') && $request->type) {
            $types = explode(',', $request->type);
            $query->whereIn('type', $types);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('approval') && ($request->approval === '0' || $request->approval === '1')) {
            $query->where('approval', $request->approval);
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

        // Thêm điều kiện lọc theo khoảng thời gian date_start
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('date_start', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('date_start', '<=', $request->end_date);
        }

        if ($request->has('exam_field_id') && $request->exam_field_id) {
            $query->where('exam_field_id', $request->exam_field_id);
        }

        // Thêm điều kiện lọc theo buổi học (Sáng/Chiều)
        if ($request->has('buoi_hoc') && in_array($request->buoi_hoc, ['Sáng', 'Chiều'])) {
            $query->whereRaw('CASE WHEN HOUR(date_start) < 13 THEN "Sáng" ELSE "Chiều" END = ?', [$request->buoi_hoc]);
        }

        // Xử lý group_by = date
        if ($request->has('group_by') && $request->group_by === 'date_dayhoc') {
            $calendars = $query->selectRaw('DATE(date_start) as date, COUNT(*) as total_calendars')
                ->groupByRaw('DATE(date_start)')
                ->orderBy('date', 'DESC')
                ->paginate(LIMIT);

            if ($request->ajax()) {
                return view('backend.calendars.dayhoc.data-date', compact('calendars'))->render();
            }
        }

        if ($request->has('group_by') && $request->group_by === 'date_lichhoc') {
            $calendars = $query->selectRaw('DATE(date_start) as date, loai_hoc, COUNT(*) as total_calendars')
                ->groupByRaw('DATE(date_start), loai_hoc')
                ->orderBy('date', 'DESC')
                ->paginate(LIMIT);

            if ($request->ajax()) {
                return view('backend.calendars.lichhoc.data-date', compact('calendars'))->render();
            }
        }

        // Xử lý group_by = date
        if (
            $request->has('group_by') &&
            ($request->group_by === 'date_exam'
                || $request->group_by === 'date_exam_edu'
                || $request->group_by === 'date_lythuyet'
                || $request->group_by === 'date_thuchanh'
                || $request->group_by === 'date_lichhoc')
        ) {
            $calendars = $query->selectRaw('
                DATE(date_start) as date,
                CASE
                    WHEN HOUR(date_start) < 13 THEN "Sáng"
                    ELSE "Chiều"
                END as session,
                exam_field_id,
                COUNT(*) as total_calendars
            ')
                ->groupByRaw('DATE(date_start), session, exam_field_id')
                ->orderBy('date', 'DESC')
                ->paginate(LIMIT);

            $view = "";
            switch ($request->group_by) {
                case 'date_exam':
                    $view = 'backend.calendars.sathach.data-date';
                    break;
                case 'date_exam_edu':
                    $view = 'backend.calendars.totnghiep.data-date';
                    break;
                case 'date_lythuyet':
                    $view = 'backend.calendars.lythuyet.data-date';
                    break;
                case 'date_thuchanh':
                    $view = 'backend.calendars.thuchanh.data-date';
                    break;
                case 'date_lichhoc':
                    $view = 'backend.calendars.lichhoc.data-date';
                    break;
            }

            if ($request->ajax()) {
                return view($view, compact('calendars'))->render();
            }
        }

        $calendars = $query->with(['admin', 'user', 'courseUser', 'lead'])->latest('date_start')->paginate(LIMIT);

        if ($request->ajax()) {

            if ($request->has('view')) {
                return view($request->view, compact('calendars'))->render();
            }

            return view('backend.calendars.partials.data', compact('calendars'))->render();
        }

        return view('backend.calendars.index', compact('calendars'));
    }

    public function learning()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.dayhoc.exam', compact('examFields'));
    }

    public function learningDate()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.dayhoc.exam-date', compact('examFields'));
    }

    public function examDate()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.sathach.exam-date', compact('examFields'));
    }

    public function exam()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.sathach.exam', compact('examFields'));
    }

    public function examEduDate()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.totnghiep.exam-date', compact('examFields'));
    }

    public function examEdu()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.totnghiep.exam', compact('examFields'));
    }

    public function ltDate()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.lythuyet.exam-date', compact('examFields'));
    }

    public function lt()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.lythuyet.exam', compact('examFields'));
    }

    public function thDate()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.thuchanh.exam-date', compact('examFields'));
    }

    public function th()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.thuchanh.exam', compact('examFields'));
    }

    public function lhDate()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.lichhoc.exam-date', compact('examFields'));
    }

    public function lh()
    {
        $examFields = ExamField::all();
        return view('backend.calendars.lichhoc.exam', compact('examFields'));
    }

    public function dat(Request $request)
    {
        $course_user_id = $request->has('course_user_id') ? $request->course_user_id : '';

        // Lấy thông tin học viên và tổng số km, giờ chạy được
        $courseUser = null;
        $totalKm = 0;
        $totalHours = 0;
        $calendars = [];

        if ($course_user_id) {
            $courseUser = CourseUser::with('user')
                ->withSum(['calendars as total_km' => function ($query) {
                    $query->whereIn('loai_hoc', listStatusApprovedKm());
                }], 'km')
                ->withSum(['calendars as total_hours' => function ($query) {
                    $query->whereIn('loai_hoc', listStatusApprovedKm());
                }], 'so_gio_chay_duoc')
                ->find($course_user_id);

            $totalKm = $courseUser->total_km ?? 0;
            $totalHours = $courseUser->total_hours ?? 0;

            // Lấy danh sách lịch học với loai_hoc là chay_dat và thuc_hanh
            $calendars = Calendar::where('course_user_id', $course_user_id)
                ->whereIn('loai_hoc', listStatusApprovedKm())
                ->orderBy('date_start', 'asc')
                ->get();
        }

        if ($request->ajax()) {
            return view('backend.calendars.modals.dat', compact('calendars', 'totalKm', 'totalHours', 'courseUser'))->render();
        }
    }

    public function learningExam()
    {
        return view('backend.calendars.modals.learning-exam');
    }

    public function updateStudentClassScheduleType()
    {
        // Lấy các bản ghi Calendar cần cập nhật
        $calendars = Calendar::where('type', 'class_schedule')
            ->whereIn('loai_hoc', ['ly_thuyet', 'cabin'])
            ->get();

        $count = 0;
        foreach ($calendars as $calendar) {
            $calendar->type = 'student_class_schedule';
            $calendar->save();
            $count++;
        }

        return response()->json([
            'success' => true,
            'message' => "Đã cập nhật $count lịch sang type student_class_schedule."
        ]);
    }
}
