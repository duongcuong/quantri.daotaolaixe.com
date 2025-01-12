<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::paginate(LIMIT);
        return view('backend.modules.index', compact('modules'));
    }

    public function create()
    {
        return view('backend.modules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:modules,name',
        ]);

        Module::create($request->all());
        toastr()->success('Thêm thành công');
        return redirect()->route('admins.modules.index')->with('success', 'Module created successfully.');
    }

    public function edit(Module $module)
    {
        return view('backend.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:modules,name,' . $module->id,
        ]);

        $module->update($request->all());
        toastr()->success('Sửa thành công');
        return redirect()->route('admins.modules.index')->with('success', 'Module updated successfully.');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        toastr()->success('Xoá thành công');
        return redirect()->route('admins.modules.index')->with('success', 'Module deleted successfully.');
    }
}
