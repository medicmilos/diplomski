<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:38 PM
 */

namespace App\Models;

use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $table = 'cycles';
    protected $guarded = ['id'];

    public function getLastsUntilAttribute() {
        return  Date::parse($this->attributes['lasts_until']);
    }

    public function setLastsUntilAttribute($value) {
        $this->attributes['lasts_until'] = Date::parse($value)->timezone('UTC');
    }
}
