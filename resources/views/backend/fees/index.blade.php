@extends('backend.app')
@section('title')
Tất cả Lịch sử nộp tiền
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
                    <li class="breadcrumb-item active" aria-current="page">Lịch sử nộp tiền</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        @if (canAccess('admins.fees.create'))
        <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.fees.create') }}"
            data-cs-modal="#modal-fees-create-ajax" title="Thêm mới nộp tiền"><i class="bx bx-plus"></i>Thêm mới nộp tiền</a>
        @endif
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-fees" id="search-form-fees" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="start_date" class="mr-2">Từ ngày</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('fees_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Đến ngày</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('fees_filters.end_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="course_user_id" class="mr-2">Học viên - Khoá học</label>
                    <select class="select2-ajax-single form-control" name="course_user_id"
                        data-selected-id="{{ session('fees_filters.course_user_id') }}" data-placeholder="Chọn Học viên - Khoá học"
                        data-url="{{ route('admins.course-user.list') }}">
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="user_id" class="mr-2">Học viên</label>
                    <select class="select2-ajax-single form-control" name="user_id"
                        data-selected-id="{{ session('fees_filters.user_id') }}" data-placeholder="Chọn học viên"
                        data-url="{{ route('admins.users.list') }}">
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="type">Loại thu</label>
                    <select class="form-control" name="type" id="type">
                        <option value="">-- Chọn loại thu --</option>
                        @foreach (listFeeTypes() as $key => $item)
                        <option value="{{ $key }}" {{ session('fees_filters.type')==$key ? 'selected' : '' }}>{{
                            $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="is_received">Tiền đã về công ty</label>
                    <select name="is_received" id="is_received" class="form-control">
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="0" {{ session('fees_filters.is_received') === '0' ? 'selected' : '' }}>Chưa về</option>
                        <option value="1" {{ session('fees_filters.is_received') == 1 ? 'selected' : '' }}>Đã về</option>
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
        <div class="table-header-fixed mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.fees.data') }}"
            id="load-data-ajax-fees" data-search="#search-form-fees">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
