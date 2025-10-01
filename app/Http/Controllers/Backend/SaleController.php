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
        // Lưu các giá trị bộ lọc vào session
        session(['sale_filters' => $request->all()]);

        $hasSearch = false;

        $query = Admin::whereHas('roles', function ($query) {
            $query->where('slug', ROLE_SALE);
        })->withCount([
            'courseUsers' => function ($query) use ($request, &$hasSearch) {
                // Thêm điều kiện lọc theo khoảng thời gian contract_date
                if ($request->has('start_date') && $request->start_date) {
                    $query->whereDate('contract_date', '>=', $request->start_date);
                    $hasSearch = true;
                }

                if ($request->has('end_date') && $request->end_date) {
                    $query->whereDate('contract_date', '<=', $request->end_date);
                    $hasSearch = true;
                }
            },
            'leads' => function ($query) use ($request, &$hasSearch) {
                // Thêm điều kiện lọc theo khoảng thời gian created_at
                if ($request->has('start_date') && $request->start_date) {
                    $query->whereDate('created_at', '>=', $request->start_date);
                    $hasSearch = true;
                }

                if ($request->has('end_date') && $request->end_date) {
                    $query->whereDate('created_at', '<=', $request->end_date);
                    $hasSearch = true;
                }
            }
        ]);

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
            $hasSearch = true;
        }

        if ($request->has('id') && $request->id) {
            $query->where('id', $request->id);
        }

        if ($hasSearch) {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        $sales = $query->paginate(LIMIT);

        // Tính tổng số course_users và leads cho tất cả các bản ghi được tìm kiếm
        $totals = Admin::whereHas('roles', function ($query) {
            $query->where('slug', ROLE_SALE);
        })->withCount([
            'courseUsers' => function ($query) use ($request) {
                if ($request->has('start_date') && $request->start_date) {
                    $query->whereDate('contract_date', '>=', $request->start_date);
                }

                if ($request->has('end_date') && $request->end_date) {
                    $query->whereDate('contract_date', '<=', $request->end_date);
                }
            },
            'leads' => function ($query) use ($request) {
                if ($request->has('start_date') && $request->start_date) {
                    $query->whereDate('created_at', '>=', $request->start_date);
                }

                if ($request->has('end_date') && $request->end_date) {
                    $query->whereDate('created_at', '<=', $request->end_date);
                }
            }
        ]);

        // Thêm điều kiện lọc theo name
        if ($request->has('name') && $request->name) {
            $totals->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('id') && $request->id) {
            $totals->where('id', $request->id);
        }

        $totals = $totals->get();

        $totalCourseUsers = $totals->sum('course_users_count');
        $totalLeads = $totals->sum('leads_count');

        if ($request->ajax()) {
            return view('backend.sales.partials.data', compact('sales', 'totalCourseUsers', 'totalLeads'))->render();
        }

        return view('backend.sales.index', compact('sales', 'totalCourseUsers', 'totalLeads'));
    }

    public function bxh(Request $request)
    {
        return view('backend.sales.bxh');
    }

    public function dataBxh(Request $request)
    {
        // Lưu filter vào session
        session(['sale_bxh_filters' => $request->all()]);

        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        $query = Admin::whereHas('roles', function ($q) {
            $q->where('slug', ROLE_SALE);
        })
            ->withSum(['courseUsers as total_revenue' => function ($q) use ($startDate, $endDate) {
                if ($startDate) $q->whereDate('contract_date', '>=', $startDate);
                if ($endDate) $q->whereDate('contract_date', '<=', $endDate);
            }], 'tuition_fee')
            ->withCount(['courseUsers as total_contracts' => function ($q) use ($startDate, $endDate) {
                if ($startDate) $q->whereDate('contract_date', '>=', $startDate);
                if ($endDate) $q->whereDate('contract_date', '<=', $endDate);
            }]);

        // Sắp xếp giảm dần theo doanh thu rồi số hợp đồng

        $orderBxh = $request->order_xh;

        if ($orderBxh == 'doanh_thu') {
            $query->orderByDesc('total_revenue');
        } else {
            $query->orderByDesc('total_contracts');
        }

        $sales = $query->paginate(LIMIT);

        // Tổng cộng để hiển thị trên đầu
        $totals = Admin::whereHas('roles', function ($q) {
            $q->where('slug', ROLE_SALE);
        })
            ->withSum(['courseUsers as total_revenue' => function ($q) use ($startDate, $endDate) {
                if ($startDate) $q->whereDate('contract_date', '>=', $startDate);
                if ($endDate) $q->whereDate('contract_date', '<=', $endDate);
            }], 'tuition_fee')
            ->withCount(['courseUsers as total_contracts' => function ($q) use ($startDate, $endDate) {
                if ($startDate) $q->whereDate('contract_date', '>=', $startDate);
                if ($endDate) $q->whereDate('contract_date', '<=', $endDate);
            }])
            ->get();

        $totalRevenueAll   = $totals->sum('total_revenue');
        $totalContractsAll = $totals->sum('total_contracts');

        if ($request->ajax()) {
            return view('backend.sales.partials.data-bxh', compact('sales', 'totalRevenueAll', 'totalContractsAll'))->render();
        }

    }
}
