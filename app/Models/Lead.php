<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lead_source_id',
        'interest_level',
        'status',
        'assigned_to',
        'name',
        'email',
        'phone',
        'address',
        'description',
        'dob',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(Admin::class, 'assigned_to');
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class);
    }
}
