@extends('backend.app')
@section('title')
Tất cả giáo viên
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
                    <li class="breadcrumb-item active" aria-current="page">Giáo viên</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.teachers.index')) --}}
        <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.teachers.create') }}" data-toggle="tooltip"
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
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>CMT/CCCD</th>
                        <th>Địa chỉ</th>
                        <th>Hạng</th>
                        <th>GPLX</th>
                        <th>Tên thẻ</th>
                        <th>Số thẻ</th>
                        <th>Trạng thái</th>
                        <th class="fixed-column text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ getImageUpload($teacher->thumbnail, 'admins', 'small') }}" alt="Avatar" class="avatar"
                                width="50"></td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->gender == 0 ? 'Nam' : ($teacher->gender == 1 ? 'Nữ' : 'Khác') }}</td>
                        <td>{{ $teacher->dob }}</td>
                        <td>{{ $teacher->identity_card }}</td>
                        <td>{{ $teacher->address }}</td>
                        <td>{!! getRank($teacher->rank) !!}</td>
                        <td>{{ $teacher->license }}</td>
                        <td>{{ $teacher->card_name }}</td>
                        <td>{{ $teacher->card_number }}</td>
                        <td>{!! getStatus($teacher->status) !!}</td>
                        <td class="fixed-column text-center">
                            <a href="{{ route('admins.teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm mr-2">
                                <i class="bx bx-edit"></i>
                            </a>
                            <form action="{{ route('admins.teachers.destroy', $teacher->id) }}" method="POST"
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
            {{ $teachers->links() }}
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
