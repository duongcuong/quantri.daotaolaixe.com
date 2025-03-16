@php
$columns = request()->has('show_column') ? explode(',', request()->show_column) : [];
@endphp
<table id="example" class="table table-sm table-hover">
    <thead>
        <tr>
            <th>STT</th>
            @if (!request()->has('show_column') || in_array('type', $columns))
            <th>Loại</th>
            @endif

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
            <th>
                @if (request()->type == 'exam_schedule' || request()->type == 'class_schedule')
                Ngày thi
                @else
                Ngày bắt đầu
                @endif
            </th>
            @endif

            @if (!request()->has('show_column') || in_array('date_end', $columns))
            <th>Ngày kết thúc</th>
            @endif

            @if (!request()->has('show_column') || in_array('name_hocvien', $columns))
            <th>Học viên</th>
            @endif

            @if (!request()->has('show_column') || in_array('dob', $columns))
            <th>Ngày sinh</th>
            @endif

            @if (!request()->has('show_column') || in_array('cccd', $columns))
            <th>CCCD</th>
            @endif

            @if (!request()->has('show_column') || in_array('phone', $columns))
            <th>SĐT</th>
            @endif

            @if (!request()->has('show_column') || in_array('sbd', $columns))
            <th>SBD</th>
            @endif

            @if (!request()->has('show_column') || in_array('teacher_id', $columns))
            <th>Giáo viên</th>
            @endif


            @if (!request()->has('show_column') || in_array('diem_don', $columns))
            <th>Điểm đón</th>
            @endif

            @if (!request()->has('show_column') || in_array('san', $columns))
            <th>
                @if (request()->type == 'exam_schedule' || request()->type == 'class_schedule')
                Sân thi
                @else
                Sân
                @endif
            </th>
            @endif

            @if (!request()->has('show_column') || in_array('course_code', $columns))
            <th>Khoá học</th>
            @endif

            @if (!request()->has('show_column') || in_array('loai_thi', $columns))
            <th>Môn thi</th>
            @endif

            @if (!request()->has('show_column') || in_array('health_check_date', $columns))
            <th>Khám SK</th>
            @endif

            @if (!request()->has('show_column') || in_array('loai_hoc', $columns))
            <th>Môn học</th>
            @endif

            @if (!request()->has('show_column') || in_array('km', $columns))
            <th>Km</th>
            @endif

            @if (!request()->has('show_column') || in_array('approval', $columns))
            <th>Duyệt Km</th>
            @endif

            @if (!request()->has('show_column') || in_array('so_gio_chay_duoc', $columns))
            <th>Giờ</th>
            @endif

            @if (!request()->has('show_column') || in_array('tuition_fee', $columns))
            <th>Lệ phí thi</th>
            @endif

            @if (!request()->has('show_column') || in_array('ngay_dong_hoc_phi', $columns))
            <th>Ngày nạp lệ phí</th>
            @endif

            @if (!request()->has('show_column') || in_array('description', $columns))
            <th>Mô tả</th>
            @endif

            @if (!request()->has('show_column') || in_array('admin_id', $columns))
            <th>Người phụ trách</th>
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

            @if (!request()->has('show_column') || in_array('type', $columns))
            <td>{!! getTypeCalendar($calendar->type) !!}</td>
            @endif

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
            <td>
                @if (request()->type == 'exam_schedule' || request()->type == 'class_schedule')
                <a href="#" data-start-date="{{ $calendar->date_start }}" class="btn-show-exam-schedule">
                    {!! formatDateTimeVn($calendar->date_start) !!}
                </a>
                @else
                {!! formatDateTimeVn($calendar->date_start) !!}
                @endif
            </td>
            @endif

            @if (!request()->has('show_column') || in_array('date_end', $columns))
            <td>{!! formatDateTimeVn($calendar->date_end) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('name_hocvien', $columns))
            <td>{{ $calendar->courseUser->user->name ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('dob', $columns))
            <td>{{ $calendar->courseUser && $calendar->courseUser->user ?
                getDateTimeStamp($calendar->courseUser->user->dob, 'd/m/Y') : "" }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('cccd', $columns))
            <td>{{ $calendar->courseUser->user->identity_card ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('phone', $columns))
            <td>{{ $calendar->courseUser->user->phone ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('sbd', $columns))
            <td>{{ $calendar->sbd ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('teacher_id', $columns))
            <td>{{ $calendar->teacher->name ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('diem_don', $columns))
            <td>{{ $calendar->diem_don }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('san', $columns))
            <td>
                @if (request()->type == 'exam_schedule' || request()->type == 'class_schedule')
                <a href="#" data-exam-field="{{ $calendar->examField->id ?? '' }}" class="btn-show-exam-field">
                    {{ $calendar->examField->name ?? '' }}
                </a>
                @else
                {{ $calendar->examField->name ?? '' }}
                @endif
                </td>
            @endif

            @if (!request()->has('show_column') || in_array('course_code', $columns))
            <td>{{ $calendar->courseUser->course->code ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('loai_thi', $columns))
            <td>{!! getLoaiThi($calendar->loai_thi) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('health_check_date', $columns))
            <td>{{ $calendar->courseUser ? getDateTimeStamp($calendar->courseUser->health_check_date, 'd/m/Y') : '' }}
            </td>
            @endif

            @if (!request()->has('show_column') || in_array('loai_hoc', $columns))
            <td>{!! getLoaiHoc($calendar->loai_hoc) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('km', $columns))
            <td>{!! number_format($calendar->km) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('approval', $columns))
            <td>{!! getStatusApprovedKm($calendar->approval, $calendar->loai_hoc, $calendar->type) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('so_gio_chay_duoc', $columns))
            <td>{!! $calendar->so_gio_chay_duoc !!}</td>
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

            @if (!request()->has('show_column') || in_array('course_user_id', $columns))
            <td>{{ $calendar->courseUser->user->name ?? '' }} - {{ $calendar->courseUser->course->code ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('lead_id', $columns))
            <td>{{ $calendar->lead->name ?? '' }}</td>
            @endif

            <td class="fixed-column text-center">
                <a href="{{ route('admins.calendars.edit', ['calendar' => $calendar->id, 'reload' => request()->reload]) }}"
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
