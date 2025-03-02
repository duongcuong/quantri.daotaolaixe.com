@extends('backend.app')
@section('title')
Tất cả lịch học
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
                    <li class="breadcrumb-item active" aria-current="page">Lịch học</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.exam-schedules.index')) --}}
        <a class="btn btn-outline-primary btn-sm btn-create-ajax"
            href="{{ route('admins.calendars.create', ['type' => 'class_schedule', 'reload' => 'load-data-ajax-class-calendars']) }}"
            data-cs-modal="#modal-calendars-create-ajax" title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
        {{-- @endif --}}
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-class-calendars" id="search-form-class-calendars"
            class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="payment_date" class="mr-2">Tháng năm</label>
                    <select class="form-control" name="loai_hoc">
                        <option value="">Loại học</option>
                        @foreach (listLoaiHocs() as $key => $item)
                        <option value="{{ $key }}" {{ session('calendar_filters.loai_hoc') == $key ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="course_id" class="mr-2">Giáo viên</label>
                    <select class="select2-ajax-single form-control" name="teacher_id"
                        data-selected-id="{{ session('calendar_filters.teacher_id') }}"
                        data-placeholder="Chọn giáo viên"
                        data-url="{{ route('admins.admins.list', ['role'=> ROLE_TEACHER]) }}">
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="course_id" class="mr-2">Học viên</label>
                    <select class="select2-ajax-single form-control" name="user_id"
                        data-selected-id="{{ session('calendar_filters.user_id') }}" data-placeholder="Chọn học viên"
                        data-url="{{ route('admins.users.list') }}">
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="status22" class="mr-2 opacity-0">Hành động </label><br>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"
                            style="display: none"></span>
                        Tìm kiếm
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div id="load-data-ajax-class-calendars" class="table-responsive mt-1 mb-1 load-data-ajax"
            data-search="#search-form-class-calendars"
            data-url="{{ route('admins.calendars.data', ['type' => 'class_schedule', 'show_column' => 'name,date_start,date_end,name_hocvien,teacher_id,diem_don,san,course_code,loai_hoc,km,so_gio_chay_duoc', 'reload' => 'load-data-ajax-class-calendars']) }}">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
