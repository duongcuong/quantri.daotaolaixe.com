<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong class="mr-1">Tổng số lượng học viên: </strong>
    <strong class="mr-2 text-danger">{{ number_format($calendars->total()) }}</strong>
</div>
<table class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Buổi thi</th>
            <th>Thứ</th>
            <th>Ngày</th>
            <th>Sân thi</th>
            <th>Số lượng học viên</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calendars as $calendar)
            <tr>
                <td>{{ getSTT($calendars, $loop->iteration) }}</td>
                <td>
                    <a href="{{ route('admins.calendars.th', ['date_start' => $calendar->date, 'buoi_hoc' => $calendar->session ]) }}" data-start-date="{{ $calendar->date }}" class="btn-show-exam-schedule">
                        {{  $calendar->session  }}
                    </a>
                </td>
                <td class="date-start-column">
                    <a href="{{ route('admins.calendars.th', ['date_start' => $calendar->date]) }}" data-start-date="{{ $calendar->date }}" class="btn-show-exam-schedule">
                        {!! formatDateTimeVnThu($calendar->date) !!}
                    </a>
                </td>
                <td class="date-start-column2">
                    <a href="{{ route('admins.calendars.th', ['date_start' => $calendar->date]) }}" data-start-date="{{ $calendar->date }}" class="btn-show-exam-schedule">
                        {!! getDateTimeStamp($calendar->date, 'd/m/Y') !!}
                    </a>
                </td>

                <td>{{ $calendar->exam_field_id ? \App\Models\ExamField::find($calendar->exam_field_id)->name : 'N/A' }}</td>
                <td>{{ $calendar->total_calendars }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Hiển thị phân trang --}}
<div class="mt-3">
    {{ $calendars->links() }}
</div>

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
        mergeTableRows('.date-start-column2');
    });
</script>
