@extends('backend.app')
@section('title')
Tất cả Khoá học - Học Viên
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
                    <li class="breadcrumb-item active" aria-current="page">Khoá học - học viên</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        @if(request()->course_id)
        <a class="btn btn-outline-primary btn-sm mr-2" href="{{ route('admins.course-user.index') }}" data-toggle="tooltip"
            title="Quay về trang quản lý Khoá học - User &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
        @endif

        @if (canAccess('admins.course-user.import'))
        <a class="btn btn-outline-success btn-sm mr-2" href="{{ route('admins.course-user.import') }}" title="Import"><i
                class="lni lni-cloud-upload mr-1"></i>Import file</a>
        @endif

        @if (canAccess('admins.course-user.create'))
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.course-user.create') }}" title="Thêm mới"><i
                class="bx bx-plus"></i>Thêm mới</a>
        @endif
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-course-user" id="search-form-course-user" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="course_id" class="mr-2">Khóa học</label>
                    <input type="hidden" name="course_id" id="course_id_input"
                        value="{{ request()->course_id ?? session('course_user_filters.course_id') }}">
                    <select class="select2-ajax-single form-control" id="course_id_search"
                        data-selected-id="{{ request()->course_id ?? session('course_user_filters.course_id') }}"
                        data-placeholder="Chọn khoá học" data-url="{{ route('admins.courses.list') }}">
                    </select>

                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="course_id" class="mr-2">Giáo viên</label>
                    <select class="select2-ajax-single-all form-control" name="teacher_id"
                        data-selected-id="{{ session('course_user_filters.teacher_id') }}"
                        data-placeholder="Chọn giáo viên"
                        data-url="{{ route('admins.admins.lists', ['role'=> ROLE_TEACHER]) }}">
                        <option></option>
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="start_date" class="mr-2">Ngày kí hợp đồng bắt đầu</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('course_user_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Ngày ký hợp đồng kết thúc</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('course_user_filters.end_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="search_text" class="mr-2">Họ tên / Mã ĐK / Số CMT</label>
                    <input type="text" name="search_text" id="search_text" class="form-control"
                        placeholder="Nhập thông tin" value="{{ session('course_user_filters.search_text') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="status22" class="mr-2">Trạng thái</label>
                    <select name="status" id="status22" class="form-control">
                        <option value="">Chọn</option>
                        @foreach (listStatusCalendars() as $key1 => $items)
                        @if ($key1 == 'exam_schedule' || $key1 == 'class_schedule')
                        @php
                        $name = $key1 == 'exam_schedule' ? 'Thi' : 'Học';
                        @endphp
                        <optgroup label="{{ $name }}">
                            @foreach ($items as $key => $item)

                            <option value="{{ $key }}" {{ session('course_user_filters.status')==="$key" ? 'selected'
                                : '' }}>{{ $item }}</option>
                            @endforeach
                        </optgroup>
                        @endif
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group col-sm-6 col-md-3">
                    <label for="card_name" class="mr-2">ID thẻ</label>
                    <input type="text" name="card_name" id="card_name" class="form-control" placeholder="Nhập ID thẻ"
                        value="{{ session('course_user_filters.card_name') }}">
                </div> --}}
                <div class="form-group col-md-3">
                    <label for="exam_field_id">Sân thi</label>
                    <select name="exam_field_id" id="exam_field_id" class="form-control single-select"
                        data-placeholder="Chọn sân thi" data-allow-clear="true">
                        <option></option>
                        @foreach ($examFields as $examField)
                        <option value="{{ $examField->id }}" {{ session('course_user_filters.exam_field_id')==$examField->id
                            ? 'selected' : '' }}> {{ $examField->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="tuition_status" class="mr-2">Trạng thái học phí</label>
                    <select name="tuition_status" id="tuition_status" class="form-control">
                        <option value="">Chọn trạng thái</option>
                        <option value="paid">Đã đóng đủ</option>
                        <option value="unpaid">Chưa đóng đủ</option>
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
        <div class="table-header-fixed mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.course-user.data') }}"
            id="load-data-ajax-course-user" data-search="#search-form-course-user">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    jQuery(document).ready(function() {
        $('#course_id_search').on('change input', function() {
            var selectedValue = $(this).val();
            $('#course_id_input').val(selectedValue);
        });

        // Nếu bạn muốn cập nhật input khi xóa giá trị trong select
        $('#course_id_search').on('input', function() {
            if ($(this).val() === '') {
                $('#course_id_input').val('');
            }
        });
    });
</script>
@endpush
