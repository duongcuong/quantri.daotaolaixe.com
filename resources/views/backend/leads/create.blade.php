@extends('backend.app')
@section('title')
Tạo lead
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
                    <li class="breadcrumb-item active" aria-current="page">Tạo lead mới</li>
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
<form action="{{ route('admins.leads.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_id">Chọn học viên(Nếu có)</label>
                            <select class="select2-ajax-single form-control" name="user_id"
                                data-selected-id="{{ old('user_id') }}" data-placeholder="Chọn học viên"
                                data-url="{{ route('admins.users.list') }}" id="change-hoc-vien">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">SĐT</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ old('address') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Ngày sinh</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="lead_source_id" class="d-flex justify-content-between">
                                <span>Nguồn</span>
                                <a class="btn-create-ajax" href="{{ route('admins.lead-sources.create') }}"
                                    data-cs-modal="#modal-lead-sources-create-ajax" title="Thêm mới"><i
                                        class="bx bx-plus"></i>Thêm nguồn</a>
                            </label>
                            <select name="lead_source_id" id="lead_source_id" class="form-control single-select"
                                data-placeholder="Chọn nguồn" data-allow-clear="true">
                                <option></option>
                                @foreach ($leadSources as $leadSource)
                                <option value="{{ $leadSource->id }}"> {{ $leadSource->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="interest_level">Mức độ quan tâm</label>
                            <select name="interest_level" id="interest_level" class="form-control">
                                @foreach (listLevels() as $key => $item)
                                <option value="{{ $key }}" {{ old('interest_level')==$key ? 'selected' : '' }}>{{ $item
                                    }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="description">Trạng thái</label>
                            <select name="status" id="" class="form-control">
                                @foreach (listStatusLeads() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="description">Ghi chú</label>
                            <textarea name="description" id="description"
                                class="form-control">{{ old('description') }}</textarea>
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
                            data-selected-id="{{ old('assigned_to') }}" data-placeholder="Chọn người phụ trách"
                            data-url="{{ route('admins.admins.list', ['role'=> ROLE_SALES]) }}">
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
