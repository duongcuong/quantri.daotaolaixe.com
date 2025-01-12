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
        {{-- @if (Auth::user()->hasPermission('admins.admins.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.admins.create') }}" data-toggle="tooltip"
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
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Ngày tham gia</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ getImageUpload($admin->thumbnail, 'admins', 'small') }}" alt="Avatar" class="avatar" width="50" height="50">
                                {{ $admin->name }}
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @foreach ($admin->roles as $role)
                                    <span class="badge badge-info mr-1">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                            <td> {!! getStatus($admin->status) !!}</td>
                            <td>
                                {{-- <a href="{{ route('admins.admins.show', $admin->id) }}" class="">
                                    <i class="bx lni-eye"></i>
                                </a> --}}
                                <a href="{{ route('admins.admins.edit', $admin->id) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admins.admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
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
            {{ $admins->links() }}
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush


