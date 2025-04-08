<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleExpenseController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.vehicle-expenses.index');
    }

    public function create(Request $request)
    {
        $vehicles = Vehicle::all();
        return view('backend.vehicle-expenses.modals.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'required|exists:vehicles,id',
            'admin_id' => 'required|exists:admins,id',
            'type' => 'required|string',
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        VehicleExpense::create($request->all());

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function edit(VehicleExpense $vehicle_expense, Request $request)
    {
        $vehicles = Vehicle::all();
        return view('backend.vehicle-expenses.modals.edit', compact('vehicle_expense', 'vehicles'));
    }

    public function update(Request $request, VehicleExpense $vehicle_expense)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'required|exists:vehicles,id',
            'admin_id' => 'required|exists:admins,id',
            'type' => 'required|string',
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $vehicle_expense->update($request->all());

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(VehicleExpense $fee)
    {
        $fee->delete();
        return response()->json(['success' => 'Course deleted successfully.']);
    }

    public function data(Request $request)
    {
        // Lưu các giá trị bộ lọc vào session
        session(['vehicle_expenses_filters' => $request->all()]);

        $query = VehicleExpense::latest();
        $query->with(['vehicle', 'admin']);

        // Lấy danh sách các loại phí từ Vahicle expense
        if ($request->has('vehicle_id') && $request->vehicle_id != '') {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        // Tìm kiếm theo license_plate trong bảng Vehicle
        if ($request->has('license_plate') && $request->license_plate != '') {
            $query->whereHas('vehicle', function ($q) use ($request) {
                $q->where('license_plate', 'like', '%' . $request->license_plate . '%');
            });
        }

        // Thêm điều kiện lọc theo khoảng thời gian date_start
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('expense_date', '>=', $request->start_date);
            $hasSearch = true;
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('expense_date', '<=', $request->end_date);
            $hasSearch = true;
        }

        $vehicle_expenses = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.vehicle-expenses.partials.data', compact('vehicle_expenses'))->render();
        }

        return view('backend.vehicle-expenses.index', compact('fees', 'feeTotal'));
    }
}
