<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:38 PM
 */

namespace App\Models;


class UserData extends GalleryModel
{
    protected $table = 'user_data';

    protected $appends = ['name', 'email'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getEmailAttribute()
    {
        return $this->user()->email;
    }


    public function getNameAttribute()
    {
        return $this->user()->name;
    }
}
