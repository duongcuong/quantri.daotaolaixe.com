@extends('backend.app')
@section('title')
Xem chi tiết {{ $courseUser->course->code }}
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $courseUser->course->code }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Thông tin <strong>{{ $courseUser->course->code }}</strong>
                    </h5>
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th colspan="2">Avatar</th>
                            <td>
                                <img src="{{ getImageUpload($courseUser->user->thumbnail, 'users', 'small') }}"
                                    alt="User Thumbnail" class="avatar" width="50">
                            </td>
                        </tr>

                        <tr>
                            <th colspan="2">Mã ĐK</th>
                            <td>{{ $courseUser->course->code }}</td>
                        </tr>

                        <tr>
                            <th colspan="2">Hạng</th>
                            <td>{{ $courseUser->course->rank }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Họ tên</th>
                            <td>{{ $courseUser->user->name }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Ngày sinh</th>
                            <td>{{ \Carbon\Carbon::parse($courseUser->user->birthdate)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Giới tính</th>
                            <td>{{ $courseUser->user->gender == 0 ? 'Nam' : ($courseUser->user->gender == 1 ? 'Nữ' :
                                'Khác') }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Số CMT</th>
                            <td>{{ $courseUser->user->identity_card }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Id thẻ</th>
                            <td>{{ $courseUser->user->card_name }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Số thẻ</th>
                            <td>{{ $courseUser->user->card_number }}</td>
                        </tr>
                        <tr>
                            <th rowspan="4">Thực hành</th>
                            <th>Cơ bản</th>
                            <td>{!! getStatusCourseUser($courseUser->basic_status) !!}</td>
                        </tr>
                        <tr>
                            <th>Sa hình</th>
                            <td>{!! getStatusCourseUser($courseUser->shape_status) !!}</td>
                        </tr>
                        <tr>
                            <th>Đường trường</th>
                            <td>{!! getStatusCourseUser($courseUser->road_status) !!}</td>
                        </tr>
                        <tr>
                            <th>Xe chíp</th>
                            <td>{!! getStatusCourseUser($courseUser->chip_status) !!}</td>
                        </tr>
                        <tr>
                            <th rowspan="2">Phiên học</th>
                            <th>Giờ</th>
                            <td>{{ $courseUser->km }}</td>
                        </tr>
                        <tr>
                            <th>Km</th>
                            <td>{{ $courseUser->hours }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Trạng thái</th>
                            <td>{!! getStatus($courseUser->status) !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5>Lịch sử nạp học phí</strong>
                        </h5>
                        <h5 class="ml-3"><span class="badge badge-info">{{ number_format($courseUser->fees_sum_amount) }} VNĐ</span></h5>
                        <div class="ml-auto">
                            {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.course-user.create') }}"
                                data-toggle="modal" data-target="#modalCreateAjax" title="Thêm mới"><i
                                    class="bx bx-plus"></i>Thêm mới</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <form id="searchForm" class="mb-3">
                        <div class="row">
                            <input type="hidden" value="{{ $courseUser->id }}" name="course_user_id">
                        </div>
                    </form>
                    <div class="table-responsive mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.fees.data') }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.fees.modals.create')

@endsection
@push('js')
@endpush
