<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong class="mr-1">Tổng số học viên: </strong>
    <strong class="mr-2 text-danger">{{ number_format($users->total()) }}</strong>
</div>
<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            {{-- <th>Avatar</th> --}}
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>SĐT</th>
            <th>CMT/CCCD</th>
            <th>Địa chỉ</th>
            {{-- <th>Tên thẻ</th> --}}
            <th>Số thẻ</th>
            <th>Trạng thái</th>
            <th>Ngày hoạt động</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ getSTT($users, $loop->iteration) }}</td>
            {{-- <td><img src="{{ getImageUpload($user->thumbnail, 'users', 'small') }}" alt="Avatar" class="avatar"
                    width="50"></td> --}}
            <td>{{ $user->name }}</td>
            <td>{{ getDateTimeStamp($user->dob, 'd/m/Y') }}</td>
            <td>{{ $user->gender == 0 ? 'Nam' : ($user->gender == 1 ? 'Nữ' : 'Khác') }}</td>
            <td>{{ $user->phone }}</td>


            <td>{{ $user->identity_card }}</td>
            <td>{{ $user->address }}</td>
            {{-- <td>{{ $user->card_name }}</td> --}}
            <td>{{ $user->card_number }}</td>
            <td>{!! getStatus($user->status) !!}</td>
            <td>{{ getDateTimeStamp($user->created_at, 'd/m/Y') }}</td>
            <td class="fixed-column text-center">
                <div class="d-flex">
                    <a href="{{ route('admins.users.show', $user->id) }}" class="btn btn-primary btn-sm mr-1">
                        <i class="lni lni-eye"></i>
                    </a>
                    <a href="{{ route('admins.users.edit', $user->id) }}" class="btn btn-warning btn-sm mr-1">
                        <i class="bx bx-edit"></i>
                    </a>
                    <form action="{{ route('admins.users.destroy', $user->id) }}" method="POST"
                        style="display:inline-block;" class="delete-form-ajax">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-btn-confirm">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
