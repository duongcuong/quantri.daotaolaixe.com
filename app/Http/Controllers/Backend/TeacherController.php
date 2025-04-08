<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        return view('backend.teachers.index');
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('backend.teachers.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'nullable|integer|in:0,1,2',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'identity_card' => 'nullable|string|max:255|unique:admins',
            'address' => 'nullable|string|max:255',
            'rank' => 'nullable|array',
            'rank.*' => 'nullable|string|max:255',
            'license' => 'nullable|string|max:255',
            // 'card_name' => 'nullable|string|max:255',
            // 'card_number' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);
        $data = $request->all();
        $data['rank'] = $request->rank ? json_encode($request->rank) : "";
        $data['password'] = Hash::make('123456');

        $thumbnailPath = $request->hasFile('thumbnail') ? uploadImage($request->file('thumbnail'), 'admins') : null;

        if ($thumbnailPath)
            $data['thumbnail'] = $thumbnailPath;

        $admin = Admin::create($data);
        $admin->roles()->attach(Role::where('slug', ROLE_TEACHER)->first());

        toastr()->success('Thêm thành công');
        return redirect()->route('admins.teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function show(Admin $teacher)
    {
        return view('backend.teachers.show', compact('teacher'));
    }

    public function edit(Admin $teacher)
    {
        $vehicles = Vehicle::all();
        return view('backend.teachers.edit', compact('teacher', 'vehicles'));
    }

    public function update(Request $request, Admin $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $teacher->id,
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'nullable|integer|in:0,1,2',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'identity_card' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'rank' => 'nullable|array',
            'rank.*' => 'nullable|string|max:255',
            'license' => 'nullable|string|max:255',
            // 'card_name' => 'nullable|string|max:255',
            // 'card_number' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        $data = $request->all();
        $data['rank'] = $request->rank ? json_encode($request->rank) : "";

        $thumbnailPath = $request->hasFile('thumbnail') ? uploadImage($request->file('thumbnail'), 'admins') : null;
        $data['thumbnail'] = $thumbnailPath;

        $teacher->update($data);

        toastr()->success('Cập nhật thành công');
        return redirect()->route('admins.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Admin $teacher)
    {
        $teacher->delete();
        toastr()->success('Xoá người dùng thành công');
        return redirect()->route('admins.teachers.index')->with('success', 'Teacher deleted successfully.');
    }

    public function data(Request $request)
    {
        // Lưu các giá trị bộ lọc vào session
        $filters = $request->all();
        session(['teacher_filters' => $filters]);

        $hasSearch = false;
        $query = Admin::whereHas('roles', function ($query) {
            $query->where('slug', ROLE_TEACHER);
        }); // Sử dụng phân trang với 10 mục mỗi trang

        $query->withSum([
            'calendars' => function ($query) {
                $query->where('approval', true)
                    ->where('type', 'class_schedule')
                    ->whereIn('loai_hoc', listStatusApprovedKm());
            }
        ], 'so_gio_chay_duoc');

        $loaiHocs = listStatusApprovedKm();
        foreach ($loaiHocs as $loaiHoc) {
            $query->withSum(['calendars as so_gio_chay_duoc_' . $loaiHoc => function ($query) use ($loaiHoc) {
                $query->where('approval', true)
                    ->where('type', 'class_schedule')
                    ->where('loai_hoc', $loaiHoc);
            }], 'so_gio_chay_duoc');
        }

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

        $teachers = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.teachers.partials.data', compact('teachers'))->render();
        }

        return view('backend.teachers.index', compact('teachers'));
    }
}
