@extends('backend.app')
@section('title')
All user
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
                    <li class="breadcrumb-item active" aria-current="page">Người dùng</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.permissions.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.permissions.create') }}" data-toggle="tooltip"
            title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
        {{-- @endif --}}
    </div>
</div>
<div class="card radius-15">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Slug</th>
                        <th>Module</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->slug }}</td>
                        <td>{{ $permission->module->name }}</td>
                        <td>
                            {{-- <a href="{{ route('admins.permissions.show', $permission->id) }}" class="">
                                <i class="bx lni-eye"></i>
                            </a> --}}
                            <a href="{{ route('admins.permissions.edit', $permission->id) }}"
                                class="btn btn-warning btn-sm mr-2">
                                <i class="bx bx-edit"></i>
                            </a>
                            <form action="{{ route('admins.permissions.destroy', $permission->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $permissions->links() }}
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
