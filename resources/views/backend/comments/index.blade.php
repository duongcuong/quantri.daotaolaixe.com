@extends('backend.app')
@section('title')
Danh sách bình luận
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
                    <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- <div class="ml-auto">
        @if (Auth::user()->hasPermission('admins.comments.index'))
        <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.comments.create') }}" data-cs-modal="#modal-comments-create-ajax"
            title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
        @endif
    </div> --}}
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-comments" id="search-form-comments" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-4">
                    <label for="teacher_id" class="mr-2">Giáo viên</label>
                    <select class="select2-ajax-single form-control" name="teacher_id"
                        data-selected-id="{{ session('comments_filters.teacher_id') }}"
                        data-placeholder="Chọn giáo viên"
                        data-url="{{ route('admins.admins.list', ['role'=> ROLE_TEACHER]) }}">
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-4">
                    <label for="course_id" class="mr-2">Khóa học</label>
                    <input type="hidden" name="course_id" id="course_id_input"
                        value="{{ session('comments_filters.course_id') }}">
                    <select class="select2-ajax-single form-control" id="course_id_search"
                        data-selected-id="{{ session('comments_filters.course_id') }}"
                        data-placeholder="Chọn khoá học" data-url="{{ route('admins.courses.list') }}">
                    </select>

                </div>
                <div class="form-group col-sm-6 col-md-4">
                    <label for="user_id" class="mr-2">Học viên</label>
                    <select class="select2-ajax-single form-control" name="teacher_id"
                        data-selected-id="{{ session('comments_filters.teacher_id') }}"
                        data-placeholder="Chọn giáo viên"
                        data-url="{{ route('admins.users.list') }}">
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-4">
                    <label for="start_date" class="mr-2">Từ ngày bình luận</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('comments_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-4">
                    <label for="end_date" class="mr-2">Đến ngày bình luận</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('comments_filters.end_date') }}">
                </div>

                <div class="form-group col-sm-6 col-md-4">
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
        <div class="table-responsive mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.comments.data') }}" id="load-data-ajax-comments" data-search="#search-form-comments">
            <div class="loading-overlay"><div class="loading-spinner"></div></div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
