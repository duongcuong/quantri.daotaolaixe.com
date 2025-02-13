<?php
namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class SaleController extends Controller
{
    public function index()
    {
        return view('backend.sales.index');
    }

    public function create()
    {
        return view('backend.sales.create');
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
            'address' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);
        $data = $request->all();
        $data['rank'] = $request->rank ? json_encode($request->rank) : "";
        $data['password'] = Hash::make('123456');

        $thumbnailPath = $request->hasFile('thumbnail') ? uploadImage($request->file('thumbnail'), 'admins') : null;

        if ($thumbnailPath)
            $data['thumbnail'] = $thumbnailPath;

        $admin = Admin::create($data);
        $admin->roles()->attach(Role::where('slug', ROLE_SALE)->first());

        toastr()->success('Thêm thành công');
        return redirect()->route('admins.sales.index')->with('success', 'Sale created successfully.');
    }

    public function show(Admin $sale)
    {
        return view('backend.sales.show', compact('sale'));
    }

    public function edit(Admin $sale)
    {
        return view('backend.sales.edit', compact('sale'));
    }

    public function update(Request $request, Admin $sale)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $sale->id,
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

        $sale->update($data);

        toastr()->success('Cập nhật thành công');
        return redirect()->route('admins.sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Admin $sale)
    {
        $sale->delete();
        toastr()->success('Xoá người dùng thành công');
        return redirect()->route('admins.sales.index')->with('success', 'Sale deleted successfully.');
    }

    public function data(Request $request)
    {
        $query = Admin::orderBy('created_at', 'desc')->whereHas('roles', function ($query) {
            $query->where('slug', ROLE_SALE);
        }); // Sử dụng phân trang với 10 mục mỗi trang

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $sales = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.sales.partials.data', compact('sales'))->render();
        }

        return view('backend.sales.index', compact('sales'));
    }
}
