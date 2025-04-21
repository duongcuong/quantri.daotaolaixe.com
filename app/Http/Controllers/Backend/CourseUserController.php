<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Calendar;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\ExamField;
use App\Models\ImportLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Fee;
use App\Models\ImportRow;
use App\Models\Role;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;

class CourseUserController extends Controller
{
    public function index()
    {
        $practiceFields = CourseUser::select('practice_field')->distinct()->pluck('practice_field');
        $examFields = ExamField::all();
        return view('backend.course-user.index', compact('practiceFields', 'examFields'));
    }

    public function create()
    {
        $examFields = ExamField::all();
        return view('backend.course-user.create', compact('examFields'));
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
            'gifted_hours' => 'nullable|regex:/^\d{2}:\d{2}$/',
            'chip_hours' => 'nullable|regex:/^\d{2}:\d{2}$/',
            'sale_id' => 'nullable|exists:admins,id',
            'exam_date' => 'nullable|date',
            'tuition_fee' => 'nullable|integer',
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

        $courseUser = CourseUser::create($request->all());

        event(new \App\Events\RecordActionEvent('added', $courseUser));

        toastr()->success('Thêm thành công');
        return redirect()->route('admins.course-user.index')->with('success', 'Course User created successfully.');

        // return response()->json(['success' => 'Thêm thành công.']);
    }

    public function show(CourseUser $courseUser)
    {
        $courseUsers = CourseUser::with('user', 'course', 'teacher', 'sale')->get();
        $admins = Admin::where('status', 1)->get();

        $courseUser->loadSum('fees', 'amount');
        $courseUser->loadSum(['calendars' => function ($query) {
            $query->where('approval', true);
        }], 'km');
        $courseUser->loadSum(['calendars' => function ($query) {
            $query->where('approval', true);
        }], 'so_gio_chay_duoc');
        // Thêm withSum cho tổng km với điều kiện is_tudong = true
        $courseUser->loadSum(['calendars as total_km_tudong' => function ($query) {
            $query->where('is_tudong', true);
        }], 'km');

        // Thêm withSum cho tổng so_gio_chay_duoc với điều kiện is_bandem = true
        $courseUser->loadSum(['calendars as total_so_gio_chay_duoc_bandem' => function ($query) {
            $query->where('is_bandem', true);
        }], 'so_gio_chay_duoc');

        return view('backend.course-user.show', compact('courseUser', 'courseUsers', 'admins'));
    }

    public function edit(CourseUser $courseUser)
    {
        $examFields = ExamField::all();
        $courseUser->loadSum('calendars', 'km');
        $courseUser->loadSum('calendars', 'so_gio_chay_duoc');
        // Thêm withSum cho tổng km với điều kiện is_tudong = true
        $courseUser->loadSum(['calendars as total_km_tudong' => function ($query) {
            $query->where('is_tudong', true);
        }], 'km');

        // Thêm withSum cho tổng so_gio_chay_duoc với điều kiện is_bandem = true
        $courseUser->loadSum(['calendars as total_so_gio_chay_duoc_bandem' => function ($query) {
            $query->where('is_bandem', true);
        }], 'so_gio_chay_duoc');
        return view('backend.course-user.edit', compact('courseUser', 'examFields'));
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
            'tuition_fee' => 'nullable|integer',
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

        event(new \App\Events\RecordActionEvent('updated', $courseUser));

        toastr()->success('Cập nhật thành công');
        return redirect()->route('admins.course-user.index')->with('success', 'Course User updated successfully.');

        // return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(CourseUser $courseUser)
    {
        $courseUser->delete();

        event(new \App\Events\RecordActionEvent('delete', $courseUser));
        return response()->json(['success' => 'Course User deleted successfully.']);
    }

    public function data(Request $request)
    {
        // Lưu các giá trị bộ lọc vào session
        $filters = $request->all();
        session(['course_user_filters' => $filters]);

        $query = CourseUser::with('user', 'course', 'teacher', 'sale', 'latestCalendar');

        $hasSearch = false;

        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
            $hasSearch = true;
        }

        if ($request->has('course_id') && $request->course_id != '') {
            $query->where('course_id', $request->course_id);
            $hasSearch = true;
        }

        if ($request->has('teacher_id') && $request->teacher_id != '') {
            $query->where('teacher_id', $request->teacher_id);
            $hasSearch = true;
        }

        if ($request->has('exam_field_id') && $request->exam_field_id != '') {
            $query->where('exam_field_id', $request->exam_field_id);
            $hasSearch = true;
        }

        // Thêm điều kiện lọc theo khoảng thời gian date_start
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('contract_date', '>=', $request->start_date);
            $hasSearch = true;
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('contract_date', '<=', $request->end_date);
            $hasSearch = true;
        }

