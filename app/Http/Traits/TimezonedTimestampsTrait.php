<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:21 PM
 */

namespace App\Http\Traits;

use Jenssegers\Date\Date;

trait TimezonedTimestampsTrait
{
    public function getCreatedAtAttribute() {
        return  Date::parse($this->attributes['created_at'])->timezone(config('settings.app_timezone', 'UTC'));
    }

    public function setCreatedAtAttribute($value) {
        $this->attributes['created_at'] = Date::parse($value)->timezone('UTC');
    }


    public function getUpdatedAtAttribute() {
        return  Date::parse($this->attributes['updated_at'])->timezone(config('settings.app_timezone', 'UTC'));
    }

    public function setUpdatedAtAttribute($value) {
        $this->attributes['updated_at'] = Date::parse($value)->timezone('UTC');
    }
}
