<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start',
        'date_end',
        'ranks',
        'exam_field_id',
        'loai_thi',
        'description',
        'status',
    ];

    protected $casts = [
        'ranks' => 'array',
        'loai_thi' => 'array',
    ];

    public function examField()
    {
        return $this->belongsTo(ExamField::class);
    }
}
