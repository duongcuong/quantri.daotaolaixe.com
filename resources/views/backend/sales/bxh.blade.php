@extends('backend.app')
@section('title')
Bảng xếp hạng Sale
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
                    <li class="breadcrumb-item active" aria-current="page">Bảng xếp hạng</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <form data-reload="#load-data-ajax-bxh-sales" id="search-form-bxh-sales" class="mb-3 form-search-submit">
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label for="" class="mr-2">Xếp hạng theo</label>
                    <select name="order_xh" id="order_xh" class="form-control">
                        <option value="doanh_thu" {{ (session('sale_bxh_filters.order_xh') == 'doanh_thu') ? 'selected' : '' }}>Doanh thu
                        </option>
                        <option value="so_hop_dong" {{ (session('sale_bxh_filters.order_xh') == 'so_hop_dong') ? 'selected' : '' }}>Số hợp đồng
                        </option>
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="start_date" class="mr-2">Ngày bắt đầu ký hợp đồng</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('sale_bxh_filters.start_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="end_date" class="mr-2">Ngày kết thúc ký hợp đồng</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('sale_bxh_filters.end_date') }}">
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label for="status22" class="mr-2 opacity-0">Hành động </label>
                    <div class="w-100">
                        <button type="submit" class="btn btn-primary mr-1">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                style="display: none"></span>
                            Tìm kiếm
                        </button>
                        <button type="reset" class="btn btn-outline-danger">
                            <i class="bx bx-refresh mr-1"></i>Refresh
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="table-header-fixed mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.sales.dataBxh') }}"
            id="load-data-ajax-bxh-sales" data-search="#search-form-bxh-sales">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
