<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong class="mr-1">Tổng số giáo viên: </strong>
    <strong class="mr-2 text-danger">{{ number_format($teachers->total()) }}</strong>
</div>
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
            <th>Biển số xe</th>
            <th>Số giờ đã dạy</th>
            <th>SĐT</th>
            {{-- <th>Tên thẻ</th>
            <th>Số thẻ</th> --}}
            <th>Trạng thái</th>
            <th>Ngày hoạt động</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teachers as $teacher)
        <tr>
            <td>{{ getSTT($teachers, $loop->iteration) }}</td>
            <td><img src="{{ getImageUpload($teacher->thumbnail, 'admins', 'small') }}" alt="Avatar" class="avatar"
                    width="50"></td>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->gender == 0 ? 'Nam' : ($teacher->gender == 1 ? 'Nữ' : 'Khác') }}</td>
            <td>{{ $teacher->dob }}</td>
            <td>{{ $teacher->identity_card }}</td>
            <td>{{ $teacher->address }}</td>
            <td>{!! getRank($teacher->rank) !!}</td>
            <td>{{ $teacher->license_plate }}</td>
            <td>{{ getFormattedSoGioChayDuocAttribute($teacher->calendars_sum_so_gio_chay_duoc) }}</td>
            <td>{{ $teacher->phone }}</td>
            {{-- <td>{{ $teacher->card_name }}</td>
            <td>{{ $teacher->card_number }}</td> --}}
            <td>{!! getStatus($teacher->status) !!}</td>
            <td>{{ getDateTimeStamp($teacher->created_at, 'd/m/Y') }}</td>
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
