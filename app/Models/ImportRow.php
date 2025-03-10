<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_log_id',
        'course_user_id',
        'row_data',
        'success',
        'error_message',
    ];

    public function importLog()
    {
        return $this->belongsTo(ImportLog::class);
    }
}
