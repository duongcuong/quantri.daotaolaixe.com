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
        'exam_field_id'
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
}
