@php
$columns = request()->has('show_column') ? explode(',', request()->show_column) : [];
@endphp
<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Ngày</th>
            <th class="w-110">Thời gian</th>
            <th>Học viên</th>
            <th>Ngày sinh</th>
            <th>Buổi học</th>
            <th class="w-130">Giáo viên</th>
            <th>Điểm đón</th>
            <th>Sân học</th>
            <th>Khoá học</th>
            <th>Tự động</th>
            <th>Ban đêm</th>
            <th>Duyệt Km</th>
            <th>Km</th>
            <th>Giờ</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calendars as $calendar)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="date-start-column">
                <a href="javascript:;" data-start-date="{{ $calendar->date_start }}" class="btn-show-exam-schedule">
                    {!! formatDateTimeVn($calendar->date_start) !!}
                </a>
            </td>
            <td>{!! formatTimeBetweenVn($calendar->date_start, $calendar->date_end) !!}</td>
            <td>{{ $calendar->courseUser->user->name ?? '' }}</td>
            <td>{{ $calendar->courseUser && $calendar->courseUser->user ?
                getDateTimeStamp($calendar->courseUser->user->dob, 'd/m/Y') : "" }}</td>
            <td>{!! getLoaiHoc($calendar->loai_hoc) !!}</td>
            <td>{{ $calendar->teacher->name ?? '' }}</td>
            <td>{{ $calendar->diem_don }}</td>
            <td>
                <a href="#" data-exam-field="{{ $calendar->examField->id ?? '' }}" class="btn-show-exam-field">
                    {{ $calendar->examField->name ?? '' }}
                </a>
            </td>
            <td>{{ $calendar->courseUser->course->code ?? '' }}</td>
            <td class="fs-20 text-center">{!! getTickTrueOrFalse($calendar->is_tudong) !!}</td>
            <td class="fs-20 text-center">{!! getTickTrueOrFalse($calendar->is_bandem) !!}</td>
            <td>{!! getStatusApprovedKm($calendar->approval, $calendar->loai_hoc, $calendar->type) !!}</td>
            <td>{!! number_format($calendar->km) !!}</td>
            <td>{!! $calendar->so_gio_chay_duoc !!}</td>

            <td class="fixed-column text-center">
                <div class="d-flex">
                    @if (canAccess('admins.calendars.edit'))
                    <a href="{{ route('admins.calendars.edit', ['calendar' => $calendar->id, 'reload' => request()->reload]) }}"
                        class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-calendars-lich-hoc-edit-ajax">
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
