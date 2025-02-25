@extends('backend.app')
@section('title')
Xem chi tiết {{ $lead->name }}
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $lead->name }}</li>
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
                    <h5>Thông tin <strong>{{ $lead->name }}</strong>
                    </h5>
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>Tên</th>
                            <td>{{ $lead->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $lead->email }}</td>
                        </tr>
                        <tr>
                            <th>Số điện thoại</th>
                            <td>{{ $lead->phone }}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td>{{ $lead->address }}</td>
                        </tr>
                        <tr>
                            <th>Ngày sinh</th>
                            <td>{{ $lead->dob ? \Carbon\Carbon::parse($lead->dob)->format('d/m/Y') : '' }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>{!! getStatusLead($lead->status) !!}</td>
                        </tr>
                        <tr>
                            <th>Ghi chú</th>
                            <td>{{ $lead->description }}</td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{ $lead->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Ngày cập nhật</th>
                            <td>{{ $lead->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </table>
                    @if ($lead->course_user_id)
                    <a class="btn btn-success btn-sm mr-2 btn-convert-course-user"
                        href="{{ route('admins.course-user.show', $lead->course_user_id) }}" data-toggle="tooltip"
                        title="Xem Học Viên - Khoá học"><i class="bx bx-user-check mr-1"></i>Xem Học viên - Khoá học</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.leads.partials.calendars')
@include('backend.leads.modals.convert_lead')

@endsection
@push('js')
@endpush
