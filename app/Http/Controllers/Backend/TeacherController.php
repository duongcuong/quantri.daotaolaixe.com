<?php
namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        return view('backend.teachers.index');
    }

    public function create()
    {
        return view('backend.teachers.create');
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
        return view('backend.teachers.edit', compact('teacher'));
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
        $teachers = Admin::orderBy('created_at', 'desc')->whereHas('roles', function ($query) {
            $query->where('slug', 'giao-vien');
        })->paginate(LIMIT); // Sử dụng phân trang với 10 mục mỗi trang

        if ($request->ajax()) {
            return view('backend.teachers.partials.data', compact('teachers'))->render();
        }

        return view('backend.teachers.index', compact('teachers'));
    }
}
