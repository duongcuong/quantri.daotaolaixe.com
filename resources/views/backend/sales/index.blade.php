@extends('backend.app')
@section('title')
Tất cả sale
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
                    <li class="breadcrumb-item active" aria-current="page">Sale</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.sales.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.sales.create') }}" data-toggle="tooltip"
            title="Tạo Sale"><i class="bx bx-plus"></i>Tạo Sale</a>
        {{-- @endif --}}
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-sales" id="search-form-sales" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="name" class="mr-2">Tên</label>
                    <select class="select2-ajax-single-all form-control" name="id"
                        data-placeholder="Chọn sale"
                        data-url="{{ route('admins.admins.lists', ['role' => ROLE_SALE]) }}"
                        data-selected-id="{{ session('sale_filters.id') }}">
                        <option></option>
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="start_date" class="mr-2">Ngày bắt đầu ký hợp đồng</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('sale_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Ngày kết thúc ký hợp đồng</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('sale_filters.end_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="status22" class="mr-2 opacity-0">Hành động </label><br>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"
                            style="display: none"></span>
                        Tìm kiếm
                    </button>
                    <button type="reset" class="btn btn-outline-danger m-1">
                        <i class="bx bx-refresh mr-1"></i>Refresh
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="table-header-fixed mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.sales.data') }}"
            id="load-data-ajax-sales" data-search="#search-form-sales">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
