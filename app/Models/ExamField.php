<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the course users for the exam field.
     */
    public function courseUsers()
    {
        return $this->hasMany(CourseUser::class);
    }
}
