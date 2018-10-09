<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 10/9/2018
 * Time: 4:51 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $fillable = [
        'name'
    ];

    /**
     * A role can have many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {

        return $this->belongsToMany('App\User','users');
    }

}