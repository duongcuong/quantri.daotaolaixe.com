@extends('backend.app')
@section('title')
Tất cả Leads
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
                    <li class="breadcrumb-item active" aria-current="page">Danh sách Leads</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.leads.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.leads.create') }}" title="Tạo Lead"><i
                class="bx bx-plus"></i>Tạo Lead</a>
        {{-- @endif --}}
    </div>
</div>

{{-- <div class="card radius-15">
    <div class="card-body">

    </div>
</div> --}}

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-leads" id="search-form-leads" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="name" class="mr-2">Tên</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên" value="{{ session('leads_filters.name') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="course_id" class="mr-2">Người phụ trách</label>
                    <select class="select2-ajax-single form-control" name="assigned_to" data-selected-id="{{ session('leads_filters.assigned_to') }}"
                        data-placeholder="Chọn Người phụ trách"
                        data-url="{{ route('admins.admins.list', ['role'=> ROLE_SALES]) }}">
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="start_date" class="mr-2">Ngày bắt đầu</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('leads_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Ngày kết thúc</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('leads_filters.end_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="interest_level">Mức độ quan tâm</label>
                    <select name="interest_level" id="interest_level" class="form-control">
                        <option value="">Chọn mức độ quan tâm</option>
                        @foreach (listLevels() as $key => $item)
                        <option value="{{ $key }}" {{ old('interest_level')==$key ? 'selected' : '' }} {{ session('leads_filters.interest_level') == $key ? 'selected' : '' }}>{{ $item
                            }}</option>
                        @endforeach
                    </select>
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
        <div class="table-header-fixed mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.leads.data') }}"
            id="load-data-ajax-leads" data-search="#search-form-leads">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
