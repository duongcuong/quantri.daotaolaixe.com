@extends('backend.app')
@section('title')
Tạo người dùng
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
                    <li class="breadcrumb-item active" aria-current="page">Tạo người dùng mới</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.admins.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.admins.index') }}" data-toggle="tooltip"
            title="Quay về trang quản lý người dùng &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
        {{-- @endif --}}
    </div>
</div>
<form action="{{ route('admins.admins.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Tên</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Giới tính</label>
                            <select name="gender" id="gender" class="form-control">
                                @foreach (listGenders() as $key => $item)
                                <option value="{{ $key }}" {{ old('gender', 0)==$key ? 'selected' : '' }}>{{ $item }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Ngày sinh</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach (listStatus() as $key => $item)
                                <option value="{{ $key }}" {{ old('status', 1)==$key ? 'selected' : '' }}>{{ $item }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="form-group">
                        <label for="thumbnail">Avatar</label>
                        <div class="thumbnail-container" onclick="document.getElementById('fileInput').click()"
                            style="background-image: none;">
                            <span class="placeholder" style="display: block;">Chọn hình ảnh</span>
                            <input type="file" id="fileInput" accept="image/*" onchange="previewImage(event)"
                                name="thumbnail">
                            <button class="delete-btn" onclick="deleteImage(event)" style="display: none;">
                                <i class="bx bx-x-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="roles">Roles</label>
                        <select name="roles[]" id="roles" class="form-control single-select" multiple required>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ (collect(old('roles'))->contains($role->id)) ? 'selected'
                                : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bx bxs-save mr-1"></i>Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('js')
@endpush
