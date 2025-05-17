@extends('backend.app')
@section('title')
Sửa Khoá học - Học Viên
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
                    <li class="breadcrumb-item active" aria-current="page">Sửa Khoá học - Học viên</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.course-user.index') }}" data-toggle="tooltip"
            title="Quay về trang quản lý Khoá học - Học viên &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
        {{-- @endif --}}
    </div>
</div>
<form action="{{ route('admins.course-user.update', $courseUser->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_id">Chọn học viên</label>
                            <select class="select2-ajax-single form-control" name="user_id"
                                data-selected-id="{{ $courseUser->user_id }}" data-placeholder="Chọn học viên"
                                data-url="{{ route('admins.users.list') }}">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="course_id">Chọn khóa học</label>
                            <select id="change-khoa-hoc" class="select2-ajax-single form-control" name="course_id"
                                data-selected-id="{{ $courseUser->course_id }}" data-placeholder="Chọn khóa học"
                                data-url="{{ route('admins.courses.list') }}">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tuition_fee" class="form-label">Học phí</label>
                            <input type="text" name="tuition_fee" id="tuition_fee" class="form-control thousand-text"
                                value="{{ old('tuition_fee', $courseUser->tuition_fee) }}">
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="practice_field">Sân tập</label>
                            <input type="text" name="practice_field" id="practice_field" class="form-control"
                                value="{{ old('practice_field', $courseUser->practice_field) }}" />
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="health_check_date">Khám sức khoẻ</label>
                            <input type="date" name="health_check_date" id="health_check_date" class="form-control"
                                value="{{ old('health_check_date', getDateTimeStamp($courseUser->health_check_date)) }}" />
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="hours">Giờ</label>
                            <input type="text" name="hours" id="hours" class="form-control"
                                value="{{ old('hours', $courseUser->hours) }}" />
                        </div> --}}
                        {{-- <div class="form-group col-md-6">
                            <label for="km">Km</label>
                            <input type="text" name="km" id="km" class="form-control"
                                value="{{ old('km', $courseUser->km) }}" />
                        </div> --}}
                        {{-- <div class="form-group col-md-6">
                            <label for="exam_date">Ngày thi</label>
                            <input type="date" name="exam_date" id="exam_date" class="form-control"
                                value="{{ old('exam_date', \Carbon\Carbon::parse($courseUser->exam_date)->format('Y-m-d')) }}" />
                        </div> --}}

                        <div class="form-group col-md-6">
                            <label for="exam_field_id" class="d-flex justify-content-between">
                                <span>Sân thi</span>
                                <a class="btn-create-ajax" href="{{ route('admins.exam-fields.create') }}"
                                    data-cs-modal="#modal-exam-fields-create-ajax" title="Thêm mới"><i
                                        class="bx bx-plus"></i>Thêm sân thi</a>
                            </label>
                            <select name="exam_field_id" id="exam_field_id" class="form-control single-select"
                                data-placeholder="Chọn sân thi" data-allow-clear="true">
                                <option></option>
                                @foreach ($examFields as $examField)
                                <option value="{{ $examField->id }}" {{ $examField->id == $courseUser->exam_field_id ? 'selected' : '' }}> {{ $examField->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--<div class="form-group col-md-6">
                            <label for="ngay_khai_giang">Ngày khai giảng</label>
                            <input type="date" name="ngay_khai_giang" id="ngay_khai_giang" class="form-control"
                                value="{{ old('ngay_khai_giang', getDateTimeStamp($courseUser->ngay_khai_giang)) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ngay_be_giang">Ngày bế giảng</label>
                            <input type="date" name="ngay_be_giang" id="ngay_be_giang" class="form-control"
                                value="{{ old('ngay_be_giang', getDateTimeStamp($courseUser->ngay_be_giang)) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ngay_hoc_cabin">Ngày học Cabin</label>
                            <input type="date" name="ngay_hoc_cabin" id="ngay_hoc_cabin" class="form-control"
                                value="{{ old('ngay_hoc_cabin', getDateTimeStamp($courseUser->ngay_hoc_cabin)) }}" />
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="contract_date">Ngày kýhợp đồng</label>
                            <input type="date" name="contract_date" id="contract_date" class="form-control"
                                value="{{ old('contract_date', \Carbon\Carbon::parse($courseUser->contract_date)->format('Y-m-d')) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gifted_hours">Số giờ chip tặng</label>
                            <input type="text" name="gifted_hours" id="gifted_hours"
                                class="form-control cs-time-picker" placeholder="HH:MM" value="{{ old('gifted_hours', $courseUser->gifted_hours) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="chip_hours">Số giờ đặt chip</label>
                            <input type="text" name="chip_hours" id="chip_hours"
                                class="form-control cs-time-picker" placeholder="HH:MM" value="{{ old('chip_hours', $courseUser->chip_hours) }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="note"
                                class="form-control">{{ old('note', $courseUser->note) }}</textarea>
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach (listStatusCourseUser() as $key => $item)
                                <option value="{{ $key }}" {{ old('status', $courseUser->status)==$key ? 'selected' : ''
                                    }}>{{ $item }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="graduation_date">Ngày tốt nghiệp</label>
                            <input type="date" name="graduation_date" id="graduation_date" class="form-control"
                                value="{{ old('graduation_date', \Carbon\Carbon::parse($courseUser->graduation_date)->format('Y-m-d')) }}" />
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="form-group">
                        <label for="teacher_id">Giáo viên hướng dẫn</label>
                        <select class="select2-ajax-single-all form-control" name="teacher_id"
                            data-selected-id="{{ $courseUser->teacher_id }}" data-placeholder="Chọn giáo viên"
                            data-url="{{ route('admins.admins.lists', ['role'=> ROLE_TEACHER]) }}">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sale_id">Nhân viên Sale</label>
                        <select class="select2-ajax-single form-control" name="sale_id"
                            data-selected-id="{{ $courseUser->sale_id }}" data-placeholder="Chọn nhân viên Sale"
                            data-url="{{ route('admins.admins.list', ['role'=> ROLE_SALES]) }}">
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bx bxs-save mr-1"></i>Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>

@include('backend.course-user.partials.class_schedule')
@include('backend.course-user.partials.lythuyet_schedule')
@include('backend.course-user.partials.thuchanh_schedule')
@include('backend.course-user.partials.exam_schedule')
@include('backend.course-user.partials.totnghiep_schedule')
@include('backend.course-user.partials.fees')

@endsection
@push('js')
@endpush
