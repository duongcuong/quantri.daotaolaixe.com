<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return view('backend.vehicles.index');
    }

    public function create()
    {
        return view('backend.vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|unique:vehicles',
            'model' => 'nullable|string',
            'rank' => 'nullable|string',
            'type' => 'nullable|string',
            'color' => 'nullable|string',
            'gptl_number' => 'nullable|string',
            'gptl_expiry_date' => 'nullable|date',
            'manufacture_year' => 'nullable|integer',
        ]);

        Vehicle::create($request->all());

        toastr()->success('Thêm thành công');
        return redirect()->route('admins.vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('backend.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('backend.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            'model' => 'nullable|string',
            'rank' => 'nullable|string',
            'type' => 'nullable|string',
            'color' => 'nullable|string',
            'gptl_number' => 'nullable|string',
            'gptl_expiry_date' => 'nullable|date',
            'manufacture_year' => 'nullable|integer',
        ]);

        $vehicle->update($request->all());

        toastr()->success('Cập nhật thành công');
        return redirect()->route('admins.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        toastr()->success('Xoá thành công');
        return redirect()->route('admins.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function data(Request $request)
    {
        // Lưu các giá trị bộ lọc vào session
        $filters = $request->all();
        session(['vehicle_filters' => $filters]);

        $hasSearch = false;
        $query = Vehicle::withSum('calendars', 'so_gio_chay_duoc')->latest();

        if ($request->has('license_plate') && $request->license_plate) {
            $query->where('license_plate', 'like', '%' . $request->license_plate . '%');
            $hasSearch = true;
        }

        // Thêm điều kiện lọc theo khoảng thời gian date_start
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('gptl_expiry_date', '>=', $request->start_date);
            $hasSearch = true;
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('gptl_expiry_date', '<=', $request->end_date);
            $hasSearch = true;
        }

        $vehicles = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.vehicles.partials.data', compact('vehicles'))->render();
        }

        return view('backend.vehicles.index', compact('vehicles'));
    }

    public function list(Request $request){
        $vehicles = Vehicle::all();
        foreach ($vehicles as $vehicle) {
            $vehicle->name = $vehicle->license_plate;
        }

        if ($request->ajax()) {
            return response()->json([
                'items' => $vehicles
            ]);
        }
    }
}
