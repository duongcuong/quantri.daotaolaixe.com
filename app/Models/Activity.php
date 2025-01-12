<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'related_type',
        'related_id',
        'type',
        'subject',
        'description',
        'start_time',
        'end_time',
        'duration',
        'assigned_to',
        'status',
    ];
}
