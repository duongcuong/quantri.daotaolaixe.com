<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <h3>Xin chào <strong>{{ $userAdmin }}</strong>,</h3>
    <p>Bạn có một thông báo về học phí của học viên.</p>
    <p>Tên học viên: {{ $userName }}</p>
    <p>Tên khóa học: {{ $courseName }}</p>
    <p>Tổng học phí: {!! getMoney($totalFee) !!} </p>
    <p>Học phí đã nộp: {!! getMoney($totalPaid) !!}</p>
    <p style="color: red">Học phí còn thiếu: {!! getMoney($remainingFee) !!}</p>
    <p><a href="{{ $site_url }}">Xem chi tiết</a></p>
</body>
</html>
