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
                    <li class="breadcrumb-item active" aria-current="page">Lịch thi sát hạch</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        @if (canAccess('admins.calendars.create'))
        <a class="btn btn-outline-primary btn-sm btn-create-ajax"
            href="{{ route('admins.calendars.create', ['type' => 'exam_schedule', 'reload' => 'load-data-ajax-class-calendars']) }}"
            data-cs-modal="#modal-calendars-create-ajax" title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
        @endif
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-class-calendars" id="search-form-class-calendars"
            class="mb-3 form-search-submit">
            @csrf
            @php
            $showColumn = 'date_start,total_calendar';
            $typeColumn = 'exam_schedule';
            $reload = 'load-data-ajax-class-calendars';
            @endphp
            <input type="hidden" name="show_column" value="{{ $showColumn }}">
            <input type="hidden" name="type" value="{{ $typeColumn }}">
            <input type="hidden" name="reload" value="{{ $reload }}">
            <input type="hidden" name="group_by" value="date_exam">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="payment_date" class="mr-2">Hình thức</label>
                    <select class="form-control" name="loai_hoc">
                        <option value="">Hình thức dạy</option>
                        @foreach (listLoaiHocs() as $key => $item)
                        <option value="{{ $key }}" {{ session('calendar_filters.loai_hoc') == $key ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group col-sm-6 col-md-3">
                    <label for="start_date" class="mr-2">Ngày bắt đầu</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('calendar_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Ngày kết thúc</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('calendar_filters.end_date') }}">
                </div> --}}
                <div class="form-group col-md-3">
                    <label for="exam_field_id">Sân thi</label>
                    <select name="exam_field_id" id="exam_field_id" class="form-control single-select"
                        data-placeholder="Chọn sân thi" data-allow-clear="true">
                        <option></option>
                        @foreach ($examFields as $examField)
                        <option value="{{ $examField->id }}" {{ session('calendar_filters.exam_field_id')==$examField->id
                            ? 'selected' : '' }}> {{ $examField->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="course_id" class="mr-2">Giáo viên</label>
                    <select class="select2-ajax-single-all form-control" name="teacher_id"
                        data-selected-id="{{ session('calendar_filters.teacher_id') }}"
                        data-placeholder="Chọn giáo viên"
                        data-url="{{ route('admins.admins.lists', ['role'=> ROLE_TEACHER]) }}">
                        <option></option>
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
                    <label for="interest_level">Mức độ ưu tiên</label>
                    <select name="interest_level" id="interest_level" class="form-control">
                        <option value="">Chọn mức độ ưu tiên</option>
                        @foreach (listLevels() as $key => $item)
                        <option value="{{ $key }}" {{ old('interest_level')==$key ? 'selected' : '' }} {{ session('calendar_filters.interest_level') == $key ? 'selected' : '' }}>{{ $item
                            }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="approval">Xét duyệt</label>
                    <select name="approval" id="approval" class="form-control">
                        <option value="">Chọn xét duyệt</option>
                        <option value="0" {{ session('calendar_filters.approval') === '0' ? 'selected' : '' }}>Chưa duyệt</option>
                        <option value="1" {{ session('calendar_filters.approval') === '1' ? 'selected' : '' }}>Đã duyệt</option>
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
        <div id="load-data-ajax-class-calendars" class="table-header-fixed mt-1 mb-1 load-data-ajax"
            data-search="#search-form-class-calendars"
            data-url="{{ route('admins.calendars.data') }}">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<style>
    .fixed-column.text-center{
        display: none;
    }
</style>
@endpush
