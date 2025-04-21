<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        // 'name',
        'rank',
        'rank_gp',
        'number_bc',
        'date_bci',
        'start_date',
        'end_date',
        'number_students',
        'decision_kg',
        'duration',
        'tuition_fee',
        'status',
        'ngay_hoc_cabin',
    ];

    protected $casts = [
        'date_bci' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_users')
                    ->withPivot('basic_status', 'shape_status', 'road_status', 'chip_status', 'status')
                    ->withTimestamps();
    }

    public function courseUsers()
    {
        return $this->hasMany(CourseUser::class);
    }
}
