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
        @if($lead->course_user_id)
        <a class="btn btn-success btn-sm mr-2 btn-convert-course-user"
            href="{{ route('admins.course-user.show', $lead->course_user_id) }}" data-toggle="tooltip"
            title="Xem Học Viên - Khoá học"><i class="bx bx-user-check mr-1"></i>Xem Học viên - Khoá học</a>
        @else
        <a class="btn btn-outline-danger btn-sm mr-2 btn-convert-course-user" href="javascript:;" data-toggle="tooltip"
            title="Chuyển sang Học Viên - Khoá học"><i class="bx bx-street-view mr-1"></i>Chuyển sang HV - KH</a>
        @endif
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
                                data-selected-id="{{ old('user_id', $lead->user_id) }}" data-placeholder="Chọn học viên"
                                data-url="{{ route('admins.users.list') }}" id="change-hoc-vien">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $lead->name) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $lead->email) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">SĐT</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ old('phone', $lead->phone) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ old('address', $lead->address) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Ngày sinh</label>
                            <input type="date" name="dob" id="dob" class="form-control"
                                value="{{ old('dob', getDateTimeStamp($lead->dob)) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lead_source_id" class="d-flex justify-content-between">
                                <span>Nguồn</span>
                                <a class="btn-create-ajax" href="{{ route('admins.lead-sources.create') }}"
                                    data-cs-modal="#modal-lead-sources-create-ajax" title="Thêm mới"><i
                                        class="bx bx-plus"></i>Thêm nguồn</a>
                            </label>
                            <select class="select2-ajax-single form-control" name="lead_source_id"
                                data-selected-id="{{ old('lead_source_id', $lead->lead_source_id) }}"
                                data-placeholder="Chọn nguồn" data-url="{{ route('admins.lead-sources.list') }}">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="interest_level">Mức độ quan tâm</label>
                            <select name="interest_level" id="interest_level" class="form-control">
                                @foreach (listLevels() as $key => $item)
                                <option value="{{ $key }}" {{ old('interest_level', $lead->interest_level) == $key ?
                                    'selected' : '' }}>{{
                                    $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="" class="form-control">
                                @foreach (listStatusLeads() as $key => $value)
                                <option value="{{ $key }}" {{ old('status', $lead->status) == $key ? 'selected' : ''
                                    }}>{{ $value }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description">Ghi chú</label>
                            <textarea name="description" id="description"
                                class="form-control">{{ old('description', $lead->description) }}</textarea>
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
                            data-selected-id="{{ old('assigned_to', $lead->assigned_to) }}"
                            data-placeholder="Chọn người phụ trách"
                            data-url="{{ route('admins.admins.list', ['role'=> ROLE_SALES]) }}">
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bx bxs-save mr-1"></i>Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
@include('backend.leads.partials.calendars')
@include('backend.leads.modals.convert_lead')
@endsection
@push('js')
@endpush
