@extends('backend.app')
@section('title')
Xem chi tiết xe
@endsection
@push('css')
@endpush
@section('content')
<div class="d-flex mb-3">
    <div class="page-breadcrumb d-flex align-items-center">
        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i
                                class='bx bx-home-alt'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $vehicle->license_platename }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.vehicles.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.vehicles.index') }}" data-toggle="tooltip"
            title="Quay về trang quản lý xe - Học viên &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
        {{-- @endif --}}
    </div>
</div>

<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Thông tin <strong>{{ $vehicle->license_plate }}</strong>
                    </h5>
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th colspan="2">Biển số xe</th>
                            <td>
                                {{ $vehicle->license_plate }}
                            </td>
                        </tr>

                        <tr>
                            <th colspan="2">Model</th>
                            <td>{{ $vehicle->model }}</td>
                        </tr>

                        <tr>
                            <th colspan="2">Hạng</th>
                            <td>{{ $vehicle->rank }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Loại</th>
                            <td>{!! $vehicle->type !!}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Màu sắc</th>
                            <td>{{ $vehicle->color }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Số GPTL</th>
                            <td>{{ $vehicle->gptl_number }}</td>
                        </tr>
                        {{-- <tr>
                            <th colspan="2">Ngày hết hạn GPTL</th>
                            <td>{{ getDateTimeStamp($vehicle->gptl_expiry_date) }}</td>
                        </tr> --}}
                        <tr>
                            <th colspan="2">Năm SX</th>
                            <td>{{ $vehicle->manufacture_year }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.vehicles.partials.vehicle-expenses')

@endsection
@push('js')
@endpush
