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
        'basic_status',
        'shape_status',
        'road_status',
        'chip_status',
        'hours',
        'km',
        'status',
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
}
