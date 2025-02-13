@extends('backend.app')
@section('title')
Sửa sale
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
                    <li class="breadcrumb-item active" aria-current="page">Sửa sale</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.sales.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.sales.index') }}" data-toggle="tooltip"
            title="Quay về trang quản lý giáo viên &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
        {{-- @endif --}}
    </div>
</div>
<form action="{{ route('admins.sales.update', $sale->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $sale->name) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email', $sale->email) }}" id="email"
                                class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Giới tính</label>
                            <select name="gender" id="gender" class="form-control" required>
                                @foreach (listGenders() as $key => $item)
                                <option value="{{ $key }}" {{ old('gender', $sale->gender)== $key ? 'selected' : ''
                                    }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $sale->phone) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Ngày sinh</label>
                            <input type="date" name="dob" id="dob" class="form-control"
                                value="{{ old('dob', $sale->dob) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="identity_card">CMT/CCCD</label>
                            <input type="text" name="identity_card" id="identity_card" class="form-control"
                                value="{{ old('identity_card', $sale->identity_card) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ old('address', $sale->address) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach (listStatus() as $key => $item)
                                <option value="{{ $key }}" {{ old('status', $sale->status)== $key ? 'selected' : ''
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
                            style="background-image: url('{{ getImageUpload($sale->thumbnail, 'admins', 'small') }}');">
                            <span class="placeholder"
                                style="display: {{ $sale->thumbnail ? 'block' : 'none' }};">Chọn hình ảnh</span>
                            <input type="file" id="fileInput" accept="image/*" onchange="previewImage(event)"
                                name="thumbnail">
                            <button class="delete-btn" style="display: {{ $sale->thumbnail ? 'block' : 'none' }}"
                                onclick="deleteImage(event)">
                                <i class="bx bx-x-circle"></i>
                            </button>
                        </div>
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
