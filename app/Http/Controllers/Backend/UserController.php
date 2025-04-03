<?php

namespace App\Http\Controllers\backend;

use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CourseUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.users.index');
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'nullable|integer|in:0,1,2',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'identity_card' => 'nullable|string|max:255|unique:users',
            'address' => 'nullable|string|max:255',
            'card_name' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);
        $data = $request->all();
        $data['rank'] = $request->rank ? json_encode($request->rank) : "";
        $data['password'] = Hash::make('123456');

        $thumbnailPath = $request->hasFile('thumbnail') ? uploadImage($request->file('thumbnail'), 'users') : null;
        $data['thumbnail'] = $thumbnailPath;

        $user = User::create($data);

        $course = Course::firstOrCreate(
            ['code' => 'NO_CODE'],
            [
                'rank' => '', // Giá trị mặc định cho rank
                'start_date' => null,
                'end_date' => null,
                'tuition_fee' => 0, // Giá trị mặc định cho học phí
            ]
        );

        $teacher = Admin::firstOrCreate(
            ['phone' => 'NO_PHONE_TEACHER'],
            [
                'name' => 'No Teacher',
                'email' => 'no_teacher_' . uniqid() . '@example.com',
                'password' => bcrypt('12345678'),
                'status' => 1,
            ]
        );
        // Gán role "teacher" cho giáo viên
        if ($teacher->wasRecentlyCreated) {
            $teacherRole = Role::where('slug', ROLE_TEACHER)->first();
            if ($teacherRole && !$teacher->roles->contains($teacherRole->id)) {
                $teacher->roles()->attach($teacherRole->id);
            }
        }

        $sale = Admin::firstOrCreate(
            ['phone' => 'NO_PHONE_SALE'],
            [
                'name' => 'No Sale',
                'email' => 'no_sale_' . uniqid() . '@example.com', // Email ngẫu nhiên
                'password' => bcrypt('12345678'), // Mật khẩu mặc định
                'status' => 1
            ]
        );
        // Gán role "sale" cho nhân viên sale
        if ($sale->wasRecentlyCreated) {
            $saleRole = Role::where('slug', ROLE_SALE)->first();
            if ($saleRole && !$sale->roles->contains($saleRole->id)) {
                $sale->roles()->attach($saleRole->id);
            }
        }

        CourseUser::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'teacher_id' => $teacher->id,
            'sale_id' => $sale->id,
            'contract_date' => now(),
        ]);

        toastr()->success('Thêm thành công');
        return redirect()->route('admins.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('backend.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('backend.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'nullable|integer|in:0,1,2',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'identity_card' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'card_name' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        $data = $request->all();

        $thumbnailPath = $request->hasFile('thumbnail') ? uploadImage($request->file('thumbnail'), 'users') : null;
        if ($thumbnailPath)
            $data['thumbnail'] = $thumbnailPath;

        $user->update($data);

        toastr()->success('Cập nhật thành công');
        return redirect()->route('admins.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        toastr()->success('Xoá người dùng thành công');
        return redirect()->route('admins.users.index')->with('success', 'User deleted successfully.');
    }

    public function list(Request $request)
    {
        $query = User::orderBy('id', 'desc');

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

    public function detail($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function data(Request $request)
    {
        // Lưu các giá trị bộ lọc vào session
        session(['user_filters' => $request->all()]);

        $query = User::query();

        $hasSearch = false;

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
            $hasSearch = true;
        }

        // Thêm điều kiện lọc theo khoảng thời gian date_start
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
            $hasSearch = true;
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
            $hasSearch = true;
        }

        if ($hasSearch) {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        $users = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.users.partials.data', compact('users'))->render();
        }

        return view('backend.users.index', compact('users'));
    }
}
