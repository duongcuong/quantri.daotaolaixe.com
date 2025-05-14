<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasFactory;

    protected $table = 'course_users';

    protected $fillable = [
        'user_id',
        'course_id',
        'contract_date',
        'theory_exam',
        'practice_exam',
        'graduation_exam',
        'graduation_date',
        'teacher_id',
        'practice_field',
        'note',
        'health_check_date',
        'sale_id',
        'exam_date',
        'tuition_fee',
        'hours',
        'km',
        'status',
        'ngay_khai_giang',
        'ngay_be_giang',
        'ngay_hoc_cabin',
        'exam_field_id',
        'gifted_hours',
        'chip_hours',
    ];

    /**
     * Get the user that owns the course_user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course that owns the course_user.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class, 'course_user_id');
    }

    /**
     * Get the teacher that owns the course_user.
     */
    public function teacher()
    {
        return $this->belongsTo(Admin::class, 'teacher_id');
    }

    /**
     * Get the sale that owns the course_user.
     */
    public function sale()
    {
        return $this->belongsTo(Admin::class, 'sale_id');
    }

    /**
     * Get the exam field that owns the course user.
     */
    public function examField()
    {
        return $this->belongsTo(ExamField::class);
    }

    /**
     * Get the exam field that owns the course user.
     */
    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }

    public function latestCalendar()
    {
        return $this->hasOne(Calendar::class)->whereIn('type', ['exam_schedule', 'class_schedule'])->latest('date_start');
    }

    public function latestCalendarLyThuyet(){
        return $this->hasOne(Calendar::class)->where('type', 'lythuyet')->orderByDesc('exam_attempts');
    }

    public function latestCalendarThucHanh(){
        return $this->hasOne(Calendar::class)->where('type', 'thuchanh')->orderByDesc('exam_attempts');
    }

    public function latestCalendarTotNghiep(){
        return $this->hasOne(Calendar::class)->where('type', 'exam_edu')->orderByDesc('exam_attempts');
    }

    /**
     * Mutator: Convert gifted_hours from HH:MM to minutes before saving to database.
     */
    public function setGiftedHoursAttribute($value)
    {
        $this->attributes['gifted_hours'] = $this->convertTimeToMinutes($value);
    }

    /**
     * Mutator: Convert chip_hours from HH:MM to minutes before saving to database.
     */
    public function setChipHoursAttribute($value)
    {
        $this->attributes['chip_hours'] = $this->convertTimeToMinutes($value);
    }

    /**
     * Accessor: Convert gifted_hours from minutes to HH:MM when retrieving from database.
     */
    public function getGiftedHoursAttribute($value)
    {
        return $this->convertMinutesToTime($value);
    }

    /**
     * Accessor: Convert chip_hours from minutes to HH:MM when retrieving from database.
     */
    public function getChipHoursAttribute($value)
    {
        return $this->convertMinutesToTime($value);
    }

    /**
     * Helper function to convert HH:MM to minutes.
     */
    private function convertTimeToMinutes($time)
    {
        if (!$time) {
            return 0;
        }

        list($hours, $minutes) = explode(':', $time);
        return ($hours * 60) + $minutes;
    }

    /**
     * Helper function to convert minutes to HH:MM.
     */
    private function convertMinutesToTime($minutes)
    {
        if (!$minutes) {
            return '';
        }

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        return sprintf('%02d:%02d', $hours, $remainingMinutes);
    }
}