        if ($request->has('status') && $request->status != '') {
            $query->whereHas('latestCalendar', function ($q) use ($request) {
                $q->whereIn('calendars.type', ['exam_schedule', 'class_schedule'])
                    ->where('calendars.status', $request->status)
                    ->whereRaw('calendars.id = (
                        SELECT id FROM calendars a
                        WHERE a.course_user_id = course_users.id
                        AND a.type IN ("exam_schedule", "class_schedule")
                        ORDER BY a.date_start DESC
                        LIMIT 1
                    )');
            });
            $hasSearch = true;
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
            $hasSearch = true;
        }

        if ($request->has('card_name') && $request->card_name != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('card_name', 'like', "%{$request->card_name}%");
            });
            $hasSearch = true;
        }

        if ($request->has('tuition_status') && $request->tuition_status != '') {
            $hasSearch = true;
        }

        $courseUsers = $query->withSum('fees', 'amount')->withSum('calendars', 'km')
            ->withSum('calendars', 'so_gio_chay_duoc')
            ->withSum(['calendars as total_so_gio_chay_duoc_tudong' => function ($query) {
                $query->where('is_tudong', true); // Điều kiện is_tudong = true
            }], 'so_gio_chay_duoc')
            ->withSum(['calendars as total_so_gio_chay_duoc_bandem' => function ($query) {
                $query->where('is_bandem', true); // Điều kiện is_bandem = true
            }], 'so_gio_chay_duoc');

        if ($hasSearch) {
            $query->join('users', 'course_users.user_id', '=', 'users.id')
                ->orderBy('users.name', 'asc')
                ->select('course_users.*');
        } else {
            $query->latest();
        }

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
                    $q->where('code', 'like', '%' . $searchText . '%');
                })->orWhereHas('user', function ($q) use ($searchText) {
                    $q->where('name', 'like', '%' . $searchText . '%');
                });
            });
        }

        $courseUsers = $query->paginate(LIMIT);

        // Thêm thuộc tính name vào từng item của $courseUsers
        foreach ($courseUsers as $courseUser) {
            $courseUser->name = $courseUser->user->name . ' - ' . $courseUser->course->code;
        }

        if ($request->ajax()) {
            return response()->json([
                'datas' => $courseUsers
            ]);
        }
    }

    public function import()
    {
        return view('backend.course-user.import');
    }

    public function importFile(Request $request)
    {
        $file = $request->file('file_xlsx');
        $timestamp = \Carbon\Carbon::now()->timestamp;
        $fileName = $timestamp . '_' . $file->getClientOriginalName();
        $sanitizedFileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($fileName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $sanitizedFileName = $file->storeAs('public/imports', $fileName);

        // Lưu thông tin file import vào bảng ImportLog
        $importLog = ImportLog::create([
            'file_name' => $file->getClientOriginalName(),
            'sanitized_file_name' => $sanitizedFileName,
            'admin_id' => auth('admin')->id(),
            'imported_at' => \Carbon\Carbon::now(),
        ]);

        $data = Excel::toArray([], $file);
        $totalRows = count($data[0]) - 3;

        // Lưu tiến trình import vào file riêng cho mỗi user
        $userId = auth('admin')->id();
        $progressFile = storage_path('app/import_progress_' . $userId . '.json');
        file_put_contents($progressFile, json_encode(['total' => $totalRows, 'processed' => 0]));

        foreach ($data[0] as $key => $row) {

            if ($key == 0 || $key == 1 || $key == 2) {
                continue;
            }

            // Cập nhật tiến trình import
            $progress = json_decode(file_get_contents($progressFile), true);
            $progress['processed']++;
            file_put_contents($progressFile, json_encode($progress));

            // sleep(1);

            DB::beginTransaction();
            try {

                $ngayKyHD = getDateByExcel($row[1]);
                $hoTen = $row[2];
                $sdt = formatPhoneNumber($row[3]);
                $ngaySinh = getDateByExcel($row[4]);
                $email = $row[5];
                $diaChi = $row[6];

                $hang = $row[7];
                $khoa = $row[8];
                $ngayKhaiGiang = getDateByExcel($row[9]);
                $ngayBeGiang = getDateByExcel($row[10]);

                $thayDay = $row[11];
                $emailThayDay = $row[12];
                $sdtThayDay = formatPhoneNumber($row[13]);

                $lePhiHoSo = getNumberCsExcel($row[14]);

                $soTienLan1 = getNumberCsExcel($row[15]);
                $ngayNapLan1 = getDateByExcel($row[16]);
                $ghiChuLan1 = $row[17];
                $soTienLan2 = getNumberCsExcel($row[18]);
                $ngayNapLan2 = getDateByExcel($row[19]);
                $ghiChuLan2 = $row[20];

                $nguoiGuiHS = $row[21];
                $sdtNguoiGuiHS = formatPhoneNumber($row[22]);
                $emailNguoiGuiHS = $row[23];

                $note = $row[24];
                $khamSucKhoe = getDateByExcel($row[25]);
                $sanTap = $row[26];

                $ngayThi = getDateByExcel($row[27]);
                $sbd = $row[28];
                $soTienThi = getNumberCsExcel($row[29]);
                $ngayDongThi = getDateByExcel($row[30]);
                $sanThi = $row[31];
                $ketQua = $row[32];

                // Validate các email
                if (empty($sdt)) {
                    throw new \Exception('Số điện thoại học viên không được để trống.');
                }

                $hocCabins = [];
                if ($row[33] && $row[34]) {
                    $hocCabins[] = [
                        'ngay' => getDateByExcel($row[33]),
                        'gio' => convertHoursExcelToSeconds($row[34])
                    ];
                }

                if ($row[35] && $row[36]) {
                    $hocCabins[] = [
                        'ngay' => getDateByExcel($row[35]),
                        'gio' => convertHoursExcelToSeconds($row[36])
                    ];
                }

                if ($row[37] && $row[38]) {
                    $hocCabins[] = [
                        'ngay' => getDateByExcel($row[37]),
                        'gio' => convertHoursExcelToSeconds($row[38])
                    ];
                }

                if ($row[39] && $row[40]) {
                    $hocCabins[] = [
                        'ngay' => getDateByExcel($row[39]),
                        'gio' => convertHoursExcelToSeconds($row[40])
                    ];
                }

                $chayDats = [];
                if ($row[41] && $row[42] && $row[43]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[41]),
                        'gio' => convertHoursExcelToSeconds($row[43]),
                        'km' => $row[42]
                    ];
                }

                if ($row[44] && $row[45] && $row[46]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[44]),
                        'gio' => convertHoursExcelToSeconds($row[46]),
                        'km' => $row[45]
                    ];
                }

                if ($row[47] && $row[48] && $row[49]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[47]),
                        'gio' => convertHoursExcelToSeconds($row[49]),
                        'km' => $row[48]
                    ];
                }

                if ($row[50] && $row[51] && $row[52]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[50]),
                        'gio' => convertHoursExcelToSeconds($row[52]),
                        'km' => $row[51]
                    ];
                }

                if ($row[53] && $row[54] && $row[55]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[53]),
                        'gio' => convertHoursExcelToSeconds($row[55]),
                        'km' => $row[54]
                    ];
                }

                if ($row[56] && $row[57] && $row[58]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[56]),
                        'gio' => convertHoursExcelToSeconds($row[58]),
                        'km' => $row[57]
                    ];
                }

                if ($row[59] && $row[60] && $row[61]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[59]),
                        'gio' => convertHoursExcelToSeconds($row[61]),
                        'km' => $row[60]
                    ];
                }

                if ($row[62] && $row[63] && $row[64]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[62]),
                        'gio' => convertHoursExcelToSeconds($row[64]),
                        'km' => $row[63]
                    ];
                }

                if ($row[65] && $row[66] && $row[67]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[65]),
                        'gio' => convertHoursExcelToSeconds($row[67]),
                        'km' => $row[66]
                    ];
                }

                if ($row[68] && $row[69] && $row[70]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[68]),
                        'gio' => convertHoursExcelToSeconds($row[70]),
                        'km' => $row[69]
                    ];
                }

                // Random email nếu không có
                $email = $email ?? 'user_' . uniqid() . '@example.com';
                $emailThayDay = $emailThayDay ?? 'teacher_' . uniqid() . '@example.com';
                $emailNguoiGuiHS = $emailNguoiGuiHS ?? 'sale_' . uniqid() . '@example.com';

                // Thêm hoặc lấy User
                $user = User::firstOrCreate(
                    ['phone' => $sdt],
                    [
                        'name' => $hoTen,
                        'email' => $email,
                        'dob' => $ngaySinh,
                        'address' => $diaChi,
                        'password' => bcrypt('12345678'),
                        'status' => 1
                    ]
                );

                // Thêm hoặc lấy Giáo viên
                if (empty($sdtThayDay)) {
                    // Nếu không có số điện thoại giáo viên, tạo giáo viên mặc định
                    $teacher = Admin::firstOrCreate(
                        ['phone' => 'NO_PHONE'], // Số điện thoại mặc định
                        [
                            'name' => 'No Teacher', // Tên giáo viên mặc định
                            'email' => 'no_teacher_' . uniqid() . '@example.com', // Email ngẫu nhiên
                            'password' => bcrypt('12345678'), // Mật khẩu mặc định
                            'status' => 1
                        ]
                    );
                } else {
                    // Nếu có số điện thoại, tìm hoặc tạo giáo viên như bình thường
                    $teacher = Admin::firstOrCreate(
                        ['phone' => $sdtThayDay],
                        [
                            'name' => $thayDay,
                            'email' => $emailThayDay ?? 'teacher_' . uniqid() . '@example.com',
                            'password' => bcrypt('12345678'),
                            'status' => 1
                        ]
                    );
                }
                // Gán role "teacher" cho giáo viên
                $teacherRole = Role::where('slug', ROLE_TEACHER)->first();
                if ($teacherRole && !$teacher->roles->contains($teacherRole->id)) {
                    $teacher->roles()->attach($teacherRole->id);
                }

                // Thêm hoặc lấy Sale
                if (empty($sdtNguoiGuiHS)) {
                    // Nếu không có số điện thoại sale, tạo sale mặc định
                    $sale = Admin::firstOrCreate(
                        ['phone' => 'NO_PHONE_SALE'], // Số điện thoại mặc định
                        [
                            'name' => 'No Sale', // Tên sale mặc định
                            'email' => 'no_sale_' . uniqid() . '@example.com', // Email ngẫu nhiên
                            'password' => bcrypt('12345678'), // Mật khẩu mặc định
                            'status' => 1
                        ]
                    );
                } else {
                    // Nếu có số điện thoại, tìm hoặc tạo sale như bình thường
                    $sale = Admin::firstOrCreate(
                        ['phone' => $sdtNguoiGuiHS],
                        [
                            'name' => $nguoiGuiHS,
                            'email' => $emailNguoiGuiHS ?? 'sale_' . uniqid() . '@example.com',
                            'password' => bcrypt('12345678'),
                            'status' => 1
                        ]
                    );
                }
                // Gán role "sale" cho nhân viên sale
                $saleRole = Role::where('slug', ROLE_SALE)->first();
                if ($saleRole && !$sale->roles->contains($saleRole->id)) {
                    $sale->roles()->attach($saleRole->id);
                }

                // Thêm hoặc lấy Khoá học
                if (empty($khoa)) {
                    // Nếu $khoa rỗng, sử dụng khóa học với code là "no_code"
                    $course = Course::firstOrCreate(
                        ['code' => 'NO_CODE'],
                        [
                            'rank' => '', // Giá trị mặc định cho rank
                            'start_date' => null,
                            'end_date' => null,
                            'tuition_fee' => 0, // Giá trị mặc định cho học phí
                        ]
                    );
                } else {
                    // Nếu $khoa có giá trị, tạo hoặc lấy khóa học như bình thường
                    $course = Course::firstOrCreate(
                        ['code' => $khoa],
                        [
                            'rank' => $hang,
                            'start_date' => $ngayKhaiGiang,
                            'end_date' => $ngayBeGiang,
                            'tuition_fee' => $lePhiHoSo,
                        ]
                    );
                }

                // Thêm hoặc lấy Sân tập
                if ($sanTap) {
                    $examField = ExamField::firstOrCreate(
                        ['name' => $sanTap],
                        ['status' => 1]
                    );
                }

                // Kiểm tra xem cặp 'user_id' và 'course_id' đã tồn tại hay chưa
                $existingCourseUser = CourseUser::where('user_id', $user->id)
                    ->where('course_id', $course->id)
                    ->first();

                if ($existingCourseUser) {
                    ImportRow::create([
                        'import_log_id' => $importLog->id,
                        'course_user_id' => $existingCourseUser->id ?? null,
                        'row_data' => json_encode($row, JSON_UNESCAPED_UNICODE),
                        'success' => false,
                        'error_message' => 'Khoá học - Học viên này đã tồn tại.',
                    ]);
                    DB::commit();
                    continue;
                }

                // Thêm hoặc lấy CourseUser
                $notes = [];
                if ($note) {
                    $notes[] = "Ghi chú: " . $note;
                }
                if ($hang) {
                    $notes[] = "Hạng: " . $hang;
                }
                if ($sanTap) {
                    $notes[] = "Sân tập: " . $sanTap;
                }
                $noteString = implode("\n", $notes);
                $courseUser = CourseUser::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'note' => $noteString,
                    'health_check_date' => $khamSucKhoe,
                    'practice_field' => $examField->id,
                    'teacher_id' => $teacher->id,
                    'sale_id' => $sale->id,
                    'ngay_khai_giang' => $ngayKhaiGiang,
                    'ngay_be_giang' => $ngayBeGiang,
                    'tuition_fee' => $lePhiHoSo,
                    'contract_date' => $ngayKyHD
                ]);

                // Thêm học phí cho CourseUser
                if ($soTienLan1) {
                    Fee::create([
                        'course_user_id' => $courseUser->id,
                        'amount' => $soTienLan1,
                        'payment_date' => $ngayNapLan1,
                        'note' => $ghiChuLan1,
                        'is_received' => 1,
                        'admin_id' => $sale->id
                    ]);
                }
                if ($soTienLan2) {
                    Fee::create([
                        'course_user_id' => $courseUser->id,
                        'amount' => $soTienLan2,
                        'payment_date' => $ngayNapLan2,
                        'note' => $ghiChuLan2,
                        'is_received' => 1,
                        'admin_id' => $sale->id
                    ]);
                }

                // Thêm lịch học: Học cabin
                foreach ($hocCabins as $hocCabin) {
                    Calendar::create([
                        'name' => 'Học cabin',
                        'teacher_id' => $teacher->id,
                        'course_user_id' => $courseUser->id,
                        'type' => 'class_schedule',
                        'loai_hoc' => 'cabin',
                        'date_start' => $hocCabin['ngay'],
                        'so_gio_chay_duoc' => $hocCabin['gio'],
                        'status' => 40
                    ]);
                }

                // Thêm lịch học: Chạy dat
                foreach ($chayDats as $chayDat) {
                    Calendar::create([
                        'name' => 'Chạy DAT',
                        'teacher_id' => $teacher->id,
                        'course_user_id' => $courseUser->id,
                        'type' => 'class_schedule',
                        'loai_hoc' => 'chay_dat',
                        'date_start' => $chayDat['ngay'],
                        'so_gio_chay_duoc' => $chayDat['gio'],
                        'km' => $chayDat['km'],
                        'status' => 40
                    ]);
                }

                // Thêm lịch thi
                if ($ngayThi) {
                    switch ($ketQua) {
                        case 'Đỗ':
                            $ketQua = 31;
                            break;
                        case 'Thi lại':
                            $ketQua = 32;
                            break;
                        case 'Thi mới':
                            $ketQua = 33;
                            break;
                        default:
                            $ketQua = 30;
                            break;
                    }
                    Calendar::create([
                        'name' => 'Lịch thi',
                        'course_user_id' => $courseUser->id,
                        'type' => 'exam_schedule',
                        'date_start' => $ngayThi,
                        'sbd' => $sbd,
                        'so_tien' => $soTienThi,
                        'ngay_dong_hoc_phi' => $ngayDongThi,
                        'san_thi' => $sanThi,
                        'status' => $ketQua
                    ]);
                }

                DB::commit();
                // Lưu log thành công
                ImportRow::create([
                    'import_log_id' => $importLog->id,
                    'course_user_id' => $courseUser->id,
                    'row_data' => json_encode($row),
                    'success' => true,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();

                // Lưu log thất bại
                ImportRow::create([
                    'import_log_id' => $importLog->id,
                    'course_user_id' => null,
                    'row_data' => json_encode($row),
                    'success' => false,
                    'error_message' => $e->getMessage(),
                ]);

                continue;
            }
        }

        if ($request->ajax()) {
            return response()->json(['success' => 'Import thành công.']);
        }
    }

    public function importProgress(Request $request)
    {
        $userId = auth('admin')->id();
        $progressFile = storage_path('app/import_progress_' . $userId . '.json');

        if (file_exists($progressFile)) {
            $progress = json_decode(file_get_contents($progressFile), true);
            return response()->json($progress);
        }

        return response()->json(['total' => 0, 'processed' => 0]);
    }

    public function detail($id)
    {
        $courseUser = CourseUser::find($id);
        $exam = $courseUser->examField->name ?? '';
        return response()->json(['exam' => $exam]);
    }
}
