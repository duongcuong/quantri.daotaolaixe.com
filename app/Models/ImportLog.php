<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'sanitized_file_name',
        'admin_id',
        'imported_at',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function importRows()
    {
        return $this->hasMany(ImportRow::class);
    }
}
