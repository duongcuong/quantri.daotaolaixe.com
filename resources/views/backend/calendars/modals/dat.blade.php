@if ($courseUser)
<div class="alert alert-primary alert-dismissible" role="alert">
    <h5 class="mb-0">{{ $courseUser->user->name }}</h5>
    <button type="button" class="close close-show-dat" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="mb-3 d-flex">
    <p class="mr-3"><strong>Tổng KM:</strong> <span class="text-danger">{{ number_format($totalKm,2) }}</span></p>
    <p><strong>Tổng giờ:</strong> <span class="text-danger">{{ getFormattedSoGioChayDuocAttribute($totalHours) }}</span>
    </p>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ngày/giờ</th>
            <th>Xe</th>
            <th>KM</th>
            <th>Giờ</th>
            <th>Duyệt</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calendars as $calendar)
        <tr>
            <td>{{ \Carbon\Carbon::parse($calendar->date_start)->format('d/m/Y H:i') }}</td>
            <td>{{ $calendar->vehicle->license_plate ?? 'N/A' }}</td>
            <td>{{ $calendar->km }}</td>
            <td>{{ $calendar->so_gio_chay_duoc }}</td>
            <td>{!! getStatusApprovedKm($calendar->approval, $calendar->loai_hoc, $calendar->type) !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Không tìm thấy thông tin học viên.</p>
@endif
