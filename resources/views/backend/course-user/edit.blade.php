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
                            <select class="select2-ajax-single form-control" name="user_id" data-selected-id="{{ $courseUser->user_id }}"
                                data-placeholder="Chọn học viên"
                                data-url="{{ route('admins.users.list') }}"
                                >
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="course_id">Chọn khóa học</label>
                            <select class="select2-ajax-single form-control" multiple name="course_id" data-selected-id="{{ $courseUser->course_id }}"
                                data-placeholder="Chọn khóa học"
                                data-url="{{ route('admins.courses.list') }}"
                                >
                            </select>
                        </div>
                    </div>
                    <div class="border radius-10 p-15 mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="theory_exam" type="checkbox" value="1" {{
                                        $courseUser->theory_exam ? 'checked' : '' }} id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">Thi hết môn lí thuyết</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="practice_exam" value="1" {{
                                        $courseUser->practice_exam ? 'checked' : '' }} id="flexCheckChecked1">
                                    <label class="form-check-label" for="flexCheckChecked1">Thi hết môn thực
                                        hành</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="graduation_exam" value="1" {{
                                        $courseUser->graduation_exam ? 'checked' : '' }} id="flexCheckChecked2">
                                    <label class="form-check-label" for="flexCheckChecked2">Thi tốt nghiệp</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="practice_field">Sân tập</label>
                            <input type="text" name="practice_field" id="practice_field" class="form-control"
                                value="{{ old('practice_field', $courseUser->practice_field) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="health_check_date">Khám sức khoẻ</label>
                            <input type="date" name="health_check_date" id="health_check_date" class="form-control"
                                value="{{ old('health_check_date', \Carbon\Carbon::parse($courseUser->health_check_date)->format('Y-m-d')) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hours">Giờ</label>
                            <input type="number" name="hours" id="hours" class="form-control"
                                value="{{ old('hours', $courseUser->hours) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="km">Km</label>
                            <input type="number" name="km" id="km" class="form-control" value="{{ old('km', $courseUser->km) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exam_date">Ngày thi</label>
                            <input type="date" name="exam_date" id="exam_date" class="form-control"
                                value="{{ old('exam_date', \Carbon\Carbon::parse($courseUser->exam_date)->format('Y-m-d')) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contract_date">Ngày kí hợp đồng</label>
                            <input type="date" name="contract_date" id="contract_date" class="form-control"
                                value="{{ old('contract_date', \Carbon\Carbon::parse($courseUser->contract_date)->format('Y-m-d')) }}" />
                        </div>
                        <div class="form-group col-md-12">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="note" class="form-control">{{ old('note', $courseUser->note) }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach (listStatusCourseUser() as $key => $item)
                                <option value="{{ $key }}" {{ old('status', $courseUser->status)==$key ? 'selected' : '' }}>{{ $item }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="graduation_date">Ngày tốt nghiệp</label>
                            <input type="date" name="graduation_date" id="graduation_date" class="form-control"
                                value="{{ old('graduation_date', \Carbon\Carbon::parse($courseUser->graduation_date)->format('Y-m-d')) }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="form-group">
                        <label for="teacher_id">Giáo viên hướng dẫn</label>
                        <select class="select2-ajax-single form-control" name="teacher_id" data-selected-id="{{ $courseUser->teacher_id }}"
                            data-placeholder="Chọn giáo viên"
                            data-url="{{ route('admins.admins.list', ['role'=> ROLE_TEACHER]) }}"
                            >
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sale_id">Nhân viên Sale</label>
                        <select class="select2-ajax-single form-control" name="sale_id" data-selected-id="{{ $courseUser->sale_id }}"
                            data-placeholder="Chọn nhân viên Sale"
                            data-url="{{ route('admins.admins.list', ['role'=> ROLE_SALE]) }}" >
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bx bxs-save mr-1"></i>Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('js')
@endpush
