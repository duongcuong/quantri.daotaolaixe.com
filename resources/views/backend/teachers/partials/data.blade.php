<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong class="mr-1">Tổng số giáo viên: </strong>
    <strong class="mr-2 text-danger">{{ number_format($teachers->total()) }}</strong>
</div>
<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th rowspan="2">STT</th>
            {{-- <th rowspan="2">Avatar</th> --}}
            <th rowspan="2">Họ tên</th>
            <th rowspan="2">Giới tính</th>
            <th rowspan="2">Ngày sinh</th>
            <th rowspan="2">CMT/CCCD</th>
            <th rowspan="2">Địa chỉ</th>
            <th rowspan="2">Hạng</th>
            <th rowspan="2">Biển số xe</th>
            <th rowspan="2">SĐT</th>
            <th colspan="4" class="text-center">Số giờ đã dạy</th>
            {{-- <th>Tên thẻ</th>
            <th>Số thẻ</th> --}}
            <th rowspan="2">Trạng thái</th>
            <th rowspan="2">Ngày hoạt động</th>
            <th rowspan="2" class="fixed-column text-center">Hành động</th>
        </tr>
        <tr>
            <th>Tổng</th>
            <th>Kỹ năng</th>
            <th>Sa hình</th>
            <th>Chạy DAT</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teachers as $teacher)
        <tr>
            <td>{{ getSTT($teachers, $loop->iteration) }}</td>
            {{-- <td><img src="{{ getImageUpload($teacher->thumbnail, 'admins', 'small') }}" alt="Avatar" class="avatar"
                    width="50"></td> --}}
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->gender == 0 ? 'Nam' : ($teacher->gender == 1 ? 'Nữ' : 'Khác') }}</td>
            <td>{{ getDateTimeStamp($teacher->dob, 'd/m/Y') }}</td>
            <td>{{ $teacher->identity_card }}</td>
            <td>{{ $teacher->address }}</td>
            <td>{!! getRank($teacher->rank) !!}</td>
            <td>{{ $teacher->vehicle ? $teacher->vehicle->license_plate : '' }}</td>
            <td>{{ $teacher->phone }}</td>
            <td style="color: red">{{ getFormattedSoGioChayDuocAttribute($teacher->calendars_sum_so_gio_chay_duoc) }}</td>
            <td>{{ getFormattedSoGioChayDuocAttribute($teacher->so_gio_chay_duoc_hoc_ky_nang) }}</td>
            <td>{{ getFormattedSoGioChayDuocAttribute($teacher->so_gio_chay_duoc_thuc_hanh) }}</td>
            <td>{{ getFormattedSoGioChayDuocAttribute($teacher->so_gio_chay_duoc_chay_dat) }}</td>
            {{-- <td>{{ $teacher->card_name }}</td>
            <td>{{ $teacher->card_number }}</td> --}}
            <td>{!! getStatus($teacher->status) !!}</td>
            <td>{{ getDateTimeStamp($teacher->created_at, 'd/m/Y') }}</td>
            <td class="fixed-column text-center">
                <div class="d-flex">
                    @if (canAccess('admins.teachers.edit'))
                    <a href="{{ route('admins.teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm mr-2">
                        <i class="bx bx-edit"></i>
                    </a>
                    @endif

                    @if (canAccess('admins.teachers.destroy'))
                    <form action="{{ route('admins.teachers.destroy', $teacher->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-btn-confirm">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $teachers->links() }}
