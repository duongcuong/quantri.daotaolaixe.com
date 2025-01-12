@extends('backend.app')
@section('title')
Tạo module
@endsection
@push('css')
@endpush
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="d-flex mb-3">
            <div class="page-breadcrumb d-flex align-items-center">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i
                                        class='bx bx-home-alt'></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tạo module mới</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="ml-auto">
                {{-- @if (Auth::user()->hasPermission('admins.modules.index')) --}}
                <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.modules.index') }}"
                    data-toggle="tooltip" title="Quay về trang quản lý module &#9194;"><i class="bx bx-rewind"></i>Quay
                    lại</a>
                {{-- @endif --}}
            </div>
        </div>

        <form action="{{ route('admins.modules.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="bx bxs-save mr-1"></i>Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
@endpush
