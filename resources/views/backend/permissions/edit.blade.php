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
        {{-- @if (Auth::user()->hasPermission('admins.permissions.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.permissions.index') }}" data-toggle="tooltip"
            title="Quay về trang quản lý người dùng &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
        {{-- @endif --}}
    </div>
</div>
<form action="{{ route('admins.permissions.update', $permission->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="form-group">
                        <label for="module_id">Module</label>
                        <select name="module_id" id="module_id" class="form-control" required>
                            @foreach ($modules as $module)
                                <option value="{{ $module->id }}" {{ old('module_id', $permission->module_id) == $module->id ? 'selected' : '' }}>{{ $module->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $permission->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $permission->slug) }}" required>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card radius-15">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary"><i class="bx bxs-save mr-1"></i>Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('js')
@endpush
