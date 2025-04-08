<?php
// Admin.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'thumbnail',
        'gender',
        'dob',
        'identity_card',
        'address',
        'rank',
        'license',
        'card_name',
        'card_number',
        'vehicle_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('slug', $permission)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($roles)
    {
        foreach ($this->roles as $role) {
            if (in_array($role->slug, (array) $roles)) {
                return true;
            }
        }
        return false;
    }

    // Mối quan hệ với bảng Calendar
    public function calendars()
    {
        return $this->hasMany(Calendar::class, 'teacher_id');
    }

    public function courseUsers()
    {
        return $this->hasMany(CourseUser::class, 'sale_id');
    }

    public function leads(){
        return $this->hasMany(Lead::class, 'assigned_to');
    }
}
