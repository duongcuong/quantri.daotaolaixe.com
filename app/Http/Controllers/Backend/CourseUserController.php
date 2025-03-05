<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\ExamField;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Fee;
use App\Models\Role;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

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
        return view('backend.course-user.create');
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
        $courseUser->loadSum('calendars', 'km');
        $courseUser->loadSum('calendars', 'so_gio_chay_duoc');

        return view('backend.course-user.show', compact('courseUser', 'courseUsers', 'admins'));
    }

    public function edit(CourseUser $courseUser)
    {
        $courseUser->loadSum('calendars', 'km');
        $courseUser->loadSum('calendars', 'so_gio_chay_duoc');
        return view('backend.course-user.edit', compact('courseUser'));
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

        $query = CourseUser::with('user', 'course', 'teacher', 'sale')->orderBy('id', 'desc');

        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('course_id') && $request->course_id != '') {
            $query->where('course_id', $request->course_id);
        }

        if ($request->has('teacher_id') && $request->teacher_id != '') {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->has('exam_field_id') && $request->exam_field_id != '') {
            $query->where('exam_field_id', $request->exam_field_id);
        }

        if ($request->has('contract_day') && $request->contract_day) {
            $contractDay = $request->contract_day;
            if ($request->has('contract_month') && $request->contract_month) {
                $contractMonthYear = $request->contract_month;
            } else {
                $contractMonthYear = now()->format('Y-m');
            }
            $date = Carbon::createFromFormat('Y-m-d', $contractMonthYear . '-' . $contractDay);
            $query->whereDate('contract_date', $date);
        } elseif ($request->has('contract_month') && $request->contract_month) {
            $contractMonthYear = Carbon::createFromFormat('Y-m', $request->contract_month);
            $query->whereYear('contract_date', $contractMonthYear->year)
                ->whereMonth('contract_date', $contractMonthYear->month);
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

        if ($request->has('tuition_status') && $request->tuition_status != '') {
            $query->whereHas('fees', function ($q) use ($request) {
                if ($request->tuition_status == 'paid') {
                    $q->havingRaw('SUM(amount) >= course_users.tuition_fee');
                } else {
                    $q->havingRaw('SUM(amount) < course_users.tuition_fee');
                }
            });
        }

        $courseUsers = $query->withSum('fees', 'amount')->withSum('calendars', 'km')
            ->withSum('calendars', 'so_gio_chay_duoc');

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
        echo "Tính năng này đang phát triển, vui lòng quay lại sau.";
        die;
        $file = $request->file('file_xlsx');
        $data = Excel::toArray([], $file);

        DB::beginTransaction();
        try {
            foreach ($data[0] as $key => $row) {

                if ($key == 0 || $key == 1 || $key == 2) {
                    continue;
                }

                $ngayKyHD = getDateByExcel($row[1]);
                $hoTen = $row[2];
                $sdt = $row[3];
                $ngaySinh = getDateByExcel($row[4]);
                $email = $row[5];
                $diaChi = $row[6];

                $hang = $row[7];
                $khoa = $row[8];
                $ngayKhaiGiang = getDateByExcel($row[9]);
                $ngayBeGiang = getDateByExcel($row[10]);

                $thayDay = $row[11];
                $emailThayDay = $row[12];
                $sdtThayDay = $row[13];

                $lePhiHoSo = getNumberCsExcel($row[14]);

                $fees = [];
                $soTienLan1 = getNumberCsExcel($row[15]);
                $ngayNapLan1 = getDateByExcel($row[16]);
                $ghiChuLan1 = $row[17];
                $soTienLan2 = getNumberCsExcel($row[18]);
                $ngayNapLan2 = getDateByExcel($row[19]);
                $ghiChuLan2 = $row[20];

                if($soTienLan1){
                    $fees[] = [
                        'so_tien' => $soTienLan1,
                        'ngay_nop' => $ngayNapLan1,
                        'ghi_chu' => $ghiChuLan1
                    ];
                }
                if($soTienLan2){
                    $fees[] = [
                        'so_tien' => $soTienLan2,
                        'ngay_nop' => $ngayNapLan2,
                        'ghi_chu' => $ghiChuLan2
                    ];
                }

                $nguoiGuiHS = $row[21];
                $sdtNguoiGuiHS = $row[22];
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

                $hocCabins = [];
                if($row[33] && $row[34]) {
                    $hocCabins[] = [
                        'ngay' => getDateByExcel($row[33]),
                        'gio' => convertHoursExcelToSeconds($row[34])
                    ];
                }

                if($row[35] && $row[36]) {
                    $hocCabins[] = [
                        'ngay' => getDateByExcel($row[35]),
                        'gio' => convertHoursExcelToSeconds($row[36])
                    ];
                }

                if($row[37] && $row[38]) {
                    $hocCabins[] = [
                        'ngay' => getDateByExcel($row[37]),
                        'gio' => convertHoursExcelToSeconds($row[38])
                    ];
                }

                if($row[39] && $row[40]) {
                    $hocCabins[] = [
                        'ngay' => getDateByExcel($row[39]),
                        'gio' => convertHoursExcelToSeconds($row[40])
                    ];
                }

                $chayDats = [];
                if($row[41] && $row[42] && $row[43]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[41]),
                        'gio' => convertHoursExcelToSeconds($row[42]),
                        'km' => $row[43]
                    ];
                }

                if($row[44] && $row[45] && $row[46]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[44]),
                        'gio' => convertHoursExcelToSeconds($row[45]),
                        'km' => $row[46]
                    ];
                }

                if($row[47] && $row[48] && $row[49]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[47]),
                        'gio' => convertHoursExcelToSeconds($row[48]),
                        'km' => $row[49]
                    ];
                }

                if($row[50] && $row[51] && $row[52]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[50]),
                        'gio' => convertHoursExcelToSeconds($row[51]),
                        'km' => $row[52]
                    ];
                }

                if($row[53] && $row[54] && $row[55]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[53]),
                        'gio' => convertHoursExcelToSeconds($row[54]),
                        'km' => $row[55]
                    ];
                }

                if($row[56] && $row[57] && $row[58]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[56]),
                        'gio' => convertHoursExcelToSeconds($row[57]),
                        'km' => $row[58]
                    ];
                }

                if($row[59] && $row[60] && $row[61]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[59]),
                        'gio' => convertHoursExcelToSeconds($row[60]),
                        'km' => $row[61]
                    ];
                }

                if($row[62] && $row[63] && $row[64]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[62]),
                        'gio' => convertHoursExcelToSeconds($row[63]),
                        'km' => $row[64]
                    ];
                }

                if($row[65] && $row[66] && $row[67]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[65]),
                        'gio' => convertHoursExcelToSeconds($row[66]),
                        'km' => $row[67]
                    ];
                }

                if($row[68] && $row[69] && $row[70]) {
                    $chayDats[] = [
                        'ngay' => getDateByExcel($row[68]),
                        'gio' => convertHoursExcelToSeconds($row[69]),
                        'km' => $row[70]
                    ];
                }

                // Tạo hoặc lấy học viên
                $user = User::firstOrCreate(
                    ['phone' => $sdt],
                    [
                        'name' => $hoTen,
                        'dob' => $ngaySinh,
                        'email' => $email,
                        'address' => $diaChi,
                        'password' => bcrypt('12345678'),
                        'status' => 1
                    ]
                );

                // Nếu $dayLai rỗng, lấy random một tài khoản giáo viên
                if (empty($dayLai)) {
                    $teacher = Admin::whereHas('roles', function ($query) {
                        $query->where('slug', ROLE_TEACHER);
                    })->inRandomOrder()->first();
                    $dayLai = $teacher->name;
                    $note .= ' Học viên này chưa có giáo viên, đây là giáo viên random.';
                } else {
                    // Tạo hoặc lấy giáo viên
                    $teacher = Admin::firstOrCreate(
                        ['name' => $dayLai],
                        [
                            'email' => Str::slug($dayLai) . Str::random(5) . '@example.com',
                            'phone' => '09' . rand(10000000, 99999999),
                            'rank' => json_encode([$hang]),
                            'password' => bcrypt('12345678'),
                            'status' => 1
                        ]
                    );
                    $teacherRole = Role::where('slug', ROLE_TEACHER)->first();
                    if ($teacherRole) {
                        $teacher->roles()->syncWithoutDetaching([$teacherRole->id]);
                    }
                }

                // Tạo hoặc lấy sale
                if (!empty($nguoiGuiHS)) {
                    $sale = Admin::firstOrCreate(
                        ['name' => $nguoiGuiHS],
                        [
                            'email' => Str::slug($nguoiGuiHS) . Str::random(5) . '@example.com',
                            'phone' => '09' . rand(10000000, 99999999),
                            'password' => bcrypt('12345678'),
                            'status' => 1
                        ]
                    );

                    $saleRole = Role::where('slug', ROLE_SALE)->first();
                    if ($saleRole) {
                        $sale->roles()->syncWithoutDetaching([$saleRole->id]);
                    }
                }

                if (empty($khoa)) {
                    $course = Course::inRandomOrder()->first();
                    $khoa = $course->code;
                    $noteArrs[] = 'Học viên này chưa có khoá học, đây là khoá học random.';
                } else {
                    $course = Course::firstOrCreate(
                        ['code' => $khoa],
                        [
                            'rank' => $hang,
                            'rank_gp' => $hang,
                            'status' => 1,
                            'tuition_fee' => $lePhiHoSo
                        ]
                    );
                }

                // Kiểm tra nếu cặp user_id và course_id đã tồn tại
                $courseUser = CourseUser::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'course_id' => $course->id
                    ],
                    [
                        'status' => 1,
                        'practice_field' => $sanTap,
                        'hours' => $tongGio,
                        'note' => implode(' - ', $noteArrs),
                        'teacher_id' => $teacher->id,
                        'sale_id' => !empty($sale) ? $sale->id : null,
                        'ngay_khai_giang' => $ngayKhaiGiang,
                        'ngay_be_giang' => $ngayBeGiang,
                        'ngay_hoc_cabin' => $ngayHocCaBin,
                        'health_check_date' => $khamSucKhoe,
                        'exam_date' => $ngayThi,
                        'contract_date' => $ngayKyHD,
                        'tuition_fee' => $lePhiHoSo
                    ]
                );

                // Tạo các bản ghi trong bảng fees
                if ($lePhiNopLan1) {
                    Fee::create([
                        'payment_date' => Carbon::now()->format('Y-m-d'),
                        'amount' => $lePhiNopLan1,
                        'admin_id' => $sale->id,
                        'is_received' => 1,
                        'course_user_id' => $courseUser->id,
                        'note' => $tinhTrang
                    ]);
                }

                if ($lePhiNopLan2) {
                    Fee::create([
                        'payment_date' => Carbon::now()->format('Y-m-d'),
                        'amount' => $lePhiNopLan2,
                        'admin_id' => $sale->id,
                        'is_received' => 1,
                        'course_user_id' => $courseUser->id,
                        'note' => $tinhTrang
                    ]);
                }
            }

            DB::commit();
            toastr()->success('Import thành công.');
            return redirect()->back()->with('success', 'Import thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            var_dump("Lỗi tại dòng $key, vui lòng kiểm tra lại file trước khi upload");
            dd($e->getMessage());
            toastr()->error('Có lỗi xẩy ra khi import file: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error importing the file: ' . $e->getMessage());
        }
    }
}
