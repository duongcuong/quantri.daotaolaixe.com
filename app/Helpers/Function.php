<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

define('LIMIT', 5);
define('ROLE_SALE', 'sale,quan-ly-sales');

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
        'B1' => 'B1',
        'B2' => 'B2',
        'C' => 'C',
        'D' => 'D',
        'E' => 'E',
        'F' => 'F',
    ];
}

function getRank($rank = '')
{
    if (!$rank) return '';

    $rank = json_decode($rank);

    $ranks = listRanks();
    return implode(' ', array_map(function ($item) use ($ranks) {
        return '<span class="badge badge-secondary">' . $ranks[$item] . '</span>' ?? '';
    }, $rank));
}

function listStatusCourseUser()
{
    $statuses = [
        '0' => 'Chưa học',
        '1' => 'Đang học',
        '2' => 'Hoàn thành'
    ];
    return $statuses;
}

function getStatusCourseUser($status)
{
    $statuses = listStatusCourseUser();
    switch ($status) {
        case 0:
            return '<span class="badge badge-danger">' . $statuses[$status] . '</span>';
            break;
        case 1:
            return '<span class="badge badge-warning">' . $statuses[$status] . '</span>';
            break;
        case 2:
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

function getLevel($level){
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

function listStatusActivities(){
    return [
        'pending' => 'Đang chờ',
        'in_progress' => 'Đang thực hiện',
        'completed' => 'Thành công',
        'cancelled' => 'Đã Huỷ'
    ];
}

function getStatusActivities($status){
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
