@extends('backend.app')
@section('title')
Tất cả lịch sử nạp học phí
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
                    <li class="breadcrumb-item active" aria-current="page">Lịch sử nạp học phí</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.fees.index')) --}}
        <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.fees.create') }}" data-cs-modal="#modal-fees-create-ajax"
            title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
        {{-- @endif --}}
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-fees" id="search-form-fees" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="payment_date" class="mr-2">Tháng năm</label>
                    <input type="month" id="payment_date" name="payment_date" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="student_name" class="mr-2">Tên học viên</label>
                    <input type="text" id="student_name" name="student_name" class="form-control">
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
        <div class="table-responsive mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.fees.data') }}" id="load-data-ajax-fees" data-search="#search-form-fees">
            <div class="loading-overlay"><div class="loading-spinner"></div></div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
