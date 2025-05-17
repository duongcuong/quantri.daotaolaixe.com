@extends('backend.app')
@section('title')
Tất cả lịch thi của học viên
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
                    <li class="breadcrumb-item active" aria-current="page">Lịch thi sát hạch ngày {{ getDateTimeStamp(request()->date_start, 'd/m/Y')}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        <a class="btn btn-outline-danger btn-sm mr-2 reset-search-action" href="{{ route('admins.calendars.exam-date') }}"
            data-toggle="tooltip" title="Quay về"><i class="bx bx-rewind"></i>Quay lại</a>
        {{-- @if (Auth::user()->hasPermission('admins.exam-schedules.index')) --}}
        <a class="btn btn-outline-primary btn-sm btn-create-ajax"
            href="{{ route('admins.calendars.create', ['type' => 'exam_schedule', 'date_start' => request()->date_start, 'reload' => 'load-data-ajax-exam-sat-hach-calendars']) }}"
            data-cs-modal="#modal-calendars-sat-hach-create-ajax" title="Tạo học viên"><i class="bx bx-plus"></i>Tạo học viên</a>
        {{-- @endif --}}

    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-exam-sat-hach-calendars" id="search-form-class-calendars"
            class="mb-3 form-search-submit">
            @csrf
            <input type="hidden" name="type" value="exam_schedule">
            <input type="hidden" name="view" value="backend.calendars.sathach.data">
            <input type="hidden" name="buoi_hoc" value="{{ request()->buoi_hoc }}">
            <input type="hidden" name="reload" value="load-data-ajax-exam-sat-hach-calendars">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="course_id" class="mr-2">Học viên</label>
                    <select class="select2-ajax-single form-control" name="user_id"
                        data-selected-id="{{ session('calendar_filters.user_id') }}" data-placeholder="Chọn học viên"
                        data-url="{{ route('admins.users.list') }}">
                    </select>
                </div>

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
                    <label for="start_date" class="mr-2">Ngày bắt đầu</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request()->date_start ?? session('calendar_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Ngày kết thúc</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ request()->date_start ?? session('calendar_filters.end_date') }}">
                </div>



                <div class="form-group col-sm-6 col-md-3">
                    {{-- <label for="status22" class="mr-2 opacity-0">Hành động </label><br> --}}
                    <button type="submit" class="btn btn-primary">
                        <label for=""></label>
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
        <div id="load-data-ajax-exam-sat-hach-calendars" class="table-header-fixed mt-1 mb-1 load-data-ajax"
            data-search="#search-form-class-calendars" data-url="{{ route('admins.calendars.data') }}">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    jQuery(document).ready(function () {
        $(document).on( 'click', '.btn-show-exam-schedule', function (e) {
            let dateStart = $(this).data('start-date');
            let date = dateStart.split(' ')[0];
            $('#start_date').val(date);
            $('#end_date').val(date);
            $('#search-form-class-calendars').submit();
        });

        $(document).on( 'click', '.btn-show-exam-field', function (e) {
            let examField = $(this).data('exam-field');
            $('#exam_field_id').val(examField).trigger('change');
            $('#search-form-class-calendars').submit();
        });
    });
</script>
@endpush
