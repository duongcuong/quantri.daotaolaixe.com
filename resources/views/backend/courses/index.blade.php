@extends('backend.app')
@section('title')
Tất cả khoá học
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
                    <li class="breadcrumb-item active" aria-current="page">Khoá học</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.courses.index')) --}}
        <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.courses.create') }}" data-cs-modal="#modal-courses-create-ajax" title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
        {{-- @endif --}}
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-courses" id="search-form-courses" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="code" class="mr-2">Tên</label>
                    <input type="text" id="code" name="code" class="form-control" placeholder="Nhập tên khoá học">
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
        <div class="table-responsive mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.courses.data') }}" id="load-data-ajax-courses" data-search="#search-form-courses">
            <div class="loading-overlay"><div class="loading-spinner"></div></div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
