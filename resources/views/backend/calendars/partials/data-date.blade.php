<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong class="mr-1">Tổng số lượng học viên: </strong>
    <strong class="mr-2 text-danger">{{ number_format($totalCalendars) }}</strong>
</div>
<table class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Ngày</th>
            <th>Tổng số lịch làm việc</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calendars as $calendar)
            <tr>
                <td>{{ getSTT($calendars, $loop->iteration) }}</td>
                <td>
                    <a href="{{ route('admins.calendars.learning', ['date_start' => $calendar->date]) }}" data-start-date="{{ $calendar->date }}" class="btn-show-exam-schedule">
                        {!! getDateTimeStamp($calendar->date, 'd/m/Y') !!}
                    </a>
                </td>
                <td>{{ $calendar->total_calendars }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Hiển thị phân trang --}}
<div class="mt-3">
    {{ $calendars->links() }}
</div>
