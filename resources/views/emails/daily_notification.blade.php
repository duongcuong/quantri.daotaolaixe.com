<!DOCTYPE html>
<html>
<head>
    <title>Thông báo lịch trong ngày</title>
</head>
<body>
    <h1>Thông báo lịch trong ngày</h1>
    <p>Xin chào <strong>{{ $user }}</strong>,</p>
    <p>Dưới đây là danh sách các lịch của bạn trong ngày hôm nay:</p>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>STT</th>
                <th>Kiểu lịch</th>
                <th>Tên lịch</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Mô tả</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calendars as $key => $calendar)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{!! getTypeCalendar($calendar['type']) !!}</td>
                <td>{{ $calendar['name'] }}</td>
                <td>{!! formatDateTimeVn($calendar['date_start']) !!}</td>
                <td>{!! formatDateTimeVn($calendar['date_end']) !!}</td>
                <td>{{ $calendar['description'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Trân trọng,</p>
    <p>Đội ngũ quản lý</p>
</body>
</html>
