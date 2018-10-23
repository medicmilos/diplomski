<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userData()
    {
        return $this->hasOne('App\Models\UserData');
    }
    public function userGalleryItems()
    {
        return $this->hasMany('App\Models\GalleryItem');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_users', 'user_id');
    }

    public function isAdmin()
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name == 'Super Admin' || $role->name == 'Administrator') {
                return true;
            }
        }

        return false;
    }
}
