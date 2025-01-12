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
        {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
        <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.course-user.create') }}" data-cs-modal="#modal-course-user-create-ajax" title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
        {{-- @endif --}}
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-course-user" id="search-form-course-user" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="course_id_search" class="mr-2">Khóa học</label>
                    <select name="course_id" id="course_id_search" class="form-control single-select"
                        data-placeholder="Chọn khóa học" data-allow-clear="true">
                        <option value=""></option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ $course->id == request()->course_id ?
                            'selected' :
                            '' }}>{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="status22" class="mr-2">Trạng thái</label>
                    <select name="status" id="status22" class="form-control single-select"
                        data-placeholder="Chọn trạng thái" data-allow-clear="true">
                        <option value=""></option>
                        @foreach (listStatus() as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="search_text" class="mr-2">Họ tên / Mã ĐK / Số CMT</label>
                    <input type="text" name="search_text" id="search_text" class="form-control"
                        placeholder="Nhập thông tin">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="card_name" class="mr-2">ID thẻ</label>
                    <input type="text" name="card_name" id="card_name" class="form-control" placeholder="Nhập ID thẻ">
                </div>
                <div class="form-group col-sm-6 col-md-3">
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
        <div class="table-responsive mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.course-user.data') }}" id="load-data-ajax-course-user" data-search="#search-form-course-user">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
