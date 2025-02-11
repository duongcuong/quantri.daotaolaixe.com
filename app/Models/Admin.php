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
}
