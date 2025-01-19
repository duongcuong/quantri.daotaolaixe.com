<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseUser;
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
        $users = User::all();
        $courses = Course::all();
        return view('backend.course-user.index', compact('users', 'courses'));
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

        CourseUser::create($request->all());

        toastr()->success('Thêm thành công');
        return redirect()->route('admins.course-user.index')->with('success', 'Course User created successfully.');

        // return response()->json(['success' => 'Thêm thành công.']);
    }

    public function show(CourseUser $courseUser)
    {
        $courseUsers = CourseUser::with('user', 'course', 'teacher', 'sale')->get();
        $admins = Admin::where('status', 1)->get();

        $courseUser->loadSum('fees', 'amount');

        return view('backend.course-user.show', compact('courseUser', 'courseUsers', 'admins'));
    }

    public function edit(CourseUser $courseUser)
    {
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

        toastr()->success('Cập nhật thành công');
        return redirect()->route('admins.course-user.index')->with('success', 'Course User updated successfully.');

        // return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(CourseUser $courseUser)
    {
        $courseUser->delete();
        return response()->json(['success' => 'Course User deleted successfully.']);
    }

    public function data(Request $request)
    {
        $query = CourseUser::with('user', 'course', 'teacher', 'sale')->orderBy('id', 'desc');

        if ($request->has('course_id') && $request->course_id != '') {
            $query->where('course_id', $request->course_id);
        }

        if ($request->has('teacher_id') && $request->teacher_id != '') {
            $query->where('teacher_id', $request->teacher_id);
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

        $courseUsers = $query->withSum('fees', 'amount');

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
        $data = Excel::toArray([], $file);

        DB::beginTransaction();
        try {
            foreach ($data[0] as $key => $row) {

                if ($key == 0) {
                    continue;
                }

                if ($key > 1400 && $key <= 1500) {
                    $status = $row[1];
                    $ngayKyHD = $row[3] ? Date::excelToDateTimeObject($row[3])->format('Y-m-d') : null;
                    $hoTen = $row[4];
                    $ngaySinh = getDateByExcel($row[5]);
                    $diaChi = $row[6];
                    $sdt = $row[7] ? "0" . $row[7] : null;
                    $hang = $row[8];
                    $khoa = trim($row[9]);
                    $ngayKhaiGiang = getDateByExcel($row[10]);
                    $ngayBeGiang = getDateByExcel($row[11]);
                    $ngayHocCaBin = getDateByExcel($row[12]);
                    $dayLai = $row[13];
                    $sanTap = $row[14];
                    $lePhiHoSo = getNumberCsExcel($row[15]);
                    $lePhiNopLan1 = getNumberCsExcel($row[16]);
                    $lePhiNopLan2 = getNumberCsExcel($row[17]);
                    $tinhTrang = $row[19];
                    $note = $row[20];
                    $ghiChu = $row[21];
                    $khamSucKhoe = $row[22] ? Date::excelToDateTimeObject($row[22])->format('Y-m-d') : null;
                    $nguoiGuiHS = $row[23];
                    $ngayThi = $row[24] ? Date::excelToDateTimeObject($row[22])->format('Y-m-d') : null;
                    $tongGio = $row[25] ? str_replace(',', '.', $row[25]) : 0;

                    $noteArrs = [];
                    if ($tinhTrang) $noteArrs[] = $tinhTrang;
                    if ($status) $noteArrs[] = $status;
                    if ($note) $noteArrs[] = $note;
                    if ($ghiChu) $noteArrs[] = $ghiChu;

                    // Nếu không có số điện thoại, random ra một số điện thoại
                    if (!$sdt) {
                        do {
                            $sdt = '09' . rand(10000000, 99999999);
                        } while (User::where('phone', $sdt)->exists());
                    }

                    // Tạo hoặc lấy học viên
                    $user = User::firstOrCreate(
                        ['phone' => $sdt],
                        [
                            'name' => $hoTen,
                            'dob' => $ngaySinh,
                            'email' => Str::slug($hoTen) . Str::random(5) . '@example.com',
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
