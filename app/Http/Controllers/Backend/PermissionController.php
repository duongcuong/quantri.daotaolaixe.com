<?php

namespace App\Http\Controllers\Backend;

use App\Models\Permission;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('module')
            ->join('modules', 'permissions.module_id', '=', 'modules.id')
            ->orderBy('modules.name')
            ->select('permissions.*')->paginate(LIMIT);
        return view('backend.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('backend.permissions.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:permissions',
            'module_id' => 'required|exists:modules,id',
        ]);

        Permission::create($request->all());
        toastr()->success('Thêm thành công');
        return redirect()->route('admins.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $modules = Module::all();
        return view('backend.permissions.edit', compact('permission', 'modules'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:permissions,slug,' . $permission->id,
            'module_id' => 'required|exists:modules,id',
        ]);

        $permission->update($request->all());
        toastr()->success('Cập nhật thành công');
        return redirect()->route('admins.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admins.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
