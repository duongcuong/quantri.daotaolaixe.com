@extends('backend.app')
@section('title')
Xem chi tiết {{ $admin->name }}
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $admin->name }}</li>
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
                    <h5>Thông tin <strong>{{ $admin->name }}</strong>
                    </h5>
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>Avatar</th>
                            <td>
                                <img src="{{ getImageUpload($admin->thumbnail, 'admins', 'small') }}"
                                    alt="User Thumbnail" class="avatar" width="50">
                            </td>
                        </tr>

                        <tr>
                            <th>Tên</th>
                            <td>{{ $admin->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $admin->email }}</td>
                        </tr>

                        <tr>
                            <th>Giới tính</th>
                            <td>{{ getGender($admin->gender) }}</td>
                        </tr>

                        <tr>
                            <th>Số điện thoại</th>
                            <td>{{ $admin->phone }}</td>
                        </tr>

                        <tr>
                            <th>Ngày sinh</th>
                            <td>{{ getDateTimeStamp($admin->dob, 'd/m/Y') }}</td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td>
                                @foreach ($admin->roles as $role)
                                <span class="badge badge-info mr-1">{{ $role->name }}</span>
                                @endforeach
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
