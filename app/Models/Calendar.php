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
        'priority',
        'date_start',
        'date_end',
        'duration',
        'description',
        'admin_id',
        'user_id',
        'course_user_id',
        'lead_id',
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
}
