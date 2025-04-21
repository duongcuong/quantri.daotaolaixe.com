@extends('backend.app')
@section('title')
Sửa xe
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
                    <li class="breadcrumb-item active" aria-current="page">Sửa xe</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.vehicles.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.vehicles.index') }}" data-toggle="tooltip"
            title="Quay về trang quản lý xe &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
        {{-- @endif --}}
    </div>
</div>
<form action="{{ route('admins.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 col-md-12 mx-auto">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="license_plate">Biển số</label>
                            <input type="text" name="license_plate" id="license_plate" class="form-control"
                                value="{{ old('license_plate', $vehicle->license_plate) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="license_plate">Model</label>
                            <input type="text" name="model" id="model" class="form-control" value="{{ old('model', $vehicle->model) }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="license_plate">Hạng</label>
                            <select name="rank" id="rank" class="form-control">
                                <option value="">Chọn hạng</option>
                                @foreach (listRanks() as $key => $value)
                                <option value="{{ $key }}" {{ $key == old('rank', $vehicle->rank) ? 'selected' : '' }}>{{ $value }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="type">Loại</label>
                            <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $vehicle->type) }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="color">Màu sắc</label>
                            <input type="text" name="color" id="color" class="form-control" value="{{ old('color', $vehicle->color) }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gptl_number">Số GPTL</label>
                            <input type="text" name="gptl_number" id="gptl_number" class="form-control"
                                value="{{ old('gptl_number', $vehicle->gptl_number) }}">
                        </div>
                        {{-- <div class="form-group col-md-4">
                            <label for="gptl_expiry_date">Ngày hết hạn GPTL</label>
                            <input type="date" name="gptl_expiry_date" id="gptl_expiry_date" class="form-control"
                                value="{{ old('gptl_expiry_date', $vehicle->gptl_expiry_date) }}">
                        </div> --}}
                        <div class="form-group col-md-4">
                            <label for="manufacture_year">Năm sản xuất</label>
                            <input type="number" name="manufacture_year" id="manufacture_year" class="form-control"
                                value="{{ old('manufacture_year', $vehicle->manufacture_year) }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="" class="form-control">{{ old('note', $vehicle->note) }}</textarea>
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
