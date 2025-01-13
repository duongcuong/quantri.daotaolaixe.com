@extends('backend.app')
@section('title')
Sửa lead
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
                    <li class="breadcrumb-item active" aria-current="page">Sửa lead</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.leads.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.leads.index') }}" data-toggle="tooltip"
            title="Quay về trang quản lý lead &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
        {{-- @endif --}}
    </div>
</div>
<form action="{{ route('admins.leads.update', $lead->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_id">Chọn học viên(Nếu có)</label>
                            <select class="select2-ajax-single form-control" name="user_id"
                                data-selected-id="{{ $lead->user_id }}" data-placeholder="Chọn học viên"
                                data-url="{{ route('admins.users.list') }}" id="change-hoc-vien"
                                >
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $lead->name }}"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $lead->email }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">SĐT</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="34334343">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ $lead->address }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Ngày sinh</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="{{ $lead->dob }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="source">Nguồn</label>
                            <input type="text" name="source" id="source" class="form-control"
                                value="{{ $lead->source }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="interest_level">Mức độ quan tâm</label>
                            <select name="interest_level" id="interest_level" class="form-control">
                                @foreach (listLevels() as $key => $item)
                                <option value="{{ $key }}" {{ $lead->interest_level == $key ? 'selected' : '' }}>{{
                                    $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description">Ghi chú</label>
                            <textarea name="description" id="description"
                                class="form-control">{{ $lead->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="form-group">
                        <label for="assigned_to">Người phụ trách</label>
                        <select class="select2-ajax-single form-control" name="assigned_to"
                            data-selected-id="{{ $lead->assigned_to }}" data-placeholder="Chọn người phụ trách"
                            data-url="{{ route('admins.admins.list', ['role'=> ROLE_SALE]) }}"
                            >
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
