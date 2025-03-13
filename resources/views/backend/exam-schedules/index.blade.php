@extends('backend.app')
@section('title')
Tất cả lịch sát hạch
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
        {{-- @if (Auth::user()->hasPermission('admins.exam-schedules.index')) --}}
        <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.exam-schedules.create') }}" data-cs-modal="#modal-exam-schedules-create-ajax"
            title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
        {{-- @endif --}}
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-exam-schedules" id="search-form-exam-schedules" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="start_date" class="mr-2">Ngày bắt đầu</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('exam_schedules.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Ngày kết thúc</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('exam_schedules.end_date') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="exam_field_id">Sân thi</label>
                    <select name="exam_field_id" id="exam_field_id" class="form-control single-select"
                        data-placeholder="Chọn sân thi" data-allow-clear="true">
                        <option></option>
                        @foreach ($examFields as $examField)
                        <option value="{{ $examField->id }}" {{ session('exam_schedules.exam_field_id')==$examField->id
                            ? 'selected' : '' }}> {{ $examField->name }}</option>
                        @endforeach
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
        <div class="table-responsive mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.exam-schedules.data') }}" id="load-data-ajax-exam-schedules" data-search="#search-form-exam-schedules">
            <div class="loading-overlay"><div class="loading-spinner"></div></div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
