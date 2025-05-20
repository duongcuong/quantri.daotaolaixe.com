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
