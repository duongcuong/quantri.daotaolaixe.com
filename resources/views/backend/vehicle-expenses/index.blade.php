@extends('backend.app')
@section('title')
Tất cả chi phí xe
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
                    <li class="breadcrumb-item active" aria-current="page">Chi phí xe</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.vehicle-expenses.index')) --}}
        <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.vehicle-expenses.create') }}"
            data-cs-modal="#modal-vehicle-expenses-create-ajax" title="Tạo Chi Phí Xe"><i class="bx bx-plus"></i>Tạo Chi
            Phí Xe</a>
        {{-- @endif --}}
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-vehicle-expenses" id="search-form-vehicle-expenses"
            class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="license_plate" class="mr-2">Biển số xe</label>
                    <select class="select2-ajax-single-all form-control" name="vehicle_id"
                        data-selected-id="{{ session('expenses_filters.vehicle_id') }}" data-placeholder="Chọn xe"
                        data-url="{{ route('admins.vehicles.list') }}">
                        <option></option>
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="type">Loại chi phí</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">Chọn loại chi phí</option>
                        @foreach (listTypeVahicleExpenses() as $key => $value)
                        <option value="{{ $key }}" {{ session('expenses_filters.type')==$key ? 'selected' : '' }}>{{
                            $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="start_date" class="mr-2">Nộp từ ngày</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('vehicle-expenses_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Nộp đến ngày</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('vehicle-expenses_filters.end_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3 mb-3">
                    <label for="admin_id">Người chi</label>
                    <select class="select2-ajax-single form-control" name="admin_id" data-selected-id="{{ session('vehicle-expenses_filters.admin_id') }}"
                        data-placeholder="Chọn người chi"
                        data-url="{{ route('admins.admins.list', ['role'=> ROLE_VEHICLE_EXPENSE]) }}">
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="status22" class="opacity-0">Hành động </label>
                    <br>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            style="display: none"></span>
                        Tìm kiếm
                    </button>
                    <button type="reset" class="btn btn-outline-danger ml-1">
                        <i class="bx bx-refresh mr-1"></i>Refresh
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="table-header-fixed mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.vehicle-expenses.data') }}"
            id="load-data-ajax-vehicle-expenses" data-search="#search-form-vehicle-expenses">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
