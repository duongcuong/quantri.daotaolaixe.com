<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

define('LIMIT', 50);
define('ROLE_SALES', 'sale,quan-ly-sales');
define('ROLE_FEE', 'sale,quan-ly-sales');
define('ROLE_VEHICLE_EXPENSE', 'sale,quan-ly-sales,giao-vien,admin');
define('ROLE_TEACHER', 'giao-vien');
define('ROLE_SALE', 'sale');
define('ROLE_ADMIN', 'admin');
define('ROLE_SUPERADMIN', 'super-admin');
define('NOTIFI_FEE', 30);
define('STATUS_CALENDAR_CANCEL', 44);

if (!function_exists('uploadImage')) {
    function uploadImage($file, $folder = "uploads")
    {
        // Tạo tên file duy nhất
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/' . $folder, $filename);

        // Kiểm tra xem file đã được lưu chưa
        if (!Storage::exists($path)) {
            throw new \Exception('File not saved to storage.');
        }

        // Định nghĩa các kích thước cần cắt
        $sizes = [
            'small' => [150, 150],
            'medium' => [300, 300],
            'large' => [600, 600],
        ];

        // Cắt và lưu các kích thước ảnh
        foreach ($sizes as $size => $dimensions) {
            $image = Image::make(Storage::path($path))->resize($dimensions[0], $dimensions[1], function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedPath = 'public/' . $folder . '/' . $size . '_' . $filename;
            $image->save(Storage::path($resizedPath));

            // Kiểm tra xem file đã được lưu chưa
            if (!Storage::exists($resizedPath)) {
                throw new \Exception('Resized file not saved to storage: ' . $resizedPath);
            }
        }

        return $filename;
    }
}

if (!function_exists('getSTT')) {
    function getSTT($paginator, $loopIndex)
    {
        return ($paginator->currentPage() - 1) * $paginator->perPage() + $loopIndex;
    }
}


if (!function_exists('getImageUpload')) {
    function getImageUpload($filename, $folder = "uploads", $size = "")
    {
        $sizes = ['small', 'medium', 'large'];

        if (in_array($size, $sizes)) {
            $path = "public/$folder" . '/' . $size . '_' . $filename;
            if (Storage::exists($path)) {
                return Storage::url($path);
            }
        }

        return asset('images/no_image.jpg');
    }
}

function listGenders()
{
    return [
        0 => 'Nam',
        1 => 'Nữ',
        2 => 'Khác'
    ];
}

function getGender($gender)
{
    $genders = listGenders();
    return $genders[$gender] ?? '';
}

function listStatus()
{
    return [
        '1' => 'Hoạt động',
        '0' => 'Không hoạt động'
    ];
}

function getStatus($status)
{
    $statuses = listStatus();
    switch ($status) {
        case 1:
            return '<span class="badge badge-success">' . $statuses[$status] . '</span>';
            break;
        case 0:
            return '<span class="badge badge-danger">' . $statuses[$status] . '</span>';
            break;
        default:
            return '';
            break;
    }
}

function listRanks()
{
    return [
        'A1' => 'A1',
        'A2' => 'A2',
        'B1' => 'B tự động',
        'B2' => 'B số sàn',
        'C' => 'C',
        'D' => 'D',
        'E' => 'E',
        'F' => 'F',
    ];
}

function getRank($rank = '', $json = true)
{
    if (!$rank) return '';
    if ($json){
        $rank = json_decode($rank);
    }

    $ranks = listRanks();
    return implode(' ', array_map(function ($item) use ($ranks) {
        return '<span class="badge badge-secondary">' . $ranks[$item] . '</span>' ?? '';
    }, $rank));
}

function getRankOne($rank = '')
{
    $ranks = listRanks();
    if (!$rank || !array_key_exists($rank, $ranks)) return 'N/A';
    return '<span class="badge badge-secondary">' . $ranks[$rank] . '</span>';
}

function listStatusCourseUser()
{
    $statuses = [
        '0' => 'Chưa học',
        '1' => 'Đang học',
        '2' => 'Chờ thi',
        '3' => 'Thi lại',
        '4' => 'Đã đỗ',
    ];
    return $statuses;
}

function getStatusCourseUser($status)
{
    $statuses = listStatusCourseUser();
    switch ($status) {
        case 0:
            return '<span class="badge badge-secondary">' . $statuses[$status] . '</span>';
            break;
        case 1:
            return '<span class="badge badge-primary">' . $statuses[$status] . '</span>';
            break;
        case 2:
            return '<span class="badge badge-info">' . $statuses[$status] . '</span>';
            break;
        case 3:
            return '<span class="badge badge-warning">' . $statuses[$status] . '</span>';
            break;
        case 4:
            return '<span class="badge badge-success">' . $statuses[$status] . '</span>';
            break;
        default:
            return '';
            break;
    }
}

function listStatusFee()
{
    return [
        '0' => 'Chưa về công ty',
        '1' => 'Đã về công ty'
    ];
}

function getStatusFee($status)
{
    $statuses = listStatusFee();
    switch ($status) {
        case 0:
            return '<span class="badge badge-danger">' . $statuses[$status] . '</span>';
            break;
        case 1:
            return '<span class="badge badge-success">' . $statuses[$status] . '</span>';
            break;
        default:
            return '';
            break;
    }
}

function listLevels()
{
    return [
        'low' => 'Thấp',
        'medium' => 'Trung bình',
        'high' => 'Cao'
    ];
}

function getLevel($level)
{
    $levels = listLevels();
    switch ($level) {
        case 'high':
            return '<span class="badge badge-danger">' . $levels[$level] . '</span>';
            break;
        case 'medium':
            return '<span class="badge badge-warning">' . $levels[$level] . '</span>';
            break;
        default:
            return '<span class="badge badge-secondary">' . $levels[$level] . '</span>';
            break;
    }
}

function listStatusActivities()
{
    return [
        'pending' => 'Đang chờ',
        'in_progress' => 'Đang thực hiện',
        'completed' => 'Thành công',
        'cancelled' => 'Đã Huỷ'
    ];
}

function getStatusActivities($status)
{
    $statuss = listLevels();
    switch ($status) {
        case 'pending':
            return '<span class="badge badge-warning">' . $statuss[$status] . '</span>';
            break;
        case 'in_progress':
            return '<span class="badge badge-info">' . $statuss[$status] . '</span>';
            break;
        case 'completed':
            return '<span class="badge badge-success">' . $statuss[$status] . '</span>';
            break;
        default:
            return '<span class="badge badge-secondary">' . $statuss[$status] . '</span>';
            break;
    }
}

function getTickTrueOrFalse($value)
{
    if ($value == 1) {
        return '<i class="text-success bx bx-check-circle"></i>';
    } else {
        return '<i class="text-danger bx bx-x-circle"></i>';
    }
}

function getMoney($money)
{
    if (!$money) return '0 <sup>đ</sup>';
    return number_format($money, 0, ',', '.') . ' <sup>đ</sup>';
}

function getMoneyConThieu($total, $paid)
{
    if (!$total) return '0 <sup>đ</sup>';

    if ($total - $paid <= 0) {
        return '<span class="badge badge-success">Đã thanh toán</span>';
    }

    return '<span class="badge badge-danger">' . number_format($total - $paid, 0, ',', '.') . ' <sup>đ</sup></span>';
}

function getDateByExcel($date)
{
    if (!$date) return null;

    return Date::excelToDateTimeObject($date)->format('Y-m-d');
}

function getDateTimeStamp($timestamp, $format = 'Y-m-d')
{
    if (!$timestamp) return null;

    return \Carbon\Carbon::parse($timestamp)->format($format);
}

function getNumberCsExcel($number)
{
    if (!$number) return 0;
    $numberTmp = preg_replace('/\D/', '', $number);
    return $numberTmp ? $numberTmp : 0;
}

function listTypeCalendars()
{
    return [
        'task' => 'Công việc',
        'meeting' => 'Lịch họp',
        'call' => 'Lịch gọi',
        'class_schedule' => 'Lịch học',
        'exam_schedule' => 'Lịch thi',
    ];
}

function getTypeCalendar($type)
{
    $types = listTypeCalendars();
    switch ($type) {
        case 'task':
            return '<span class="text-danger">' . $types[$type] . '</span>';
            break;
        case 'meeting':
            return '<span class="text-warning">' . $types[$type] . '</span>';
            break;
        case 'call':
            return '<span class="text-success">' . $types[$type] . '</span>';
            break;
        case 'exam_schedule':
            return '<span class="text-info">' . $types[$type] . '</span>';
            break;
        case 'class_schedule':
            return '<span class="text-primary">' . $types[$type] . '</span>';
            break;
        default:
            return '';
            break;
    }
}

function listStatusCalendars()
{
    return [
        'task' => [
            0 => 'Chưa bắt đầu',
            1 => 'Đang tiến hành',
            2 => 'Hoàn thành',
            3 => 'Hoãn lại',
        ],
        'meeting' => [
            10 => 'Đã lên lịch',
            11 => 'Đang diễn ra',
            12 => 'Hoàn thành',
            13 => 'Đã hủy',
        ],
        'call' => [
            20 => 'Đã lên kế hoạch',
            21 => 'Đã thực hiện',
            22 => 'Không thực hiện',
        ],
        'exam_schedule' => [
            30 => 'Đang chờ',
            31 => 'Đỗ',
            32 => 'Thi lại',
            33 => 'Thi mới',
        ],
        'class_schedule' => [
            40 => 'Đang chờ',
            41 => 'Đang học',
            42 => 'Hoàn thành',
            43 => 'Thiếu giáo viên',
            44 => 'Huỷ ca',
        ],
        // Add other types and their statuses as needed
    ];
}

function getStatusCalendarByType($type, $status)
{
    $statuses = listStatusCalendars();

    if(!isset($statuses[$type][$status])) return '';

    switch ($status) {
        case '0':
            return '<span class="badge badge-info">' . $statuses[$type][$status] . '</span>';
            break;
        case '1':
            return '<span class="badge badge-primary">' . $statuses[$type][$status] . '</span>';
            break;
        case '2':
            return '<span class="badge badge-success">' . $statuses[$type][$status] . '</span>';
            break;
        case '3':
            return '<span class="badge badge-warning">' . $statuses[$type][$status] . '</span>';
            break;
        case '10':
            return '<span class="badge badge-info">' . $statuses[$type][$status] . '</span>';
            break;
        case '11':
            return '<span class="badge badge-primary">' . $statuses[$type][$status] . '</span>';
            break;
        case '12':
            return '<span class="badge badge-success">' . $statuses[$type][$status] . '</span>';
            break;
        case '13':
            return '<span class="badge badge-secondary">' . $statuses[$type][$status] . '</span>';
            break;
        case '20':
            return '<span class="badge badge-success">' . $statuses[$type][$status] . '</span>';
            break;
        case '21':
            return '<span class="badge badge-info">' . $statuses[$type][$status] . '</span>';
            break;
        case '22':
            return '<span class="badge badge-secondary">' . $statuses[$type][$status] . '</span>';
            break;
        case '30':
            return '<span class="badge badge-warning">' . $statuses[$type][$status] . '</span>';
            break;
        case '31':
            return '<span class="badge badge-success">' . $statuses[$type][$status] . '</span>';
            break;
        case '32':
            return '<span class="badge badge-danger">' . $statuses[$type][$status] . '</span>';
            break;
        case '33':
            return '<span class="badge badge-secondary">' . $statuses[$type][$status] . '</span>';
            break;
        case '40':
            return '<span class="badge badge-warning">' . $statuses[$type][$status] . '</span>';
            break;
        case '41':
            return '<span class="badge badge-info">' . $statuses[$type][$status] . '</span>';
            break;
        case '42':
            return '<span class="badge badge-success">' . $statuses[$type][$status] . '</span>';
            break;
        case '43':
            return '<span class="badge badge-secondary">' . $statuses[$type][$status] . '</span>';
            break;
        case '44':
            return '<span class="badge badge-danger">' . $statuses[$type][$status] . '</span>';
            break;
        default:
            return "";
            break;
    }
}

function getStatusCalendarByType2($type, $status)
{
    $statuses = listStatusCalendars();

    if(!$type || !$status) return '';
    if(!isset($statuses[$type][$status])) return '';

    switch ($status) {
        case '30':
            return '<strong>Thi: </strong><span class="badge badge-warning">' . $statuses[$type][$status] . '</span>';
            break;
        case '31':
            return '<strong>Thi: </strong><span class="badge badge-success">' . $statuses[$type][$status] . '</span>';
            break;
        case '32':
            return '<strong>Thi: </strong><span class="badge badge-danger">' . $statuses[$type][$status] . '</span>';
            break;
        case '33':
            return '<strong>Thi: </strong><span class="badge badge-secondary">' . $statuses[$type][$status] . '</span>';
            break;
        case '40':
            return '<strong>Học: </strong><span class="badge badge-warning">' . $statuses[$type][$status] . '</span>';
            break;
        case '41':
            return '<strong>Học: </strong><span class="badge badge-info">' . $statuses[$type][$status] . '</span>';
            break;
        case '42':
            return '<strong>Học: </strong><span class="badge badge-success">' . $statuses[$type][$status] . '</span>';
            break;
        case '43':
            return '<strong>Học: </strong><span class="badge badge-secondary">' . $statuses[$type][$status] . '</span>';
            break;
        case '44':
            return '<strong>Học: </strong><span class="badge badge-danger">' . $statuses[$type][$status] . '</span>';
            break;
        default:
            return "";
            break;
    }
}

function listPriorities()
{
    return [
        'Low' => 'Thấp',
        'Normal' => 'Trung bình',
        'High' => 'Cao',
        'Urgent' => 'Khẩn cấp',
    ];
}

function getPriority($priority)
{
    $priorities = listPriorities();
    switch ($priority) {
        case 'Urgent':
            return '<span class="badge badge-danger">' . $priorities[$priority] . '</span>';
            break;
        case 'High':
            return '<span class="badge badge-warning">' . $priorities[$priority] . '</span>';
            break;
        case 'Normal':
            return '<span class="badge badge-info">' . $priorities[$priority] . '</span>';
            break;
        default:
            return '<span class="badge badge-secondary">' . $priorities[$priority] . '</span>';
            break;
    }
}

function listDurations()
{
    return [
        '300' => '5 phút',
        '600' => '10 phút',
        '900' => '15 phút',
        '1800' => '30 phút',
        '2700' => '45 phút',
        '3600' => '1 giờ',
        '7200' => '2 giờ',
        '10800' => '3 giờ',
    ];
}

function getDuration($duration)
{
    $durations = listDurations();
    return '<span class="badge badge-secondary">' . $durations[$duration] . '</span>' ?? '';
}

function listLoaiHocs()
{
    return [
        'hoc_ky_nang' => 'Học kỹ năng',
        'ly_thuyet' => 'Lý thuyết',
        'thuc_hanh' => 'Sa hình',
        'mo_phong' => 'Mô phỏng',
        'cabin' => 'Cabin',
        'chay_dat' => 'Chạy DAT',
        // 'duong_truong' => 'Đường trường',
    ];
}

function getLoaiHoc($loaiHoc)
{
    if (!$loaiHoc) return '';
    $loaiHocs = listLoaiHocs();
    if(!isset($loaiHocs[$loaiHoc])) return '';
    return '<span class="badge badge-secondary">' . $loaiHocs[$loaiHoc] . '</span>' ?? '';
}

function listLoaiThis()
{
    return [
        'thi_ly_thuyet' => 'Thi lý thuyết',
        'thi_mo_phong' => 'Thi mô phỏng',
        'thi_thuc_hanh' => 'Thi sa hình',
        'thi_duong_truong' => 'Thi đường trường'
    ];
}

function listLoaiThiRutGons()
{
    return [
        'thi_thuc_hanh' => 'TH',
        'thi_ly_thuyet' => 'LT',
        'thi_mo_phong' => 'MP',
        'thi_duong_truong' => 'ĐT'
    ];
}

function getLoaiThi($loaiThi)
{
    if (!$loaiThi) return '';
    $loaiHocs = listLoaiThiRutGons();
    $result = [];
    foreach ($loaiThi as $item) {
        if ($loaiHocs[$item]) {
            $result[] = '<span class="badge badge-secondary mr-1 mb-1">' . $loaiHocs[$item] . '</span>';
        }
    }
    return implode('', $result);
}

function formatDateTimeVn($dateTime)
{
    if (!$dateTime) return '';
    $date = Carbon::parse($dateTime);
    $dayOfWeek = [
        'Sunday' => 'Chủ nhật',
        'Monday' => 'Thứ 2',
        'Tuesday' => 'Thứ 3',
        'Wednesday' => 'Thứ 4',
        'Thursday' => 'Thứ 5',
        'Friday' => 'Thứ 6',
        'Saturday' => 'Thứ 7',
    ];
    return $dayOfWeek[$date->format('l')] . ', ' . $date->format('d/m/Y');
}

function formatDateTimeVnThu($dateTime)
{
    if (!$dateTime) return '';
    $date = Carbon::parse($dateTime);
    $dayOfWeek = [
        'Sunday' => 'Chủ nhật',
        'Monday' => 'Thứ 2',
        'Tuesday' => 'Thứ 3',
        'Wednesday' => 'Thứ 4',
        'Thursday' => 'Thứ 5',
        'Friday' => 'Thứ 6',
        'Saturday' => 'Thứ 7',
    ];
    return $dayOfWeek[$date->format('l')];
}

function formatTimeVn($dateTime)
{
    if (!$dateTime) return '';
    $date = Carbon::parse($dateTime);
    return $date->format('H\hi');
}

function formatTimeBetweenVn($dateStart, $dateEnd)
{
    if (!$dateStart && !$dateEnd) return '';
    $stringArr = [];
    if($dateStart) $stringArr[] = formatTimeVn($dateStart);
    if($dateEnd) $stringArr[] = formatTimeVn($dateEnd);
    return implode(' - ', $stringArr);
}

function getFormattedSoGioChayDuocAttribute($value)
{
    if ($value === null) {
        return "00:00";
    }
    $totalMinutes = $value;
    $hours = intdiv($totalMinutes, 60);
    $minutes = $totalMinutes % 60;
    return sprintf('%02d:%02d', $hours, $minutes);
}

function listStatusLeads()
{
    return [
        'new' => 'Mới',
        'contacted' => 'Đã liên hệ',
        'qualified' => 'Đã chuyển đổi',
        'lost' => 'Mất',
        'closed' => 'Đã đóng',
    ];
}

function getStatusLead($status)
{
    if (!$status) return '';
    $statuses = listStatusLeads();
    switch ($status) {
        case 'new':
            return '<span class="badge badge-primary">' . $statuses[$status] . '</span>';
            break;
        case 'contacted':
            return '<span class="badge badge-info">' . $statuses[$status] . '</span>';
            break;
        case 'qualified':
            return '<span class="badge badge-success">' . $statuses[$status] . '</span>';
            break;
        case 'lost':
            return '<span class="badge badge-danger">' . $statuses[$status] . '</span>';
            break;
        case 'closed':
            return '<span class="badge badge-secondary">' . $statuses[$status] . '</span>';
            break;
        default:
            return '';
            break;
    }
}

function convertHoursExcelToSeconds($value)
{
    if (!$value) return null;
    return $value * 24 * 60;
}

function listStatusApprovedKm(){
    return ['chay_dat', 'thuc_hanh', 'hoc_ky_nang'];
}

function getStatusApprovedKm($value, $loai_hoc, $type){
    if($type == 'class_schedule'){
        if(in_array($loai_hoc, listStatusApprovedKm())){
            if($value == 1){
                return '<span class="badge badge-success">Đã duyệt</span>';
            }else{
                return '<span class="badge badge-danger">Chưa duyệt</span>';
            }
        }
    }
    return '...';
}

function formatPhoneNumber($phone)
{
    if (!empty($phone) && substr($phone, 0, 1) !== '0') {
        return '0' . $phone;
    }
    return $phone;
}

function listTypeVahicleExpenses()
{
    return [
        'sa_hinh' => 'Sa hình',
        'do_xang' => 'Đổ xăng',
        'bao_duong' => 'Bảo dưỡng',
        'dang_kiem' => 'Đăng kiểm',
        'thay_lop' => 'Thay lốp',
        'khac' => 'Khác',
    ];
}

function getTypeVahicleExpense($value, $note = null)
{
    if (!$value) return '';
    $lists = listTypeVahicleExpenses();
    $result = $lists[$value];
    if($value == 'khac' && $note){
        $result = $note;
    }
    return '<span class="badge badge-secondary">' . $result . '</span>';
}

/**
 * Check if the user has permission to access a specific route
 */
if (!function_exists('canAccess')) {
    function canAccess($permission)
    {
        return Auth::guard('admin')->user()->hasPermission($permission);
    }
}

function listFeeTypes()
{
    return [
        '1' => 'Học phí',
        '2' => 'Lệ phí giờ đăng ký',
        '3' => 'Lệ phí cọc chíp',
        '4' => 'Lệ phí đưa đón',
        '5' => 'Khác',
    ];
}

function getFeeType($type)
{
    if (!$type) return '';
    $types = listFeeTypes();
    switch ($type) {
        case '1':
            return '<span class="badge badge-primary">' . $types[$type] . '</span>';
            break;
        case '2':
            return '<span class="badge badge-warning">' . $types[$type] . '</span>';
            break;
        case '3':
            return '<span class="badge badge-success">' . $types[$type] . '</span>';
            break;
        case '4':
            return '<span class="badge badge-danger">' . $types[$type] . '</span>';
            break;
        case '5':
            return '<span class="badge badge-secondary">' . $types[$type] . '</span>';
            break;
        default:
            return '';
            break;
    }
}
