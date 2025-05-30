@php
$columns = request()->has('show_column') ? explode(',', request()->show_column) : [];
@endphp
<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            @if (!request()->has('show_column') || in_array('type', $columns))
            <th>Loại</th>
            @endif

            @if (!request()->has('show_column') || in_array('name', $columns))
            <th>Tên sự kiện</th>
            @endif

            @if (!request()->has('show_column') || in_array('date_start', $columns))
            <th>
                @switch(request()->type)
                @case('exam_schedule')
                Ngày
                @break
                @case('class_schedule')
                Ngày
                @break
                @default
                Ngày
                @endswitch
            </th>
            @endif

            @if (!request()->has('show_column') || in_array('time', $columns))
            <th>
                @switch(request()->type)
                @case('class_schedule')
                Thời gian
                @break
                @default
                Thời gian
                @endswitch
            </th>
            @endif

            @if (!request()->has('show_column') || in_array('total_calendar', $columns))
            <th>
                Tổng lịch dạy
            </th>
            @endif

            @if (!request()->has('show_column') || in_array('status', $columns))
            <th>Trạng thái</th>
            @endif

            @if (!request()->has('show_column') || in_array('priority', $columns))
            <th>Ưu tiên</th>
            @endif

            @if (!request()->has('show_column') || in_array('name_hocvien', $columns))
            <th>Học viên</th>
            @endif

            @if (!request()->has('show_column') || in_array('dob', $columns))
            <th>Ngày sinh</th>
            @endif

            @if (!request()->has('show_column') || in_array('loai_hoc', $columns))
            <th>Buổi học</th>
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
                @switch(request()->type)
                @case('exam_schedule')
                Sân thi
                @break
                @case('class_schedule')
                Sân học
                @break
                @default
                Sân
                @endswitch
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

            @if (!request()->has('show_column') || in_array('is_tudong', $columns))
            <th>Tự động</th>
            @endif

            @if (!request()->has('show_column') || in_array('is_bandem', $columns))
            <th>Ban đêm</th>
            @endif

            @if (!request()->has('show_column') || in_array('approval', $columns))
            <th>Duyệt Km</th>
            @endif

            @if (!request()->has('show_column') || in_array('km', $columns))
            <th>Km</th>
            @endif

            @if (!request()->has('show_column') || in_array('so_gio_chay_duoc', $columns))
            <th>Giờ</th>
            @endif

            @if (!request()->has('show_column') || in_array('pickup_registered', $columns))
            <th class="text-center">Đưa đón</th>
            @endif

            {{-- @if (!request()->has('show_column') || in_array('tuition_fee', $columns))
            <th>Lệ phí thi</th>
            @endif --}}

            {{-- @if (!request()->has('show_column') || in_array('ngay_dong_hoc_phi', $columns))
            <th>Ngày nộp lệ phí</th>
            @endif --}}

            @if (!request()->has('show_column') || in_array('gifted_hours', $columns))
            <th>Giờ tặng</th>
            @endif

            @if (!request()->has('show_column') || in_array('chip_hours', $columns))
            <th>Số giờ đăng ký</th>
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

            @if (!request()->has('show_column') || in_array('date_start', $columns))
            <td class="date-start-column">
                @if (request()->type == 'exam_schedule' || request()->type == 'class_schedule')
                <a href="javascript:;" data-start-date="{{ $calendar->date_start }}" class="btn-show-exam-schedule">
                    {!! formatDateTimeVn($calendar->date_start) !!}
                </a>
                @else
                {!! formatDateTimeVn($calendar->date_start) !!}
                @endif
            </td>
            @endif

            @if (!request()->has('show_column') || in_array('total_calendar', $columns))
            <td>{!! 0 !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('time', $columns))
            <td>{!! formatTimeBetweenVn($calendar->date_start, $calendar->date_end) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('status', $columns))
            <td>{!! getStatusCalendarByType($calendar->type, $calendar->status) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('priority', $columns))
            <td>{!! getPriority($calendar->priority) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('name_hocvien', $columns))
            <td>{{ $calendar->courseUser->user->name ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('dob', $columns))
            <td>{{ $calendar->courseUser && $calendar->courseUser->user ?
                getDateTimeStamp($calendar->courseUser->user->dob, 'd/m/Y') : "" }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('loai_hoc', $columns))
            <td>{!! getLoaiHoc($calendar->loai_hoc) !!}</td>
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

            @if (!request()->has('show_column') || in_array('is_tudong', $columns))
            <th class="fs-20 text-center">{!! getTickTrueOrFalse($calendar->is_tudong) !!}</th>
            @endif

            @if (!request()->has('show_column') || in_array('is_bandem', $columns))
            <th class="fs-20 text-center">{!! getTickTrueOrFalse($calendar->is_bandem) !!}</th>
            @endif

            @if (!request()->has('show_column') || in_array('approval', $columns))
            <td>{!! getStatusApprovedKm($calendar->approval, $calendar->loai_hoc, $calendar->type) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('km', $columns))
            <td>{!! number_format($calendar->km) !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('so_gio_chay_duoc', $columns))
            <td>{!! $calendar->so_gio_chay_duoc !!}</td>
            @endif

            @if (!request()->has('show_column') || in_array('pickup_registered', $columns))
            <td class="text-center fs-5">{!! getTickTrueOrFalse($calendar->pickup_registered) !!}</td>
            @endif

            {{-- @if (!request()->has('show_column') || in_array('tuition_fee', $columns))
            <td>{!! getMoney($calendar->tuition_fee) !!}</td>
            @endif --}}

            {{-- @if (!request()->has('show_column') || in_array('ngay_dong_hoc_phi', $columns))
            <td>{{ getDateTimeStamp($calendar->ngay_dong_hoc_phi, 'd/m/Y') }}</td>
            @endif --}}

            @if (!request()->has('show_column') || in_array('gifted_hours', $columns))
            <td>{{ $calendar->courseUser->gifted_hours ?? '' }}</td>
            @endif

            @if (!request()->has('show_column') || in_array('chip_hours', $columns))
            <td>{{ $calendar->courseUser->chip_hours ?? '' }}</td>
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
                <div class="d-flex">
                    @if (canAccess('admins.calendars.edit'))
                    <a href="{{ route('admins.calendars.edit', ['calendar' => $calendar->id, 'reload' => request()->reload]) }}"
                        class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-calendars-edit-ajax">
                        <i class="bx bx-edit"></i>
                    </a>
                    @endif

                    @if (canAccess('admins.calendars.destroy'))
                    <form action="{{ route('admins.calendars.destroy', $calendar->id) }}" class="delete-form-ajax"
                        method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
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
{{ $calendars->links() }}

<script>
    jQuery(document).ready(function () {
        function mergeTableRows(selector) {
            var previousText = null;
            var rowspan = 1;
            var previousElement = null;

            $(selector).each(function () {
                var currentText = $(this).text().trim();

                if (previousText === currentText) {
                    // Nếu giá trị giống nhau, ẩn ô hiện tại và tăng rowspan của ô trước đó
                    $(this).remove(); // Xóa ô hiện tại
                    $(previousElement).attr('rowspan', rowspan + 1); // Tăng rowspan
                    rowspan++;
                } else {
                    // Nếu giá trị khác nhau, đặt lại rowspan và cập nhật giá trị trước đó
                    previousText = currentText;
                    previousElement = this; // Lưu lại ô hiện tại
                    rowspan = 1;
                }
            });
        }

        // Gọi hàm để gộp các ô trong cột `date-start-column`
        mergeTableRows('.date-start-column');
    });
</script>
