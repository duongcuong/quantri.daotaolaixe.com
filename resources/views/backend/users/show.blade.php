@extends('backend.app')
@section('title')
Xem chi tiết {{ $user->name }}
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.users.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.users.index') }}" data-toggle="tooltip"
            title="Quay về trang quản lý học viên &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
        {{-- @endif --}}
    </div>
</div>

<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Thông tin <strong>{{ $user->name }}</strong>
                    </h5>
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>Avatar</th>
                            <td>
                                <img src="{{ getImageUpload($user->thumbnail, 'users', 'small') }}"
                                    alt="User Thumbnail" class="avatar" width="50">
                            </td>
                        </tr>

                        <tr>
                            <th>Tên</th>
                            <td>{{ $user->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th>Giới tính</th>
                            <td>{{ getGender($user->gender) }}</td>
                        </tr>

                        <tr>
                            <th>Số điện thoại</th>
                            <td>{{ $user->phone }}</td>
                        </tr>

                        <tr>
                            <th>Ngày sinh</th>
                            <td>{{ getDateTimeStamp($user->dob, 'd/m/Y') }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.users.partials.course-user')
@endsection
@push('js')
@endpush
