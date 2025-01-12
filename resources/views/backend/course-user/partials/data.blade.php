<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th rowspan="2">STT</th>
            <th rowspan="2">Avatar</th>
            <th rowspan="2">Mã ĐK / Khóa</th>
            <th rowspan="2">Hạng</th>
            <th rowspan="2">Họ tên</th>
            <th rowspan="2">Ngày sinh</th>
            <th rowspan="2">Giới tính</th>
            <th rowspan="2">Số CMT</th>
            <th rowspan="2">Id thẻ</th>
            <th rowspan="2">Số thẻ</th>
            <th colspan="4" class="text-center">
                Thực hành
            </th>
            <th colspan="2" class="text-center">
                Phiên học
            </th>
            <th rowspan="2">Số tiền đã nạp</th>
            <th rowspan="2">Trạng thái</th>
            <th class="fixed-column text-center" rowspan="2">Hành động</th>
        </tr>
        <tr>
            <th>Cơ bản</th>
            <th>Sa hình</th>
            <th>Đường trường</th>
            <th>Xe chíp</th>
            <th>Giờ</th>
            <th>Km</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($courseUsers as $courseUser)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <img src="{{ getImageUpload($courseUser->user->thumbnail, 'users', 'small') }}"
                    alt="User Thumbnail" class="avatar" width="50">
            </td>
            <td>{{ $courseUser->course->code }} / {{ $courseUser->course->name }}</td>
            <td>{{ $courseUser->course->rank }}</td>
            <td>{{ $courseUser->user->name }}</td>
            <td>{{ \Carbon\Carbon::parse($courseUser->user->dob)->format('d/m/Y') }}</td>
            <td>{{ $courseUser->user->gender == 0 ? 'Nam' : ($courseUser->user->gender == 1 ? 'Nữ' : 'Khác')
                }}</td>
            <td>{{ $courseUser->user->identity_card }}</td>
            <td>{{ $courseUser->user->card_name }}</td>
            <td>{{ $courseUser->user->card_number }}</td>

            <td>{!! getStatusCourseUser($courseUser->basic_status) !!}</td>
            <td>{!! getStatusCourseUser($courseUser->shape_status) !!}</td>
            <td>{!! getStatusCourseUser($courseUser->road_status) !!}</td>
            <td>{!! getStatusCourseUser($courseUser->chip_status) !!}</td>

            <td>{{ number_format($courseUser->km) }}</td>
            <td>{{ number_format($courseUser->hours) }}</td>
            <td>{{ number_format($courseUser->fees_sum_amount) ?? 0 }}</td>
            <td>{!! getStatus($courseUser->status) !!}</td>
            <td class="fixed-column text-center">
                <a href="{{ route('admins.course-user.show', $courseUser->id) }}"
                    class="btn btn-primary btn-sm mr-1">
                    <i class="lni lni-eye"></i>
                </a>
                <a href="{{ route('admins.course-user.edit', $courseUser->id) }}"
                    class="btn btn-warning btn-sm mr-1 btn-edit-ajax" data-cs-modal="#modal-course-user-edit-ajax">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.course-user.destroy', $courseUser->id) }}" method="POST"
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
{{ $courseUsers->links() }}
