<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Functions;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::orderBy('created_at', 'desc')->paginate(LIMIT);
        return view('backend.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles' => 'required|array',
        ]);

        $thumbnailPath = $request->hasFile('thumbnail') ? uploadImage($request->file('thumbnail'), 'admins') : null;

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'thumbnail' => $thumbnailPath,
        ]);

        $admin->roles()->sync($request->roles);
        toastr()->success('Thêm người dùng thành công');
        return redirect()->route('admins.admins.index')->with('success', 'Admin created successfully.');
    }

    public function show(Admin $admin)
    {
        return view('backend.admins.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('backend.admins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles' => 'required|array',
        ]);

        $data = $request->all();

        $thumbnailPath = $request->hasFile('thumbnail') ? uploadImage($request->file('thumbnail'), 'admins') : $admin->thumbnail;
        if ($thumbnailPath)
            $data['thumbnail'] = $thumbnailPath;

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
            'status' => $request->status,
            'thumbnail' => $thumbnailPath,
        ]);

        $admin->roles()->sync($request->roles);
        toastr()->success('Cập nhật người dùng thành công');
        return redirect()->route('admins.admins.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        toastr()->success('Xoá người dùng thành công');
        return redirect()->route('admins.admins.index')->with('success', 'Admin deleted successfully.');
    }

    public function list(Request $request)
    {
        $query = Admin::orderBy('id', 'desc');

        if ($request->has('id')) {
            $query->where('id', $request->id);
        }

        if ($request->has('role')) {
            $roles = explode(',', $request->role);
            $query->whereHas('roles', function ($q) use ($roles) {
                $q->whereIn('slug', $roles);
            });
        }

        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $admins = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return response()->json([
                'datas' => $admins
            ]);
        }
    }
}
