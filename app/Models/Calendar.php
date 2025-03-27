<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'status',
        'approval',
        'priority',
        'date_start',
        'date_end',
        'duration',
        'description',
        'admin_id',
        'user_id',
        'course_user_id',
        'lead_id',
        'tuition_fee',
        'reason',
        'ngay_dong_hoc_phi',
        'hang_thi',
        'created_by',
        'exam_field_id',
        'teacher_id',
        'loai_hoc',
        'km',
        'is_tudong',
        'is_bandem',
        'so_xe',
        'loai_thi',
        'diem_don',
        'so_gio_chay_duoc',
        'sbd'
    ];

    protected $casts = [
        'loai_thi' => 'array',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseUser()
    {
        return $this->belongsTo(CourseUser::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function examField()
    {
        return $this->belongsTo(ExamField::class, 'exam_field_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Admin::class, 'teacher_id');
    }

    public function getSoGioChayDuocAttribute($value)
    {
        if ($value === null) {
            return null;
        }

        $hours = intdiv($value, 60);
        $minutes = $value % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public function setSoGioChayDuocAttribute($value)
    {
        if ($value === null) {
            $this->attributes['so_gio_chay_duoc'] = null;
        } else {
            list($hours, $minutes) = sscanf($value, '%d:%d');
            $this->attributes['so_gio_chay_duoc'] = $hours * 60 + $minutes;
        }
    }
}
