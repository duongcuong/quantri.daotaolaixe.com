@php
$columns = request()->has('show_column') ? explode(',', request()->show_column) : [];
@endphp
<table id="example" class="table table-sm table-hover">
    <thead>
        <tr>
            <th>STT</th>
            @if (!request()->has('show_column') || in_array('name', $columns))
            <th>Tên sự kiện</th>
            @endif

            @if (!request()->has('show_column') || in_array('status', $columns))
            <th>Trạng thái</th>
            @endif

            @if (!request()->has('show_column') || in_array('priority', $columns))
            <th>Ưu tiên</th>
            @endif

            @if (!request()->has('show_column') || in_array('date_start', $columns))
            <th>Ngày bắt đầu</th>
            @endif

            @if (!request()->has('show_column') || in_array('date_end', $columns))
            <th>Ngày kết thúc</th>
            @endif

            @if (!request()->has('show_column') || in_array('loai_thi', $columns))
            <th>Môn thi</th>
            @endif

            @if (!request()->has('show_column') || in_array('loai_hoc', $columns))
            <th>Môn học</th>
            @endif

            @if (!request()->has('show_column') || in_array('km', $columns))
            <th>Km</th>
            @endif

            @if (!request()->has('show_column') || in_array('tuition_fee', $columns))
            <th>Học phí</th>
            @endif

            @if (!request()->has('show_column') || in_array('ngay_dong_hoc_phi', $columns))
            <th>Ngày nạp</th>
            @endif

            @if (!request()->has('show_column') || in_array('description', $columns))
            <th>Mô tả</th>
            @endif

            @if (!request()->has('show_column') || in_array('admin_id', $columns))
            <th>Người phụ trách</th>
            @endif

            @if (!request()->has('show_column') || in_array('user_id', $columns))
            <th>Học viên</th>
            @endif

            @if (!request()->has('show_column') || in_array('teacher_id', $columns))
            <th>Giáo viên</th>
            @endif

            @if (!request()->has('show_column') || in_array('course_user_id', $columns))
            <th>Học viên - Khóa học</th>
            @endif

            @if (!request()->has('show_column') || in_array('lead_id', $columns))
            <th>Lead</th>
            @endif
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calendars as $calendar)
        <tr>
            <td>{{ $loop->iteration }}</td>
            {{-- <td>{!! getTypeCalendar($calendar->type) !!}</td> --}}

            @if (!request()->has('show_column') || in_array('name', $columns))
            <td>{{ $calendar->name }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('status', $columns))
            <td>{!! getStatusCalendarByType($calendar->type, $calendar->status) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('priority', $columns))
            <td>{!! getPriority($calendar->priority) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('date_start', $columns))
            <td>{{ getDateTimeStamp($calendar->date_start, 'd/m/Y') }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('date_end', $columns))
            <td>{{ getDateTimeStamp($calendar->date_end, 'd/m/Y') }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('loai_thi', $columns))
            <td>{{ getLoaiThi($calendar->loai_thi) }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('loai_hoc', $columns))
            <td>{!! getLoaiHoc($calendar->loai_hoc) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('km', $columns))
            <td>{!! number_format($calendar->km) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('tuition_fee', $columns))
            <td>{!! getMoney($calendar->tuition_fee) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('ngay_dong_hoc_phi', $columns))
            <td>{{ getDateTimeStamp($calendar->ngay_dong_hoc_phi, 'd/m/Y') }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('description', $columns))
            <td>{{ $calendar->description }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('admin_id', $columns))
            <td>{{ $calendar->admin->name ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('user_id', $columns))
            <td>{{ $calendar->user->name ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('teacher_id', $columns))
            <td>{{ $calendar->teacher->name ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('course_user_id', $columns))
            <td>{{ $calendar->courseUser->user->name ?? '' }} - {{ $calendar->courseUser->course->code ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('lead_id', $columns))
            <td>{{ $calendar->lead->name ?? '' }}</td>
            @endif

            <td class="fixed-column text-center">
                <a href="{{ route('admins.calendars.edit', $calendar->id) }}"
                    class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-calendars-edit-ajax">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.calendars.destroy', $calendar->id) }}" class="delete-form-ajax"
                    method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bx bx-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $calendars->links() }}
