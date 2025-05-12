@php
$columns = request()->has('show_column') ? explode(',', request()->show_column) : [];
@endphp
<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th rowspan="2">STT</th>
            <th rowspan="2">Buổi thi</th>
            <th rowspan="2">Học viên</th>
            <th rowspan="2">Ngày sinh</th>
            <th rowspan="2">CCCD</th>
            <th rowspan="2">SĐT</th>
            <th rowspan="2">SBD</th>
            {{-- <th rowspan="2">Sân thi</th> --}}
            <th rowspan="2">Khoá học</th>
            <th rowspan="2">Môn thi</th>
            <th rowspan="2">Khám SK</th>
            <th rowspan="2">Đưa đón</th>
            <th colspan="2" class="text-center">Xe chíp</th>
            <th rowspan="2" class="text-center">Ghi chú</th>
            <th rowspan="2" class="fixed-column text-center">Hành động</th>
        </tr>
        <tr>
            <th>Giờ tặng</th>
            <th>Số giờ đăng ký</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calendars as $calendar)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{!! getSangChieu($calendar->date_start) !!}</td>
            <td>{{ $calendar->courseUser->user->name ?? '' }}</td>
            <td>{{ $calendar->courseUser && $calendar->courseUser->user ?
                getDateTimeStamp($calendar->courseUser->user->dob, 'd/m/Y') : "" }}</td>
            <td>{{ $calendar->courseUser->user->identity_card ?? '' }}</td>
            <td>{{ $calendar->courseUser->user->phone ?? '' }}</td>
            <td>{{ $calendar->sbd ?? '' }}</td>
            <td>{{ $calendar->courseUser->course->code ?? '' }}</td>
            <td>{!! getLoaiThi($calendar->loai_thi) !!}</td>
            <td>{{ $calendar->courseUser ? getDateTimeStamp($calendar->courseUser->health_check_date, 'd/m/Y') : '' }}
            </td>
            <td class="text-center fs-5">{!! getTickTrueOrFalse($calendar->pickup_registered) !!}</td>
            <td>{{ $calendar->courseUser->gifted_hours ?? '' }}</td>
            <td>{{ $calendar->courseUser->chip_hours ?? '' }}</td>
            <td>{{ $calendar->description }}</td>
            <td class="fixed-column text-center">
                <div class="d-flex">
                    @if (canAccess('admins.calendars.edit'))
                    <a href="{{ route('admins.calendars.edit', ['calendar' => $calendar->id, 'reload' => request()->reload]) }}"
                        class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-calendars-thuc-hanh-edit-ajax">
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
