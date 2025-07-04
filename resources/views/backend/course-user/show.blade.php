@extends('backend.app')
@section('title')
Xem chi tiết {{ $courseUser->user->name }} - {{ $courseUser->course->code }}
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $courseUser->user->name }} - {{
                        $courseUser->course->code }}</li>
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

<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Thông tin <strong>{{ $courseUser->user->name }} - {{ $courseUser->course->code }}</strong>
                    </h5>
                    <table class="table table-bordered table-sm" style="table-layout: fixed;">
                        <tr>
                            <th colspan="2" style="width: 400px;">Avatar</th>
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
                            <th colspan="2">Giáo viên</th>
                            <td>{{ $courseUser->teacher->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Nhân viên Sale</th>
                            <td>{{ $courseUser->sale->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Ngày khai giảng</th>
                            <td>{{ getDateTimeStamp($courseUser->ngay_khai_giang, 'd/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Ngày bế giảng</th>
                            <td>{{ getDateTimeStamp($courseUser->ngay_be_giang, 'd/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Ngày học Cabin</th>
                            <td>{{ getDateTimeStamp($courseUser->ngay_hoc_cabin, 'd/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th rowspan="3">Thông tin</th>
                            <th>Thi hết môn lý thuyết</th>
                            <td class="fs-5">{!! getTickTrueOrFalse($courseUser->theory_exam) !!}</td>
                        </tr>
                        <tr>
                            <th>Thi hết môn thực hành</th>
                            <td class="fs-5">{!! getTickTrueOrFalse($courseUser->practice_exam) !!}</td>
                        </tr>
                        <tr>
                            <th>Thi tốt nghiệp</th>
                            <td class="fs-5">{!! getTickTrueOrFalse($courseUser->graduation_exam) !!}</td>
                        </tr>
                        <tr>
                            <th rowspan="2">Phiên học</th>
                            <th>Giờ</th>
                            <td>{{ getFormattedSoGioChayDuocAttribute($courseUser->calendars_sum_so_gio_chay_duoc) }}</td>
                        </tr>
                        <tr>
                            <th>Km</th>
                            <td>{{ $courseUser->calendars_sum_km }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Tổng học phí phải đóng</th>
                            <td class="text-danger">{!! getMoney($courseUser->tuition_fee) !!}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Tổng học phí đã nộp</th>
                            <td class="text-success">
                                {!! getMoney($courseUser->fees_sum_amount)
                                !!}
                                <a href="#fees-section" class="btn btn-sm btn-warning m-2 radius-4 px-3"> <i class="lni lni-eye mr-1"></i> Xem chi tiết</a>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Tổng học phí còn thiếu</th>
                            <td class="text-warning">{!! getMoneyConThieu($courseUser->tuition_fee, $courseUser->fees_sum_amount)
                                !!}</td>
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

@include('backend.course-user.partials.class_schedule')
@include('backend.course-user.partials.student_class_schedule')
@include('backend.course-user.partials.lythuyet_schedule')
@include('backend.course-user.partials.thuchanh_schedule')
@include('backend.course-user.partials.totnghiep_schedule')
@include('backend.course-user.partials.exam_schedule')
@include('backend.course-user.partials.fees')

@endsection
@push('js')
@endpush
