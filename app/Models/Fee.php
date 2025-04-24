<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'course_user_id',
        'amount',
        'payment_date',
        'payment_method',
        'note',
        'admin_id',
        'is_received',
    ];

    /**
     * Get the course user that owns the fee.
     */
    public function courseUser()
    {
        return $this->belongsTo(CourseUser::class);
    }

    /**
     * Get the admin that received the fee.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
