@extends('backend.app')
@section('title')
Tất cả giáo viên
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
                    <li class="breadcrumb-item active" aria-current="page">Giáo viên</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        @if (canAccess('admins.teachers.create'))
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.teachers.create') }}" data-toggle="tooltip"
            title="Thêm giáo viên mới"><i class="bx bx-plus"></i>Thêm giáo viên mới</a>
        @endif
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-teachers" id="search-form-teachers" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="name" class="mr-2">Tên</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên" value="{{ session('teacher_filters.name') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="start_date" class="mr-2">Ngày bắt đầu</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('teacher_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Ngày kết thúc</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('teacher_filters.end_date') }}">
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
        <div class="table-header-fixed mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.teachers.data') }}" id="load-data-ajax-teachers" data-search="#search-form-teachers">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
