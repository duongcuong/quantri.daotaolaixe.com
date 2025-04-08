<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'admin_id',
        'type',
        'expense_date',
        'amount',
        'note'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
