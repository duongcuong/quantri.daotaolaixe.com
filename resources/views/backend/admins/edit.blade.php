@extends('backend.app')
@section('title')
Sửa người dùng
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
                    <li class="breadcrumb-item active" aria-current="page">Sửa người dùng mới</li>
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
<form action="{{ route('admins.admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Tên</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $admin->name) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $admin->email) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach (listStatus() as $key => $item)
                                <option value="{{ $key }}" {{ old('status', $admin->status) == $key ? 'selected' : ''
                                    }}>{{ $item }}</option>
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
                            style="background-image: url('{{ getImageUpload($admin->thumbnail, 'admins', 'small') }}');">
                            <span class="placeholder" style="display: {{ $admin->thumbnail ? 'block' : 'none' }};">Chọn
                                hình ảnh</span>
                            <input type="file" id="fileInput" accept="image/*" onchange="previewImage(event)"
                                name="thumbnail">
                            <button class="delete-btn" style="display: {{ $admin->thumbnail ? 'block' : 'none' }}"
                                onclick="deleteImage(event)">
                                <i class="bx bx-x-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="roles">Roles</label>
                        <select name="roles[]" id="roles" class="form-control single-select" multiple required>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ (collect(old('roles', $admin->
                                roles->pluck('id')->toArray()))->contains($role->id)) ? 'selected' : '' }}>{{
                                $role->name }}</option>
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
