<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        User::create($data);

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
        $query = User::orderBy('created_at', 'desc'); // Sử dụng phân trang với 10 mục mỗi trang

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('created_at') && $request->created_at) {
            $date = \Carbon\Carbon::createFromFormat('Y-m', $request->created_at);
            $query->whereMonth('created_at', $date->month)
                  ->whereYear('created_at', $date->year);
        }

        $users = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.users.partials.data', compact('users'))->render();
        }

        return view('backend.users.index', compact('users'));
    }
}
