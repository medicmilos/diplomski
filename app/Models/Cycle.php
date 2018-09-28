<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:38 PM
 */

namespace App\Models;

use Jenssegers\Date\Date;
use App\Models\GalleryModel;
use App\Http\Traits\TimezonedTimestampsTrait;

class Cycle extends GalleryModel
{
    use TimezonedTimestampsTrait;


    protected $table = 'cycles';
    protected $guarded = ['id'];

    public function getLastsUntilAttribute() {
        return  Date::parse($this->attributes['lasts_until'])->timezone(config('settings.app_timezone', 'UTC'));
    }

    public function setLastsUntilAttribute($value) {
        $this->attributes['lasts_until'] = Date::parse($value)->timezone('UTC');
    }
}
