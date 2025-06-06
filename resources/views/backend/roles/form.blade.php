@extends('backend.app')
@section('title')
{{ isset($role->id) ? 'Sửa vai trò' : 'Tạo vai trò mới' }}
@endsection
@push('css')
@endpush
@section('content')
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3">Dashboard</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i class='bx bx-home-alt'></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($role->id) ? 'Sửa vai trò' : 'Tạo vai
                    trò mới' }}</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12 col-lg-12 mx-auto">
        <div class="card radius-15">
            <div class="card-header border-bottom-0 mb-4">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">{{ isset($role->id) ? 'Sửa vai trò' : 'Tạo vai trò mới' }}</h5>
                    </div>
                    <div class="ml-auto">
                        {{-- @if (Auth::user()->hasPermission('admins.roles.index')) --}}
                        <a class="btn btn-primary" href="{{ route('admins.roles.index') }}" data-toggle="tooltip"
                            title="Quay về trang quản lý vai trò &#9194;"><i class="bx bx-rewind"></i>Quay lại</a>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ isset($role->id) ? route('admins.roles.update', $role->id) : route('admins.roles.store') }}"
                    method="post">
                    @csrf
                    @isset($role->id)
                    @method('PUT')
                    @endisset
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tên vai trò</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                                    value="{{ $role->name ?? old('name') }}" placeholder="Tên vai trò">
                                @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description"
                                    placeholder="Type the content here!">{{ $role->description ?? old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-form-label text-center text-uppercase mx-auto"
                                style="border-bottom: 1px solid rgb(47, 129, 252);min-width: 35%"><b>Quyền quản
                                    lý</b></label>
                        </div>
                        <br>
                        <p class=" text-center">
                            @error('permissions')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </p>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 ml-4">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" class="custom-control-input" name="select-all"
                                        id="select-all" @if (isset($role->id)) {{ $permission ==
                                    $role->permissions()->count() ? 'checked' : '' }} @endif>

                                    <label class="custom-control-label" for="select-all">Tất cả quyền</label>
                                </div>
                            </div>
                        </div>
                        @forelse ($modules->chunk(3) as $chunks)
                        <div class="row">
                            @foreach ($chunks as $key => $module)
                            <div class="col-12 col-lg-4 col-xl-4">
                                <div class="card radius-15">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h6><strong>{{ $module->name }}</strong></h6>
                                        </div>
                                        @foreach ($module->permissions as $permission)
                                        <div class="mb-3 ml-4">
                                            <div
                                                class="custom-control custom-checkbox @error('permissions') invalid-feedback @enderror ">
                                                <input type="checkbox" id="permission-{{ $permission->id }}"
                                                    value="{{ $permission->id }}" @isset($role->id)
                                                @foreach ($role->permissions as $rolePermission)
                                                {{ $permission->id == $rolePermission->id ? 'checked' : '' }}
                                                @endforeach
                                                @endisset
                                                class="custom-control-input"
                                                name="permissions[]">
                                                <label class="custom-control-label"
                                                    for="permission-{{ $permission->id }}">{{ $permission->name
                                                    }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @empty
                        <div class="row">
                            <span class="col text-center text-danger"></span>
                        </div>
                        @endforelse
                        <div class="float-right">
                            <div class="btn-group">
                                @if (isset($role->id))
                                <button type="submit" class="btn btn-primary px-4" data-toggle="tooltip"
                                    title="Update those data &#128190;"> <i class="bx bx-task"></i> Cập nhật</button>
                                @else
                                <button type="submit" class="btn btn-primary px-4" data-toggle="tooltip"
                                    title="Save to database &#128190;"> <i class="bx bx-save"></i> Lưu</button>
                                @endif
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $('#select-all').click(function(e) {
    if (this.checked) {
      $(':checkbox').each(function() {
        this.checked = true;
      });
    } else {
      $(':checkbox').each(function() {
        this.checked = false;
      });
    }
  });

</script>
@endpush
