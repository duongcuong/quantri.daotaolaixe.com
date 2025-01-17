@extends('backend.app')
@section('title')
Tất cả học viên
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
                    <li class="breadcrumb-item active" aria-current="page">Học viên</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.users.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.users.create') }}" data-toggle="tooltip"
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
                        <th>Avatar</th>
                        <th>Họ tên</th>
                        <th>SĐT</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>CMT/CCCD</th>
                        <th>Địa chỉ</th>
                        <th>Tên thẻ</th>
                        <th>Số thẻ</th>
                        <th>Trạng thái</th>
                        <th class="fixed-column text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ getImageUpload($user->thumbnail, 'users', 'small') }}" alt="Avatar" class="avatar"
                                width="50"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->gender == 0 ? 'Nam' : ($user->gender == 1 ? 'Nữ' : 'Khác') }}</td>
                        <td>{{ $user->dob }}</td>
                        <td>{{ $user->identity_card }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->card_name }}</td>
                        <td>{{ $user->card_number }}</td>
                        <td>{!! getStatus($user->status) !!}</td>
                        <td class="fixed-column text-center">
                            <a href="{{ route('admins.users.edit', $user->id) }}" class="btn btn-warning btn-sm mr-2">
                                <i class="bx bx-edit"></i>
                            </a>
                            <form action="{{ route('admins.users.destroy', $user->id) }}" method="POST"
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
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
